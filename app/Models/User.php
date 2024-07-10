<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use App\Permissions\HasPermissionsTrait;
class User extends Authenticatable
{
    use  HasFactory, Notifiable , HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'Total_Space' , 'Remaining_Space'
        , 'path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

         /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

     /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    //user has one company profile and the profile belongs to one user
    public function profile(){
        return $this->hasOne(Company_Profile::class);
    }


    //user has many folders
    public function folders(){
        return $this->hasMany(Folder::class , 'user_id');
    }

    //user has may files
    public function files(){
        return $this->hasMany(File::class , 'user_id');
    }

    //user has many case studies
    public function case_studies(){
        return $this->hasMany(Case_Study::class , 'user_id');
    }

    //user can leave more than one review about the agency
    public function reviews(){
        return $this->hasMany(Review::class , 'user_id');
    }

}
