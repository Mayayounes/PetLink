<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - PetLink</title>
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: Inter, sans-serif;
        }

        .circle-bg-wrapper {
            position: relative;
            width: 100%;
            height: 60vh;
            overflow: hidden;
        }

        .circle-bg {
            width: 100%;
            height: 100%;
            background-color: #F8D6D8;
            border-bottom-left-radius: 100% 100%;
            border-bottom-right-radius: 100% 100%;
            position: relative;
            z-index: 1;
        }

        .circle-bg-wrapper img.cat,
        .circle-bg-wrapper img.dog {
            position: absolute;
            object-fit: contain;
            z-index: 2;
        }

        img.cat {
            width: 400px;
            aspect-ratio: 1 / 1;
            left: -100px;
            bottom: 0;
        }

        img.dog {
            width: 522px;
            height: 350px;
            right: -130px;
            bottom: 40px;
        }

        .title-wrapper {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            pointer-events: none;
            user-select: none;
        }

        .title {
            color: #322B2B;
            font-family: Inter, sans-serif;
            font-size: 32px;
            font-weight: 600;
            margin: 0;
        }

        .subtitle {
            color: #555;
            font-family: Inter, sans-serif;
            font-size: 16px;
            margin-top: 8px;
        }

        .cart-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            background: #FEF7F7;
            border-radius: 20px;
            margin: 40px auto;
            max-width: 600px;
        }

        .empty-cart h2 {
            color: #9D4F51;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .empty-cart p {
            color: #666;
            font-size: 16px;
            margin-bottom: 24px;
        }

        .cart-items-wrapper {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .cart-items {
            flex: 2;
        }

        .cart-item {
            display: flex;
            align-items: center;
            background: #FEF7F7;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .cart-item:hover {
            transform: translateY(-2px);
        }

        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            margin-right: 20px;
            background: #F8D6D8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
        }

        .product-details {
            flex: 1;
            margin-right: 20px;
        }

        .product-name {
            font-size: 18px;
            font-weight: 600;
            color: #322B2B;
            margin-bottom: 4px;
        }

        .product-category {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }

        .product-price {
            font-size: 16px;
            font-weight: 600;
            color: #9D4F51;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-right: 20px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .qty-btn.decrease {
            background-color: #DC3545;
            color: white;
        }

        .qty-btn.increase {
            background-color: #28A745;
            color: white;
        }

        .qty-btn:hover {
            transform: scale(1.1);
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            padding: 8px 4px;
            font-size: 16px;
            font-weight: 600;
        }

        .item-total {
            font-size: 18px;
            font-weight: 600;
            color: #322B2B;
            margin-right: 20px;
            min-width: 80px;
            text-align: right;
        }

        .remove-btn {
            background: #DC3545;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }

        .remove-btn:hover {
            background: #C82333;
        }

        .cart-summary {
            flex: 1;
            background: #F8D6D8;
            border-radius: 20px;
            padding: 24px;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 20px;
            font-weight: 600;
            color: #322B2B;
            margin-bottom: 20px;
            text-align: center;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding: 8px 0;
        }

        .summary-row.total {
            border-top: 2px solid #9D4F51;
            padding-top: 16px;
            margin-top: 16px;
            font-size: 18px;
            font-weight: 600;
            color: #322B2B;
        }

        .checkout-btn {
            width: 100%;
            background: #9D4F51;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.2s ease;
        }

        .checkout-btn:hover {
            background: #7a3a3b;
        }

        .clear-cart-btn {
            width: 100%;
            background: #DC3545;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 12px;
            transition: background-color 0.2s ease;
        }

        .clear-cart-btn:hover {
            background: #C82333;
        }

        .continue-shopping-btn {
            display: inline-block;
            background: #9D4F51;
            color: white;
            padding: 16px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: background-color 0.2s ease;
        }

        .continue-shopping-btn:hover {
            background: #7a3a3b;
        }

        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background: white;
            border-radius: 16px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            padding: 0;
            max-width: 420px;
            width: 90%;
            transform: scale(0.9) translateY(20px);
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .modal-overlay.show .modal {
            transform: scale(1) translateY(0);
        }

        .modal-header {
            padding: 28px 28px 16px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .modal-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .modal-icon.success {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
        }

        .modal-icon.error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .modal-icon.warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .modal-icon.info {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin: 0;
            line-height: 1.3;
        }

        .modal-body {
            padding: 16px 28px 28px;
        }

        .modal-message {
            color: #6b7280;
            font-size: 15px;
            line-height: 1.6;
            margin: 0 0 24px 0;
        }

        .modal-footer {
            padding: 0 28px 28px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .modal-button {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            min-width: 90px;
        }

        .modal-button.primary {
            background: linear-gradient(135deg, #9D4F51, #7a3a3b);
            color: white;
        }

        .modal-button.primary:hover {
            background: linear-gradient(135deg, #7a3a3b, #5f2d2e);
            transform: translateY(-1px);
        }

        .modal-button.secondary {
            background: #f8f9fa;
            color: #6c757d;
            border: 1px solid #e9ecef;
        }

        .modal-button.secondary:hover {
            background: #e9ecef;
            transform: translateY(-1px);
        }

        .modal-button.danger {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
        }

        .modal-button.danger:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            transform: translateY(-1px);
        }

        /* Loading state for buttons */
        .modal-button.loading {
            opacity: 0.7;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Animation for icons */
        .success-checkmark {
            animation: checkmark 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes checkmark {
            0% { transform: scale(0) rotate(45deg); }
            50% { transform: scale(1.2) rotate(45deg); }
            100% { transform: scale(1) rotate(45deg); }
        }

        .error-x {
            animation: errorShake 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes errorShake {
            0%, 20%, 40%, 60%, 80% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-3px); }
        }

        .warning-exclamation {
            animation: warningPulse 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes warningPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @media (max-width: 768px) {
            .cart-items-wrapper {
                flex-direction: column;
                gap: 20px;
            }

            .cart-item {
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }

            .product-image {
                margin-right: 0;
            }

            .quantity-controls {
                margin-right: 0;
            }

            .item-total {
                margin-right: 0;
                text-align: center;
            }

            .modal {
                max-width: 350px;
            }

            .modal-header {
                padding: 24px 20px 12px;
            }

            .modal-body {
                padding: 12px 20px 20px;
            }

            .modal-footer {
                padding: 0 20px 20px;
                flex-direction: column-reverse;
            }

            .modal-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    @include('components.navbar')

    <div class="circle-bg-wrapper">
        <div class="circle-bg"></div>
        <img src="{{ asset('img/cat.png') }}" class="cat" alt="Cat" />
        <img src="{{ asset('img/dog.png') }}" class="dog" alt="Dog" />

        <div class="title-wrapper">
            <div class="title">Shopping Cart</div>
            <div class="subtitle">Review your items before checkout</div>
        </div>
    </div>

    <div class="cart-container">
        @if(empty($cart))
            <div class="empty-cart">
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added any items to your cart yet.</p>
                <a href="{{ route('products.index') }}" class="continue-shopping-btn">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="cart-items-wrapper">
                <div class="cart-items">
                    @foreach($cart as $id => $item)
                        <div class="cart-item" data-product-id="{{ $id }}">
                            <div class="product-image">
                                @php
                                    $formattedName = strtolower(str_replace(' ', '-', $item['name']));
                                    $imageUrl = asset('img/' . $formattedName . '.jpg');
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $item['name'] }}" 
                                     style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px;"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                <span style="display: none;">No Image</span>
                            </div>
                            
                            <div class="product-details">
                                <div class="product-name">{{ $item['name'] }}</div>
                                <div class="product-category">{{ $item['category'] }}</div>
                                <div class="product-price">{{ number_format($item['price'], 2) }} EGP</div>
                            </div>

                            <div class="quantity-controls">
                                <button class="qty-btn decrease" onclick="updateQuantity({{ $id }}, {{ $item['quantity'] }} - 1)">
                                    -
                                </button>
                                <input type="number" class="qty-input" value="{{ $item['quantity'] }}" 
                                       min="1" readonly>
                                <button class="qty-btn increase" onclick="updateQuantity({{ $id }}, {{ $item['quantity'] }} + 1)">
                                    +
                                </button>
                            </div>

                            <div class="item-total">
                                {{ number_format($item['price'] * $item['quantity'], 2) }} EGP
                            </div>

                            <button class="remove-btn" onclick="removeFromCart({{ $id }})">
                                Remove
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="cart-summary">
                    <div class="summary-title">Order Summary</div>
                    
                    <div class="summary-row">
                        <span>Items ({{ array_sum(array_column($cart, 'quantity')) }})</span>
                        <span>{{ number_format($total, 2) }} EGP</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>{{ number_format($total, 2) }} EGP</span>
                    </div>

                    <a href="{{ route('checkout') }}" class="checkout-btn" style="display: block; text-align: center; text-decoration: none;">
                        Proceed to Checkout
                    </a>

                    <button class="clear-cart-btn" onclick="clearCart()">
                        Clear Cart
                    </button>
                </div>
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('products.index') }}" class="continue-shopping-btn">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>

    <!-- Modal HTML -->
    <div id="modalOverlay" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <div id="modalIcon" class="modal-icon">
                    <span id="modalIconSymbol">✓</span>
                </div>
                <h3 id="modalTitle" class="modal-title">Success</h3>
            </div>
            <div class="modal-body">
                <p id="modalMessage" class="modal-message">Operation completed successfully.</p>
            </div>
            <div class="modal-footer">
                <button id="modalSecondaryButton" class="modal-button secondary" style="display: none;">Cancel</button>
                <button id="modalPrimaryButton" class="modal-button primary">OK</button>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Modal elements
        const modalOverlay = document.getElementById('modalOverlay');
        const modalIcon = document.getElementById('modalIcon');
        const modalIconSymbol = document.getElementById('modalIconSymbol');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const modalPrimaryButton = document.getElementById('modalPrimaryButton');
        const modalSecondaryButton = document.getElementById('modalSecondaryButton');

        // Modal functions
        function showModal(type, title, message, primaryText = 'OK', secondaryText = null, onPrimary = null, onSecondary = null) {
            // Set modal type and icon
            modalIcon.className = `modal-icon ${type}`;
            
            switch(type) {
                case 'success':
                    modalIconSymbol.textContent = '✓';
                    modalIconSymbol.className = 'success-checkmark';
                    break;
                case 'error':
                    modalIconSymbol.textContent = '✕';
                    modalIconSymbol.className = 'error-x';
                    break;
                case 'warning':
                    modalIconSymbol.textContent = '!';
                    modalIconSymbol.className = 'warning-exclamation';
                    break;
                case 'info':
                    modalIconSymbol.textContent = 'i';
                    modalIconSymbol.className = '';
                    break;
            }

            // Set content
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            modalPrimaryButton.textContent = primaryText;

            // Handle secondary button
            if (secondaryText) {
                modalSecondaryButton.textContent = secondaryText;
                modalSecondaryButton.style.display = 'block';
                
                // Set appropriate button styles for confirmation dialogs
                if (type === 'warning') {
                    modalPrimaryButton.className = 'modal-button danger';
                } else {
                    modalPrimaryButton.className = 'modal-button primary';
                }
            } else {
                modalSecondaryButton.style.display = 'none';
                modalPrimaryButton.className = 'modal-button primary';
            }

            // Set up event listeners
            modalPrimaryButton.onclick = () => {
                hideModal();
                if (onPrimary) onPrimary();
            };

            modalSecondaryButton.onclick = () => {
                hideModal();
                if (onSecondary) onSecondary();
            };

            // Close modal when clicking overlay
            modalOverlay.onclick = (e) => {
                if (e.target === modalOverlay) {
                    hideModal();
                }
            };

            // Show modal
            modalOverlay.classList.add('show');
            
            // Focus primary button for accessibility
            setTimeout(() => modalPrimaryButton.focus(), 300);
        }

        function hideModal() {
            modalOverlay.classList.remove('show');
        }

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modalOverlay.classList.contains('show')) {
                hideModal();
            }
        });

        function updateQuantity(productId, newQuantity) {
            if (newQuantity < 1) return;

            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload the page to reflect changes
                    window.location.reload();
                } else {
                    showModal('error', 'Update Failed', data.message || 'Error updating cart quantity. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('error', 'Connection Error', 'Unable to update cart. Please check your connection and try again.');
            });
        }

        function removeFromCart(productId) {
            showModal(
                'warning',
                'Remove Item',
                'Are you sure you want to remove this item from your cart? This action cannot be undone.',
                'Remove',
                'Cancel',
                () => {
                    // Confirmed removal
                    fetch('/cart/remove', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showModal(
                                'success',
                                'Item Removed',
                                'The item has been successfully removed from your cart.',
                                'OK',
                                null,
                                () => window.location.reload()
                            );
                        } else {
                            showModal('error', 'Removal Failed', data.message || 'Error removing item from cart. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showModal('error', 'Connection Error', 'Unable to remove item. Please check your connection and try again.');
                    });
                }
            );
        }

        function clearCart() {
            showModal(
                'warning',
                'Clear Entire Cart',
                'Are you sure you want to remove all items from your cart? This action cannot be undone and will permanently clear your cart.',
                'Clear Cart',
                'Cancel',
                () => {
                    // Confirmed clear cart
                    fetch('/cart/clear', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showModal(
                                'success',
                                'Cart Cleared',
                                'Your shopping cart has been successfully cleared. You can continue shopping to add new items.',
                                'Continue',
                                null,
                                () => window.location.reload()
                            );
                        } else {
                            showModal('error', 'Clear Failed', data.message || 'Error clearing cart. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showModal('error', 'Connection Error', 'Unable to clear cart. Please check your connection and try again.');
                    });
                }
            );
        }
    </script>
</body>
</html>