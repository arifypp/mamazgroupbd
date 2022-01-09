@extends('layouts.master')

@section('title') নতুন বুকিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') বুকিং @endslot
        @slot('title') নতুন বুকিং @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card card-body">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 align-self-center align-middle">
                    <thead>
                        <tr>
                            <th>বুকিং আইডি</th>
                            <th>গ্রাহকের নাম</th>
                            <th>প্লট / জমির পরিমান</th>
                            <th>টাকার পরিমান</th>
                            <th>মোবাইল</th>
                            <th>স্টাটার্স</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach( $bookings as $booking )
                        <tr>
                            <td>{{ $booking->bookingid }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->flatvalue }}</td>
                            <td>{{ $booking->bookingmoney }}</td>
                            <td>{{ $booking->phonenumber }}</td>
                            <td>
                                <a href="{{ route('bbooking.show', $booking->id) }}" class="text-success"><i class="mdi mdi-18px mdi-eye"></i></a>
                                <a href="#" class="text-info"><i class="mdi mdi-18px mdi-lead-pencil"></i></a>
                                <a href="#" class="text-danger"><i class="mdi mdi-18px mdi-trash-can-outline"></i></a>
                                <a href="#" class="text-primary"><i class="mdi mdi-18px mdi-file-pdf"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection