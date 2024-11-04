<!-- Navigation Section -->
<header class="navbar">
        <!-- Top navigation section -->
        <div class="navbar-top">
            <!-- Logo -->
            <div class="logo">Eureka Fashion</div>

            <!-- Search Bar with Icon -->
                <form class="search-container" action="{{ route('categorie.show', '') }}" method="GET" onsubmit="return searchCategory()">
      
       <input type="text" name="category_name" id="category-name-input" placeholder="Rechercher une catégorie..." required>
       <i class="fas fa-search search-icon"></i>
    
    </form>
    


            <!-- Navigation Menu -->
            <div class="menu">
                <div class="app-icon">
                    <i class="fas fa-download"></i> Télécharger l'application
                </div>
                <a href="{{ route('register') }}" class="user-icon">
                    <i class="fas fa-user"></i> Inscription
                </a>
            </div>
        </div>

        <!-- Categories Dropdown with Icon -->
        <div class="category-container">
            <div class="menu-icon"><i class="fas fa-bars"></i></div>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Toutes les Catégories
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($allCategories as $category)
                        <a class="dropdown-item"  href="{{ route('categoryProducts', $category->id) }}">
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" style="width: 20px; height: 20px; vertical-align: middle;"/>
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </header>