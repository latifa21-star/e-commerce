<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits de la Catégorie {{ $category->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .contenue h1 {
        text-align: center;
        margin-top: 20px;
        font-size: 40px;
        color: blue;
        
    }

    .product-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 20px;
    }

    .product-card {
        width: 30%;
        padding: 15px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .product-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-name {
        font-size: 1.1rem;
      font-weight: 100;
      margin: 0.5rem 0;
      color: #1e293b;
      font-family: fantasy;
      text-align: center;
    }

    .product-price {
        font-size: 1.2rem;
      font-weight: 100;
      color: #2563eb;
      margin: 0.5rem 0 1rem;
      font-family: fantasy;
      text-align: center;
    }

    .product-catalog__buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .product-catalog__btn {
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.025em;
        border: none;
        cursor: pointer;
        font-family: Georgia, serif;
        text-decoration: none;
        text-align: center;
    }

    .product-catalog__btn--success {
        background-color: #22c55e;
        color: #ffffff;
        font-family: cursive;
    }

    .product-catalog__btn--success:hover {
        background-color: #16a34a;
    }

    .product-catalog__btn--primary {
        background-color: #2563eb;
        color: #ffffff;
        font-family: cursive;
    }

    .product-catalog__btn--danger {
        background-color: #dc3545;
        color: #ffffff;
        font-family: cursive;
    }

    .product-catalog__modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .product-catalog__modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
    }

    .test {
        text-align: center;
        margin-top: 20px;
    }

    .back-to-categories-link {
        font-size: 30px;
        font-weight: bold;
        color: white;
        text-decoration: none;
        background-color: #007bff;
    }

    .back-to-categories-link:hover {
        text-decoration: underline;
    }
    #danger{
        background-color: #ef4444;
      color: #ffffff;
      width: 50%;
      margin-top: 1rem;
      margin-left: 1rem;
      font-family: cursive;
    }
    
</style>
</head>
<body>
@extends('layouts.admin')
@section('content')
<div class="contenue">
    <h1>Produit de la Catégorie : {{ $category->name }}</h1>
</div>
@if($products->isEmpty())
<p class="text-center text-muted">Aucun produit trouvé pour cette catégorie.</p>
@else
<div class="product-container">
@foreach ($products as $product)
<div class="product-card">
<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
<h2 class="product-name">{{ $product->name }}</h2>
<p class="product-price">{{ $product->price }} MAD</p>
<div class="product-catalog__buttons">
<a href="{{ route('products.show', $product->id) }}" class="product-catalog__btn product-catalog__btn--success">Détails</a>
<a href="{{ route('products.edit', $product->id) }}" class="product-catalog__btn product-catalog__btn--primary">Modifier</a>
</div>
<button type="button" id="danger"class="product-catalog__btn product-catalog__btn--danger" onclick="showModal('deleteModal{{ $product->id }}')">Supprimer</button>
</div>
<div class="product-catalog__modal" id="deleteModal{{ $product->id }}" style="display: none;">
            <div class="product-catalog__modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la Suppression</h5>
                    <button type="button" class="btn-close" onclick="hideModal('deleteModal{{ $product->id }}')"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer le produit <strong>{{ $product->name }}</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="product-catalog__btn" onclick="hideModal('deleteModal{{ $product->id }}')">Annuler</button>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="product-catalog__btn product-catalog__btn--danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif
<div class="test">
    <a href="{{ route('categories.index') }}" class="back-to-categories-link">Retour aux catégories</a>
</div>
<script>
    function showModal(id) {
        document.getElementById(id).style.display = "block";
    }

    function hideModal(id) {
        document.getElementById(id).style.display = "none";
    }
</script>
@endsection
</body>
</html>