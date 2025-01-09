<x-app-layout>
  <div class="container">
    <h1 class="mb-4 mt-3 fs-2">Users</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-4">Add New User</a>

    <table class="table table-striped table-bordered">
        <thead class="bg-primary text-white"  >
            <tr>
                <th>No</th>
                <th>User Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="icon">
                          <span class="material-icons">edit</span>
                        </a>
                        
                        <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="icon" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                              <span class="material-icons">delete</span>
                          </button>
                      </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>