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
                        <div class="page-title">Edit Restaurant Branch</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{route('dashboard.home')}}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Restaurant Branches</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Edit Restaurant Branch</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Edit Restaurant Branch</header>
                        </div>
                        <form action="{{route('dashboard.branches.update', $branch->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body row">
                                <div class="col-lg-6 p-t-20">
                                    <div class="form-group">
                                        <label>Restaurant</label>
                                        <select name="restaurant_id" class="form-control" required>
                                            <option value="">...</option>
                                            @foreach ($restaurants as $restaurant)
                                                <option {{ $branch->restaurant_id == $restaurant->id? 'selected':'' }} value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 p-t-20">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" placeholder="Enter Address ..." required>{{ $branch->address ?? old('address')}}</textarea>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 p-t-20">
                                    <div class="form-group">
                                        <label>Governorate</label>
                                        <select class="form-control governorate" required>
                                            <option value="">...</option>
                                            @foreach ($governorates as $governorate)
                                                <option {{ $branch->city->governorate_id == $governorate->id? 'selected':'' }} value="{{$governorate->id}}">{{$governorate->governorate_name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 p-t-20">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select id="city" name="city_id" class="form-control" required>
                                            <option value="">...</option>
                                            @foreach ($cities as $city)
                                                <option {{ $branch->city_id == $city->id? 'selected':'' }} value="{{$city->id}}">{{$city->city_name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 p-t-20">
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <input name="lat" value="{{ $branch->lat ?? old('lat')}}" class="mdl-textfield__input" type="text" 
                                         pattern = "-?[0-9]*(\.[0-9]+)?" id="text5" required>
                                      <label class = "mdl-textfield__label" for = "text5">Lat</label>
                                      {{-- <span class = "mdl-textfield__error">Lat required!</span> --}}
                                   </div>
                                 </div>
                                <div class="col-lg-6 p-t-20">
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <input name="lng" value="{{ $branch->lng ?? old('lng')}}" class = "mdl-textfield__input" type = "text" 
                                         pattern = "-?[0-9]*(\.[0-9]+)?" id="text5" required>
                                      <label class = "mdl-textfield__label" for = "text5">Lng</label>
                                      {{-- <span class = "mdl-textfield__error">Lng required!</span> --}}
                                   </div>
                                </div>
                                <div class="col-lg-6 p-t-20">
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <input name="landline" value="{{ $branch->landline ?? old('landline')}}" class = "mdl-textfield__input" type = "text" 
                                         pattern = "-?[0-9]*(\.[0-9]+)?" id = "text5">
                                      <label class = "mdl-textfield__label" for = "text5">Landline</label>
                                      {{-- <span class = "mdl-textfield__error">Number required!</span> --}}
                                   </div>
                                 </div>
                                 <div class="col-lg-6 p-t-20">
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <input name="mobile1" value="{{ $branch->mobile1 ?? old('mobile1')}}" class = "mdl-textfield__input" type = "text" 
                                         pattern = "-?[0-9]*(\.[0-9]+)?" id = "text5">
                                      <label class = "mdl-textfield__label" for = "text5">Mobile 1</label>
                                      {{-- <span class = "mdl-textfield__error">Number required!</span> --}}
                                   </div>
                                 </div>
                                 <div class="col-lg-6 p-t-20">
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <input name="mobile2" value="{{ $branch->mobile2 ?? old('mobile2')}}" class = "mdl-textfield__input" type = "text" 
                                         pattern = "-?[0-9]*(\.[0-9]+)?" id = "text5">
                                      <label class = "mdl-textfield__label" for = "text5">Mobile 2</label>
                                      {{-- <span class = "mdl-textfield__error">Number required!</span> --}}
                                    </div>
                                 </div>
                                 <div class="col-lg-6 p-t-20">
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <input name="number_of_tables" value="{{ $branch->number_of_tables ?? old('number_of_tables')}}" class = "mdl-textfield__input" type = "text" 
                                         pattern = "-?[0-9]*(\.[0-9]+)?" id = "text5">
                                      <label class = "mdl-textfield__label" for = "text5">Number of Tables</label>
                                      {{-- <span class = "mdl-textfield__error">Number required!</span> --}}
                                    </div>
                                 </div>
                                 <div class="col-lg-6 p-t-20">
                                    <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <input name="number_of_seats" value="{{ $branch->number_of_seats ?? old('number_of_seats')}}" class = "mdl-textfield__input" type = "text" 
                                         pattern = "-?[0-9]*(\.[0-9]+)?" id = "text5">
                                      <label class = "mdl-textfield__label" for = "text5">Number of Seats</label>
                                      {{-- <span class = "mdl-textfield__error">Number required!</span> --}}
                                    </div>
                                 </div>
                                <div class="col-lg-12 p-t-20 text-center"> 
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
                                    <a type="button" href="{{route('dashboard.branches.index')}}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</a>
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
    <script>
        $('.governorate').on('change', function() {
            var governorate_id = $(this).val();
            console.log(governorate_id);
            if(governorate_id) {
                $.ajax({
                    url: '/dashboard/getcities/'+governorate_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {        
                        $('#city').empty();
                        $.each(data, function(key, value) {
                        $('#city').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('#city').empty();
            }
        });
    </script>
@endsection