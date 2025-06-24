@section('title', 'Add Tablets')

<x-app-layout>

    <div class="pt-7">
        <div class="mb-6">
            <a href="{{ route('dashboard') }}" class="rounded-[6px] bg-[#228B22]  px-[1.1rem] py-3">
                <i class="fa fa-chevron-left text-white text-[18px]" aria-hidden="true"></i>

            </a>
        </div>




        <div class="tabs-container f-inter mt-20">
            <div class="bg-[#F7F7F7] lg:w-[28rem] rounded-[2px]">
                <nav class="tabs flex flex-col flex-wrap sm:flex-row justify-between">
                    <a href="{{ route('dashboard') }}"
                        class="tab active bg-[#228B22] text-white font-[500] texy-[14px] py-2 px-4 block flex items-center gap-[10px] rounded-[4px]">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="30" height="30" fill="url(#pattern0_16_946)" />
                            <defs>
                                <pattern id="pattern0_16_946" patternContentUnits="objectBoundingBox" width="1"
                                    height="1">
                                    <use xlink:href="#image0_16_946" transform="scale(0.01)" />
                                </pattern>
                                <image id="image0_16_946" width="100" height="100"
                                    xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAABW0lEQVR4nO3dsU3DQACF4eyBwjqZgC7ZhR2SMATTAMokhP4hJNMgQC6i6PnyfdL1Pv86n92cVysAAAAAAIAbk2ST5MHINe7BZk6QU7iWkyBdBCkjSBlByghSRpAygowY5PEyn6DjS/IoSBFByghSRpAygpQRpIwgZQQpI0gZQcoIUkaQMoKUEaSMIGUEKSNIGUHKCFJGkDKClBGkjCBlBCkjSBlByghSRpAygpQRpIwgZQQpI0gZQcoIUkaQMoKUEaSMIGUEudEgz06by9wT456vEYTLEaSMIGWGC/KeZJ9kO41DknOWY6ggL0nufrn+dZLXLMMwQd5/i/EjyhJWyjBB9jPmcUy/YYJsZ8xjl36ClBkmyGHGPJ7Sb5gg56+N+5853Cf5SL9hgmR6tV3/EeMtyzBUkO+Vcpw28N30mFrCyhg2yNIJUkaQJQbxy6MU/fIIAAAAAABgNZZPGyddpyy/Vg0AAAAASUVORK5CYII=" />
                            </defs>
                        </svg>


                        Module Tablets
                    </a>
                    <a href="{{ route('adsmanagement') }}"
                        class="tab text-[#228B22] font-[500] texy-[14px] py-2 px-4 block flex items-center gap-[10px] rounded-[4px]">
                        <svg width="34" height="34" viewBox="0 0 34 34" fill="none"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="34" height="34" fill="url(#pattern0_16_953)" />
                            <defs>
                                <pattern id="pattern0_16_953" patternContentUnits="objectBoundingBox" width="1"
                                    height="1">
                                    <use xlink:href="#image0_16_953" transform="scale(0.01)" />
                                </pattern>
                                <image id="image0_16_953" width="100" height="100"
                                    xlink:href="data:image/png;base64,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" />
                            </defs>
                        </svg>

                        Ads Management
                    </a>

                </nav>
            </div>

            <div
                class="container hidden lg:flex gap-[20px] justify-between items-center mt-[-9.5rem] mx-auto h-full text-[#228B22] md:justify-end bg-transparent py-3">

                <img class="w-[5rem] hidden lg:block h-[5rem] rounded-full object-cover border border-[#228B22]"
                    src="{{ asset('storage/img/admin.jpg') }}" alt="">
                <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                    @click="toggleSideMenu" aria-label="Menu">
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <div class=md:hidden>

                    <svg width="168" height="38" viewBox="0 0 168 38" fill="none"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M42.176 31L46.368 19.08H48.704L52.896 31H50.88L49.968 28.328H45.12L44.192 31H42.176ZM45.664 26.648H49.392L47.28 20.408H47.808L45.664 26.648ZM54.9501 31V19.08H58.8541C60.0915 19.08 61.1635 19.3307 62.0701 19.832C62.9875 20.3227 63.6968 21.016 64.1981 21.912C64.6995 22.808 64.9501 23.848 64.9501 25.032C64.9501 26.2053 64.6995 27.2453 64.1981 28.152C63.6968 29.048 62.9875 29.7467 62.0701 30.248C61.1635 30.7493 60.0915 31 58.8541 31H54.9501ZM56.8381 29.32H58.8861C59.7288 29.32 60.4595 29.144 61.0781 28.792C61.7075 28.44 62.1928 27.944 62.5341 27.304C62.8755 26.664 63.0461 25.9067 63.0461 25.032C63.0461 24.1573 62.8701 23.4053 62.5181 22.776C62.1768 22.136 61.6968 21.64 61.0781 21.288C60.4595 20.936 59.7288 20.76 58.8861 20.76H56.8381V29.32ZM67.4495 31V19.08H69.2095L73.6895 25.288H72.8095L77.2095 19.08H78.9695V31H77.0975V21.304L77.8015 21.496L73.3055 27.64H73.1135L68.7135 21.496L69.3375 21.304V31H67.4495ZM82.0739 31V19.08H83.9619V31H82.0739ZM87.0733 31V19.08H88.5933L95.2813 28.312L94.5613 28.424V19.08H96.4333V31H94.9133L88.2733 21.704L88.9613 21.576V31H87.0733ZM102.978 31V19.08H107.314C108.114 19.08 108.818 19.2293 109.426 19.528C110.045 19.816 110.525 20.2427 110.866 20.808C111.208 21.3627 111.378 22.0293 111.378 22.808C111.378 23.576 111.202 24.2373 110.85 24.792C110.509 25.3467 110.034 25.7733 109.426 26.072C108.818 26.3707 108.114 26.52 107.314 26.52H104.866V31H102.978ZM104.866 24.84H107.362C107.789 24.84 108.162 24.7547 108.482 24.584C108.802 24.4133 109.053 24.1787 109.234 23.88C109.416 23.5707 109.506 23.208 109.506 22.792C109.506 22.376 109.416 22.0187 109.234 21.72C109.053 21.4107 108.802 21.176 108.482 21.016C108.162 20.8453 107.789 20.76 107.362 20.76H104.866V24.84ZM111.953 31L116.145 19.08H118.481L122.673 31H120.657L119.745 28.328H114.897L113.969 31H111.953ZM115.441 26.648H119.169L117.057 20.408H117.585L115.441 26.648ZM124.727 31V19.08H126.247L132.935 28.312L132.215 28.424V19.08H134.087V31H132.567L125.927 21.704L126.615 21.576V31H124.727ZM137.195 31V19.08H138.715L145.403 28.312L144.683 28.424V19.08H146.555V31H145.035L138.395 21.704L139.083 21.576V31H137.195ZM149.663 31V19.08H157.519V20.76H151.551V24.184H157.199V25.864H151.551V29.32H157.519V31H149.663ZM159.913 31V19.08H161.801V29.32H166.953V31H159.913Z"
                            fill="#22421A" />
                        <rect width="38" height="38" fill="url(#pattern0_16_3123)" />
                        <defs>
                            <pattern id="pattern0_16_3123" patternContentUnits="objectBoundingBox" width="1"
                                height="1">
                                <use xlink:href="#image0_16_3123" transform="scale(0.01)" />
                            </pattern>
                            <image id="image0_16_3123" width="100" height="100"
                                xlink:href="data:image/png;base64,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" />
                        </defs>
                    </svg>

                </div>


                <x-dropdown>
                    <x-slot name="trigger">
                        <button
                            class=" hidden lg:block align-middle rounded-full focus:shadow-outline-purple focus:outline-none f-plus text-[#228B22] text-[29px] font-[500]"
                            @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                            aria-haspopup="true">
                            {{ Auth::user()->name }}
                        </button>
                        <p class="hidden lg:block m-0 f-plus text-[#228B22] text-[23px] font-[400]">Admin</p>
                        <img class="w-[5rem] lg:hidden h-[5rem] rounded-full object-cover border border-[#228B22]"
                            src="{{ asset('storage/storage/images/avatar.png') }}" alt=""
                            @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                            aria-haspopup="true">
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profile.edit') }}">
                            <x-slot name="icon">
                                <svg class="mr-3 w-4 h-4" aria-hidden="true" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </x-slot>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <x-slot name="icon">
                                    <svg class="mr-3 w-4 h-4" aria-hidden="true" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                </x-slot>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

        </div>


        <div class="pt-20 pb-6">
            <a href="{{ route('tablet.add') }}"
                class="f-plus text-[16px] font-[500] text-[#228B22] flex items-center gap-[10px]">
                Add New Tabs <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect width="25" height="25" rx="3" fill="#228B22" />
                    <path d="M12.75 7V18.5" stroke="white" stroke-width="2" stroke-linecap="round" />
                    <path d="M18.5 12.75L7 12.75" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>

            </a>
        </div>


        <div class="bg-[#FFFFFF] rounded-[12px] pt-3 pb-8 px-4 mb-10">
            <h3 class="test-[#0D2927] f-plus font-[500] text-[24px] mb-6">Add New Tablets</h3>
            <div class="lg:w-[35rem] mx-auto">
                <form action="" method="post">
                    @csrf
                    <div class="f-inter flex flex-col mb-6">
                        <label class="f-inter text-[16px] font-[400] text-[#0D2927] mb-1">Tab Name</label>

                        <input type="text" name="name" value="{{ old('name') }}"
                            class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]"
                            placeholder="Enter your Tab name">
                        @error('name')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="f-inter flex flex-col mb-6">
                        <label class="f-inter text-[16px] font-[400] text-[#0D2927] mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]"
                            placeholder="Enter your email">
                        @error('email')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="f-inter flex flex-col mb-6">
                        <label class="f-inter text-[16px] font-[400] text-[#0D2927] mb-1">Create Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password"
                                class="password-input bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]"
                                placeholder="Enter password">
                            <i id="togglePassword" class="fas fa-eye toggle-eye"></i>
                        </div>
                        {{-- <input type="password" name="password" class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]" placeholder="Enter password"> --}}
                        @error('password')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="f-inter flex flex-col mb-10">
                        <label class="f-inter text-[16px] font-[400] text-[#0D2927] mb-1">Confirm Password</label>

                        <div class="password-container">
                            <input type="password" id="password1" name="confirmPassword"
                                class="password-input bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]"
                                placeholder="Confirm password">
                            <i id="togglePassword1" class="fas fa-eye toggle-eye"></i>
                        </div>
                        {{-- <input type="password" name="confirmPassword" class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]" placeholder="Confirm password"> --}}
                        @error('confirmPassword')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="lg:w-[20rem] mx-auto mb-5 pb-5">
                        <button type="submit"
                            class="f-plus text-[16px] font-[500] text-[#FFFFFF] bg-[#228B22] rounded-[4px] py-3 w-full">Submit</button>
                    </div>
                    <style>
                        .password-container {
                            position: relative;
                            width: ;

                        }

                        .password-input {
                            width: 100%;
                            background-color: #EEF6F1;
                            border: 1px solid #F3FFF2;
                            /* padding: 10px 40px 10px 10px;  */
                            font-size: 16px;
                            font-weight: 400;
                            color: #323232;
                            border-radius: 5px;

                        }

                        @media (min-width: 1024px) {
                            .password-input {
                                width: 35rem;


                            }
                        }

                        .toggle-eye {
                            position: absolute;
                            right: 1rem;
                            top: 50%;
                            transform: translateY(-50%);
                            cursor: pointer;
                            color: #323232;
                        }
                    </style>
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                    <script>
                        const togglePassword = document.getElementById('togglePassword');
                        const togglePassword1 = document.getElementById('togglePassword1');
                        const passwordField = document.getElementById('password');
                        const passwordField1 = document.getElementById('password1');

                        togglePassword.addEventListener('click', () => {
                            // Toggle the type attribute
                            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                            passwordField.setAttribute('type', type);

                            // Toggle the eye icon
                            togglePassword.classList.toggle('fa-eye');
                            togglePassword.classList.toggle('fa-eye-slash');
                        });
                        togglePassword1.addEventListener('click', () => {
                            // Toggle the type attribute
                            const type = passwordField1.getAttribute('type') === 'password' ? 'text' : 'password';
                            passwordField1.setAttribute('type', type);

                            // Toggle the eye icon
                            togglePassword1.classList.toggle('fa-eye');
                            togglePassword1.classList.toggle('fa-eye-slash');
                        });
                    </script>

                </form>

            </div>


        </div>

    </div>
</x-app-layout>
