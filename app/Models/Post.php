<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    // Con esto le especificamos a laravel que infomacoin tiene que leer o que informacion tiene que procesar
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }

    public function likes()  {
        return $this->hasMany(like::class);
    }


    public function checkLike(User $user) {
        // Esto lo que hace es posicionarse en la tabal de likes y utilizando contains le decimmos si en la tabla de likes
        // Contienes en la columna de user_id el usiaio que estamos pasando
        return $this->likes->contains('user_id',$user->id);
    }
}
