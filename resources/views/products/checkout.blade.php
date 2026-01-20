<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <title>Checkout - PetLink</title>
    <link rel="stylesheet" href="{{ asset('css/stylesCheckout.css') }}">
    <style>
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }
        
        .success-message, .error-message {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            z-index: 1000;
            animation: slideIn 0.3s ease;
        }
        
        .success-message {
            background-color: #4CAF50;
            color: white;
        }
        
        .error-message {
            background-color: #DC3545;
            color: white;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
    </style>
</head>
<body>
@include('components.navbar')

<div class="circle-bg-wrapperrr">
    <div class="circle-bgg"></div>
    <img src="{{ asset('img/cat.png') }}" class="cat" alt="Cat" />
    <img src="{{ asset('img/dog.png') }}" class="dog" alt="Dog" />
    <div class="title-wrapper">
        <div class="title">Checkout</div>
    </div> 
</div>

<main class="main-content">
    <form class="checkout-form" id="checkout-form">
        @csrf

        <!-- Delivery Section -->
        <section class="delivery-section">
            <h2 class="section-title">Delivery</h2>

            <div class="address-input">
                <input type="text" name="address" placeholder="Address" class="input-field" required />
                <button type="button" class="search-button" aria-label="Search address">
                    <svg class="search-icon" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.5 21.5C16.7467 21.5 21 17.2467 21 12C21 6.75329 16.7467 2.5 11.5 2.5C6.25329 2.5 2 6.75329 2 12C2 17.2467 6.25329 21.5 11.5 21.5Z" stroke="#7C6B6C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M22 22.5L20 20.5" stroke="#7C6B6C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <div class="location-inputs">
                <input type="text" name="city" placeholder="City" class="input-field" required />
                <input type="text" name="zip" placeholder="ZIP code" class="input-field" required />
            </div>

            <label class="save-info">
                <input type="checkbox" name="save_info" class="checkbox" />
                <span>Save this information for next time</span>
            </label>
        </section>

        <!-- Payment Section -->
        <section class="payment-section">
            <h2 class="section-title">Payment</h2>
            <p class="security-note">All transactions are secure and encrypted</p>

            <div class="payment-method">
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="cash" checked hidden>
                    <span class="payment-label">Cash On Delivery</span>
                    <svg class="money-icon" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2.5C17.5228 2.5 22 6.97715 22 12.5C22 18.0228 17.5228 22.5 12 22.5C6.47715 22.5 2 18.0228 2 12.5C2 6.97715 6.47715 2.5 12 2.5Z" stroke="#7C6B6C" stroke-width="1.5"/>
                        <path d="M12 7.5V17.5M8 12.5H16" stroke="#7C6B6C" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </label>
            </div>
        </section>

        <!-- Pay Button -->
        <button type="submit" class="pay-button">Pay Now</button>
    </form>
</main>

<!-- Dialog -->
<div id="confirmation-dialog" class="dialog-overlay" style="display: none;">
    <div class="dialog-box">
        <button class="close-dialog" onclick="closeDialog()">✕</button>
        <h2 class="dialog-title">Order Confirmed! Your Pet's Goodies Are on the Way!</h2>
        <p class="dialog-subtitle">Thank you for shopping with PetLink!</p>
        <img src="{{ asset('img/logo2.png') }}" alt="Confirmation" class="dialog-image" />
        <div style="margin-top: 20px;">
            <button onclick="goToHome()" style="background: #9D4F51; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; margin-right: 10px;">Go to Home</button>
            <button onclick="closeDialog()" style="background: #6c757d; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer;">Close</button>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        const payButton = form.querySelector('.pay-button');
        
        // Show loading state
        payButton.textContent = 'Processing...';
        payButton.disabled = true;
        form.classList.add('loading');
        
        // Convert FormData to JSON
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });
        
        fetch('/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage(data.message, 'success');
                openDialog();
                // Clear the form
                form.reset();
            } else {
                showMessage(data.message || 'Failed to place order', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Failed to place order. Please try again.', 'error');
        })
        .finally(() => {
            // Reset button state
            payButton.textContent = 'Pay Now';
            payButton.disabled = false;
            form.classList.remove('loading');
        });
    });

    function openDialog() {
        document.getElementById('confirmation-dialog').style.display = 'flex';
    }

    function closeDialog() {
        document.getElementById('confirmation-dialog').style.display = 'none';
    }
    
    function goToHome() {
        window.location.href = '/home';
    }
    
    function showMessage(message, type = 'success') {
        const messageDiv = document.createElement('div');
        messageDiv.className = type === 'success' ? 'success-message' : 'error-message';
        messageDiv.textContent = message;
        document.body.appendChild(messageDiv);

        setTimeout(() => {
            messageDiv.remove();
        }, 5000);
    }
</script>

</body>
</html>