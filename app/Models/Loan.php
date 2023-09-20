<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'loan_user_id');
    }

    public function admin_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(Asset::class, 'asset_loans', 'loan_id', 'asset_id')
                        ->withPivot('unit_borrowed', 'serial_number')
                        ->withTimestamps();
    }

    // public function assetLoans()
    // {
    //     return $this->hasMany(AssetLoan::class, 'loan_code', 'loan_code');
    // }

    public function returns(): HasOne
    {
        // argument kedua, foreign key di table asset_returns
        // argument ketiga, primary key di table parent, (loans)
        return $this->hasOne(AssetReturn::class);
    }
}
