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
                         <input type="password" class="form-input" id="loginPassword" placeholder="Enter your password"
                             required>
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
                         <input type="password" class="form-input" id="registerPassword" placeholder="Create a password"
                             required minlength="8">
                         <button type="button" class="toggle-password" data-target="registerPassword">
                             <i class="fas fa-eye"></i>
                         </button>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="form-label">Confirm Password</label>
                     <div class="password-toggle">
                         <input type="password" class="form-input" id="confirmPassword"
                             placeholder="Confirm your password" required>
                         <button type="button" class="toggle-password" data-target="confirmPassword">
                             <i class="fas fa-eye"></i>
                         </button>
                     </div>
                 </div>
                 <div class="form-checkbox">
                     <input type="checkbox" id="agreeTerms" required>
                     <label for="agreeTerms">I agree to the <a href="#">Terms</a> and <a href="#">Privacy
                             Policy</a></label>
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
 {{-- <div class="modal-overlay" id="quickViewModal">
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
     <!-- Quick View Modal -->

 </div> --}}
<div class="modal-overlay" id="quickViewModal">
    <div class="modal quick-view-modal">
        <button class="modal-close" id="quickViewClose">
            <i class="fas fa-times"></i>
        </button>
        <div class="quick-view-content">
            <!-- Product Image -->
            <div class="quick-view-image" id="quickViewImage">
                <!-- Image will be inserted here -->
            </div>
            
            <!-- Product Info -->
            <div class="quick-view-info">
                <!-- Category & Brand -->
                <div class="product-header">
                    <p class="product-category" id="quickViewCategory">Category</p>
                    <p class="product-brand" id="quickViewBrand" style="display: none;">Brand</p>
                </div>
                
                <!-- Product Name -->
                <h2 class="product-name" id="quickViewName">Product Name</h2>
                
                <!-- Price Section -->
                <div class="product-price">
                    <span class="current-price" id="quickViewPrice">Rp 0</span>
                    <span class="original-price" id="quickViewOriginalPrice" style="display: none;">Rp 0</span>
                </div>
                
                <!-- Description -->
                <p class="product-description" id="quickViewDescription" style="display: none;">
                    Product description will appear here
                </p>
                
                <!-- Size Selector -->
                <div class="size-selector">
                    <span class="size-label">Select Size</span>
                    <div class="size-options">
                        <!-- Sizes will be inserted here dynamically -->
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="add-to-cart-btn" id="addToCartBtn">
                        <i class="fas fa-shopping-bag"></i>
                        Add to Cart
                    </button>
                    <button class="wishlist-btn" id="quickViewWishlistBtn">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                
                <!-- Product Features -->
                <div class="product-features">
                    <div class="feature-item">
                        <i class="fas fa-truck"></i>
                        <span>Free Shipping</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-undo"></i>
                        <span>Easy Returns</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Secure Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Toast Container -->
 <div class="toast-container" id="toastContainer"></div>


<style>
/* ===================================
   QUICK VIEW MODAL STYLES
   =================================== */

/* Modal Overlay */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(4px);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    padding: 1rem;
}

.modal-overlay.active {
    display: flex;
    opacity: 1;
}

/* Modal Container */
.quick-view-modal {
    background: white;
    border-radius: 20px;
    max-width: 900px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    animation: modalSlideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes modalSlideUp {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Modal Close Button */
.quick-view-modal .modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 40px;
    height: 40px;
    border: none;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.quick-view-modal .modal-close:hover {
    background: white;
    transform: rotate(90deg);
}

.quick-view-modal .modal-close i {
    font-size: 1.25rem;
    color: #374151;
}

/* Quick View Content Grid */
.quick-view-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
}

/* Product Image Section */
.quick-view-image {
    width: 100%;
    height: 100%;
    min-height: 400px;
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    border-radius: 20px 0 0 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}

.quick-view-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.quick-view-image i {
    font-size: 5rem;
    color: rgba(0, 0, 0, 0.1);
}

/* Product Info Section */
.quick-view-info {
    padding: 2.5rem 2rem;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

/* Product Header (Category & Brand) */
.product-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.product-category {
    font-size: 0.8rem;
    color: #6366f1;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    font-weight: 700;
    margin: 0;
}

.product-brand {
    font-size: 0.8rem;
    color: #9ca3af;
    margin: 0;
    padding-left: 0.75rem;
    border-left: 2px solid #e5e7eb;
}

/* Product Name */
.quick-view-info .product-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
    margin: 0;
    line-height: 1.3;
}

/* Price Section */
.quick-view-info .product-price {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.quick-view-info .current-price {
    font-size: 1.75rem;
    font-weight: 800;
    color: #111827;
    transition: all 0.3s ease;
}

.quick-view-info .original-price {
    font-size: 1.125rem;
    color: #9ca3af;
    text-decoration: line-through;
}

/* Product Description */
.product-description {
    font-size: 0.9rem;
    line-height: 1.6;
    color: #6b7280;
    margin: 0;
    padding: 1rem 0;
    border-top: 1px solid #e5e7eb;
    border-bottom: 1px solid #e5e7eb;
}

/* Size Selector */
.size-selector {
    margin: 0.5rem 0;
}

.size-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.size-options {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.size-option {
    min-width: 48px;
    height: 48px;
    padding: 0 1rem;
    border: 2px solid #e5e7eb;
    background: white;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #374151;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.size-option:hover {
    border-color: #6366f1;
    background: #f3f4f6;
}

.size-option.active {
    border-color: #6366f1;
    background: #6366f1;
    color: white;
}

.size-option:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.75rem;
    margin-top: 0.5rem;
}

.add-to-cart-btn {
    flex: 1;
    padding: 1rem 1.5rem;
    background: #111827;
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.add-to-cart-btn:hover {
    background: #000;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.add-to-cart-btn:active {
    transform: translateY(0);
}

.wishlist-btn {
    width: 56px;
    height: 56px;
    border: 2px solid #e5e7eb;
    background: white;
    border-radius: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.wishlist-btn:hover {
    border-color: #ef4444;
    background: #fef2f2;
}

.wishlist-btn i {
    font-size: 1.25rem;
    color: #6b7280;
    transition: all 0.3s ease;
}

.wishlist-btn:hover i {
    color: #ef4444;
}

.wishlist-btn.active i {
    color: #ef4444;
}

.wishlist-btn.active i::before {
    content: "\f004"; /* Solid heart */
}

/* Product Features */
.product-features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    margin-top: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e7eb;
}

.feature-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 0.5rem;
}

.feature-item i {
    font-size: 1.25rem;
    color: #6366f1;
}

.feature-item span {
    font-size: 0.75rem;
    color: #6b7280;
    font-weight: 500;
}

/* ===================================
   RESPONSIVE STYLES
   =================================== */

/* Tablet */
@media (max-width: 768px) {
    .quick-view-content {
        grid-template-columns: 1fr;
    }
    
    .quick-view-image {
        border-radius: 20px 20px 0 0;
        min-height: 300px;
    }
    
    .quick-view-info {
        padding: 2rem 1.5rem;
    }
    
    .quick-view-info .product-name {
        font-size: 1.25rem;
    }
    
    .quick-view-info .current-price {
        font-size: 1.5rem;
    }
    
    .product-features {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .feature-item {
        flex-direction: row;
        justify-content: center;
    }
}

/* Mobile */
@media (max-width: 480px) {
    .modal-overlay {
        padding: 0.5rem;
    }
    
    .quick-view-modal {
        max-height: 95vh;
        border-radius: 16px;
    }
    
    .quick-view-image {
        min-height: 250px;
        border-radius: 16px 16px 0 0;
    }
    
    .quick-view-info {
        padding: 1.5rem 1rem;
        gap: 1rem;
    }
    
    .quick-view-info .product-name {
        font-size: 1.125rem;
    }
    
    .quick-view-info .current-price {
        font-size: 1.25rem;
    }
    
    .size-options {
        gap: 0.375rem;
    }
    
    .size-option {
        min-width: 44px;
        height: 44px;
        font-size: 0.85rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .wishlist-btn {
        width: 100%;
        height: 48px;
    }
    
    .add-to-cart-btn {
        padding: 0.875rem 1rem;
        font-size: 0.9rem;
    }
}

/* ===================================
   DARK MODE SUPPORT
   =================================== */

.dark .quick-view-modal {
    background: #1f2937;
}

.dark .quick-view-image {
    background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
}

.dark .quick-view-modal .modal-close {
    background: rgba(31, 41, 55, 0.9);
}

.dark .quick-view-modal .modal-close i {
    color: #f9fafb;
}

.dark .product-category {
    color: #818cf8;
}

.dark .product-brand {
    color: #6b7280;
    border-left-color: #374151;
}

.dark .quick-view-info .product-name {
    color: #f9fafb;
}

.dark .quick-view-info .current-price {
    color: #f9fafb;
}

.dark .product-description {
    color: #9ca3af;
    border-color: #374151;
}

.dark .size-label {
    color: #d1d5db;
}

.dark .size-option {
    border-color: #374151;
    background: #1f2937;
    color: #d1d5db;
}

.dark .size-option:hover {
    border-color: #818cf8;
    background: #374151;
}

.dark .size-option.active {
    border-color: #818cf8;
    background: #818cf8;
    color: white;
}

.dark .add-to-cart-btn {
    background: #f9fafb;
    color: #111827;
}

.dark .add-to-cart-btn:hover {
    background: white;
}

.dark .wishlist-btn {
    border-color: #374151;
    background: #1f2937;
}

.dark .wishlist-btn:hover {
    border-color: #ef4444;
    background: #7f1d1d;
}

.dark .wishlist-btn i {
    color: #9ca3af;
}

.dark .product-features {
    border-color: #374151;
}

.dark .feature-item i {
    color: #818cf8;
}

.dark .feature-item span {
    color: #9ca3af;
}
</style>
