@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="col-md-12">
                            <img src="{{ Storage::url(Auth::user()->photo->photo_path) }}" height="400" width="300" class="card-img-top"
                                 style="max-width: 45%; margin: 0 auto; display: block;">

                            <h3 class="text-center"> {{ __ ('Name -'.Auth::user()->name) }} </h3>
                            <h3 class="text-center"> {{ __ ('Email-'.Auth::user()->email) }} </h3>
                            <h3 class="text-center"> {{ __ ('Role-'.Auth::user()->role->name) }} </h3>
                            <h3 class="text-center"> Blocked-{{ __ (Auth::user()->blocked ) ? 'true' : 'false' }} </h3>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
