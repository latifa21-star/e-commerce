<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Liste des Produits</title>
    <style>
        /* Ajoute des styles de base */
        body {
            font-family: Arial, sans-serif;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 200px;
            text-align: center;
        }
        .product img {
            max-width: 100%;
            height: auto;
        }
        .product-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .product-buttons form {
            display: inline;
        }
        .product-buttons button {
            padding: 5px 10px;
            font-size: 12px;
        }
    </style>
</head>
<body>

<h1>Liste des Produits</h1>

@if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

<div class="product-list">
    @foreach($prds as $product)
        <div class="product">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <h2>{{ $product->name }}</h2>
            
            <div class="product-buttons">
                <!-- Button pour voir les détails du produit -->
                <a href="{{ route('products.show', $product->id) }}">
                    <button type="button">Détails</button>
                </a>

                <!-- Button pour modifier le produit -->
                <a href="{{ route('products.edit', $product->id) }}">
                    <button type="button">Modifier</button>
                </a>

                <!-- Form pour supprimer le produit avec confirmation -->
                <!-- Bouton Supprimer - Ouvre la modal de confirmation -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                                Supprimer
                            </button>
            </div>
        </div>
        <!-- Modal Bootstrap pour Confirmation de Suppression -->
        <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Confirmer la Suppression</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Es-tu sûr de vouloir supprimer le produit <strong>{{ $product->name }}</strong> ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <!-- Formulaire pour supprimer le produit -->
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    @endforeach
</div>

</body>
</html>
