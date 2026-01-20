  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
  </head>
  <body>
    <nav class="navbar">
  <div class="navbar-content">
    <div class="brand">
      <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/ee562b85bf9ce729a2b8fd7f38d0dbd8b94f14b1" alt="PetLink Logo" class="logo" />
      <h1 class="brand-name">PetLink</h1>
    </div>
    <ul class="nav-links">
      <li><a href="/home" class="nav-link">Home</a></li>
      <li><a href="/pets" class="nav-link">Adopt</a></li>
      <li><a href="/products" class="nav-link">Shop Supplies</a></li>
      <li><a href="#" class="nav-link">Book Vet</a></li>
      <li><a href="#" class="nav-link">Contact Us</a></li>
    </ul>
    <div class="nav-actions">
      <button class="icon-button" aria-label="Search">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" stroke="#322B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M22 22L20 20" stroke="#322B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </button>
      <button class="icon-button" aria-label="Favorites">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12.62 20.81C12.28 20.93 11.72 20.93 11.38 20.81C8.48 19.82 2 15.69 2 8.69C2 5.6 4.49 3.1 7.56 3.1C9.38 3.1 10.99 3.98 12 5.34C13.01 3.98 14.63 3.1 16.44 3.1C19.51 3.1 22 5.6 22 8.69C22 15.69 15.52 19.82 12.62 20.81Z" stroke="#322B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </button>
      <a href="/cart" aria-label="Shopping Cart">
      <button class="icon-button" aria-label="Shopping Cart">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M7.5 7.67V6.7C7.5 4.45 9.31 2.24 11.56 2.03C14.24 1.77 16.5 3.88 16.5 6.51V7.89" stroke="#322B2B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M8.99995 22H14.9999C19.0199 22 19.7399 20.39 19.9499 18.43L20.6999 12.43C20.9699 9.99 20.2699 8 15.9999 8H7.99995C3.72995 8 3.02995 9.99 3.29995 12.43L4.04995 18.43C4.25995 20.39 4.97995 22 8.99995 22Z" stroke="#322B2B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M15.4955 12H15.5045" stroke="#322B2B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M8.49451 12H8.50349" stroke="#322B2B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </button></a>
      <button class="icon-button" aria-label="Profile">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12.12 12.78C12.05 12.77 11.96 12.77 11.88 12.78C10.12 12.72 8.71997 11.28 8.71997 9.51C8.71997 7.7 10.18 6.23 12 6.23C13.81 6.23 15.28 7.7 15.28 9.51C15.27 11.28 13.88 12.72 12.12 12.78Z" stroke="#322B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M18.74 19.38C16.96 21.01 14.6 22 12 22C9.40001 22 7.04001 21.01 5.26001 19.38C5.36001 18.44 5.96001 17.52 7.03001 16.8C9.77001 14.98 14.25 14.98 16.97 16.8C18.04 17.52 18.64 18.44 18.74 19.38Z" stroke="#322B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#322B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </button>
      <form method="POST" action="{{ route('logout') }}">
  @csrf
  <button class="icon-button" type="submit" aria-label="Logout" title="Logout">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M16 17L21 12L16 7" stroke="#322B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M21 12H9" stroke="#322B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M12 2H5C3.89543 2 3 2.89543 3 4V20C3 21.1046 3.89543 22 5 22H12" stroke="#322B2B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </button>
</form>

    </div>
  </div>
</nav>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach(link => {
      // Highlight based on current URL (for reload support)
      if (link.getAttribute("href") === window.location.pathname) {
        link.classList.add("active");
      }

      link.addEventListener("click", function () {
        // Remove 'active' from all links
        navLinks.forEach(l => l.classList.remove("active"));

        // Add 'active' to clicked link
        this.classList.add("active");
      });
    });
  });
</script>

  </body>
  </html>

