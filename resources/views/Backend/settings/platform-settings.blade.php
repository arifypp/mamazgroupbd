@extends('layouts.master')

@section('title') ওয়েবসাইট সেটিং @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection

@section('content')





<div class="checkout-tabs">
        <div class="row">
            <div class="col-lg-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                    <a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill" href="#v-pills-gen-ques"
                        role="tab" aria-controls="v-pills-gen-ques" aria-selected="true">
                        <i class="bx bx-edit d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">বেসিক সেটিং</p>
                    </a>

                    <a class="nav-link" id="v-pills-privacy-tab" data-bs-toggle="pill" href="#v-pills-privacy" role="tab"
                        aria-controls="v-pills-privacy" aria-selected="false">
                        <i class="bx bx-envelope d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">ই-মেইল সেটিং</p>
                    </a>

                    <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support" role="tab"
                        aria-controls="v-pills-support" aria-selected="false">
                        <i class="bx bx-duplicate d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4"> লোগো সেটিং </p>
                    </a>

                </div>
            </div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="v-pills-tabContent">
                            <!-- Website title setting -->
                            <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel"
                                aria-labelledby="v-pills-gen-ques-tab">
                            @foreach($wsettings as $value)    
                             <form id="websitetitle" action="{{route('settings.update', $value->id)}}" method="post">
                               @csrf
                                <h4 class="card-title mb-5"> আপডেট বেসিক সেটিং </h4>
                                <!-- Form group -->
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">ওয়েবসাইট টাইটেল</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="wtitle" value="{{$value->title}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">মেটা টাইটেল</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="metatitle" value="{{$value->seotitle}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">মোবাইল</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="phone" value="{{$value->phone}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">সাইট আড্রেস</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="address" value="{{$value->address}}"><br>
                                        <input class="form-control" type="text" name="city" value="{{$value->city}}"><br>
                                        <input class="form-control" type="text" name="postcode" value="{{$value->postcode}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">মেটা বিবরণ</label>
                                    <div class="col-md-10">
                                        <textarea name="description" id="" cols="30" rows="10" class="form-control">{{$value->metadesc}}</textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> </label>
                                    <div class="col-md-10">
                                    <!-- <select class="select2 form-control select2-multiple" multiple="multiple"
                                        data-placeholder="Select the tag ..." name="webtag">
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK">Alaska</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                        <optgroup label="Pacific Time Zone">
                                            <option value="CA">California</option>
                                            <option value="NV">Nevada</option>
                                            <option value="OR">Oregon</option>
                                            <option value="WA">Washington</option>
                                        </optgroup>
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TX">Texas</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="WI">Wisconsin</option>
                                        </optgroup>
  
                                    </select> -->
                                    <div class="col-md-3 mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">পরিবর্তন করুন</button>
                                    </div>
                                  </form>
                                  @endforeach
                                 </div>
                                  
                                </div>


                        </div>

                        <div class="tab-pane fade" id="v-pills-privacy" role="tabpanel"
                                aria-labelledby="v-pills-privacy-tab">
                            @foreach($wsettings as $value)    
                             <form id="websitetitle" action="{{route('basic.updateemail', $value->id)}}" method="post">
                               @csrf
                                <h4 class="card-title mb-5">Basic Email Settings</h4>
                                <!-- Form group -->
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Email Address</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="email" name="email" value="{{$value->email}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Sender Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="sendername" value="{{$value->sendername}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Email Encryption</label>
                                    <div class="col-md-10">
                                        <select name="emailencryption" id="" class="form-control">
                                            <option value="ssl">SSL</option>
                                            <option value="tsl">TSL</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">SMTP Host</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="SMTPhost" value="{{$value->SMTPhost}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">SMTP Port</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="SMTPport" value="{{$value->SMTPport}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">SMTP Username</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="SMTPusername" value="{{$value->SMTPusername}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">SMTP Password</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="SMTPpassword" value="{{$value->SMTPpassword}}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Email Signature</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="Emailsignature" value="{{$value->Emailsignature}}"><br>
                                    </div>
                                </div>


                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> </label>                                        
                                        <div class="col-md-3 mt-3 mb-3">
                                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Save Changes</button>
                                        </div>
                                  </form>
                                  @endforeach
                                
                                </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-support" role="tabpanel"
                                aria-labelledby="v-pills-support-tab">
                               
                            @foreach($wsettings as $value)    
                             <form action="{{route('basic.updatelogo', $value->id)}}" method="post" enctype="multipart/form-data">
                               @csrf
                                <h4 class="card-title mb-5">Website Logo Settings</h4>
                                <!-- Form group -->
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-4 col-form-label">Upload Admin Logo</label>
                                    <div class="col-md-8">
                                        <input class="form-file-control" type="file" name="websitelogowhite">
                                        <img src="{{ asset('assets/images/settings/'. $value->websitelogowhite) }}" alt="" width="150">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-4 col-form-label">Upload Website Logo</label>
                                    <div class="col-md-8">
                                    <input class="form-file-control" type="file" name="websitelogodark">
                                    <img src="{{ asset('assets/images/settings/'. $value->websitelogodark) }}" alt="" width="150">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-4 col-form-label">Upload White Favicon</label>
                                    <div class="col-md-8">
                                    <input class="form-file-control" type="file" name="websitefaviconwhite">
                                    <img src="{{ asset('assets/images/settings/'. $value->websitefaviconwhite) }}" alt="" width="50">  
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-4 col-form-label">Upload Dark Favicon</label>
                                    <div class="col-md-8">
                                    <input class="form-file-control" type="file" name="websitefavicondark">
                                    <img src="{{ asset('assets/images/settings/'. $value->websitefavicondark) }}" alt="" width="50">
                                    </div>
                                </div>


                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-4 col-form-label"> </label>                                        
                                        <div class="col-md-3 mt-3 mb-3">
                                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Save Changes</button>
                                        </div>
                                  </form>
                                  @endforeach
                               
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <!-- form advanced init -->
    <script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
    
@endsection