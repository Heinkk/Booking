@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Room List
                    </div>
                    <div class="card-body">

                        @if(session('status'))

                            <p class="alert alert-success">{{ session('status') }}</p>

                        @endif




{{--                        <div class="d-flex justify-content-between">--}}
{{--                            {{ $posts->appends(request()->all())->links() }}--}}
{{--                            <div class="">--}}
{{--                                <form>--}}
{{--                                    <div class="input-group mb-3">--}}
{{--                                        <input type="text" class="form-control" placeholder="Search Anything" name="search">--}}
{{--                                        <button class="btn btn-primary" id="button-addon2">--}}
{{--                                            <i class="fas fa-search"></i>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}


                        <table class="table  align-middle">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="">Name</th>
                                <th class="w-50">Description</th>
                                <th>Photo</th>
                                <th>Price</th>
                                <th>Features</th>
                                @if(Auth::user()->role == 0)
                                    <th>User</th>
                                @endif
                                <th>Control</th>
                                <th>Created_at</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse(\App\Models\Room::all() as $room)
                                <tr>
                                    <td>{{ $room->id }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>{{ $room->description }}</td>
                                    <td>
{{--                                        {{$room->photos}}--}}
                                        @forelse($room->photos as $photo)
                                            <a class="my-link" data-gall="gall{{ $room->id }}" href="{{ asset('storage/photo/'.$photo->name) }}">
                                                <img src="{{ asset('storage/thumbnail/'.$photo->name) }}" height="40" alt="image alt"/>
                                            </a>

                                        @empty
                                            <p class="text-muted small">No Photo</p>
                                        @endforelse
                                    </td>
                                    <td>{{ $room->price }}</td>
{{--                                    <td>--}}
{{--                                            <span class="badge bg-primary">--}}
{{--                                                {{ $post->category->title }}--}}
{{--                                            </span>--}}
{{--                                    </td>--}}
                                    <td>
                                        @foreach($room->features as $feature)
                                            <span class="badge bg-secondary small rounded-pill">
                                                    <i class="fas fa-hashtag"></i>
                                                    {{ $feature->title }}
                                                </span>
                                        @endforeach
                                    </td>
                                    @if(Auth::user()->role == 0)
                                        <td>{{ $room->user->name }}</td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-outline-primary" href="{{ route('room.show',$room->id) }}">
                                                <i class="fas fa-info fa-fw"></i>
                                            </a>
{{--                                            @can('view',$post)--}}
                                                <a class="btn btn-sm btn-outline-primary" href="{{ route('room.edit',$room->id) }}">
                                                    <i class="fas fa-pencil-alt fa-fw"></i>
                                                </a>
{{--                                            @endcan--}}
{{--                                            @can('delete',$post)--}}
                                            <button class="btn btn-outline-primary btn-sm" form="del{{ $room->id }}">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
{{--                                            @endcan--}}
                                        </div>
{{--                                        @can('delete',$post)--}}

                                        <form action="{{ route('room.destroy',$room->id) }}" class="d-none" id="del{{ $room->id }}" method="post">
                                            @csrf
                                            @method('delete')

                                        </form>
{{--                                        @endcan--}}

                                    </td>
                                    <td>
                                        {!! $room->show_created_at !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">There is no Post</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>





                    </div>
                </div>
            </div>
        </div>

        <script src="venobox/dist/venobox.min.js"></script>
    </div>

@endsection
