<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        Role::create($validated);

        return redirect()->route('roles.index')
            ->with('success', 'Rôle créé avec succès');
    }

    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        $role->update($validated);

        return redirect()->route('roles.index')
            ->with('success', 'Rôle mis à jour avec succès');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        
        // Vérifier si le rôle a des utilisateurs associés
        if ($role->users()->count() > 0) {
            return redirect()->route('roles.index')
                ->with('error', 'Impossible de supprimer ce rôle car il est associé à des utilisateurs');
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Rôle supprimé avec succès');
    }
}