<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class MyProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity'
    ];

    public function product()
    {
        return MyProduct::where('id', $this->product_id)->first();
    }
    public function productSwatch()
    {
        return MyProductSwatch::where('product_id', $this->product_id)->first();
    }

    public function getBadge()
    {
        if($this->quantity > 3) {
            return '<span class="bg-blue-200 text-blue-600 rounded-md text-sm py-1 px-2">En stock</span>';
        } else {
            return '<span class="bg-orange-200 text-orange-600 rounded-md text-sm py-1 px-2">Stock faible</span>';
        }
    }

    public function getupdatedDate()
    {
        if (strtotime($this->updated_at) == strtotime(Carbon::now())) {
            return 'Aujourd\'hui';
        } else {
            return date('d/m/Y', strtotime($this->updated_at));
        }
    }
}
