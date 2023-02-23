@extends('kycmodule::layouts.customer.dashboard')
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
@foreach($ndingaLoans as $ndingaLoan)
 <div class="col-sm-2">
   <div class="card">
     <div class="card-body">
       <h5 class="card-title">Ndinga Loan</h5>
       <p class="card-text">TSH. {{number_format($ndingaLoan->amount)}}</p>
     </div>
   </div>
 </div>
 @endforeach

 <div class="col-sm-3 col-sm-3 offset-1 d-flex align-items-center text-center">
   <a href="{{url('kycmodule/loans')}}" class="text-decoration-none text-muted"><div class="card my-auto">
     <div class="card-body">
       <p class="card-text">Omba mkopo mwingine  <i class="ms-5 fa fa-arrow-right"></i> </p>
     </div></a>
   </div>
 </div>
</div>

@if(count($ndingaLoans)>0)
<div class="row">
  <div class="col-md-12">
    <h5 class="mt-4">Mkopo wa ndinga</h5>

  </div>
</div>
<div class="row">
    <div class="col-md-12">
      <table class="table table-bordered bg-white">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Kiasi</th>
                      <th scope="col">Tarehe ya kuomba</th>
                      <th scope="col">Hali ya mkopo</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white">
                     @foreach($ndingaLoans as $key => $ndingaLoan)
                    <tr>
                      <th scope="row">{{$key+1}}.</th>
                      <td>{{$ndingaLoan->amount}}</td>
                      <td>{{ Carbon\Carbon::parse($ndingaLoan->created_at)->format('Y-m-d')}}</td>
                      <td>{{$ndingaLoan->status}}</td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>



    </div>
</div>
@endif


@if(count($mtajipapLoans)>0)
<div class="row">
  <div class="col-md-12">
    <h5 class="mt-4">Mkopo wa Mtajipap</h5>

  </div>
</div>
<div class="row">
    <div class="col-md-12">
      <table class="table table-bordered bg-white">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Kiasi</th>
                      <th scope="col">Tarehe ya kuomba</th>
                      <th scope="col">Hali ya mkopo</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white">
                     @foreach($mtajipapLoans as $key => $mtajipapLoan)
                    <tr>
                      <th scope="row">{{$key+1}}.</th>
                      <td>{{$mtajipapLoan->amount}}</td>
                      <td>{{ Carbon\Carbon::parse($mtajipapLoan->created_at)->format('Y-m-d')}}</td>
                      <td>{{$mtajipapLoan->status}}</td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>



    </div>
</div>
@endif

@if(count($mdauLoans)>0)
<div class="row">
  <div class="col-md-12">
    <h5 class="mt-4">Mkopo wa Mdau</h5>

  </div>
</div>
<div class="row">
    <div class="col-md-12">
      <table class="table table-bordered bg-white">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Kiasi</th>
                      <th scope="col">Tarehe ya kuomba</th>
                      <th scope="col">Hali ya mkopo</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white">
                     @foreach($mdauLoans as $key => $mdauLoan)
                    <tr>
                      <th scope="row">{{$key+1}}.</th>
                      <td>{{$mdauLoan->amount}}</td>
                      <td>{{ Carbon\Carbon::parse($mdauLoan->created_at)->format('Y-m-d')}}</td>
                      <td>{{$mdauLoan->status}}</td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>



    </div>
</div>
@endif


@if(count($ndingaLoans)>0)
<div class="row">
  <div class="col-md-12">
    <h5 class="mt-4">Mkopo wa Mtumishi wa Umma</h5>

  </div>
</div>
<div class="row">
    <div class="col-md-12">
      <table class="table table-bordered bg-white">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Kiasi</th>
                      <th scope="col">Tarehe ya kuomba</th>
                      <th scope="col">Hali ya mkopo</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white">
                     @foreach($ndingaLoans as $key => $ndingaLoan)
                    <tr>
                      <th scope="row">{{$key+1}}.</th>
                      <td>{{$ndingaLoan->amount}}</td>
                      <td>{{ Carbon\Carbon::parse($ndingaLoan->created_at)->format('Y-m-d')}}</td>
                      <td>{{$ndingaLoan->status}}</td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>



    </div>
</div>
@endif
</div>
@endsection
