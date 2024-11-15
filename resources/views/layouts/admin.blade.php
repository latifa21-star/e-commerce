<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .topbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem;
            position: fixed;
            top: 0;
            right: 0;
            left: 250px; 
            z-index: 1000;
            
        }
        
        .sidebar {
            position: fixed;
            top: 0; 
            bottom: 0;
            left: 0;
            width: 250px;
            z-index: 100;
            padding: 20px 0 0; 
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background: white;
        }

        .sidebar .logo-container {
            padding: 1rem;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, .1);
        }

        .main-content {
            margin-top: 70px; 
            margin-left: 250px; 
            padding: 20px;
        }

        .footer {
            background: white;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            right: 0;
            left: 250px; 
            box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .devise-box {
            background: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .user-dropdown {
            position: relative;
        }

        .user-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 4px;
            min-width: 200px;
            display: none;
        }

        .user-dropdown:hover .user-menu {
            display: block;
        }

        .nav-link {
            padding: 0.8rem 1rem;
            color: #333;
            transition: all 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        .user-dropdown .btn {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.user-menu {
    position: absolute;
    right: 0;
    top: 100%;
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-radius: 4px;
    min-width: 250px;
    display: none;
    margin-top: 0.5rem;
    border: 1px solid rgba(0,0,0,0.1);
}

.user-menu .border-bottom {
    border-bottom: 1px solid rgba(0,0,0,0.1) !important;
}
.logo-text.d-block{
    font-family: fantasy;
    /* font-family: system-ui; */
    /* font-family: emoji; */
    /* font-family: inherit; */
    font-weight:100;
}

.user-menu.show {
    display: block;
}

.user-menu a:hover, 
.user-menu button:hover {
    background-color: #f8f9fa;
}
    </style>
</head>
<body>
    
    <nav class="sidebar">
        <div class="logo-container">
            <img src="{{ Storage::url('LOGO/LOGO.svg') }}" alt="Logo" height="40" class="mb-2">
            <span class="logo-text d-block">Eureka fashion</span>
        </div>
        <div class="position-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Tableau de bord
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                        <i class="fas fa-box"></i>
                        Produits
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                        <i class="fas fa-folder"></i>
                        Catégories
                    </a>
                </li>
               
            
              
                <li class="nav-item">
    @if(auth()->user()->role && auth()->user()->role->name !== 'admin') <!-- Vérifie si le rôle n'est pas "admin" -->
        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            Utilisateurs
        </a>
    @endif
</li>

           
<li class="nav-item">
    @if(auth()->user()->role && auth()->user()->role->name == 'super_admin')
        <a class="nav-link {{ Request::is('roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
            <i class="fas fa-user-tag"></i>
            Rôles
        </a>
    @endif
</li>
            
            </ul>
        </div>
    </nav>

   
    <nav class="topbar">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="d-flex align-items-center">
            <div class="user-dropdown">
    <button id="userDropdownBtn" class="btn d-flex align-items-center">
        <i class="fas fa-user me-2"></i>
        <span class="me-2">{{ auth()->user()->name }}</span>
        <i class="fas fa-chevron-down"></i>
    </button>
    <div id="userMenu" class="user-menu p-2">
        <div class="px-3 py-2 border-bottom">
            <div class="fw-bold">{{ auth()->user()->name }}</div>
            <div class="text-muted small">{{ auth()->user()->email }}</div>
        </div>
        <a href="{{ route('profile.edit') }}" class="d-block p-2 text-decoration-none text-dark">
            <i class="fas fa-user-edit me-2"></i>Profile
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-dark text-decoration-none px-2 w-100 text-start">
                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
            </button>
        </form>
    </div>
</div>
            </div>
        </div>
    </nav>

    
    <main class="main-content">
        @yield('content')
    </main>

    
    <footer class="footer text-center">
        <p class="mb-0">&copy; {{ date('Y') }} Eureka fashion . votre style, notre passion.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const topbar = document.querySelector('.topbar');
            const footer = document.querySelector('.footer');
            
            sidebar.classList.toggle('d-none');
            if (sidebar.classList.contains('d-none')) {
                mainContent.style.marginLeft = '0';
                topbar.style.left = '0';
                footer.style.left = '0';
            } else {
                mainContent.style.marginLeft = '250px';
                topbar.style.left = '250px';
                footer.style.left = '250px';
            }
        });


        
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownBtn = document.getElementById('userDropdownBtn');
        const userMenu = document.getElementById('userMenu');
        let isDropdownOpen = false;

        
        function closeDropdown() {
            userMenu.classList.remove('show');
            isDropdownOpen = false;
        }

        dropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (isDropdownOpen) {
                closeDropdown();
            } else {
                userMenu.classList.add('show');
                isDropdownOpen = true;
            }
        });

        
        document.addEventListener('click', function(e) {
            if (isDropdownOpen && !userMenu.contains(e.target) && !dropdownBtn.contains(e.target)) {
                closeDropdown();
            }
        });

        
        userMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    </script>
</body>
</html>