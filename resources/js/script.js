// Product Data
const products = [
    {
        id: 1,
        name: "Silk Evening Gown",
        category: "women",
        price: 2850,
        originalPrice: 3200,
        badge: "New",
        color: "#D6A99D",
        icon: "fa-person-dress",
    },
    {
        id: 2,
        name: "Tailored Wool Blazer",
        category: "men",
        price: 1450,
        originalPrice: null,
        badge: null,
        color: "#9CAFAA",
        icon: "fa-shirt",
    },
    {
        id: 3,
        name: "Cashmere Wrap Coat",
        category: "women",
        price: 3200,
        originalPrice: 4000,
        badge: "Sale",
        color: "#D6DAC8",
        icon: "fa-mitten",
    },
    {
        id: 4,
        name: "Leather Crossbody Bag",
        category: "accessories",
        price: 890,
        originalPrice: null,
        badge: "Best Seller",
        color: "#C9A962",
        icon: "fa-bag-shopping",
    },
    {
        id: 5,
        name: "Linen Summer Dress",
        category: "women",
        price: 780,
        originalPrice: null,
        badge: "New",
        color: "#9CAFAA",
        icon: "fa-person-dress",
    },
    {
        id: 6,
        name: "Premium Cotton Shirt",
        category: "men",
        price: 320,
        originalPrice: 400,
        badge: "Sale",
        color: "#D6A99D",
        icon: "fa-shirt",
    },
    {
        id: 7,
        name: "Diamond Tennis Bracelet",
        category: "accessories",
        price: 4500,
        originalPrice: null,
        badge: "Exclusive",
        color: "#D6DAC8",
        icon: "fa-gem",
    },
    {
        id: 8,
        name: "Merino Wool Sweater",
        category: "men",
        price: 580,
        originalPrice: null,
        badge: null,
        color: "#C9A962",
        icon: "fa-shirt",
    },
    {
        id: 9,
        name: "Velvet Midi Skirt",
        category: "women",
        price: 650,
        originalPrice: 850,
        badge: "New",
        color: "#D6A99D",
        icon: "fa-person-dress",
    },
    {
        id: 10,
        name: "Leather Belt",
        category: "accessories",
        price: 280,
        originalPrice: null,
        badge: null,
        color: "#9CAFAA",
        icon: "fa-circle",
    },
    {
        id: 11,
        name: "Structured Tote Bag",
        category: "accessories",
        price: 1200,
        originalPrice: null,
        badge: "New",
        color: "#D6DAC8",
        icon: "fa-bag-shopping",
    },
    {
        id: 12,
        name: "Slim Fit Trousers",
        category: "men",
        price: 420,
        originalPrice: 520,
        badge: "Sale",
        color: "#C9A962",
        icon: "fa-person",
    },
];

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
const newsletterForm = document.getElementById("newsletterForm");
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
    showToast(
        "success",
        "Account Created!",
        `Welcome to Maison Élégance, ${name}`
    );
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

// Render Products
function renderProducts(filter = "all") {
    const filteredProducts =
        filter === "all"
            ? products
            : products.filter(
                  (p) =>
                      p.category === filter ||
                      (filter === "new" && p.badge === "New")
              );

    productsGrid.innerHTML = filteredProducts
        .map(
            (product) => `
                <div class="product-card" data-id="${
                    product.id
                }" data-category="${product.category}">
                    <div class="product-image" style="background: linear-gradient(135deg, ${
                        product.color
                    } 0%, ${adjustColor(product.color, -20)} 100%);">
                        <i class="fas ${product.icon}"></i>
                        ${
                            product.badge
                                ? `<span class="product-badge">${product.badge}</span>`
                                : ""
                        }
                        <div class="product-actions">
                            <button class="product-action-btn wishlist-btn" title="Add to Wishlist">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="product-action-btn quick-view-btn" title="Quick View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <p class="product-category">${product.category}</p>
                        <h3 class="product-name">${product.name}</h3>
                        <div class="product-price">
                            <span class="current-price">$${product.price.toLocaleString()}</span>
                            ${
                                product.originalPrice
                                    ? `<span class="original-price">$${product.originalPrice.toLocaleString()}</span>`
                                    : ""
                            }
                        </div>
                    </div>
                </div>
            `
        )
        .join("");

    // Add event listeners
    document.querySelectorAll(".quick-view-btn").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            const card = btn.closest(".product-card");
            const productId = parseInt(card.dataset.id);
            openQuickView(productId);
        });
    });

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
}

// Helper function to adjust color brightness
function adjustColor(hex, percent) {
    const num = parseInt(hex.replace("#", ""), 16);
    const amt = Math.round(2.55 * percent);
    const R = (num >> 16) + amt;
    const G = ((num >> 8) & 0x00ff) + amt;
    const B = (num & 0x0000ff) + amt;
    return (
        "#" +
        (
            0x1000000 +
            (R < 255 ? (R < 1 ? 0 : R) : 255) * 0x10000 +
            (G < 255 ? (G < 1 ? 0 : G) : 255) * 0x100 +
            (B < 255 ? (B < 1 ? 0 : B) : 255)
        )
            .toString(16)
            .slice(1)
    );
}

// Filter Products
filterTabs.forEach((tab) => {
    tab.addEventListener("click", () => {
        filterTabs.forEach((t) => t.classList.remove("active"));
        tab.classList.add("active");
        renderProducts(tab.dataset.filter);
    });
});

// Quick View Modal
function openQuickView(productId) {
    const product = products.find((p) => p.id === productId);
    if (!product) return;

    document.getElementById(
        "quickViewImage"
    ).style.background = `linear-gradient(135deg, ${
        product.color
    } 0%, ${adjustColor(product.color, -20)} 100%)`;
    document.getElementById(
        "quickViewImage"
    ).innerHTML = `<i class="fas ${product.icon}"></i>`;
    document.getElementById("quickViewCategory").textContent = product.category;
    document.getElementById("quickViewName").textContent = product.name;
    document.getElementById(
        "quickViewPrice"
    ).textContent = `$${product.price.toLocaleString()}`;
    document.getElementById("quickViewOriginalPrice").textContent =
        product.originalPrice
            ? `$${product.originalPrice.toLocaleString()}`
            : "";

    quickViewModal.classList.add("active");
}

quickViewClose.addEventListener("click", () => {
    quickViewModal.classList.remove("active");
});

quickViewModal.addEventListener("click", (e) => {
    if (e.target === quickViewModal) {
        quickViewModal.classList.remove("active");
    }
});

// Size Selection
document.querySelectorAll(".size-option").forEach((btn) => {
    btn.addEventListener("click", () => {
        document
            .querySelectorAll(".size-option")
            .forEach((b) => b.classList.remove("active"));
        btn.classList.add("active");
    });
});

// Add to Cart
document.getElementById("addToCartBtn").addEventListener("click", () => {
    cartCount++;
    cartCountEl.textContent = cartCount;
    quickViewModal.classList.remove("active");
    showToast(
        "success",
        "Added to Bag",
        "Item has been added to your shopping bag"
    );
});

// Category Cards
document.querySelectorAll(".category-card").forEach((card) => {
    card.addEventListener("click", () => {
        const category = card.dataset.category;
        filterTabs.forEach((t) => t.classList.remove("active"));
        const targetTab = document.querySelector(
            `.filter-tab[data-filter="${category}"]`
        );
        if (targetTab) targetTab.classList.add("active");
        renderProducts(category);
        document
            .getElementById("products")
            .scrollIntoView({ behavior: "smooth" });
    });
});

// Newsletter Form
newsletterForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const email = newsletterForm.querySelector("input").value;
    if (email) {
        showToast(
            "success",
            "Subscribed!",
            "Thank you for joining our newsletter"
        );
        newsletterForm.reset();
    }
});

// Close dropdown when clicking outside
document.addEventListener("click", (e) => {
    if (!e.target.closest(".user-menu")) {
        userDropdown.style.display = "none";
    }
});

// Initialize
initTheme();
renderProducts();
