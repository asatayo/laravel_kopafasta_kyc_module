@extends('kycmodule::layouts.admin-master')
@section('content')

<div class="container-fluid p-5">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3">

              <div class="form-message">

              </div>

                <div class="row">
                   @foreach($categories as $category)
                    <div class="col-md-6 mx-0 remove_class-{{$category->id}}">

                      <div class="card p-2">
                          <img class="card-img-top" src="{{asset('modules/kycmodule/img/logo-h.png')}}"  alt="Card image cap">
                          <div class="card-body">
                            <h5 class="card-title">{{$category->name}}</h5>
                            <p class="card-text">{{$category->description}}.</p>
                          </div>
                          <ul class="list-group list-group-flush">
                             @foreach($category->steps as $step)
                                <li class="list-group-item">{{$step->name}} <strong>{{$step->user->name}}</strong> </li>
                             @endforeach
                          </ul>
                          <div class="card-body">
                            <a href="{{url('kycmodule/loan-category/more',[$category->id])}}" class="card-link">View more</a>
                            <a href="{{url('kycmodule/loan-category/edit',[$category->id])}}" class="card-link">Edit</a>
                            <form class="validate-form mt-5" action="{{route('deleteCategory')}}" method="post">
                              @csrf
                                <input type="hidden" name="confirm-msg" value="Je unataka kuondoa kundi hili">
                                <input type="hidden" name="category" value="{{$category->id}}">
                                <input type="hidden" name="remove_class" value="remove_class-{{$category->id}}">


                                <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                          </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
