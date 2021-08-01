@extends('layouts.app_layout')

@section('extra-css')
<link href="{{asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Offers</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{route('dashboard.home')}}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Offers</li>
                </ol>
            </div>
        </div>
         <div class="row">
            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Select Restaurant / Branch</header>
                        <form action="">
                            <div class="row">
                                <div class="col-lg-4 p-t-20">
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
                                 <div class="col-lg-4 p-t-20">
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
                                 <div class="col-lg-2 p-t-20 text-center"> 
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Select</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="card-body ">
                        <div class="row p-b-20">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="btn-group">
                                    <a href="{{route('dashboard.restaurants.create')}}" id="addRow" class="btn btn-info">
                                        Add New <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-scrollable">
                        <table class="table table-hover table-checkable order-column full-width" id="example4">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center"> Name </th>
                                    <th class="center"> Type </th>
                                    <th class="center"> Main Number </th>
                                    <th class="center"> Categories </th>
                                    <th class="center"> Website </th>
                                    <th class="center"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($restaurants as $restaurant)
                                    <tr class="odd gradeX">
                                        <td class="center">{{$loop->iteration}}</td>
                                        <td class="center">{{$restaurant->name}}</td>
                                        <td class="center">{{$restaurant->type}}</td>
                                        <td class="center">{{$restaurant->main_number}}</td>
                                        <td class="center">
                                            @foreach ($restaurant->categories as $category)
                                                {{$category->name}}  ,
                                            @endforeach
                                        </td>
                                        <td class="center">{{$restaurant->website_link}}</td>
                                        <td class="center">
                                            <a href="{{route('dashboard.restaurants.edit', $restaurant->id)}}" class="btn btn-tbl-edit btn-xs">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button class="btn btn-tbl-delete btn-xs" onclick="event.preventDefault();
                                            document.getElementById('delete-form').submit();">
                                                <i class="fa fa-trash-o "></i>
                                            </button>
                                            <form id="delete-form" action="{{route('dashboard.restaurants.destroy', $restaurant->id)}}" method="POST" class="d-none">
                                                @csrf
                                                @method('Delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}" ></script>
    <script src="{{asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js')}}" ></script>
    <script src="{{asset('assets/js/pages/table/table_data.js')}}" ></script>
@endsection