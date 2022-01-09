@extends('layouts.master')

@section('title') বুকিং তথ্য @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') বুকিং @endslot
        @slot('title') বুকিং এর বিবরণ @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12 col-12">
            <div class="card card-body">
              <div class="row">
                  <div class="col-md-6">
                        <table class="table-responsive align-middle">
                            <tbody>
                                <tr>
                                @foreach( $site_settings as $value )
                                    <img src="{{ URL::asset ('/assets/images/settings/' .$value->websitelogodark) }}" alt="Mamaz" class="img-fluid" width="100">
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                  </div>
                  <div class="col-md-6">
                        <table  class="table-responsive align-middle text-right float-md-right" style="float:right;">
                            <tbody>
                                <tr>
                                    <th>বুকিং আইডি:</th>
                                    <td>:</td>
                                    <td>{{ $bookings->bookingid }}</td>
                                </tr>
                            </tbody>
                        </table>
                  </div>
                  <div class="col-md-12 mt-4">
                      <center>
                          <h3 class="font-weight-bold"> <strong>মামাজ বুকিং তথ্য</strong> </h3>
                          <h5>সাভার, ঢাকা ।</h5>
                      </center>
                      <hr>
                  </div>
                  <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-8 mb-2">
                            <table class="align-middle w-100" >
                                <tbody>
                                    <tr>
                                        <th>রেজিস্ট্রেশন নং</th>
                                        <td> - &nbsp</td>
                                        <td style="width:70%; border-bottom:1px dashed #333"> {{ $bookings->bookingid }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 mb-2">
                            <table class="align-middle w-100" style="float:right">
                                <tbody>
                                    <tr>
                                        <th>তারিখ</th>
                                        <td> - &nbsp</td>
                                        <td style="width:60%; border-bottom:1px dashed #333"> {{ date('d-m-Y', strtotime($bookings->created_at));}} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 mb-2">
                            <table class="align-middle w-100">
                                <tbody>
                                    <tr>
                                        <th>নাম </th>
                                        <td> - &nbsp</td>
                                        <td style="width:90%; border-bottom:1px dashed #333">
                                            <strong>{{ $bookings->name }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-8 mb-2">
                            <table class="align-middle w-100">
                                <tbody>
                                    <tr>
                                        <th>জন্ম তারিখ </th>
                                        <td> - &nbsp</td>
                                        <td style="width:70%; border-bottom:1px dashed #333">
                                            {{ date('d-m-Y', strtotime($bookings->dob));}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 mb-2">
                            <table class="align-middle w-100">
                                <tbody>
                                    <tr>
                                        <th>ধর্ম </th>
                                        <td> - &nbsp</td>
                                        <td style="width:70%; border-bottom:1px dashed #333">
                                            <strong>{{ $bookings->religion }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-8 mb-2">
                            <table class="align-middle w-100">
                                <tbody>
                                    <tr>
                                        <th>জাতীয় পরিচয় পত্র নম্বর </th>
                                        <td> - &nbsp</td>
                                        <td style="width:50%; border-bottom:1px dashed #333">
                                            {{ $bookings->nidnumber}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 mb-2">
                            <table class="align-middle w-100">
                                <tbody>
                                    <tr>
                                        <th>জাতীয়তা </th>
                                        <td> - &nbsp</td>
                                        <td style="width:50%; border-bottom:1px dashed #333">
                                            <strong>{{ $bookings->nationality }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12 col-12">
            <div class="card card-body">
                পার্ট - ২
            </div>
        </div>
    </div>

@endsection