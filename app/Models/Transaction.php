<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'amount', 'type', 'description', 'date'];

    protected $dates = ['date'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $validator = Validator::make($transaction->toArray(), [
                'amount' => [
                    'required',
                    'numeric',
                    'min:0.01',
                    'max:99999999.99',
                    'regex:/^\d+(\.\d{1,2})?$/',
                    function ($attribute, $value, $fail) {
                        if (is_nan($value) || !is_finite($value) || strpos(strtolower($value), 'e') !== false) {
                            $fail('Wartość kwoty jest nieprawidłowa.');
                        }
                    }
                ],
            ]);

            if ($validator->fails()) {
                throw new \Illuminate\Validation\ValidationException($validator);
            }
        });

        static::updating(function ($transaction) {
            $validator = Validator::make($transaction->toArray(), [
                'amount' => [
                    'required',
                    'numeric',
                    'min:0.01',
                    'max:99999999.99',
                    'regex:/^\d+(\.\d{1,2})?$/',
                    function ($attribute, $value, $fail) {
                        if (is_nan($value) || !is_finite($value) || strpos(strtolower($value), 'e') !== false) {
                            $fail('Wartość kwoty jest nieprawidłowa.');
                        }
                    }
                ],
            ]);

            if ($validator->fails()) {
                throw new \Illuminate\Validation\ValidationException($validator);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value);
    }
}
