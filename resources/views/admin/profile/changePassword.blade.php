@extends('admin.layouts.app')

@section('content')
    <div class="col-9 offset-2 mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- alert start --}}
                            @if (Session::has('updateSuccess'))
                                <div class="alert alert-success alert-dismissible text-warning fade show text-center col-8 offset-2"
                                    role="alert">
                                    <i class="fa-regular fa-circle-check mx-1"></i>{{ Session::get('updateSuccess') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger alert-dismissible text-warning fade show text-center col-8 offset-2"
                                    role="alert">
                                    <i class="fa-regular fa-circle-check mx-1"></i>{{ Session::get('fail') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- alert end --}}
                            <form class="form-horizontal" method="post" action="{{ route('admin#changePassword') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Old Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="oldPassword" class="form-control" value=""
                                            placeholder="Old Password">
                                        @error('oldPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="newPassword" class="form-control" value=""
                                            placeholder="New Password">
                                        @error('newPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="confirmPassword" class="form-control" value=""
                                            placeholder="Confirm Password">
                                        @error('confirmPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn bg-dark text-white">Change Password</button>
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
