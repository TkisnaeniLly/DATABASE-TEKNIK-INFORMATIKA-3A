@extends('layouts.app')

@section('content')
    <!-- Checkout Container -->
    <div class="checkout-container">
        <div class="checkout-header">
            <p class="checkout-subtitle">Complete Your Order</p>
            <h1 class="checkout-title">Checkout</h1>
        </div>

        <!-- Progress Steps -->
        <div class="checkout-steps">
            <div class="step active" data-step="1">
                <div class="step-number">1</div>
                <div class="step-label">Shipping</div>
            </div>
            <div class="step-line"></div>
            <div class="step" data-step="2">
                <div class="step-number">2</div>
                <div class="step-label">Payment</div>
            </div>
            <div class="step-line"></div>
            <div class="step" data-step="3">
                <div class="step-number">3</div>
                <div class="step-label">Review</div>
            </div>
        </div>

        <div class="checkout-layout">
            <!-- Left Column - Forms -->
            <div class="checkout-forms">
                <!-- STEP 1: Shipping Information -->
                <div class="checkout-step-content" id="step1" style="display: block;">
                    <div class="checkout-section">
                        <h2 class="section-title">
                            <i class="fas fa-shipping-fast"></i>
                            Shipping Information
                        </h2>

                        <!-- Saved Addresses -->
                        <div id="savedAddressesContainer" style="display: none;">
                            <div style="margin-bottom: 20px;">
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                    <h3 class="subsection-title" style="margin: 0;">
                                        <i class="fas fa-map-marked-alt"></i>
                                        Pilih Alamat Pengiriman
                                    </h3>
                                    <button class="add-address-btn" onclick="showNewAddressForm()">
                                        <i class="fas fa-plus"></i>
                                        Tambah Alamat Baru
                                    </button>
                                </div>
                                <div id="savedAddressesList" class="saved-addresses-list">
                                    <!-- Saved addresses will be populated here -->
                                </div>
                            </div>
                        </div>

                        <!-- New Address Form -->
                        <div id="newAddressFormContainer">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;"
                                id="formHeader">
                                <h3 class="subsection-title" style="margin: 0;">
                                    <i class="fas fa-plus-circle"></i>
                                    Alamat Baru
                                </h3>
                                <button class="cancel-new-address-btn" onclick="cancelNewAddress()" style="display: none;">
                                    <i class="fas fa-times"></i>
                                    Batal
                                </button>
                            </div>

                            <form id="shippingForm">
                                <!-- Address Label -->
                                <div class="form-group">
                                    <label class="form-label">Label Alamat *</label>
                                    <select class="form-input" id="addressLabel" required>
                                        <option value="">Pilih label alamat</option>
                                        <option value="home">🏠 Rumah Pribadi/Kontrakan</option>
                                        <option value="parents">👨‍👩‍👧‍👦 Rumah Orang Tua</option>
                                        <option value="office">🏢 Tempat Kerja</option>
                                        <option value="school">🎓 Sekolah/Kampus</option>
                                        <option value="other">📍 Lainnya</option>
                                    </select>
                                </div>

                                <!-- Custom Label (if Other selected) -->
                                <div class="form-group" id="customLabelGroup" style="display: none;">
                                    <label class="form-label">Nama Label *</label>
                                    <input type="text" class="form-input" id="customLabel"
                                        placeholder="Contoh: Rumah Nenek, Kos">
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Nama Depan *</label>
                                        <input type="text" class="form-input" id="firstName" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nama Belakang *</label>
                                        <input type="text" class="form-input" id="lastName" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-input" id="email" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nomor Telepon *</label>
                                    <input type="tel" class="form-input" id="phone" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alamat Lengkap *</label>
                                    <textarea class="form-input" id="address" rows="3" required placeholder="Nama jalan, nomor rumah, RT/RW"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Kota/Kabupaten *</label>
                                        <input type="text" class="form-input" id="city" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kode Pos *</label>
                                        <input type="text" class="form-input" id="postalCode" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Provinsi *</label>
                                    <select class="form-input" id="province" required>
                                        <option value="">Pilih Provinsi</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Sumatera Utara">Sumatera Utara</option>
                                    </select>
                                </div>

                                <!-- Save Address Checkbox -->
                                <div class="save-address-checkbox">
                                    <label>
                                        <input type="checkbox" id="saveAddress" checked>
                                        <span>Simpan alamat ini untuk pemesanan selanjutnya</span>
                                    </label>
                                </div>
                            </form>
                        </div>

                        <!-- Shipping Method -->
                        <div style="margin-top: 30px;">
                            <h3 class="subsection-title">
                                <i class="fas fa-truck"></i>
                                Metode Pengiriman
                            </h3>
                            <div class="shipping-methods">
                                <label class="shipping-option">
                                    <input type="radio" name="shipping" value="regular" data-cost="25000" checked>
                                    <div class="shipping-option-content">
                                        <div class="shipping-option-header">
                                            <div class="shipping-name">Regular Shipping</div>
                                            <div class="shipping-price">Rp 25,000</div>
                                        </div>
                                        <div class="shipping-desc">Estimasi pengiriman: 5-7 hari kerja</div>
                                    </div>
                                </label>
                                <label class="shipping-option">
                                    <input type="radio" name="shipping" value="express" data-cost="50000">
                                    <div class="shipping-option-content">
                                        <div class="shipping-option-header">
                                            <div class="shipping-name">Express Shipping</div>
                                            <div class="shipping-price">Rp 50,000</div>
                                        </div>
                                        <div class="shipping-desc">Estimasi pengiriman: 2-3 hari kerja</div>
                                    </div>
                                </label>
                                <label class="shipping-option">
                                    <input type="radio" name="shipping" value="oneday" data-cost="100000">
                                    <div class="shipping-option-content">
                                        <div class="shipping-option-header">
                                            <div class="shipping-name">Same Day Delivery</div>
                                            <div class="shipping-price">Rp 100,000</div>
                                        </div>
                                        <div class="shipping-desc">Pesan sebelum jam 12 siang untuk pengiriman hari ini
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="step-navigation">
                        <button class="btn-next" onclick="nextStep(1)">
                            Lanjut ke Pembayaran
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: Payment Method -->
                <div class="checkout-step-content" id="step2" style="display: none;">
                    <div class="checkout-section">
                        <h2 class="section-title">
                            <i class="fas fa-credit-card"></i>
                            Metode Pembayaran
                        </h2>
                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="payment" value="credit" checked>
                                <div class="payment-option-content">
                                    <i class="fas fa-credit-card"></i>
                                    <span>Kartu Kredit/Debit</span>
                                </div>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment" value="bank">
                                <div class="payment-option-content">
                                    <i class="fas fa-university"></i>
                                    <span>Transfer Bank</span>
                                </div>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment" value="ewallet">
                                <div class="payment-option-content">
                                    <i class="fas fa-wallet"></i>
                                    <span>E-Wallet</span>
                                </div>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment" value="cod">
                                <div class="payment-option-content">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span>Bayar di Tempat</span>
                                </div>
                            </label>
                        </div>

                        <!-- Payment Details (shown conditionally) -->
                        <div id="creditCardForm" class="payment-details" style="margin-top: 30px;">
                            <h3 class="subsection-title">Detail Kartu</h3>
                            <div class="form-group">
                                <label class="form-label">Nomor Kartu *</label>
                                <input type="text" class="form-input" id="cardNumber"
                                    placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Kadaluarsa *</label>
                                    <input type="text" class="form-input" id="expiryDate" placeholder="MM/YY"
                                        maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">CVV *</label>
                                    <input type="text" class="form-input" id="cvv" placeholder="123"
                                        maxlength="3">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Pemegang Kartu *</label>
                                <input type="text" class="form-input" id="cardholderName"
                                    placeholder="Nama di kartu">
                            </div>
                        </div>

                        <div id="bankTransferInfo" class="payment-details" style="display: none; margin-top: 30px;">
                            <div class="info-box">
                                <i class="fas fa-info-circle"></i>
                                <div>
                                    <p><strong>Instruksi Transfer Bank:</strong></p>
                                    <p>Setelah melakukan pemesanan, Anda akan menerima detail rekening bank via email. Harap
                                        selesaikan pembayaran dalam 24 jam.</p>
                                </div>
                            </div>
                        </div>

                        <div id="ewalletInfo" class="payment-details" style="display: none; margin-top: 30px;">
                            <div class="form-group">
                                <label class="form-label">Pilih Provider E-Wallet *</label>
                                <select class="form-input" id="ewalletProvider">
                                    <option value="">Pilih Provider</option>
                                    <option value="gopay">GoPay</option>
                                    <option value="ovo">OVO</option>
                                    <option value="dana">DANA</option>
                                    <option value="shopeepay">ShopeePay</option>
                                </select>
                            </div>
                        </div>

                        <div id="codInfo" class="payment-details" style="display: none; margin-top: 30px;">
                            <div class="info-box">
                                <i class="fas fa-info-circle"></i>
                                <div>
                                    <p><strong>Bayar di Tempat (COD):</strong></p>
                                    <p>Bayar dengan uang tunai saat pesanan diantar. Biaya tambahan Rp 5,000.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step-navigation">
                        <button class="btn-back" onclick="prevStep(2)">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Pengiriman
                        </button>
                        <button class="btn-next" onclick="nextStep(2)">
                            Review Pesanan
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: Review Order -->
                <div class="checkout-step-content" id="step3" style="display: none;">
                    <div class="checkout-section">
                        <h2 class="section-title">
                            <i class="fas fa-clipboard-check"></i>
                            Review Pesanan
                        </h2>

                        <!-- Shipping Info Summary -->
                        <div class="review-section">
                            <div class="review-header">
                                <h3>Informasi Pengiriman</h3>
                                <button class="edit-btn" onclick="goToStep(1)">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </div>
                            <div class="review-content" id="reviewShipping">
                                <!-- Will be populated by JS -->
                            </div>
                        </div>

                        <!-- Payment Info Summary -->
                        <div class="review-section">
                            <div class="review-header">
                                <h3>Metode Pembayaran</h3>
                                <button class="edit-btn" onclick="goToStep(2)">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </div>
                            <div class="review-content" id="reviewPayment">
                                <!-- Will be populated by JS -->
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="review-section">
                            <div class="review-header">
                                <h3>Item Pesanan</h3>
                            </div>
                            <div class="review-items" id="reviewItems">
                                <!-- Will be populated by JS -->
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="terms-checkbox">
                            <label>
                                <input type="checkbox" id="agreeTerms" required>
                                <span>Saya menyetujui <a href="#" class="terms-link">Syarat dan Ketentuan</a> serta
                                    <a href="#" class="terms-link">Kebijakan Privasi</a></span>
                            </label>
                        </div>
                    </div>

                    <div class="step-navigation">
                        <button class="btn-back" onclick="prevStep(3)">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Pembayaran
                        </button>
                        <button class="btn-next btn-place-order" onclick="placeOrder()">
                            <i class="fas fa-lock"></i>
                            Buat Pesanan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="checkout-sidebar">
                <div class="order-summary">
                    <h2 class="summary-title">Ringkasan Pesanan</h2>
                    <div id="orderItems" class="order-items">
                        <!-- Items will be populated by JavaScript -->
                    </div>

                    <div class="summary-details">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="summarySubtotal">Rp 0</span>
                        </div>
                        <div class="summary-row">
                            <span>Pengiriman</span>
                            <span id="summaryShipping">Rp 25,000</span>
                        </div>
                        <div class="summary-row" id="promoRow" style="display: none;">
                            <span>Diskon Promo</span>
                            <span class="text-rose" id="summaryPromo">Rp 0</span>
                        </div>
                        <div class="summary-row" id="codFeeRow" style="display: none;">
                            <span>Biaya COD</span>
                            <span id="summaryCodFee">Rp 5,000</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="summaryTotal">Rp 0</span>
                        </div>
                    </div>

                    <div class="security-badges">
                        <i class="fas fa-shield-alt"></i>
                        <span>Checkout Aman</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>

    <style>
        .checkout-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 120px 50px 80px;
        }

        .checkout-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .checkout-subtitle {
            font-size: 0.8rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--rose);
            margin-bottom: 15px;
        }

        .checkout-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 300;
        }

        /* Progress Steps */
        .checkout-steps {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 60px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--bg-card);
            border: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--text-secondary);
            transition: var(--transition);
        }

        .step.active .step-number {
            background: var(--rose);
            border-color: var(--rose);
            color: white;
        }

        .step.completed .step-number {
            background: var(--teal);
            border-color: var(--teal);
            color: white;
        }

        .step.completed .step-number::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        .step.completed .step-number {
            font-size: 0;
        }

        .step-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            transition: var(--transition);
        }

        .step.active .step-label {
            color: var(--rose);
            font-weight: 500;
        }

        .step.completed .step-label {
            color: var(--teal);
        }

        .step-line {
            flex: 1;
            height: 2px;
            background: var(--border-color);
            margin: 0 20px;
            max-width: 100px;
            transition: var(--transition);
        }

        .step.completed~.step-line {
            background: var(--teal);
        }

        /* Checkout Layout */
        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 450px;
            gap: 40px;
            align-items: start;
        }

        .checkout-forms {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .checkout-step-content {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .checkout-section {
            background: var(--bg-card);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 1.3rem;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-primary);
        }

        .section-title i {
            color: var(--rose);
        }

        .subsection-title {
            font-size: 1.1rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-primary);
        }

        .subsection-title i {
            color: var(--rose);
            font-size: 0.9rem;
        }

        /* Saved Addresses */
        .add-address-btn,
        .cancel-new-address-btn {
            padding: 8px 16px;
            background: var(--rose);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-address-btn:hover {
            background: #c48b7f;
            transform: translateY(-2px);
        }

        .cancel-new-address-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .cancel-new-address-btn:hover {
            border-color: var(--rose);
            color: var(--rose);
        }

        .saved-addresses-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .address-card {
            padding: 20px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .address-card:hover {
            border-color: var(--rose);
            background: rgba(214, 169, 157, 0.05);
        }

        .address-card.selected {
            border-color: var(--rose);
            background: rgba(214, 169, 157, 0.1);
        }

        .address-card.selected::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 15px;
            right: 15px;
            width: 24px;
            height: 24px;
            background: var(--rose);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }

        .address-label-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            background: var(--rose);
            color: white;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .address-card-name {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 5px;
        }

        .address-card-details {
            font-size: 0.85rem;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .address-card-actions {
            display: flex;
            gap: 10px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--border-color);
        }

        .address-action-btn {
            padding: 6px 12px;
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            border-radius: 6px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .address-action-btn:hover {
            border-color: var(--rose);
            color: var(--rose);
        }

        .address-action-btn.delete:hover {
            border-color: #e74c3c;
            color: #e74c3c;
        }

        /* Form Styles */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--bg-primary);
            color: var(--text-primary);
            font-family: "Montserrat", sans-serif;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--rose);
            box-shadow: 0 0 0 3px rgba(214, 169, 157, 0.1);
        }

        .save-address-checkbox {
            margin-top: 20px;
            padding: 15px;
            background: rgba(156, 175, 170, 0.05);
            border-radius: 8px;
        }

        .save-address-checkbox label {
            display: flex;
            gap: 10px;
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        .save-address-checkbox input[type="checkbox"] {
            margin-top: 3px;
            accent-color: var(--rose);
            cursor: pointer;
        }

        /* Shipping Methods */
        .shipping-methods {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .shipping-option {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 20px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .shipping-option:hover {
            border-color: var(--rose);
            background: rgba(214, 169, 157, 0.05);
        }

        .shipping-option input[type="radio"] {
            margin-top: 3px;
            accent-color: var(--rose);
            cursor: pointer;
        }

        .shipping-option-content {
            flex: 1;
        }

        .shipping-option-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .shipping-name {
            font-weight: 600;
            color: var(--text-primary);
        }

        .shipping-price {
            font-weight: 600;
            color: var(--rose);
        }

        .shipping-desc {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        /* Payment Methods */
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .payment-option {
            position: relative;
            display: flex;
            align-items: center;
            padding: 20px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .payment-option:hover {
            border-color: var(--rose);
            background: rgba(214, 169, 157, 0.05);
        }

        .payment-option input[type="radio"] {
            display: none;
        }

        .payment-option input[type="radio"]:checked~.payment-option-content {
            color: var(--rose);
        }

        .payment-option input[type="radio"]:checked~* {
            border-color: var(--rose);
        }

        .payment-option input[type="radio"]:checked+.payment-option-content::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 10px;
            right: 10px;
            color: var(--rose);
            font-size: 0.9rem;
        }

        .payment-option-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            width: 100%;
            color: var(--text-primary);
            transition: var(--transition);
            position: relative;
        }

        .payment-option-content i {
            font-size: 1.8rem;
        }

        .payment-option-content span {
            font-size: 0.85rem;
            font-weight: 500;
        }

        .payment-details {
            padding: 20px;
            background: var(--bg-primary);
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }

        .info-box {
            display: flex;
            gap: 15px;
            padding: 15px;
            background: rgba(156, 175, 170, 0.1);
            border-left: 4px solid var(--teal);
            border-radius: 8px;
        }

        .info-box i {
            color: var(--teal);
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .info-box p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        /* Review Section */
        .review-section {
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid var(--border-color);
        }

        .review-section:last-of-type {
            border-bottom: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .review-header h3 {
            font-size: 1.1rem;
            color: var(--text-primary);
        }

        .edit-btn {
            padding: 8px 15px;
            background: transparent;
            border: 1px solid var(--rose);
            color: var(--rose);
            border-radius: 6px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .edit-btn:hover {
            background: var(--rose);
            color: white;
        }

        .review-content {
            font-size: 0.9rem;
            color: var(--text-secondary);
            line-height: 1.8;
        }

        .review-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .review-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            background: var(--bg-primary);
            border-radius: 10px;
        }

        .review-item-image {
            width: 60px;
            height: 70px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--rose) 0%, #c48b7f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .review-item-image i {
            color: white;
            font-size: 1.5rem;
        }

        .review-item-details {
            flex: 1;
        }

        .review-item-name {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 5px;
        }

        .review-item-meta {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .review-item-price {
            font-weight: 600;
            color: var(--rose);
            text-align: right;
        }

        .terms-checkbox {
            margin-top: 25px;
            padding: 20px;
            background: rgba(214, 169, 157, 0.05);
            border-radius: 10px;
        }

        .terms-checkbox label {
            display: flex;
            gap: 10px;
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        .terms-checkbox input[type="checkbox"] {
            margin-top: 3px;
            accent-color: var(--rose);
            cursor: pointer;
        }

        .terms-link {
            color: var(--rose);
            text-decoration: underline;
        }

        /* Step Navigation */
        .step-navigation {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .btn-back,
        .btn-next {
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-family: "Montserrat", sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back {
            background: var(--bg-card);
            border: 2px solid var(--border-color);
            color: var(--text-primary);
        }

        .btn-back:hover {
            border-color: var(--rose);
            color: var(--rose);
        }

        .btn-next {
            background: linear-gradient(135deg, var(--rose) 0%, #c48b7f 100%);
            color: white;
        }

        .btn-next:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(214, 169, 157, 0.4);
        }

        .btn-place-order {
            flex: 1;
        }

        /* Order Summary Sidebar */
        .checkout-sidebar {
            position: sticky;
            top: 100px;
        }

        .order-summary {
            background: var(--bg-card);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
        }

        .summary-title {
            font-size: 1.5rem;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .order-items {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 25px;
        }

        .order-item {
            display: flex;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item-image {
            width: 60px;
            height: 70px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--rose) 0%, #c48b7f 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .order-item-image i {
            color: white;
            font-size: 1.5rem;
        }

        .order-item-details {
            flex: 1;
        }

        .order-item-name {
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 3px;
            color: var(--text-primary);
        }

        .order-item-meta {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-bottom: 5px;
        }

        .order-item-price {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--rose);
        }

        .summary-details {
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.95rem;
            color: var(--text-primary);
        }

        .summary-row.total {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid var(--border-color);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .text-rose {
            color: var(--rose);
        }

        .security-badges {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .security-badges i {
            color: var(--teal);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .checkout-sidebar {
                position: static;
            }

            .payment-methods {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .checkout-container {
                padding: 100px 20px 60px;
            }

            .checkout-section {
                padding: 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .checkout-steps {
                scale: 0.9;
            }

            .step-line {
                max-width: 50px;
                margin: 0 10px;
            }

            .step-navigation {
                flex-direction: column;
            }

            .btn-back,
            .btn-next {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <script>
        let currentStep = 1;
        let cartData = {};
        let shippingCost = 25000;
        let codFee = 0;
        let savedAddresses = [];
        let selectedAddressId = null;
        const MAX_ADDRESSES = 5;

        // Shipping and payment data
        let shippingData = {};
        let paymentData = {};

        // Address label icons
        const addressIcons = {
            home: '🏠',
            parents: '👨‍👩‍👧‍👦',
            office: '🏢',
            school: '🎓',
            other: '📍'
        };

        const addressLabels = {
            home: 'Rumah Pribadi/Kontrakan',
            parents: 'Rumah Orang Tua',
            office: 'Tempat Kerja',
            school: 'Sekolah/Kampus',
            other: 'Lainnya'
        };

        function loadCheckoutData() {
            const saved = window.localStorage.getItem('cart');

            if (saved) {
                try {
                    cartData = JSON.parse(saved);

                    const items = cartData.items || cartData;
                    if (Array.isArray(items) && items.length > 0) {
                        renderOrderSummary();
                    } else {
                        alert('Keranjang Anda kosong. Mengalihkan ke halaman keranjang...');
                        window.location.href = '/cart';
                    }
                } catch (e) {
                    console.error('Error parsing cart data:', e);
                    window.location.href = '/cart';
                }
            } else {
                alert('Keranjang Anda kosong. Mengalihkan ke halaman keranjang...');
                window.location.href = '/cart';
            }

            // Load saved addresses
            loadSavedAddresses();
        }

        function loadSavedAddresses() {
            const saved = window.localStorage.getItem('savedAddresses');
            if (saved) {
                try {
                    savedAddresses = JSON.parse(saved);
                    if (savedAddresses.length > 0) {
                        document.getElementById('savedAddressesContainer').style.display = 'block';
                        renderSavedAddresses();
                    }
                } catch (e) {
                    console.error('Error loading addresses:', e);
                    savedAddresses = [];
                }
            }
        }

        function renderSavedAddresses() {
            const container = document.getElementById('savedAddressesList');

            container.innerHTML = savedAddresses.map((addr, index) => {
                const labelText = addr.labelType === 'other' ? addr.customLabel : addressLabels[addr.labelType];
                const icon = addressIcons[addr.labelType];

                return `
                    <div class="address-card ${selectedAddressId === addr.id ? 'selected' : ''}" 
                         onclick="selectAddress('${addr.id}')">
                        <div class="address-label-badge">
                            ${icon} ${labelText}
                        </div>
                        <div class="address-card-name">${addr.firstName} ${addr.lastName}</div>
                        <div class="address-card-details">
                            ${addr.phone}<br>
                            ${addr.address}<br>
                            ${addr.city}, ${addr.province} ${addr.postalCode}
                        </div>
                        <div class="address-card-actions" onclick="event.stopPropagation()">
                            <button class="address-action-btn" onclick="editAddress('${addr.id}')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="address-action-btn delete" onclick="deleteAddress('${addr.id}')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function selectAddress(addressId) {
            selectedAddressId = addressId;
            renderSavedAddresses();

            // Hide new address form
            document.getElementById('newAddressFormContainer').style.display = 'none';
        }

        function showNewAddressForm() {
            if (savedAddresses.length >= MAX_ADDRESSES) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Maksimal Alamat Tercapai',
                    text: `Anda sudah memiliki ${MAX_ADDRESSES} alamat tersimpan. Hapus salah satu alamat untuk menambah yang baru.`
                });
                return;
            }

            selectedAddressId = null;
            renderSavedAddresses();

            document.getElementById('newAddressFormContainer').style.display = 'block';
            document.querySelector('.cancel-new-address-btn').style.display = 'flex';

            // Clear form
            document.getElementById('shippingForm').reset();
            document.getElementById('customLabelGroup').style.display = 'none';

            // Scroll to form
            document.getElementById('newAddressFormContainer').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function cancelNewAddress() {
            if (savedAddresses.length > 0) {
                document.getElementById('newAddressFormContainer').style.display = 'none';
                document.querySelector('.cancel-new-address-btn').style.display = 'none';
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Alamat Diperlukan',
                    text: 'Anda harus menambahkan minimal satu alamat pengiriman.'
                });
            }
        }

        function editAddress(addressId) {
            const address = savedAddresses.find(a => a.id === addressId);
            if (!address) return;

            // Show form
            document.getElementById('newAddressFormContainer').style.display = 'block';
            document.querySelector('.cancel-new-address-btn').style.display = 'flex';

            // Fill form with address data
            document.getElementById('addressLabel').value = address.labelType;
            document.getElementById('firstName').value = address.firstName;
            document.getElementById('lastName').value = address.lastName;
            document.getElementById('email').value = address.email;
            document.getElementById('phone').value = address.phone;
            document.getElementById('address').value = address.address;
            document.getElementById('city').value = address.city;
            document.getElementById('postalCode').value = address.postalCode;
            document.getElementById('province').value = address.province;

            if (address.labelType === 'other') {
                document.getElementById('customLabelGroup').style.display = 'block';
                document.getElementById('customLabel').value = address.customLabel;
            }

            // Store editing ID
            document.getElementById('shippingForm').dataset.editingId = addressId;

            // Scroll to form
            document.getElementById('newAddressFormContainer').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function deleteAddress(addressId) {
            Swal.fire({
                title: 'Hapus Alamat?',
                text: 'Alamat ini akan dihapus secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#95a5a6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    savedAddresses = savedAddresses.filter(a => a.id !== addressId);
                    window.localStorage.setItem('savedAddresses', JSON.stringify(savedAddresses));

                    if (selectedAddressId === addressId) {
                        selectedAddressId = null;
                    }

                    if (savedAddresses.length === 0) {
                        document.getElementById('savedAddressesContainer').style.display = 'none';
                        document.getElementById('newAddressFormContainer').style.display = 'block';
                        document.querySelector('.cancel-new-address-btn').style.display = 'none';
                    } else {
                        renderSavedAddresses();
                    }

                    Swal.fire('Terhapus!', 'Alamat berhasil dihapus.', 'success');
                }
            });
        }

        function formatRupiah(amount) {
            return 'Rp ' + amount.toLocaleString('id-ID');
        }

        function renderOrderSummary() {
            let items = [];

            if (Array.isArray(cartData)) {
                items = cartData;
            } else if (cartData && Array.isArray(cartData.items)) {
                items = cartData.items;
            }

            const orderItemsContainer = document.getElementById('orderItems');

            if (!orderItemsContainer) {
                console.error('Element #orderItems tidak ditemukan');
                return;
            }

            if (items.length === 0) {
                alert('Keranjang Anda kosong. Mengalihkan ke halaman keranjang...');
                window.location.href = '/cart';
                return;
            }

            orderItemsContainer.innerHTML = items.map(item => {
                const itemImage = item.image || null
                const itemName = item.name || item.productName || 'Unknown Product';
                const itemSize = item.size || item.variantSize || 'N/A';
                const itemQuantity = item.quantity ?? 1;
                const itemPrice = item.price ?? 0;

                return `
            <div class="order-item">
                <div class="order-item-image">
                    ${itemImage ? `<img src="${itemImage}" alt="${itemName}">` : '<i class="fas fa-question"></i>'}
                </div>
                <div class="order-item-details">
                    <div class="order-item-name">${itemName}</div>
                    <div class="order-item-meta">
                        Qty: ${itemQuantity} • Size: ${itemSize}
                    </div>
                    <div class="order-item-price">
                        ${formatRupiah(itemPrice * itemQuantity)}
                    </div>
                </div>
            </div>
        `;
            }).join('');

            updateSummary();
        }


        function updateSummary() {
            let items = [];
            if (Array.isArray(cartData)) {
                items = cartData;
            } else if (cartData.items && Array.isArray(cartData.items)) {
                items = cartData.items;
            }

            const subtotal = items.reduce((sum, item) => sum + (item.price * item.quantity), 0);

            let promoDiscount = 0;
            const promo = cartData.promo || null;
            if (promo && promo.discount) {
                promoDiscount = Math.floor((subtotal * promo.discount) / 100);
                document.getElementById('promoRow').style.display = 'flex';
                document.getElementById('summaryPromo').textContent = '-' + formatRupiah(promoDiscount);
            }

            const total = subtotal + shippingCost + codFee - promoDiscount;

            document.getElementById('summarySubtotal').textContent = formatRupiah(subtotal);
            document.getElementById('summaryShipping').textContent = formatRupiah(shippingCost);
            document.getElementById('summaryTotal').textContent = formatRupiah(total);
        }

        // Multi-step navigation
        function nextStep(step) {
            // Validate current step
            if (step === 1) {
                // Check if address is selected or new form is filled
                if (!selectedAddressId) {
                    const form = document.getElementById('shippingForm');
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    const addressLabel = document.getElementById('addressLabel').value;
                    if (addressLabel === 'other' && !document.getElementById('customLabel').value) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Label Diperlukan',
                            text: 'Harap isi nama label alamat'
                        });
                        return;
                    }

                    // Save new address if checkbox is checked
                    const shouldSave = document.getElementById('saveAddress').checked;
                    const editingId = document.getElementById('shippingForm').dataset.editingId;

                    const newAddress = {
                        id: editingId || 'addr_' + Date.now(),
                        labelType: addressLabel,
                        customLabel: addressLabel === 'other' ? document.getElementById('customLabel').value : '',
                        firstName: document.getElementById('firstName').value,
                        lastName: document.getElementById('lastName').value,
                        email: document.getElementById('email').value,
                        phone: document.getElementById('phone').value,
                        address: document.getElementById('address').value,
                        city: document.getElementById('city').value,
                        postalCode: document.getElementById('postalCode').value,
                        province: document.getElementById('province').value
                    };

                    if (shouldSave || editingId) {
                        if (editingId) {
                            // Update existing address
                            const index = savedAddresses.findIndex(a => a.id === editingId);
                            if (index !== -1) {
                                savedAddresses[index] = newAddress;
                            }
                            delete document.getElementById('shippingForm').dataset.editingId;
                        } else {
                            // Add new address
                            if (savedAddresses.length >= MAX_ADDRESSES) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Maksimal Alamat Tercapai',
                                    text: `Maksimal ${MAX_ADDRESSES} alamat tersimpan`
                                });
                                return;
                            }
                            savedAddresses.push(newAddress);
                        }

                        window.localStorage.setItem('savedAddresses', JSON.stringify(savedAddresses));
                    }

                    // Use this address for shipping
                    shippingData = {
                        ...newAddress,
                        shippingMethod: document.querySelector('input[name="shipping"]:checked').value,
                        shippingCost: parseInt(document.querySelector('input[name="shipping"]:checked').dataset.cost)
                    };
                } else {
                    // Use selected address
                    const selectedAddress = savedAddresses.find(a => a.id === selectedAddressId);
                    if (!selectedAddress) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Alamat tidak ditemukan'
                        });
                        return;
                    }

                    shippingData = {
                        ...selectedAddress,
                        shippingMethod: document.querySelector('input[name="shipping"]:checked').value,
                        shippingCost: parseInt(document.querySelector('input[name="shipping"]:checked').dataset.cost)
                    };
                }
            }

            if (step === 2) {
                // Save payment data
                const paymentMethod = document.querySelector('input[name="payment"]:checked').value;
                paymentData = {
                    method: paymentMethod
                };

                if (paymentMethod === 'credit') {
                    const cardNumber = document.getElementById('cardNumber').value;
                    const expiryDate = document.getElementById('expiryDate').value;
                    const cvv = document.getElementById('cvv').value;
                    const cardholderName = document.getElementById('cardholderName').value;

                    if (!cardNumber || !expiryDate || !cvv || !cardholderName) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Informasi Tidak Lengkap',
                            text: 'Harap isi semua detail kartu'
                        });
                        return;
                    }

                    paymentData.cardNumber = cardNumber.slice(-4);
                    paymentData.cardholderName = cardholderName;
                } else if (paymentMethod === 'ewallet') {
                    const provider = document.getElementById('ewalletProvider').value;
                    if (!provider) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Pilih Provider',
                            text: 'Harap pilih provider e-wallet'
                        });
                        return;
                    }
                    paymentData.provider = provider;
                }

                // Populate review section
                populateReview();
            }

            goToStep(step + 1);
        }

        function prevStep(step) {
            goToStep(step - 1);
        }

        function goToStep(step) {
            // Hide all steps
            document.querySelectorAll('.checkout-step-content').forEach(el => {
                el.style.display = 'none';
            });

            // Show target step
            document.getElementById('step' + step).style.display = 'block';

            // Update progress indicators
            document.querySelectorAll('.step').forEach((el, index) => {
                el.classList.remove('active', 'completed');
                if (index + 1 === step) {
                    el.classList.add('active');
                } else if (index + 1 < step) {
                    el.classList.add('completed');
                }
            });

            currentStep = step;

            // Scroll to top
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function populateReview() {
            // Shipping info
            const shippingMethods = {
                regular: 'Regular Shipping (5-7 hari)',
                express: 'Express Shipping (2-3 hari)',
                oneday: 'Same Day Delivery'
            };

            const labelText = shippingData.labelType === 'other' ?
                shippingData.customLabel :
                addressLabels[shippingData.labelType];
            const icon = addressIcons[shippingData.labelType];

            document.getElementById('reviewShipping').innerHTML = `
                <div style="display: inline-block; padding: 4px 12px; background: var(--rose); color: white; border-radius: 20px; font-size: 0.75rem; font-weight: 600; margin-bottom: 10px;">
                    ${icon} ${labelText}
                </div>
                <p><strong>${shippingData.firstName} ${shippingData.lastName}</strong></p>
                <p>${shippingData.email}</p>
                <p>${shippingData.phone}</p>
                <p>${shippingData.address}</p>
                <p>${shippingData.city}, ${shippingData.province} ${shippingData.postalCode}</p>
                <p style="margin-top: 10px; color: var(--rose);"><strong>${shippingMethods[shippingData.shippingMethod]}</strong></p>
            `;

            // Payment info
            const paymentMethods = {
                credit: 'Kartu Kredit/Debit',
                bank: 'Transfer Bank',
                ewallet: 'E-Wallet',
                cod: 'Bayar di Tempat'
            };

            let paymentInfo = `<p><strong>${paymentMethods[paymentData.method]}</strong></p>`;

            if (paymentData.method === 'credit') {
                paymentInfo += `<p>Kartu berakhiran ****${paymentData.cardNumber}</p>`;
                paymentInfo += `<p>${paymentData.cardholderName}</p>`;
            } else if (paymentData.method === 'ewallet') {
                paymentInfo += `<p>${paymentData.provider.toUpperCase()}</p>`;
            }

            document.getElementById('reviewPayment').innerHTML = paymentInfo;

            // Order items
            let items = cartData.items || cartData;
            document.getElementById('reviewItems').innerHTML = items.map(item => {
                const itemName = item.name || item.productName || 'Unknown Product';
                const itemSize = item.size || item.variantSize || 'N/A';
                const itemQuantity = item.quantity || 1;
                const itemPrice = item.price || 0;

                return `
                    <div class="review-item">
                        <div class="review-item-image">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <div class="review-item-details">
                            <div class="review-item-name">${itemName}</div>
                            <div class="review-item-meta">Jumlah: ${itemQuantity} • Ukuran: ${itemSize}</div>
                        </div>
                        <div class="review-item-price">
                            ${formatRupiah(itemPrice * itemQuantity)}
                        </div>
                    </div>
                `;
            }).join('');
        }

        function placeOrder() {
            // Check terms agreement
            if (!document.getElementById('agreeTerms').checked) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Syarat Diperlukan',
                    text: 'Harap setujui syarat dan ketentuan'
                });
                return;
            }

            const orderNumber = 'ORD-' + Date.now();

            Swal.fire({
                title: 'Memproses Pesanan...',
                html: 'Mohon tunggu sementara kami memproses pesanan Anda',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Simulate API call
            setTimeout(() => {
                window.localStorage.removeItem('cart');

                const labelText = shippingData.labelType === 'other' ?
                    shippingData.customLabel :
                    addressLabels[shippingData.labelType];

                Swal.fire({
                    icon: 'success',
                    title: 'Pesanan Berhasil Dibuat!',
                    html: `
                        <div style="text-align: left; padding: 20px;">
                            <p style="margin-bottom: 15px; color: #666;">Terima kasih atas pesanan Anda!</p>
                            <div style="background: #f5f5f5; padding: 15px; border-radius: 8px;">
                                <div style="margin-bottom: 8px;">
                                    <strong>Nomor Pesanan:</strong> ${orderNumber}
                                </div>
                                <div style="margin-bottom: 8px;">
                                    <strong>Nama:</strong> ${shippingData.firstName} ${shippingData.lastName}
                                </div>
                                <div style="margin-bottom: 8px;">
                                    <strong>Alamat:</strong> ${labelText}
                                </div>
                                <div style="margin-bottom: 8px;">
                                    <strong>Email:</strong> ${shippingData.email}
                                </div>
                                <div>
                                    <strong>Total:</strong> ${document.getElementById('summaryTotal').textContent}
                                </div>
                            </div>
                            <p style="color: #666; font-size: 0.9rem; margin-top: 15px;">
                                Kami telah mengirim email konfirmasi ke <strong>${shippingData.email}</strong>
                            </p>
                        </div>
                    `,
                    confirmButtonText: 'Lanjut Belanja'
                }).then(() => {
                    window.location.href = '/';
                });
            }, 2000);
        }

        // Payment method switching
        document.addEventListener('DOMContentLoaded', function() {
            loadCheckoutData();

            // Address label change handler
            document.getElementById('addressLabel').addEventListener('change', function() {
                const customLabelGroup = document.getElementById('customLabelGroup');
                const customLabelInput = document.getElementById('customLabel');

                if (this.value === 'other') {
                    customLabelGroup.style.display = 'block';
                    customLabelInput.setAttribute('required', 'required');
                } else {
                    customLabelGroup.style.display = 'none';
                    customLabelInput.removeAttribute('required');
                    customLabelInput.value = '';
                }
            });

            // Shipping method change
            const shippingRadios = document.querySelectorAll('input[name="shipping"]');
            shippingRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    shippingCost = parseInt(this.dataset.cost);
                    updateSummary();
                });
            });

            // Payment method change
            const paymentRadios = document.querySelectorAll('input[name="payment"]');
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Hide all payment details
                    document.querySelectorAll('.payment-details').forEach(el => {
                        el.style.display = 'none';
                    });

                    // Show relevant payment details
                    if (this.value === 'credit') {
                        document.getElementById('creditCardForm').style.display = 'block';
                        codFee = 0;
                        document.getElementById('codFeeRow').style.display = 'none';
                    } else if (this.value === 'bank') {
                        document.getElementById('bankTransferInfo').style.display = 'block';
                        codFee = 0;
                        document.getElementById('codFeeRow').style.display = 'none';
                    } else if (this.value === 'ewallet') {
                        document.getElementById('ewalletInfo').style.display = 'block';
                        codFee = 0;
                        document.getElementById('codFeeRow').style.display = 'none';
                    } else if (this.value === 'cod') {
                        document.getElementById('codInfo').style.display = 'block';
                        codFee = 5000;
                        document.getElementById('codFeeRow').style.display = 'flex';
                        document.getElementById('summaryCodFee').textContent = formatRupiah(codFee);
                    }

                    updateSummary();
                });
            });

            // Card number formatting
            const cardNumberInput = document.getElementById('cardNumber');
            if (cardNumberInput) {
                cardNumberInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\s/g, '');
                    let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
                    e.target.value = formattedValue;
                });
            }

            // Expiry date formatting
            const expiryInput = document.getElementById('expiryDate');
            if (expiryInput) {
                expiryInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length >= 2) {
                        value = value.slice(0, 2) + '/' + value.slice(2, 4);
                    }
                    e.target.value = value;
                });
            }
        });
    </script>
@endsection
