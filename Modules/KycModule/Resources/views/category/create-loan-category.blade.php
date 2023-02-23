@extends('kycmodule::layouts.admin-master')
@section('content')
<div class="container-fluid p-md-5 background-field" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3">
              <h6>SOMA KWA MAKINI MAELEKEZO YANAYOHUSU UJAZAJI WA FOMU HII YALIYOAMBATANISHWA</h6>
                <h6 class="text-black mt-3">INGIZA TAARIFA BINAFSI</h6>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" class="form" method="POST" action="{{route('addCategory')}}">
                          @csrf
                            <fieldset>
                                <div class="form-card">

                                  <div class="form-group mb-1 form-message">

                                  </div>



                                      <div class="row">
                                        <div class="d-flex flex-row">
                                                <h5 class="text-black me-3">Sajili aina ya mkopo</h5>
                                        </div>

                                        <div class="mb-1">

                                        </div>
                                      </div>
                                    <div class="row mb-4">
                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="name" class="text-black">Jina la mkopo*</label>
                                             <input type="text"  class="form-control form-control-lg" name="name" placeholder="Jina la mkopo"/>
                                             <small class="fw-bold name_error"></small>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="maximum" class="text-black">Kiwango cha cha juu cha mkopo </label>
                                             <input type="number"  class="form-control form-control-lg" name="maximum" placeholder="Kiwango cha juu cha mkopo*"/>
                                             <small class="fw-bold maximum_error"></small>
                                         </div>
                                       </div>


                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="minimum" class="text-black">Kiwango cha chini cha mkopo*</label>
                                             <input type="number"  class="form-control form-control-lg" name="minimum" placeholder="Kiwango cha chini cha mkopo*"/>
                                             <small class="fw-bold minimum_error"></small>
                                         </div>
                                       </div>


                                    </div>


                                    <div class="row mb-4">


                                       <div class="col-md-12">
                                         <div class="form-group mb-4">
                                           <label for="description" class="text-black">Maelezo ya ziada</label>
                                             <textarea  class="form-control" name="description" placeholder="Maelezo ya ziada ya mkopo"/></textarea>
                                             <small class="fw-bold description_error"></small>
                                         </div>
                                       </div>

                                    </div>

                                    <div class="row">
                                      <label for="steps" class="text-black">Verification steps</label>

                                        @foreach($steps as $step)

                                                  <div class="col-md-3">
                                                  <div class="form-check">
                                                    <input class="form-check-input" name="steps[]" value="{{$step->id}}"  type="checkbox" id="id{{$step->id}}">
                                                    <label class="form-check-labe mt-1" for="id{{$step->id}}">
                                                      {{$step->name}}
                                                    </label>
                                                  </div>
                                                  </div>

                                            @endforeach
                                             <small class="fw-bold steps_error"></small>
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
