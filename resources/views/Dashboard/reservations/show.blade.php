@extends('layouts.app_layout')

@section('extra-css')

    <link href="{{asset('assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('assets/css/pages/formlayout.css')}}" rel="stylesheet" type="text/css" />

    <!-- Date Time item CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.css')}}" />
    <!--tagsinput-->
    <link href="{{asset('assets/plugins/jquery-tags-input/jquery-tags-input.css')}}" rel="stylesheet">
    <!--select2-->
    <link href="{{asset('assets/plugins/select2/css/select2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />


@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Reservations</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{route('dashboard.home')}}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="{{route('dashboard.reservations.index')}}">Reservations</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Show Reservation</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Show Reservation</header>
                        </div>
                        <form action="{{route('dashboard.reservations.update', $reservation->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="card-body">
                                <h3><span class="bold">Customer Data</span></h3>
                                <div class="row">
                                    <div class="col-lg-6 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input value="{{$reservation->user->name}}" class ="mdl-textfield__input" type="text" readonly>
                                            <label class ="mdl-textfield__label">Customer Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input value="{{$reservation->user->number}}" class ="mdl-textfield__input" type="text" readonly>
                                            <label class ="mdl-textfield__label">Customer Phone</label>
                                        </div>
                                    </div>
                                </div>
                                <h3><span class="bold">Restaurant Data</span></h3>
                                <div class="row">
                                    <div class="col-lg-6 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input value="{{$reservation->branch->restaurant->name}}" class ="mdl-textfield__input" type="text" readonly>
                                            <label class ="mdl-textfield__label">Restaurant Name</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input value="{{$reservation->branch->city->governorate->governorate_name_en}}" class ="mdl-textfield__input" type="text" readonly>
                                            <label class ="mdl-textfield__label">Governorate</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input value="{{$reservation->branch->city->city_name_en}}" class ="mdl-textfield__input" type="text" readonly>
                                            <label class ="mdl-textfield__label">City</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input value="{{$reservation->branch->address}}" class ="mdl-textfield__input" type="text" readonly>
                                            <label class ="mdl-textfield__label">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <h3><span class="bold">Reservation Data</span></h3>
                                <div class="row">
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input value="{{$reservation->date}}" class ="mdl-textfield__input" type="text" readonly>
                                            <label class ="mdl-textfield__label">Date</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input value="{{$reservation->time}}" class ="mdl-textfield__input" type="text" readonly>
                                            <label class ="mdl-textfield__label">Time</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input value="{{$reservation->number_of_seats}}" class ="mdl-textfield__input" type="text" readonly>
                                            <label class ="mdl-textfield__label">Number of Seats</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 p-t-20"> 
                                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input value="{{$reservation->status}}" class ="mdl-textfield__input" type="text" readonly>
                                            <label class ="mdl-textfield__label">Status</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 p-t-20 text-center"> 
                                    @if($reservation->status == 'Approved')
                                        <button type="submit" name="status" value="Rejected" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger">Reject</button>
                                    @elseif($reservation->status == 'Pending')
                                        <button type="submit" name="status" value="Approved" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-success">Accept</button>
                                        <button type="submit" name="status" value="Rejected" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-danger">Reject</button>
                                    @endif
                                    <a type="button" href="{{route('dashboard.reservations.index')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div> 
        </div>
    </div>
@endsection

@section('extra-js')
    <script  src="{{asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}" ></script>
    <script  src="{{asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js')}}" ></script>
    <script  src="{{asset('assets/js/pages/material_select/getmdl-select.js')}}" ></script>
    <script  src="{{asset('assets/plugins/material-datetimepicker/moment-with-locales.min.js')}}"></script>
    <script  src="{{asset('assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.js')}}"></script>
    <script  src="{{asset('assets/plugins/material-datetimepicker/datetimepicker.js')}}"></script>
    <!--tags input-->
    <script src="{{asset('assets/plugins/jquery-tags-input/jquery-tags-input.js')}}" ></script>
    <script src="{{asset('assets/plugins/jquery-tags-input/jquery-tags-input-init.js')}}" ></script>
    <!--select2-->
    <script src="{{asset('assets/plugins/select2/js/select2.js')}}" ></script>
    <script src="{{asset('assets/js/pages/select2/select2-init.js')}}" ></script>

@endsection