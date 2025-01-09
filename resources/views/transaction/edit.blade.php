<x-app-layout>
  <div class="container">
    <h2 class="fs-3 m-3">Edit Transaction</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('transaction.update', ['id' => $transaction->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Form untuk Categories -->
        <div class="form-group m-3">
            <label for="name">Category Name</label>
            <select name="name" id="name" class="form-control">
                <option value="" disabled {{ old('name', $transaction->name ?? '') == '' ? 'selected' : '' }}>-- Pilih Nama Categori--</option>
                <option value="Gaji" {{ old('name', $transaction->name ?? '') == 'Gaji' ? 'selected' : '' }}>Gaji</option>
                <option value="Operasional" {{ old('name', $transaction->name ?? 'Operasional') == 'Operasional' ? 'selected' : '' }}>Operasional</option>
                <option value="Investasi" {{ old('name', $transaction->name ?? 'Investasi') == 'Investasi' ? 'selected' : '' }}>Investasi</option>
            </select>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Form untuk Budgets -->
        @if (auth()->user()->hasRole('staff'))
        <div class="form-group m-3">
            <label for="amount_requested">Amount</label>
            <input type="text" 
                   class="form-control" 
                   id="amount_requested" 
                   name="amount_requested" 
                   value="{{ old('amount_requested', $budgets->amount_requested ?? '') }}"
                   required>
            @error('amount_requested')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @elseif (auth()->user()->hasRole('admin'))
        <div class="form-group m-3">
            <label for="amount_requested">Amount</label>
            <input type="text" 
                   class="form-control" 
                   id="amount_requested" 
                   name="amount_requested" 
                   value="{{ old('amount_requested', $budgets->amount_requested ?? '') }}"
                   readonly>
            @error('amount_requested')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endif

        @if (auth()->user()->hasRole('admin'))
        <div class="form-group m-3">
            <label for="amount_approved">Amount Approved</label>
            <input type="text" 
                   class="form-control" 
                   id="amount_approved" 
                   name="amount_approved" 
                   value="{{ old('amount_approved', $budgets->amount_approved ?? '') }}"
                   required>
            @error('amount_approved')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @elseif (auth()->user()->hasRole('staff'))
        @endif
        
        <!-- Form untuk Transaction -->
        <div class="form-group m-3">
            <label for="type">Transaction Type</label>
            <select name="type" id="type" class="form-control">
                <option value="" disabled {{ old('type', $transaction->type ?? '') == '' ? 'selected' : '' }}>--Jenis Transaksi--</option>
                <option value="Pendapatan" {{ old('type', $transaction->type ?? 'Pendapatan') == 'Pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                <option value="Pengeluaran" {{ old('type', $transaction->type ?? 'Pengeluaran') == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
            </select>

            @error('type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group m-3">
            <label for="description">Description</label>
            <input type="text" 
                   class="form-control" 
                   id="description" 
                   name="description" 
                   value="{{ old('description', $transaction->description ?? '') }}"
                   required>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        @if (auth()->user()->hasRole('admin'))
        <div class="form-group m-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="" disabled {{ old('status', $transaction->status ?? '') == '' ? 'selected' : '' }}>-- Pilih Status Transaksi --</option>
                <option value="Approved" {{ old('status', $transaction->status ?? '') == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ old('status', $transaction->status ?? '') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="Pending" {{ old('status', $transaction->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
            </select>

            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endif

        <div class="form-group m-3">
            <label for="created_at">Created at</label>
            <input type="date" class="form-control" id="created_at" name="created_at" value="{{ $transaction->created_at ? $transaction->created_at->format('Y-m-d') : '' }}">
            @error('created_at')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
    document.querySelector('form').addEventListener('submit', function (event) {
    const statusSelect = document.getElementById('status');
    if (!statusSelect.value) {
        alert('Silakan pilih status transaksi!');
        event.preventDefault();
    }
});

</script>
</x-app-layout>
