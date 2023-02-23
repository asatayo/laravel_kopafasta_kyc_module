@extends('kycmodule::layouts.master')
@section('content')
<div class="container-fluid p-md-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3">
               <h4>FOMU YA MDAU</h4>
              <h6>SOMA KWA MAKINI MAELEKEZO YANAYOHUSU UJAZAJI WA FOMU HII YALIYOAMBATANISHWA</h6>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" class="form" method="POST" action="{{route('mdauLoanFour')}}">
                          @csrf
                          <input type="hidden" name="mdau" value="{{$mdauLoan->id}}">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="details"><strong>Taarifa za mkopaji</strong></li>
                                <li class="active"id="loan"><strong>Mikopo ya nyuma</strong></li>
                                <li class="active"id="personal"><strong>Taarifa za wadhamini</strong></li>
                                <li class="active" id="vehice-form"><strong>Masharti na vigezo</strong></li>
                            </ul>
                            <!-- fieldsets -->

                             <div class="form-group  px-5">
                               <div class="form-message">

                               </div>
                             </div>
                            <fieldset>
                                <div class="form-card">
                                    <h6 class="fs-title">TAARIFA MUHIMU ZA GARI</h6>


                                    <div class="row mb-4">
                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="vehicle_type" class="text-black">Aina ya gari*</label>
                                             <input type="text"  class="form-control form-control-lg" value="{{$mdauLoan->vehicle_type}}" name="vehicle_type" placeholder="Aina ya gari"/>
                                             <small class="fw-bold vehicle_type_error"></small>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="vehicle_name" class="text-black">Jina kamili linalosomeka kwenye kadi gari*</label>
                                             <input type="text"  class="form-control form-control-lg"  value="{{$mdauLoan->vehicle_name}}" name="vehicle_name" placeholder="Jina kamili linalosomeka kwenye kadi gari"/>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="vehicle_registration_number" class="text-black">Namba ya usajili*</label>
                                             <input type="text"  class="form-control form-control-lg" value="{{$mdauLoan->vehicle_registration_number}}" name="vehicle_registration_number" placeholder="Namba ya usajili"/>
                                         </div>
                                       </div>
                                    </div>


                        <div class="row mb-4">
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="vehicle_chassis_number" class="text-black">Namba ya chasis*</label>
                                      <input type="text"  class="form-control form-control-lg" name="vehicle_chassis_number" value="{{$mdauLoan->vehicle_chassis_number}}"  placeholder="Namba ya chasis"/>
                                      <small class="fw-bold vehicle_chassis_number_error"></small>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="vehicle_color" class="text-black">Rangi ya gari*</label>
                                      <input type="text"  class="form-control form-control-lg" value="{{$mdauLoan->vehicle_color}}" name="vehicle_color" placeholder="Rangi ya gari"/>
                                      <small class="fw-bold vehicle_color_error"></small>
                                  </div>
                                </div>


                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="vehicle_model" class="text-black">Modeli*</label>
                                    <input type="text"  class="form-control form-control-lg" value="{{$mdauLoan->vehicle_model}}" name="vehicle_model" placeholder="Modeli"/>
                                      <small class="fw-bold vehicle_model_error"></small>
                                </div>
                              </div>


                           </div>


                            <div class="row">
                              <div class="form-group">
                                <h5 class="text-black">Weka picha za gari</h5>
                              </div>
                            </div>

                           <div class="row mb-4">
                                 <div class="col-md-3">
                                     <div class="form-group">
                                       <label for="first_vehicle_photo" class="text-black">Picha ya 1 *</label>
                                         <input type="file"  class="form-control form-control-lg" name="first_vehicle_photo"/>
                                         <small class="fw-bold first_vehicle_photo_error"></small>
                                     </div>
                                   </div>

                                   <div class="col-md-3">
                                       <div class="form-group">
                                         <label for="second_vehicle_photo" class="text-black">Picha ya 2 *</label>
                                           <input type="file"  class="form-control form-control-lg" name="second_vehicle_photo"/>
                                           <small class="fw-bold second_vehicle_photo_error"></small>
                                       </div>
                                     </div>


                                     <div class="col-md-3">
                                         <div class="form-group">
                                           <label for="third_vehicle_photo" class="text-black">Picha ya 3 *</label>
                                             <input type="file"  class="form-control form-control-lg" name="third_vehicle_photo"/>
                                             <small class="fw-bold third_vehicle_photo_error"></small>
                                         </div>
                                       </div>

                                       <div class="col-md-3">
                                           <div class="form-group">
                                             <label for="fourth_vehicle_photo" class="text-black">Picha ya 4 *</label>
                                               <input type="file"  class="form-control form-control-lg" name="fourth_vehicle_photo"/>
                                               <small class="fw-bold fourth_vehicle_photo_error"></small>
                                           </div>
                                         </div>

                              </div>


                              <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="vehicle_insurance" class="text-black">Aina ya Bima*</label>
                                            <input type="text"  class="form-control form-control-lg" value="{{$mdauLoan->vehicle_insurance_type}}" name="vehicle_insurance_type" placeholder="Aina ya Bima"/>
                                            <small class="fw-bold vehicle_insurance_type_error"></small>
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="vehicle_insurance_provider" class="text-black">Jina la mtoa Bima*</label>
                                            <input type="text"  class="form-control form-control-lg" name="vehicle_insurance_provider" value="{{$mdauLoan->vehicle_insurance_provider}}" placeholder="Jina la mtoa Bima"/>
                                              <small class="fw-bold vehicle_insurance_provider_error"></small>
                                        </div>
                                      </div>




                                 </div>



                                </div>
                                <a href="{{URL::previous()}}"  class="float-start btn btn-success ms-md-5"/><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Rundi Nyuma</a>
                                  <button type="submit" class="float-end btn btn-success me-md-5"/>Hifadhi <i class="fa fa-plus" aria-hidden="true"></i></button>
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
