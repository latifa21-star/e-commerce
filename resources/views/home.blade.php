@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <title>Catalogue de Produits</title>
  <style>
    
    .product-catalog {
      background-color: #f8fafc;
      padding: 20px;
    }

    .product-catalog__search-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 12%;
      width: 100%;
      max-width: 800px;
      margin: 2rem auto;
    }

    .product-catalog__search-input-wrapper {
      position: relative;
      flex-grow: 1;
      margin-right: 1rem;
    }

    .product-catalog__search-input {
      width: 100%;
      padding: 1rem 1.5rem;
      border-radius: 12px;
      border: 2px solid #e2e8f0;
      background-color: #ffffff;
      font-size: 1rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      font-family: Georgia, serif;
    }

    .product-catalog__search-input:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
      outline: none;
    }

    .product-catalog__search-icon {
      position: absolute;
      right: 1.5rem;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
    }

    .product-catalog__add-btn {
      background-color: #2563eb;
      color: #ffffff;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s;
      margin-left: 3rem;
      font-family: Georgia, serif;
    }

    .product-catalog__add-btn:hover {
      background-color: #1e40af;
    }

    .product-catalog__grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 2rem;
      padding: 2rem;
      max-width: 1440px;
      margin: 0 auto;
    }

    .product-catalog__card {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
      width: 100%;
      border: none;
    }

    .product-catalog__card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.15);
    }

    .product-catalog__image {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 12px 12px 0 0;
    }

    .product-catalog__content {
      padding: 1.5rem;
    }

    .product-catalog__name {
      font-size: 1.1rem;
      font-weight: 100;
      margin: 0.5rem 0;
      color: #1e293b;
      font-family: fantasy;
      text-align: center;
    }

    .product-catalog__price {
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

    .product-catalog__btn--primary:hover {
      background-color:darkblue;
    }

    .product-catalog__btn--danger {
      background-color: #ef4444;
      color: #ffffff;
      width: 50%;
      margin-top: 1rem;
      margin-left: 5rem;
      font-family: cursive;
      
    }

    .product-catalog__btn--danger:hover {
      background-color: #dc2626;
    }

    .product-catalog__modal {
      display: none;
      position: fixed;
      z-index: 999;
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
      border-radius: 12px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* Modal specifics */
    .modal-header {
      padding: 1rem;
      border-bottom: 1px solid #e2e8f0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-title {
      margin: 0;
      font-family: Georgia, serif;
      color: #1e293b;
    }

    .modal-body {
      padding: 1.5rem;
      font-family: Georgia, serif;
    }

    .modal-footer {
      padding: 1rem;
      border-top: 1px solid #e2e8f0;
      display: flex;
      justify-content: flex-end;
      gap: 1rem;
    }

    .btn-close {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: #64748b;
    }

    /* Pagination styles */
    .pagination {
      margin: 2rem 0;
      display: flex;
      justify-content: center;
      gap: 0.5rem;
    }

    /* Responsive design */
    @media (max-width: 768px) {
      .product-catalog__grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        padding: 1rem;
        gap: 1rem;
      }

      .product-catalog__search-container {
        margin: 1rem;
        flex-direction: column;
        gap: 1rem;
      }

      .product-catalog__add-btn {
        margin-left: 0;
        width: 100%;
        text-align: center;
      }

      .product-catalog__modal-content {
        width: 90%;
        margin: 10% auto;
      }
    }
  </style>
</head>
<body>
  <div class="product-catalog">
    <div class="product-catalog__search-container">
      <div class="product-catalog__search-input-wrapper">
        <input type="text" id="searchInput" class="product-catalog__search-input" placeholder="Rechercher un produit..." value="{{ $search ?? '' }}" onkeyup="filterProducts()">
        <i class="fas fa-search product-catalog__search-icon"></i>
      </div>
      <a href="{{ route('products.create') }}" class="product-catalog__add-btn">Ajouter Produit</a>
    </div>

    <div class="product-catalog__grid" id="productContainer">
      @foreach($products as $product)
        <div class="product-catalog__card">
          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-catalog__image">
          <div class="product-catalog__content">
            <h3 class="product-catalog__name">{{ $product->name }}</h3>
            <p class="product-catalog__price">{{ $product->price }} MAD</p>
            
            <div class="product-catalog__buttons">
              <a href="{{ route('products.show', $product->id) }}" class="product-catalog__btn product-catalog__btn--success">Détails</a>
              <a href="{{ route('products.edit', $product->id) }}" class="product-catalog__btn product-catalog__btn--primary">Modifier</a>
            </div>
            <button type="button" class="product-catalog__btn product-catalog__btn--danger" onclick="showModal('deleteModal{{ $product->id }}')">Supprimer</button>
          </div>
        </div>
        
        <div class="product-catalog__modal" id="deleteModal{{ $product->id }}">
          <div class="product-catalog__modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmer la Suppression</h5>
              <button type="button" class="btn-close" onclick="hideModal('deleteModal{{ $product->id }}')">×</button>
            </div>
            <div class="modal-body">
              <p>tu-es sûr de vouloir supprimer le produit <strong>{{ $product->name }}</strong> ?</p>
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

    <div class="pagination">
      {{ $products->links() }}
    </div>
  </div>

  <script>
    function filterProducts() {
      var input = document.getElementById('searchInput');
      var filter = input.value.toUpperCase();
      var container = document.getElementById("productContainer");
      var products = container.getElementsByClassName('product-catalog__card');

      for (var i = 0; i < products.length; i++) {
        var name = products[i].getElementsByClassName("product-catalog__name")[0];
        var txtValue = name.textContent || name.innerText;
        products[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
      }
    }

    function showModal(id) {
      document.getElementById(id).style.display = "block";
    }

    function hideModal(id) {
      document.getElementById(id).style.display = "none";
    }
  </script>
</body>
</html>
@endsection