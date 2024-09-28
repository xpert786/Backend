<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = ['customerId','folder_id', 'documents'];

    public function sharedocument()
    {
        return $this->hasMany(ShareDocument::class);
    }
}
