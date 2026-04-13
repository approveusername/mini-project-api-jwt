<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    protected $table = 'books';
    
    protected $fillable = [
        'title', 'author', 'cover_image', 'price', 'published_date', '_deleted'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'published_date' => 'date',
        '_deleted' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('_deleted', false);
    }

    public function softDelete()
    {
        $this->_deleted = true;
        return $this->save();
    }
}