<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareDocument extends Model
{
    use HasFactory;
    protected $fillable = ['document_id', 'shared_to', 'shared_from'];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
    public function sharedToUser()
{
    return $this->belongsTo(User::class, 'shared_to');
}
}
