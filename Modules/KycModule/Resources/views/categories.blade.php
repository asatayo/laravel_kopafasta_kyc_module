@extends('kycmodule::layouts.intro')
@section('title', 'Chagua aina ya mkopo')
@section('favicon', asset(Auth::guard('customer')->User()->profile_path))
@section('content')

!-- MultiStep Form -->
<div class="container-fluid p-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3 kopa-auth">
              <div class="container-fluid text-center justify-content-center">
                   <img src="{{asset('modules/kycmodule/img/logo.png')}}" width="100px" alt="">

              </div>
                <div class="row">
                    <div class="col-md-12 mx-0 px-5">
                        <form id="msform" class="form" method="POST" action="{{route('chooseLoan')}}">
                          @csrf
                            <fieldset>
                                <div class="form-card">
                                  <h6 class="text-center text-black">CHAGUA AINA YA MKOPO KUENDELEA</h6>

                                    <div class="row mb-4 mt-5 px-4">
                                        <div class="col-md-6 offset-md-3 px-5">
                                          <div class="form-group mb-1 form-message">

                                          </div>
                                           <div class="form-group mb-4">
                                             <select class="form-select form-select-lg" name="category">
                                                  <option selected disabled>Chagua aina ya mkopo</option>
                                                  <option value="ndinga">MKOPO WA NDINGA</option>
                                                  <option value="mtajipap">MKOPO WA MTAJIPAP</option>
                                                  <option value="mdau">MKOPO WA MDAU</option>
                                                  <option value="mtumishi">MKOPO WA WATUMISHI WA UMA</option>
                                             </select>
                                               <small class="fw-bold category_error"></small>
                                           </div>
                                           <div class="form-group">
                                              <button type="submit"  class="float-end btn btn-success block"/>Endelea <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                           </div>

                                         </div>

                                    </div>
                                </div>

                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
