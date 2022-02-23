@extends('layouts.admin_layout')

@section('title', 'User.')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="col-md-12">
                            <img src="{{ Storage::url($user->photo->photo_path) }}" height="400" width="300" class="card-img-top"
                                 style="max-width: 45%; margin: 0 auto; display: block;">

                            <h3 class="text-center"> {{ __ ('Name -'.$user->name) }} </h3>
                            <h3 class="text-center"> {{ __ ('Email-'.$user->email) }} </h3>
                            <h3 class="text-center"> {{ __ ('Role-'.$user->role->name) }} </h3>
                            <h3 class="text-center"> Blocked-{{ __ ($user->blocked ) ? 'true' : 'false' }} </h3>
                        </div>
                            <div class="row justify-content-center">
                                <div class="btn-group">
                                    <a href="{{ url()->previous() }}"
                                       class="btn btn-sm btn-outline-dark">{{ __('Back') }}</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
