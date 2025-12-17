 <!-- Auth Modal -->
    <div class="modal-overlay" id="authModal">
        <div class="modal">
            <button class="modal-close" id="modalClose">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-header">
                <div class="modal-logo">MAISON É</div>
                <h2 class="modal-title" id="modalTitle">Welcome Back</h2>
                <p class="modal-subtitle" id="modalSubtitle">Sign in to access your account</p>
            </div>
            <div class="modal-body">
                <div class="auth-tabs">
                    <button class="auth-tab active" data-tab="login">Sign In</button>
                    <button class="auth-tab" data-tab="register">Create Account</button>
                </div>

                <!-- Login Form -->
                <form id="loginForm">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-input" id="loginEmail" placeholder="your@email.com" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="password-toggle">
                            <input type="password" class="form-input" id="loginPassword" placeholder="Enter your password" required>
                            <button type="button" class="toggle-password" data-target="loginPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-checkbox">
                        <input type="checkbox" id="rememberMe">
                        <label for="rememberMe">Remember me</label>
                    </div>
                    <button type="submit" class="submit-btn">Sign In</button>
                    <div class="divider">
                        <span>or continue with</span>
                    </div>
                    <div class="social-auth">
                        <button type="button" class="social-auth-btn"><i class="fab fa-google"></i></button>
                
                        <button type="button" class="social-auth-btn"><i class="fab fa-facebook-f"></i></button>
                    </div>
                </form>

                <!-- Register Form -->
                <form id="registerForm" style="display: none;">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-input" id="registerName" placeholder="John Doe" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-input" id="registerEmail" placeholder="your@email.com" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="password-toggle">
                            <input type="password" class="form-input" id="registerPassword" placeholder="Create a password" required minlength="8">
                            <button type="button" class="toggle-password" data-target="registerPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <div class="password-toggle">
                            <input type="password" class="form-input" id="confirmPassword" placeholder="Confirm your password" required>
                            <button type="button" class="toggle-password" data-target="confirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-checkbox">
                        <input type="checkbox" id="agreeTerms" required>
                        <label for="agreeTerms">I agree to the <a href="#">Terms</a> and <a href="#">Privacy Policy</a></label>
                    </div>
                    <button type="submit" class="submit-btn">Create Account</button>
                    <div class="divider">
                        <span>or continue with</span>
                    </div>
                    <div class="social-auth">
                        <button type="button" class="social-auth-btn"><i class="fab fa-google"></i></button>
                        <button type="button" class="social-auth-btn"><i class="fab fa-apple"></i></button>
                        <button type="button" class="social-auth-btn"><i class="fab fa-facebook-f"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="modal-overlay" id="quickViewModal">
        <div class="modal quick-view-modal">
            <button class="modal-close" id="quickViewClose">
                <i class="fas fa-times"></i>
            </button>
            <div class="quick-view-content">
                <div class="quick-view-image" id="quickViewImage"></div>
                <div class="quick-view-info">
                    <p class="product-category" id="quickViewCategory"></p>
                    <h2 id="quickViewName"></h2>
                    <div class="product-price">
                        <span class="current-price" id="quickViewPrice"></span>
                        <span class="original-price" id="quickViewOriginalPrice"></span>
                    </div>
                    <p id="quickViewDesc">Experience unparalleled comfort and style with this exquisitely crafted piece. Made from premium materials with meticulous attention to detail, this garment embodies the essence of modern luxury.</p>
                    <div class="size-selector">
                        <span class="size-label">Select Size</span>
                        <div class="size-options">
                            <button class="size-option">XS</button>
                            <button class="size-option">S</button>
                            <button class="size-option active">M</button>
                            <button class="size-option">L</button>
                            <button class="size-option">XL</button>
                        </div>
                    </div>
                    <button class="add-to-cart-btn" id="addToCartBtn">
                        <i class="fas fa-shopping-bag"></i>
                        Add to Bag
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>