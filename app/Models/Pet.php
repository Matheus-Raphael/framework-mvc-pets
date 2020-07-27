<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'age', 'users_id'];

    public function user()
    {
        // $this->belongsTo('App\Models\User');
         return $this->belongsTo(User::class, 'users_id', 'id');
        //return $this->belongsTo(User::class);
    }
}
