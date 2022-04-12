@extends('layouts.master')

@section('title') বোনাস সেটিং @endsection

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
                        <p class="fw-bold mb-4">বোনাস ও পার্সেন্ট সেটিং</p>
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
                             <form id="websitetitle" action="{{ route('bonus.post') }}" method="post">
                               @csrf
                                <h4 class="card-title mb-5"> অ্যাসেট বোনাস সেটিং </h4>
                                <!-- Form group -->
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">অ্যাসেট</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="assetbonus" class="form-control" placeholder="অ্যাসেট পার্সেন্ট" value="{{ config('bonus_settings.assetbonus') }}">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">ক্যাশ </label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="cashbonus" class="form-control" value="{{ config('bonus_settings.cashbonus') }}" placeholder="ক্যাশ পার্সেন্ট">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">চ্যারিটি বোনাস</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="charitybouns" class="form-control" placeholder="চ্যারিটি বোনাস" value="{{ config('bonus_settings.charitybouns') }}">
                                            <div class="input-group-text">৳</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">ভ্যাট ও ট্যাক্স</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="vatandtax" class="form-control" value="{{ config('bonus_settings.vatandtax') }}" placeholder="ভ্যাট ও ট্যাক্স পার্সেন্ট">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">মামাজ পয়সা</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="mamazpoisha" class="form-control" value="{{ config('bonus_settings.mamazpoisha') }}" placeholder="মামাজ পয়সা পার্সেন্ট">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">ফাউন্ডারশিপ বোনাস</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="foundershipbonus" class="form-control" value="{{ config('bonus_settings.foundershipbonus') }}" placeholder="ফাউন্ডারশিপ বোনাস পার্সেন্ট">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">নন স্পন্সর বোনাস</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="nonsponsorbonus" class="form-control" value="{{ config('bonus_settings.nonsponsorbonus') }}" placeholder="নন স্পন্সর বোনাস বোনাস পার্সেন্ট">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">ল্যান্ড কাভারেজ বোনাস</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="landcoverage" class="form-control" value="{{ config('bonus_settings.landcoverage') }}" placeholder="ল্যান্ড কাভারেজ বোনাস">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">ক্লাব বোনাস</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="clubbonus" class="form-control" value="{{ config('bonus_settings.clubbonus') }}" placeholder="ক্লাব বোনাস">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">বেস্ট পারফোরমেন্স বোনাস</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="bestperformancebonus" class="form-control" value="{{ config('bonus_settings.bestperformancebonus') }}" placeholder="বেস্ট পারফোরমেন্স বোনাস">
                                            <div class="input-group-text">৳</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> উইথড্র চার্জ</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="withdrwacharge" class="form-control" value="{{ config('bonus_settings.withdrawcharge') }}" placeholder="ক্লাব বোনাস">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> টার্গেট সেল বোনাস</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="TargetSell" class="form-control" value="{{ config('bonus_settings.TargetSell') }}" placeholder="Target Sell Bonus">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> গিফট এ্যান্ড ট্যুর</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="giftandtoure" class="form-control" value="{{ config('bonus_settings.giftandtour') }}" placeholder="Gift and Tour">
                                            <div class="input-group-text">৳</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> ৫ জেনেরেশন বোনাস</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="5generationbonus" class="form-control" value="{{ config('bonus_settings.5generationbonus') }}" placeholder="Gift and Tour">
                                            <div class="input-group-text">৳</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> নন টাগের্ট বোনাস</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="nontargetbonus" class="form-control" value="{{ config('bonus_settings.nontargetbonus') }}" placeholder="Non Target">
                                            <div class="input-group-text">৳</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> ফলোআপ বোনাস</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="followupbonus" class="form-control" value="{{ config('bonus_settings.followupbonus') }}" placeholder="Follow up bonus">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> হোন্ডা এবং কার </label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="hondaandcar" class="form-control" value="{{ config('bonus_settings.hondaandcar') }}" placeholder="Follow up bonus">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> ল্যান্ড ইনসুরেন্স </label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="landinsurance" class="form-control" value="{{ config('bonus_settings.landinsurance') }}" placeholder="land insurace bonus">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> ডেভেলোপমেন্ট বোনাস </label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="developmentbonus" class="form-control" value="{{ config('bonus_settings.developmentbonus') }}" placeholder="Developement bonus">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> সার্ভিস চার্জ </label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="ServiceCharge" class="form-control" value="{{ config('bonus_settings.ServiceCharge') }}" placeholder="Service Charge">
                                            <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"> গোল্ড পিন, ক্রেস্ট, সার্টিফিকেট </label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" name="gccf" class="form-control" value="{{ config('bonus_settings.gccf') }}" placeholder="Enter value">
                                            <div class="input-group-text">৳</div>
                                        </div>
                                    </div>
                                </div>
                                
                                    <div class="col-md-3 mt-3 mb-3">
                                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">পরিবর্তন করুন</button>
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