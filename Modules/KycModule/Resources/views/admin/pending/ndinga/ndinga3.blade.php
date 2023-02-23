@extends('kycmodule::layouts.admin-master')
@section('content')
<div class="container-fluid py-5 px-md-5 modified-container">






                            <div class="row mt-5 bg-white">
                              <h4>Mikopo ya hivi karibuni</h4>
                              <table class="table table-bordered">
                                 <thead>
                                   <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">Jina</th>
                                     <th scope="col">Kiasi</th>
                                     <th scope="col">Kitambulisho</th>
                                     <th scope="col">Uhusiano</th>
                                      <th scope="col">Action</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                   @foreach($ndingaLoans as $key => $ndingaLoan)
                                   <tr>
                                     <th scope="row">{{ $key+1 }}</th>
                                     <td>{{$ndingaLoan->customer->first_name}} {{$ndingaLoan->customer->middle_name}} {{$ndingaLoan->customer->surname}}</td>
                                     <td>{{ number_format($ndingaLoan->amount)}}</td>
                                     <td>{{$ndingaLoan->customer->identity}}</td>
                                     <td>{{$ndingaLoan->customer->phone}}</td>
                                     <td>
                                        @if($ndingaLoan->is_reviewed)
                                         <a class="btn btn-secondary float-end me-5" href="{{url('kycmodule/admin/loan/ndinga/more',[$ndingaLoan->id])}}"> View more</a>
                                        @else
                                        <a class="btn btn-success float-end me-5" href="{{url('kycmodule/admin/loan/ndinga/review',[$ndingaLoan->id])}}">Review</a>

                                        @endif
                                     </td>

                                   </tr>
                                   @endforeach
                                 </tbody>
                               </table>
                            </div>

</div>
@endsection
