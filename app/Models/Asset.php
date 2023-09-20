<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class);
    }

   

    public function categoryAsset(): BelongsTo {
        return $this->belongsTo(CategoryAsset::class);
    }
}
