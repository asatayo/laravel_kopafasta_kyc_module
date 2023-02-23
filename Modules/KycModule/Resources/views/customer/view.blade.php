@section('content')
<div class="container-fluid py-5 px-md-5 modified-container">
    <div class="row mt-5">
        <div class="col-sm-12 col-md-6 col-lg-6 order-2 order-md-1" >
             <div class="form-group has-search">
               <span class="fa fa-search form-control-feedback"></span>
               <input type="text" name="search" class="form-control form-control-lg" placeholder="Tafuta mkopo" value="">
             </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 order-1 order-md-2">
              <div class="d-flex flex-row float-end">
                      <h6 class="text-muted pt-2">{{Auth::guard('customer')->User()->first_name}} {{Auth::guard('customer')->User()->surname}}<br> {{Auth::guard('customer')->User()->phone}}</h6>
                      <div class="d-flex flex-column text-center">
                             <img src="{{asset('modules/kycmodule/img/profile.png')}}" height="40px" alt="">
                            <small><a href="{{url('edit')}}" class="text-decoration-none">Edit</a></small>

                      </div>
              </div>

        </div>
    </div>
 <h4>Taarifa za Mikopo</h4>


 <div class="row">
  
@foreach($loanApplicationDetails as $key => $loanApplicationDetail)
{{ $key}}
 <div class="col-sm-2">
   <div class="card">
     <div class="card-body">
       <h5 class="card-title">Ndinga Loan</h5>
       <p class="card-text">{{ strtoupper($loanApplicationDetail->field_name) }}</p>
       <p class="card-text">{{ strtoupper($loanApplicationDetail->data) }}</p>
     </div>
   </div>
 </div>
 @endforeach

 
</div>
@endsection
