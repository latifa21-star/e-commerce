@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h2>Liste des Utilisateurs</h2>
                @if(request('role_filter'))
                    @php
                        $currentRole = $roles->find(request('role_filter'));
                    @endphp
                    <div class="text-muted">
                        Filtré par rôle: {{ ucfirst($currentRole->name) }}
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary ms-2">
                            <i class="fas fa-times"></i> Supprimer le filtre
                        </a>
                    </div>
                @endif
            </div>
            
            @if(auth()->check() && auth()->user()->role->name == 'super_admin')
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvel Utilisateur
                </a>
            @endif
        </div>
        
        <div class="card-body">
            <!-- Add Role Filter -->
            <div class="mb-4">
                <form action="{{ route('users.index') }}" method="GET" class="d-flex align-items-center">
                    <label for="role_filter" class="me-2">Filtrer par rôle:</label>
                    <select name="role_filter" id="role_filter" class="form-select" style="width: 200px;" onchange="this.form.submit()">
                        <option value="">Tous les rôles</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ request('role_filter') == $role->id ? 'selected' : '' }}>
                                {{ $role->name == 'super_admin' ? 'Super Admin' : ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Date d'Inscription</th>
                            <th>Rôle</th>
                            @if(auth()->check() && auth()->user()->role->name == 'super_admin')
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="role" class="form-select badge bg-info" style="border:none; width:80%" onchange="this.form.submit()">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $user->role->id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name == 'super_admin' ? 'Super Admin' : ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>

                                @if(auth()->check() && auth()->user()->role->name == 'super_admin')
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('users.edit', $user->id) }}" 
                                               class="btn btn-sm btn-warning me-2"
                                               title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $user->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                @endif
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmer la Suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Tu-Es sûr de vouloir supprimer l'utilisateur <strong>{{ $user->name }}</strong> ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
.form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M7.5 8.5l3 3 3-3z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.5rem center;
    background-size: 1.5em 1.5em;
    border-color: blue;
}

.form-select:focus {
    outline: none;
    box-shadow: none;
    border-color: blue;
}
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
@endsection