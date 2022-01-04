@extends('layouts.master')

@section('title') প্রিয় ক্লাইন্ট সেটিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') ড্যাশবোর্ড @endslot
        @slot('title') প্রিয় ক্লাইন্ট সেটিং @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-4">
            <div class="card card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="formrow-websiteherotitle-input" class="form-label">প্রিয় ক্লাইন্ট টাইটেল</label>
                        <input type="text" class="form-control" id="formrow-websiteherotitle-input" placeholder="টাইটেল লিখুন!">
                    </div>
                    <div class="mb-5">
                        <label for="formrow-websiteherotitle-input" class="form-label">প্রিয় ক্লাইন্ট ছোট বিবরণ</label>
                        <textarea name="desc" id="" cols="5" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light">সেভ করুন</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12 col-8">

            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                   প্রিয় ক্লাইন্ট লোগো
                   <button type="button" class="btn btn-light waves-effect" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right;">নতুন লোগো যোগ করুন</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>name Nixon</td>
                                <td>url Architect</td>
                                <td>status</td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">নতুন লোগো যোগ করুন </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>I will not close if you click outside me. Don't even try to press escape key.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">বাদ দিন</button>
                            <button type="button" class="btn btn-primary">সেভ করুন</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection