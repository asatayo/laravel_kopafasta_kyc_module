@extends('kycmodule::layouts.master')

@section('content')

<div class="container-fluid p-md-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3">
              <h6>SOMA KWA MAKINI MAELEKEZO YANAYOHUSU UJAZAJI WA FOMU HII YALIYOAMBATANISHWA</h6>
                <h6 class="text-black mt-3">INGIZA TAARIFA BINAFSI</h6>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" class="form" method="POST" action="{{route('addCustomer')}}">
                          @csrf
                            <fieldset>
                                <div class="form-card">

                                  <div class="form-group mb-1 form-message">

                                  </div>



                                      <div class="row">
                                        <div class="d-flex flex-row">
                                                <h5 class="text-black me-3">Madeni ya mikopo mingine </h5>
                                        </div>

                                        <div class="mb-1">

                                        </div>
                                      </div>
                                    <div class="row mb-4">
                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="first_name" class="text-black">Jina la kwanza*</label>
                                             <input type="text"  class="form-control form-control-lg" name="first_name" placeholder="Jina la kwanza"/>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="middle_name" class="text-black">Jina la kati*</label>
                                             <input type="text"  class="form-control form-control-lg" name="middle_name" placeholder="Jina la kati*"/>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="surname" class="text-black">Jina la ukoo*</label>
                                             <input type="text"  class="form-control form-control-lg" name="surname" placeholder="Jina la ukoo*"/>
                                         </div>
                                       </div>


                                    </div>


                                    <div class="row mb-4">


                                       <div class="col-md-9">
                                           <div class="row">

                                             <div class="col-4">
                                               <div class="form-group">
                                                 <label for="identity_type" class="text-black mb-3">Chagua aina ya kitambulisho</label>
                                                   <select class="form-select form-select-lg" name="identity_type">
                                                     <option value="NIDA">NIDA</option>
                                                     <option value="Voter ID">Kitambulisho cha kura</option>
                                                     <option value="Driving Licence">Leseni ya udereva</option>
                                                   </select>
                                               </div>
                                             </div>



                                             <div class="col-md-4">
                                               <div class="form-group">
                                                 <label for="identity" class="text-black mb-3">Ingiza namba ya kitambulisho*</label>
                                                   <input type="text"  class="form-control form-control-lg" name="identity" placeholder="Ingiza namba ya kitambulisho"/>
                                               </div>
                                             </div>

                                             <div class="col-md-4">
                                               <div class="form-group">
                                                 <label for="identity_copy" class="text-black mb-3">Pakia kopi ya kitambulisho*</label>
                                                   <input type="file"  class="form-control form-control-lg" name="identity_copy" placeholder="Pakia kopi ya kitambulisho*"/>
                                               </div>
                                             </div>



                                           </div>
                                       </div>




                                       <div class="col-md-3 form-group">
                                         <label for="dob" class="text-black mb-3">Tarehe ya kuzaliwa*</label>

                                          <div class="row">

                                            <div class="col-4">
                                              <div class="form-group">
                                                  <select class="form-select form-select-lg" name="day">
                                                       <option disabled>Tarehe</option>
                                                       @for($i=1; $i<=31; $i++)
                                                          <option value="{{$i}}">{{$i}}</option>
                                                       @endfor
                                                  </select>
                                              </div>
                                            </div>

                                            <div class="col-4">
                                              <div class="form-group">
                                                  <select class="form-select form-select-lg" name="month">
                                                       <option disabled>Mwezi</option>
                                                       @for($i=1; $i<=12; $i++)
                                                          <option value="{{$i}}">{{$i}}</option>
                                                       @endfor
                                                  </select>
                                              </div>
                                            </div>


                                            <div class="col-4">
                                              <div class="form-group">
                                                  <select class="form-select form-select-lg" name="year">
                                                       @php $increment = Carbon\Carbon::now()->format('Y') - 18; @endphp
                                                       <option disabled>Mwaka</option>
                                                       @for($year=1950; $year<=$increment; $year++)
                                                          <option value="{{$year}}">{{$year}}</option>
                                                       @endfor
                                                  </select>
                                              </div>
                                            </div>


                                          </div>
                                       </div>
                                    </div>


                                    <div class="row mb-4">

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
                                            <small class="fw-bold marital_error"></small>
                                      </div>
                                    </div>
                                    </div>


                                </div>
                                <button type="submit"  class="float-end btn btn-success me-md-5"/>Hifadhi na Endelea <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>

                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
