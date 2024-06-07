<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'amount', 'type', 'description', 'date',
    ];

    protected $dates = [
        'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value);
    }
}
