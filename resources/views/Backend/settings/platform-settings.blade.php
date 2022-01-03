@extends('layouts.master')

@section('title') Website Settings @endsection

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
                        <p class="fw-bold mb-4">Basic Setting</p>
                    </a>

                    <a class="nav-link" id="v-pills-privacy-tab" data-bs-toggle="pill" href="#v-pills-privacy" role="tab"
                        aria-controls="v-pills-privacy" aria-selected="false">
                        <i class="bx bx-envelope d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">E-mail Setting</p>
                    </a>

                    <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support" role="tab"
                        aria-controls="v-pills-support" aria-selected="false">
                        <i class="bx bx-duplicate d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Logo Upload</p>
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
                             <form id="websitetitle" action="" method="post">
                               @csrf
                                <h4 class="card-title mb-5">Update Basic Setting</h4>
                                <!-- Form group -->
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Website Title</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="wtitle" value="">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Website Meta Title</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="metatitle" value="">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Website Phone No</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="phone" value="">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Website Address</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="address" value=""><br>
                                        <input class="form-control" type="text" name="city" value=""><br>
                                        <input class="form-control" type="text" name="postcode" value="">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Meta Description</label>
                                    <div class="col-md-10">
                                        <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
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
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Save Changes</button>
                                    </div>
                                  </form>
                                  
                                 </div>
                                  
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