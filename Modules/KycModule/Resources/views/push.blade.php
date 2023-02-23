@extends('layouts.admin.dashboard')
@section('title', 'Welcome')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-12 mb-4 order-0">
      <div class="card">
          <div class="card-body">


              <div class="d-flex align-items-center row">


                    <div class="col-md-12 d-flex justify-content-end">
                       <a href="{{url('admin/offers/push/custom')}}" class="btn btn-secondary"> <i class="fa fa-crown"></i> Send customized message </a>
                    </div>

                  <div class="col-sm-7">


              <!-- <div class="card-title d-flex justify-content-between">

                <div class="me dropdown">
                  <button
                    class="btn p-0"
                    type="button"
                    id="cardOpt1"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="cardOpt1">
                    <a class="dropdown-item" href="{{url('admin/customers/view')}}">View customers</a>
                    <a class="dropdown-item" href="{{url('admin/customers/more')}}">More</a>
                  </div>
                </div>
              </div> -->




              <h3 class="card-title text-primary">Send generalized message</h3>



                <form role="form" method="post" class="form" action="{{route('pushOffer')}}" enctype="multipart/form-data">
                @csrf


           <div class="row">

             <div class="col-md-12">

                            <div class="form-group p-2">
                          <label for="title" class="form-label">Title</label>
                          <input type="text" class="form-control" name="title" maxlength="30" placeholder="Message title, this will apply to notification only">
                          <small class="input-error title_error"></small>

                        </div>

                        <div class="form-group p-2">
                          <label for="body" class="form-label">Body</label>
                          <textarea class="form-control" name="body" maxlength="256" placeholder="Type your message to customer not exceedibng 256 characters"rows="4" ></textarea>
                          <small class="input-error body_error"></small>

                        </div>

                        <div class="form-group p-2">
                            <label for="photo" class="form-label">Icon</label>
                            <input class="form-control" type="file" name="icon" id="icon" />
                            <small class="input-error photo_error"></small>
                        </div>

                        <div class="form-group p-2">
                          <div class="mt-3 form-message"></div>
                        </div>

                        <div class="form-group p-2">
                          <button type="submit" class="btn btn-warning float-right">
                             Publish <i class="fa fa-gift" aria-hidden="true"></i>
                          </button>
                        </div>

             </div>
           </div>
           </form>
          </div>
          <div class="col-sm-4 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src="{{asset('icons/offer.gif')}}"
                height="200"
                alt=""
                data-app-dark-img="{{asset('icons/offer.gif')}}"
                data-app-light-img="{{asset('icons/offer.gif')}}"
              />
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>

  </div>

</div>
<!-- / Content -->
@endsection
