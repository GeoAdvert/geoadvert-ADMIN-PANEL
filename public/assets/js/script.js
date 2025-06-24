
// GeoAdvert JavaScript

document.addEventListener('DOMContentLoaded', function () {
    // Industry buttons functionality
    const industryButtons = document.querySelectorAll('.industry-btn');

    industryButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Remove active class from all buttons
            industryButtons.forEach(btn => btn.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Here you would typically load content based on the selected industry
            // For demo purposes, let's just update the industry title
            const industryTitle = document.querySelector('h2');
            if (industryTitle) {
                industryTitle.textContent = this.textContent;
            }
        });
    });

    // // Mobile menu toggle
    // const menuButton = document.querySelector('.md\\:hidden');
    // const mobileMenu = document.querySelector('.mobile-menu');
    // const closeMenuButton = document.querySelector('.close-menu');

    // if (menuButton && mobileMenu) {
    //     menuButton.addEventListener('click', function () {
    //         mobileMenu.classList.add('active');
    //     });
    // }

    // if (closeMenuButton && mobileMenu) {
    //     closeMenuButton.addEventListener('click', function () {
    //         mobileMenu.classList.remove('active');
    //     });
    // }

    // Form validation
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            let valid = true;
            const requiredFields = form.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            if (!valid) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });
    });

    // Tab navigation
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');

    tabLinks.forEach(link => {
        link.addEventListener('click', function () {
            // Get the tab ID
            const tabId = this.getAttribute('data-tab');

            // Remove active class from all tabs
            tabLinks.forEach(tab => tab.classList.remove('active'));
            tabContents.forEach(content => content.classList.add('hidden'));

            // Add active class to current tab
            this.classList.add('active');
            document.getElementById(tabId).classList.remove('hidden');
        });
    });

    // Password visibility toggle
    const passwordToggles = document.querySelectorAll('.password-toggle');

    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function () {
            const passwordField = this.previousElementSibling;

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>';
            } else {
                passwordField.type = 'password';
                this.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>';
            }
        });
    });

    // Custom dropdown functionality
    const dropdowns = document.querySelectorAll('.custom-dropdown');

    dropdowns.forEach(dropdown => {
        const select = dropdown.querySelector('select');
        const customDropdown = document.createElement('div');
        customDropdown.className = 'relative';

        const selectedOption = document.createElement('div');
        selectedOption.className = 'selected-option flex justify-between items-center border rounded px-3 py-2 cursor-pointer';
        selectedOption.innerHTML = `
            <span>${select.options[select.selectedIndex].text}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        `;

        const optionsList = document.createElement('div');
        optionsList.className = 'options-list absolute w-full bg-white border rounded mt-1 hidden z-10';

        Array.from(select.options).forEach(option => {
            const optionElement = document.createElement('div');
            optionElement.className = 'option px-3 py-2 cursor-pointer hover:bg-gray-100';
            optionElement.textContent = option.text;
            optionElement.dataset.value = option.value;

            optionElement.addEventListener('click', function () {
                select.value = this.dataset.value;
                selectedOption.querySelector('span').textContent = this.textContent;
                optionsList.classList.add('hidden');

                // Trigger change event on the select
                const event = new Event('change', { bubbles: true });
                select.dispatchEvent(event);
            });

            optionsList.appendChild(optionElement);
        });

        selectedOption.addEventListener('click', function () {
            optionsList.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if (!customDropdown.contains(e.target)) {
                optionsList.classList.add('hidden');
            }
        });

        customDropdown.appendChild(selectedOption);
        customDropdown.appendChild(optionsList);

        // Hide the original select
        select.style.display = 'none';
        select.parentNode.insertBefore(customDropdown, select.nextSibling);
    });

    // Handle package selection
    const packageCards = document.querySelectorAll('.package-card');

    packageCards.forEach(card => {
        card.addEventListener('click', function () {
            // Remove selected class from all cards
            packageCards.forEach(c => c.classList.remove('border-pink-500', 'border-2'));

            // Add selected class to clicked card
            this.classList.add('border-pink-500', 'border-2');

            // Optionally, update any price summary or selected package info
            const packageName = this.querySelector('h3').textContent;
            const packagePrice = this.querySelector('.price').textContent;

            const selectedPackageInfo = document.querySelector('.selected-package-info');
            if (selectedPackageInfo) {
                selectedPackageInfo.innerHTML = `
                    <div>Selected Package: <strong>${packageName}</strong></div>
                    <div>Price: <strong>${packagePrice}</strong></div>
                `;
            }
        });
    });

    // Handle quantity input changes
    const quantityInputs = document.querySelectorAll('.quantity-input');

    quantityInputs.forEach(input => {
        input.addEventListener('change', function () {
            const price = parseFloat(this.dataset.price);
            const quantity = parseInt(this.value);
            const total = price * quantity;

            const totalElement = document.querySelector(`#total-${this.dataset.id}`);
            if (totalElement) {
                totalElement.textContent = `PLN ${total.toFixed(2)}`;
            }

            // Update grand total
            updateGrandTotal();
        });
    });

    // Calculate grand total function
    function updateGrandTotal() {
        const totalElements = document.querySelectorAll('[id^="total-"]');
        let grandTotal = 0;

        totalElements.forEach(element => {
            const value = parseFloat(element.textContent.replace('PLN ', ''));
            grandTotal += value;
        });

        const grandTotalElement = document.querySelector('.grand-total');
        if (grandTotalElement) {
            grandTotalElement.textContent = `PLN ${grandTotal.toFixed(2)}`;
        }
    }

    // Initialize any carousels or sliders
    // This would typically use a library like Swiper or Splide
    // For now, we'll just add a placeholder function
    function initializeCarousels() {
        console.log('Carousels initialized');
    }

    initializeCarousels();
    function renderNavbar() {
    const wrapper = document.createElement('div');

    // Dynamically determine the correct path for the logo
    const depth = window.location.pathname.split('/').length - 1;
   const { backPath , customerPanel , logoPath } = window.appRoutes;
                   console.log(backPath,depth);

    wrapper.innerHTML = `
        <!-- Navigation Bar -->
        <nav class="bg-navy-blue py-4">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <a href="${backPath}" class="flex items-center">
                    <div class="w-full h-15">
                        <img src="${logoPath}" alt="Car Icon" class="w-full h-full object-cover">
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex space-x-8">
                    <a href="#services" class="text-white hover:text-pink-500 transition duration-200">Our Services</a>
                    <a href="#buy" class="text-white hover:text-pink-500 transition duration-200">Buy advertising</a>
                    <a href="${customerPanel}" class="text-white hover:text-pink-500 transition duration-200">Customer panel</a>
                    <a href="#contact" class="text-white hover:text-pink-500 transition duration-200">Contact</a>
                </div>
                <div class="flex items-center gap-10">
                    <!-- Consultation Button (Desktop) -->
                    <a href="#consultation" title="Order a Consultation"
                        class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600 transition duration-200 hidden sm:block">
                        Order a Consultation
                    </a>

                    <!-- Mobile Consultation Icon -->
                    <a href="#consultation" title="Order a Consultation"
                        class="bg-pink-500 text-white p-3 rounded-full hover:bg-pink-600 transition duration-200 sm:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M4.00488 16V4H2.00488V2H5.00488C5.55717 2 6.00488 2.44772 6.00488 3V15H18.4433L20.4433 7H8.00488V5H21.7241C22.2764 5 22.7241 5.44772 22.7241 6C22.7241 6.08176 22.7141 6.16322 22.6942 6.24254L20.1942 16.2425C20.083 16.6877 19.683 17 19.2241 17H5.00488C4.4526 17 4.00488 16.5523 4.00488 16ZM6.00488 23C4.90031 23 4.00488 22.1046 4.00488 21C4.00488 19.8954 4.90031 19 6.00488 19C7.10945 19 8.00488 19.8954 8.00488 21C8.00488 22.1046 7.10945 23 6.00488 23ZM18.0049 23C16.9003 23 16.0049 22.1046 16.0049 21C16.0049 19.8954 16.9003 19 18.0049 19C19.1095 19 20.0049 19.8954 20.0049 21C20.0049 22.1046 19.1095 23 18.0049 23Z"></path></svg>
                    </a>

                    <!-- Mobile Hamburger Button -->
                    <button id="nav-toggle" class="lg:hidden text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden hidden px-4 py-5 mt-2 space-y-2 text-center">
                <a href="#services" class="block text-white hover:text-pink-500">Our Services</a>
                <hr>
                <a href="#buy" class="block text-white hover:text-pink-500">Buy advertising</a>
                <hr>
                <a href="${customerPanel}" class="block text-white hover:text-pink-500">Customer panel</a>
                <hr>
                <a href="#contact" class="block text-white hover:text-pink-500">Contact</a>
            </div>
        </nav>
    `;

    return wrapper.firstElementChild;
}

    const navbar = renderNavbar();
    document.body.prepend(navbar);

    const toggleBtn = document.getElementById('nav-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    toggleBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });


    // For Dropdown Js
    const dropdownButtons = document.querySelectorAll("[data-dropdown-toggle]");

    dropdownButtons.forEach(button => {
      const menuId = button.getAttribute("data-dropdown-toggle");
      const menu = document.getElementById(menuId);

      // Toggle dropdown on button click
      button.addEventListener("click", (e) => {
        e.stopPropagation();
        menu.classList.toggle("hidden");
      });

      // Close dropdown if clicked outside
      window.addEventListener("click", (e) => {
        if (!button.contains(e.target) && !menu.contains(e.target)) {
          menu.classList.add("hidden");
        }
      });
    });
});
