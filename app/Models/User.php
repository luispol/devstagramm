<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // fillable es, los datos que esperamos que el usuario nos de, aqui le vamos a especificar que valores que valores quieres que se guarden en la 
    // base de datos, es como una medidad de seguridad
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
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

    public function posts()  {
        // Vamos a ocupar hasMany para referirnos que un usuario puede tener multiples posts
        // Asi que nos referimos al modelo Post
        return $this-> hasMany(Post::class);
    }

    public function likes() {
        return $this->hasMany(like::class);
    }

    // Alamacena los seguidores de un usuario

    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id','follower_id');
    }

    // Alamacenar los que seguimos
    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id','user_id');
    }

    //Comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user)  {
        return $this->followers->contains($user->id);

    }


    
}
