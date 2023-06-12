<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetLoan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function loan()
    // {
    //     return $this->belongsTo(Loan::class, 'loan_code', 'loan_code');
    // }

    // public function asset()
    // {
    //     return $this->belongsTo(Asset::class, 'asset_id');
    // }
}

