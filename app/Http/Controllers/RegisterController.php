<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Se utiliza index para mostrar la vista de registro, generalmente se pone index en laravel para mostrar vistas, simple practica del framework
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        // el dd es para hacer un dump and die, es decir, mostrar en pantalla lo que se esta enviando y detener la ejecucion
        // dd($request);
        // dd($request->get('email'));

        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validacion
        $this->validate($request,[
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:30',
            'email'=> 'required|email|unique:users|max:60',
            'password' => 'required|confirmed|min:6'
            
        ]);


        // Esto es equivalente a un insert into
        User::create([
            'name' => $request->name,
            'username' =>  $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password) 
        ]);

        //Autenticar un usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // Redireccionar
        return redirect()->route('posts.index');

    }

}
