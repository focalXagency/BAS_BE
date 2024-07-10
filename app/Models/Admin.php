<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'email' , 'password'
    ];


    //Admin can control many company profiles
    public function companyProfiles(){
        return $this->hasMany(Company_Profile::class , 'admin_id');
    }

    //admin has many case studies
    public function caseStudies(){
        return $this->hasMany(Case_Study::class , 'admin_id');
    }

    //admin controls many files
    public function files(){
        return $this->hasMany(File::class , 'admin_id');
    }

    //admin controls many folders
    public function folders(){
        return $this->hasMany(Folder::class , 'admin_id');
    }

    //admin recsives many messages through the contact us form
    public function messages(){
        return $this->hasMany(InboxMessages::class , 'admin_id');
    }
}
