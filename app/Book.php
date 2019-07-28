<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=['category_id', 'title', 'author', 'isbn', 'public_year', 'publisher', 'available'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function loans()
    {
        return $this->hasMany(Loan::class, 'book_id');
    }

    public function isAvailable()
    {
        $status = false;
        if ($this->available > 0) {
            $status = true;
        }
        return $status;
    }
    
}

