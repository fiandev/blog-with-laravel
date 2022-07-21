<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;
use Cviebrock\EloquentSluggable\Sluggable;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ["id"];
    
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
    
    public function getRouteKeyName(){
      return "slug";
    }
    
    public function posts(){
      return $this->hasMany(Post::class);
    }
    
    public function roles() {
      //return $this->belongsToMany(Role::class);
      return $this->belongsToMany(Role::class, "role_users");
    }
    
    public function hasRole($roleName) {
      $result = false;
      foreach ($this->roles as $role) {
        if ($role->name === $roleName) {
          $result = true;
          break;
        }
      }
      return $result;
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'username'
            ]
        ];
    }
}
