@extends('kycmodule::layouts.master')
@section('content')
<div class="container-fluid p-md-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3">
               <h4>FOMU YA MTAJIPAP</h4>
              <h6>SOMA KWA MAKINI MAELEKEZO YANAYOHUSU UJAZAJI WA FOMU HII YALIYOAMBATANISHWA</h6>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" class="form" method="POST" action="{{route('mtajipapLoanFour')}}">
                          @csrf
                          <input type="hidden" name="mtajipap" value="{{$mtajipapLoan->id}}">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="details"><strong>Taarifa za mkopaji</strong></li>
                                <li class="active"id="loan"><strong>Mikopo ya nyuma</strong></li>
                                <li class="active"id="personal"><strong>Taarifa za wadhamini</strong></li>
                                <li class="active" id="vehice-form"><strong>Maoni ya mamlaka(ofisi ya soko)</strong></li>
                            </ul>
                            <!-- fieldsets -->

                             <div class="form-group  px-5">
                               <div class="form-message">

                               </div>
                             </div>
                            <fieldset>
                                <div class="form-card">
                                    <h6 class="fs-title">TAARIFA ZA SOKO</h6>


                                    <div class="row mb-4">

                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="market_manager_name" class="text-black">Jina la msimamizi wa soko*</label>
                                            <input type="text"  class="form-control form-control-lg" value="{{$mtajipapLoan->market_manager_name}}" name="market_manager_name" placeholder="Jina la msimamizi wa soko"/>
                                               <small class="fw-bold market_manager_name_error"></small>
                                        </div>
                                      </div>



                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="title" class="text-black">Cheo*</label>
                                             <input type="text"  class="form-control form-control-lg"  value="{{$mtajipapLoan->title}}" name="title" placeholder="Title"/>
                                                <small class="fw-bold title_error"></small>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="market_name" class="text-black">Jina la Soko*</label>
                                             <input type="text"  class="form-control form-control-lg" value="{{$mtajipapLoan->market_name}}" name="market_name" placeholder="Market name"/>
                                                <small class="fw-bold market_name_error"></small>
                                         </div>
                                       </div>



                                    </div>


                                    <div class="row mb-4">


                                       <div class="col-md-8">
                                         <h5 class="text-black"> Eneo la soko lilipo</h5>
                                           <div class="row">

                                             <div class="col-4">
                                               <div class="form-group">
                                                   <select class="form-select form-select-lg" name="region">
                                                        <option selected disabled>Mkoa</option>
                                                        <option value="Arusha">Arusha</option>
                                                   </select>
                                                   <small class="fw-bold region_error"></small>
                                               </div>
                                             </div>



                                             <div class="col-4">
                                               <div class="form-group">
                                                   <select class="form-select form-select-lg" name="district">
                                                        <option selected disabled>Wilaya</option>
                                                        <option value="Arusha">Manispaa ya Arusha</option>
                                                   </select>
                                                   <small class="fw-bold district_error"></small>
                                               </div>
                                             </div>

                                             <div class="col-4">
                                               <div class="form-group">
                                                   <select class="form-select form-select-lg" name="ward">
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
                                           <label for="market_manager_phone" class="text-black">Namba ya simu ya msimamizi wa soko *</label>
                                             <input type="text"  class="form-control form-control-lg" name="market_manager_phone" placeholder="Namba ya simu ya msimamizi wa soko"/>
                                             <small class="fw-bold market_manager_phone_error"></small>
                                         </div>
                                       </div>
                                    </div>


  

                           <div class="row mb-4">
                                 <div class="col-md-4">
                                     <div class="form-group">
                                       <label for="market_leadership_letter" class="text-black">Pakia barua kutoka kwenye uongozi wa soko *</label>
                                         <input type="file"  class="form-control form-control-lg" name="market_leadership_letter"/>
                                         <small class="fw-bold market_leadership_letter_error"></small>
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
