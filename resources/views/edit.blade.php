<!-- resources/views/produits/edit.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .app-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #fff;
            margin-top:10%;
            margin-bottom:15%;
           
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .gender-options,
        .size-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .gender-options label,
        .size-options label {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004d99;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>
<body>
    @extends('layouts.admin')

    @section('content')
        <div class="app-container">
            <div class="form-container">
                <h1>Modifier le Produit : {{ $product->name }}</h1>

                <!-- Formulaire pour modifier le produit -->
                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="image">Modifier l'image :</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="name">Nom du produit :</label>
                        <input type="text" id="name" name="name" value="{{ $product->name }}">
                    </div>

                    <div class="form-group">
                        <label for="price">Prix du produit :</label>
                        <input type="number" id="price" name="price" value="{{ $product->price }}">

                        <label for="category">Catégorie :</label>
                        <select name="category_id">
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="form-group">
                            <label for="stock">Quantité en stock :</label>
                            <input type="number" id="stock" name="stock" value="{{ $product->stock }}" min="0">
                        </div>

                    <div class="form-group">
                        <label for="gender">Genre :</label>
                        <div class="gender-options">
                            <div>
                                <input type="radio" id="homme" name="gender" value="homme" {{ $product->gender == 'homme' ? 'checked' : '' }}>
                                <label for="homme">Homme</label>
                            </div>
                            <div>
                                <input type="radio" id="femme" name="gender" value="femme" {{ $product->gender == 'femme' ? 'checked' : '' }}>
                                <label for="femme">Femme</label>
                            </div>
                            <div>
                                <input type="radio" id="enfant" name="gender" value="enfant" {{ $product->gender == 'enfant' ? 'checked' : '' }}>
                                <label for="enfant">Enfant</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Taille :</label>
                        <div class="size-options">
                            @foreach(['XS', 'S', 'M', 'L', 'XL'] as $size)
                                <div>
                                    <input type="checkbox" id="{{ strtolower($size) }}" name="sizes[]" value="{{ $size }}" {{ in_array($size, json_decode($product->sizes)) ? 'checked' : '' }}>
                                    <label for="{{ strtolower($size) }}">{{ $size }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" rows="5">{{ $product->description }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour à la liste des produits</a>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</body>
</html>