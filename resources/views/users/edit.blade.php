<x-app-layout>
  <div class="container">
    <h1 class="mb-4 fs-2 mt-3">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" >
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                <option value="manager" {{ $user->hasRole('manager') ? 'selected' : '' }}>Manager</option>
                <option value="staff" {{ $user->hasRole('staff') ? 'selected' : '' }}>Staff</option>
            </select>
        </div>

        <div>
          <button type="submit" class="btn btn-success mt-3">Update User</button>
          <button class="btn btn-success mt-3"><a href="{{ route('users.index') }}">Back</a></button>
        </div>
    </form>
  </div>
</x-app-layout>
