<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'user_id',
        'category_id',
        'type',
        'amount',
        'description',
        'status',
    ];

    // M:1 transaction->users
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // M:1 transaction->categories
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
