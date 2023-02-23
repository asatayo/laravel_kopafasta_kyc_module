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
use Modules\KycModule\Entities\MtajipapLoan;

use Modules\KycModule\Entities\MdauLoan;




class KycModuleAdminDashboardController extends Controller
{

  public function index()
  {



    $admin =   Auth::guard('admin')->user();
    
    


    $categoryIds = Step::where('user_id', $admin->id)->where('category_id', 2)->get()->pluck('category_id');
    $mtajipapLoans =  MtajipapLoan::whereIn('category_id', $categoryIds)->with('customer')->limit(3)->get();
    $mtajipapLoansCount =  MtajipapLoan::count();



    $categoryIds = Step::where('user_id', $admin->id)->where('category_id', 1)->get()->pluck('category_id');

    $ndingaLoans =  NdingaLoan::whereIn('category_id', $categoryIds)->with('customer')->limit(3)->get();
    $ndingaLoansCount =  NdingaLoan::count();
    
    
     $categoryIds = Step::where('user_id', $admin->id)->where('category_id', 3)->get()->pluck('category_id');
     $mdauLoans =  MdauLoan::whereIn('category_id', $categoryIds)->with('customer')->limit(3)->get();
     $mdauLoansCount =  MdauLoan::count();



      return view('kycmodule::admin.dashboard', compact('mtajipapLoans','ndingaLoans', 'mtajipapLoansCount', 'ndingaLoansCount', 'mdauLoans', 'mdauLoansCount'));
  }
}
