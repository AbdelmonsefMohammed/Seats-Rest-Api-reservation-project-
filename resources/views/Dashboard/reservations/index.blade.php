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
                    <div class="page-title">All Reservations</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{route('dashboard.home')}}">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" href="">Reservations</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">All Reservations</li>
                </ol>
            </div>
        </div>
         <div class="row">
            <div class="col-md-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>All Reservations</header>
                    </div>
                    <div class="card-body ">
                        <div class="table-scrollable">
                        <table class="table table-hover table-checkable order-column full-width" id="example4">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center"> Restaurant / Branch </th>
                                    <th class="center"> User </th>
                                    <th class="center"> Date / time </th>
                                    <th class="center"> Status </th>
                                    <th class="center"> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr class="odd gradeX">
                                        <td class="center">{{$loop->iteration}}</td>
                                        <td class="center">{{$reservation->branch->restaurant->name}} / {{$reservation->branch->city->city_name_en}}</td>
                                        <td class="center">{{$reservation->user->name}}</td>
                                        <td class="center">{{$reservation->date}} / {{$reservation->time}}</td>
                                        <td class="center">{{$reservation->status}}</td>
                                        <td class="center">
                                            <a href="{{route('dashboard.reservations.show', $reservation->id)}}" class="btn btn-tbl-edit btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <button class="btn btn-tbl-delete btn-xs" onclick="event.preventDefault();
                                            document.getElementById('delete-form').submit();">
                                                <i class="fa fa-trash-o "></i>
                                            </button>
                                            <form id="delete-form" action="{{route('dashboard.reservations.destroy', $reservation->id)}}" method="POST" class="d-none">
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