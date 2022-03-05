@extends('layouts.admin_layout')

@section('title', 'All Users.')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Users.</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if(count($users))
        <!-- Main content -->
        <section class="content">

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Photo
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Role
                                </th>
                                <th>
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        <img src="{{ Storage::url($user->photo->photo_path) }}" height="40" width="40"
                                             class="card-img-top"
                                             style="max-width: 30%; margin: 0 auto; display: block;">
                                    </td>
                                    <td>
                                        <a href="{{route('user.show',$user->id)}}"><strong> {{$user->name}}</strong></a>
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->role->name }}
                                    </td>
                                    <td>
                                        <form action="{{ route('user.changeStatus', $user->id) }}" method="POST"
                                              style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-flag"></i>
                                                </i>
                                                {{ $user->userBlockedOrNot() }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="project-actions text-right">

                                        <a class="btn btn-info btn-sm"
                                           href="{{ route('user.edit', $user->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                              style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="col-md-8">
                    {{$users->links()}}
                </div>

            </div><!-- /.container-fluid -->
            @else
                <div class="text-center">
                    <h2>
                        <p>No Users !</p>
                    </h2>
                </div>
        </section>
        <!-- /.content -->
    @endif
@endsection


