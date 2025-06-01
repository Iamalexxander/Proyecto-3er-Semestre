@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 me-3" style="background: var(--accent-color)">
                        <i class="fas fa-tags fa-2x text-white"></i>
                    </div>
                    <h2 class="text-white font-playfair mb-0">Gestión de Categorías</h2>
                </div>
                <a href="{{ route('admin.categorias.create') }}" class="btn">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span>Nueva Categoría</span>
                </a>
            </div>

            <!-- Table Card -->
            <div class="card border-0" style="background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(245, 158, 11, 0.2);">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-hashtag"></i>
                                            </span>
                                            ID
                                        </div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-tag"></i>
                                            </span>
                                            Nombre
                                        </div>
                                    </th>
                                    <th class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-box"></i>
                                            </span>
                                            Productos
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="icon-wrapper me-2">
                                                <i class="fas fa-cogs"></i>
                                            </span>
                                            Acciones
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categorias as $categoria)
                                <tr class="text-white border-bottom" style="border-color: rgba(245, 158, 11, 0.2) !important;">
                                    <td class="px-4 py-3">{{ $categoria->id }}</td>
                                    <td class="px-4 py-3">{{ $categoria->nombre }}</td>
                                    <td class="px-4 py-3">
                                        <span class="badge" style="background: var(--accent-color)">
                                            <i class="fas fa-cubes me-1"></i>
                                            {{ $categoria->productos->count() }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.categorias.edit', $categoria) }}"
                                               class="btn btn-sm btn-action">
                                                <i class="fas fa-edit me-1"></i>
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.categorias.destroy', $categoria) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ms-2"
                                                        onclick="return confirm('¿Está seguro de eliminar esta categoría?')">
                                                    <i class="fas fa-trash-alt me-1"></i>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal de Edición -->
                                <div class="modal fade" id="editCategoriaModal{{ $categoria->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="background: var(--primary-color);">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title text-white">Editar Categoría</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.categorias.edit', $categoria) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="edit_nombre_{{ $categoria->id }}" class="form-label text-white">Nombre</label>
                                                        <input type="text" id="edit_nombre_{{ $categoria->id }}"
                                                               class="form-control bg-transparent text-white"
                                                               name="nombre" value="{{ old('nombre', $categoria->nombre) }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-action">Actualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr class="text-white">
                                    <td colspan="4" class="text-center py-4">No hay categorías registradas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table {
    color: var(--text-color);
}

.icon-wrapper {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
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
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    color: white;
}

.modal-content {
    border: 1px solid var(--accent-color);
}

.form-control {
    border: 1px solid var(--accent-color);
    color: white;
}

.form-control:focus {
    background-color: rgba(30, 41, 59, 0.9) !important;
    border-color: var(--accent-color2);
    box-shadow: 0 0 0 0.25rem rgba(245, 158, 11, 0.25);
    color: white;
}

@media (max-width: 768px) {
    .table-responsive {
        border-radius: 0.5rem;
    }

    .btn-group {
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn-group .btn {
        width: 100%;
    }
}
</style>
@endsection
