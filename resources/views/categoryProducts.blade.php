<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous">
    <title>Document</title>
   
        <style>
   
.navbar {
    background-color: #222;
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between; 
    align-items: center;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
}
.fas.fa-search.search-icon{

}

.logo {
    font-size: 1.5rem;
    font-weight: bold;
    color: white;
    margin-right: 20px;
}

.search-container {
    display: flex;
    align-items: center;
    background-color: #333;
    padding: 5px;
    border-radius: 5px;
    width: 40%;
    margin-left:60px;
}

.search-container input[type="text"] {
    border: none;
    background-color: #333;
    color: white;
    width: 100%;
    padding: 5px;
}

.search-container input[type="text"]::placeholder {
    color: #aaa;
}

.search-container .search-icon {
    color: white;
    margin-left:5px;
   
}
.fas.fa-search.search-icon{
    margin-left:50px;
}

.menu {
    display: flex;
    gap: 15px;
    align-items: center;
    margin-left: auto; 
    margin-right: 50px; 
}


.menu .app-icon,
.menu .user-icon {
    color: white;
    text-decoration: none;
    padding: 0vh;
}

.menu .app-icon i,
.menu .user-icon i {
    margin-right: 5px;
}

    
    
    .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .card-body {
        padding: 15px;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }

    .card-text {
        font-size: 1rem;
        color: #e67e22;
        margin-bottom: 0.5rem;
    }

    .text-muted {
        font-size: 0.9rem;
    }

    .text-success {
        font-size: 0.9rem;
        margin-top: -5px;
    }
}
    body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    overflow-x: hidden;
}

.card {
    position: relative;
    background-color: white;
    border: none;
    border-radius: 12px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.15);
}

.card img {
    height: 40vh;
    object-fit: cover;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.card-body {
    padding: 20px;
    text-align: center;
}

.card-title {
    font-size: 1.2em;
    font-weight: bold;
    color: #333;
}

.card-text {
    font-size: 1em;
    color: #777;
    margin-top: 8px;
}

.add-to-cart {
    position: absolute;
    bottom: 15px;
    right: 15px;
    background-color: #ffffff;
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease, transform 0.3s ease;
    cursor: pointer;
}

.add-to-cart:hover {
    background-color: #f7f7f7;
    transform: scale(1.1);
}

.add-to-cart i {
    font-size: 20px;
    color: #333;
}

.row {
    margin-top: 30px;
    display: flex;
    justify-content: center;
    gap: 30px;
}
</style>

   
</head>
<body>
     
     <header class="navbar">
        
        <div class="navbar-top" style="width : 100%; ">
            
            <div style="display:flex; width: 100%; justify-content:space-between;">
                <div class="logo">Eureka Fashion</div>
                <form class="search-container" action="{{ route('categorie.show', '') }}" method="GET" onsubmit="return searchCategory()">
                    <input type="text" name="category_name" id="category-name-input" placeholder="Rechercher une catégorie..." required>
                    <i class="fas fa-search search-icon"></i>
                </form>
                <div class="menu">
                    <div class="app-icon">
                        <i class="fas fa-download"></i> Télécharger l'application
                    </div>
                    <a href="{{ route('register') }}" class="user-icon">
                        <i class="fas fa-user"></i> Inscription
                    </a>
                </div>
           
            </div>
            

        </div>
        </header>
    
<main>
<div class="container my-4">
        <h2>Produits pour la catégorie : {{ $category->name }}</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Prix : {{ $product->price }} MAD</p>
                                        <button class="add-to-cart">
                                            <i class="fas fa-shopping-bag"></i> <!-- Utilise Font Awesome pour l'icône -->
                                        </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
</body>
</html>

