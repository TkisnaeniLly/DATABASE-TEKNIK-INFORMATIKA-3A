    <!-- Navigation -->
    <nav id="navbar">
        <a href="#" class="nav-logo">IT <span>SHOP</span></a>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#collections">Collections</a></li>
            <li><a href="#products">Shop</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="nav-icons">
            <button class="nav-icon" id="themeToggle" aria-label="Toggle theme">
                <i class="fas fa-moon"></i>
            </button>
            <button class="nav-icon" aria-label="Search">
                <i class="fas fa-search"></i>
            </button>
            <div class="user-menu" id="userMenuContainer">
                <button class="nav-icon" id="userBtn" aria-label="Account">
                    <i class="fas fa-user"></i>
                </button>
                <div class="user-dropdown" id="userDropdown" style="display: none;">
                    <div class="user-dropdown-header">
                        <div class="user-dropdown-name" id="dropdownName"></div>
                        <div class="user-dropdown-email" id="dropdownEmail"></div>
                    </div>
                    <ul class="user-dropdown-links">
                        <li><a href="#"><i class="fas fa-user"></i> My Profile</a></li>
                        <li><a href="#"><i class="fas fa-box"></i> Orders</a></li>
                        <li><a href="#"><i class="fas fa-heart"></i> Wishlist</a></li>
                        <li><a href="#" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
            <button class="nav-icon" style="position: relative;" aria-label="Cart" onclick="goToCart()">
                <i class="fas fa-shopping-bag"></i>
                <span class="cart-count" id="cartCount">0</span>
            </button>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- Mobile Navigation -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
    <div class="mobile-nav" id="mobileNav">
        <button class="mobile-nav-close" id="mobileNavClose">
            <i class="fas fa-times"></i>
        </button>
        <ul class="mobile-nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#collections">Collections</a></li>
            <li><a href="#products">Shop</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </div>
    <script>
        function goToCart() {
            window.location.href = '/cart';
        }
    </script>
