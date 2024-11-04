<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous">

    <title>Eureka Fashion</title> 
    <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        overflow-x: hidden;
    }
    .navbar {
        background-color: #222;
        color: white;
        padding: 2vh 2vw;
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 100vw;
    }
    .fas.fa-search.search-icon{
        margin-left:810px;
    }
    .navbar-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }
    .logo {
        font-size: 3vh;
        font-weight: bold;
    }
    .card img {
        height: 50vh;
        object-fit: cover;
        max-width: 100%; 
    }
    .search-container {
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 2vw;
        position: relative;
    }
    .search-container input[type="text"] {
        width: 80%;
        padding: 1.5vh 2vw 1.5vh 4vw;
        font-size: 2vh;
        border: none;
        border-radius: 4px;
        background-color: #333;
        color: white;
    }
    .search-container .search-icon {
        position: absolute;
        right: 7.4vw;
        color: white;
        font-size: 2vh;
        pointer-events: none;
    }
    .menu {
        display: flex;
        gap: 1.5vw;
        align-items: center;
    }
    .menu a {
        color: white;
        text-decoration: none;
        font-size: 2vh;
    }
    .menu .app-icon, .menu .user-icon {
        display: flex;
        align-items: center;
        gap: 0.5vw;
    }
    .menu .app-icon i, .menu .user-icon i, .menu .menu-icon i {
        font-size: 2.5vh;
    }
    .category-container {
        display: flex;
        align-items: center;
        max-width: 80vw;
        padding: 2vh;
        background-color: #555;
        border-radius: 4px;
        align-self: flex-start;
    }
    .menu-icon {
        color: white;
        font-size: 2vh;
        margin-right: 1vw;
    }
    .dropdown-menu {
        max-width: 90vw;
    }
    .row{
        margin-top:20px;
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

   
   @include("navbar")

   
    @foreach ($allCategories as $category)
            
            <div class="row">
                @if (isset($products[$category->id]))
                    @foreach ($products[$category->id] as $product)
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
             
                    
                @endif
            </div>
        @endforeach
   
</main>



</body>
</html>
