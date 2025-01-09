<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budgets extends Model
{
    use HasFactory;

    protected $table = 'budgets';

    protected $fillable = [
        'user_id',
        'category_id',
        'amount_requested',
        'amount_approved',
        'status',
        'reason',
    ];

    // M:1 budgets->users
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // M:1 budgets->categories
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
