@extends('Backend.Agent.includes.main')

@section('title') মোট ব্যবহারকারী  @endsection

@section('css')
    <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') মোট ব্যবহারকারী  @endslot
        @slot('title') মোট ব্যবহারকারী  @endslot
    @endcomponent

    <!-- Starting content -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table-responsive table align-middle">
                        <thead>
                            <th>ক্র. নং</th>
                            <th>ছবি</th>
                            <th>নাম</th>
                            <th>আইডি</th>
                            <th>লেভেল</th>
                            <th>স্ট্যাটাস</th>
                        </thead>
                        <tbody>
                            @php 
                                $i = 1;
                            @endphp
                            @foreach( $user as $value )
                            @php 
                                $refuser = App\Models\User::where('referrer_id', $value->id)->get();
                                
                            @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td> <img src="{{ asset($value->avatar) }}" alt="{{$value->name}}" class="img-fluid img-rounded" width="20"> </td>
                                <td> 
                                   @if( ( count($refuser) != 0 ) )
                                        @foreach( $refuser as $listuser )
                                        <a href="{{ route('user.referel', $listuser->referrer_id) }}"> {{ $listuser->name }} </a>
                                        @endforeach
                                    @else
                                        {{ __($value->name) }}
                                    @endif
                                </td>
                                <td>{{ $value->username }}</td>
                                <td>
                                    @if( $value->auth_promote == 0 )
                                    <span class="text-success">Project Co-Ordinator</span>
                                    @elseif( $value->auth_promote == 1 )
                                        <span class="text-success">Marketing Executive</span>
                                    @elseif( $value->auth_promote == 2 )
                                        <span class="text-success">Assitant General Manager</span>
                                    @elseif( $value->auth_promote == 3 )
                                    <span class="text-success">General Manager</span>
                                    @elseif( $value->auth_promote == 4 )
                                    <span class="text-success">Project Director</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $value->status == 0 )
                                    <span class="text-success">active</span>
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>
                              
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
