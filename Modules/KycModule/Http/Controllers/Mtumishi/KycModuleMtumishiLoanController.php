<?php

namespace Modules\KycModule\Http\Controllers\Mtumishi;

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
use Modules\KycModule\Entities\MtumishiLoanOtherDebts;
use Modules\KycModule\Entities\MtumishiLoan;
use Modules\KycModule\Entities\MtumishiLoanGuarantorPerson;
use Modules\KycModule\Entities\MtumishiReview;
use Redirect;




class KycModuleMtumishiLoanController extends Controller
{

  public function step_one_form($loan)
  {

       $customer = Auth::guard('customer')->User();

      $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

      return view('kycmodule::forms.mtumishi.step_one_form', compact('mtumishiLoan'));
  }


        public function mtumishiLoanOne(Request $request){

          $validator =  Validator::make($request->all(), [
              'mtumishi' => ['required', 'integer'],
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

          $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $request->mtumishi)->first();

          $mtumishiLoan->amount = $request->amount;
          $mtumishiLoan->amount_words = $request->amount_words;
          $mtumishiLoan->intension = $request->intension;
          $mtumishiLoan->work_business = $request->work_business;

          $mtumishiLoan->dependants_count = $request->dependants_count;
          $mtumishiLoan->income_perday = $request->income_perday;
          $mtumishiLoan->income_perweek = $request->income_perweek;
          $mtumishiLoan->income_permonth = $request->income_permonth;
          $mtumishiLoan->income_peryear = $request->income_peryear;
          $mtumishiLoan->other_properties = $request->other_properties;
          $mtumishiLoan->save();

          $message = 'Umeongeza hatua kikamilifu';



         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'location'=>'/kycmodule/loan/mtumishi/'.$mtumishiLoan->id.'/step-two', 'html'=>$html]);



      }




      public function step_two_form($loan)
      {

        $customer = Auth::guard('customer')->User();

        $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        $mtumishiOtherDebts = MtumishiLoanOtherDebts::where('mtumishi_id', $mtumishiLoan->id)->get();

          return view('kycmodule::forms.mtumishi.step_two_form', compact('mtumishiLoan', 'mtumishiOtherDebts'));
      }









        public function mtumishiLoanTwo(Request $request){

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

          $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $request->mtumishi)->first();


              $mtumishiOtherDebts = new MtumishiLoanOtherDebts();
              $mtumishiOtherDebts->mtumishi_id = $mtumishiLoan->id;
              $mtumishiOtherDebts->amount = $request->debt_amount;
              $mtumishiOtherDebts->debt_institution =  $request->debt_institution;
              $mtumishiOtherDebts->finish_date= $request->clear_date;
              $mtumishiOtherDebts->phone = $request->phone;
              if(!empty($request->registration_number)){
                $mtumishiOtherDebts->registration_number = $request->registration_number;
              }
              $mtumishiOtherDebts->region = $request->region;
              $mtumishiOtherDebts->district =  $request->district;
              $mtumishiOtherDebts->ward =  $request->ward;
              $mtumishiOtherDebts->save();

              $message = 'Umeongeza hatua kikamilifu';

         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

        }


        public function delete_debt($loan, $debt)
        {

          $customer = Auth::guard('customer')->User();

          $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          MtumishiLoanOtherDebts::where('mtumishi_id', $mtumishiLoan->id)->where('id', $debt)->delete();

          return back();
        }





        public function step_three_form($loan)
        {

          $customer = Auth::guard('customer')->User();

          $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          $guarators = MtumishiLoanGuarantorPerson::where('mtumishi_id', $mtumishiLoan->id)->get();

            return view('kycmodule::forms.mtumishi.step_three_form', compact('mtumishiLoan', 'guarators'));
        }



        public function mtumishiLoanThree(Request $request){

          $validator =  Validator::make($request->all(), [
              'first_name' => ['required', 'string'],
              'middle_name' => ['required', 'string'],
              'last_name' => ['required','string'],
              "identity_type"    => ['required','string'],
              'identity'=>['required','string'],
              'identity_copy' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
              'mtumishi' => ['required', 'string'],
              'phone' => ['required', 'string'],
              'relationship' => ['required', 'string'],
          ]);

           $message = 'Formu imewasilishwa ikiwa na mapungufu.';


          if($validator->fails()){

                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
          }



             $customer = Auth::guard('customer')->User();


             $mtumishiLoan =  MtumishiLoan::where('id', $request->mtumishi)->where('customer_id', $customer->id)->first();


              // return $mtumishiLoan;

              $mtumishiLoanGuarantorPerson = new MtumishiLoanGuarantorPerson();
              $mtumishiLoanGuarantorPerson->mtumishi_id = $mtumishiLoan->id;
              $mtumishiLoanGuarantorPerson->first_name = $request->first_name;
              $mtumishiLoanGuarantorPerson->middle_name =  $request->middle_name;
              $mtumishiLoanGuarantorPerson->last_name= $request->last_name;
              $mtumishiLoanGuarantorPerson->phone = $request->phone;
              $mtumishiLoanGuarantorPerson->identity_type = $request->identity_type;
              $mtumishiLoanGuarantorPerson->identity = $request->identity;
              $mtumishiLoanGuarantorPerson->relationship =  $request->relationship;

              if(!empty($request->identity_copy)){
               $image = $request->file('identity_copy');
               $path = 'modules/kycmodule/uploads/identities';
               $name = strtolower($request->last_name).'-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
               $image->move(public_path($path), $name);
               $mtumishiLoanGuarantorPerson->identity_path =   $path.'/'.$name;
                }

              $mtumishiLoanGuarantorPerson->save();

              $message = 'Umeongeza hatua kikamilifu';

         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

        }


        public function delete_guarantor($loan, $guarator)
        {

          $customer = Auth::guard('customer')->User();

          $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          MtumishiLoanGuarantorPerson::where('mtumishi_id', $mtumishiLoan->id)->where('id', $guarator)->delete();

          return back();
        }





//step four for adding vehicle details


public function step_four_form($loan)
{

  $customer = Auth::guard('customer')->User();

  $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $loan)->first();


  $mtumishiLoan->is_submited = 1;
  $mtumishiLoan->save();





   $steps = Step::with('user')->where('category_id', $mtumishiLoan->category_id)->orderBy('magnitude', 'ASC')->get();

   if(count($steps)==0){
     Session::flash('message', "Special message goes here");
     return Redirect::to('kycmodule/loan/mtumishi/1/step-three?error=1');

   }

   foreach ($steps as $step) {

    $mtumishireview =  new  MtumishiReview();
    $mtumishireview->mtumishi_id = $mtumishiLoan->id;
    $mtumishireview->user_id = $step->user->id;
    $mtumishireview->step_id = $step->id;
    $mtumishireview->is_reviewed = 0;
    $mtumishireview->magnitude = $step->magnitude;
    $mtumishireview->save();

   }


   $reviews = MtumishiReview::where('mtumishi_id', $mtumishiLoan->id)->get();

   foreach ($reviews as $review) {
      if(!$review->is_reviewed){
        $mtumishiLoan->current_step = $review->step_id;
        $mtumishiLoan->save();
        break;
      }
   }


 return Redirect::to('kycmodule/loan/mtumishi/'.$mtumishiLoan->id.'/terms');


}


      public function mtumishiLoanFour(Request $request){


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

        $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $request->mtumishi)->first();

        if(empty($mtumishiLoan->first_vehicle_photo)){
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

        $mtumishiLoan->vehicle_type = $request->vehicle_type;
        $mtumishiLoan->vehicle_name = $request->vehicle_name;
        $mtumishiLoan->vehicle_registration_number = $request->vehicle_registration_number;
        $mtumishiLoan->vehicle_chassis_number = $request->vehicle_chassis_number;
        $mtumishiLoan->vehicle_color = $request->vehicle_color;

        $mtumishiLoan->vehicle_model = $request->vehicle_model;
        $mtumishiLoan->vehicle_insurance_type = $request->vehicle_insurance_type;
        $mtumishiLoan->vehicle_insurance_provider = $request->vehicle_insurance_provider;


        if(!empty($request->first_vehicle_photo)){
             $image = $request->file('first_vehicle_photo');
             $path = 'modules/kycmodule/uploads/vehicles';
             $name = strtolower($request->vehicle_name).'first-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
             $image->move(public_path($path), $name);
             $mtumishiLoan->first_vehicle_photo = $path.'/'.$name;
          }

          if(!empty($request->second_vehicle_photo)){
               $image = $request->file('second_vehicle_photo');
               $path = 'modules/kycmodule/uploads/vehicles';
               $name = strtolower($request->vehicle_name).'second-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
               $image->move(public_path($path), $name);
               $mtumishiLoan->second_vehicle_photo = $path.'/'.$name;
            }


            if(!empty($request->third_vehicle_photo)){
                 $image = $request->file('third_vehicle_photo');
                 $path = 'modules/kycmodule/uploads/vehicles';
                 $name = strtolower($request->vehicle_name).'third-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
                 $image->move(public_path($path), $name);
                 $mtumishiLoan->third_vehicle_photo = $path.'/'.$name;
              }

              if(!empty($request->fourth_vehicle_photo)){
                   $image = $request->file('fourth_vehicle_photo');
                   $path = 'modules/kycmodule/uploads/vehicles';
                   $name = strtolower($request->vehicle_name).'fourth-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
                   $image->move(public_path($path), $name);
                   $mtumishiLoan->fourth_vehicle_photo = $path.'/'.$name;
                }


        $mtumishiLoan->is_submited = 1;
        $mtumishiLoan->save();





         $steps = Step::with('user')->where('category_id', $mtumishiLoan->category_id)->orderBy('magnitude', 'ASC')->get();

         foreach ($steps as $step) {



          $mtumishireview =  new  MtumishiReview();
          $mtumishireview->mtumishi_id = $request->mtumishi;
          $mtumishireview->user_id = $step->user->id;
          $mtumishireview->step_id = $step->id;
          $mtumishireview->is_reviewed = 0;
          $mtumishireview->magnitude = $step->magnitude;
          $mtumishireview->save();

         }


         $reviews = MtumishiReview::where('mtumishi_id', $mtumishiLoan->id)->get();

         foreach ($reviews as $review) {
            if(!$review->is_reviewed){
              $mtumishiLoan->current_step = $review->step_id;
              $mtumishiLoan->save();
              break;
            }
         }




        $message = 'Umeongeza hatua kikamilifu';



       $html = View::make('kycmodule::messages.success', compact('message'))->render();
       return response()->json([ 'success'=>true,  'location'=>'/kycmodule/loan/mtumishi/'.$mtumishiLoan->id.'/terms', 'html'=>$html]);



    }


    public function terms($loan)
    {

      $customer = Auth::guard('customer')->User();

      $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        return view('kycmodule::forms.mtumishi.terms', compact('mtumishiLoan'));
    }



    public function finish($loan)
    {

      $customer = Auth::guard('customer')->User();

      $mtumishiLoan =  MtumishiLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        return view('kycmodule::forms.mtumishi.finish', compact('mtumishiLoan'));
    }






}
