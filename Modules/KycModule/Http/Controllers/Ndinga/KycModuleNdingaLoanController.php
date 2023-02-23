<?php

namespace Modules\KycModule\Http\Controllers\Ndinga;

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
use Modules\KycModule\Entities\NdingaLoanOtherDebts;
use Modules\KycModule\Entities\NdingaLoan;
use Modules\KycModule\Entities\NdingaLoanGuarantorPerson;
use Modules\KycModule\Entities\NdingaReview;




class KycModuleNdingaLoanController extends Controller
{

  public function step_one_form($loan)
  {

       $customer = Auth::guard('customer')->User();

      $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

      return view('kycmodule::forms.ndinga.step_one_form', compact('ndingaLoan'));
  }


        public function ndingaLoanOne(Request $request){
            
       
         $request->merge(['amount'=> str_replace(',', '', $request->amount)]);
         

          $validator =  Validator::make($request->all(), [
              'ndinga' => ['required', 'integer'],
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

          $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $request->ndinga)->first();

          $ndingaLoan->amount = $request->amount;
          $ndingaLoan->amount_words = $request->amount_words;
          $ndingaLoan->intension = $request->intension;
          $ndingaLoan->work_business = $request->work_business;

          $ndingaLoan->dependants_count = $request->dependants_count;
          $ndingaLoan->income_perday = $request->income_perday;
          $ndingaLoan->income_perweek = $request->income_perweek;
          $ndingaLoan->income_permonth = $request->income_permonth;
          $ndingaLoan->income_peryear = $request->income_peryear;
          $ndingaLoan->other_properties = $request->other_properties;
          $ndingaLoan->save();

          $message = 'Umeongeza hatua kikamilifu';



         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'location'=>'/kycmodule/loan/ndinga/'.$ndingaLoan->id.'/step-two', 'html'=>$html]);



      }




      public function step_two_form($loan)
      {

        $customer = Auth::guard('customer')->User();

        $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        $ndingaOtherDebts = NdingaLoanOtherDebts::where('ndinga_id', $ndingaLoan->id)->get();

          return view('kycmodule::forms.ndinga.step_two_form', compact('ndingaLoan', 'ndingaOtherDebts'));
      }









        public function ndingaLoanTwo(Request $request){
            
           
           $request->merge(['debt_amount'=> str_replace(',', '', $request->debt_amount)]);


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

          $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $request->ndinga)->first();


              $ndingaOtherDebts = new NdingaLoanOtherDebts();
              $ndingaOtherDebts->ndinga_id = $ndingaLoan->id;
              $ndingaOtherDebts->amount = $request->debt_amount;
              $ndingaOtherDebts->debt_institution =  $request->debt_institution;
              $ndingaOtherDebts->finish_date= $request->clear_date;
              $ndingaOtherDebts->phone = $request->phone;
              if(!empty($request->registration_number)){
                $ndingaOtherDebts->registration_number = $request->registration_number;
              }
              $ndingaOtherDebts->region = $request->region;
              $ndingaOtherDebts->district =  $request->district;
              $ndingaOtherDebts->ward =  $request->ward;
              $ndingaOtherDebts->save();

              $message = 'Umeongeza hatua kikamilifu';

         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

        }


        public function delete_debt($loan, $debt)
        {

          $customer = Auth::guard('customer')->User();

          $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          NdingaLoanOtherDebts::where('ndinga_id', $ndingaLoan->id)->where('id', $debt)->delete();

          return back();
        }





        public function step_three_form($loan)
        {

          $customer = Auth::guard('customer')->User();

          $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          $guarators = NdingaLoanGuarantorPerson::where('ndinga_id', $ndingaLoan->id)->get();

            return view('kycmodule::forms.ndinga.step_three_form', compact('ndingaLoan', 'guarators'));
        }



        public function ndingaLoanThree(Request $request){

          $validator =  Validator::make($request->all(), [
              'first_name' => ['required', 'string'],
              'middle_name' => ['required', 'string'],
              'last_name' => ['required','string'],
              "identity_type"    => ['required','string'],
              'identity'=>['required','string'],
              'identity_copy' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
              'ndinga' => ['required', 'string'],
              'phone' => ['required', 'string'],
              'relationship' => ['required', 'string'],
          ]);

           $message = 'Formu imewasilishwa ikiwa na mapungufu.';


          if($validator->fails()){

                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
          }



             $customer = Auth::guard('customer')->User();


             $ndingaLoan =  NdingaLoan::where('id', $request->ndinga)->where('customer_id', $customer->id)->first();


              // return $ndingaLoan;

              $ndingaLoanGuarantorPerson = new NdingaLoanGuarantorPerson();
              $ndingaLoanGuarantorPerson->ndinga_id = $ndingaLoan->id;
              $ndingaLoanGuarantorPerson->first_name = $request->first_name;
              $ndingaLoanGuarantorPerson->middle_name =  $request->middle_name;
              $ndingaLoanGuarantorPerson->last_name= $request->last_name;
              $ndingaLoanGuarantorPerson->phone = $request->phone;
              $ndingaLoanGuarantorPerson->identity_type = $request->identity_type;
              $ndingaLoanGuarantorPerson->identity = $request->identity;
              $ndingaLoanGuarantorPerson->relationship =  $request->relationship;

              if(!empty($request->identity_copy)){
               $image = $request->file('identity_copy');
               $path = 'modules/kycmodule/uploads/identities';
               $name = strtolower($request->last_name).'-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
               $image->move(public_path($path), $name);
               $ndingaLoanGuarantorPerson->identity_path =   $path.'/'.$name;
                }

              $ndingaLoanGuarantorPerson->save();

              $message = 'Umeongeza hatua kikamilifu';

         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

        }


        public function delete_guarantor($loan, $guarator)
        {

          $customer = Auth::guard('customer')->User();

          $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          NdingaLoanGuarantorPerson::where('ndinga_id', $ndingaLoan->id)->where('id', $guarator)->delete();

          return back();
        }





//step four for adding vehicle details


public function step_four_form($loan)
{

  $customer = Auth::guard('customer')->User();

  $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

    return view('kycmodule::forms.ndinga.step_four_form', compact('ndingaLoan'));
}


      public function ndingaLoanFour(Request $request){


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

        $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $request->ndinga)->first();

        if(empty($ndingaLoan->first_vehicle_photo)){
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

        $ndingaLoan->vehicle_type = $request->vehicle_type;
        $ndingaLoan->vehicle_name = $request->vehicle_name;
        $ndingaLoan->vehicle_registration_number = $request->vehicle_registration_number;
        $ndingaLoan->vehicle_chassis_number = $request->vehicle_chassis_number;
        $ndingaLoan->vehicle_color = $request->vehicle_color;

        $ndingaLoan->vehicle_model = $request->vehicle_model;
        $ndingaLoan->vehicle_insurance_type = $request->vehicle_insurance_type;
        $ndingaLoan->vehicle_insurance_provider = $request->vehicle_insurance_provider;


        if(!empty($request->first_vehicle_photo)){
             $image = $request->file('first_vehicle_photo');
             $path = 'modules/kycmodule/uploads/vehicles';
             $name = strtolower($request->vehicle_name).'first-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
             $image->move(public_path($path), $name);
             $ndingaLoan->first_vehicle_photo = $path.'/'.$name;
          }

          if(!empty($request->second_vehicle_photo)){
               $image = $request->file('second_vehicle_photo');
               $path = 'modules/kycmodule/uploads/vehicles';
               $name = strtolower($request->vehicle_name).'second-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
               $image->move(public_path($path), $name);
               $ndingaLoan->second_vehicle_photo = $path.'/'.$name;
            }


            if(!empty($request->third_vehicle_photo)){
                 $image = $request->file('third_vehicle_photo');
                 $path = 'modules/kycmodule/uploads/vehicles';
                 $name = strtolower($request->vehicle_name).'third-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
                 $image->move(public_path($path), $name);
                 $ndingaLoan->third_vehicle_photo = $path.'/'.$name;
              }

              if(!empty($request->fourth_vehicle_photo)){
                   $image = $request->file('fourth_vehicle_photo');
                   $path = 'modules/kycmodule/uploads/vehicles';
                   $name = strtolower($request->vehicle_name).'fourth-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
                   $image->move(public_path($path), $name);
                   $ndingaLoan->fourth_vehicle_photo = $path.'/'.$name;
                }


        $ndingaLoan->is_submited = 1;
        $ndingaLoan->save();





         $steps = Step::with('user')->where('category_id', $ndingaLoan->category_id)->orderBy('magnitude', 'ASC')->get();

         foreach ($steps as $step) {



          $ndingareview =  new  NdingaReview();
          $ndingareview->ndinga_id = $request->ndinga;
          $ndingareview->user_id = $step->user->id;
          $ndingareview->step_id = $step->id;
          $ndingareview->is_reviewed = 0;
          $ndingareview->magnitude = $step->magnitude;
          $ndingareview->save();

         }


         $reviews = NdingaReview::where('ndinga_id', $ndingaLoan->id)->get();

         foreach ($reviews as $review) {
            if(!$review->is_reviewed){
              $ndingaLoan->current_step = $review->step_id;
              $ndingaLoan->save();
              break;
            }
         }




        $message = 'Umeongeza hatua kikamilifu';



       $html = View::make('kycmodule::messages.success', compact('message'))->render();
       return response()->json([ 'success'=>true,  'location'=>'/kycmodule/loan/ndinga/'.$ndingaLoan->id.'/terms', 'html'=>$html]);



    }


    public function terms($loan)
    {

      $customer = Auth::guard('customer')->User();

      $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        return view('kycmodule::forms.ndinga.terms', compact('ndingaLoan'));
    }



    public function finish($loan)
    {

      $customer = Auth::guard('customer')->User();

      $ndingaLoan =  NdingaLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        return view('kycmodule::forms.ndinga.finish', compact('ndingaLoan'));
    }






}
