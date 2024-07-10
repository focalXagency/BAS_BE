<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_logo extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo' , 'path' , 'order'
    ];

    //logo belongs to one project
    public function project(){
        return $this->belongsTo(latest_project::class , 'project_id');
    }
}
