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
                        <form id="msform" class="form" method="POST" action="{{route('mdauLoanOne')}}">
                          @csrf
                          <input type="hidden" name="mdau" value="{{ $mdauLoan->id }}">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="details"><strong>Taarifa za mkopaji</strong></li>
                                <li id="loan"><strong>Mikopo ya nyuma</strong></li>
                                <li id="personal"><strong>Taarifa za wadhamini</strong></li>
                                <li id="vehice-form"><strong>Masharti na vigezo</strong></li>
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
                                              <input type="text"  onkeyup="formatNumber('amount')" class="form-control form-control-lg amount" name="amount" value="{{ !empty($mdauLoan->amount)?$mdauLoan->amount : ''}}" placeholder="Kiasi"/>
                                              <small class="fw-bold amount_error"></small>
                                          </div>
                                        </div>

                                        <div class="col-md-8">
                                          <div class="form-group mb-4">
                                            <label for="amount_words" class="text-black ps-1 mb-1">Kiasi cha mkopo kinachoombwa (Kwa maneno)*</label>
                                              <textarea  class="form-control" name="amount_words" rows="4" placeholder="Kiasi kwa maneno"/>{{ !empty($mdauLoan->amount_words)?$mdauLoan->amount_words : ''}}</textarea>
                                              <small class="fw-bold amount_words_error"></small>
                                          </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                      <div class="form-group mb-4">
                                        <label for="intension" class="text-black">Lengo la mkopo</label>
                                          <textarea  class="form-control" name="intension" placeholder="Lengo la mkopo"/>{{ !empty($mdauLoan->intension)?$mdauLoan->intension : ''}}</textarea>
                                          <small class="fw-bold intension_error"></small>
                                      </div>
                                    </div>

                                    <div class="row mb-4">
                                       <div class="col-md-6">
                                         <div class="form-group">
                                           <label for="work_business" class="text-black">Kazi/Biashara</label>
                                             <input type="text"  class="form-control form-control-lg" name="work_business" value="{{ !empty($mdauLoan->work_business)?$mdauLoan->work_business : ''}}" placeholder="Kazi/Biashara"/>
                                             <small class="fw-bold work_business_error"></small>
                                         </div>
                                       </div>

                                       <div class="col-md-6">
                                         <div class="form-group">
                                           <label for="dependants_count" class="text-black">Idadi ya wategemezi</label>
                                             <input type="text"  class="form-control form-control-lg" name="dependants_count" value="{{ !empty($mdauLoan->dependants_count)?$mdauLoan->dependants_count : ''}}" placeholder="Idadi ya wategemezi"/>
                                             <small class="fw-bold dependants_count_error"></small>
                                         </div>
                                       </div>


                                    </div>



                                    <div class="row mb-4">


                                       <div class="col-md-3">
                                         <div class="form-group">
                                           <label for="income_perday" class="text-black">Kipato cha sasa (kwa siku)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_perday" value="{{ !empty($mdauLoan->income_perday)?$mdauLoan->income_perday : ''}}" placeholder="Kipato kwa siku"/>
                                             <small class="fw-bold income_perday_error"></small>
                                         </div>
                                       </div>


                                       <div class="col-md-3">
                                         <div class="form-group">
                                           <label for="income_perweek" class="text-black">Kipato cha sasa (kwa wiki)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_perweek" value="{{ !empty($mdauLoan->income_perweek)?$mdauLoan->income_perweek : ''}}" placeholder="Kipato cha sasa (kwa wiki)"/>
                                             <small class="fw-bold income_perweek_error"></small>
                                         </div>
                                       </div>
                                       <div class="col-md-3">
                                         <div class="form-group">
                                           <label for="income_permonth" class="text-black">Kipato cha sasa (kwa mwezi)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_permonth" value="{{ !empty($mdauLoan->income_permonth)?$mdauLoan->income_permonth : ''}}" placeholder="Kipato cha sasa (kwa mwezi)"/>
                                             <small class="fw-bold income_permonth_error"></small>
                                         </div>
                                       </div>
                                       <div class="col-md-3">
                                         <div class="form-group">
                                           <label for="income_peryear" class="text-black">Kipato cha sasa (kwa mwaka)</label>
                                             <input type="text"  class="form-control form-control-lg" name="income_peryear" value="{{ !empty($mdauLoan->income_permonth)?$mdauLoan->income_permonth : ''}}" placeholder="Kipato cha sasa (kwa mwaka)"/>
                                             <small class="fw-bold income_peryear_error"></small>
                                         </div>
                                       </div>
                                    </div>

                                    <div class="form-group mb-4">
                                      <label for="other_properties" class="text-black">Mali nyinginezo</label>
                                        <textarea  class="form-control" name="other_properties" placeholder="Mali nyinginezo"/>{{ !empty($mdauLoan->other_properties)?$mdauLoan->other_properties : ''}}</textarea>
                                        <small class="fw-bold other_properties_error"></small>
                                    </div>





                                </div>
                                <button type="submit" class="float-end btn btn-success me-md-5"/>Hifadhi na Endelea <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>

                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
