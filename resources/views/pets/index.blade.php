<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <title>Pet Adoption</title>
    <link rel="stylesheet" href="{{ asset('css/stylesPet.css') }}">
</head>
<body>
@include('components.navbar')
<div class="circle-bg-wrapper">
    <div class="circle-bg"></div>
    <img src="{{ asset('img/cat.png') }}" class="cat" alt="Cat" />
    <img src="{{ asset('img/dog.png') }}" class="dog" alt="Dog" />

    <div class="title-wrapper">
        <div class="title">Adopt</div>
        <div class="subtitle">Meet Our Adorable Pets Looking for Forever Homes</div>
    </div>
</div>

<!-- Main content container for filter and pets -->
<div class="main-content">
    <form method="GET" action="{{ route('pets.index') }}" class="filter-box">
        <!-- Logo and Discover -->
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; width: 100%;">
            <img src="{{ asset('img/logo.png') }}" width="64" height="64" alt="Logo" />
            <h1 style="font-size: 60px; color: #322B2B; font-family: Inter; font-weight: 600; margin: 0;">Discover</h1>
        </div>

        <!-- Species Filter -->
        <div style="width: 100%;">
            <h3 style="margin: 0; font-family: Inter, sans-serif;">Species</h3>
            <hr style="width: 100%; border: 1px solid #322B2B; margin: 8px 0;" />
            <label><input type="checkbox" name="species[]" value="cat" @if(request()->has('species') && in_array('cat', request('species'))) checked @endif> Cat</label><br>
            <label><input type="checkbox" name="species[]" value="dog" @if(request()->has('species') && in_array('dog', request('species'))) checked @endif> Dog</label><br>
            <label><input type="checkbox" name="species[]" value="bird" @if(request()->has('species') && in_array('bird', request('species'))) checked @endif> Bird</label><br>
            <label><input type="checkbox" name="species[]" value="turtle" @if(request()->has('species') && in_array('turtle', request('species'))) checked @endif> Turtle</label><br>
            <label><input type="checkbox" name="species[]" value="parrot" @if(request()->has('species') && in_array('parrot', request('species'))) checked @endif> Parrot</label><br>
            <label><input type="checkbox" name="species[]" value="fish" @if(request()->has('species') && in_array('fish', request('species'))) checked @endif> Fish</label>
        </div>

        <!-- Gender Filter -->
        <div style="width: 100%;">
            <h3 style="margin: 0; font-family: Inter, sans-serif;">Gender</h3>
            <hr style="width: 100%; border: 1px solid #322B2B; margin: 8px 0;" />
            <label><input type="checkbox" name="gender[]" value="male" @if(request()->has('gender') && in_array('male', request('gender'))) checked @endif> Male</label><br>
            <label><input type="checkbox" name="gender[]" value="female" @if(request()->has('gender') && in_array('female', request('gender'))) checked @endif> Female</label>
        </div>

        <!-- Age Filter -->
        <div style="width: 100%;">
            <h3 style="margin: 0; font-family: Inter, sans-serif;">Age</h3>
            <hr style="width: 100%; border: 1px solid #322B2B; margin: 8px 0;" />
            <label><input type="checkbox" name="age[]" value="<2" @if(request()->has('age') && in_array('<2', request('age'))) checked @endif> &lt;2 years</label><br>
            <label><input type="checkbox" name="age[]" value="2-4" @if(request()->has('age') && in_array('2-4', request('age'))) checked @endif> 2–4 years</label><br>
            <label><input type="checkbox" name="age[]" value="5-10" @if(request()->has('age') && in_array('5-10', request('age'))) checked @endif> 5–10 years</label><br>
            <label><input type="checkbox" name="age[]" value="11-15" @if(request()->has('age') && in_array('11-15', request('age'))) checked @endif> 11–15 years</label>
        </div>

        <!-- Buttons -->
        <div style="width: 100%; display: flex; gap: 16px;">
            <button id="reset-button" class="filter-btn reset-filter" type="button" style="flex: 1; padding: 12px; background-color: #CCCCCC; border: none; border-radius: 10px; font-weight: bold; cursor: pointer;">
                Reset Filter
            </button>
            <button type="submit" class="filter-btn apply-filter" style="flex: 1; padding: 12px; background-color: #9D4F51; color: white; border: none; border-radius: 10px; font-weight: bold; cursor: pointer;">
                Apply Filter
            </button>
        </div>
    </form>

    <!-- Pet cards -->
    <div class="pet-grid">
        <div class="pet-container">
            @foreach ($pets as $index => $pet)
                @php
                    $bgClass = match($index % 4) {
                        0 => 'bg-1',
                        1 => 'bg-2',
                        2 => 'bg-3',
                        default => 'bg-4',
                    };
                    $imageUrl = asset('img/' . $pet->name . '.jpg');
                @endphp

                <div class="pet-wrapper">
                    <div class="pet-card {{ $bgClass }}" 
                         style="background-image: url('{{ $imageUrl }}'); 
                         {{ in_array($pet->id, $adoptedPetIds) ? 'opacity: 0.25;' : '' }}" 
                         id="pet-image-{{ $pet->id }}">
                    </div>

                    <div class="pet-info-block">
                        <p class="pet-name"><strong>Name:</strong> {{ $pet->name }}</p>
                        <p><strong>Breed:</strong> {{ $pet->breed }}</p>
                        <p><strong>Gender:</strong> {{ $pet->gender }}</p>
                        <p><strong>Age:</strong> {{ $pet->age }}</p>
                        <p><strong>Medical History:</strong> {{ $pet->medical_history }}</p>
                        @if (in_array($pet->id, $userAdoptedPetIds))
                            <p class="adopt-status user-adopted">You adopted this pet</p>
                        @elseif (in_array($pet->id, $adoptedPetIds))
                            <p class="adopt-status already-adopted">Already adopted</p>
                        @else
                            <button class="adopt-btn" data-pet-id="{{ $pet->id }}" data-pet-name="{{ $pet->name }}">Adopt Me</button>
                        @endif
                    </div>

                    <!-- Confirmation Dialog (hidden by default) -->
                    <div class="adopt-confirmation-container" id="adopt-confirmation-{{ $pet->id }}">
                        <p>Are you sure you want to adopt {{ $pet->name }}?</p>
                        <button class="adopt-confirmation-yes" data-pet-id="{{ $pet->id }}" data-pet-name="{{ $pet->name }}">Yes</button>
                        <button class="adopt-confirmation-no" data-pet-id="{{ $pet->id }}">No</button>
                    </div>
                </div>

                @if (($index + 1) % 4 == 0)
                    </div><div class="pet-container">
                @endif
            @endforeach
        </div>
    </div>
</div>

<style>
.filter-box input[type="checkbox"] {
    accent-color: #9D4F51;
}

/* Main content container for side-by-side layout */
.main-content {
    display: flex;
    gap: 40px;
    padding: 40px;
    align-items: flex-start;
    max-width: 1400px;
    margin: 0 auto;
}

/* Override filter box positioning */
.filter-box {
    width: 450px !important;
    padding: 40px !important;
    background-color: #F8D6D8 !important;
    border-radius: 25px !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 40px !important;
    justify-content: center !important;
    align-items: flex-start !important;
    flex-shrink: 0;
    margin-top: 0 !important;
}

/* Override pet container positioning */
.pet-container {
    width: 700px !important;
    display: flex !important;
    flex-wrap: wrap !important;
    gap: 24px !important;
    justify-content: flex-start !important;
    position: static !important;
    top: auto !important;
    left: auto !important;
}

/* Responsive design */
@media (max-width: 1200px) {
    .main-content {
        flex-direction: column;
        align-items: center;
    }
    
    .pet-container {
        width: 100% !important;
        justify-content: center !important;
    }
    
    .filter-box {
        width: 100% !important;
        max-width: 450px !important;
    }
}
</style>

<script>
    document.getElementById('reset-button').addEventListener('click', () => {
        // Select all checkboxes inside the form with class filter-box
        const checkboxes = document.querySelectorAll('.filter-box input[type="checkbox"]');
        
        // Uncheck each checkbox
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        // Optionally, submit the form without filters to reload empty results:
        // document.querySelector('.filter-box').submit();
    });
</script>

<!-- Adoption details dialog -->
<div id="adoption-details-dialog">
    <div class="dialog-content" style="background-color: #FEF7F7;">
        <h2 id="adoption-details-title"></h2>
        <img src="{{ asset('img/logo2.png') }}" alt="Logo" class="dialog-logo" />
        <div class="dialog-text">
            <p>Next Steps:</p>
            <p><strong>Pick-Up Location:</strong> PetLink Shelter 5 Fawzi Moaz Street Alexandria, Egypt</p>
            <p><strong>Pick-Up Date/Time:</strong> 30/5/2025 12:00 pm (Please arrive on time!)</p>
            <p><strong>What To Bring:</strong></p>
            <ul>
                <li>A valid photo ID</li>
                <li>A secure carrier (for cats/small pets) or leash &amp; collar (for dogs)</li>
                <li>Your adoption screenshot (please take a screenshot for this adoption confimation)</li>
            </ul>
        </div>
        <button id="close-adoption-details-btn">Close</button>
    </div>
</div>

<script>
    document.querySelectorAll('.adopt-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const petId = btn.getAttribute('data-pet-id');
            const confirmationBox = document.getElementById(`adopt-confirmation-${petId}`);
            btn.style.display = 'none';
            confirmationBox.style.display = 'block';
        });
    });

    document.querySelectorAll('.adopt-confirmation-yes').forEach(yesBtn => {
        yesBtn.addEventListener('click', () => {
            const petId = yesBtn.getAttribute('data-pet-id');
            const petName = yesBtn.getAttribute('data-pet-name');
            const petImage = document.getElementById(`pet-image-${petId}`);
            const confirmationContainer = document.getElementById(`adopt-confirmation-${petId}`);
            const adoptBtn = document.querySelector(`button.adopt-btn[data-pet-id='${petId}']`);

            fetch('/adopt', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    pet_id: petId,
                    date: new Date().toISOString().split('T')[0]
                })
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to adopt pet.');
                return response.json();
            })
            .then(data => {
                // Mark adopted visually
                petImage.classList.add('adopted');
                adoptBtn.textContent = 'Adopted';
                adoptBtn.classList.add('adopted');
                adoptBtn.disabled = true;

                // Hide confirmation container
                confirmationContainer.style.display = 'none';
                adoptBtn.style.display = 'block';

                // Show the adoption details dialog
                const detailsDialog = document.getElementById('adoption-details-dialog');
                const detailsTitle = document.getElementById('adoption-details-title');
                detailsTitle.textContent = `${petName} Is Officially Yours`;
                detailsDialog.style.display = 'flex';
            })
            .catch(error => {
                alert('There was an error processing the adoption. Please try again.');
                console.error(error);
            });
        });
    });

    // Close adoption details dialog button handler
    document.getElementById('close-adoption-details-btn').addEventListener('click', () => {
        document.getElementById('adoption-details-dialog').style.display = 'none';
    });

    document.querySelectorAll('.adopt-confirmation-no').forEach(noBtn => {
        noBtn.addEventListener('click', () => {
            const petId = noBtn.getAttribute('data-pet-id');
            const confirmationContainer = document.getElementById(`adopt-confirmation-${petId}`);
            const adoptBtn = document.querySelector(`button.adopt-btn[data-pet-id='${petId}']`);

            // Hide confirmation container and show adopt button again
            confirmationContainer.style.display = 'none';
            adoptBtn.style.display = 'block';
        });
    });
</script>

</body>
</html>