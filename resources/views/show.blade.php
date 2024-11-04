<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
    <style>
        /* Styles globaux */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        /* Titre principal */
        .page-title {
            font-size: 24px;
            color: #0984e3;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Container principal */
        .product-details {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        img {
            border-radius: 8px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: scale(1.05);
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        strong {
            color: #636e72;
        }

        /* Bouton de retour */
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0984e3;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #74b9ff;
        }
    </style>
</head>
<body>

    <!-- Titre de la page -->
    <h1 class="page-title">Détails du Produit : {{ $product->name }}</h1>

    <!-- Conteneur des détails du produit -->
    <div class="product-details">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 200px;">
        <p><strong>Nom :</strong> {{ $product->name }}</p>
        <p><strong>Prix :</strong> {{ $product->price }} MAD</p>
        <p><strong>Genre :</strong> {{ $product->gender }}</p>
        <p><strong>Tailles :</strong> 
    @foreach(json_decode($product->sizes) as $index => $size)
        {{ $size }}@if($index < count(json_decode($product->sizes)) - 1) / @endif
    @endforeach
</p>

        <p><strong>Catégorie :</strong> {{ $product->category->name }}</p>
        <p><strong>Description :</strong> {{ $product->description }}</p>
    </div>

    <!-- Lien de retour en dehors de la div des détails -->
    <a href="{{ route('products.index') }}" class="back-link">Retour à la liste des produits</a>
</body>
</html>
