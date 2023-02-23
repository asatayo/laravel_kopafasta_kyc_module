@extends('kycmodule::layouts.intro')

@section('content')
<div class="container-fluid p-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3 kopa-otp">
              <div class="container-fluid text-center justify-content-center">
                   <img src="{{asset('modules/kycmodule/img/logo.png')}}" width="100px" alt="">

              </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <form id="msform" class="form" method="POST" action="{{route('verifyOtp')}}">
                          @csrf
                            <fieldset>
                                <div class="form-card">
                                      <h6 class="text-center text-black">{{\Session::get('phone')}}</h6>

                                          <div class="d-flex justify-content-center align-items-center">
                                              
                                              
                                                   <div class="position-relatives">
                                                          <div class="text-center d-flex flex-column p-5">

                                                                  <h6 class="text-black">Ingiza namba 6 zilizotumwa kwenye namba yako ya simu uliyoiweka ili kukamilisha usajili wa awali.</h6>
                                                                  <div class="form-group mb-1 form-message">

                                                                  </div>
                                                                  
                                                                 
	
                                                                    		<div class="otp-inputs" id="otp_values">
                                                                    			<input type="text" class="otp-field" id='ist' maxlength="1" onkeyup="clickEvent(this,'sec')">
                                                                    			<input type="text" class="otp-field" id="sec" maxlength="1" onkeyup="clickEvent(this,'third')">
                                                                    			<input type="text" class="otp-field" id="third" maxlength="1" onkeyup="clickEvent(this,'fourth')">
                                                                    			<input type="text" class="otp-field" id="fourth" maxlength="1" onkeyup="clickEvent(this,'fifth')">
                                                                    			<input type="text" class="otp-field" id="fifth" maxlength="1" onkeyup="clickEvent(this,'sixth')">
                                                                    			<input type="text" class="otp-field" id="sixth" maxlength="1"  onkeyup="clickEvent(this,'sixth')">
                                                                    		</div>

                                                                      <input  type="hidden" id="otp" name="otp" />

                                                                   <button type="submit"  class="float-end btn btn-success block btn-lg mt-4"/>Endelea <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>

                                                             </div>

                                                             <div class="text-center d-flex flex-column mt-5">


                                                                      <div class="d-flex flex-row justify-content-center mt-4">
                                                                          <div class="d-flex flex-row">
                                                                            <div> <h6 class="text-black">Hujapokea OTP? </h6></div>
                                                                            <div>  <h6 class="text-black"><a href="{{url('resend-otp')}}" class="text-success ms-2 text-decoration-none"> Tuma tena</a></h6> </div>
                                                                          </div>
                                                                      </div>


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
