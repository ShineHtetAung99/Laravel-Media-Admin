@extends('admin.layouts.app')

@section('content')
    {{-- alert start --}}
    @if (Session::has('createSuccess'))
        <div class="alert alert-success alert-dismissible text-warning fade show text-center col-6 offset-3 mt-2"
            role="alert">
            <i class="fa-regular fa-circle-check mx-1"></i>{{ Session::get('createSuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session::has('deleteSuccess'))
        <div class="alert alert-success alert-dismissible text-warning fade show text-center col-6 offset-3 mt-2"
            role="alert">
            <i class="fa-regular fa-circle-check mx-1"></i>{{ Session::get('deleteSuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session::has('updateSuccess'))
        <div class="alert alert-success alert-dismissible text-warning fade show text-center col-6 offset-3 mt-2"
            role="alert">
            <i class="fa-regular fa-circle-check mx-1"></i>{{ Session::get('updateSuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{-- alert end --}}

    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-header py-4">
                <h3 class="card-title" style="font-size: 1.7rem">Category List</h3>

                <div class="card-tools">
                    <form action="{{ route('admin#category') }}" method="get">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="key" class="form-control float-right" placeholder="Search"
                                value="{{ request('key') }}">

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
                <a href="{{ route('admin#createCategoryPage') }}" class="btn btn-info w-100 mb-3">Create Category</a>
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->category_id }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <a href="{{ route('admin#editCategory', $category->category_id) }}">
                                        <button class="btn btn-sm bg-dark text-white" title="edit"><i
                                                class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#deleteCategory', $category->category_id) }}">
                                        <button class="btn btn-sm bg-danger text-white" title="delete">
                                            <i class="fas fa-trash-alt"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="d-flex justify-content-end mr-4">{{ $categories->links() }}</div>
        <!-- /.card -->
    </div>
@endsection
