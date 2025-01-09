<x-app-layout>
<div class="container">
  <h1 class="mb-4">Add New User</h1>

  <form action="{{ route('users.store') }}" method="POST">
      @csrf
      <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" required>
      </div>

      <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" required>
      </div>

      <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
      </div>

      <div class="form-group">
          <label for="role">Role</label>
          <select name="role" id="role" class="form-control" required>
              <option value="admin">Admin</option>
              <option value="manager">Manager</option>
              <option value="staff">Staff</option>
          </select>
      </div>

      <div class="div">
        <button type="submit" class="btn btn-success mt-3">Create User</button>
        <button class="btn btn-success mt-3"><a href="{{ route('users.index') }}">Back</a></button>
      </div>
  </form>
</div>
</x-app-layout>
