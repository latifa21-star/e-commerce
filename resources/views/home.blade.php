<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Barre latérale et catégories circulaires</title>
  <style>
    /* Style de la barre latérale */
    .sidebar {
      height: 100vh;
      width: 0;
      position: fixed;
      top: 0;
      left: 0;
      background-color: white;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }
    .product-list {
      display: flex;
      flex-wrap: wrap;
      gap: 20px; /* Espace entre les produits */
      justify-content: center;
    }

    .product {
      border: 1px solid #ddd;
      padding: 10px;
      width: 180px; /* Ajuste la largeur selon tes besoins */
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px; /* Coins arrondis */
      text-align: center;
      transition: transform 0.2s;
    }

    .product:hover {
      transform: scale(1.05); /* Zoom léger au survol */
    }

    .product img {
      width: 100%;
      height: 140px; /* Hauteur fixe pour les images */
      object-fit: cover; /* Adapter les images à la taille */
      margin-bottom: 10px;
      border-radius: 5px; /* Coins arrondis pour les images */
    }

    .product h2 {
      font-size: 14px;
      margin: 10px 0;
      color: #333;
      height: 40px; /* Limiter la hauteur du texte pour les titres longs */
      overflow: hidden; /* Masquer le texte débordant */
      text-overflow: ellipsis; /* Ajouter des points de suspension pour le texte long */
    }

    .product-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .product-buttons button {
      font-size: 12px;
      padding: 5px 10px;
      border: none;
      background-color: #f0f0f0;
      cursor: pointer;
      border-radius: 4px;
      transition: background-color 0.2s;
    }

    .product-buttons button:hover {
      background-color: #ddd;
    }

    /* Symbole de la barre latérale */
    .sidebar-symbol {
      position: fixed;
      top: 50%;
      left: 0;
      background-color: #333;
      color: black;
      padding: 10px;
      cursor: pointer;
      transition: 0.5s;
      z-index: 1;
    }

    /* Lien dans la barre latérale */
    .sidebar a {
      padding: 16px 16px;
      text-decoration: none;
      font-size: 18px;
      color: black;
      display: block;
      transition: 0.3s;
    }

    .sidebar a:hover {
      background-color: #575757;
    }

    /* Afficher la barre latérale lorsqu'on passe le curseur */
    .sidebar:hover {
      width: 250px;
    }

    .sidebar-symbol:hover ~ .sidebar {
      width: 250px;
    }

    /* Style du cercle et du symbole + */
    .circle {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background-color: #ff9800;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 36px;
      text-align: center;
      cursor: pointer;
      position: relative;
      margin: 20px auto; /* Centrer le cercle */
      display: none; /* Cacher le cercle par défaut */
    }

    .circle:hover {
      background-color: #f57c00;
    }

    .logout {
      position: absolute;
      margin-top: 10px;
      right: 10px;
      color: black;
      cursor: pointer;
    }

    /* Style du champ de recherche */
    .search-container {
      position: relative;
      align-items:center;
      display:flex;
      justify-content:center;
      
    }

    .search-container input {
      width: 50%;
      padding: 10px 10px 10px 10px; /* Espace pour l'icône */
      border-radius: 20px; /* Coins arrondis */
      border: 1px solid #ddd; /* Bordure */
      outline: none; /* Enlever le contour par défaut */
      transition: border 0.3s; /* Transition pour la bordure */
    }

    .search-container input:focus {
      border: 1px solid #007bff; /* Bordure bleue au focus */
    }

    .search-container .fa-search {
      position: absolute;
      left: 73%;
      top: 50%;
      transform: translateY(-50%); /* Centrer verticalement */
      color: #aaa; /* Couleur de l'icône */
    }
    #test{
      margin-top:6%;
    }
    
  </style>
</head>
<body>

<form method='get'>
  <div class="sidebar-symbol">></div>
  <div class="sidebar">
    <a href="{{ route('products.index') }}">Liste des produits</a>
    <a href="{{ route('products.create') }}">Ajouter un produit</a>
    <a href="{{ route('categories.index') }}">Catégories</a>
   
  </div>
</form>

<div class="nav-item dropdown">
<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    <i class="fas fa-bars"></i> <!-- Icône trois barres -->
</a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>

@if(session('success'))
  <div style="color: green;">
    {{ session('success') }}
  </div>
@endif

<!-- Formulaire de recherche des produits -->
<form method="GET" action="{{ route('products.index') }}" class="mb-4 search-container">
  <i class="fas fa-search"></i>
  <input type="text" id="searchInput" placeholder="Rechercher un produit..." value="{{ $search ?? '' }}" onkeyup="filterProducts()">
  
</form>

<div class="product-list" id="productContainer">
  @foreach($products as $product)
    <div  style="width: 15%;"class="product">
      <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
      <h2 class="product-name">{{ $product->name }}</h2>
      
      <div class="product-buttons">
  <a href="{{ route('products.show', $product->id) }}" class="btn btn-success" style="width: 45%; margin-right: 0px;">Détails</a>
  <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary" style="width: 45%; margin-left: 8px;">Modifier</a>
</div>
<button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}" style="width: 100%;">Supprimer</button>
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

<script>
 

  function filterProducts() {
    var input, filter, container, products, name, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    container = document.getElementById("productContainer");
    products = container.getElementsByClassName('product');

    for (i = 0; i < products.length; i++) {
      name = products[i].getElementsByClassName("product-name")[0];
      txtValue = name.textContent || name.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        products[i].style.display = "";
      } else {
        products[i].style.display = "none";
      }
    }
  }
</script>
<div id="test" class="d-flex justify-content-center">
    {{ $products->links() }}
</div>


</body>
</html>
