@extends('layouts.master')

@section('title') ক্রেডিট করুন  @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') ক্রেডিট @endslot
        @slot('title') ক্রেডিট করুন  @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-6 offset-md-3 align-items-center align-self-center justify-content-center">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('credit.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="Amount">টাকার পরিমাণ ?</label>
                            <input type="number" name="amount" id="amount" class="form-control input-lg" value="{{ old('amount') }}" autocomplete="off" min="0" max="10000" step="1" required style="font-size: 40px;">
                        </div>
                        <div class="form-group mb-3">
                            <label for="Amount">ডিপোজিট টাইপ ?</label>
                            <select name="walletype" id="walletype" class="form-control" required>
                                <option value="0">নির্বাচন করুন</option>
                                @php
                                $walletTypeID = CoreProc\WalletPlus\Models\WalletType::all();
                                @endphp
                                @foreach( $walletTypeID as $key => $walletType )
                                <option value="{{ $walletType->id }}"> {{ $walletType->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="বিবরণ"> বিবরণ </label>
                            <textarea name="desc" id="desc" cols="5" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">ডিপোজিট করুন</button>
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