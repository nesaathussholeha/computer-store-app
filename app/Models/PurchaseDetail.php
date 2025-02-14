<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseDetailFactory> */
    use HasFactory;

    protected $fillable = ['purchase_id', 'product_id', 'jumlah_beli', 'sub_total'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
