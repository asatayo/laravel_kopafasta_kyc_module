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
use Modules\KycModule\Entities\MtajipapLoanOtherDebts;
use Modules\KycModule\Entities\MtajipapLoan;
use Modules\KycModule\Entities\MtajipapLoanGuarantorPerson;
use Modules\KycModule\Entities\MtajipapReview;





class KycModuleAdminMtajipapLoanController extends Controller
{

  public function categories()
  {

      $categories = Category::orderBy('name', 'ASC')->get();


      return view('kycmodule::admin.pending.mtajipap.categories', compact('categories'));
  }


  public function mtajipap()
  {

    $admin =   Auth::guard('admin')->user();

      $categoryIds = Step::where('user_id', $admin->id)->where('category_id', 2)->get()->pluck('category_id');


      $mtajipapLoans =  MtajipapLoan::whereIn('category_id', $categoryIds)->with('customer')->get();

      // return $mtajipapLoans;

      return view('kycmodule::admin.pending.mtajipap.mtajipap', compact('mtajipapLoans'));
  }

  public function review($mtajipapLoanId)
  {

       $admin =   Auth::guard('admin')->user();


      $mtajipapLoan =  MtajipapLoan::where('id', $mtajipapLoanId)->with('customer', 'guarators')->first();

    $pending_reviews = MtajipapReview::with('step')->where('user_id', $admin->id)->where('mtajipap_id', $mtajipapLoanId)->get();




      return view('kycmodule::admin.pending.mtajipap.review-mtajipap', compact('mtajipapLoan', 'pending_reviews'));
  }

  public function more($mtajipapLoanId)
  {

    $admin =   Auth::guard('admin')->user();



      $pending_reviews = MtajipapReview::with('step')->where('user_id', $admin->id)->where('mtajipap_id', $mtajipapLoanId)->get();


      $mtajipapLoan =  MtajipapLoan::where('id', $mtajipapLoanId)->with('customer', 'guarators')->first();

      //view the details more to see if the inforamtion is being retried



      return view('kycmodule::admin.pending.mtajipap.mtajipap-more', compact('mtajipapLoan','pending_reviews'));
  }



  public function mtajipapReview(Request $request){

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


        $review = MtajipapReview::where('id', $request->review)->first();
        $review->review = $request->description;
        $review->is_accepted =  $request->is_accepted;
        $review->is_reviewed = 1;

        $review->save();
          $mtajipapLoan = MtajipapLoan::where('id', $review->mtajipap_id)->first();
        if(!$request->is_accepted){
          $mtajipapLoan->is_submited = 0;
          $mtajipapLoan->save();

          //send mesage to customer that first level of review was rejected;
        }else{
          if(!MtajipapReview::where('mtajipap_id', $mtajipapLoan->id)->where('is_reviewed',0)->exists()){
              $mtajipapLoan->status = 'Accepted';
              $mtajipapLoan->save();
          }
        }







        $message = 'Umeongeza hatua kikamilifu';

   $html = View::make('kycmodule::messages.success', compact('message'))->render();
   return response()->json([ 'success'=>true,  'isreloading'=>true, 'html'=>$html]);

  }






}
