<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }


    public function store(Request $request){

        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request,[
            'username' => ['required','unique:users,username,'. auth()->user()->id, 'min:3' , 'max:30', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email,'.auth()->user()->id],
            'password' => ['nullable'],
           
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            // Esto genera un id unico para la imagen
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            $imagenServidor = Image::make($imagen);

            $imagenServidor->fit(1000,1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            //La imagen que tenemos en memoria
            $imagenServidor->save($imagenPath);
        } 


         // Verificar si el usuario ha ingresado su contraseña actual
         
        if ($request->password){
            if (!Hash::check($request->password, auth()->user()->password)) {
                return back()->withErrors(['password' => 'La contraseña actual no es correcta']);
            } else{
                $new_password = $request->new_password;
                $usuario = User::find(auth()->user()->id);
                $usuario->username = $request->username;
                $usuario->email = $request->email;
                $usuario->password = Hash::make($new_password);
                $usuario ->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
                $usuario -> save();
            }
        } 


        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        // $usuario->password = Hash::make($new_password);
        $usuario ->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario -> save();


        // Redireccionar

        return redirect()->route('posts.index', $usuario->username);
    }
}
