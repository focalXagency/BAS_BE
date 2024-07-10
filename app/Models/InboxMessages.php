<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InboxMessages extends Model
{
    use HasFactory;
    protected $fillable = [
        'service' , 'name' , 'companyName' , 'number' ,
        'position' , 'email' , 'message' , 'admin_id'
    ];

    //messages belongs to one admin
    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }

}
