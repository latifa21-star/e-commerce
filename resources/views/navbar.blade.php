<!-- Navigation Section -->
<header class="navbar">
        <!-- Top navigation section -->
        <div class="navbar-top">
            <!-- Logo -->
            <div class="logo">Eureka Fashion</div>

            <!-- Search Bar with Icon -->
            <form class="search-container" action="{{ route('categorie.show', '') }}" method="GET" >
    <input onchange="return searchCategory()" type="text" name="category_name" id="category-name-input" placeholder="Rechercher une catégorie..." required>
    <input type="hidden" id="currentPage" value="{{ Route::currentRouteName() }}">
    <i class="fas fa-search search-icon"></i>
</form>



           
            <div class="menu">
                <div class="app-icon">
                    <i class="fas fa-download"></i> Télécharger l'application
                </div>
                <a href="{{ route('register') }}" class="user-icon">
                    <i class="fas fa-user"></i> Inscription
                </a>
                <a class="cart-icon">
                <i class="fas fa-cart-plus"></i> Ajouter au Panier
            </a>

            </div>
        </div>

        <!-- Categories Dropdown with Icon -->
        @if($showCategories ?? true)
        <div class="category-container">
            <div class="menu-icon"><i class="fas fa-bars"></i></div>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Toutes les Catégories
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($allCategories as $category)
                        <a class="dropdown-item"  href="{{ route('categorie.show', $category->id) }}">
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" style="width: 20px; height: 20px; vertical-align: middle;"/>
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </header>

    <script>
    function searchCategory() {
    const categoryName = document.getElementById('category-name-input').value;
    const currentPage = document.getElementById('currentPage').value;

    fetch(`{{ route('findCategoryId') }}?category_name=${categoryName}`)
        .then(response => response.json())
        .then(data => {
            if (data.id) {
                // Vérifiez la page actuelle pour ajuster la redirection
                if (currentPage === 'categoryProducts') {
                    window.location.href = `{{ url('categoryProducts') }}/${data.id}`;
                } else {
                    window.location.href = `{{ url('categorie') }}/${data.id}`;
                }
            } else {
                alert('Catégorie non trouvée');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue');
        });

    return false;
}

</script>
