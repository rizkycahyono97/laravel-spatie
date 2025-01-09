<x-app-layout>
  <div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white text-center py-4 bg-primary">
            <h2 class="mb-0 ">Detail Transaksi</h2>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded shadow-sm">
                        <h5 class="text-primary">Informasi Pengguna</h5>
                        <p><strong>Nama User:</strong> {{ $data->user_name }}</p>
                        <p><strong>Role:</strong> {{ $data->user_role }}</p>
                        <p><strong>Nama Kategori:</strong> {{ $data->category_name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded shadow-sm">
                        <h5 class="text-primary">Detail Transaksi</h5>
                        <p><strong>Jumlah Diminta:</strong> {{ $data->budget_amount_requested }}</p>
                        <p><strong>Jenis Transaksi:</strong> {{ $data->transaction_type }}</p>
                        <p><strong>Deskripsi:</strong> {{ $data->transaction_description }}</p>
                        <p><strong>Status:</strong> {{ $data->transaction_status }}</p>
                        <p><strong>Dibuat Pada:</strong> {{ \Carbon\Carbon::parse($data->transaction_created_at)->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light text-center py-3">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary px-4 py-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
  </div>
</x-app-layout>
