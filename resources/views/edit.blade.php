<!-- resources/views/produits/edit.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 110vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 400px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }

        textarea {
            resize: vertical;
        }

        button[type="submit"] {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: blue;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 15px;
        }

        .form-group input[type="number"],
        .form-group select {
            width: calc(50% - 5px);
        }

        /* Styles pour les options de genre et tailles */
        .gender-options,
        .size-options {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .gender-options div,
        .size-options div {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Lien de retour */
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
@include('_homeLink')
    <div class="container">
        <h1>Modifier le Produit : {{ $product->name }}</h1>

        <!-- Formulaire pour modifier le produit -->
        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="image">Modifier l'image :</label>
    <input type="file" id="image" name="image" accept="image/*">

    <label for="name">Nom du produit :</label>
    <input type="text" id="name" name="name" value="{{ $product->name }}">

    <div class="form-group">
        <label for="price">Prix du produit :</label>
        <input type="number" id="price" name="price" value="{{ $product->price }}">

        <label for="category">Catégorie :</label>
        <select name ="category_id">
        @foreach($categories as $categorie)
        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
        @endforeach
        </select>
    </div>

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

    <label>Taille :</label>
    <div class="size-options">
        @foreach(['XS', 'S', 'M', 'L', 'XL'] as $size)
            <div>
                <input type="checkbox" id="{{ strtolower($size) }}" name="sizes[]" value="{{ $size }}" {{ in_array($size, json_decode($product->sizes)) ? 'checked' : '' }}>
                <label for="{{ strtolower($size) }}">{{ $size }}</label>
            </div>
        @endforeach
    </div>

    <label for="description">Description :</label>
    <textarea id="description" name="description" rows="5">{{ $product->description }}</textarea>

            <button type="submit">Modifier</button>
        </form>

        <a href="{{ route('products.index') }}">Retour à la liste des produits</a>
    </div>
</body>
</html>
