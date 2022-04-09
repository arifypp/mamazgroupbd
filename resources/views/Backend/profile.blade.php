@extends('layouts.master')

@section('title') প্রোফাইল @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') প্রোফাইল @endslot
        @slot('title') প্রোফাইল @endslot
    @endcomponent

<div class="row">
    <div class="col-md-6 offset-md-3 m-auto text-center align-items-center">
        <div class="card card-body">
            <div class="profile-img img-fluid">
                <img src="{{ asset($user->avatar) }}" class="circle-rounded" alt="{{ $user->name }}" width="100">
            </div>
            <hr>
            <div class="user-details">
                <h2 class="text-center">
                    প্রোফাইল তথ্য
                </h2>
                <table class="table table responsive">
                    <tbody>
                        <tr>
                            <th>নাম</th>
                            <td>:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>ইউজার নাম</th>
                            <td>:</td>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th>ই-মেইল </th>
                            <td>:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>মোবাইল নং </th>
                            <td>:</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>ঠিকানা </th>
                            <td>:</td>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th>জন্ম তারিখ </th>
                            <td>:</td>
                            <td>{{ $user->dob }}</td>
                        </tr>
                        <tr>
                            <th>রেফারেল লিঙ্ক </th>
                            <td>:</td>
                            <td>{{ route('homepage') }}/register?ref={{ Auth::user()->username }}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection