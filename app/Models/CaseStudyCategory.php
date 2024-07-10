<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudyCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function CaseStudy(){
        return $this->hasMany(Case_Study::class);
    }
}
