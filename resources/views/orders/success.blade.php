<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - PetLink</title>
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
</head>
<body>
    @include('components.navbar')
    
    <div style="text-align: center; padding: 100px 20px;">
        <h1 style="color: #9D4F51; font-size: 32px; margin-bottom: 16px;">Order Placed Successfully!</h1>
        <p style="font-size: 18px; color: #666; margin-bottom: 32px;">Thank you for your order. Your pet's goodies are on the way!</p>
        <a href="{{ route('products.index') }}" style="background: #9D4F51; color: white; padding: 16px 32px; border-radius: 12px; text-decoration: none; font-weight: 600;">Continue Shopping</a>
    </div>
</body>
</html>