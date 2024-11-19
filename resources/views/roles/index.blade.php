@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Gestion des Rôles</h2>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nouveau Rôle
            </a>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom du Rôle</th>
                            <th>Nombre d'Utilisateurs</th>
                            <th>Liste Utilisateurs</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ ucfirst($role->name) }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $role->users_count }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('users.index', ['role_filter' => $role->id]) }}" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-users me-1"></i> Voir les utilisateurs
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('roles.edit', $role->id) }}" 
                                           class="btn btn-sm btn-warning me-2"
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $role->id }}"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal de suppression -->
                            <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmer la Suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Êtes-vous sûr de vouloir supprimer le rôle <strong>{{ $role->name }}</strong> ?</p>
                                            @if($role->users_count > 0)
                                                <div class="alert alert-warning">
                                                    Ce rôle est actuellement attribué à {{ $role->users_count }} utilisateur(s).
                                                    Vous devez d'abord réaffecter ces utilisateurs avant de pouvoir supprimer ce rôle.
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" {{ $role->users_count > 0 ? 'disabled' : '' }}>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
@endsection