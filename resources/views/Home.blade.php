<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
  @include('components.navbar')

<main>
  <section class="circle-bg-wrapperr">
     <div class="circle-bg">
    <div class="hero-content">
      <div class="hero-image-container">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/ee2fedc08977b213d8511b6db6ee7f7abf0d3826" alt="Happy Dog" class="hero-image" />
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/b294c9cc15f8d6b09df24f2d1b14d04ca42d05ba" alt="Paw Print" class="paw paw-1" />
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/b294c9cc15f8d6b09df24f2d1b14d04ca42d05ba" alt="Paw Print" class="paw paw-2" />
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/b294c9cc15f8d6b09df24f2d1b14d04ca42d05ba" alt="Paw Print" class="paw paw-3" />
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/b294c9cc15f8d6b09df24f2d1b14d04ca42d05ba" alt="Paw Print" class="paw paw-4" />
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/b294c9cc15f8d6b09df24f2d1b14d04ca42d05ba" alt="Paw Print" class="paw paw-5" />
      </div>
      <div class="hero-text">
        <h2 class="hero-title">Connecting love, one paw at a time</h2>
        <div class="hero-features">
          <p class="feature">
            <strong>Find Your Perfect Pet:</strong>
            <br />
            Browse lovable dogs, cats, and more—each with photos and personality details.
          </p>
          <p class="feature">
            <strong>Pet Care:</strong>
            <br />
            Book vet visits and take care of your loved ones.
          </p>
          <p class="feature">
            <strong>Everything Pets Need:</strong>
            <br />
            Shop food, toys, and supplies—all in one place.
          </p>
        </div>
     <div class="hero-actions">
  <button class="btn btn-primary" onclick="window.location.href='/pets'">Adopt Pet</button>
  <button class="btn btn-primary" onclick="window.location.href='/products'">Shop Supplies</button>
  <button class="btn btn-primary" onclick="window.location.href='/vet'">Book Vet</button>
</div>


      </div>
    </div>
</div>
  </section>

  <section class="products">
    <article class="product-card carrier" style="background-image: url('{{ asset('img/img1.png') }}'); background-size: cover; background-position: center;">
      <h3 class="product-title">Safe Pet Carrier</h3>
      <div class="product-features">
        <p><strong>Secure</strong> – Escape-proof locks & ventilation</p>
        <p><strong>Airline Approved</strong> – Fits under seats</p>
        <p><strong>Easy-Clean</strong> – Washable pad & waterproof base</p>
        <p><strong>Travel-Ready</strong> – Seatbelt straps & storage</p>
      </div>
      <button class="btn btn-secondary" onclick="window.location.href='/products'">Shop Now</button>
           

    </article>

    
        <article class="product-card birds" style="background-image: url('{{ asset('img/img4.png') }}'); background-size: cover; background-position: center;">

      <h3 class="product-title">Love Birds</h3>
      <div class="product-content">
        <p class="discount">Get 10% discount</p>
        <p class="description">Bring home a sweet, chirpy duo</p>
        <p class="description">of lovebirds and fill your life</p>
        <p class="description">with joy and melody!</p>

      </div>
      <button class="btn btn-sec" onclick="window.location.href='/pets'">Shop Now</button>
               

    </article>

    <div class="product-grid">
      <article class="product-card food" style="background-image: url('{{ asset('img/img2.png') }}'); background-size: cover; background-position: center;">
        <div class="product-content">
          <h3 class="product-title">Pet Food Supplies</h3>
          <div class="product-features">
            <p><strong>Nutrient-Rich Recipes</strong> – Vet-approved, made with real meat & veggies</p>
            <p><strong>No Fillers</strong> – Zero artificial flavors,</p>
            <p> colors, or preservatives</p>
            
          </div>
    
          <button class="btn btn-accent" onclick="window.location.href='/products'">Shop Now</button>

        </div>
      </article>

      <article class="product-card clothing" style="background-image: url('{{ asset('img/img3.png') }}'); background-size: cover; background-position: center;">
        <div class="product-content">
          <h3 class="product-title">Puppy Clothing</h3>
          <div class="product-features">
            <p><strong>Ultra-Soft Fabrics</strong> –</p>
            <p> Gentle on fur, perfect for</p>
            <p> sensitive skin</p>

            <p><strong>Adorable Designs</strong> – From</p>
                        <p> hoodies to holiday sweaters</p>

          </div>
          <button class="btn btn-accent2" onclick="window.location.href='/pets'">Shop Now</button>
          
        </div>
      </article>
    </div>
  </section>

  <section class="services">
    <div class="services-header">
      <h2 class="section-title">Our Services</h2>
      <p class="section-description">
        At PetLink, we go beyond adoption to support every step of your pet parenting journey.
        Our all-in-one care services ensure your companion stays happy, healthy, and loved for life.
      </p>
    </div>

    <div class="services-grid">
      <article class="service-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/b83e01e44bd3b61fae7e3c5b9297fcee5beaa032" alt="Adoption icon" class="service-icon" />
        <div class="service-content">
          <h3 class="service-title">Adoption Made Easy</h3>
          <p class="service-description">
            Meet vetted pets (dogs, cats & more) with transparent health/behavior profiles
            <br />
            Paperless applications + virtual home checks
          </p>
        </div>
      </article>

      <article class="service-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/9677c097f7a9216a18ef12b55f2fc6faec2082dd" alt="Pet supplies icon" class="service-icon" />
        <div class="service-content">
          <h3 class="service-title">Premium Pet Supplies</h3>
          <p class="service-description">
            Quality food & treats
            <br />
            Toys, beds & accessories
            <br />
            Auto-delivery options
          </p>
        </div>
      </article>

      <article class="service-card">
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/babc729ade1ef63109e69089040d26214f27a30a" alt="Veterinary care icon" class="service-icon" />
        <div class="service-content">
          <h3 class="service-title">Veterinary Care</h3>
          <p class="service-description">
            Routine check-ups & vaccinations
            <br />
            Emergency appointments
            <br />
            Specialist referrals
          </p>
        </div>
      </article>
    </div>
  </section>

  <section class="faq">
    <div class="faq-content">
      <div class="faq-header">
        <h2 class="section-title">Frequently Asked Questions</h2>
      </div>
      <div class="faq-list">
        <details class="faq-item active">
          <summary class="faq-question">
            What is good food for cats?
            <span class="faq-icon check"></span>
          </summary>
          <p class="faq-answer">
            Ideal cat food is high in animal protein (like chicken or salmon), low in carbs, and includes essential taurine.
            Wet food helps hydration while dry food offers convenience - many vets recommend mixing both. Choose AAFCO-approved
            brands (like Hill's or Royal Canin) and avoid fillers like corn. Adjust for life stages: kittens need more protein,
            seniors benefit from joint support. Always transition foods gradually and never feed toxic human foods. The best diet
            keeps your cat's coat shiny and energy levels stable.
          </p>
        </details>

        <details class="faq-item">
          <summary class="faq-question">
            What is the process of adoption?
            <span class="faq-icon check"></span>
          </summary>
           <p class="faq-answer">
           1. Browse Pets: View profiles online or in-person to find your match.<br>
          2. Apply & Meet: Submit a quick application, then schedule a meet-and-greet.<br>
          3. Get Approved: Our team reviews your application (1-2 days) for final approval.<br>
          4. Take Them Home: Sign paperwork, pay the fee, and start your adventure together!<br>
          </p>
        </details>

        <details class="faq-item">
          <summary class="faq-question">
            How do I book an appointment with a veteran?
            <span class="faq-icon check"></span>
          </summary>
           <p class="faq-answer">
            Log in, go to " "Book Appointment".<br>
Select visit type, vet, and available slot.<br>
Confirm details and finalize booking.<br>
Urgent? Call clinics directly for faster help<br>
          </p>
        </details>
      </div>
    </div>
    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/4adbfb60038f149630ba3a13a9999a879a9ecbec" alt="A happy dog with its owner" class="faq-image" />
  </section>
</main>


</body>
</html>