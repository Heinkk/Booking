@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Manage RoomType
                    </div>
                    <div class="card-body">

                        <form action="{{ route('type.store') }}" class="mb-3" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-4">
                                    <div class="">
                                        <input type="text" name="title" value="{{ old('title') }}" placeholder="New Type Name" class="form-control @error('title') is-invalid @enderror">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-primary">Add RoomType</button>
                                </div>
                            </div>
                            @error('title')
                            <p class="text-danger small mt-2">{{ $message }}</p>
                            @enderror

                        </form>

                        @if(session('status'))

                            <p class="alert alert-success">{{ session('status') }}</p>

                        @endif


                        @include('type.list')

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
