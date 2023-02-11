<table class="table align-items-center table-flush table-hover data" style="text-align: center">
    <thead class="thead-light">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Avatar</th>
        <th>Email</th>
        <th>Phone</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($users) > 0)
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{  $user->name }}</td>
                <td>
                    <img width="100" height="100"
                         src="{{ asset('assets/uploads/user/' . $user->avatar) }}"
                         alt="">
                </td>

                <td>{{ $user->email}}</td>
                <td>{{ $user->phone}}</td>
                <td>
                    <button type="button" data-id="{{ $user->id }}"
                            data-url="{{ route('products.show', $user->id) }}"
                            class="btn btn-info btn-detail-product">
                        View
                    </button>
                </td>
                <td>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                        Edit</a>
                </td>
                <td>
                    <button data-url="{{ route('user.delete', $user->id) }}"
                            class="btn btn-danger delete-user">
                        Delete</button>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8">Không có user</td>
        </tr>
    @endif
    </tbody>
</table>
    <div>{{ $users->links() }}</div>

