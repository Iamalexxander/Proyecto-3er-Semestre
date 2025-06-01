<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function show()
    {
        $usuario = Auth::user();
        return view('usuarios.perfil.show', compact('usuario'));
    }

    public function edit()
    {
        $usuario = Auth::user();
        return view('usuarios.perfil.edit', compact('usuario'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $validated = $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $usuario->id
        ]);

        $usuario->fill($validated);
        $usuario->save();

        return redirect()->route('usuarios.perfil')
            ->with('success', 'Perfil actualizado exitosamente');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario = Auth::user();

        if (!Hash::check($request->current_password, $usuario->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }

        $usuario->password = Hash::make($validated['password']);
        $usuario->save();

        return redirect()->route('usuarios.perfil')
            ->with('success', 'Contraseña actualizada exitosamente');
    }
}
