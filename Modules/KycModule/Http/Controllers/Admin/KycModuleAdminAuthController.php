<?php

namespace Modules\KycModule\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use View;
use Auth;
use Carbon\Carbon;
use Session;
use App\Models\User;
use Redirect;

class KycModuleAdminAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function login()
    {

      // return Hash::make('password');
        return view('kycmodule::admin.admin-login');
    }


        public function adminLogin(Request $request){


          $validation =  Validator::make($request->all(), [
              'email' => ['required', 'string'],
              'password' => ['required', 'string'],
          ]);

          if($validation->fails()){
                  $message = 'Fomu ina makosa!';
                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validation->errors()->toArray()]);
          }





          $credentials = [
              'email' => $request['email'],
              'password' => $request['password'],
            ];



         if (Auth::guard('admin')->attempt($credentials)){

                 $message = 'Imefanikiwa, subiri kidogo..';

                 $validation->getMessageBag()->add('password', $message);
                 $html = View::make('kycmodule::messages.success', compact('message'))->render();
                 return response()->json([ 'success'=>true,  'location'=>'/kycmodule/admin/home', 'html'=>$html]);

       }else {

         $message = 'Taarifa sii sahihi';
         $validation->getMessageBag()->add('password', $message);
         $html = View::make('kycmodule::messages.danger', compact('message'))->render();
         return response()->json([ 'success'=>false,'errors'=> $validation->errors()->toArray(), 'html'=>$html]);
       }

    }


    public function logout()
    {


        Auth::logout();
        Session::flush();
        Auth::guard('admin')->logout();


        return Redirect::to('kycmodule/admin/login');
    }


}
