<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    {{-- Welcome --}}
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body text-center gradient-bg">
                <h1 class="mb-4 fw-light">Welcome to User Role Management</h1>
                <p class="lead fw-bold">Hello, {{ auth()->user()->name }}!</p>
                <div class="divider"></div>
                <div class="role-panel">
                    @if (auth()->user()->hasRole('admin'))
                        <h2>Admin Panel</h2>
                        <p>Manage all aspects of the system effectively.</p>
                        {{-- <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Go to Admin Panel</a> --}}
                    @elseif (auth()->user()->hasRole('manager'))
                        <h2>Manager Panel</h2>
                        <p>Access the tools to manage your team and tasks.</p>
                    @elseif (auth()->user()->hasRole('staff'))
                        <h2>Staff Panel</h2>
                        <p>Work on your assigned tasks with ease.</p>
                    @else
                        <p class="text-warning">⚠️ Your role is not recognized.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contoh fitur berbasis permission -->
    {{-- @can('view reports')
        <p>Anda memiliki izin untuk melihat laporan.</p>
    @endcan
    @can('create finance data')
        <p>Anda memiliki izin untuk membuat data keuangan.</p>
    @endcan --}}

    {{-- Table Data --}}
    <div class="container mt-5" style="overflow-x: auto;">
        <h1 class="text-center mb-4 fw-bold">Transaction Data</h1>
        <div>
            <a href="{{ route('transaction.create') }}" class="btn btn-sm rounded-2 p-2 btn-primary">Create</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Category Name</th>
                        <th>Amount</th>
                        <th>Amount Approved</th>
                        <th>Transaction Type</th>
                        {{-- <th>Amount</th> --}}
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user_name }}</td>
                            <td>{{ $item->user_role }}</td>
                            <td>{{ $item->category_name ?? 'N/A' }}</td>
                            <td>{{ $item->budget_amount_requested ? number_format($item->budget_amount_requested, 0, ',', '.') : 'N/A' }}</td>
                            <td>{{ $item->budget_amount_approved ? number_format($item->budget_amount_approved, 0, ',', '.') : 'N/A' }}</td>
                            <td>{{ $item->transaction_type ?? 'N/A' }}</td>
                            {{-- <td>{{ $item->amount ?? 'N/A' }}</td> --}}
                            <td>{{ $item->transaction_description ?? 'N/A' }}</td>
                            <td>
                                @if ($item->transaction_status === 'Approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif ($item->transaction_status === 'Pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($item->transaction_status === 'Rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td>{{ $item->transaction_created_at ?? 'N/A' }}</td>
                            <td>
                                @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('staff'))
                                {{-- view --}}
                                <a href="{{ route('transaction.view', $item->category_id) }}" class="icon">
                                    <span class="material-icons">visibility</span>
                                </a>
                                    {{-- jika status sudah approved atau rejeected, maka staff cuma bisa view --}}
                                    @if (auth()->user()->hasRole('admin') || !in_array($item->transaction_status, ['Approved', 'Rejected']))
                                    {{-- edit --}}
                                    <a href="{{ route('transaction.edit', $item->category_id) }}" class="icon">
                                        <span class="material-icons">edit</span>
                                    </a>
                                    <!--  Delete -->
                                    <form action="{{ route('transaction.delete', $item->category_id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <span class="material-icons">delete</span>
                                        </button>
                                    </form>
                                    @endif
                                @elseif (auth()->user()->hasRole('manager'))
                                {{-- view --}}
                                <a href="{{ route('transaction.view', $item->category_id) }}" class="icon">
                                    <span class="material-icons">visibility</span>
                                </a>
                                @endif
                            </td> 
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4 mb-5">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>

</x-app-layout>
