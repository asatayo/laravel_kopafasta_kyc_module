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
                      @if (\Session::has('message'))
                            <div class="alert alert-info">{{ \Session::get('message') }}</div>
                      @endif


                        <form id="msform" class="form" method="POST" action="{{route('mdauLoanThree')}}">
                          @csrf
                          <input type="hidden" name="mdau" value="{{$mdauLoan->id}}">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="details"><strong>Taarifa za mkopaji</strong></li>
                                <li class="active" id="loan"><strong>Mikopo ya nyuma</strong></li>
                                <li  class="active" id="personal"><strong>Taarifa za wadhamini</strong></li>
                              <li id="vehice-form"><strong>Masharti na vigezo</strong></li>
                            </ul>
                            <!-- fieldsets -->

                             <div class="form-group  px-5">
                               <div class="form-message">

                               </div>
                             </div>

                            <fieldset>
                                <div class="form-card">
                                    <h6 class="fs-title">TAARIFA ZA WADHAMINI</h6>

                                  <div class="row mb-4">
                                     <div class="col-md-4">
                                       <div class="form-group">
                                         <label for="first_name" class="text-black">Jina la kwanza*</label>
                                           <input type="text"  class="form-control form-control-lg" name="first_name" placeholder="Jina la kwanza"/>
                                           <small class="fw-bold first_name_error"></small>
                                       </div>
                                     </div>


                                     <div class="col-md-4">
                                       <div class="form-group">
                                         <label for="middle_name" class="text-black">Jina la kati*</label>
                                           <input type="text"  class="form-control form-control-lg" name="middle_name" placeholder="Jina la kati"/>
                                           <small class="fw-bold middle_name_error"></small>
                                       </div>
                                     </div>


                                     <div class="col-md-4">
                                       <div class="form-group">
                                         <label for="last_name" class="text-black">Jina la mwisho*</label>
                                           <input type="text"  class="form-control form-control-lg" name="last_name" placeholder="Jina la Mwisho"/>
                                           <small class="fw-bold last_name_error"></small>
                                       </div>
                                     </div>
                                  </div>



                      <div class="row mb-4">
                          <div class="col-3">
                                 <div class="form-group">
                                   <label for="clear_date" class="text-black">Chagua aina ya kitambulisho</label>
                                     <select class="form-select form-select-lg" name="identity_type">
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
                                   <label for="identity" class="text-black">Ingiza namba ya kitambulisho*</label>
                                     <input type="text"  class="form-control form-control-lg" name="identity" placeholder="Ingiza namba ya kitambulisho"/>
                                     <small class="fw-bold identity_error"></small>
                                 </div>
                               </div>

                               <div class="col-3">
                                 <div class="form-group">
                                   <label for="identity_copy" class="text-black">Pakia kopi ya kitambulisho*</label>
                                     <input type="file"  class="form-control form-control-lg" name="identity_copy" placeholder="Pakia kopi ya kitambulisho"/>
                                      <small class="fw-bold identity_copy_error"></small>
                                 </div>
                               </div>

                               <div class="col-3">
                                 <div class="form-group">
                                   <label for="phone" class="text-black">Namba ya simu*</label>
                                     <input type="text"  class="form-control form-control-lg" name="phone" placeholder="Namba ya simu"/>
                                       <small class="fw-bold phone_error"></small>
                                 </div>
                               </div>


                         </div>


                            <div class="row mb-4">
                            <div class="col-6">
                              <div class="form-group">
                                <label for="relationship" class="text-black">Mahusiano yako na mdhamini*</label>
                                  <input type="text"  class="form-control form-control-lg" name="relationship" placeholder="Mahusiano yako na mdhamini"/>
                                  <small class="fw-bold relationship_error"></small>
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
                                     <th scope="col">Jina</th>
                                     <th scope="col">Kitambulisho</th>
                                     <th scope="col">Uhusiano</th>
                                      <th scope="col">Action</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                   @foreach($guarators as $key => $guarator)
                                   <tr>
                                     <th scope="row">{{ $key+1 }}</th>
                                     <td>{{$guarator->first_name}} {{$guarator->last_name}}</td>
                                     <td>{{$guarator->identity}}</td>
                                     <td>{{$guarator->relationship}}</td>
                                     <td> <a class="btn btn-danger float-end me-5" href="{{url('kycmodule/loan/mdau/guarator-delete', [$mdauLoan->id,$guarator->id])}}">Delete</a> </td>

                                   </tr>
                                   @endforeach
                                 </tbody>
                               </table>
                            </div>
                            <a href="{{ url('kycmodule/loan/mdau',[$mdauLoan->id, 'step-four']) }}"  class="float-end btn btn-success me-md-5"/> Hakiki na Hifadhi <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
