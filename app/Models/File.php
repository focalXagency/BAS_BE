<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable =[
        'admin_id' , 'user_id' , 'folder_id' ,
        'name' , 'date' , 'size' , 'type'
    ];

    //files can be controlled by only one admin
    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    //files belongs to one user
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    //each file belongs to one folder
    public function folder(){
        return $this->belongsTo(Folder::class , 'folder_id');
    }
}
