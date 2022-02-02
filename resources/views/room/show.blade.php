@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ $room->name }}
                    </div>
                    <div class="card-body">
                        <p class="h3 text-center">Description</p>
                        {{ $room->description }}
                        <hr>
                        <p class="h3 text-center">Price</p>
                        ${{ $room->price }}


                        <hr>
                        <a href="{{ route('room.index') }}" class="btn btn-primary w-100">Previous</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
