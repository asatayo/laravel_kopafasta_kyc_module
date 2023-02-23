@extends('kycmodule::layouts.admin-master')
@section('content')
<div class="container-fluid py-5 px-md-5 modified-container">

 <h4>Changua aina ya mkopo</h4>

 <div class="row">
<div class="col-md-4 align-items-center text-center">
  <a href="{{url('kycmodule/admin/loans/pending/mtajipap')}}" class="text-decoration-none text-muted"><div class="card my-auto">
    <div class="card-body">
      <p class="card-text">Ndinga  <i class="ms-5 fa fa-arrow-right"></i> </p>
    </div></a>
  </div>
</div>


<div class="col-md-4 align-items-center text-center">
  <a href="{{url('kycmodule/admin/loans/pending/mtajipap')}}" class="text-decoration-none text-muted"><div class="card my-auto">
    <div class="card-body bg-warning">
      <p class="card-text">Mtajipap  <i class="ms-5 fa fa-arrow-right"></i> </p>
    </div></a>
  </div>
</div>

</div>
</div>
@endsection
