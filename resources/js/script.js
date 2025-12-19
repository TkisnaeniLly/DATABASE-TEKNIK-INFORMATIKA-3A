// Get products from window (passed from Blade)
const products = window.productsData || [];

// App State
let currentUser = null;
let cartCount = 0;

// DOM Elements
const preloader = document.getElementById("preloader");
const navbar = document.getElementById("navbar");
const themeToggle = document.getElementById("themeToggle");
const userBtn = document.getElementById("userBtn");
const userDropdown = document.getElementById("userDropdown");
const authModal = document.getElementById("authModal");
const modalClose = document.getElementById("modalClose");
const loginForm = document.getElementById("loginForm");
const registerForm = document.getElementById("registerForm");
const productsGrid = document.getElementById("productsGrid");
const filterTabs = document.querySelectorAll(".filter-tab");
const quickViewModal = document.getElementById("quickViewModal");
const quickViewClose = document.getElementById("quickViewClose");
const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const mobileNav = document.getElementById("mobileNav");
const mobileNavClose = document.getElementById("mobileNavClose");
const mobileNavOverlay = document.getElementById("mobileNavOverlay");
const logoutBtn = document.getElementById("logoutBtn");
const cartCountEl = document.getElementById("cartCount");

// Theme Detection and Toggle
function initTheme() {
    if (
        window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches
    ) {
        document.documentElement.classList.add("dark");
        updateThemeIcon(true);
    }
    window
        .matchMedia("(prefers-color-scheme: dark)")
        .addEventListener("change", (event) => {
            if (event.matches) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
            updateThemeIcon(event.matches);
        });
}

function updateThemeIcon(isDark) {
    const icon = themeToggle.querySelector("i");
    icon.className = isDark ? "fas fa-sun" : "fas fa-moon";
}

themeToggle.addEventListener("click", () => {
    const isDark = document.documentElement.classList.toggle("dark");
    updateThemeIcon(isDark);
});

// Preloader
window.addEventListener("load", () => {
    setTimeout(() => {
        preloader.classList.add("hidden");
    }, 1500);
});

// Navbar Scroll Effect
window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});

// Mobile Menu
mobileMenuBtn.addEventListener("click", () => {
    mobileNav.classList.add("active");
    mobileNavOverlay.classList.add("active");
});

function closeMobileNav() {
    mobileNav.classList.remove("active");
    mobileNavOverlay.classList.remove("active");
}

mobileNavClose.addEventListener("click", closeMobileNav);
mobileNavOverlay.addEventListener("click", closeMobileNav);

document.querySelectorAll(".mobile-nav-links a").forEach((link) => {
    link.addEventListener("click", closeMobileNav);
});

// Auth Modal
userBtn.addEventListener("click", () => {
    if (currentUser) {
        userDropdown.style.display =
            userDropdown.style.display === "none" ? "block" : "none";
    } else {
        authModal.classList.add("active");
    }
});

modalClose.addEventListener("click", () => {
    authModal.classList.remove("active");
});

authModal.addEventListener("click", (e) => {
    if (e.target === authModal) {
        authModal.classList.remove("active");
    }
});

// Auth Tabs
document.querySelectorAll(".auth-tab").forEach((tab) => {
    tab.addEventListener("click", () => {
        document
            .querySelectorAll(".auth-tab")
            .forEach((t) => t.classList.remove("active"));
        tab.classList.add("active");

        const tabName = tab.dataset.tab;
        const modalTitle = document.getElementById("modalTitle");
        const modalSubtitle = document.getElementById("modalSubtitle");

        if (tabName === "login") {
            loginForm.style.display = "block";
            registerForm.style.display = "none";
            modalTitle.textContent = "Welcome Back";
            modalSubtitle.textContent = "Sign in to access your account";
        } else {
            loginForm.style.display = "none";
            registerForm.style.display = "block";
            modalTitle.textContent = "Create Account";
            modalSubtitle.textContent = "Join our exclusive community";
        }
    });
});

// Password Toggle
document.querySelectorAll(".toggle-password").forEach((btn) => {
    btn.addEventListener("click", () => {
        const targetId = btn.dataset.target;
        const input = document.getElementById(targetId);
        const icon = btn.querySelector("i");

        if (input.type === "password") {
            input.type = "text";
            icon.className = "fas fa-eye-slash";
        } else {
            input.type = "password";
            icon.className = "fas fa-eye";
        }
    });
});

// Toast Notification
function showToast(type, title, message) {
    const toastContainer = document.getElementById("toastContainer");
    const toast = document.createElement("div");
    toast.className = `toast toast-${type}`;

    const iconClass =
        type === "success"
            ? "fa-check"
            : type === "error"
            ? "fa-times"
            : "fa-info";

    toast.innerHTML = `
                <div class="toast-icon"><i class="fas ${iconClass}"></i></div>
                <div class="toast-content">
                    <div class="toast-title">${title}</div>
                    <div class="toast-message">${message}</div>
                </div>
            `;

    toastContainer.appendChild(toast);

    setTimeout(() => toast.classList.add("show"), 100);

    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => toast.remove(), 400);
    }, 4000);
}

// Login Form
loginForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const email = document.getElementById("loginEmail").value;
    const password = document.getElementById("loginPassword").value;

    // Simulate login
    if (email && password.length >= 6) {
        currentUser = {
            name:
                email.split("@")[0].charAt(0).toUpperCase() +
                email.split("@")[0].slice(1),
            email: email,
        };

        updateUserUI();
        authModal.classList.remove("active");
        showToast(
            "success",
            "Welcome Back!",
            `Signed in as ${currentUser.name}`
        );
        loginForm.reset();
    } else {
        showToast("error", "Login Failed", "Please check your credentials");
    }
});

// Register Form
registerForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const name = document.getElementById("registerName").value;
    const email = document.getElementById("registerEmail").value;
    const password = document.getElementById("registerPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        showToast("error", "Password Mismatch", "Passwords do not match");
        return;
    }

    if (password.length < 8) {
        showToast(
            "error",
            "Weak Password",
            "Password must be at least 8 characters"
        );
        return;
    }

    currentUser = { name, email };
    updateUserUI();
    authModal.classList.remove("active");
    showToast("success", "Account Created!", `Welcome to our store, ${name}`);
    registerForm.reset();
});

// Update User UI
function updateUserUI() {
    if (currentUser) {
        document.getElementById("dropdownName").textContent = currentUser.name;
        document.getElementById("dropdownEmail").textContent =
            currentUser.email;
        userDropdown.style.display = "none";
        userBtn.innerHTML = `<i class="fas fa-user-check"></i>`;
    } else {
        userDropdown.style.display = "none";
        userBtn.innerHTML = `<i class="fas fa-user"></i>`;
    }
}

// Logout
logoutBtn.addEventListener("click", (e) => {
    e.preventDefault();
    currentUser = null;
    updateUserUI();
    showToast("info", "Signed Out", "You have been logged out successfully");
});

// Filter Products - Now works with rendered HTML
filterTabs.forEach((tab) => {
    tab.addEventListener("click", () => {
        filterTabs.forEach((t) => t.classList.remove("active"));
        tab.classList.add("active");

        const filter = tab.dataset.filter;
        const productCards = document.querySelectorAll(".product-card");

        productCards.forEach((card) => {
            const category = card.dataset.category;
            const badge = card.dataset.badge;

            if (filter === "all") {
                card.style.display = "block";
            } else if (filter === "new") {
                card.style.display = badge === "New" ? "block" : "none";
            } else {
                card.style.display = category === filter ? "block" : "none";
            }
        });
    });
});

// Quick View Modal
document.querySelectorAll(".quick-view-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const productId = parseInt(btn.dataset.productId);
        const product = window.productsMap[productId];
        if (product) {
            openQuickView(product);
        } else {
            console.error("Product not found:", productId);
        }
    });
});

function openQuickView(product) {
    if (!product) return;

    // Store current product in modal for later use
    quickViewModal.dataset.currentProduct = JSON.stringify(product);

    // Update modal content
    const quickViewImage = document.getElementById("quickViewImage");
    const imgElement = document.createElement("img");
    imgElement.src = product.image;
    imgElement.alt = product.name;
    imgElement.style.cssText = "width: 100%; height: 100%; object-fit: cover;";
    imgElement.onerror = function () {
        this.style.display = "none";
        quickViewImage.innerHTML = '<i class="fas fa-tshirt"></i>';
    };
    quickViewImage.innerHTML = "";
    quickViewImage.appendChild(imgElement);

    document.getElementById("quickViewCategory").textContent =
        product.category || "Product";
    document.getElementById("quickViewName").textContent = product.name;

    // Update brand if available
    const brandEl = document.getElementById("quickViewBrand");
    if (brandEl && product.brand) {
        brandEl.textContent = product.brand;
        brandEl.style.display = "block";
    } else if (brandEl) {
        brandEl.style.display = "none";
    }

    // Update description if available
    const descEl = document.getElementById("quickViewDescription");
    if (descEl && product.description) {
        descEl.textContent = product.description;
        descEl.style.display = "block";
    } else if (descEl) {
        descEl.style.display = "none";
    }

    // Update variants if available
    const sizeOptions = document.querySelector(".size-options");
    if (sizeOptions && product.variants && product.variants.length > 0) {
        const sizeVariants = product.variants.filter(
            (v) => v.variant_type === "SIZE"
        );

        if (sizeVariants.length > 0) {
            sizeOptions.innerHTML = sizeVariants
                .map(
                    (v, i) => `
                    <button class="size-option ${i === 0 ? "active" : ""}" 
                            data-variant-id="${v.id}"
                            data-variant-price="${v.price}">
                        ${v.variant_value}
                    </button>
                `
                )
                .join("");

            // Set initial price (first variant)
            updateQuickViewPrice(parseFloat(sizeVariants[0].price));

            // Add event listeners to update price on variant change
            document.querySelectorAll(".size-option").forEach((sizeBtn) => {
                sizeBtn.addEventListener("click", () => {
                    // Update active state
                    document
                        .querySelectorAll(".size-option")
                        .forEach((b) => b.classList.remove("active"));
                    sizeBtn.classList.add("active");

                    // Update price based on selected variant
                    const variantPrice = parseFloat(
                        sizeBtn.dataset.variantPrice
                    );
                    updateQuickViewPrice(variantPrice);
                });
            });
            sizeOptions.parentElement.style.display = "block";
        } else {
            sizeOptions.parentElement.style.display = "none";
            // Set price if no variants
            const price = parseFloat(product.price) || 0;
            updateQuickViewPrice(price);
        }
    } else if (sizeOptions) {
        sizeOptions.parentElement.style.display = "none";
        // Set price if no variants
        const price = parseFloat(product.price) || 0;
        updateQuickViewPrice(price);
    }

    // Reset wishlist button state
    const wishlistBtn = document.getElementById("quickViewWishlistBtn");
    if (wishlistBtn) {
        const wishlist = JSON.parse(localStorage.getItem("wishlist") || "[]");
        const isInWishlist = wishlist.some((item) => item.id === product.id);

        if (isInWishlist) {
            wishlistBtn.classList.add("active");
            wishlistBtn.querySelector("i").className = "fas fa-heart";
        } else {
            wishlistBtn.classList.remove("active");
            wishlistBtn.querySelector("i").className = "far fa-heart";
        }
    }

    quickViewModal.classList.add("active");
}

// Helper function to update price display in quick view modal
function updateQuickViewPrice(price) {
    const priceEl = document.getElementById("quickViewPrice");
    const originalPriceEl = document.getElementById("quickViewOriginalPrice");

    if (priceEl) {
        priceEl.textContent = `Rp ${price.toLocaleString("id-ID")}`;

        // Add animation effect
        priceEl.style.transform = "scale(1.1)";
        priceEl.style.transition = "transform 0.2s ease";
        setTimeout(() => {
            priceEl.style.transform = "scale(1)";
        }, 200);
    }

    // Hide original price for now (you can add discount logic later)
    if (originalPriceEl) {
        originalPriceEl.style.display = "none";
    }
}

quickViewClose.addEventListener("click", () => {
    quickViewModal.classList.remove("active");
});

quickViewModal.addEventListener("click", (e) => {
    if (e.target === quickViewModal) {
        quickViewModal.classList.remove("active");
    }
});

// Quick View Wishlist Button
const quickViewWishlistBtn = document.getElementById("quickViewWishlistBtn");
if (quickViewWishlistBtn) {
    quickViewWishlistBtn.addEventListener("click", () => {
        const currentProduct = JSON.parse(
            quickViewModal.dataset.currentProduct || "{}"
        );

        if (!currentProduct.id) return;

        let wishlist = JSON.parse(localStorage.getItem("wishlist") || "[]");
        const existingIndex = wishlist.findIndex(
            (item) => item.id === currentProduct.id
        );

        if (existingIndex > -1) {
            // Remove from wishlist
            wishlist.splice(existingIndex, 1);
            quickViewWishlistBtn.classList.remove("active");
            quickViewWishlistBtn.querySelector("i").className = "far fa-heart";
            showToast(
                "info",
                "Removed from Wishlist",
                `${currentProduct.name} removed from wishlist`
            );
        } else {
            // Add to wishlist
            wishlist.push({
                id: currentProduct.id,
                name: currentProduct.name,
                price: currentProduct.price,
                image: currentProduct.image,
                addedAt: new Date().toISOString(),
            });
            quickViewWishlistBtn.classList.add("active");
            quickViewWishlistBtn.querySelector("i").className = "fas fa-heart";
            showToast(
                "success",
                "Added to Wishlist",
                `${currentProduct.name} added to wishlist`
            );
        }

        localStorage.setItem("wishlist", JSON.stringify(wishlist));
    });
}

// Wishlist functionality
document.querySelectorAll(".wishlist-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        const icon = btn.querySelector("i");
        icon.classList.toggle("far");
        icon.classList.toggle("fas");

        if (icon.classList.contains("fas")) {
            showToast(
                "success",
                "Added to Wishlist",
                "Item saved to your wishlist"
            );
        }
    });
});

// Add to Cart
document.getElementById("addToCartBtn").addEventListener("click", () => {
    // Get selected variant
    const selectedVariantBtn = document.querySelector(".size-option.active");

    if (!selectedVariantBtn) {
        showToast(
            "error",
            "Select Size",
            "Please select a size before adding to cart"
        );
        return;
    }

    const variantId = selectedVariantBtn.dataset.variantId;
    const variantValue = selectedVariantBtn.textContent.trim();
    const variantPrice = parseFloat(selectedVariantBtn.dataset.variantPrice);

    // Get current product info from modal
    const currentProduct = JSON.parse(
        quickViewModal.dataset.currentProduct || "{}"
    );

    // Create cart item object (you can save this to localStorage or send to backend)
    const cartItem = {
        productId: currentProduct.id,
        productName: currentProduct.name,
        variantId: variantId,
        variantSize: variantValue,
        price: variantPrice,
        quantity: 1,
        image: currentProduct.image,
        addedAt: new Date().toISOString(),
    };

    // Save to cart (example: localStorage)
    let rawCart = JSON.parse(localStorage.getItem("cart") || "[]");

    let cart = [];
    if (Array.isArray(rawCart)) {
        cart = rawCart;
    } else if (rawCart && Array.isArray(rawCart.items)) {
        cart = rawCart.items;
    }

    // Check if item already exists in cart
    const existingItemIndex = cart.findIndex(
        (item) => item.variantId === variantId
    );

    if (existingItemIndex > -1) {
        // Update quantity if item exists
        cart[existingItemIndex].quantity += 1;
        showToast(
            "success",
            "Updated Cart",
            `Quantity updated for ${variantValue}`
        );
    } else {
        // Add new item
        cart.push(cartItem);
        showToast(
            "success",
            "Added to Cart",
            `${currentProduct.name} (${variantValue}) added to cart`
        );
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    // Update cart count
    cartCount = cart.reduce((total, item) => total + item.quantity, 0);
    cartCountEl.textContent = cartCount;

    // Close modal
    quickViewModal.classList.remove("active");

    // console.log("Cart updated:", cart);
});

// Category Cards
document.querySelectorAll(".category-card").forEach((card) => {
    card.addEventListener("click", () => {
        const category = card.dataset.category;
        filterTabs.forEach((t) => t.classList.remove("active"));
        const targetTab = document.querySelector(
            `.filter-tab[data-filter="${category}"]`
        );
        if (targetTab) {
            targetTab.classList.add("active");

            // Filter products
            const productCards = document.querySelectorAll(".product-card");
            productCards.forEach((pCard) => {
                const pCategory = pCard.dataset.category;
                const badge = pCard.dataset.badge;

                if (category === "new") {
                    pCard.style.display = badge === "New" ? "block" : "none";
                } else {
                    pCard.style.display =
                        pCategory === category ? "block" : "none";
                }
            });
        }

        document
            .getElementById("products")
            .scrollIntoView({ behavior: "smooth" });
    });
});

// Close dropdown when clicking outside
document.addEventListener("click", (e) => {
    if (!e.target.closest(".user-menu")) {
        userDropdown.style.display = "none";
    }
});

// Initialize
initTheme();
loadCartCount();

// Function to load cart count from localStorage
function loadCartCount() {
    try {
        const rawCart = JSON.parse(localStorage.getItem("cart"));

        let items = [];

        if (Array.isArray(rawCart)) {
            items = rawCart;
        } else if (rawCart && Array.isArray(rawCart.items)) {
            items = rawCart.items;
        }

        const cartCount = items.reduce(
            (total, item) => total + (item.quantity ?? 1),
            0
        );

        cartCountEl.textContent = cartCount;
    } catch (error) {
        console.error("Error loading cart:", error);
        cartCountEl.textContent = 0;
    }
}
