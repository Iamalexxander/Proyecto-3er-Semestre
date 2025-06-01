<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('admin.clientes.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios',
            'telefono' => 'nullable|string|max:50',
            'direccion' => 'nullable|string',
            'password' => 'required|min:6',
            'rol_id' => 'required|integer|in:1,2,3',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        Usuario::create($validated);

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Usuario registrado exitosamente.');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.clientes.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $validated = $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'telefono' => 'nullable|string|max:50',
            'direccion' => 'nullable|string',
            'rol_id' => 'required|integer|in:1,2,3',
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        $usuario->update($validated);

        return redirect()->route('admin.clientes.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.clientes.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
