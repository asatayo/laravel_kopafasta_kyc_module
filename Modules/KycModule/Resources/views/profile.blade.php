@extends('kycmodule::layouts.master')

@section('content')

<div class="container-fluid p-md-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3">
              <h6>WEKA PICHA YAKO ULIYOPOIGA NA KITAMBULISHO KUTHIBITISHA USAJILI WAKO</h6>
                <h6 class="text-black mt-3">INGIZA TAARIFA BINAFSI</h6>
                <div class="row justify-content-center">
                    <div class="col-md-8 mx-0">
                        <form id="msform" class="form" method="POST" action="{{route('uploadProfile')}}">
                          @csrf
                            <fieldset>
                                <div class="form-card">

                                    <div class="row mb-4">
                                       <div class="col-md-4 bg-white selected-profile">
                                         <img id="img" src="{{asset(!empty(Auth::guard('customer')->User()->profile_path)? Auth::guard('customer')->User()->profile_path: 'modules/kycmodule/img/profile.png')}}" class="img-fluid"/>
                                       </div>

                                       <div class="col-md-8 p-5">
                                         <div class="form-group mb-1 form-message">

                                         </div>

                                         <div class="form-group d-flex flex-column profile">
                                           <label for="photo" class="text-black">Pakia Picha</label>
                                                 <input type="file" name="photo" id="photo" />
                                                 <button type="button" id="photo_btn" class="mt-1 btn bg-white upload-btn float-none"><small class="text-muted">JPG, PNG or PDF, faili lisizidi 10mb</small>  <i class="fa fa-cloud-upload"></i> </button>

                                         </div>

                                         <div class="form-group d-flex flex-column mt-5 profile">
                                           <label for="camera" class="text-black">Piga Picha</label>
                                                 <button type="button" id="camera_btn" class="mt-1 camera-btn btn btn-white float-none"><small class="text-success"></small>  <i class="fa fa-camera text-success fa-2xl"></i> </button>
                                                 <input type="file" accept="image/*" capture="camera" name="camera" id="camera" />
                                         </div>
                                       </div>

                                    </div>




                                </div>
                                <button type="submit"  class="float-end btn btn-success me-md-5"/>Pakia <i class="fa fa-upload" aria-hidden="true"></i></button>

                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
