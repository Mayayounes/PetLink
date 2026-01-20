<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Pet Adoption</title>
    <link rel="stylesheet" href="{{ asset('css/stylesProduct.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
</head>

<body>
    @include('components.navbar')
    <div class="circle-bg-wrapper">
        <div class="circle-bg"></div>
        <img src="{{ asset('img/cat.png') }}" class="cat" alt="Cat" />
        <img src="{{ asset('img/dog.png') }}" class="dog" alt="Dog" />

        <div class="title-wrapper">
            <div class="title">Shop Supplies</div>
            <div class="subtitle">Everything pets need, all in one place</div>
        </div>
    </div>

    <div class="flex-container">
        <form method="GET" action="{{ route('products.index') }}" class="filter-box">
            <!-- Species Filter -->
            <div style="width: 100%;">
                <h3 style="margin: 0; font-family: Inter, sans-serif;">Categories</h3>
                <hr style="width: 100%; border: 1px solid #322B2B; margin: 8px 0;" />
                <label><input type="checkbox" name="categories[]" value="Leashes"
                        @if (request()->has('categories') && in_array('Leashes', request('categories'))) checked @endif> Leashes</label><br>
                <label><input type="checkbox" name="categories[]" value="Pet Cleaning Products"
                        @if (request()->has('categories') && in_array('Pet Cleaning Products', request('categories'))) checked @endif> Pet Cleaning Products</label><br>
                <label><input type="checkbox" name="categories[]" value="Feeding Bowls"
                        @if (request()->has('categories') && in_array('Feeding Bowls', request('categories'))) checked @endif> Feeding Bowls</label><br>
                <label><input type="checkbox" name="categories[]" value="Aquarium Supplies"
                        @if (request()->has('categories') && in_array('Aquarium Supplies', request('categories'))) checked @endif> Aquarium Supplies</label><br>
                <label><input type="checkbox" name="categories[]" value="Pet Apparel"
                        @if (request()->has('categories') && in_array('Pet Apparel', request('categories'))) checked @endif> Pet Apparel</label><br>
                <label><input type="checkbox" name="categories[]" value="Training Pads"
                        @if (request()->has('categories') && in_array('Training Pads', request('categories'))) checked @endif> Training Pads</label><br>
                <label><input type="checkbox" name="categories[]" value="Grooming Supplies"
                        @if (request()->has('categories') && in_array('Grooming Supplies', request('categories'))) checked @endif> Grooming Supplies</label><br>
                <label><input type="checkbox" name="categories[]" value="Health Supplements"
                        @if (request()->has('categories') && in_array('Health Supplements', request('categories'))) checked @endif> Health Supplements</label><br>
                <label><input type="checkbox" name="categories[]" value="Cages & Carriers"
                        @if (request()->has('categories') && in_array('Cages & Carriers', request('categories'))) checked @endif> Cages & Carriers</label><br>
                <label><input type="checkbox" name="categories[]" value="Beds"
                        @if (request()->has('categories') && in_array('Beds', request('categories'))) checked @endif> Beds</label><br>
                <label><input type="checkbox" name="categories[]" value="Toys"
                        @if (request()->has('categories') && in_array('Toys', request('categories'))) checked @endif> Toys</label><br>
                <label><input type="checkbox" name="categories[]" value="Bird Food"
                        @if (request()->has('categories') && in_array('Bird Food', request('categories'))) checked @endif> Bird Food</label><br>
                <label><input type="checkbox" name="categories[]" value="Treats"
                        @if (request()->has('categories') && in_array('Treats', request('categories'))) checked @endif> Treats</label><br>
                <label><input type="checkbox" name="categories[]" value="Wet Food"
                        @if (request()->has('categories') && in_array('Wet Food', request('categories'))) checked @endif> Wet Food</label><br>
                <label><input type="checkbox" name="categories[]" value="Litter"
                        @if (request()->has('categories') && in_array('Litter', request('categories'))) checked @endif> Litter</label><br>
            </div>

            <!-- Price Range Filter -->
            <div style="width: 100%;">
                <h3 style="margin: 0; font-family: Inter, sans-serif;">Price Range</h3>
                <hr style="width: 100%; border: 1px solid #322B2B; margin: 8px 0;" />
                <label><input type="checkbox" name="price_of_single_product[]" value="<50"
                        @if (request()->has('price_of_single_product') && in_array('<50', request('price_of_single_product'))) checked @endif> &lt;50 EGP</label><br>
                <label><input type="checkbox" name="price_of_single_product[]" value="50-150"
                        @if (request()->has('price_of_single_product') && in_array('50-150', request('price_of_single_product'))) checked @endif> 50–150 EGP</label><br>
                <label><input type="checkbox" name="price_of_single_product[]" value="151-300"
                        @if (request()->has('price_of_single_product') && in_array('151-300', request('price_of_single_product'))) checked @endif> 151–300 EGP</label><br>
                <label><input type="checkbox" name="price_of_single_product[]" value="301-700"
                        @if (request()->has('price_of_single_product') && in_array('301-700', request('price_of_single_product'))) checked @endif> 301–700 EGP</label><br>
            </div>

            <!-- Buttons -->
            <div style="width: 100%; display: flex; gap: 16px;">
                <button id="reset-button" class="filter-btn reset-filter" type="button"
                    style="flex: 1; padding: 12px; background-color: #CCCCCC; border: none; border-radius: 10px; font-weight: bold; cursor: pointer;">
                    Reset Filter
                </button>
                <button type="submit" class="filter-btn apply-filter"
                    style="flex: 1; padding: 12px; background-color: #9D4F51; color: white; border: none; border-radius: 10px; font-weight: bold; cursor: pointer;">
                    Apply Filter
                </button>
            </div>
        </form>

        <div class="pet-container">
            @foreach ($products as $index => $product)
                @php
                    $bgClass = match ($index % 4) {
                        0 => 'bg-1',
                        1 => 'bg-2',
                        2 => 'bg-3',
                        default => 'bg-4',
                    };
                    $formattedName = strtolower(str_replace(' ', '-', $product->name));
                    $imageUrl = asset('img/' . $formattedName . '.jpg');
                    $isOutOfStock = $product->quantity <= 0;
                @endphp

                <div class="pet-wrapper">
                    <div class="pet-card {{ $bgClass }}" style="background-image: url('{{ $imageUrl }}');"
                        id="pet-image-{{ $product->id }}">
                        @if($isOutOfStock)
                            <div class="out-of-stock-overlay">
                                <span class="out-of-stock-text">Out of Stock</span>
                            </div>
                        @endif
                    </div>
                    <div class="pet-info-block">
                        <p class="pet-name"><strong>Name:</strong> {{ $product->name }}</p>
                        <p><strong>Price:</strong> {{ $product->price_of_single_product }} EGP</p>
                        <p><strong>Category:</strong> {{ $product->category }}</p>
                        
                        @if($isOutOfStock)
                            <button type="button" class="adopt-btn sold-out-btn" disabled>
                                Sold Out
                            </button>
                        @else
                            <button type="button" class="adopt-btn add-to-cart-btn" data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}" data-product-price="{{ $product->price_of_single_product }}">
                                Add to cart
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

<!-- Professional Quantity Modal -->
<div id="quantityModal">
    <div class="modal-content">
        <button class="close-btn" id="closeBtn">&times;</button>
        
        <div class="modal-header">
            <h2 class="modal-title">Add to Cart</h2>
            <p class="modal-subtitle">Select the quantity you'd like to purchase</p>
        </div>

        <div class="product-info">
            <div class="product-name" id="modalProductName"></div>
            <div class="product-price" id="modalProductPrice"></div>
        </div>

        <div class="quantity-section">
            <div class="quantity-label">Quantity</div>
            <div class="quantity-controls">
                <button class="quantity-btn decrease" id="decreaseQty">−</button>
                <input type="text" class="quantity-input" id="quantityInput" value="1" readonly>
                <button class="quantity-btn increase" id="increaseQty">+</button>
            </div>
        </div>

        <div class="modal-actions">
            <button class="modal-btn btn-cancel" id="cancelBtn">Cancel</button>
            <button class="modal-btn btn-confirm" id="confirmBtn">Add to Cart</button>
        </div>
    </div>
</div>

<style>
/* Sold Out Button Styles */
.sold-out-btn {
    background-color: #666 !important;
    color: #ccc !important;
    cursor: not-allowed !important;
    opacity: 0.6;
}

.sold-out-btn:hover {
    background-color: #666 !important;
    transform: none !important;
}

/* Out of Stock Overlay */
.out-of-stock-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: inherit;
}

.out-of-stock-text {
    color: white;
    font-size: 18px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
}

/* Make pet-card position relative for overlay */
.pet-card {
    position: relative;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('quantityModal');
        const qtyInput = document.getElementById('quantityInput');
        const increaseBtn = document.getElementById('increaseQty');
        const decreaseBtn = document.getElementById('decreaseQty');
        const cancelBtn = document.getElementById('cancelBtn');
        const confirmBtn = document.getElementById('confirmBtn');
        let selectedProductId = null;
        let selectedProductName = '';
        let selectedProductPrice = 0;

        // CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Show modal when "Add to cart" button clicked (only for in-stock items)
        document.querySelectorAll('.add-to-cart-btn:not(.sold-out-btn)').forEach(button => {
            button.addEventListener('click', () => {
                selectedProductId = button.getAttribute('data-product-id');
                selectedProductName = button.getAttribute('data-product-name');
                selectedProductPrice = parseFloat(button.getAttribute('data-product-price'));
                qtyInput.value = 1; // Reset quantity to 1
                
                // Update modal content
                document.getElementById('modalProductName').textContent = selectedProductName;
                document.getElementById('modalProductPrice').textContent = `${selectedProductPrice} EGP`;
                
                // Show modal with animation
                modal.style.display = 'flex';
                setTimeout(() => modal.classList.add('show'), 10);
            });
        });

        // Close button
        document.getElementById('closeBtn').addEventListener('click', () => {
            hideModal();
        });

        // Cancel button closes modal
        cancelBtn.addEventListener('click', () => {
            hideModal();
        });

        // Function to hide modal
        function hideModal() {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
                selectedProductId = null;
                selectedProductName = '';
                selectedProductPrice = 0;
            }, 300);
        }

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target.id === 'quantityModal') {
                hideModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                hideModal();
            }
        });

        // Quantity control functions
        increaseBtn.addEventListener('click', () => {
            let currentQty = parseInt(qtyInput.value, 10);
            qtyInput.value = currentQty + 1;
        });

        decreaseBtn.addEventListener('click', () => {
            let currentQty = parseInt(qtyInput.value, 10);
            if (currentQty > 1) { // Prevent quantity from going below 1
                qtyInput.value = currentQty - 1;
            }
        });

        // Update the confirm button click handler
        confirmBtn.addEventListener('click', () => {
            const quantity = parseInt(qtyInput.value, 10);
            
            // Show loading state
            confirmBtn.classList.add('loading');
            confirmBtn.textContent = 'Adding';

            // Send AJAX request to add item to cart
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: selectedProductId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartCount();
                    showSuccessMessage(data.message);
                    hideModal();
                } else {
                    showErrorMessage(data.message || 'Error adding product to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorMessage('Error adding product to cart');
            })
            .finally(() => {
                // Reset button state
                confirmBtn.classList.remove('loading');
                confirmBtn.textContent = 'Add to Cart';
            });
        });

        // Function to update cart count in navbar
        function updateCartCount() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    const cartButton = document.querySelector('a[href="/cart"] button');
                    if (cartButton && data.count > 0) {
                        // Add cart count badge
                        let badge = cartButton.querySelector('.cart-badge');
                        if (!badge) {
                            badge = document.createElement('span');
                            badge.className = 'cart-badge';
                            badge.style.cssText = `
                                position: absolute;
                                top: -8px;
                                right: -8px;
                                background-color: rgb(131, 83, 88);
                                color: white;
                                border-radius: 50%;
                                width: 20px;
                                height: 20px;
                                font-size: 12px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: bold;
                            `;
                            cartButton.style.position = 'relative';
                            cartButton.appendChild(badge);
                        }
                        badge.textContent = data.count;
                    }
                })
                .catch(error => console.error('Error updating cart count:', error));
        }

        // Function to show success message
        function showSuccessMessage(message) {
            const successDiv = document.createElement('div');
            successDiv.className = 'success-message';
            successDiv.textContent = message;
            document.body.appendChild(successDiv);

            setTimeout(() => {
                successDiv.remove();
            }, 3000);
        }

        // Function to show error message
        function showErrorMessage(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'success-message';
            errorDiv.style.backgroundColor = '#DC3545';
            errorDiv.textContent = message;
            document.body.appendChild(errorDiv);

            setTimeout(() => {
                errorDiv.remove();
            }, 3000);
        }

        // Load cart count on page load
        updateCartCount();
    });
</script>

</body>

</html>