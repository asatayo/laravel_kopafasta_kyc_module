@extends('kycmodule::layouts.master')

@section('content')


!-- MultiStep Form -->
<div class="container-fluid p-md-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3">
               <h4>FOMU YA MDAU</h4>
              <h6>SOMA KWA MAKINI MAELEKEZO YANAYOHUSU UJAZAJI WA FOMU HII YALIYOAMBATANISHWA</h6>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" class="form" method="POST" action="{{route('mdauLoan')}}">
                          @csrf
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="details"><strong>Taarifa za mkopaji</strong></li>
                                <li id="personal"><strong>Taarifa za wadhamini</strong></li>
                                <li id="vehice-form"><strong>Taarifa muhimu za gari</strong></li>
                            </ul>
                            <!-- fieldsets -->

                             <div class="form-group  px-5">
                               <div class="form-message">

                               </div>
                             </div>
                            <fieldset>
                                <div class="form-card">
                                    <h6 class="fs-title">TAARIFA ZA MKOPAJI</h6>


                                    <div class="row">
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="amount" class="text-black">Kiasi*</label>
                                              <input type="text"  class="form-control form-control-lg" name="amount" placeholder="Kiasi"/>
                                              <small class="fw-bold amount_error"></small>
                                          </div>
                                        </div>

                                        <div class="col-md-8">
                                          <div class="form-group mb-4">
                                            <label for="amount_words" class="text-black ps-1 mb-1">Kiasi cha mkopo kinachoombwa (Kwa maneno)*</label>
                                              <textarea  class="form-control" name="amount_words" rows="4" placeholder="Kiasi kwa maneno"/></textarea>
                                              <small class="fw-bold amount_words_error"></small>
                                          </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                      <div class="form-group mb-4">
                                        <label for="intension" class="text-black">Lengo la mkopo</label>
                                          <textarea  class="form-control" name="intension" placeholder="Lengo la mkopo"/></textarea>
                                          <small class="fw-bold intension_error"></small>
                                      </div>
                                    </div>

                                    <div class="row mb-4">
                                       <div class="col-md-6">
                                         <div class="form-group">
                                           <label for="work_business" class="text-black">Kazi/Biashara</label>
                                             <input type="text"  class="form-control form-control-lg" name="work_business" placeholder="Kazi/Biashara"/>
                                             <small class="fw-bold work_business_error"></small>
                                         </div>
                                       </div>

                                       <div class="col-md-6">
                                         <div class="form-group">
                                           <label for="dependants_count" class="text-black">Idadi ya wategemezi</label>
                                             <input type="text"  class="form-control form-control-lg" name="dependants_count" placeholder="Kazi/Biashara"/>
                                             <small class="fw-bold dependants_count_error"></small>
                                         </div>
                                       </div>


                                    </div>



                                    <div class="row mb-4">


                                       <div class="col-md-2">
                                         <div class="form-group">
                                           <label for="income_perday" class="text-black">Kipato cha sasa (kwa siku)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_perday" placeholder="Kipato kwa siku"/>
                                             <small class="fw-bold income_perday_error"></small>
                                         </div>
                                       </div>


                                       <div class="col-md-2">
                                         <div class="form-group">
                                           <label for="income_perweek" class="text-black">Kipato cha sasa (kwa wiki)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_perweek" placeholder="Kipato cha sasa (kwa wiki)"/>
                                             <small class="fw-bold income_perweek_error"></small>
                                         </div>
                                       </div>
                                       <div class="col-md-2">
                                         <div class="form-group">
                                           <label for="income_permonth" class="text-black">Kipato cha sasa (kwa mwezi)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_permonth" placeholder="Kipato cha sasa (kwa mwezi)"/>
                                             <small class="fw-bold income_permonth_error"></small>
                                         </div>
                                       </div>
                                       <div class="col-md-2">
                                         <div class="form-group">
                                           <label for="income_peryear" class="text-black">Kipato cha sasa (kwa mwaka)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_peryear" placeholder="Kipato cha sasa (kwa mwaka)"/>
                                             <small class="fw-bold income_peryear_error"></small>
                                         </div>
                                       </div>
                                    </div>

                                    <div class="form-group mb-4">
                                      <label for="other_properties" class="text-black">Mali nyinginezo</label>
                                        <textarea  class="form-control" name="other_properties" placeholder="Mali nyinginezo"/></textarea>
                                        <small class="fw-bold other_properties_error"></small>
                                    </div>

                                      <div class="row">
                                        <div class="d-flex flex-row">
                                                <h5 class="text-black me-3">Madeni ya mikopo mingine </h5>
                                                <h5 class="text-black" id="addmore">+ </h5>
                                        </div>

                                        <div class="mb-1">

                                        </div>
                                      </div>
                                    <div class="row mb-4" id="debt_field">
                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="debt_amount" class="text-black">Kiasi</label>
                                             <input type="number"  class="form-control form-control-lg" name="debt_amount[]" placeholder="Kiasi"/>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="debpt_organization" class="text-black">Taasisi</label>
                                             <input type="text"  class="form-control form-control-lg" name="debpt_organization[]" placeholder="Taasisi"/>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="clear_date" class="text-black">Tarehe ya kumaliza</label>
                                             <input type="date"  class="form-control form-control-lg" name="clear_date[]" placeholder="Tarehe ya kumaliza"/>
                                         </div>
                                       </div>


                                    </div>


                                    <div class="row mb-4">


                                       <div class="col-md-8">
                                         <h5 class="text-black"> Eneo la makazi</h5>
                                           <div class="row">

                                             <div class="col-4">
                                               <div class="form-group">
                                                   <select class="form-select form-select-lg" name="region[]">
                                                        <option selected disabled>Mkoa</option>
                                                        <option value="Arusha">Arusha</option>
                                                   </select>
                                                   <small class="fw-bold region_error"></small>
                                               </div>
                                             </div>



                                             <div class="col-4">
                                               <div class="form-group">
                                                   <select class="form-select form-select-lg" name="district[]">
                                                        <option selected disabled>Wilaya</option>
                                                        <option value="Arusha">Manispaa ya Arusha</option>
                                                   </select>
                                                   <small class="fw-bold district_error"></small>
                                               </div>
                                             </div>

                                             <div class="col-4">
                                               <div class="form-group">
                                                   <select class="form-select form-select-lg" name="ward[]">
                                                        <option selected disabled>Kata</option>
                                                        <option value="Arusha">Arusha Mikindani</option>
                                                   </select>
                                                   <small class="fw-bold ward_error"></small>
                                               </div>
                                             </div>



                                           </div>
                                       </div>




                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="phone" class="text-black">Namba ya simu</label>
                                             <input type="text"  class="form-control form-control-lg" name="phone[]" placeholder="Namba ya simu"/>
                                             <small class="fw-bold phone_error"></small>
                                         </div>
                                       </div>
                                    </div>


                                </div>
                                <button type="button" name="next" class="float-end btn btn-success next action-button me-md-5"/>Hifadhi na Endelea <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>

                            </fieldset>
                            <fieldset>
                              <div class="form-card">
                                  <h6 class="fs-title">TAARIFA ZA WADHAMINI</h6>
                                    <div id="representative_field">
                                              <div class="form-group mb-4">
                                                <div class="row">
                                                  <div class="d-flex flex-row">
                                                          <h5 class="text-black me-3">Mdhamini wa kwanza </h5>
                                                          <h5 class="text-black" id="add_representative">+ </h5>
                                                  </div>
                                                </div>
                                              <div class="row mb-4">
                                                 <div class="col-md-4">
                                                   <div class="form-group">
                                                     <label for="first_name" class="text-black">Jina la kwanza*</label>
                                                       <input type="text"  class="form-control form-control-lg" name="first_name[]" placeholder="Jina la kwanza"/>
                                                       <small class="fw-bold first_name_error"></small>
                                                   </div>
                                                 </div>


                                                 <div class="col-md-4">
                                                   <div class="form-group">
                                                     <label for="middle_name" class="text-black">Jina la kati*</label>
                                                       <input type="text"  class="form-control form-control-lg" name="middle_name[]" placeholder="Jina la kati"/>
                                                       <small class="fw-bold middle_name_error"></small>
                                                   </div>
                                                 </div>


                                                 <div class="col-md-4">
                                                   <div class="form-group">
                                                     <label for="last_name" class="text-black">Jina la mwisho*</label>
                                                       <input type="text"  class="form-control form-control-lg" name="last_name[]" placeholder="Jina la Mwisho"/>
                                                       <small class="fw-bold last_name_error"></small>
                                                   </div>
                                                 </div>
                                              </div>
                                            </div>


                                  <div class="row mb-4">
                                      <div class="col-3">
                                             <div class="form-group">
                                               <label for="clear_date" class="text-black">Chagua aina ya kitambulisho</label>
                                                 <select class="form-select form-select-lg" name="identity_type[]">
                                                      <option selected disabled>Chagua aina ya kitambulisho</option>
                                                      <option value="NIDA">NIDA</option>
                                                      <option value="Voter ID">Kitambulisho cha Mpiga kura</option>
                                                      <option value="Driving Licence">Leseni ya udereva</option>
                                                 </select>
                                                 <small class="fw-bold identity_type_error"></small>
                                             </div>
                                           </div>



                                           <div class="col-3">
                                             <div class="form-group">
                                               <label for="guarantor_identity" class="text-black">Ingiza namba ya kitambulisho*</label>
                                                 <input type="text"  class="form-control form-control-lg" name="guarantor_identity[]" placeholder="Ingiza namba ya kitambulisho"/>
                                                 <small class="fw-bold guarantor_identity_error"></small>
                                             </div>
                                           </div>

                                           <div class="col-3">
                                             <div class="form-group">
                                               <label for="guarantor_identity_file_copy" class="text-black">Pakia kopi ya kitambulisho*</label>
                                                 <input type="file"  class="form-control form-control-lg" name="guarantor_identity_file_copy[]" placeholder="Pakia kopi ya kitambulisho"/>
                                                  <small class="fw-bold guarantor_identity_file_copy_error"></small>
                                             </div>
                                           </div>

                                           <div class="col-3">
                                             <div class="form-group">
                                               <label for="guarantor_phone" class="text-black">Namba ya simu*</label>
                                                 <input type="text"  class="form-control form-control-lg" name="guarantor_phone[]" placeholder="Namba ya simu"/>
                                                   <small class="fw-bold guarantor_phone_error"></small>
                                             </div>
                                           </div>

                                           <div class="col-3">
                                             <div class="form-group">
                                               <label for="guarantor_realtionship" class="text-black">Mahusiano yako na mdhamini*</label>
                                                 <input type="text"  class="form-control form-control-lg" name="guarantor_realtionship[]" placeholder="Mahusiano yako na mdhamini"/>
                                                 <small class="fw-bold guarantor_realtionship_error"></small>
                                             </div>
                                           </div>



                                     </div>
                                   </div>




                              </div>

                                <button type="button" name="next" class="float-start btn btn-success previous action-button-previous ms-md-5"/> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Rudi nyuma </button>


                                <button type="button" name="next" class="float-end btn btn-success next action-button me-md-5"/>Hifadhi na Endelea <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>

                            </fieldset>
                            <fieldset>
                              <div class="form-card">
                                  <h6 class="fs-title">TAARIFA MUHIMU ZA GARI</h6>
                                    <div id="representative_field">



                                              <div class="row mb-4">
                                                 <div class="col-md-4">
                                                   <div class="form-group">
                                                     <label for="vehicle_type" class="text-black">Aina ya gari*</label>
                                                       <input type="text"  class="form-control form-control-lg" name="vehicle_type" placeholder="Aina ya gari"/>
                                                       <small class="fw-bold vehicle_type_error"></small>
                                                   </div>
                                                 </div>


                                                 <div class="col-md-4">
                                                   <div class="form-group">
                                                     <label for="vehicle_name" class="text-black">Jina kamili linalosomeka kwenye kadi gari*</label>
                                                       <input type="text"  class="form-control form-control-lg" name="vehicle_name" placeholder="Jina kamili linalosomeka kwenye kadi gari"/>
                                                   </div>
                                                 </div>


                                                 <div class="col-md-4">
                                                   <div class="form-group">
                                                     <label for="vehicle_registration_number" class="text-black">Namba ya usajili*</label>
                                                       <input type="text"  class="form-control form-control-lg" name="vehicle_registration_number" placeholder="Namba ya usajili"/>
                                                   </div>
                                                 </div>
                                              </div>


                                  <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="vehicle_chassis_number" class="text-black">Namba ya chasis*</label>
                                                <input type="text"  class="form-control form-control-lg" name="vehicle_chassis_number" placeholder="Namba ya chasis"/>
                                                <small class="fw-bold vehicle_chassis_number_error"></small>
                                            </div>
                                          </div>

                                          <div class="col-md-4">
                                            <div class="form-group">
                                              <label for="vehicle_color" class="text-black">Rangi ya gari*</label>
                                                <input type="text"  class="form-control form-control-lg" name="vehicle_color" placeholder="Rangi ya gari"/>
                                                <small class="fw-bold vehicle_color_error"></small>
                                            </div>
                                          </div>


                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="vehicle_model" class="text-black">Modeli*</label>
                                              <input type="text"  class="form-control form-control-lg" name="vehicle_model" placeholder="Modeli"/>
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
                                                      <input type="text"  class="form-control form-control-lg" name="vehicle_insurance_type" placeholder="Aina ya Bima"/>
                                                      <small class="fw-bold vehicle_insurance_type_error"></small>
                                                  </div>
                                                </div>

                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="vehicle_insurance_provider" class="text-black">Jina la mtoa Bima*</label>
                                                      <input type="text"  class="form-control form-control-lg" name="vehicle_insurance_provider" placeholder="Jina la mtoa Bima"/>
                                                        <small class="fw-bold vehicle_insurance_provider_error"></small>
                                                  </div>
                                                </div>




                                           </div>





                                   </div>

                              </div>

                                <button type="button" name="next" class="float-start btn btn-success previous action-button-previous ms-md-5"/> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Rudi nyuma </button>


                                <button type="submit" class="float-end btn btn-success me-md-5"/>Hifadhi na tum taaifa <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>

                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
