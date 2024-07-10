<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Case_Study extends Model
{
    use HasFactory;
    protected $fillable  = [
        'category_id' , 'logo' , 'path' ,
        'company_name' , 'order'
    ];

    //Case studies belongs to only one admin
    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    //case study belongs to one user
    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function category(){
        return $this->hasOne(CaseStudyCategory::class, 'id' , 'category_id');
    }

}
