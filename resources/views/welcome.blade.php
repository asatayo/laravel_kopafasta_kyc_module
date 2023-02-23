@extends('kycmodule::layouts.master')

@section('content')


!-- MultiStep Form -->
<div class="container-fluid p-md-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3 kopa-intro">
               <h4 class="mb-5">KOPA FASTA</h4>
              <h6>KARIBU KATIKA MFUMO WA KOPA FASTA</h6>
                <div class="row mt-5">
                    <div class="col-lg-6 col-md-12 col-sm-12">

                          <a href="{{url('kycmodule/start')}}"  class="btn btn-success"/>Jaribu kama mteja <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                
                    </div>
                    
                     <div class="col-lg-6 col-md-12 col-sm-12 py-3">
                        <a href="{{url('kycmodule/admin/login')}}"  class="btn btn-danger"/>Test as Administrator <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>

                    </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
