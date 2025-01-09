<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];

    // 1:M categories->transaction
    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'category_id');
    }

    // 1:M categories->budgets
    public function budgets()
    {
        return $this->hasMany(Budgets::class, 'budgets_id');
    }
}
