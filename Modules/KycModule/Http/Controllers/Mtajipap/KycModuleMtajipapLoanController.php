<?php

namespace Modules\KycModule\Http\Controllers\Mtajipap;

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
use Modules\KycModule\Entities\MtajipapLoanOtherDebts;
use Modules\KycModule\Entities\MtajipapLoan;
use Modules\KycModule\Entities\MtajipapLoanGuarantorPerson;
use Modules\KycModule\Entities\MtajipapReview;




class KycModuleMtajipapLoanController extends Controller
{

  public function step_one_form($loan)
  {

       $customer = Auth::guard('customer')->User();

      $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

      return view('kycmodule::forms.mtajipap.step_one_form', compact('mtajipapLoan'));
  }


        public function mtajipapLoanOne(Request $request){
              
          $request->merge(['amount'=> str_replace(',', '', $request->amount)]);


          $validator =  Validator::make($request->all(), [
              'mtajipap' => ['required', 'integer'],
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

          $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $request->mtajipap)->first();

          $mtajipapLoan->amount = $request->amount;
          $mtajipapLoan->amount_words = $request->amount_words;
          $mtajipapLoan->intension = $request->intension;
          $mtajipapLoan->work_business = $request->work_business;

          $mtajipapLoan->dependants_count = $request->dependants_count;
          $mtajipapLoan->income_perday = $request->income_perday;
          $mtajipapLoan->income_perweek = $request->income_perweek;
          $mtajipapLoan->income_permonth = $request->income_permonth;
          $mtajipapLoan->income_peryear = $request->income_peryear;
          $mtajipapLoan->other_properties = $request->other_properties;
          $mtajipapLoan->save();

          $message = 'Umeongeza hatua kikamilifu';



         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'location'=>'/kycmodule/loan/mtajipap/'.$mtajipapLoan->id.'/step-two', 'html'=>$html]);



      }




      public function step_two_form($loan)
      {

        $customer = Auth::guard('customer')->User();

        $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        $mtajipapOtherDebts = MtajipapLoanOtherDebts::where('mtajipap_id', $mtajipapLoan->id)->get();

          return view('kycmodule::forms.mtajipap.step_two_form', compact('mtajipapLoan', 'mtajipapOtherDebts'));
      }









        public function mtajipapLoanTwo(Request $request){

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

          $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $request->mtajipap)->first();


              $mtajipapOtherDebts = new MtajipapLoanOtherDebts();
              $mtajipapOtherDebts->mtajipap_id = $mtajipapLoan->id;
              $mtajipapOtherDebts->amount = $request->debt_amount;
              $mtajipapOtherDebts->debt_institution =  $request->debt_institution;
              $mtajipapOtherDebts->finish_date= $request->clear_date;
              $mtajipapOtherDebts->phone = $request->phone;
              if(!empty($request->registration_number)){
                $mtajipapOtherDebts->registration_number = $request->registration_number;
              }
              $mtajipapOtherDebts->region = $request->region;
              $mtajipapOtherDebts->district =  $request->district;
              $mtajipapOtherDebts->ward =  $request->ward;
              $mtajipapOtherDebts->save();

              $message = 'Umeongeza hatua kikamilifu';

         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

        }


        public function delete_debt($loan, $debt)
        {

          $customer = Auth::guard('customer')->User();

          $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          MtajipapLoanOtherDebts::where('mtajipap_id', $mtajipapLoan->id)->where('id', $debt)->delete();

          return back();
        }





        public function step_three_form($loan)
        {

          $customer = Auth::guard('customer')->User();

          $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          $guarators = MtajipapLoanGuarantorPerson::where('mtajipap_id', $mtajipapLoan->id)->get();

            return view('kycmodule::forms.mtajipap.step_three_form', compact('mtajipapLoan', 'guarators'));
        }



        public function mtajipapLoanThree(Request $request){

          $validator =  Validator::make($request->all(), [
              'first_name' => ['required', 'string'],
              'middle_name' => ['required', 'string'],
              'last_name' => ['required','string'],
              "identity_type"    => ['required','string'],
              'identity'=>['required','string'],
              'identity_copy' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
              'mtajipap' => ['required', 'string'],
              'phone' => ['required', 'string'],
              'relationship' => ['required', 'string'],
          ]);

           $message = 'Formu imewasilishwa ikiwa na mapungufu.';


          if($validator->fails()){

                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
          }



             $customer = Auth::guard('customer')->User();


             $mtajipapLoan =  MtajipapLoan::where('id', $request->mtajipap)->where('customer_id', $customer->id)->first();


              // return $mtajipapLoan;

              $mtajipapLoanGuarantorPerson = new MtajipapLoanGuarantorPerson();
              $mtajipapLoanGuarantorPerson->mtajipap_id = $mtajipapLoan->id;
              $mtajipapLoanGuarantorPerson->first_name = $request->first_name;
              $mtajipapLoanGuarantorPerson->middle_name =  $request->middle_name;
              $mtajipapLoanGuarantorPerson->last_name= $request->last_name;
              $mtajipapLoanGuarantorPerson->phone = $request->phone;
              $mtajipapLoanGuarantorPerson->identity_type = $request->identity_type;
              $mtajipapLoanGuarantorPerson->identity = $request->identity;
              $mtajipapLoanGuarantorPerson->relationship =  $request->relationship;

              if(!empty($request->identity_copy)){
               $image = $request->file('identity_copy');
               $path = 'modules/kycmodule/uploads/identities';
               $name = strtolower($request->last_name).'-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
               $image->move(public_path($path), $name);
               $mtajipapLoanGuarantorPerson->identity_path =   $path.'/'.$name;
                }

              $mtajipapLoanGuarantorPerson->save();

              $message = 'Umeongeza hatua kikamilifu';

         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

        }


        public function delete_guarantor($loan, $guarator)
        {

          $customer = Auth::guard('customer')->User();

          $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

          MtajipapLoanGuarantorPerson::where('mtajipap_id', $mtajipapLoan->id)->where('id', $guarator)->delete();

          return back();
        }





//step four for adding vehicle details


public function step_four_form($loan)
{

  $customer = Auth::guard('customer')->User();

  $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

    return view('kycmodule::forms.mtajipap.step_four_form', compact('mtajipapLoan'));
}


      public function mtajipapLoanFour(Request $request){


        // return $request->all();

        $validator =  Validator::make($request->all(), [
            'market_manager_name' => ['required', 'string'],
            'title' => ['required', 'string'],
            'market_manager_phone' => ['required','string'],
            'market_name' => ['required','string'],
            'region' => ['required', 'string'],
            'district' => ['required', 'string'],
            'ward' => ['required', 'string'],
            'market_leadership_letter' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);



      $message = 'Formu imewasilishwa ikiwa na mapungufu.';


        if($validator->fails()){

                $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
        }



        $customer = Auth::guard('customer')->User();

        $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $request->mtajipap)->first();

        if(empty($mtajipapLoan->market_leadership_letter)){
          $validator =  Validator::make($request->all(), [
              'market_leadership_letter' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],

          ]);

          if($validator->fails()){

                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
          }
        }

        $mtajipapLoan->market_name = $request->market_name;
        $mtajipapLoan->market_manager_name = $request->market_manager_name;
        $mtajipapLoan->market_manager_phone = $request->market_manager_phone;
        $mtajipapLoan->market_region = $request->region;
        $mtajipapLoan->market_district = $request->district;
        $mtajipapLoan->title = $request->title;


        $mtajipapLoan->market_ward = $request->ward;


        if(!empty($request->market_leadership_letter)){
             $image = $request->file('market_leadership_letter');
             $path = 'modules/kycmodule/uploads/letter';
             $name = 'letter-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
             $image->move(public_path($path), $name);
             $mtajipapLoan->market_leadership_letter = $path.'/'.$name;
          }

          $steps = Step::with('user')->where('category_id', $mtajipapLoan->category_id)->get();

          if(count($steps)==0){

            $message = 'Mkopo haukupokelewa hatua bado hazijaandaliwa.';

           $html = View::make('kycmodule::messages.danger', compact('message'))->render();
           return response()->json([ 'success'=>false,  'html'=>$html]);

          }


        $mtajipapLoan->is_submited = 1;
        $mtajipapLoan->save();


         foreach ($steps as $step) {

          $mtajipapreview =  new  MtajipapReview();
          $mtajipapreview->mtajipap_id = $request->mtajipap;
          $mtajipapreview->user_id = $step->user->id;
          $mtajipapreview->step_id = $step->id;
          $mtajipapreview->is_reviewed = 0;
          $mtajipapreview->magnitude = $step->magnitude;
          $mtajipapreview->save();

         }



        $message = 'Umeongeza hatua kikamilifu';


       $html = View::make('kycmodule::messages.success', compact('message'))->render();
       return response()->json([ 'success'=>true,  'location'=>'/kycmodule/loan/mtajipap/'.$mtajipapLoan->id.'/terms', 'html'=>$html]);



    }


    public function terms($loan)
    {

      $customer = Auth::guard('customer')->User();

      $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        return view('kycmodule::forms.mtajipap.terms', compact('mtajipapLoan'));
    }



    public function finish($loan)
    {

      $customer = Auth::guard('customer')->User();

      $mtajipapLoan =  MtajipapLoan::where('customer_id', $customer->id)->where('id', $loan)->first();

        return view('kycmodule::forms.mtajipap.finish', compact('mtajipapLoan'));
    }






}
