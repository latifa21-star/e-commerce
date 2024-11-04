<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Produits de la Catégorie {{ $category->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
            .button-container {
        display: flex;
        justify-content: space-between;
        margin-top: 10px; /* Espace entre les boutons et les autres éléments */
    }

    .button-container .btn {
        flex: 1; /* Faire en sorte que les boutons prennent un espace égal */
        margin-right: 5px; /* Espace entre les boutons */
    }

    .button-container .btn:last-child {
        margin-right: 0; /* Supprimer l'espace à droite du dernier bouton */
    }


        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin: 0 auto;
            padding: 20px;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 200px;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .product-card h2 {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .product-card p {
            font-size: 14px;
            color: #555;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin: 20px auto;
        }

        .btn-group {
            margin-top: 10px;
        }
        .btn.btn-primary.btn-back{
            display: flex;          /* Permet de le traiter comme un bouton */
            padding: 10px 20px;            /* Espacement interne */
            text-decoration: none;          /* Enlève le soulignement */
            color: white;                   /* Couleur du texte */
            background-color: blue;         /* Couleur de fond */
            border-radius: 5px;            /* Coins arrondis */
            min-width: 120px;               /* Largeur minimale */
            text-align: center;             /* Centre le texte */
            transition: background-color 0.3s; /* Effet de transition */
            width: 14%;
            
        }
        .btn .btn-primary .btn-back:hover{
            background-color: darkblue; 
        }
        .test{
            width: 100%;
        }

    </style>
</head>
<body>
@include('_homeLink')

    <h1>Produits de la Catégorie : {{ $category->name }}</h1>

    @if($products->isEmpty())
        <p class="text-center text-muted">Aucun produit trouvé pour cette catégorie.</p>
    @else
    <div class="product-container">
    @foreach ($products as $product)
        <div class="product-card">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <h2>{{ $product->name }}</h2>
            <p>Prix : {{ $product->price }} MAD</p>
            <div class="button-container">
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-success">Détails</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Modifier</a>
            </div>
            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteFormAction('{{ route('products.destroy', $product->id) }}')">Supprimer</a>

        </div>
    @endforeach
</div>

    @endif

   <div class="test">
   <a href="{{ route('categories.index') }}" class="btn btn-primary btn-back">Retour aux catégories</a>

   </div>
   
    <!-- Modal de confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce produit ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function setDeleteFormAction(action) {
        document.getElementById('deleteForm').action = action;
    }
</script>

</body>
</html>
