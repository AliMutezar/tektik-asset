<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetReturn extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function loan(): BelongsTo
    {
        // argument kedua, foreign key di table asset_returns
        // argument ketiga, primary key di table parent (loans)
        return $this->belongsTo(Loan::class);
    }
}