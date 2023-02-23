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
use Modules\KycModule\Entities\Loan;
use Modules\KycModule\Entities\Category;
use Modules\KycModule\Entities\StepCategory;



class KycModuleAdminLoanCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     public function categories()
     {

         $categories = Category::orderBy('name', 'ASC')->get();


         return view('kycmodule::category.categories', compact('categories'));
     }




    public function category_form()
    {
       $steps = Step::orderBy('name', 'ASC')->get();
        return view('kycmodule::category.create-loan-category', compact('steps'));
    }


        public function addCategory(Request $request)
        {




          $validation =  Validator::make($request->all(), [
              'name' => ['required', 'string','max:255'],
              'maximum' => ['required', 'integer'],
              'minimum' => ['required', 'integer'],
              'steps' => ['required'],
              'description' => ['required', 'string','max:2000'],
          ]);

          if($validation->fails()){
                    $message = 'Fomu ina makosa!';
                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validation->errors()->toArray()]);
          }



          $category = new Category();

          $category->name = $request->name;
          $category->maximum = $request->maximum;
          $category->minimum = $request->minimum;
          $category->description = $request->description;
          $category->save();
          $message = 'Umeongeza hatua kikamilifu';

           $steps = $request->steps;

           foreach ($steps as $step) {
              $stepCategory = new StepCategory();
              $stepCategory->category_id = $category->id;
              $stepCategory->step_id = $step;
              $stepCategory->save();
           }

         $validation->getMessageBag()->add('password', $message);
         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'isredirecting'=>true, 'html'=>$html]);



        }


        public function deleteCategory(Request $request)
        {




          $validation =  Validator::make($request->all(), [
              'category' => ['required', 'integer'],
          ]);

          if($validation->fails()){
                    $message = 'Fomu ina makosa!';
                  $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                  return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validation->errors()->toArray()]);
          }



          $category =  Category::where('id', $request->category)->first();

          if(empty($category)){

                      $message = 'Kundi hili halipo';
                    $html = View::make('kycmodule::messages.danger', compact('message'))->render();
                    return response()->json([ 'success'=>false, 'html'=>$html]);

          }

          $steps = StepCategory::where('category_id', $category->id)->get();

           foreach ($steps as $step) {

              $stepCategory->delete();
           }

           $category->delete();
           $message = 'Umeondoa hatua kikamilifu';

         $validation->getMessageBag()->add('password', $message);
         $html = View::make('kycmodule::messages.success', compact('message'))->render();
         return response()->json([ 'success'=>true,  'remove'=>$request->remove_class, 'html'=>$html]);



        }

}
