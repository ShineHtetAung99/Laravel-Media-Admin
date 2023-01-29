@extends('admin.layouts.app')

@section('content')
    <div class="col-9 offset-2 mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
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
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible text-warning fade show text-center col-8 offset-2"
                                    role="alert">
                                    <i class="fa-regular fa-circle-check mx-1"></i>{{ Session::get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- alert end --}}
                            <form class="form-horizontal" method="post" action="{{ route('admin#update') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="adminName" class="form-control"
                                            value="{{ old('adminName', $user->name) }}" placeholder="Name">
                                        @error('adminName')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="adminEmail" class="form-control"
                                            value="{{ old('adminEmail', $user->email) }}" placeholder="Email">
                                        @error('adminEmail')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="adminPhone" class="form-control"
                                            value="{{ $user->phone }}" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="adminAddress" cols="30" rows="5" placeholder="Address">{{ $user->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-9">
                                        <select name="adminGender" id="" class="form-control">
                                            @if ($user->gender == 'male')
                                                <option value="">Choose Your Option</option>
                                                <option value="male" selected>Male</option>
                                                <option value="female">Female</option>
                                            @elseif ($user->gender == 'female')
                                                <option value="">Choose Your Option</option>
                                                <option value="male">Male</option>
                                                <option value="female" selected>Female</option>
                                            @else
                                                <option value="" selected>Choose Your Option</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-9">
                                        <button type="submit" class="btn bg-dark text-white">Update</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-9">
                                        <a href="{{ route('admin#changePasswordPage') }}">Change Password</a>
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
