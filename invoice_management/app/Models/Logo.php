<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = ['customerId', 'logo'];

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
