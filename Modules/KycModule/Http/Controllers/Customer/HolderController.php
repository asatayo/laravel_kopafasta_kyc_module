// html view
<input type="number" name="amount"/> // 6000

// controller
public function store(Request $request){
	// create application
  $loanApplication = $loanApplicant->applications()->create();

  // create fields
  foreach($request->all() as $key => $requestData){
  	$loanApplicationField = LoanApplicationField::firstOrCreate([,
      "field_name" => $key,
      "field_type" => "empty"
    ],[
    	"loan_product_id"=> $loanApplication->loan_product_id
		]);
    
    LoanApplicationFieldDetail::create([
      "loan_application_id"=> $loanApplication->id,
      "loan_application_field_id"=> $field->id,
      "data" => $requestData // 6000
    ]);
    
  }
  
  // other logics

}


public function show(Request $request, LoanApplication $loanApplication){
	$loanApplicationDetails = LoanApplicationDetail::where("loan_application_id", $loanApplication->id)
    ->join("loan_application_fields", "loan_application_fields.id", "=", "loan_application_details.loan_application_field_id")
    ->select(
      "loan_application_details.data",
      "loan_application_fields.field_name"
    )
    ->pluck(["field_name", "data"]);
  
  [
  	"amount"=>5000,
    "age"=>12
  ];
  
  return view("some-view",[
  	"data"=>$loanApplicationDetails
  ]);
}

// html
<p>{{$data["amount"]}}</p>


