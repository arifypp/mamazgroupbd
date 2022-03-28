@extends('layouts.master')

@section('title') জমির রিজার্ভ এডিট করুন @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

@component('components.breadcrumb')
    @slot('li_1') জমির রিজার্ভ এডিট করুন @endslot
    @slot('title') জমির রিজার্ভ এডিট করুন @endslot
@endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <form action="{{ route('landreserve.update', $landreseve->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="এস এফ টি">এস এফ টি</label>
                                <input type="number" class="form-control" name="sft" placeholder="Enter SFT number"  value="{{ old('lcname', $landreseve->sft)}}">
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="ক্যাটাগরি">জমি</label>
                                <select name="landid" id="" class="form-control">
                                    <option value="0">নির্বাচন করুন</option>
                                    @foreach(App\Models\Backend\Landcat::orderby('id', 'desc')->get() as $landid )
                                    <option value="{{ $landid->id }}" @if( $landid->id ==  $landreseve->land_cat) selected @endif >{{ $landid->mainland }} বিগা</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-block w-100">
                                আপডেট করুন
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
