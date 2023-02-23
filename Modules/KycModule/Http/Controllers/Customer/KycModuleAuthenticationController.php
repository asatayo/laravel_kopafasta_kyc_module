<?php

namespace Modules\KycModule\Http\Controllers\Customer;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\KycModule\Http\Controllers\Customer\KycModuleConstantsController;

use View;
use Auth;
use Carbon\Carbon;
use Session;

use Modules\KycModule\Entities\Customer;

class KycModuleAuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function phone_form()
    {
        return view('kycmodule::phone');
    }


        public function addPhone(Request $request){

          $request->merge(['phone' => KycModuleConstantsController::formatPhone($request->phone)]);


          $validation =  Validator::make($request->all(), [
              'phone' => ['required', 'integer'],
          ]);

          if($validation->fails()){
                  $message = 'Fomu ina makosa!';
                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validation->errors()->toArray()]);
          }



         if (!Customer::where('phone', $request->phone)->exists()){

           Customer::create([
                     'phone' => $request->phone,
                     'otp' => 123456,
                    //  'otp' => KycModuleConstantsController::getOtp(),
                     'last_seen_at' => Carbon::now()->toDateTimeString(),
                     'last_login_ip' => $request->getClientIp(),
                     'login_attempt' => 0,
                     'block_attempt' => 0,
                     'last_try_at' => Carbon::now()->toDateTimeString(),
                 ]);

                 $message = 'Imefanikiwa, subiri kidogo..';
                 Session::put('phone', $request->phone);
                 $validation->getMessageBag()->add('password', $message);
                 $html = View::make('kycmodule::messages.success', compact('message'))->render();
                 return response()->json([ 'success'=>true,  'location'=>'/kycmodule/verify', 'html'=>$html]);

       }else {
         $customer =  Customer::where('phone', $request->phone)->first();
          $customer->update([
                   'otp' => 123456,
                //   'otp' => KycModuleConstantsController::getOtp(),
                   'last_login_ip' => $request->getClientIp(),
               ]);

         $message = 'Imefanikiwa, subiri kidogo..';
         Session::put('phone', $request->phone);
         $validation->getMessageBag()->add('password', $message);
         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'location'=>'/kycmodule/verify', 'html'=>$html]);

         $message = 'Namba imekwishatumika';
         $validation->getMessageBag()->add('phone', $message);
         $html = View::make('kycmodule::messages.danger', compact('message'))->render();
         return response()->json([ 'success'=>false,'errors'=> $validation->errors()->toArray(), 'html'=>$html]);
       }

    }


    public function verify()
    {
        return view('kycmodule::otp');
    }


    public function verifyOtp(Request $request){

      $phone = Session::get('phone');

      $request->request->add(['phone' => $phone]);







      $validation =  Validator::make($request->all(), [
          'phone' => ['required', 'integer'],
          'otp' => ['required', 'integer'],
      ]);

      if($validation->fails()){
                $message = 'Fomu ina makosa!';
              $html = View::make('kycmodule::messages.danger', compact('message'))->render();
              return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validation->errors()->toArray()]);
      }


      $customer = Customer::where('phone', $request->phone)->where('otp', $request->otp)->first();


       if (!empty($customer)){


           Auth::guard('customer')->loginUsingId($customer->id);

            $customer = Auth::guard('customer')->User();
            $customer->update([
                      'last_seen_at' => Carbon::now()->toDateTimeString(),
                      'last_login_ip' => $request->getClientIp(),
                      'login_attempt' => 0,
                      'block_attempt' => 0,
                      'last_try_at' => Carbon::now()->toDateTimeString(),
                  ]);


                   if($customer->is_submited){
                    $location = '/kycmodule/home';
                   }else{
                    
                    $location = '/kycmodule/profile';
                   }


              $message = 'Imefanikiwa, subiri kidogo..';
             // Session::put('phone', $request->phone);
             $validation->getMessageBag()->add('password', $message);
             $html = View::make('kycmodule::messages.success', compact('message'))->render();
             return response()->json([ 'success'=>true,  'location'=>$location, 'html'=>$html]);

   }else {


     $message = 'OTP sii sahihi.';
     $validation->getMessageBag()->add('phone', $message);
     $html = View::make('kycmodule::messages.danger', compact('message'))->render();
     return response()->json([ 'success'=>false,'errors'=> $validation->errors()->toArray(), 'html'=>$html]);
   }

}

}
