<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a class="badge badge-primary showData" style="cursor: pointer" data-id="{{ $user->id }}">Show</a>
                    <a class="badge badge-warning editData" style="cursor: pointer" data-id="{{ $user->id }}">Edit</a>
                    <a class="badge badge-danger deleteData" style="cursor: pointer" data-id="{{ $user->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>