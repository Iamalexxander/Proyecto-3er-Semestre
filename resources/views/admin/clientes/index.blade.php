@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <div class="rounded-circle p-3 me-3" style="background: var(--accent-color)">
                <i class="fas fa-users fa-2x text-white"></i>
            </div>
            <h2 class="text-white font-playfair mb-0">Gestión de Usuarios</h2>
        </div>
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-action">
            <i class="fas fa-plus-circle me-2"></i>
            <span class="d-none d-sm-inline">Nuevo Usuario</span>
        </a>
    </div>

    <!-- Table Card -->
    <div class="card border-0 overflow-hidden" style="background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(245, 158, 11, 0.2);">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr class="text-white border-bottom" style="border-color: rgba(245, 158, 11, 0.2) !important;">
                        <th class="px-3 py-3">
                            <div class="d-flex align-items-center">
                                <span class="icon-wrapper me-2">
                                    <i class="fas fa-user"></i>
                                </span>
                                <span class="d-none d-md-block">Usuario</span>
                            </div>
                        </th>
                        <th class="px-3 py-3">
                            <div class="d-flex align-items-center">
                                <span class="icon-wrapper me-2">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <span class="d-none d-md-block">Email</span>
                            </div>
                        </th>
                        <th class="px-3 py-3 d-none d-lg-table-cell">
                            <div class="d-flex align-items-center">
                                <span class="icon-wrapper me-2">
                                    <i class="fas fa-phone"></i>
                                </span>
                                Teléfono
                            </div>
                        </th>
                        <th class="px-3 py-3 d-none d-xl-table-cell">
                            <div class="d-flex align-items-center">
                                <span class="icon-wrapper me-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                Dirección
                            </div>
                        </th>
                        <th class="px-3 py-3">
                            <div class="d-flex align-items-center">
                                <span class="icon-wrapper me-2">
                                    <i class="fas fa-user-tag"></i>
                                </span>
                                <span class="d-none d-md-block">Rol</span>
                            </div>
                        </th>
                        <th class="px-3 py-3 text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                    <tr class="text-white border-bottom" style="border-color: rgba(245, 158, 11, 0.2) !important;">
                        <td class="px-3 py-3">{{ $usuario->nombre_usuario }}</td>
                        <td class="px-3 py-3">{{ $usuario->email }}</td>
                        <td class="px-3 py-3 d-none d-lg-table-cell">{{ $usuario->telefono }}</td>
                        <td class="px-3 py-3 d-none d-xl-table-cell">{{ $usuario->direccion }}</td>
                        <td class="px-3 py-3">
                            @if($usuario->rol_id == 1)
                            <span class="badge rounded-pill" style="background: var(--accent-color)">
                                <i class="fas fa-crown me-1"></i>Admin
                            </span>
                        @else
                            <span class="badge rounded-pill bg-info">
                                <i class="fas fa-user me-1"></i>Cliente
                            </span>
                        @endif
                        </td>
                        <td class="px-3 py-3 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.clientes.edit', $usuario->id) }}"
                                   class="btn btn-sm btn-action">
                                    <i class="fas fa-edit"></i>
                                    <span class="d-none d-md-inline ms-1">Editar</span>
                                </a>
                                <form action="{{ route('admin.clientes.destroy', $usuario->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                        <span class="d-none d-md-inline ms-1">Eliminar</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <div class="rounded-circle p-3 mb-3" style="background: rgba(245, 158, 11, 0.1)">
                                    <i class="fas fa-users-slash fa-3x text-warning"></i>
                                </div>
                                <p class="text-white mb-0">No hay usuarios registrados</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.table {
    color: var(--text-color);
    margin-bottom: 0;
}

.icon-wrapper {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    background: var(--accent-color);
    border-radius: 50%;
}

.table tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background: rgba(245, 158, 11, 0.1);
}

.badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
    letter-spacing: 0.5px;
}

.btn-action {
    background: linear-gradient(45deg, var(--accent-color), var(--accent-color2));
    color: white;
    border: none;
    transition: all 0.3s ease;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    color: white;
}

.btn-danger {
    background: linear-gradient(45deg, #ef4444, #dc2626);
    border: none;
    transition: all 0.3s ease;
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
}

@media (max-width: 768px) {
    .table td, .table th {
        white-space: nowrap;
    }

    .btn {
        padding: 0.4rem 0.8rem;
    }
}
</style>
@endsection
