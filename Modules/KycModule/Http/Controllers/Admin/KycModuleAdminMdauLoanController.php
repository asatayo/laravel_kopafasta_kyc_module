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
use Modules\KycModule\Entities\MdauLoanOtherDebts;
use Modules\KycModule\Entities\MdauLoan;
use Modules\KycModule\Entities\MdauLoanGuarantorPerson;
use Modules\KycModule\Entities\MdauReview;





class KycModuleAdminMdauLoanController extends Controller
{

  public function categories()
  {

      $categories = Category::orderBy('name', 'ASC')->get();


      return view('kycmodule::admin.pending.mdau.categories', compact('categories'));
  }


  public function mdau()
  {

    $admin =   Auth::guard('admin')->user();

      $categoryIds = Step::where('user_id', $admin->id)->where('category_id', 3)->get()->pluck('category_id');
      

      
      

      $mdauLoans =  MdauLoan::whereIn('category_id', $categoryIds)->with('customer')->get();

    //   return $mdauLoans;

      return view('kycmodule::admin.pending.mdau.mdau', compact('mdauLoans'));
  }

  public function review($mdauLoanId)
  {



    $admin =   Auth::guard('admin')->user();



      $mdauLoan =  MdauLoan::where('id', $mdauLoanId)->with('customer', 'guarators')->first();

      $pending_reviews = MdauReview::with('step')->where('user_id', $admin->id)->where('mdau_id', $mdauLoanId)->get();



      return view('kycmodule::admin.pending.mdau.review-mdau', compact('mdauLoan', 'pending_reviews'));
  }

  public function more($mdauLoanId)
  {

      $admin =   Auth::guard('admin')->user();


      $pending_reviews = MdauReview::with('step')->where('user_id', $admin->id)->where('mdau_id', $mdauLoanId)->get();


      $mdauLoan =  MdauLoan::where('id', $mdauLoanId)->with('customer', 'guarators')->first();




      //view the details more to see if the inforamtion is being retried



      return view('kycmodule::admin.pending.mdau.mdau-more', compact('mdauLoan','pending_reviews'));
  }



  public function mdauReview(Request $request){

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


        $review = MdauReview::where('id', $request->review)->first();
        $review->review = $request->description;
        $review->is_accepted =  $request->is_accepted;
        $review->is_reviewed = 1;

        $review->save();
        $mdauLoan = MdauLoan::where('id', $review->mdau_id)->first();

        $reviews = MdauReview::where('mdau_id', $mdauLoan->id)->get();

        foreach ($reviews as $review) {
           if(!$review->is_reviewed){
             $mdauLoan->current_step = $review->step_id;
             $mdauLoan->save();
             break;
           }
        }



        if(!$request->is_accepted){
          $mdauLoan->is_submited = 0;
          $mdauLoan->save();

          //send mesage to customer that first level of review was rejected;
        }else{
          if(!MdauReview::where('mdau_id', $mdauLoan->id)->where('is_reviewed',0)->exists()){
              $mdauLoan->status = 'Accepted';
              $mdauLoan->is_accepted = 1;
              $mdauLoan->is_completed = 1;
              $mdauLoan->save();
          }
        }







        $message = 'Umeongeza hatua kikamilifu';

   $html = View::make('kycmodule::messages.success', compact('message'))->render();
   return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

  }






}
