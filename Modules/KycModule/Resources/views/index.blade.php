@extends('kycmodule::layouts.master')

@section('content')


!-- MultiStep Form -->
<div class="container-fluid p-md-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3">
               <h4>FOMU YA NDINGA</h4>
              <h6>SOMA KWA MAKINI MAELEKEZO YANAYOHUSU UJAZAJI WA FOMU HII YALIYOAMBATANISHWA</h6>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" class="form" method="POST" action="{{route('addCustomer')}}">
                          @csrf
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="details"><strong>Taarifa za mkopaji</strong></li>
                                <li id="personal"><strong>Taarifa za wadhamini</strong></li>
                                <li id="payment"><strong>Taarifa muhimu za gari</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h6 class="fs-title">TAARIFA ZA MKOPAJI</h6>
                                    <div class="form-group mb-4">
                                      <label for="amount_words" class="text-black ps-1 mb-1">Kiasi cha mkopo kinachoombwa (Kwa maneno)</label>
                                        <textarea  class="form-control" name="amount_words" placeholder="Kiasi kwa maneno"/></textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                      <label for="intension" class="text-black">Lengo la mkopo</label>
                                        <textarea  class="form-control" name="intension" placeholder="Lengo la mkopo"/></textarea>
                                    </div>

                                    <div class="row mb-4">
                                       <div class="col-md-5">
                                         <div class="form-group">
                                           <label for="work_business" class="text-black">Kazi/Biashara</label>
                                             <input type="text"  class="form-control form-control-lg" name="work_business" placeholder="Kazi/Biashara"/>
                                         </div>
                                       </div>

                                       <div class="col-md-7">
                                          <div class="form-group">
                                              <label for="marital" class="text-black">Hali ya ndoa</label>

                                             <div class="form-group py-2">
                                               <div class="form-check form-check-inline">
                                                     <input class="form-check-input text-black" type="radio" name="marital" id="marital1" value="Umeoa">
                                                     <label class="form-check-label text-black" for="marital1">Umeoa</label>
                                               </div>

                                               <div class="form-check form-check-inline">
                                                     <input class="form-check-input text-black" type="radio" name="marital" id="marital2" value="Umeolewa">
                                                     <label class="form-check-label text-black" for="marital2">Umeolewa</label>
                                               </div>

                                               <div class="form-check form-check-inline">
                                                     <input class="form-check-input text-black" type="radio" name="marital" id="marital3" value="Nimeolewa">
                                                     <label class="form-check-label text-black" for="marital3">Nimeolewa</label>
                                               </div>

                                               <div class="form-check form-check-inline">
                                                     <input class="form-check-input text-black" type="radio" name="marital" id="marital4" value="Sijaolewa">
                                                     <label class="form-check-label text-black" for="marital4">Sijaolewa</label>
                                               </div>
                                             </div>
                                       </div>
                                     </div>
                                    </div>



                                    <div class="row mb-4">
                                       <div class="col-md-2">
                                         <div class="form-group">
                                           <label for="dependants_count" class="text-black">Idadi ya wategemezi</label>
                                             <input type="text"  class="form-control form-control-lg" name="dependants_count" placeholder="Kazi/Biashara"/>
                                         </div>
                                       </div>




                                       <div class="col-md-2">
                                         <div class="form-group">
                                           <label for="income_perday" class="text-black">Kipato cha sasa (kwa siku)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_perday" placeholder="Kipato kwa siku"/>
                                         </div>
                                       </div>


                                       <div class="col-md-2">
                                         <div class="form-group">
                                           <label for="income_perweek" class="text-black">Kipato cha sasa (kwa wiki)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_perweek" placeholder="Kipato cha sasa (kwa wiki)"/>
                                         </div>
                                       </div>
                                       <div class="col-md-2">
                                         <div class="form-group">
                                           <label for="income_permonth" class="text-black">Kipato cha sasa (kwa mwezi)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_permonth" placeholder="Kipato cha sasa (kwa mwezi)"/>
                                         </div>
                                       </div>
                                       <div class="col-md-2">
                                         <div class="form-group">
                                           <label for="income_peryear" class="text-black">Kipato cha sasa (kwa mwaka)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_peryear" placeholder="Kipato cha sasa (kwa mwaka)"/>
                                         </div>
                                       </div>
                                    </div>

                                    <div class="form-group mb-4">
                                      <label for="other_properties" class="text-black">Mali nyinginezo</label>
                                        <textarea  class="form-control" name="other_properties" placeholder="Mali nyinginezo"/></textarea>
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
                                             <input type="text"  class="form-control form-control-lg" name="debpt_organization" placeholder="Taasisi"/>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="clear_date" class="text-black">Tarehe ya kumaliza</label>
                                             <input type="date"  class="form-control form-control-lg" name="clear_date" placeholder="Tarehe ya kumaliza"/>
                                         </div>
                                       </div>


                                    </div>


                                    <div class="row mb-4">


                                       <div class="col-md-8">
                                         <h5 class="text-black"> Eneo la makazi</h5>
                                           <div class="row">

                                             <div class="col-4">
                                               <div class="form-group">
                                                   <select class="form-select form-select-lg" name="region">
                                                        <option selected disabled>Mkoa</option>
                                                        <option value="Arusha">Arusha</option>
                                                   </select>
                                               </div>
                                             </div>



                                             <div class="col-4">
                                               <div class="form-group">
                                                   <select class="form-select form-select-lg" name="district">
                                                        <option selected disabled>Wilaya</option>
                                                        <option value="Arusha">Manispaa ya Arusha</option>
                                                   </select>
                                               </div>
                                             </div>

                                             <div class="col-4">
                                               <div class="form-group">
                                                   <select class="form-select form-select-lg" name="ward">
                                                        <option selected disabled>Kata</option>
                                                        <option value="Arusha">Arusha Mikindani</option>
                                                   </select>
                                               </div>
                                             </div>



                                           </div>
                                       </div>




                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="phone" class="text-black">Namba ya simu</label>
                                             <input type="text"  class="form-control form-control-lg" name="phone" placeholder="Namba ya simu"/>
                                         </div>
                                       </div>
                                    </div>


                                </div>
                                <button type="button" name="next" class="float-end btn btn-success next action-button me-md-5"/>Hifadhi na Endelea <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>

                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
