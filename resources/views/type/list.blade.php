<table class="table table-hover align-middle">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Owner</th>
        <th>Control</th>
        <th>Created_At</th>
    </tr>
    </thead>
    <tbody>

    @forelse(\App\Models\Type::all() as $type)
        <tr>
            <td>{{ $type->id }}</td>
            <td>{{ $type->title }}</td>
            <td>{{ $type->user->name }}</td>
            <td>

                <div class="btn btn-group">

                    <a href="{{ route('type.edit',$type->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </a>
                    <button class="btn btn-outline-primary btn-sm" form="del{{ $type->id }}">
                        <i class="fas fa-trash-alt fa-fw"></i>
                    </button>
                </div>

                <form action="{{ route('type.destroy',$type->id) }}" class="d-none" id="del{{ $type->id }}" method="post">
                    @csrf
                    @method('delete')

                </form>





            </td>
            <td>
                <p class="mb-0 small">
                    <i class="fas fa-calendar fa-fw"></i> {{ $type->created_at->format('d / m / Y') }}
                </p>
                <p class="mb-0 small">
                    <i class="fas fa-clock fa-fw"></i>
                    {{ $type->created_at->format("h:i a") }}
                </p>


            </td>
        </tr>

    @empty
        <tr>
            <td colspan="5">There is no RoomType!</td>
        </tr>
        @endforelse

    </tbody>
</table>

{{--{{ $categories->links() }}--}}
