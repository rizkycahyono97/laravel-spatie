<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Budgets;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
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
                'budgets.amount_requested as budget_amount_requested',
                'budgets.amount_approved as budget_amount_approved',
            )
            ->paginate(10);
    

        // spatie debugging
        // $user = auth()->user();
        // dd($user->getRoleNames(), $user->role); 
        // if (!$user->hasRole('admin')) {
        //     abort(403, 'User does not have the right roles.');
        // }

        return view('dashboard', compact('data'));
    }
}
