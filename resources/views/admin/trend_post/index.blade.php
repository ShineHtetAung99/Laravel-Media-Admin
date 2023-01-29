@extends('admin.layouts.app')

@section('content')
    <div class="col-12 mt-2 mb-5">
        <div class="card mt-2">
            <div class="card-header py-4">
                <h3 class="card-title" style="font-size: 1.7rem">Trend Post List</h3>

                <div class="card-tools">
                    <form action="{{ route('admin#trendPost') }}" method="get">
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
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Post ID</th>
                            <th>Post Title</th>
                            <th>Image</th>
                            <th>View Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $item)
                            <tr>
                                <td style="vertical-align: middle">{{ $item->post_id }}</td>
                                <td style="vertical-align: middle">{{ $item->title }}</td>
                                <td style="vertical-align: middle">
                                    @if ($item->image == null)
                                        <img src="{{ asset('defaultImage/default.png') }}" class="rounded shadow"
                                            style="width: 150px; height:100px">
                                    @else
                                        <img src="{{ asset('postImage/' . $item->image) }}" class="rounded shadow"
                                            style="width: 150px; height:100px">
                                    @endif
                                </td>
                                <td style="vertical-align: middle">
                                    <h5><i class="fa-solid fa-eye mr-2"></i>{{ $item->post_count }}</h5>
                                </td>
                                <td style="vertical-align: middle">
                                    <a href="{{ route('admin#detailsTrendPost', $item->post_id) }}">
                                        <button class="btn btn-sm bg-dark text-white" title="view">
                                            <i class="fa-solid fa-file-lines"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        {{-- <div class="justify-content-end d-flex mr-5">{{ $post->links() }}</div> --}}
        <!-- /.card -->
    </div>
@endsection
