@extends('layouts.app')

@section('content')
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-pattern"></div>
        <div class="hero-content">
            <p class="hero-subtitle">Koleksi Terbaru 2025</p>
            <h1 class="hero-title"> Gaya <span> Esensial</span></h1>
            <p class="hero-desc">
                Rangkaian fashion eksklusif dengan sentuhan modern, detail halus, 
                dan kualitas terbaik untuk setiap momen berharga Anda.
            </p>
            <a href="#products" class="hero-btn">Jelajahi Koleksi</a>
        </div>
        <div class="scroll-indicator">
            <span>Scroll</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories" id="collections">
        <div class="section-header">
            <p class="section-subtitle">Jelajahi</p>
            <h2 class="section-title">Koleksi Unggulan</h2>
        </div>
        <div class="categories-grid">
            <div class="category-card" data-category="t-shirt">
                <div class="category-bg">
                    <i class="fas fa-tshirt"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">Kaos</h3>
                    <p class="category-count">{{ collect($products)->where('Kategori', 'Kaos')->count() }} Produk</p>
                </div>
            </div>
            <div class="category-card" data-category="jaket">
                <div class="category-bg">
                    <i class="fas fa-vest"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">Jaket</h3>
                    <p class="category-count">{{ collect($products)->where('Kategori', 'Jaket')->count() }} Produk</p>
                </div>
            </div>
            <div class="category-card" data-category="sepatu">
                <div class="category-bg">
                    <i class="fas fa-shoe-prints"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">sepatu</h3>
                    <p class="category-count">{{ collect($products)->where('Kategori', 'Sepatu')->count() }} Produk</p>
                </div>
            </div>
            <div class="category-card" data-category="new">
                <div class="category-bg">
                    <i class="fas fa-star"></i>
                </div>
                <div class="category-content">
                    <h3 class="category-name">Gaya Baru</h3>
                    <p class="category-count">{{ collect($products)->where('badge', 'Baru')->count() }} Produk</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products" id="products">
        <div class="section-header">
            <p class="section-subtitle">Belanja Sekarang</p>
            <h2 class="section-title">Produk Unggulan</h2>
        </div>
        <div class="filter-tabs">
            <button class="filter-tab active" data-filter="all">Semua</button>
            <button class="filter-tab" data-filter="t-shirt">Kaos</button>
            <button class="filter-tab" data-filter="jaket">Jaket</button>
            <button class="filter-tab" data-filter="sepatu">Sepatu</button>
            <button class="filter-tab" data-filter="new">Baru</button>
        </div>
        <div class="products-grid" id="productsGrid">
            @foreach ($products as $product)
            {{dd()}}
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
                        <p class="product-category">{{ $product['Kategori'] }}</p>
                        <h3 class="product-name">{{ $product['Nama'] }}</h3>
                        @if ($product['brand'])
                            <p class="product-brand" style="font-size: 0.85rem; color: #888; margin-top: 0.25rem;">
                                {{ $product['brand'] }}</p>
                        @endif
                        <div class="product-price">
                            <span class="current-price">Rp {{ number_format($product['Harga'], 0, ',', '.') }}</span>
                            @if ($product['HargaAsli'])
                                <span class="original-price">Rp
                                    {{ number_format($product['HargaAsli'], 0, ',', '.') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

   
<!-- ================= NEWSLETTER ================= -->
<section class="newsletter">
    <h2 class="newsletter-title">Bergabung Dengan Kami</h2>
    <p class="newsletter-desc">
        Berlangganan untuk menerima penawaran eksklusif, akses awal ke koleksi baru,
        dan rekomendasi gaya yang dipersonalisasi.
    </p>

    <form class="newsletter-form" id="newsletterForm">
        <input
            type="email"
            name="email"
            class="newsletter-input"
            placeholder="Masukkan email Anda"
            required
        >
        <button type="submit" class="newsletter-btn">Langganan</button>
    </form>
</section>

<!-- ================= TOAST POPUP ================= -->
<div id="toast" class="toast">
    <strong id="toastTitle"></strong>
    <p id="toastMessage"></p>
</div>

<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const newsletterForm = document.getElementById("newsletterForm");
    const toast = document.getElementById("toast");
    const toastTitle = document.getElementById("toastTitle");
    const toastMessage = document.getElementById("toastMessage");

    function showToast(title, message) {
        toastTitle.innerText = title;
        toastMessage.innerText = message;
        toast.classList.add("show");

        setTimeout(() => {
            toast.classList.remove("show");
        }, 3000);
    }

    newsletterForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const emailInput = newsletterForm.querySelector('input[name="email"]');
        const email = emailInput.value.trim();

        if (!email) {
            showToast("Gagal ❌", "Email tidak boleh kosong");
            return;
        }

        showToast(
            "Berhasil 🎉",
            "Terima kasih telah berlangganan. Kami akan mengirimkan update terbaru ke email Anda."
        );

        newsletterForm.reset();
    });
});
</script>

<!-- ================= STYLE TOAST ================= -->
<style>
.toast {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: #1f2933;
    color: #fff;
    padding: 16px 20px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
    z-index: 9999;
    max-width: 320px;
}

.toast.show {
    opacity: 1;
    transform: translateY(0);
}

.toast strong {
    display: block;
    font-size: 1rem;
    margin-bottom: 4px;
}
</style>

@endsection