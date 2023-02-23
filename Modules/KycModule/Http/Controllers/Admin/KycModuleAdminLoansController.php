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
use Modules\KycModule\Entities\NdingaLoanOtherDebts;
use Modules\KycModule\Entities\NdingaLoan;
use Modules\KycModule\Entities\NdingaLoanGuarantorPerson;
use Modules\KycModule\Entities\NdingaReview;





class KycModuleAdminLoansController extends Controller
{

  public function categories()
  {

      $categories = Category::orderBy('name', 'ASC')->get();


      return view('kycmodule::admin.pending.categories', compact('categories'));
  }


  public function ndinga()
  {

    $admin =   Auth::guard('admin')->user();


      $categoryIds = Step::where('user_id', $admin->id)->where('category_id', 1)->get()->pluck('category_id');

      $ndingaLoans =  NdingaLoan::whereIn('category_id', $categoryIds)->with('customer')->get();

      // return $ndingaLoans;

      return view('kycmodule::admin.pending.ndinga', compact('ndingaLoans'));
  }

  public function review($ndingaLoanId)
  {

    $admin =   Auth::guard('admin')->user();



      $ndingaLoan =  NdingaLoan::where('id', $ndingaLoanId)->with('customer', 'guarators')->first();

    $pending_reviews = NdingaReview::with('step')->where('user_id', $admin->id)->where('ndinga_id', $ndingaLoanId)->get();




      return view('kycmodule::admin.pending.review-ndinga', compact('ndingaLoan', 'pending_reviews'));
  }

  public function more($ndingaLoanId)
  {

    $admin =   Auth::guard('admin')->user();



      $pending_reviews = NdingaReview::with('step')->where('user_id', $admin->id)->where('ndinga_id', $ndingaLoanId)->get();


      $ndingaLoan =  NdingaLoan::where('id', $ndingaLoanId)->with('customer', 'guarators')->first();

      //view the details more to see if the inforamtion is being retried



      return view('kycmodule::admin.pending.ndinga-more', compact('ndingaLoan','pending_reviews'));
  }



  public function ndingaReview(Request $request){

    $validator =  Validator::make($request->all(), [
        'review' => ['required', 'integer'],
        'is_accepted' => ['required', 'integer'],
        'description' => ['required','string'],
      ]);

     $message = 'Formu imewasilishwa ikiwa na mapungufu.';


    if($validator->fails()){

            $html = View::make('kycmodule::messages.danger', compact('message'))->render();
            return response()->json([ 'success'=>false, 'html'=>$html,  'errors'=>$validator->errors()->toArray()]);
    }



    $admin =   Auth::guard('admin')->user();



        $review = NdingaReview::where('id', $request->review)->first();
        $review->review = $request->description;
        $review->is_accepted =  $request->is_accepted;
        $review->is_reviewed = 1;

        $review->save();
          $ndingaLoan = NdingaLoan::where('id', $review->ndinga_id)->first();
        if(!$request->is_accepted){
          $ndingaLoan->is_submited = 0;
          $ndingaLoan->save();

          //send mesage to customer that first level of review was rejected;
        }else{
          if(!NdingaReview::where('ndinga_id', $ndingaLoan->id)->where('is_reviewed',0)->exists()){
              $ndingaLoan->status = 'Accepted';
              $ndingaLoan->save();
          }
        }







        $message = 'Umeongeza hatua kikamilifu';

   $html = View::make('kycmodule::messages.success', compact('message'))->render();
   return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

  }






}
