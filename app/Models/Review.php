<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name' , 'position' , 'review' ,
        'companyName' , 'order'
    ];

    //review belongs to only one user
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }
}
