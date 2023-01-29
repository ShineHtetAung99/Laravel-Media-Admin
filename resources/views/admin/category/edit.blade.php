@extends('admin.layouts.app')

@section('content')
    <div class="col-9 offset-2 mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Edit Category</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form class="form-horizontal" method="post"
                                action="{{ route('admin#updateCategory', $category->category_id) }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="categoryTitle" class="form-control"
                                            value="{{ old('categoryTitle', $category->title) }}" placeholder="Title">
                                        @error('categoryTitle')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="categoryDescription" cols="30" rows="5" placeholder="Description">{{ old('categoryDescription', $category->description) }}</textarea>
                                        @error('categoryDescription')
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
