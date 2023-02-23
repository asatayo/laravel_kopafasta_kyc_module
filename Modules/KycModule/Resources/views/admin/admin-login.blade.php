@extends('kycmodule::layouts.intro')

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
                    <div class="col-md-12 mx-0">
                        <form id="msform" class="form" method="POST" action="{{route('adminLogin')}}">
                          @csrf

                            <fieldset>
                                <div class="form-card">
                                  <h6 class="text-center text-black">ADMIN LOGIN</h6>

                                    <div class="row mb-4 mt-5 px-4">
                                        <div class="col-md-4 offset-md-4 px-5">
                                          <div class="form-group mb-1 form-message">

                                          </div>

                                          <div class="form-group mb-4">
                                              <label for="email">E-mail Address</label>
                                              <input type="email"  class="form-control form-control-lg" name="email" placeholder="Eg. asat@domain.com"/>
                                              <small class="fw-bold email_error"></small>
                                          </div>

                                           <div class="form-group mb-4">
                                             <label for="email">Password</label>
                                               <input type="password"  class="form-control form-control-lg" name="password" placeholder="Password"/>
                                               <small class="fw-bold password_error"></small>
                                           </div>

                                           <div class="form-group d-grid gap-1">
                                              <button type="submit"  class="float-end btn btn-success block"/>Login <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
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
