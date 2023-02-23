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
                        <form id="msform" class="form" method="POST" action="{{route('mdauLoanTwo')}}">
                          @csrf
                          <input type="hidden" name="mdau" value="{{$mdauLoan->id}}">

                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="details"><strong>Taarifa za mkopaji</strong></li>
                                <li class="active" id="loan"><strong>Mikopo ya nyuma</strong></li>
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
                                    <h6 class="fs-title">MIKOPO YA NYUMA</h6>


                                    <div class="row mb-4" id="debt_field">
                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="debt_amount" class="text-black">Kiasi</label>
                                             <input type="number"  class="form-control form-control-lg" name="debt_amount" placeholder="Kiasi"/>
                                               <small class="fw-bold debt_amount_error"></small>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="debt_institution" class="text-black">Taasisi</label>
                                             <input type="text"  class="form-control form-control-lg" name="debt_institution" placeholder="Taasisi"/>
                                                <small class="fw-bold debt_institution_error"></small>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="clear_date" class="text-black">Tarehe ya kumaliza</label>
                                             <input type="date"  class="form-control form-control-lg" name="clear_date" placeholder="Tarehe ya kumaliza"/>
                                               <small class="fw-bold clear_date_error"></small>
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
                                           <label for="phone" class="text-black">Namba ya simu</label>
                                             <input type="text"  class="form-control form-control-lg" name="phone" placeholder="Namba ya simu"/>
                                             <small class="fw-bold phone_error"></small>
                                         </div>
                                       </div>
                                    </div>


                                    <div class="row mb-4">

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="registration_number" class="text-black">Namba ya usajii Kopafasta (kama ulishasajiliwa)</label>
                                          <input type="text"  class="form-control form-control-lg" name="registration_number" placeholder="Namba ya usajii Kopafasta"/>
                                          <small class="fw-bold registration_number_error"></small>
                                      </div>
                                    </div>
                                  </div>




                                </div>
                                <a href="{{URL::previous()}}"  class="float-start btn btn-success ms-md-5"/><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Rundi Nyuma</a>
                                  <button type="submit" class="float-end btn btn-success me-md-5"/>Hifadhi <i class="fa fa-plus" aria-hidden="true"></i></button>

                            </fieldset>

                            <div class="row mt-5">
                              <table class="table">
                                 <thead>
                                   <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">Kiasi</th>
                                     <th scope="col">Taasisi</th>
                                     <th scope="col">Tarehe ya kumaliza</th>
                                      <th scope="col">Action</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                   @foreach($mdauOtherDebts as $key => $mdauOtherDebt)
                                   <tr>
                                     <th scope="row">{{ $key+1 }}</th>
                                     <td>{{$mdauOtherDebt->amount}}</td>
                                     <td>{{$mdauOtherDebt->debt_institution}}</td>
                                     <td>{{ Carbon\Carbon::parse($mdauOtherDebt->finish_date)->format('Y-m-d')}}</td>
                                     <td> <a class="btn btn-danger" href="{{url('kycmodule/loan/mdau/debt-delete', [$mdauLoan->id,$mdauOtherDebt->id])}}">Delete</a> </td>

                                   </tr>
                                   @endforeach
                                 </tbody>
                               </table>
                            </div>
                            <a href="{{ url('kycmodule/loan/mdau',[$mdauLoan->id, 'step-three']) }}"  class="float-end btn btn-success me-md-5"/> Hakiki na Hifadhi <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
