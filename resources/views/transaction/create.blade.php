<x-app-layout>
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold">Tambah Data</h1>
    <!-- Alert untuk sukses atau error -->
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

    <!-- Form -->
    <form action="{{ route('transaction.store') }}" method="POST">
        @csrf

        <!-- Nama Kategori -->
        <div class="mb-3">
          <label for="name" class="form-label">Category Name</label>
          <select name="name" id="name" class="form-select" required>
                  <option value="null" selected>-- Pilih Nama Kategori --</option>
                  <option value="Gaji">Gaji</option>
                  <option value="Operasional">Operasional</option>
                  <option value="Investasi">Investasi</option>
          </select>
          <div id="error-handling" class="text-danger" style="display:none;">
              Harap pilih Gardu Induk terlebih dahulu.
          </div>
      </div>

        <!-- Amount Requested -->
        <div class="mb-3">
            <label for="amount_requested" class="form-label">Amount</label>
            <input type="number" class="form-control @error('amount_requested') is-invalid @enderror" id="amount_requested" name="amount_requested" value="{{ old('amount_requested') }}" required>
            @error('amount_requested')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Jenis Transaksi -->
        <div class="mb-3">
          <label for="type" class="form-label">Transaction Type</label>
          <select name="type" id="type" class="form-select" required>
                  <option value="null" selected>-- Jenis Transaksi --</option>
                  <option value="Pendapatan">Pendapatan</option>
                  <option value="Pengeluaran">Pengeluaran</option>
          </select>
          <div id="error-handling" class="text-danger" style="display:none;">
              Harap pilih Gardu Induk terlebih dahulu.
          </div>
      </div>

        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tanggal Dibuat -->
        <div class="mb-3">
            <label for="created_at" class="form-label">Created Date</label>
            <input type="date" class="form-control @error('created_at') is-invalid @enderror" id="created_at" name="created_at" value="{{ old('created_at') }}" required>
            @error('created_at')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <div class="d-flex justify-content-start gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-secondary" href="{{ route('dashboard') }}">Back</a>
        </div>
    </form>
</div>
</x-app-layout>

