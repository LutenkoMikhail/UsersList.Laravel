@extends('layouts.admin_layout')

@section('title','Main')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@yield('title')</h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$countUsers}}</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-newspaper"></i>
                    </div>
                    <a href="{{route('user.index')}}" class="small-box-footer">Users <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->

            </div>

        </div>
        <!-- /.row -->
        <!-- Main row -->

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
