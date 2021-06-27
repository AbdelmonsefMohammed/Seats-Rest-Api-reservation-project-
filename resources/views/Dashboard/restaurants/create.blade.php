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
                        <div class="page-title">Add Restaurant</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{route('dashboard.home')}}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Restaurants</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Add Restaurant</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Add Restaurant</header>
                        </div>
                        <form action="{{route('dashboard.restaurants.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body row">
                                <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input name="name" class = "mdl-textfield__input" type="text" required>
                                        <label class ="mdl-textfield__label">Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <input name="main_number" class = "mdl-textfield__input" type = "text" 
                                         pattern = "-?[0-9]*(\.[0-9]+)?" id = "text5">
                                      <label class = "mdl-textfield__label" for = "text5">Main Number</label>
                                      <span class = "mdl-textfield__error">Number required!</span>
                                   </div>
                                 </div>

                                 <label class="col-lg-2 p-t-20">Opening Hour</label>
                                 <div class="col-lg-4">
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <div class="input-group date form_time col-md-8" data-date="" data-date-format="hh:ii" data-link-field="openingHourInput" data-link-format="hh:ii">
                                            <input class="form-control" size="16" type="text" value=""  required>
                                            <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                        </div>
                                        <input name="opening_time" type="hidden" id="openingHourInput" value="" />
                                   </div>
                                 </div>

                                 <label class="col-lg-2 p-t-20">Closing Hour</label>
                                 <div class="col-lg-4">
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <div class="input-group date form_time col-md-8" data-date="" data-date-format="hh:ii" data-link-field="closingHourInput" data-link-format="hh:ii">
                                            <input class="form-control" size="16" type="text" value="" required>
                                            <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
                                        </div>
                                        <input name="closing_time" type="hidden" id="closingHourInput" value="" />
                                   </div>
                                 </div>
                                 
                                 <div class="col-lg-6 p-t-20"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input name="website_link" class = "mdl-textfield__input" type="url">
                                        <label class ="mdl-textfield__label">Website URL</label>
                                    </div>
                                </div>
                                 <div class="col-lg-3 p-t-20">
                                    <div class="form-group">
                                        <label>Select Type</label>
                                        <select name="type" class="form-control" required>
                                            <option value="">...</option>
                                            <option value="Restaurant">Restaurant</option>
                                            <option value="Cafe">Cafe</option>
                                            <option value="Bar">Bar</option>
                                            <option value="Party">Party</option>
                                            <option value="Office">Office</option>
                                        </select>
                                    </div>
                                 </div>
                                 <div class="col-lg-3 p-t-20">
                                    <div class="form-group">
                                        <label>Price Range</label>
                                        <select name="price_range" class="form-control">
                                            <option value="">...</option>
                                            <option value="1">$</option>
                                            <option value="2">$$</option>
                                            <option value="3">$$$</option>
                                        </select>
                                    </div>
                                 </div>
                                 <div class="col-lg-6"> 
                                    <div class="form-group">
                                        <label>Select Categories</label>
                                         @foreach ($categories as $category)
                                            <div class="checkbox checkbox-icon-black p-0">
                                                <input id="checkbox{{$category->id}}"  type="checkbox" name="categories_{{$category->id}}">
                                                <label for="checkbox{{$category->id}}">
                                                    {{$category->name}}
                                                </label>
                                            </div>
                                         @endforeach
                                    </div>
                                </div>
                                 <label class="col-lg-2 p-t-20">Picture</label>
                                 <div class="col-lg-4"> 
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <input name="picture" class ="mdl-textfield__input" type="file" required>
                                    </div>
                                </div>

                                <div class="col-lg-12 p-t-20 text-center"> 
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
                                    <a type="button" href="{{route('dashboard.restaurants.index')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</a>
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