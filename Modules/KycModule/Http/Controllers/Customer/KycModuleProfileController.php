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

class KycModuleProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function form()
    {
      $customer = Auth::guard('customer')->User();
       if(!empty($customer->profile_path)){
         return Redirect::to('kycmodule/personal-details');
       }
        return view('kycmodule::profile');
    }



    public function uploadProfile(Request $request)
    {


      $validation =  Validator::make($request->all(), [

          'camera' => ['mimes:jpeg,png,jpg,gif,svg','max:2048'],
          'photo' =>  ['mimes:jpeg,png,jpg,gif,svg','max:2048'],

      ]);
      //
      if($validation->fails()){
              $message = 'Fomu ina makosa!';
              $html = View::make('kycmodule::messages.danger', compact('message'))->render();
              return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validation->errors()->toArray()]);
      }

      // return $request->all();



      if(!$request->hasFile('photo') && !$request->hasFile('camera')){

              $message = 'Tafadhali changua wala picha moja!';
              $html = View::make('kycmodule::messages.danger', compact('message'))->render();
              return response()->json([ 'success'=>false, 'html'=>$html]);
      }



      $customer = Auth::guard('customer')->User();


      if($request->hasFile('photo')){


           $image = $request->file('photo');
           $path = 'modules/kycmodule/uploads/profile';
           $name = strtolower($request->surname).'-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
           $image->move(public_path($path), $name);
           $customer->profile_path =   $path.'/'.$name;
}


    if($request->hasFile('camera')){

         $image = $request->file('camera');
         $path = 'modules/kycmodule/uploads/profile';
         $name = strtolower($request->surname).'-'.Carbon::now()->format('y-m-d-h-i-s').'.'.$image->extension();
         $image->move(public_path($path), $name);
         $customer->profile_path =   $path.'/'.$name;
    }

      $customer->save();
      $message = 'Inapakia, subiri kidogo..';
      $html = View::make('kycmodule::messages.success', compact('message'))->render();
     return response()->json([ 'success'=>true,  'location'=>'/kycmodule/personal-details', 'html'=>$html]);



    }


}
