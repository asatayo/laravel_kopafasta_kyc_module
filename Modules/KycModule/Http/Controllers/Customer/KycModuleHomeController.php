<?php

namespace Modules\KycModule\Http\Controllers\Customer;

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
use Modules\KycModule\Entities\MtajipapLoan;
use Modules\KycModule\Entities\MdauLoan;

use Modules\KycModule\Entities\NdingaLoanGuarantorPerson;




class KycModuleHomeController extends Controller
{

  public function home()
  {

    $customer = Auth::guard('customer')->User();

    $ndingaLoans =  NdingaLoan::where('customer_id', $customer->id)->take(4)->get();
    $mtajipapLoans =  MtajipapLoan::where('customer_id', $customer->id)->take(4)->get();
    $mdauLoans =  MdauLoan::where('customer_id', $customer->id)->take(4)->get();



      return view('kycmodule::customer.dashboard', compact('ndingaLoans', 'mtajipapLoans', 'mdauLoans'));
  }

}
