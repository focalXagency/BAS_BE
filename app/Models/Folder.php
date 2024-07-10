<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $fillable = [
      'name' , 'size' , 'creation_date' , 'admin_id' , 'user_id'
    ];

    //folders can be controlled by only one admin
    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    //folders belongs to one user
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    //folder has many files inside of it
    public function files(){
        return $this->hasMany(File::class , 'folder_id');
    }
}
