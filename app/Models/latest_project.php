<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class latest_project extends Model
{
    use HasFactory;
    protected $fillable = [
        'companyName' , 'serviceProvided' ,
        'descirption' , 'CEOName'
    ];

    //project has many logos
    public function logos(){
        return $this->hasMany(Project_logo::class , 'project_id');
    }
}
