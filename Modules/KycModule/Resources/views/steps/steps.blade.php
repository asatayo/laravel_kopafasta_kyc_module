@extends('kycmodule::layouts.admin-master')

@section('content')

<div class="container-fluid p-md-5" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-5 mt-3 mb-2">
            <div class="card-d px-0 pt-4 pb-0 mt-3 mb-3">
              <h6>HATUA ZILIZOPO</h6>
                <div class="row">
                    <div class="col-md-8 offset-md-2">


                      <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Jina</th>
                                      <th scope="col">Msimamizi</th>
                                      <th scope="col">Kundi</th>
                                        <th scope="col">Zaidi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                     @foreach($steps as $key => $step)
                                    <tr>
                                      <th scope="row">{{$key+1}}</th>
                                      <td>{{$step->name}}</td>
                                      <td>{{$step->user->name}}</td>
                                      <td>{{$step->category->name}}</td>
                                      <td> <a href="{{url('kycmodule/step/delete',[$step->id])}}" class="btn btn-danger">Delete</a> </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                              </table>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
