<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseDeteail()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,         // Model tujuan
            PurchaseDetail::class,  // Model perantara
            'purchase_id',          // FK di purchase_details ke purchases
            'id',                   // PK di products
            'id',                   // PK di purchases
            'product_id'            // FK di purchase_details ke products
        );
    }
}
