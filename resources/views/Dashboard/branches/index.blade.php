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
                    <div class="page-title">All Restaurant Branches</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{route('dashboard.home')}}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Restaurant Branches</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">All Restaurant Branches</li>
                </ol>
            </div>
        </div>
         <div class="row">
            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>All Restaurant Branches</header>
                    </div>
                    <div class="card-body ">
                        <div class="row p-b-20">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="btn-group">
                                    <a href="{{route('dashboard.branches.create')}}" id="addRow" class="btn btn-info">
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
                                    <th class="center"> Restaurant Name </th>
                                    <th class="center"> Address </th>
                                    <th class="center"> City </th>
                                    <th class="center"> Governorate </th>
                                    <th class="center"> Mobile </th>
                                    <th class="center"> Rating </th>
                                    <th class="center"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                    <tr class="odd gradeX">
                                        <td class="center">{{$loop->iteration}}</td>
                                        <td class="center">{{$branch->restaurant->name}}</td>
                                        <td class="center">{{$branch->address}}</td>
                                        <td class="center">{{$branch->city->city_name_en}}</td>
                                        <td class="center">{{$branch->city->governorate->governorate_name_en}}</td>
                                        <td class="center">{{$branch->mobile1}}</td>
                                        <td class="center">{{$branch->rating > 0? $branch->rating . ' Stars':'No rating'}}</td>
                                        <td class="center">
                                            <a href="{{route('dashboard.branches.edit', $branch->id)}}" class="btn btn-tbl-edit btn-xs">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button class="btn btn-tbl-delete btn-xs" onclick="event.preventDefault();
                                            document.getElementById('delete-form').submit();">
                                                <i class="fa fa-trash-o "></i>
                                            </button>
                                            <form id="delete-form" action="{{route('dashboard.branches.destroy', $branch->id)}}" method="POST" class="d-none">
                                                @csrf
                                                @method('Delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
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