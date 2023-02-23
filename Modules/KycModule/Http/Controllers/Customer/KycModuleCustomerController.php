<?php

namespace Modules\KycModule\Http\Controllers\Customer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

use View;
use Auth;
use Carbon\Carbon;
use Session;
use Redirect;
class KycModuleCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function customer_form()
    {

      $customer = Auth::guard('customer')->User();
       if($customer->is_submited){
         return Redirect::to('kycmodule/loans');
       }
        return view('kycmodule::customer');
    }



    public function addCustomer(Request $request)
    {

      $validation =  Validator::make($request->all(), [
          'first_name' => ['required', 'string','max:255'],
          'middle_name' => ['required', 'string','max:255'],
          'surname' => ['required', 'string','max:255'],
          'identity_type' => ['required', 'string','max:255'],
          'identity' => ['required', 'string','max:255'],
          'identity_copy' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
          'day' => ['required', 'integer','max:31'],
          'month' => ['required', 'integer','max:12'],
          'year' => ['required', 'integer'],
      ]);

      if($validation->fails()){
                $message = 'Fomu ina makosa!';
              $html = View::make('kycmodule::messages.danger', compact('message'))->render();
              return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validation->errors()->toArray()]);
      }

       $year = $request->year;
       $month = $request->month;
       $day = $request->day;

       $dob =  Carbon::parse($year.'-'.$month.'-'.$day);

      $customer = Auth::guard('customer')->User();

      $customer->first_name = $request->first_name;
      $customer->middle_name = $request->middle_name;
      $customer->surname = $request->surname;
      $customer->dob = $dob;
      $customer->identity_type = $request->identity_type;
      $customer->identity = $request->identity;
      $customer->is_submited = 1;

      // if($request->hasFile('')){
      //       $image_path = $request->file('identity_copy')->store('identity', 'public/');
      //       $customer->identity_path = $image_path;
      // }


      if(!empty($request->identity_copy)){


       $image = $request->file('identity_copy');
       $path = 'modules/kycmodule/uploads/identities';
       $name = strtolower($request->surname).'-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
       $image->move(public_path($path), $name);
       $customer->identity_path =   $path.'/'.$name;
}

      $customer->save();
      $message = 'Imefanikiwa, subiri kidogo..';

     // Session::put('phone', $request->phone);
     $validation->getMessageBag()->add('password', $message);
     $html = View::make('kycmodule::messages.success', compact('message'))->render();
     return response()->json([ 'success'=>true,  'location'=>'/kycmodule/loans', 'html'=>$html]);



    }


}
