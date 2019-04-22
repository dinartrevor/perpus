<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable=['member_id', 'book_id', 'no_loan', 'start_date', 'end_date', 'return_date', 'punishment'];

    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function books()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
