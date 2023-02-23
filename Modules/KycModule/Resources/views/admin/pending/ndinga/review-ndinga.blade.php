@extends('kycmodule::layouts.admin-master')
@section('content')
<div class="container-fluid py-5 px-md-5 modified-container">

   <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-0">Mikopo mingine </h4>

                <div id="cardCollpase4" class="collapse show">
                    <div class="table-responsive pt-3">
                        <table class="table table-centered table-nowrap table-borderless mb-0">
                            <thead class="table-light">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Kiasi</th>
                                  <th scope="col">Taasisi</th>
                                  <th scope="col">Simu</th>
                                  <th scope="col">Tarehe ya kumaliza</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ndingaLoan->other_debts as $key => $debt)
                                 <tr>
                                   <th scope="row">{{ $key+1 }}</th>
                                   <td>{{$debt->amount}}</td>
                                   <td>{{$debt->debt_institution}}</td>
                                   <td>{{$debt->phone}}</td>
                                   <td>{{$debt->finish_date}}</td>
                                 </tr>
                                 @endforeach
                            </tbody>
                        </table>
                    </div> <!-- .table-responsive -->
                </div> <!-- end collapse-->
            </div> <!-- end card-body-->
        </div> <!-- end card-->
      </div>
   </div>

   <div class="row">
   <div class="col-md-12">
     <div class="card">
         <div class="card-body">

             <h4 class="header-title mb-0">Gurantors</h4>

             <div id="cardCollpase4" class="collapse show">
                 <div class="table-responsive pt-3">
                     <table class="table table-centered table-nowrap table-borderless mb-0">
                         <thead class="table-light">
                             <tr>
                               <th scope="col">#</th>
                               <th scope="col">Jina</th>
                               <th scope="col">Aina</th>
                               <th scope="col">Kitambulisho</th>
                               <th scope="col">Uhusiano</th>
                              <th scope="col">Simu</th>
                               <th scope="col">Nida</th>
                             </tr>
                         </thead>
                         <tbody>
                           <tbody>
                             @foreach($ndingaLoan->guarators as $key => $guarator)
                             <tr>
                               <th scope="row">{{ $key+1 }}</th>
                               <td>{{$guarator->first_name}} {{$guarator->middle_name}} {{$guarator->surname}}</td>
                               <td>{{$guarator->identity_type}}</td>
                               <td>{{$guarator->identity}}</td>
                               <td>{{$guarator->relationship}}</td>
                               <td>{{$guarator->phone}}</td>
                               
                                <td> <a href="{{ url($guarator->identity_path)}}" download>Nida file</a> </td>
                             </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div> <!-- .table-responsive -->
             </div> <!-- end collapse-->
         </div> <!-- end card-body-->
     </div> <!-- end card-->
   </div>
</div>

<div class="row">
   <div class="col-md-12">
     <div class="card">
         <div class="card-body">

             <h4 class="header-title mb-0">Vehicle</h4>

             <div id="cardCollpase4" class="collapse show">
                 <div class="table-responsive pt-3">
                     <table class="table table-centered table-nowrap table-borderless mb-0">
                         <thead class="table-light">
                             <tr>
                               <th scope="col">Vehicle name</th>
                               <th scope="col">Type</th>
                               <th scope="col">RegNo.</th>
                               <th scope="col">Chasis No.</th>
                               <th scope="col">Color</th>
                              <th scope="col">Model</th>
                               <th scope="col">Nida</th>
                               
                                <th scope="col">1st Photo</th>
                               <th scope="col">2nd Photo</th>
                                <th scope="col">3rd Photo</th>
                               <th scope="col">4th Photo</th>
                             </tr>
                         </thead>
                         <tbody>
                           <tbody>
                           
                             <tr>
                              
                               <td>{{$ndingaLoan->vehicle_name}} </td>
                               <td>{{$ndingaLoan->vehicle_type}}</td>
                               <td>{{$ndingaLoan->vehicle_registration_number}}</td>
                               <td>{{$ndingaLoan->vehicle_chassis_number}}</td>
                               <td>{{$ndingaLoan->vehicle_color}}</td>
                               <td>{{$ndingaLoan->vehicle_model}}</td>
                                <td> <a href="{{ url($ndingaLoan->first_vehicle_photo)}}" download>First Photo</a> </td>
                                <td> <a href="{{ url($ndingaLoan->second_vehicle_photo)}}" download>Second photo</a> </td>
                                <td> <a href="{{ url($ndingaLoan->third_vehicle_photo)}}" download>Third photo</a> </td>
                                <td> <a href="{{ url($ndingaLoan->fourth_vehicle_photo)}}" download>Fourth photo</a> </td>
                             </tr>
                           
                         </tbody>
                     </table>
                 </div> <!-- .table-responsive -->
             </div> <!-- end collapse-->
         </div> <!-- end card-body-->
     </div> <!-- end card-->
   </div>
</div>


<div class="row">
<div class="col-md-12">
  <div class="card">
      <div class="card-body">

          <h4 class="header-title mb-0">Mapitio</h4>


          <div class="row">

            @if ($ndingaLoan->is_bottom_reviewed)

            <div class="col-md-6">
              <table class="table table-bordered">
                 <thead>
                   <tr>
                     <th scope="col">#</th>
                     <th scope="col">Mapendelezo</th>
                     <th scope="col">Ilikubaliwa</th>
                     <th scope="col">Hali</th>
                     <th scope="col">Tarehe</th>
                   </tr>
                 </thead>
                 <tbody>
                   @foreach($ndingaLoan->reviews as $key => $review)
                   <tr>
                     <th scope="row">{{ $key+1 }}</th>
                     <td>{{$review->review}}</td>
                     <td>{{ $review->is_accepted? 'Ndiyo': 'Hapana'}}</td>
                     <td>{{ $review->is_reviewed? 'Tayari': 'Bado'}}</td>
                     <td>{{$review->created_at}}</td>
                   </tr>
                   @endforeach
                 </tbody>
               </table>
            </div>
              <div class="col-md-6 mx-0 px-5">

                <form id="msform" class="form" method="POST" action="{{route('ndingaReview')}}">
                  @csrf
                    <fieldset>
                        <div class="form-card">
                          <h6 class="text-center text-black">CHAGUA HATUA KUFANYA MAPITIO</h6>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                  <div class="form-group mb-1 form-message">

                                  </div>

                                  <div class="form-group mb-4">
                                    <select class="form-select form-select-lg" name="review">
                                           @foreach($pending_reviews  as $pending_review)
                                                <option value="{{$pending_review->id}}">{{$pending_review->step->name}}</option>
                                           @endforeach
                                    </select>
                                      <small class="fw-bold review_error"></small>
                                  </div>

                                  <div class="form-group mb-4">
                                      <textarea name="description" class="form-control"  placeholder="Andima mapendekezo"></textarea>
                                      <small class="fw-bold description_error"></small>

                                  </div>

                                  <div class="form-group">
                                     <div class="form-group py-2">
                                       <div class="form-check form-check-inline">
                                             <input class="form-check-input text-black" type="radio" name="is_accepted" id="is_accepted1" value="1">
                                             <label class="form-check-label text-black" for="is_accepted1">Imekubaliwa</label>
                                       </div>

                                       <div class="form-check form-check-inline">
                                             <input class="form-check-input text-black" type="radio" name="is_accepted" id="is_accepted2" value="0">
                                             <label class="form-check-label text-black" for="is_accepted2">Imekataliwa</label>
                                       </div>
                                     </div>
                                     <small class="fw-bold is_accepted_error"></small>
                               </div>





                                 </div>
                                 <div class="form-group">

                                    <button type="submit"  class="float-end btn btn-success block"/>{{$ndingaLoan->is_reviewed? 'Tuma tena': 'Tuma'}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                 </div>
                            </div>
                        </div>

                    </fieldset>

                </form>

              </div>
              @else

              @if($ndingaLoan->is_completed)
                <div class="col-md-12 p-2">
                  <div class="alert alert-warning" role="alert"><strong>Taarifa</strong><br><i>Samahani, kwa sasa mteja huyu amekwisha hudumiwa huwezi kubadili taarifa hizi kwa sasa. </i></div>
                </div>

                @else
                  <div class="col-md-12 p-2">
                    <div class="alert alert-warning" role="alert"><strong>Taarifa</strong><br>Samahani, kwa sasa hatua hii inafanyiwa kazi na msimamizi mwingine, hutoweza kubadili taarifa hii tafadhali wasiliana na msimizi <i><strong>{{$ndingaLoan->reviewer_name->name}}</strong></i></div>
                  </div>
                @endif

              @endif
          </div>

      </div> <!-- end card-body-->
  </div> <!-- end card-->
</div>
</div>

</div>
@endsection
