@extends('admin.layouts.app')

@section('content')
    <div class="col-9 offset-2 mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Create Post</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form class="form-horizontal" method="post" action="{{ route('admin#createPost') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="postTitle" class="form-control"
                                            value="{{ old('postTitle') }}" placeholder="Title">
                                        @error('postTitle')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="postDescription" cols="30" rows="5" placeholder="Description">{{ old('postDescription') }}</textarea>
                                        @error('postDescription')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="postImage" class="form-control" value=""
                                            placeholder="">
                                        @error('postImage')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select name="postCategory" class="form-control">
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('postCategory')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-9">
                                        <button type="submit" class="btn bg-dark text-white px-4">Create</button>
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
