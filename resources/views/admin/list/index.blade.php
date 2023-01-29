@extends('admin.layouts.app')

@section('content')
    <div class="col-12">
        <div class="col-6 offset-3">
            {{-- alert start --}}
            @if (Session::has('deleteSuccess'))
                <div class="my-3 alert alert-success alert-dismissible text-warning fade show text-center col-8 offset-2"
                    role="alert">
                    <i class="fa-regular fa-circle-check mx-1"></i>{{ Session::get('deleteSuccess') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- alert end --}}
        </div>
        <div class="card mt-2">
            <div class="card-header py-4">
                <h3 class="card-title" style="font-size: 1.7rem">Admin List</h3>
                <div class="card-tools">
                    <form action="{{ route('admin#list') }}" method="get">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="key" value="{{ request('key') }}"
                                class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userData as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>
                                    @if ($item->id == Auth::user()->id)
                                    @else
                                        <a href="{{ route('admin#deleteAccount', $item->id) }}">
                                            <button class="btn btn-sm bg-danger text-white" title="delete">
                                                <i class="fas fa-trash-alt"></i></button></a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="d-flex justify-content-end mr-4">{{ $userData->links() }}</div>
        <!-- /.card -->
    </div>
@endsection
