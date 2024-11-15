@extends('layouts.admin')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="mb-0 text-primary">{{ __('Profile') }}</h4>
                    </div>

                    <div class="card-body">
                        @if (session('status') === 'profile-updated')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ __('Profile updated successfully.') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <!-- Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold text-primary">{{ __('Nom') }}</label>
                                <input type="text" class="form-control shadow-sm @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold text-primary">{{ __('Email') }}</label>
                                <input type="email" class="form-control shadow-sm @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                           

                            <!-- New Password -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold text-primary">{{ __('Nouveau Mots de Pass') }}</label>
                                <input type="password" class="form-control shadow-sm @error('password') is-invalid @enderror" 
                                       id="password" name="password">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                           
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold text-primary">{{ __('Confirmer Mots de Pass') }}</label>
                                <input type="password" class="form-control shadow-sm" 
                                       id="password_confirmation" name="password_confirmation">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Sauvegarder') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection