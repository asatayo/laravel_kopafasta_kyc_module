@extends('kycmodule::layouts.admin-master')

@section('content')

<div class="container-fluid p-md-5">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-5 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3">
              <h6>TENGEZA HATUA</h6>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <form id="msform" class="form" method="POST" action="{{route('addStep')}}">
                          @csrf
                            <fieldset>
                                <div class="form-card">

                                  <div class="form-group mb-1 form-message">

                                  </div>
                                    <div class="row mb-4">
                                       <div class="col-md-4">
                                         <div class="form-group">
                                           <label for="name" class="text-black mb-3">Jina la hatua</label>
                                             <input type="text"  class="form-control form-control-lg" name="name" placeholder="Jin la hatua"/>
                                             <small class="fw-bold name_error"></small>
                                         </div>
                                       </div>




                                       <div class="col-4">
                                         <div class="form-group">
                                           <label for="operator" class="text-black mb-3">Jina la msimamizi</label>
                                             <select class="form-select form-select-lg" name="operator">
                                               @foreach($users as $user)
                                                 <option value="{{$user->id}}">{{$user->name}}</option>
                                              @endforeach
                                             </select>
                                             <small class="fw-bold operator_error"></small>
                                         </div>
                                       </div>


                                       <div class="col-4">
                                         <div class="form-group">
                                           <label for="operator" class="text-black mb-3">Jina la kundi</label>
                                             <select class="form-select form-select-lg" name="category">
                                               @foreach($categories as $category)
                                                 <option value="{{$category->id}}">{{$category->name}}</option>
                                              @endforeach
                                             </select>
                                             <small class="fw-bold category_error"></small>
                                         </div>
                                       </div>


                                    </div>
                                    <button type="submit"  class="float-end btn btn-success"/>Tengeneza <i class="fa fa-plus" aria-hidden="true"></i></button>





                                </div>

                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
