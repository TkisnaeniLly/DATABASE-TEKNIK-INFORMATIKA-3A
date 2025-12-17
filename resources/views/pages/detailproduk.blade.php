@extends('layouts.app')

@section('content')

<!-- Product Detail Section -->
<section class="product-detail">
    <div class="product-detail-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/">Home</a>
            <i class="fas fa-chevron-right"></i>
            <a href="/#products">Products</a>
            <i class="fas fa-chevron-right"></i>
            <span>Premium Silk Dress</span>
        </div>

        <!-- Product Main Content -->
        <div class="product-detail-grid">
            <!-- Product Images -->
            <div class="product-images">
                <div class="main-image-container">
                    <div class="product-badge">New</div>
                    <div class="main-image" id="mainImage">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <button class="wishlist-btn">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                <div class="thumbnail-images">
                    <div class="thumbnail active" data-index="0">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="thumbnail" data-index="1">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="thumbnail" data-index="2">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="thumbnail" data-index="3">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-detail-info">
                <div class="product-meta">
                    <span class="product-category">Women's Fashion</span>
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="rating-count">(4.5) 128 Reviews</span>
                    </div>
                </div>

                <h1 class="product-detail-title">Premium Silk Dress</h1>
                
                <div class="product-detail-price">
                    <span class="current-price">$299.00</span>
                    <span class="original-price">$399.00</span>
                    <span class="discount-badge">-25%</span>
                </div>

                <p class="product-description">
                    Embrace timeless elegance with our Premium Silk Dress. Crafted from the finest mulberry silk, 
                    this piece features a flowing silhouette that drapes beautifully on any body type. 
                    The minimalist design is accentuated by subtle details and impeccable tailoring, 
                    making it perfect for both sophisticated evening events and upscale daytime occasions.
                </p>

                <!-- Color Selection -->
                <div class="product-options">
                    <div class="option-group">
                        <label class="option-label">
                            Color: <span id="selectedColor">Rose</span>
                        </label>
                        <div class="color-options">
                            <button class="color-option active" data-color="Rose" style="background: var(--rose)"></button>
                            <button class="color-option" data-color="Sage" style="background: var(--sage)"></button>
                            <button class="color-option" data-color="Teal" style="background: var(--teal)"></button>
                            <button class="color-option" data-color="Cream" style="background: var(--cream)"></button>
                            <button class="color-option" data-color="Dark" style="background: var(--dark)"></button>
                        </div>
                    </div>

                    <!-- Size Selection -->
                    <div class="option-group">
                        <div class="option-header">
                            <label class="option-label">
                                Size: <span id="selectedSize">M</span>
                            </label>
                            <a href="#" class="size-guide">Size Guide</a>
                        </div>
                        <div class="size-options">
                            <button class="size-option" data-size="XS">XS</button>
                            <button class="size-option" data-size="S">S</button>
                            <button class="size-option active" data-size="M">M</button>
                            <button class="size-option" data-size="L">L</button>
                            <button class="size-option" data-size="XL">XL</button>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="option-group">
                        <label class="option-label">Quantity</label>
                        <div class="quantity-selector">
                            <button class="quantity-btn" id="decreaseQty">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="quantity-input" value="1" min="1" max="10" id="quantityInput">
                            <button class="quantity-btn" id="increaseQty">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="product-actions-group">
                    <button class="btn-primary add-to-cart-main">
                        <i class="fas fa-shopping-cart"></i>
                        Add to Cart
                    </button>
                    <button class="btn-secondary buy-now">
                        <i class="fas fa-bolt"></i>
                        Buy Now
                    </button>
                </div>

                <!-- Product Features -->
                <div class="product-features">
                    <div class="feature-item">
                        <i class="fas fa-truck"></i>
                        <div>
                            <strong>Free Shipping</strong>
                            <span>On orders over $100</span>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-undo"></i>
                        <div>
                            <strong>Easy Returns</strong>
                            <span>30-day return policy</span>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <div>
                            <strong>Secure Payment</strong>
                            <span>100% secure checkout</span>
                        </div>
                    </div>
                </div>

                <!-- Share Product -->
                <div class="product-share">
                    <span>Share:</span>
                    <div class="share-buttons">
                        <button class="share-btn"><i class="fab fa-facebook-f"></i></button>
                        <button class="share-btn"><i class="fab fa-instagram"></i></button>
                        <button class="share-btn"><i class="fab fa-whatsapp"></i></button>
                        <button class="share-btn"><i class="fab fa-tiktok"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="product-tabs">
            <div class="tab-buttons">
                <button class="tab-btn active" data-tab="description">Description</button>
                <button class="tab-btn" data-tab="details">Product Details</button>
                <button class="tab-btn" data-tab="reviews">Reviews (128)</button>
                <button class="tab-btn" data-tab="shipping">Shipping & Returns</button>
            </div>

            <div class="tab-content-container">
                <div class="tab-content active" id="description">
                    <h3>Product Description</h3>
                    <p>
                        Our Premium Silk Dress represents the pinnacle of luxury fashion. Each piece is meticulously 
                        crafted using 100% Grade-A mulberry silk, sourced from sustainable farms committed to ethical 
                        production practices. The fabric undergoes a proprietary finishing process that enhances its 
                        natural luster while maintaining breathability and comfort.
                    </p>
                    <p>
                        The design philosophy behind this dress centers on versatility and timelessness. Whether you're 
                        attending a gallery opening, enjoying a sophisticated dinner, or celebrating a special occasion, 
                        this dress adapts seamlessly to your needs. The flowing silhouette creates an effortlessly elegant 
                        look that flatters all body types.
                    </p>
                    <h4>Key Features:</h4>
                    <ul>
                        <li>100% Pure Mulberry Silk</li>
                        <li>Breathable and Temperature-Regulating</li>
                        <li>Hypoallergenic and Gentle on Skin</li>
                        <li>Naturally Moisture-Wicking</li>
                        <li>Timeless, Versatile Design</li>
                        <li>Sustainable Production Methods</li>
                    </ul>
                </div>

                <div class="tab-content" id="details">
                    <h3>Product Details</h3>
                    <div class="details-grid">
                        <div class="detail-item">
                            <strong>Material:</strong>
                            <span>100% Mulberry Silk</span>
                        </div>
                        <div class="detail-item">
                            <strong>Care Instructions:</strong>
                            <span>Dry clean only</span>
                        </div>
                        <div class="detail-item">
                            <strong>Origin:</strong>
                            <span>Made in Italy</span>
                        </div>
                        <div class="detail-item">
                            <strong>Fit:</strong>
                            <span>Regular fit, flows naturally</span>
                        </div>
                        <div class="detail-item">
                            <strong>Length:</strong>
                            <span>Midi length (Size M: 48")</span>
                        </div>
                        <div class="detail-item">
                            <strong>Closure:</strong>
                            <span>Hidden back zipper</span>
                        </div>
                        <div class="detail-item">
                            <strong>Lining:</strong>
                            <span>Fully lined with silk</span>
                        </div>
                        <div class="detail-item">
                            <strong>Model Info:</strong>
                            <span>Model is 5'9" wearing size S</span>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="reviews">
                    <div class="reviews-summary">
                        <div class="rating-overview">
                            <div class="rating-score">4.5</div>
                            <div class="rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p>Based on 128 reviews</p>
                        </div>
                        <div class="rating-bars">
                            <div class="rating-bar-item">
                                <span>5 <i class="fas fa-star"></i></span>
                                <div class="rating-bar">
                                    <div class="rating-bar-fill" style="width: 75%"></div>
                                </div>
                                <span>96</span>
                            </div>
                            <div class="rating-bar-item">
                                <span>4 <i class="fas fa-star"></i></span>
                                <div class="rating-bar">
                                    <div class="rating-bar-fill" style="width: 15%"></div>
                                </div>
                                <span>19</span>
                            </div>
                            <div class="rating-bar-item">
                                <span>3 <i class="fas fa-star"></i></span>
                                <div class="rating-bar">
                                    <div class="rating-bar-fill" style="width: 6%"></div>
                                </div>
                                <span>8</span>
                            </div>
                            <div class="rating-bar-item">
                                <span>2 <i class="fas fa-star"></i></span>
                                <div class="rating-bar">
                                    <div class="rating-bar-fill" style="width: 3%"></div>
                                </div>
                                <span>4</span>
                            </div>
                            <div class="rating-bar-item">
                                <span>1 <i class="fas fa-star"></i></span>
                                <div class="rating-bar">
                                    <div class="rating-bar-fill" style="width: 1%"></div>
                                </div>
                                <span>1</span>
                            </div>
                        </div>
                    </div>

                    <div class="reviews-list">
                        <div class="review-item">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <div class="reviewer-avatar">S</div>
                                    <div>
                                        <strong>Sarah Mitchell</strong>
                                        <div class="review-stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="review-date">2 weeks ago</span>
                            </div>
                            <p class="review-text">
                                Absolutely stunning dress! The silk quality is exceptional and the fit is perfect. 
                                I wore it to a wedding and received so many compliments. Worth every penny!
                            </p>
                            <div class="review-helpful">
                                <span>Helpful?</span>
                                <button><i class="far fa-thumbs-up"></i> 24</button>
                                <button><i class="far fa-thumbs-down"></i> 2</button>
                            </div>
                        </div>

                        <div class="review-item">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <div class="reviewer-avatar">E</div>
                                    <div>
                                        <strong>Emily Carter</strong>
                                        <div class="review-stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="review-date">1 month ago</span>
                            </div>
                            <p class="review-text">
                                Love the elegant design and luxurious feel. The dress flows beautifully and the 
                                color is even more gorgeous in person. Highly recommend!
                            </p>
                            <div class="review-helpful">
                                <span>Helpful?</span>
                                <button><i class="far fa-thumbs-up"></i> 18</button>
                                <button><i class="far fa-thumbs-down"></i> 1</button>
                            </div>
                        </div>
                    </div>

                    <button class="btn-secondary load-more-reviews">Load More Reviews</button>
                </div>

                <div class="tab-content" id="shipping">
                    <h3>Shipping Information</h3>
                    <p>
                        We offer free standard shipping on all orders over $100. Orders are typically processed 
                        within 1-2 business days and delivered within 5-7 business days for domestic orders.
                    </p>
                    <ul>
                        <li><strong>Standard Shipping:</strong> Free on orders $100+ (5-7 business days)</li>
                        <li><strong>Express Shipping:</strong> $15 (2-3 business days)</li>
                        <li><strong>Next Day Delivery:</strong> $25 (Order before 2 PM)</li>
                        <li><strong>International Shipping:</strong> Calculated at checkout (7-14 business days)</li>
                    </ul>

                    <h3>Returns & Exchanges</h3>
                    <p>
                        We want you to be completely satisfied with your purchase. If for any reason you're not 
                        happy, you can return unworn items within 30 days of delivery for a full refund.
                    </p>
                    <ul>
                        <li>Items must be unworn, unwashed, and in original condition</li>
                        <li>All original tags must be attached</li>
                        <li>Items must be returned in original packaging</li>
                        <li>Return shipping is free for exchanges</li>
                        <li>Refunds are processed within 5-7 business days</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="related-products">
            <h2 class="section-title">You May Also Like</h2>
            <div class="related-products-grid">
                <div class="product-card">
                    <div class="product-image" style="background: linear-gradient(135deg, var(--teal) 0%, #7a9994 100%);">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <div class="product-info">
                        <p class="product-category">Women</p>
                        <h3 class="product-name">Cashmere Sweater</h3>
                        <div class="product-price">
                            <span class="current-price">$189.00</span>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image" style="background: linear-gradient(135deg, var(--sage) 0%, #b8bda9 100%);">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="product-info">
                        <p class="product-category">Accessories</p>
                        <h3 class="product-name">Leather Handbag</h3>
                        <div class="product-price">
                            <span class="current-price">$249.00</span>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image" style="background: linear-gradient(135deg, var(--rose) 0%, #c48b7f 100%);">
                        <i class="fas fa-shoe-prints"></i>
                    </div>
                    <div class="product-info">
                        <p class="product-category">Women</p>
                        <h3 class="product-name">Classic Heels</h3>
                        <div class="product-price">
                            <span class="current-price">$159.00</span>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image" style="background: linear-gradient(135deg, #c9a962 0%, #a8894d 100%);">
                        <i class="fas fa-gem"></i>
                    </div>
                    <div class="product-info">
                        <p class="product-category">Accessories</p>
                        <h3 class="product-name">Gold Necklace</h3>
                        <div class="product-price">
                            <span class="current-price">$129.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Product Detail Styles */
.product-detail {
    padding: 120px 50px 100px;
    min-height: 100vh;
}

.product-detail-container {
    max-width: 1400px;
    margin: 0 auto;
}

/* Breadcrumb */
.breadcrumb {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 40px;
    font-size: 0.85rem;
}

.breadcrumb a {
    color: var(--text-secondary);
    text-decoration: none;
    transition: var(--transition);
}

.breadcrumb a:hover {
    color: var(--rose);
}

.breadcrumb i {
    font-size: 0.7rem;
    color: var(--text-secondary);
}

.breadcrumb span {
    color: var(--text-primary);
    font-weight: 500;
}

/* Product Detail Grid */
.product-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    margin-bottom: 80px;
}

/* Product Images */
.product-images {
    position: sticky;
    top: 120px;
    height: fit-content;
}

.main-image-container {
    position: relative;
    margin-bottom: 20px;
}

.main-image {
    height: 600px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--rose) 0%, #c48b7f 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 8rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.wishlist-btn {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--bg-card);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    font-size: 1.3rem;
    color: var(--text-primary);
    z-index: 10;
}

.wishlist-btn:hover,
.wishlist-btn.active {
    background: var(--rose);
    color: white;
    transform: scale(1.1);
}

.thumbnail-images {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
}

.thumbnail {
    height: 120px;
    border-radius: 8px;
    background: linear-gradient(135deg, var(--teal) 0%, #7a9994 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    cursor: pointer;
    transition: var(--transition);
    border: 3px solid transparent;
}

.thumbnail:hover,
.thumbnail.active {
    border-color: var(--rose);
    transform: translateY(-3px);
}

/* Product Info */
.product-detail-info {
    padding: 20px 0;
}

.product-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 8px;
}

.product-rating i {
    color: var(--gold);
    font-size: 0.9rem;
}

.rating-count {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin-left: 5px;
}

.product-detail-title {
    font-size: 2.5rem;
    margin-bottom: 20px;
    font-weight: 300;
}

.product-detail-price {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

.product-detail-price .current-price {
    font-size: 2rem;
    font-weight: 500;
    color: var(--rose);
}

.product-detail-price .original-price {
    font-size: 1.3rem;
    color: var(--text-secondary);
    text-decoration: line-through;
}

.discount-badge {
    padding: 6px 12px;
    background: var(--rose);
    color: white;
    font-size: 0.85rem;
    border-radius: 5px;
    font-weight: 500;
}

.product-description {
    color: var(--text-secondary);
    line-height: 1.8;
    margin-bottom: 30px;
    font-size: 0.95rem;
}

/* Product Options */
.product-options {
    margin-bottom: 30px;
}

.option-group {
    margin-bottom: 25px;
}

.option-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.option-label {
    font-size: 0.85rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-primary);
    font-weight: 500;
    margin-bottom: 12px;
    display: block;
}

.option-label span {
    color: var(--rose);
}

.size-guide {
    font-size: 0.85rem;
    color: var(--rose);
    text-decoration: none;
    transition: var(--transition);
}

.size-guide:hover {
    text-decoration: underline;
}

/* Color Options */
.color-options {
    display: flex;
    gap: 12px;
}

.color-option {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    border: 3px solid transparent;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
}

.color-option::after {
    content: '';
    position: absolute;
    inset: -6px;
    border: 2px solid var(--rose);
    border-radius: 50%;
    opacity: 0;
    transition: var(--transition);
}

.color-option.active::after,
.color-option:hover::after {
    opacity: 1;
}

/* Size Options */
.size-options {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.size-option {
    min-width: 55px;
    padding: 12px 18px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    background: var(--bg-primary);
    color: var(--text-primary);
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
}

.size-option:hover {
    border-color: var(--rose);
}

.size-option.active {
    border-color: var(--rose);
    background: var(--rose);
    color: white;
}

/* Quantity Selector */
.quantity-selector {
    display: flex;
    align-items: center;
    gap: 15px;
    width: fit-content;
}

.quantity-btn {
    width: 40px;
    height: 40px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    background: var(--bg-primary);
    color: var(--text-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
}

.quantity-btn:hover {
    border-color: var(--rose);
    color: var(--rose);
}

.quantity-input {
    width: 70px;
    height: 40px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    background: var(--bg-primary);
    color: var(--text-primary);
    text-align: center;
    font-size: 1rem;
    font-weight: 500;
}

.quantity-input:focus {
    outline: none;
    border-color: var(--rose);
}

/* Action Buttons */
.product-actions-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 30px;
}

.btn-primary,
.btn-secondary {
    padding: 18px 30px;
    border-radius: 8px;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.9rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-weight: 500;
}

.btn-primary {
    background: var(--rose);
    border: 2px solid var(--rose);
    color: white;
}

.btn-primary:hover {
    background: transparent;
    color: var(--rose);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(214, 169, 157, 0.3);
}

.btn-secondary {
    background: transparent;
    border: 2px solid var(--border-color);
    color: var(--text-primary);
}

.btn-secondary:hover {
    border-color: var(--rose);
    color: var(--rose);
    transform: translateY(-3px);
}

/* Product Features */
.product-features {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 25px;
    background: var(--bg-secondary);
    border-radius: 10px;
    margin-bottom: 30px;
}

.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.feature-item i {
    font-size: 1.5rem;
    color: var(--rose);
    margin-top: 5px;
}

.feature-item div {
    flex: 1;
}

.feature-item strong {
    display: block;
    font-size: 0.9rem;
    margin-bottom: 3px;
}

.feature-item span {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

/* Product Share */
.product-share {
    display: flex;
    align-items: center;
    gap: 15px;
    padding-top: 25px;
    border-top: 1px solid var(--border-color);
}

.product-share span {
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-secondary);
}

.share-buttons {
    display: flex;
    gap: 10px;
}

.share-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid var(--border-color);
    background: var(--bg-primary);
    color: var(--text-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
}

.share-btn:hover {
    border-color: var(--rose);
    background: var(--rose);
    color: white;
}

/* Product Tabs */
.product-tabs {
    margin-bottom: 80px;
}

.tab-buttons {
    display: flex;
    gap: 10px;
    border-bottom: 1px solid var(--border-color);
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.tab-btn {
    padding: 15px 30px;
    background: none;
    border: none;
    font-family: 'Montserrat', sans-serif;
    font-size: 0.9rem;
    letter-spacing: 0.05em;
    color: var(--text-secondary);
    cursor: pointer;
    transition: var(--transition);
    position: relative;
}

.tab-btn::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--rose);
    transform: scaleX(0);
    transition: var(--transition);
}

.tab-btn.active,
.tab-btn:hover {
    color: var(--rose);
}

.tab-btn.active::after {
    transform: scaleX(1);
}

.tab-content {
    display: none;
    animation: fadeIn 0.5s ease;
}

.tab-content.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.tab-content h3 {
    font-size: 1.8rem;
    margin-bottom: 20px;
}

.tab-content h4 {
    font-size: 1.3rem;
    margin: 25px 0 15px;
}

.tab-content p {
    color: var(--text-secondary);
    line-height: 1.8;
    margin-bottom: 20px;
}

.tab-content ul {
    list-style: none;
    padding-left: 0;
}

.tab-content ul li {
    color: var(--text-secondary);
    padding: 8px 0;
    padding-left: 30px;
    position: relative;
}

.tab-content ul li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--rose);
    font-weight: bold;
}

/* Details Grid */
.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.detail-item {
    padding: 20px;
    background: var(--bg-secondary);
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.detail-item strong {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--text-primary);
}

.detail-item span {
    color: var(--text-secondary);
}

/* Reviews */
.reviews-summary {
    display: grid;
    grid-template-columns: 250px 1fr;
    gap: 50px;
    padding: 30px;
    background: var(--bg-secondary);
    border-radius: 15px;
    margin-bottom: 40px;
}

.rating-overview {
    text-align: center;
}

.rating-score {
    font-size: 4rem;
    font-weight: 300;
    color: var(--rose);
    margin-bottom: 15px;
}

.rating-overview .rating-stars {
    margin-bottom: 15px;
}

.rating-overview .rating-stars i {
    font-size: 1.2rem;
    color: var(--gold);
}

.rating-overview p {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.rating-bars {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.rating-bar-item {
    display: flex;
    align-items: center;
    gap: 15px;
}

.rating-bar-item > span:first-child {
    width: 50px;
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.rating-bar-item i {
    font-size: 0.7rem;
    color: var(--gold);
}

.rating-bar {
    flex: 1;
    height: 8px;
    background: var(--bg-primary);
    border-radius: 10px;
    overflow: hidden;
}

.rating-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--rose), #c48b7f);
    transition: width 0.5s ease;
}

.rating-bar-item > span:last-child {
    width: 40px;
    text-align: right;
    font-size: 0.9rem;
    color: var(--text-secondary);
}

/* Reviews List */
.reviews-list {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin-bottom: 30px;
}

.review-item {
    padding: 30px;
    background: var(--bg-secondary);
    border-radius: 15px;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
    flex-wrap: wrap;
    gap: 15px;
}

.reviewer-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.reviewer-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--rose);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 500;
}

.reviewer-info strong {
    display: block;
    margin-bottom: 5px;
}

.review-stars {
    display: flex;
    gap: 3px;
}

.review-stars i {
    font-size: 0.85rem;
    color: var(--gold);
}

.review-date {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.review-text {
    color: var(--text-secondary);
    line-height: 1.8;
    margin-bottom: 15px;
}

.review-helpful {
    display: flex;
    align-items: center;
    gap: 15px;
}

.review-helpful span {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.review-helpful button {
    padding: 8px 15px;
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: 6px;
    color: var(--text-primary);
    font-size: 0.85rem;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 8px;
}

.review-helpful button:hover {
    border-color: var(--rose);
    color: var(--rose);
}

.load-more-reviews {
    width: fit-content;
    margin: 0 auto;
}

/* Related Products */
.related-products {
    margin-top: 80px;
}

.related-products .section-title {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 40px;
}

.related-products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

/* Responsive */
@media (max-width: 1024px) {
    .product-detail {
        padding: 100px 30px 80px;
    }

    .product-detail-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .product-images {
        position: static;
    }

    .reviews-summary {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .product-features {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .product-detail {
        padding: 90px 20px 60px;
    }

    .main-image {
        height: 450px;
        font-size: 6rem;
    }

    .thumbnail-images {
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .thumbnail {
        height: 80px;
        font-size: 1.5rem;
    }

    .product-detail-title {
        font-size: 2rem;
    }

    .product-detail-price .current-price {
        font-size: 1.5rem;
    }

    .product-actions-group {
        grid-template-columns: 1fr;
    }

    .tab-buttons {
        gap: 5px;
    }

    .tab-btn {
        padding: 12px 20px;
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .breadcrumb {
        font-size: 0.75rem;
        gap: 8px;
    }

    .main-image {
        height: 350px;
        font-size: 4rem;
    }

    .thumbnail-images {
        grid-template-columns: repeat(3, 1fr);
    }

    .product-detail-title {
        font-size: 1.6rem;
    }

    .color-options {
        gap: 8px;
    }

    .color-option {
        width: 38px;
        height: 38px;
    }

    .tab-btn {
        padding: 10px 15px;
        font-size: 0.75rem;
    }

    .review-item {
        padding: 20px;
    }
}
</style>

<script>
// Thumbnail image selector
document.querySelectorAll('.thumbnail').forEach(thumb => {
    thumb.addEventListener('click', function() {
        document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
    });
});

// Wishlist toggle
document.querySelector('.wishlist-btn').addEventListener('click', function() {
    this.classList.toggle('active');
    const icon = this.querySelector('i');
    if (this.classList.contains('active')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
    }
});

// Color selector
document.querySelectorAll('.color-option').forEach(option => {
    option.addEventListener('click', function() {
        document.querySelectorAll('.color-option').forEach(o => o.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('selectedColor').textContent = this.dataset.color;
    });
});

// Size selector
document.querySelectorAll('.size-option').forEach(option => {
    option.addEventListener('click', function() {
        document.querySelectorAll('.size-option').forEach(o => o.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('selectedSize').textContent = this.dataset.size;
    });
});

// Quantity selector
const decreaseBtn = document.getElementById('decreaseQty');
const increaseBtn = document.getElementById('increaseQty');
const quantityInput = document.getElementById('quantityInput');

decreaseBtn.addEventListener('click', () => {
    const currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
});

increaseBtn.addEventListener('click', () => {
    const currentValue = parseInt(quantityInput.value);
    if (currentValue < 10) {
        quantityInput.value = currentValue + 1;
    }
});

// Tab switching
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const targetTab = this.dataset.tab;
        
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        
        this.classList.add('active');
        document.getElementById(targetTab).classList.add('active');
    });
});

// Add to cart
document.querySelector('.add-to-cart-main').addEventListener('click', function() {
    const quantity = quantityInput.value;
    const size = document.getElementById('selectedSize').textContent;
    const color = document.getElementById('selectedColor').textContent;
    
    console.log(`Added to cart: ${quantity}x Premium Silk Dress (${size}, ${color})`);
    alert('Product added to cart!');
});

// Buy now
document.querySelector('.buy-now').addEventListener('click', function() {
    alert('Proceeding to checkout...');
});
</script>

@endsection