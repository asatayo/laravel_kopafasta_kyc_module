@extends('kycmodule::layouts.admin-master')

@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img src="{{ asset('modules/kycmodule/assets/images/icons/1.png') }}" class="img-fluid rounded-circle" alt="user-img">
                                    </div>
                                </div>
                                <div class="col">
                                    <h5 class="mb-1 mt-2 font-16">Ndiga</h5>
                                    <p class="mb-2 text-muted">{{$ndingaLoansCount}}</p>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img src="{{ asset('modules/kycmodule/assets/images/icons/1.png') }}" class="img-fluid rounded-circle" alt="user-img">
                                    </div>
                                </div>
                                <div class="col">
                                    <h5 class="mb-1 mt-2 font-16">Mtajipap</h5>
                                  <p class="mb-2 text-muted">{{$mtajipapLoansCount}}</p>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img src="{{ asset('modules/kycmodule/assets/images/icons/1.png') }}" class="img-fluid rounded-circle" alt="user-img">
                                    </div>
                                </div>
                                <div class="col">
                                    <h5 class="mb-1 mt-2 font-16">Mdau</h5>
                                    <p class="mb-2 text-muted">{{$mdauLoansCount}}</p>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        <img src="{{ asset('modules/kycmodule/assets/images/icons/1.png') }}" class="img-fluid rounded-circle" alt="user-img">
                                    </div>
                                </div>
                                <div class="col">
                                    <h5 class="mb-1 mt-2 font-16">Mtumishi</h5>
                                    <p class="mb-2 text-muted">1</p>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->



            <div class="row">
                <div class="col-12">
                    <!-- Portlet card -->
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title mb-0">Recent Loan</h4>

                            <div id="cardCollpase4" class="collapse show">
                                <div class="table-responsive pt-3">
                                    <table class="table table-centered table-nowrap table-borderless mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Category</th>
                                                <th>Loan name</th>
                                                <th>Amount</th>
                                                <th>Identity</th>
                                                <th>Relationship</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($ndingaLoans as $key => $ndingaLoan)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td><span class="badge bg-soft-info text-muted p-1">Ndinga Loan</span></td>

                                                <td>{{ $ndingaLoan->customer->first_name}} {{$ndingaLoan->customer->middle_name}} {{$ndingaLoan->customer->surname}}</td>
                                                <td>{{ number_format($ndingaLoan->amount)}}</td>
                                                <td>{{$ndingaLoan->customer->identity}}</td>
                                                <td>{{$ndingaLoan->customer->phone}}</td>
                                                <td>


                                                  @if($ndingaLoan->is_reviewed)
                                                   <span class="badge bg-soft-success text-info p-1">Completed</span>
                                                  @else
                                                <span class="badge bg-soft-warning text-muted p-1">Pending</span>
                                                  @endif

                                                </td>
                                                <td>
                                                  @if($ndingaLoan->is_reviewed)
                                                   <a class="btn btn-secondary float-end me-5" href="{{url('kycmodule/admin/ndinga/more',[$ndingaLoan->id])}}"> View more</a>
                                                  @else
                                                  <a class="btn btn-success float-end me-5" href="{{url('kycmodule/admin/ndinga/review',[$ndingaLoan->id])}}">Review</a>

                                                  @endif
                                                </td>

                                            </tr>
                                            @endforeach

                                            @foreach($mtajipapLoans as $key => $mtajipapLoan)
                                             <tr>
                                                 <td>{{ $key+1 }}</td>
                                                  <td><span class="badge bg-soft-success text-muted p-1">Mtajipap</span></td>
                                                 <td>{{ $mtajipapLoan->customer->first_name}} {{$mtajipapLoan->customer->middle_name}} {{$mtajipapLoan->customer->surname}}</td>
                                                 <td>{{ number_format($mtajipapLoan->amount)}}</td>
                                                 <td>{{$mtajipapLoan->customer->identity}}</td>
                                                 <td>{{$mtajipapLoan->customer->phone}}</td>
                                                 <td>


                                                   @if($mtajipapLoan->is_reviewed)
                                                    <span class="badge bg-soft-success text-info p-1">Completed</span>
                                                   @else
                                                 <span class="badge bg-soft-warning text-muted p-1">Pending</span>
                                                   @endif

                                                 </td>
                                                 <td>
                                                   @if($mtajipapLoan->is_reviewed)
                                                    <a class="btn btn-secondary float-end me-5" href="{{url('kycmodule/admin/mtajipap/more',[$mtajipapLoan->id])}}"> View more</a>
                                                   @else
                                                   <a class="btn btn-success float-end me-5" href="{{url('kycmodule/admin/mtajipap/review',[$mtajipapLoan->id])}}">Review</a>

                                                   @endif
                                                 </td>

                                             </tr>
                                             @endforeach
                                             
                                             
                                                @foreach($mdauLoans as $key => $mdauLoan)
                                             <tr>
                                                 <td>{{ $key+1 }}</td>
                                                  <td><span class="badge bg-soft-success text-muted p-1">Mtajipap</span></td>
                                                 <td>{{ $mdauLoan->customer->first_name}} {{$mdauLoan->customer->middle_name}} {{$mdauLoan->customer->surname}}</td>
                                                 <td>{{ number_format($mdauLoan->amount)}}</td>
                                                 <td>{{$mdauLoan->customer->identity}}</td>
                                                 <td>{{$mdauLoan->customer->phone}}</td>
                                                 <td>


                                                   @if($mdauLoan->is_reviewed)
                                                    <span class="badge bg-soft-success text-info p-1">Completed</span>
                                                   @else
                                                 <span class="badge bg-soft-warning text-muted p-1">Pending</span>
                                                   @endif

                                                 </td>
                                                 <td>
                                                   @if($mdauLoan->is_reviewed)
                                                    <a class="btn btn-secondary float-end me-5" href="{{url('kycmodule/admin/mdau/more',[$mdauLoan->id])}}"> View more</a>
                                                   @else
                                                   <a class="btn btn-success float-end me-5" href="{{url('kycmodule/admin/mdau/review',[$mdauLoan->id])}}">Review</a>

                                                   @endif
                                                 </td>

                                             </tr>
                                             @endforeach

                                        </tbody>
                                    </table>
                                </div> <!-- .table-responsive -->
                            </div> <!-- end collapse-->
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->







        </div> <!-- container -->

    </div> <!-- content -->

    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="#">Coderthemes</a>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end footer-links d-none d-sm-block">
                        <a href="javascript:void(0);">About Us</a>
                        <a href="javascript:void(0);">Help</a>
                        <a href="javascript:void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->
@endsection
