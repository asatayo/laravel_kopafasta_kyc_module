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
                                @foreach($mtajipapLoan->other_debts as $key => $debt)
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

             <h4 class="header-title mb-0">Wadhamini</h4>

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
                             </tr>
                         </thead>
                         <tbody>
                           <tbody>
                             @foreach($mtajipapLoan->guarators as $key => $guarator)
                             <tr>
                               <th scope="row">{{ $key+1 }}</th>
                               <td>{{$guarator->first_name}} {{$guarator->middle_name}} {{$guarator->surname}}</td>
                               <td>{{$guarator->identity_type}}</td>
                               <td>{{$guarator->identity}}</td>
                               <td>{{$guarator->relationship}}</td>
                               <td>{{$guarator->phone}}</td>
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

          <h4 class="header-title mb-0">Mapitio</h4>


          <div class="row">

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
                   @foreach($mtajipapLoan->reviews as $key => $review)
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
                <form id="msform" class="form" method="POST" action="{{route('mtajipapReview')}}">
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
                                    <button type="submit"  class="float-end btn btn-success block"/>Tuma <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                                 </div>
                            </div>
                        </div>

                    </fieldset>

                </form>
              </div>
          </div>

      </div> <!-- end card-body-->
  </div> <!-- end card-->
</div>
</div>

</div>
@endsection
