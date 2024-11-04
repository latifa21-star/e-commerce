<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Catégories</title>
    <!-- Lien vers la bibliothèque Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Conteneur principal pour centrer les catégories */
        .category-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap; /* Pour les faire passer à la ligne si nécessaire */
            gap: 15px; /* Espacement entre les cercles */
            padding: 20px;
        }

        /* Style pour les cercles des catégories */
        .category-circle {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 120px; /* Largeur du cercle */
            height: 120px; /* Hauteur du cercle */
            border-radius: 50%; /* Forme circulaire */
            background-color: #fff; /* Couleur de fond */
            text-align: center; /* Centrer le texte */
            margin: 10px; /* Espacement entre les cercles */
            position: relative; /* Position relative pour l'icône */
            padding: 10px; /* Espacement intérieur */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Ombre pour effet 3D */
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            text-decoration:none;
            color:black;
        }
        .category-name{
           color:black;
        }

        .category-circle:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Style pour le symbole + */
        .add-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: blue;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .add-circle:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Style pour le formulaire d'ajout de catégorie */
        .modal {
            display: none; /* Cacher la modale par défaut */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4); /* Noir avec opacité */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Largeur de la modale */
            max-width: 500px; /* Largeur maximale */
            border-radius: 5px;
        }

        /* Style pour le bouton de fermeture */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        input[type="text"],
        input[type="file"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: calc(100% - 20px); /* Ajuste la largeur pour le padding */
        }

        button {
            padding: 10px 15px;
            background-color: blue;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: blue;
        }

        /* Style pour la barre de recherche */
        .search-container {
            margin: 20px 0;
            position: relative; /* Position relative pour l'icône */
            display: inline-block; /* Pour que l'icône et l'input soient alignés */
        }

        .search-container input {
            padding: 12px 40px 12px 40px; /* Augmente le padding pour faire de la place à l'icône */
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 300px; /* Largeur de la barre de recherche */
            transition: border-color 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Ombre légère */
        }

        .search-container input:focus {
            border-color: blue; /* Changement de couleur au focus */
            box-shadow: 0 0 10px blue; /* Ombre plus marquée au focus */
        }

        .search-container input::placeholder {
            color: #999; /* Couleur du texte placeholder */
        }

        /* Style pour l'icône de recherche */
        .search-icon {
            position: absolute;
            left: 10px; /* Position de l'icône */
            top: 50%;
            transform: translateY(-50%); /* Centrer verticalement */
            color: #999; /* Couleur de l'icône */
        }
        /* Style pour l'icône des trois points */
.menu-icon {
    position: absolute;
    top: 20px; /* Positionne en haut du cercle */
    left: 30px; /* Positionne à gauche du cercle */
    display: none; /* Masqué par défaut */
    cursor: pointer;
}

/* Affiche les trois points au survol du cercle */
.category-circle:hover .menu-icon {
    display: block;
}

/* Style pour le menu contextuel */
.menu {
    position: absolute;
    top: 30px; /* Positionne le menu sous les trois points */
    left: 10px;
    background-color: #fff; /* Couleur de fond du menu */
    border: 1px solid #ccc; /* Bordure */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15); /* Ombre */
    border-radius: 5px; /* Coins arrondis */
    z-index: 10; /* S'assurer que le menu est au-dessus */
    display: none; /* Masqué par défaut */
}

/* Affiche le menu lorsqu'on clique sur l'icône des trois points */
.menu-icon:hover .menu {
    display: block;
}

.menu a {
    display: block; /* Chaque option occupe toute la largeur */
    padding: 8px 12px;
    
    color: #333;
    font-size: 14px;
}

/* Style pour les liens au survol */
.menu a:hover {
    background-color: #f0f0f0;
}
.category-link{
    text-decoration:none;
}

       

    </style>
</head>
<body>
@include('_homeLink')
    <h1>Gestion des Catégories</h1>

    <!-- Affiche un message de succès si une catégorie est ajoutée -->
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <!-- Zone de recherche -->
    <div class="search-container">
        <i class="fas fa-search search-icon"></i> <!-- Icône de recherche de Font Awesome -->
        <input type="text" id="searchInput" placeholder="Rechercher une catégorie..." onkeyup="filterCategories()">
    </div>

    <!-- Cercle pour ajouter une nouvelle catégorie -->
    <div class="add-circle" id="addCategoryBtn">+</div>

    <!-- Liste des catégories existantes -->
  
    <div class="category-container" id="categoryContainer">
    @foreach ($categories as $category)
        <div class="category-circle">
            <!-- Trois points et menu contextuel -->
            <div class="menu-icon">
                <i class="fas fa-ellipsis-v dots" aria-hidden="true"></i>
                <div class="menu">
                <a href="#" class="modify-category" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-icon="{{ $category->icon }}">Modifier</a>

                    <a href="{{ route('categories.destroy', $category->id) }}" class="delete-category" >Supprimer</a>


                </div>
            </div>
            <!-- Contenu du cercle -->
            <a href="{{ route('categories.products', $category->id) }}" class="category-link">
                <div class="category-icon">
                    <img src="{{ asset('storage/'.$category->icon) }}" alt="Icône" width="40">
                </div>
                <div class="category-name">{{ $category->name }}</div>
            </a>
        </div>
    @endforeach
</div>
<!-- Modale pour le formulaire de modification de catégorie -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Modifier la Catégorie</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="text" id="editName" name="name" placeholder="Nom de la catégorie" required>
            <input type="file" id="editIcon" name="icon" accept="image/*">
            <button type="submit">Modifier</button>
        </form>
    </div>
</div>




    <!-- Modale pour le formulaire d'ajout de catégorie -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter une Catégorie</h2>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" id="name" name="name" placeholder="Nom de la catégorie" required>
                <input type="file" id="icon" name="icon" accept="image/*" required>
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </div>
  <!-- Modale de confirmation de suppression -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Confirmer la suppression</h2>
        <p>Êtes-vous sûr de vouloir supprimer cette catégorie ?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Confirmer</button>
            <button type="button" onclick="closeDeleteModal()">Annuler</button>
        </form>
    </div>
</div>



    <script>
        
// Récupère la modale de modification
var editModal = document.getElementById("editModal");
var editForm = document.getElementById("editForm");

// Fonction pour ouvrir la modale de modification avec les détails de la catégorie
function openEditModal(categoryId, categoryName, categoryIcon) {
    editForm.action = `/categories/${categoryId}`; // Définit l'action du formulaire à l'URL de mise à jour
    document.getElementById("editName").value = categoryName; // Remplit le champ de nom
    // Si tu veux garder l'icône actuelle, tu peux afficher une prévisualisation
    if (categoryIcon) {
        editForm.insertAdjacentHTML('afterbegin', `<img src="/storage/${categoryIcon}" width="50" alt="Icône actuelle">`);
    }
    editModal.style.display = "block"; // Affiche la modale
}

// Fonction pour fermer la modale de modification
function closeEditModal() {
    editModal.style.display = "none"; // Masque la modale
}

// Associe l'événement de clic aux liens de modification
document.querySelectorAll('.modify-category').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        const categoryId = this.getAttribute('data-id'); // Récupère l'ID de la catégorie
        const categoryName = this.getAttribute('data-name'); // Récupère le nom de la catégorie
        const categoryIcon = this.getAttribute('data-icon'); // Récupère l'icône de la catégorie
        openEditModal(categoryId, categoryName, categoryIcon); // Ouvre la modale de modification
    });
});







                   // Récupère la modale de suppression
var deleteModal = document.getElementById("deleteModal");
var deleteForm = document.getElementById("deleteForm");

// Fonction pour ouvrir la modale de suppression avec l'URL spécifique de la catégorie
function openDeleteModal(deleteUrl) {
    deleteForm.action = deleteUrl; // Définit l'action du formulaire à l'URL de suppression
    deleteModal.style.display = "block"; // Affiche la modale
}

// Fonction pour fermer la modale de suppression
function closeDeleteModal() {
    deleteModal.style.display = "none"; // Masque la modale
}

// Associe l'événement de clic aux liens de suppression
document.querySelectorAll('.delete-category').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        const deleteUrl = this.getAttribute('href'); // Récupère l'URL de suppression
        openDeleteModal(deleteUrl); // Ouvre la modale de confirmation
    });
});

// Ferme tous les menus lorsque vous cliquez en dehors
document.addEventListener('click', function(event) {
    if (!deleteModal.contains(event.target) && !event.target.matches('.delete-category')) {
        closeDeleteModal();
    }
});

// Ferme la modale lorsque l'utilisateur clique sur <span> (x)
document.querySelector('.close').onclick = function() {
    closeDeleteModal();
};


        // Récupérer la modale
        var modal = document.getElementById("myModal");

        // Récupérer le bouton qui ouvre la modale
        var btn = document.getElementById("addCategoryBtn");

        // Récupérer l'élément <span> qui ferme la modale
        var span = document.getElementsByClassName("close")[0];

        // Quand l'utilisateur clique sur le bouton, ouvrir la modale
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Quand l'utilisateur clique sur <span> (x), fermer la modale
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Quand l'utilisateur clique en dehors de la modale, fermer la modale
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Filtrer les catégories en fonction de la recherche
        function filterCategories() {
    var input, filter, container, categories, name, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    container = document.getElementById("categoryContainer");
    categories = container.getElementsByClassName("category-circle"); // Sélectionne directement les div .category-circle

    for (i = 0; i < categories.length; i++) {
        name = categories[i].getElementsByClassName("category-name")[0];
        txtValue = name.textContent || name.innerText;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            categories[i].style.display = "";
        } else {
            categories[i].style.display = "none";
        }
    }
}

        // Sélectionne tous les éléments de menu icon
const menuIcons = document.querySelectorAll('.menu-icon');

// Boucle à travers chaque élément de menu icon
menuIcons.forEach(icon => {
    icon.addEventListener('click', function(event) {
        // Empêche la propagation du clic vers le cercle parent
        event.stopPropagation();

        // Ferme tous les autres menus
        document.querySelectorAll('.menu').forEach(menu => {
            if (menu !== this.querySelector('.menu')) {
                menu.style.display = 'none';
            }
        });

        // Bascule l'affichage du menu actuel
        const menu = this.querySelector('.menu');
        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    });
});

// Ferme tous les menus lorsque vous cliquez en dehors
document.addEventListener('click', function() {
    document.querySelectorAll('.menu').forEach(menu => {
        menu.style.display = 'none';
    });
});

    </script>
</body>
</html>
