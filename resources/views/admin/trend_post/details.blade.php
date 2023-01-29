@extends('admin.layouts.app')

@section('content')
    <div class="col-6 offset-3 my-5 shadow bg-white">
        <h3 class="mt-3 ml-3"><a href="{{ route('admin#trendPost') }}"><i class="fa-solid fa-arrow-left text-dark"></i></a>
        </h3>
        <div class="card-header">
            <div class="text-center">
                @if ($details->image != null)
                    <img src="{{ asset('postImage/' . $details->image) }}" class="rounded shadow-sm w-100 img-thumbnail"
                        style="height: 400px">
                @else
                    <img src="{{ asset('defaultImage/default.png') }}" class="rounded shadow-sm w-100 img-thumbnail"
                        style="height: 400px">
                @endif
            </div>
        </div>
        <div class="card-body">
            <h2 class="text-center">{{ $details->title }}</h2>
            <p class="text-start">{{ $details->description }}</p>
        </div>
        <div class="ml-3 mb-5">
            <a href="{{ route('admin#trendPost') }}"><button class="btn btn-dark">Back</button></a>
        </div>
    </div>
@endsection
