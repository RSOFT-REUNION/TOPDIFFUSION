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

    public function getupdatedDate()
    {
        if (strtotime($this->updated_at) == strtotime(Carbon::now())) {
            return 'Aujourd\'hui';
        } else {
            return date('d/m/Y', strtotime($this->updated_at));
        }
    }
}
