<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .pet-card {
            display: flex;
            height: 479px;
            padding: 16px 16px 413px 331px;
            flex-direction: column;
            align-items: center;
            align-self: stretch;
            border-radius: 20px;
            border: 1px solid var(--Light-Pink-100, #322B2B);
            background-size: cover;
            background-repeat: no-repeat;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Pet Adoption Center</h1>
    </header>

    <main>
        @include('components.navbar')
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025</p>
    </footer>
</body>
</html>
