@extends('layouts.master')

@section('title') নতুন বোনাস তৈরি করুন @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') ড্যাশবোর্ড @endslot
        @slot('title') বোনাস তৈরি করুন @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('bonus.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="bonus name">বোনাস সেটিং নাম</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="বোনাস সেটিং নাম" autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="bonus name">বোনাস টাইপ</label>
                            <select name="bonustype" id="" class="form-control">
                                <option value="0"> নির্বাচন করুন </option>
                                <option value="percent">পার্সেন্টটেজ (%)</option>
                                <option value="amount">টাকা (৳)</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="bonus name">ডেফলট ভেলু</label>
                            <input type="text" name="defaultvalue" value="{{ old('defaultvalue') }}" class="form-control" placeholder="বোনাস ভেলু">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm"> সাবমিট করুন</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
@endsection