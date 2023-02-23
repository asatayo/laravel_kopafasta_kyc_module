<?php

namespace Modules\KycModule\Http\Controllers\Admin;

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
use Modules\KycModule\Entities\Category;



class KycModuleAdminStepsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     public function steps()
     {
       $steps = Step::with('user')->orderBy('name', 'ASC')->get();
         return view('kycmodule::steps.steps', compact('steps'));
     }






    public function step_form()
    {
       $users = User::orderBy('name', 'ASC')->get();
       $categories = Category::orderBy('name', 'ASC')->get();
        return view('kycmodule::steps.add-step', compact('users', 'categories'));
    }


        public function addStep(Request $request)
        {

          $validation =  Validator::make($request->all(), [
              'name' => ['required', 'string','max:255'],
              'operator' => ['required', 'integer'],
              'category' => ['required', 'integer'],
          ]);

          if($validation->fails()){
                    $message = 'Fomu ina makosa!';
                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validation->errors()->toArray()]);
          }

          $stepsCount =   Step::where('category_id', $request->category)->count();

          $step = new Step();

          $step->name = $request->name;
          $step->user_id = $request->operator;
          $step->magnitude = $stepsCount + 1;
          $step->category_id = $request->category;
          $step->save();
          $message = 'Umeongeza hatua kikamilifu';

         $validation->getMessageBag()->add('password', $message);
         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'isredirecting'=>true, 'html'=>$html]);



        }


        public function delete($id)
        {


          $step = Step::findOrFail($id);


          $step->delete();

          return back();

        }

}
