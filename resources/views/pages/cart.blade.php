@extends('layouts.app')

@section('content')
    <!-- Cart Container -->
    <div class="cart-container">
        <div class="cart-header">
            <p class="cart-subtitle">Your Selection</p>
            <h1 class="cart-title">Shopping Cart</h1>
        </div>

        <div id="cartContent">
            <!-- Cart will be populated by JavaScript -->
        </div>
    </div>

    <style>
        /* Cart Container */
        .cart-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 120px 50px 80px;
        }

        .cart-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .cart-subtitle {
            font-size: 0.8rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--rose);
            margin-bottom: 15px;
        }

        .cart-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 300;
        }

        /* Cart Layout */
        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 40px;
            align-items: start;
        }

        /* Cart Items */
        .cart-items {
            background: var(--bg-card);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        .cart-item {
            display: grid;
            grid-template-columns: 120px 1fr auto;
            gap: 25px;
            padding: 25px 0;
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .cart-item:first-child {
            padding-top: 0;
        }

        .cart-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .cart-item-image {
            width: 120px;
            height: 140px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--rose) 0%, #c48b7f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-image i {
            font-size: 2.5rem;
            color: white;
        }

        .cart-item-details {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cart-item-header {
            margin-bottom: 10px;
        }

        .cart-item-name {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 5px;
            color: var(--text-primary);
        }

        .cart-item-category {
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--rose);
        }

        .cart-item-meta {
            display: flex;
            gap: 20px;
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 15px;
        }

        .cart-item-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .cart-item-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 15px;
            background: var(--bg-primary);
            padding: 8px 15px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .quantity-btn {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: none;
            background: var(--rose);
            color: white;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .quantity-btn:hover {
            background: #c48b7f;
            transform: scale(1.1);
        }

        .quantity-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .quantity-value {
            min-width: 30px;
            text-align: center;
            font-weight: 500;
            color: var(--text-primary);
        }

        .remove-btn {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            transition: var(--transition);
            padding: 5px 10px;
            font-size: 0.85rem;
        }

        .remove-btn:hover {
            color: #dc2626;
        }

        .cart-item-price-section {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
        }

        .cart-item-price {
            font-size: 1.3rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .cart-item-original-price {
            font-size: 0.9rem;
            color: var(--text-secondary);
            text-decoration: line-through;
        }

        /* Cart Summary */
        .cart-summary {
            background: var(--bg-card);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 100px;
        }

        .summary-title {
            font-size: 1.5rem;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }

        .summary-row.total {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid var(--border-color);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .summary-label {
            color: var(--text-secondary);
        }

        .summary-value {
            font-weight: 500;
            color: var(--text-primary);
        }

        .summary-value.discount {
            color: var(--rose);
        }

        /* Promo Code */
        .promo-code {
            margin: 25px 0;
        }

        .promo-input-group {
            display: flex;
            gap: 10px;
        }

        .promo-input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--bg-primary);
            color: var(--text-primary);
            font-family: "Montserrat", sans-serif;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .promo-input:focus {
            outline: none;
            border-color: var(--rose);
        }

        .promo-btn {
            padding: 12px 20px;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-primary);
            font-family: "Montserrat", sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: var(--transition);
        }

        .promo-btn:hover {
            background: var(--rose);
            border-color: var(--rose);
            color: white;
        }

        /* Checkout Button */
        .checkout-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--rose) 0%, #c48b7f 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-family: "Montserrat", sans-serif;
            font-size: 0.9rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 20px;
        }

        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(214, 169, 157, 0.4);
        }

        .continue-shopping {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 15px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.85rem;
            transition: var(--transition);
        }

        .continue-shopping:hover {
            color: var(--rose);
        }

        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-cart-icon {
            font-size: 5rem;
            color: var(--rose);
            margin-bottom: 25px;
            opacity: 0.5;
        }

        .empty-cart-title {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .empty-cart-desc {
            color: var(--text-secondary);
            margin-bottom: 30px;
        }

        .shop-now-btn {
            display: inline-block;
            padding: 15px 40px;
            background: transparent;
            border: 1px solid var(--text-primary);
            color: var(--text-primary);
            font-family: "Montserrat", sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
            border-radius: 8px;
        }

        .shop-now-btn:hover {
            background: var(--rose);
            border-color: var(--rose);
            color: white;
        }

        .free-shipping-notice {
            background: linear-gradient(135deg, var(--sage) 0%, var(--teal) 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 25px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .cart-container {
                padding: 100px 20px 60px;
            }

            .cart-item {
                grid-template-columns: 90px 1fr;
                gap: 15px;
            }

            .cart-item-price-section {
                grid-column: 2;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                margin-top: 15px;
            }

            .cart-item-image {
                width: 90px;
                height: 110px;
            }

            .cart-items,
            .cart-summary {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .cart-item-actions {
                flex-direction: column;
                align-items: flex-start;
            }

            .promo-input-group {
                flex-direction: column;
            }

            .promo-btn {
                width: 100%;
            }
        }
    </style>

    <script>
        // Cart state
        let cartItems = [];
        let appliedPromo = null;

        const validPromoCodes = {
            'DISKON10': {
                discount: 10,
                label: '10% OFF'
            },
            'DISKON20': {
                discount: 20,
                label: '20% OFF'
            },
            'DISKON5': {
                discount: 5,
                label: '5% OFF'
            },
            'DISKON15': {
                discount: 15,
                label: '15% OFF'
            }
        };

        function formatRupiah(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        function loadCart() {
            try {
                const saved = localStorage.getItem('cart');
                if (saved) {
                    const cartData = JSON.parse(saved);

                    // Handle both old and new format
                    if (Array.isArray(cartData)) {
                        // Old format: direct array
                        cartItems = cartData.map(transformCartItem);
                    } else if (cartData.items) {
                        // New format: object with items and promo
                        cartItems = cartData.items.map(transformCartItem);
                        appliedPromo = cartData.promo || null;
                    } else {
                        cartItems = [];
                    }
                } else {
                    cartItems = [];
                }
            } catch (error) {
                console.error('Error loading cart:', error);
                cartItems = [];
            }
        }

        // Transform cart item to ensure consistent format
        function transformCartItem(item) {
            return {
                id: item.id || item.productId || Date.now(),
                name: item.name || item.productName || 'Unknown Product',
                category: item.category || 'Product',
                price: parseFloat(item.price) || 0,
                originalPrice: item.originalPrice ? parseFloat(item.originalPrice) : null,
                quantity: parseInt(item.quantity) || 1,
                size: item.size || item.variantSize || 'N/A',
                color: item.color || 'N/A',
                image: item.image || null
            };
        }

        function updateQuantity(itemId, change) {
            const item = cartItems.find(i => i.id === itemId);
            if (item) {
                item.quantity = Math.max(1, item.quantity + change);
                saveCart();
                renderCart();
                updateGlobalCartCount();
            }
        }

        function removeItem(itemId) {
            cartItems = cartItems.filter(i => i.id !== itemId);
            saveCart();
            renderCart();
            updateGlobalCartCount();
            showToast('Item removed from cart', 'info');
        }

        function saveCart() {
            const cartData = {
                items: cartItems,
                promo: appliedPromo
            };
            localStorage.setItem('cart', JSON.stringify(cartData));
        }

        function applyPromoCode() {
            const promoInput = document.querySelector('.promo-input');
            if (!promoInput) return;

            const code = promoInput.value.trim().toUpperCase();

            if (!code) {
                showToast('Please enter a promo code', 'error');
                return;
            }

            if (validPromoCodes[code]) {
                appliedPromo = {
                    code: code,
                    ...validPromoCodes[code]
                };
                showToast(`Promo code applied! ${validPromoCodes[code].label}`, 'success');
                saveCart();
                renderCart();
            } else {
                showToast('Invalid promo code', 'error');
            }
        }

        function removePromoCode() {
            appliedPromo = null;
            const promoInput = document.querySelector('.promo-input');
            if (promoInput) {
                promoInput.value = '';
            }
            showToast('Promo code removed', 'info');
            saveCart();
            renderCart();
        }

        function showToast(message, type = 'info') {
            let toastContainer = document.querySelector('.toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.className = 'toast-container';
                toastContainer.style.cssText =
                    'position: fixed; bottom: 30px; right: 30px; z-index: 3000; display: flex; flex-direction: column; gap: 10px;';
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            toast.className = `toast toast-${type} show`;

            const icons = {
                success: 'fa-check-circle',
                error: 'fa-exclamation-circle',
                info: 'fa-info-circle'
            };

            const colors = {
                success: '#4caf50',
                error: '#f44336',
                info: 'var(--teal)'
            };

            toast.innerHTML = `
                <div class="toast-icon" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: ${colors[type]}15; color: ${colors[type]};">
                    <i class="fas ${icons[type]}"></i>
                </div>
                <div class="toast-content" style="flex: 1;">
                    <div class="toast-message" style="font-size: 0.9rem;">${message}</div>
                </div>
            `;

            toast.style.cssText = `
                padding: 18px 25px;
                background: var(--bg-card);
                border-radius: 10px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
                display: flex;
                align-items: center;
                gap: 15px;
                max-width: 350px;
                transform: translateX(0);
                transition: var(--transition);
            `;

            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.style.transform = 'translateX(120%)';
                setTimeout(() => toast.remove(), 400);
            }, 3000);
        }

        function renderCart() {
            console.log(cartItems);
            const cartContent = document.getElementById('cartContent');

            if (cartItems.length === 0) {
                cartContent.innerHTML = `
                    <div class="empty-cart">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h2 class="empty-cart-title">Your Cart is Empty</h2>
                        <p class="empty-cart-desc">Looks like you haven't added anything to your cart yet.</p>
                        <a href="/" class="shop-now-btn">Start Shopping</a>
                    </div>
                `;
                return;
            }

            const subtotal = cartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const discount = cartItems.reduce((sum, item) => {
                if (item.originalPrice) {
                    return sum + ((item.originalPrice - item.price) * item.quantity);
                }
                return sum;
            }, 0);
            const shipping = subtotal > 500000 ? 0 : 25000;

            let promoDiscount = 0;
            if (appliedPromo) {
                promoDiscount = Math.floor((subtotal * appliedPromo.discount) / 100);
            }

            const total = subtotal + shipping - promoDiscount;

            const cartItemsHTML = cartItems.map(item => `
                <div class="cart-item">
                    <div class="cart-item-image">
                        ${item.image ? `<img src="${item.image}" alt="${item.name}" onerror="this.style.display='none'; this.parentElement.innerHTML='<i class=\\'fas fa-tshirt\\'></i>';">` : `<i class="fas fa-tshirt"></i>`}
                    </div>
                    <div class="cart-item-details">
                        <div class="cart-item-header">
                            <h3 class="cart-item-name">${item.name}</h3>
                            <p class="cart-item-category">${item.category}</p>
                        </div>
                        <div class="cart-item-meta">
                            <span><i class="fas fa-palette"></i> ${item.color}</span>
                            <span><i class="fas fa-ruler"></i> ${item.size}</span>
                        </div>
                        <div class="cart-item-actions">
                            <div class="quantity-control">
                                <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)" ${item.quantity <= 1 ? 'disabled' : ''}>
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="quantity-value">${item.quantity}</span>
                                <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <button class="remove-btn" onclick="removeItem(${item.id})">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                    <div class="cart-item-price-section">
                        <div>
                            <div class="cart-item-price">${formatRupiah(item.price * item.quantity)}</div>
                            ${item.originalPrice ? `<div class="cart-item-original-price">${formatRupiah(item.originalPrice * item.quantity)}</div>` : ''}
                        </div>
                    </div>
                </div>
            `).join('');

            cartContent.innerHTML = `
                <div class="cart-layout">
                    <div class="cart-items">
                        ${cartItemsHTML}
                    </div>
                    <div class="cart-summary">
                        <h2 class="summary-title">Order Summary</h2>
                        
                        ${subtotal < 500000 ? `
                                            <div class="free-shipping-notice">
                                                <i class="fas fa-truck"></i>
                                                Add ${formatRupiah(500000 - subtotal)} more for FREE shipping!
                                            </div>
                                        ` : `
                                            <div class="free-shipping-notice">
                                                <i class="fas fa-check-circle"></i>
                                                You qualify for FREE shipping!
                                            </div>
                                        `}
                        
                        <div class="summary-row">
                            <span class="summary-label">Subtotal</span>
                            <span class="summary-value">${formatRupiah(subtotal)}</span>
                        </div>
                        ${discount > 0 ? `
                                            <div class="summary-row">
                                                <span class="summary-label">Discount</span>
                                                <span class="summary-value discount">-${formatRupiah(discount)}</span>
                                            </div>
                                        ` : ''}
                        <div class="summary-row">
                            <span class="summary-label">Shipping</span>
                            <span class="summary-value">${shipping === 0 ? 'FREE' : formatRupiah(shipping)}</span>
                        </div>
                        ${appliedPromo ? `
                                            <div class="summary-row">
                                                <span class="summary-label">Promo (${appliedPromo.code})</span>
                                                <span class="summary-value discount">-${formatRupiah(promoDiscount)}</span>
                                            </div>
                                        ` : ''}
                        
                        <div class="promo-code">
                            ${appliedPromo ? `
                                                <div style="background: linear-gradient(135deg, var(--rose) 0%, #c48b7f 100%); color: white; padding: 15px; border-radius: 8px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">
                                                    <div>
                                                        <div style="font-weight: 600; margin-bottom: 3px;">
                                                            <i class="fas fa-tag"></i> ${appliedPromo.code}
                                                        </div>
                                                        <div style="font-size: 0.85rem; opacity: 0.9;">
                                                            ${appliedPromo.label} Applied
                                                        </div>
                                                    </div>
                                                    <button onclick="removePromoCode()" style="background: rgba(255,255,255,0.2); border: none; color: white; padding: 8px 12px; border-radius: 6px; cursor: pointer;">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            ` : `
                                                <div class="promo-input-group">
                                                    <input type="text" class="promo-input" placeholder="Enter promo code" onkeypress="if(event.key==='Enter') applyPromoCode()">
                                                    <button class="promo-btn" onclick="applyPromoCode()">Apply</button>
                                                </div>
                                                <div style="font-size: 0.75rem; color: var(--text-secondary); margin-top: 8px;">
                                                    <i class="fas fa-info-circle"></i> Try: DISKON10, DISKON15, DISKON20
                                                </div>
                                            `}
                        </div>
                        
                        <div class="summary-row total">
                            <span class="summary-label">Total</span>
                            <span class="summary-value">${formatRupiah(total)}</span>
                        </div>
                        
                        <button class="checkout-btn" onclick="checkout()">
                            <i class="fas fa-lock"></i> Proceed to Checkout
                        </button>
                        
                        <a href="/" class="continue-shopping">
                            <i class="fas fa-arrow-left"></i>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            `;
        }

        function checkout() {
            if (cartItems.length === 0) {
                showToast('Your cart is empty', 'error');
                return;
            }
            window.location.href = '/checkout';
        }

        function updateGlobalCartCount() {
            const cartCountEl = document.getElementById('cartCount');
            if (cartCountEl) {
                const count = cartItems.reduce((total, item) => total + item.quantity, 0);
                cartCountEl.textContent = count;
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadCart();
            renderCart();
            updateGlobalCartCount();
        });
    </script>
@endsection
