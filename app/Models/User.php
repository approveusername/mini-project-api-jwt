<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Vote;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\PhoneNumber;
use App\Models\Company;
use App\Models\UserImage;
use App\Models\UserLanguage;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims() // if we want to add any custom claim in the token, we can add here and it will be added in the token payload
    {
        return [];
    }

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'user_roles');  //user_roles (pivot table) table name
    }

    public function PhoneNumber(){
        /* ================ if we have no specified the foreign key relations in migrations ==================
        | return $this->hasOneThrough(PhoneNumber::class, Company::class, 'user_id', 'company_id', 'id', 'id'); 
        | PhoneNumber: Target Model
        | Company: Through/via Model
        | user_id: foreign key of Company (Through) Model 
        | company_id: foreign key of PhoneNumber (Target) Model 
        | id: id/local key of User (First) Model 
        | id: id/local key of Company (Through) Model 
        ====================================================================================================*/
        return $this->hasOneThrough(PhoneNumber::class, Company::class);  // [target and via model]
    }

    public function company(){
        return $this->hasOne(Company::class);
    }

    /* ============ in case of hasManyThrough ===================
    |    suppose this file (Model Class) is Country Model
    |    3 tables: Country->hasMany('Post')->Through('User')
    |
    |    public function posts(){
    |        return $this->hasManyThrough(Post::class, User::class);  // [target and via model]
    |    }
    |
    |    public function users(){
    |        return $this->hasMany(User::class);
    |    } 
    |
    |    // controller code
    |    public function index(){
    |        return Country::with('posts')->with('users')->find(1);    
    |    }
    |=================================================================*/

    public function languages() : HasMany {
        return $this->hasMany(UserLanguage::class);
    }

    public function images() : HasMany {
        return $this->hasMany(UserImage::class);
    }
}
