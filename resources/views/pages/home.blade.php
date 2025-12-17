@extends('layouts.app')

@section('content')

    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-pattern"></div>
        <div class="hero-content">
            <p class="hero-subtitle">New Collection 2025</p>
            <h1 class="hero-title">Timeless <span>Elegance</span></h1>
            <p class="hero-desc">Discover our curated collection of luxury fashion pieces, crafted with exceptional attention to detail and sustainable materials.</p>
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
            <div class="category-card" data-category="women">
                <div class="category-bg">
                    <i class="fas fa-female"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">Women</h3>
                    <p class="category-count">124 Products</p>
                </div>
            </div>
            <div class="category-card" data-category="men">
                <div class="category-bg">
                    <i class="fas fa-male"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">Men</h3>
                    <p class="category-count">98 Products</p>
                </div>
            </div>
            <div class="category-card" data-category="accessories">
                <div class="category-bg">
                    <i class="fas fa-gem"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">Accessories</h3>
                    <p class="category-count">76 Products</p>
                </div>
            </div>
            <div class="category-card" data-category="new">
                <div class="category-bg">
                    <i class="fas fa-star"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">New Arrivals</h3>
                    <p class="category-count">42 Products</p>
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
            <button class="filter-tab" data-filter="women">Women</button>
            <button class="filter-tab" data-filter="men">Men</button>
            <button class="filter-tab" data-filter="accessories">Accessories</button>
            <button class="filter-tab" data-filter="new">New</button>
        </div>
        <div class="products-grid" id="productsGrid">
            <!-- Products will be loaded dynamically -->
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
        <h2 class="newsletter-title">Join Our World</h2>
        <p class="newsletter-desc">Subscribe to receive exclusive offers, early access to new collections, and personalized style recommendations.</p>
        <form class="newsletter-form" id="newsletterForm">
            <input type="email" class="newsletter-input" placeholder="Enter your email address" required>
            <button type="submit" class="newsletter-btn">Subscribe</button>
        </form>
    </section>

@endsection
