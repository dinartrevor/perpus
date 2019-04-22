<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['no_member', 'name', 'city', 'address', 'phone_number'];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'member_id');
    }
}
