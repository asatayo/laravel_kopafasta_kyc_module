<?php

namespace Modules\KycModule\Http\Controllers\Customer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Modules\KycModule\Entities\Customer;


use View;
use Auth;
use Carbon\Carbon;
use Session;
use Modules\KycModule\Entities\LoanApplicant;
use Modules\KycModule\Entities\LoanApplication;
use Modules\KycModule\Entities\LoanProductField;
use Modules\KycModule\Entities\LoanProduct;
use Modules\KycModule\Entities\LoanApplicationDetail;

use Modules\KycModule\Entities\NdingaLoanGuarantorPerson;




class KycModuleActionController extends Controller
{

 public function index(){

    return view('kycmodule::customer.test');
 }


  public function store(Request $request)
  {
    
    //geneerally customer 
    ///session will come from the authenticated customer
    $loanApplicant = LoanApplicant::findOrFail(1);

    //Find the equivalent loan product selected by the customer
    $loanProduct = LoanProduct::findOrFail(1);

    
    $loanApplication = LoanApplication::create([
        'loan_product_id'=> $loanProduct->id,
        'loan_applicant_id'=>$loanApplicant->id,
    ]);

    
    foreach($request->all() as $key => $requestData){

       $loanProductField = LoanProductField::firstOrCreate([
            "field_name" => $key,
            "field_type" => "empty"
            ],[
            "loan_product_id"=> $loanApplication->loan_product_id
            ]);
      
        LoanApplicationDetail::create([
            "loan_application_id"=> $loanApplication->id,
            "loan_product_field_id"=> $loanProductField->id,
            "data" => $requestData
        ]);
      
    }


    return $this->show($request, $loanApplication->id);



     
  }




public function show(Request $request, $loanApplicationId){
 
	$loanApplicationDetails = LoanApplicationDetail::where("loan_application_id", $loanApplicationId)
    ->join("loan_product_fields", "loan_product_fields.id", "=", "loan_application_details.loan_product_field_id")
    ->select(
      "loan_application_details.data",
      "loan_product_fields.field_name"
    )->get()->toArray();

    // return $loanApplicationDetails;

 return view('kycmodule::customer.view', compact('loanApplicationDetails'));

}

}
