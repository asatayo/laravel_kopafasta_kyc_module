<?php

namespace Modules\KycModule\Http\Controllers\Customer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;


use View;
use Auth;
use Carbon\Carbon;
use Session;
use Modules\KycModule\Entities\Step;
use Modules\KycModule\Entities\Loan;
use Modules\KycModule\Entities\Category;
use Modules\KycModule\Entities\StepCategory;
use Modules\KycModule\Entities\NdingaLoan;
use Modules\KycModule\Entities\MtajipapLoan;
use Modules\KycModule\Entities\MtumishiLoan;
use Modules\KycModule\Entities\MdauLoan;

use Redirect;


class KycModuleLoanCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     public function categories()
     {

         $categories = Category::orderBy('name', 'ASC')->get();




         return view('kycmodule::categories', compact('categories'));
     }


     public function chooseLoan(Request $request)
     {

       $validation =  Validator::make($request->all(), [
           'category' => ['required', 'string'],
       ]);

         $customer = Auth::guard('customer')->User();
          $category = $request->category;

         switch ($category) {
           case 'ndinga':
                 $loan = NdingaLoan::where('customer_id', $customer->id)->where('is_submited', 0)->first();
                 if(empty($loan)){
                   $loan = new NdingaLoan();
                   $loan->category_id = 1;
                   $loan->customer_id = $customer->id;
                   $loan->save();
                 }
             break;

             case 'mtajipap':
                   $loan = new MtajipapLoan();
                   $loan->customer_id = $customer->id;
                   $loan->category_id = 2;
                   $loan->save();
               break;


               case 'mdau':
                     $loan = new MdauLoan();
                     $loan->customer_id = $customer->id;
                     $loan->category_id = 3;
                     $loan->save();
                 break;


                 case 'mtumishi':
                       $loan = new MtumishiLoan();
                       $loan->customer_id = $customer->id;
                       $loan->category_id = 4;
                       $loan->save();
                   break;

           default:
             // code...
             break;
         }


       Session::put('loan_name', $category);
       $message = 'Tafadhali subiri';
       $html = View::make('kycmodule::messages.success', compact('message'))->render();
       return response()->json([ 'success'=>true,  'location'=>'/kycmodule/loan/'.$category.'/'.$loan->id.'/step-one', 'html'=>$html]);




     }



}
