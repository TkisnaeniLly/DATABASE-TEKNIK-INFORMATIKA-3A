@extends('layouts.app')

@section('content')
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-pattern"></div>
        <div class="hero-content">
            <p class="hero-subtitle">New Collection 2025</p>
            <h1 class="hero-title">Timeless <span>Elegance</span></h1>
            <p class="hero-desc">Discover our curated collection of luxury fashion pieces, crafted with exceptional attention
                to detail and sustainable materials.</p>
            <a href="#products" class="hero-btn">Explore Collection</a>
        </div>
        <div class="scroll-indicator">
            <span>Scroll</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories" id="collections">
        <div class="section-header">
            <p class="section-subtitle">Explore</p>
            <h2 class="section-title">Featured Collections</h2>
        </div>
        <div class="categories-grid">
            <div class="category-card" data-category="t-shirt">
                <div class="category-bg">
                    <i class="fas fa-tshirt"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">T-Shirts</h3>
                    <p class="category-count">{{ collect($products)->where('category', 't-shirt')->count() }} Products</p>
                </div>
            </div>
            <div class="category-card" data-category="jaket">
                <div class="category-bg">
                    <i class="fas fa-vest"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">Jackets</h3>
                    <p class="category-count">{{ collect($products)->where('category', 'jaket')->count() }} Products</p>
                </div>
            </div>
            <div class="category-card" data-category="sepatu">
                <div class="category-bg">
                    <i class="fas fa-shoe-prints"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">Shoes</h3>
                    <p class="category-count">{{ collect($products)->where('category', 'sepatu')->count() }} Products</p>
                </div>
            </div>
            <div class="category-card" data-category="new">
                <div class="category-bg">
                    <i class="fas fa-star"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">New Arrivals</h3>
                    <p class="category-count">{{ collect($products)->where('badge', 'New')->count() }} Products</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products" id="products">
        <div class="section-header">
            <p class="section-subtitle">Shop Now</p>
            <h2 class="section-title">Featured Products</h2>
        </div>
        <div class="filter-tabs">
            <button class="filter-tab active" data-filter="all">All</button>
            <button class="filter-tab" data-filter="t-shirt">T-Shirts</button>
            <button class="filter-tab" data-filter="jaket">Jackets</button>
            <button class="filter-tab" data-filter="sepatu">Shoes</button>
            <button class="filter-tab" data-filter="new">New</button>
        </div>
        <div class="products-grid" id="productsGrid">
            @foreach ($products as $product)
                <div class="product-card" data-id="{{ $product['id'] }}" data-category="{{ $product['category'] }}"
                    data-badge="{{ $product['badge'] }}">
                    <div class="product-image" style="background: linear-gradient(135deg, #D6A99D 0%, #C9967E 100%);">
                        @if (!empty($product['image']))
                            <img src="{{ App\Helpers\ImageHelper::getUrl($product['image']) }}" alt="{{ $product['name'] }}"
                                this.nextElementSibling.style.display='block';"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="fas fa-tshirt"></i>
                        @endif
                        @if ($product['badge'])
                            <span class="product-badge">{{ $product['badge'] }}</span>
                        @endif
                        <div class="product-actions">
                            <button class="product-action-btn wishlist-btn" title="Add to Wishlist">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="product-action-btn quick-view-btn" data-product-id="{{ $product['id'] }}"
                                title="Quick View">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <p class="product-category">{{ $product['category'] }}</p>
                        <h3 class="product-name">{{ $product['name'] }}</h3>
                        @if ($product['brand'])
                            <p class="product-brand" style="font-size: 0.85rem; color: #888; margin-top: 0.25rem;">
                                {{ $product['brand'] }}</p>
                        @endif
                        <div class="product-price">
                            <span class="current-price">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                            @if ($product['originalPrice'])
                                <span class="original-price">Rp
                                    {{ number_format($product['originalPrice'], 0, ',', '.') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
        <h2 class="newsletter-title">Join Our World</h2>
        <p class="newsletter-desc">Subscribe to receive exclusive offers, early access to new collections, and personalized
            style recommendations.</p>
        <form class="newsletter-form" id="newsletterForm">
            <input type="email" class="newsletter-input" placeholder="Enter your email address" required>
            <button type="submit" class="newsletter-btn">Subscribe</button>
        </form>
    </section>

    <script>
        // Pass products data to JavaScript
        window.productsData = @json($products);

        // Create product map for quick access
        window.productsMap = {};
        window.productsData.forEach(product => {
            window.productsMap[product.id] = product;
        });

        const newsletterForm = document.getElementById("newsletterForm");
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
    </script>
@endsection
