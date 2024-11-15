<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        /* Encapsulation de tous les styles dans une classe spécifique */
        .user-edit-form {
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            margin-top:4%;
        }

        .user-edit-form * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .user-edit-form .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 500px !important; /* Force la largeur maximale */
            margin: 2rem auto !important; /* Centre le conteneur */
        }

        .user-edit-form h1 {
            color: #4a90e2;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.8rem;
            font-weight: 500;
        }

        .user-edit-form .form-group {
            margin-bottom: 1.5rem;
        }

        .user-edit-form .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        .user-edit-form .form-group input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .user-edit-form .form-group input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }

        .user-edit-form .password-container {
            position: relative;
        }

        .user-edit-form .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
        }

        .user-edit-form .submit-btn {
            width: 100%;
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .user-edit-form .submit-btn:hover {
            background-color: #357abd;
        }

        .user-edit-form .submit-btn:active {
            transform: scale(0.98);
        }

        .user-edit-form .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .user-edit-form .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        @media (max-width: 600px) {
            .user-edit-form .container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
@extends('layouts.admin')

@section('content')
    <div class="user-edit-form">
        <div class="container">
            <h1>Modifier l'utilisateur</h1>
            
            @if(session('success'))
                <div class="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $user->name) }}" 
                        required
                        placeholder="Entrez le nom"
                    >
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}" 
                        required
                        placeholder="exemple@email.com"
                    >
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                        <label for="role">Rôle</label>
                        <select 
                            id="role" 
                            name="role_id" 
                            class="form-control" 
                            required
                            style="width: 100%;
                                padding: 0.8rem 1rem;
                                border: 1px solid #ddd;
                                border-radius: 5px;
                                font-size: 1rem;
                                background-color: white;">
                            <option value="">Sélectionner un rôle</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                 </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="password-container">
                        <input 
                            type="password" 
                            id="password" 
                            name="password"
                            placeholder="Laissez vide pour garder le même mot de passe"
                        >
                        <button type="button" class="password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <div class="password-container">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation"
                            placeholder="Confirmez le nouveau mot de passe"
                        >
                        <button type="button" class="password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">
                    Mettre à jour l'utilisateur
                </button>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.querySelectorAll('.user-edit-form .password-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        });

        // Auto-hide alerts after 5 seconds
        document.querySelectorAll('.user-edit-form .alert').forEach(alert => {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 5000);
        });
    </script>
</body>
</html>