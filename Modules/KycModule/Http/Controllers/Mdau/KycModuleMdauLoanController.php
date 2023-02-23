<?php

namespace Modules\KycModule\Http\Controllers\Mdau;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


use View;
use Auth;
use Carbon\Carbon;
use Session;
use Modules\KycModule\Entities\Step;
use Modules\KycModule\Entities\Loan;
use Modules\KycModule\Entities\Category;
use Modules\KycModule\Entities\StepCategory;
use Modules\KycModule\Entities\MdauLoanOtherDebts;
use Modules\KycModule\Entities\MdauLoan;
use Modules\KycModule\Entities\MdauLoanGuarantorPerson;
use Modules\KycModule\Entities\MdauReview;
use Redirect;




class KycModuleMdauLoanController extends Controller
{

  public function step_one_form($loan)
  {

       $customer = Auth::guard('customer')->User();

      $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

      return view('kycmodule::forms.mdau.step_one_form', compact('mdauLoan'));
  }


        public function mdauLoanOne(Request $request){
            
            
        $request->merge(['amount'=> str_replace(',', '', $request->amount)]);


          $validator =  Validator::make($request->all(), [
              'mdau' => ['required', 'integer'],
              'amount' => ['required', 'integer'],
              'amount_words' => ['required', 'string'],
              'intension' => ['required','string'],
              'work_business' => ['required','string'],
              'dependants_count' => ['required', 'string'],
              'income_perday' => ['required', 'string'],
              'income_perweek' => ['required', 'string'],
              'income_permonth' => ['required', 'string'],
              'income_peryear' => ['required', 'string'],
              'other_properties' => ['required','string'],
          ]);



        $message = 'Formu imewasilishwa ikiwa na mapungufu.';


          if($validator->fails()){

                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
          }



          $customer = Auth::guard('customer')->User();

          $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $request->mdau)->first();

          $mdauLoan->amount = $request->amount;
          $mdauLoan->amount_words = $request->amount_words;
          $mdauLoan->intension = $request->intension;
          $mdauLoan->work_business = $request->work_business;

          $mdauLoan->dependants_count = $request->dependants_count;
          $mdauLoan->income_perday = $request->income_perday;
          $mdauLoan->income_perweek = $request->income_perweek;
          $mdauLoan->income_permonth = $request->income_permonth;
          $mdauLoan->income_peryear = $request->income_peryear;
          $mdauLoan->other_properties = $request->other_properties;
          $mdauLoan->save();

          $message = 'Umeongeza hatua kikamilifu';



         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'location'=>'/kycmodule/loan/mdau/'.$mdauLoan->id.'/step-two', 'html'=>$html]);



      }




      public function step_two_form($loan)
      {

        $customer = Auth::guard('customer')->User();

        $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        $mdauOtherDebts = MdauLoanOtherDebts::where('mdau_id', $mdauLoan->id)->get();

          return view('kycmodule::forms.mdau.step_two_form', compact('mdauLoan', 'mdauOtherDebts'));
      }









        public function mdauLoanTwo(Request $request){

          $validator =  Validator::make($request->all(), [
              'debt_amount' => ['required', 'integer'],
              'debt_institution' => ['required', 'string'],
              'clear_date' => ['required','string'],
              "phone"    => ['required','string'],
              'region' => ['required', 'string'],
              'district' => ['required', 'string'],
              'ward' => ['required', 'string'],
          ]);

           $message = 'Formu imewasilishwa ikiwa na mapungufu.';


          if($validator->fails()){

                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
          }



          $customer = Auth::guard('customer')->User();

          $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $request->mdau)->first();


              $mdauOtherDebts = new MdauLoanOtherDebts();
              $mdauOtherDebts->mdau_id = $mdauLoan->id;
              $mdauOtherDebts->amount = $request->debt_amount;
              $mdauOtherDebts->debt_institution =  $request->debt_institution;
              $mdauOtherDebts->finish_date= $request->clear_date;
              $mdauOtherDebts->phone = $request->phone;
              if(!empty($request->registration_number)){
                $mdauOtherDebts->registration_number = $request->registration_number;
              }
              $mdauOtherDebts->region = $request->region;
              $mdauOtherDebts->district =  $request->district;
              $mdauOtherDebts->ward =  $request->ward;
              $mdauOtherDebts->save();

              $message = 'Umeongeza hatua kikamilifu';

         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

        }


        public function delete_debt($loan, $debt)
        {

          $customer = Auth::guard('customer')->User();

          $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          MdauLoanOtherDebts::where('mdau_id', $mdauLoan->id)->where('id', $debt)->delete();

          return back();
        }





        public function step_three_form($loan)
        {

          $customer = Auth::guard('customer')->User();

          $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          $guarators = MdauLoanGuarantorPerson::where('mdau_id', $mdauLoan->id)->get();

            return view('kycmodule::forms.mdau.step_three_form', compact('mdauLoan', 'guarators'));
        }



        public function mdauLoanThree(Request $request){

          $validator =  Validator::make($request->all(), [
              'first_name' => ['required', 'string'],
              'middle_name' => ['required', 'string'],
              'last_name' => ['required','string'],
              "identity_type"    => ['required','string'],
              'identity'=>['required','string'],
              'identity_copy' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
              'mdau' => ['required', 'string'],
              'phone' => ['required', 'string'],
              'relationship' => ['required', 'string'],
          ]);

           $message = 'Formu imewasilishwa ikiwa na mapungufu.';


          if($validator->fails()){

                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
          }



             $customer = Auth::guard('customer')->User();


             $mdauLoan =  MdauLoan::where('id', $request->mdau)->where('customer_id', $customer->id)->first();


              // return $mdauLoan;

              $mdauLoanGuarantorPerson = new MdauLoanGuarantorPerson();
              $mdauLoanGuarantorPerson->mdau_id = $mdauLoan->id;
              $mdauLoanGuarantorPerson->first_name = $request->first_name;
              $mdauLoanGuarantorPerson->middle_name =  $request->middle_name;
              $mdauLoanGuarantorPerson->last_name= $request->last_name;
              $mdauLoanGuarantorPerson->phone = $request->phone;
              $mdauLoanGuarantorPerson->identity_type = $request->identity_type;
              $mdauLoanGuarantorPerson->identity = $request->identity;
              $mdauLoanGuarantorPerson->relationship =  $request->relationship;

              if(!empty($request->identity_copy)){
               $image = $request->file('identity_copy');
               $path = 'modules/kycmodule/uploads/identities';
               $name = strtolower($request->last_name).'-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
               $image->move(public_path($path), $name);
               $mdauLoanGuarantorPerson->identity_path =   $path.'/'.$name;
                }

              $mdauLoanGuarantorPerson->save();

              $message = 'Umeongeza hatua kikamilifu';

         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

        }


        public function delete_guarantor($loan, $guarator)
        {

          $customer = Auth::guard('customer')->User();

          $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          MdauLoanGuarantorPerson::where('mdau_id', $mdauLoan->id)->where('id', $guarator)->delete();

          return back();
        }





//step four for adding vehicle details


public function step_four_form($loan)
{

  $customer = Auth::guard('customer')->User();

  $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $loan)->first();


  $mdauLoan->is_submited = 1;
  $mdauLoan->save();





   $steps = Step::with('user')->where('category_id', $mdauLoan->category_id)->orderBy('magnitude', 'ASC')->get();

   if(count($steps)==0){
     Session::flash('message', "Special message goes here");
     return Redirect::to('kycmodule/loan/mdau/1/step-three?error=1');

   }

   foreach ($steps as $step) {

    $mdaureview =  new  MdauReview();
    $mdaureview->mdau_id = $mdauLoan->id;
    $mdaureview->user_id = $step->user->id;
    $mdaureview->step_id = $step->id;
    $mdaureview->is_reviewed = 0;
    $mdaureview->magnitude = $step->magnitude;
    $mdaureview->save();

   }


   $reviews = MdauReview::where('mdau_id', $mdauLoan->id)->get();

   foreach ($reviews as $review) {
      if(!$review->is_reviewed){
        $mdauLoan->current_step = $review->step_id;
        $mdauLoan->save();
        break;
      }
   }


 return Redirect::to('kycmodule/loan/mdau/'.$mdauLoan->id.'/terms');


}


      public function mdauLoanFour(Request $request){


        // return $request->all();

        $validator =  Validator::make($request->all(), [
            'vehicle_type' => ['required', 'string'],
            'vehicle_name' => ['required', 'string'],
            'vehicle_registration_number' => ['required','string'],
            'vehicle_chassis_number' => ['required','string'],
            'vehicle_color' => ['required', 'string'],
            'vehicle_model' => ['required', 'string'],
            'vehicle_insurance_type' => ['required', 'string'],
            'vehicle_insurance_provider' => ['required', 'string'],
        ]);



      $message = 'Formu imewasilishwa ikiwa na mapungufu.';


        if($validator->fails()){

                $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
        }



        $customer = Auth::guard('customer')->User();

        $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $request->mdau)->first();

        if(empty($mdauLoan->first_vehicle_photo)){
          $validator =  Validator::make($request->all(), [
              'first_vehicle_photo' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
              'second_vehicle_photo' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
              'third_vehicle_photo' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
              'fourth_vehicle_photo' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
          ]);

          if($validator->fails()){

                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
          }
        }

        $mdauLoan->vehicle_type = $request->vehicle_type;
        $mdauLoan->vehicle_name = $request->vehicle_name;
        $mdauLoan->vehicle_registration_number = $request->vehicle_registration_number;
        $mdauLoan->vehicle_chassis_number = $request->vehicle_chassis_number;
        $mdauLoan->vehicle_color = $request->vehicle_color;

        $mdauLoan->vehicle_model = $request->vehicle_model;
        $mdauLoan->vehicle_insurance_type = $request->vehicle_insurance_type;
        $mdauLoan->vehicle_insurance_provider = $request->vehicle_insurance_provider;


        if(!empty($request->first_vehicle_photo)){
             $image = $request->file('first_vehicle_photo');
             $path = 'modules/kycmodule/uploads/vehicles';
             $name = strtolower($request->vehicle_name).'first-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
             $image->move(public_path($path), $name);
             $mdauLoan->first_vehicle_photo = $path.'/'.$name;
          }

          if(!empty($request->second_vehicle_photo)){
               $image = $request->file('second_vehicle_photo');
               $path = 'modules/kycmodule/uploads/vehicles';
               $name = strtolower($request->vehicle_name).'second-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
               $image->move(public_path($path), $name);
               $mdauLoan->second_vehicle_photo = $path.'/'.$name;
            }


            if(!empty($request->third_vehicle_photo)){
                 $image = $request->file('third_vehicle_photo');
                 $path = 'modules/kycmodule/uploads/vehicles';
                 $name = strtolower($request->vehicle_name).'third-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
                 $image->move(public_path($path), $name);
                 $mdauLoan->third_vehicle_photo = $path.'/'.$name;
              }

              if(!empty($request->fourth_vehicle_photo)){
                   $image = $request->file('fourth_vehicle_photo');
                   $path = 'modules/kycmodule/uploads/vehicles';
                   $name = strtolower($request->vehicle_name).'fourth-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
                   $image->move(public_path($path), $name);
                   $mdauLoan->fourth_vehicle_photo = $path.'/'.$name;
                }


        $mdauLoan->is_submited = 1;
        $mdauLoan->save();





         $steps = Step::with('user')->where('category_id', $mdauLoan->category_id)->orderBy('magnitude', 'ASC')->get();

         foreach ($steps as $step) {



          $mdaureview =  new  MdauReview();
          $mdaureview->mdau_id = $request->mdau;
          $mdaureview->user_id = $step->user->id;
          $mdaureview->step_id = $step->id;
          $mdaureview->is_reviewed = 0;
          $mdaureview->magnitude = $step->magnitude;
          $mdaureview->save();

         }


         $reviews = MdauReview::where('mdau_id', $mdauLoan->id)->get();

         foreach ($reviews as $review) {
            if(!$review->is_reviewed){
              $mdauLoan->current_step = $review->step_id;
              $mdauLoan->save();
              break;
            }
         }




        $message = 'Umeongeza hatua kikamilifu';



       $html = View::make('kycmodule::messages.success', compact('message'))->render();
       return response()->json([ 'success'=>true,  'location'=>'/kycmodule/loan/mdau/'.$mdauLoan->id.'/terms', 'html'=>$html]);



    }


    public function terms($loan)
    {

      $customer = Auth::guard('customer')->User();

      $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        return view('kycmodule::forms.mdau.terms', compact('mdauLoan'));
    }



    public function finish($loan)
    {

      $customer = Auth::guard('customer')->User();

      $mdauLoan =  MdauLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        return view('kycmodule::forms.mdau.finish', compact('mdauLoan'));
    }






}
