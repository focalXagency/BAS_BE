<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name' , 'description' , 'industry' ,
        'location' , 'intro' , 'company_problem' ,
        'logo' , 'path' , 'solution'
    ];

    //company profiles can be controlled by only one admin
    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }
    
}
