<?php

namespace App\Http\Controllers;

use App\Models\Budgets;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class TransactionController extends Controller
{
    // create
    public function create()
    {
        $categories = DB::table('categories')->select('name')->get();

        return view('transaction.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            // validation
            $request->validate([
                'name' => 'required|string',
                'amount_requested' => 'numeric|string',
                'type' => 'required|string',
                'description' => 'required|string',
                'created_at' => 'required|date'
            ]);
            
            // simpan data
            // table categories
            $categories = new Categories();
            $categories->name = $request->name;
            $categories->save();
    
            //table budgets
            $budgets = new Budgets();
            $budgets->user_id = auth()->id(); // FK berdasarkan id user yang login
            $budgets->category_id = $categories->id; // fk
            $budgets->amount_requested = $request->amount_requested; 
            $budgets->save();
    
            // table transaction
            $transaction = new Transaction();
            $transaction->user_id = auth()->id();
            $transaction->category_id = $categories->id; // fk
            $transaction->type = $request->type;
            $transaction->description = $request->description;
            $transaction->status = $request->status ?? 'Pending'; // otomatis status menjadi Pending
            $transaction->created_at = $request->created_at;
            $transaction->save();

            return redirect()->route('dashboard')->with('success', 'Transaction updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // edit
    public function edit ($id)
    {
        try {
            $categories = Categories::findOrFail($id);

            // table transaction
            $transaction = Transaction::findOrFail($id);

            // table budgets
            $budgets = Budgets::findOrFail($id);

            return view('transaction.edit', compact('categories', 'transaction', 'budgets'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update (Request $request, $id)
    {
        try {

            // ambil data
            $categories = Categories::findOrFail($id);
            $budgets = Budgets::findOrFail($id);
            $transaction = Transaction::findOrFail($id);

            // Cek apakah user adalah staff dan status tidak boleh diubah
            if (!auth()->user()->hasRole('admin') && in_array($transaction->status, ['Approved', 'Rejected'])) {
                return back()->with('error', 'Anda tidak dapat mengedit laporan dengan status "Approved" atau "Rejected".');
            }

            // validation
            $request->validate([
                'name' => 'nullable|string',
                'amount_requested' => 'nullable|string',
                'amount_approved' => 'nullable|string',
                'type' => 'nullable|string',
                'description' => 'nullable|string',
                'status' => [
                    // validasi admin wajib mengganti status
                    function ($attribute, $value, $fail) use ($request, $transaction) {
                        if (auth()->user()->hasRole('admin')) {
                            if ($transaction->status === 'Pending' && empty($value)) {
                                $fail('Status wajib diubah menjadi "Approved" atau "Rejected" ketika memberikan nilai Amount Approved.');
                            }
    
                            if ($value === 'Pending' && $request->input('amount_approved')) {
                                $fail('Admin tidak boleh menyimpan status sebagai "Pending" setelah memberikan Amount Approved.');
                            }
                        }
                    },
                ],
                'created_at' => 'nullable|date'
            ]);

            // 1. table categories
            $categories->update([
                'name' => $request->input('name')
            ]);

            // 2. table budgets
            $budgets->update([
                'amount_requested' => $request->input('amount_requested'),
                'amount_approved' => $request->input('amount_approved')
            ]);

            // 3. table transaction
            $transaction->update([
                'type' => $request->input('type'),
                'description' => $request->input('description'),
                'status' => $request->input('status') ?? 'Pending',
                'created_at' => $request->input('created_at')
            ]);

            return redirect()->route('dashboard', ['id' => $id])
            ->with('success', 'Data berhasil diupdate');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // view
    public function view ($id)
    {
        try {
            $data = DB::table('users')
            ->join('transaction', 'users.id', '=', 'transaction.user_id')
            ->join('categories', 'transaction.category_id', '=', 'categories.id')
            ->join('budgets', function ($join) {
                $join->on('users.id', '=', 'budgets.user_id')
                     ->on('categories.id', '=', 'budgets.category_id');
            })
            ->select(
                'users.name as user_name',
                'users.role as user_role',
                'transaction.type as transaction_type',
                'transaction.description as transaction_description',
                'transaction.status as transaction_status',
                'transaction.created_at as transaction_created_at',
                'categories.id as category_id',
                'categories.name as category_name',
                'budgets.amount_requested as budget_amount_requested'
            )
            ->where('transaction.id', $id)
            ->first();

            if (!$data) {
                return back()->with('error', 'Data tidak ditemukan.');
            }
    
            return view('transaction.view', compact('data'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // delete
    public function delete ($id)
    {
        try {
            Transaction::where('category_id', $id)->delete();
            Budgets::where('category_id', $id)->delete();

            $categories = Categories::findOrFail($id);

            // Cek apakah user adalah staff dan status tidak boleh dihapus
            if (!auth()->user()->hasRole('admin') && in_array($transaction->status, ['Approved', 'Rejected'])) {
                return back()->with('error', 'Anda tidak dapat menghapus laporan dengan status "Approved" atau "Rejected".');
            }

            $categories->delete();

            return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
