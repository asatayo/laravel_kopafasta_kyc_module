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
                                   @foreach($mtajipapLoans as $key => $mtajipapLoan)
                                   <tr>
                                     <th scope="row">{{ $key+1 }}</th>
                                     <td>{{$mtajipapLoan->customer->first_name}} {{$mtajipapLoan->customer->middle_name}} {{$mtajipapLoan->customer->surname}}</td>
                                     <td>{{ number_format($mtajipapLoan->amount)}}</td>
                                     <td>{{$mtajipapLoan->customer->identity}}</td>
                                     <td>{{$mtajipapLoan->customer->phone}}</td>
                                     <td>
                                        @if($mtajipapLoan->is_reviewed)
                                         <a class="btn btn-secondary float-end me-5" href="{{url('kycmodule/admin/loan/mtajipap/more',[$mtajipapLoan->id])}}"> View more</a>
                                        @else
                                        <a class="btn btn-success float-end me-5" href="{{url('kycmodule/admin/loan/mtajipap/review',[$mtajipapLoan->id])}}">Review</a>

                                        @endif
                                     </td>

                                   </tr>
                                   @endforeach
                                 </tbody>
                               </table>
                            </div>

</div>
@endsection
