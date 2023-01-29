@extends('admin.layouts.app')

@section('content')
    <div class="col-9 offset-2 mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Edit Post</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form class="form-horizontal" method="post"
                                action="{{ route('admin#updatePost', $post->post_id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="postTitle" class="form-control"
                                            value="{{ old('postTitle', $post->title) }}" placeholder="Title">
                                        @error('postTitle')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="postDescription" cols="30" rows="5" placeholder="Description">{{ old('postDescription', $post->description) }}</textarea>
                                        @error('postDescription')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        @if ($post->image != null)
                                            <img src="{{ asset('postImage/' . $post->image) }}"
                                                class="rounded shadow w-100 img-thumbnail" style="height: 400px">
                                        @else
                                            <img src="{{ asset('defaultImage/default.png') }}"
                                                class="rounded shadow w-100 img-thumbnail" style="height: 400px">
                                        @endif
                                        <input type="file" name="postImage" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select name="postCategory" class="form-control">
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}"
                                                    @if ($post->category_id == $category->category_id) selected @endif>
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('postCategory')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-9">
                                        <button type="submit" class="btn bg-dark text-white px-4">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
