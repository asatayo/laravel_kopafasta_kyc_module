@extends('kycmodule::layouts.master')

@section('content')
<div class="container-fluid p-md-5">
    <div class="row mt-0">
        <div class="col-12 col-md-8 offset-md-2 p-0 mt-5 mb-2" style="min-height: 75vh;">
              <h5 class="mt-5 text-center">SOMA KWA MAKINI VIGEZO NA MSAHARTI YA MKOPO</h5>



        </div>
    </div>
    <a href="{{URL::previous()}}"  class="float-start btn btn-success ms-md-5"/><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Nyuma</a>
    <a href="{{ url('kycmodule/home')}}"  class="float-end btn btn-success me-md-5"/> Maliza <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
</div>

@endsection
