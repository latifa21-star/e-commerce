<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            /* Styles pour les groupes radio et checkbox */
    .gender-options,
    .size-options {
        display: flex;
        align-items: center;
        gap: 15px; /* Espacement entre les options */
        margin-bottom: 15px;
    }

    /* Styles spécifiques pour chaque option de genre et taille */
    .gender-options div,
    .size-options div {
        display: flex;
        align-items: center;
        gap: 5px; /* Espacement entre le label et l'input */
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
        input[type="number"]{
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="text"],
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

        /* Styles supplémentaires pour les champs radio et checkbox */
        .gender-options,
        .size-options {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .gender-options label,
        .size-options label {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
@include('_homeLink')
<div class="container">
    <h1>Ajouter un produit</h1>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="image">Choisir une image :</label>
        <input type="file" name="image" accept="image/*">

        <label for="name">Nom du produit :</label>
        <input type="text" name="name">

        <div class="ts">
        <label for="price">Prix du produit :</label>
        <input type="number" name="price"><br>
        <label>Category:</label><br>
        <select name ="category_id">
        @foreach($categories as $categorie)
        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
        @endforeach
        </select>

        
        </div>

        <label for="category">Sexe :</label>
<div class="gender-options">
    <div>
        <input type="radio" name="gender" value="homme">
        <label for="homme">Homme</label>
    </div>
    <div>
        <input type="radio" name="gender" value="femme">
        <label for="femme">Femme</label>
    </div>
    <div>
        <input type="radio" name="gender" value="enfant">
        <label for="enfant">Enfant</label>
    </div>
</div>

<label>Taille :</label>
<div class="size-options">
    <div>
        <input type="checkbox" name="sizes[]" value="XS">
        <label for="xs">XS</label>
    </div>
    <div>
        <input type="checkbox" name="sizes[]" value="S">
        <label for="s">S</label>
    </div>
    <div>
        <input type="checkbox" name="sizes[]" value="M">
        <label for="m">M</label>
    </div>
    <div>
        <input type="checkbox" name="sizes[]" value="L">
        <label for="l">L</label>
    </div>
    <div>
        <input type="checkbox" name="sizes[]" value="XL">
        <label for="xl">XL</label>
    </div>
</div>
        
        
        

        <label for="description">Description du produit :</label>
        <textarea id="description" name="description" rows="5" cols="40" placeholder="Entrez la description du produit ici..."></textarea>

        <button type="submit">Ajouter</button>
</body>
</html>