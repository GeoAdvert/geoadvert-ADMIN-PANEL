@section('title', 'Dashboard')
<x-app-layout>

    <div class="pt-[5rem] overflow-x-hidden">
        {{-- <div class="search-input w-[100%] lg:w-[25rem] relative mb-4">
            <div class="search-icon absolute top-[23%] left-[8px]">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                        stroke="#54545A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M21.0004 20.9999L16.6504 16.6499" stroke="#54545A" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </div>
            <input
                class="appearance-none block w-full bg-[#F7F7F7] text-[#54545A] text-[14px] font-[300] border-[1.5px] border-[#EFEFEF] rounded-[5px] py-3 px-9 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-last-name" type="text" placeholder="Search">
        </div> --}}
        <div class="tabs-container f-inter mt-10">
            <div class="bg-[#F7F7F7] w-[100%] lg:w-[28rem] rounded-[2px]">
                <nav class="tabs flex flex-col flex-wrap sm:flex-row justify-between">
                    <a href="{{ route('dashboard') }}"
                        class="tab active {{ Request::routeIs('dashboard') ? 'bg-[#228B22] text-white' : 'text-[#228B22]' }} font-[500] texy-[14px] py-2 px-4 block flex items-center gap-[10px] rounded-[4px]">
                        @if (Request::routeIs('dashboard'))
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
                        @else
                            <svg width="34" height="34" viewBox="0 0 34 34" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect width="34" height="34" fill="url(#pattern0_16_971)" />
                                <defs>
                                    <pattern id="pattern0_16_971" patternContentUnits="objectBoundingBox" width="1"
                                        height="1">
                                        <use xlink:href="#image0_16_971" transform="scale(0.01)" />
                                    </pattern>
                                    <image id="image0_16_971" width="100" height="100"
                                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAABtElEQVR4nO3dPU7DQBCGYd8DgTwT5SycgC7cJSXaCVV+DsFpCOIkgT7IkCJCiUxBMp+97yNtv57XKyeN3TQAAAAAAAAAAACVaRftvRV7YNnFZ9DNujeIhb17+J7lF59BN2uChM7NRpDIj0CQyB88QSJ/2ASJ/AETJPKHSpDIH6RUEAub/89f0PGzsDlBhBBEDEHEEEQMQcQQRAxBxBBEDEHEEEQMQcQQRAxBxBBEDEHEEEQMQcQQRAxBxBBEDEHEEEQMQcQQRAxBxBBEDEHEEEQMQcQQRAxBxBBEDEHEEEQMQcQQRAxBxBBEDEHEEKTGIB7+wtvm7E9vjOtmdY0grBB6tQbLtd51wnKC+Pk7bOfFl1Zs1i0PX1mxj6HcNOM6IcVfp8/Tm9/7nywmtx6+Td9fTUEsbHcqxnGUIZyU0QTx4su+6/Di6/R91hLEis36rqON9jF7nwQ5QpDr3l2rpoeHb7JPQE0n5KN7cJ+N8eR3Xvwze5/VBPGftT0V5RDjTWB/1QXZf/+0Lb7unheHZ8ZmCCdjtEF84IsgkR+BIDHwIHzyyLQ+eQQAAAAAAAAAANCMyxcKk1mmlyxlawAAAABJRU5ErkJggg==" />
                                </defs>
                            </svg>
                        @endif
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
                            src="{{ asset('storage/img/admin.jpg') }}" alt="" @click="toggleProfileMenu"
                            @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true">
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
        <script>
            var msg = '{{ Session::get('status') }}';
            var exist = '{{ Session::has('status') }}';
            if (exist) {
                alert(msg);
            }
            var msg1 = '{{ Session::get('error') }}';
            var exist1 = '{{ Session::has('error') }}';
            if (exist1) {
                alert(msg1);
            }
        </script>
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
        <div class="bg-[#FFFFFF] rounded-[12px] pt-3 pb-10 mb-10 px-4">
            <h3 class="text-[#0D2927] f-plus font-[500] text-[24px]">Tablets</h3>


            <div class="overflow-x-auto">
                <table
                    class="min-w-full bg-white table-auto w-full shadow-md mt-5 rounded border-separate border-spacing-y-3">
                    <thead class="">
                        <tr class="f-inter text-[#0D2927] text-[20px] font-[500]">
                            <th class="w-[20.333333%] px-2 py-2 text-left">
                                <div class="flex items-center gap-[10px]">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="20" height="20" fill="url(#pattern0_16_913)" />
                                        <defs>
                                            <pattern id="pattern0_16_913" patternContentUnits="objectBoundingBox"
                                                width="1" height="1">
                                                <use xlink:href="#image0_16_913" transform="scale(0.01)" />
                                            </pattern>
                                            <image id="image0_16_913" width="100" height="100"
                                                xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAABuUlEQVR4nO3dQU7CQBSH8S41mTFxbXRjeG+mHsQTuIO7cAfAQ3gaMZwE3GMajDEGUxfC/Nv5fsnsp+/rUNiUpgEAAAAAAAAAAKjMlftjaP2J5SefQTfr3iAx2SZm37P89DNItiFIFrrZCOLlIxDEyw+eIF5+2ATx8gMmiJcfKkG8/CDFgsz/5yfo+MXsc4IIIYgYgoghiBiCiCGIGIKIIYgYgoghiBiCiCGIGIKIIYgYgoghiBiCiCGIGIKIIYgYgoghiBiCiCGIGIKIIYgYgoghiBiCiCGIGIKIIYgYgoghiBiCiCGIGIKIIYgYgoghSJVBkr/wtjn/0xvjulmd48UBrKz1ag1WJsh+lDfC2E5IyLYN2RYx2/SwfBmS7Urvq84gyV8vJ5Obn/u/eLi/jdnXxfdXU5CQbXssxvcogzgpIwqy6L2O7KvS+6wmSMw27Q9is/L7JMgXgpz37lo2PWLy5+InoJYTEpLtugf3b9dw3bZ3Idl76X1WEyQe1vpYlC5GzPYmsL/qguw/v9quDs8Lm3UfU4M4GWMNEoe+COLlIxDEhx2Evzxyrb88AgAAAAAAAAAAaMblA5b52SSbzr0FAAAAAElFTkSuQmCC" />
                                        </defs>
                                    </svg>
                                    <span class="f-inter text-[15px] lg:text-[20px] font-[500] text-[#0D2927]">
                                        Module Tablets
                                    </span>

                                </div>
                            </th>
                            <th class="w-[20.333333%] px-2 py-2 text-left">
                                <div class="flex items-center gap-[10px] justify-left">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.33268 3.3335H16.666C17.5827 3.3335 18.3327 4.0835 18.3327 5.00016V15.0002C18.3327 15.9168 17.5827 16.6668 16.666 16.6668H3.33268C2.41602 16.6668 1.66602 15.9168 1.66602 15.0002V5.00016C1.66602 4.0835 2.41602 3.3335 3.33268 3.3335Z"
                                            stroke="#0D2927" stroke-width="1.66667" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M18.3327 5L9.99935 10.8333L1.66602 5" stroke="#0D2927"
                                            stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <span class="f-inter text-[15px] lg:text-[20px] font-[500] text-[#0D2927]">
                                        Email
                                    </span>
                                </div>
                            </th>

                            <th class="w-[18.333333%] px-2 py-2 text-left">
                                <div class="flex items-center gap-[10px] justify-left">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.33268 3.3335H16.666C17.5827 3.3335 18.3327 4.0835 18.3327 5.00016V15.0002C18.3327 15.9168 17.5827 16.6668 16.666 16.6668H3.33268C2.41602 16.6668 1.66602 15.9168 1.66602 15.0002V5.00016C1.66602 4.0835 2.41602 3.3335 3.33268 3.3335Z"
                                            stroke="#0D2927" stroke-width="1.66667" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M18.3327 5L9.99935 10.8333L1.66602 5" stroke="#0D2927"
                                            stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <span class="f-inter text-[15px] lg:text-[20px] font-[500] text-[#0D2927]">
                                        Password
                                    </span>
                                </div>

                            </th>

                            <th class="w-[20.333333%] px-2 py-2 text-left">
                                <div class="flex items-center gap-[10px] justify-left">


                                    <svg fill="#000000" width="20" height="20"  viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M429.811 577.1l-80.485-86.309c-21.425-22.976-57.42-24.233-80.396-2.807s-24.233 57.42-2.807 80.396l81.839 87.762-.158.152 43.493 45.038c19.643 20.341 52.056 20.907 72.397 1.264l35.686-34.462 8.195-7.642-.133-.143 251.802-243.163c22.607-21.832 23.236-57.857 1.405-80.464s-57.857-23.236-80.464-1.405L429.812 577.1zM512 1024C229.23 1024 0 794.77 0 512S229.23 0 512 0s512 229.23 512 512-229.23 512-512 512z"></path></g></svg>

                                    <span class="f-inter text-[15px] lg:text-[20px] font-[500] text-[#0D2927]">
                                        Status
                                    </span>
                                </div>

                            </th>

                            <th class="w-[20.333333%] px-2 py-2 text-left">
                                <div class="flex items-center gap-[10px] justify-left">


                                    <svg fill="#000000" width="20" height="20" viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12ZM3.00683 12C3.00683 16.9668 7.03321 20.9932 12 20.9932C16.9668 20.9932 20.9932 16.9668 20.9932 12C20.9932 7.03321 16.9668 3.00683 12 3.00683C7.03321 3.00683 3.00683 7.03321 3.00683 12Z" fill="#0F0F0F"></path> <path d="M12 5C11.4477 5 11 5.44771 11 6V12.4667C11 12.4667 11 12.7274 11.1267 12.9235C11.2115 13.0898 11.3437 13.2343 11.5174 13.3346L16.1372 16.0019C16.6155 16.278 17.2271 16.1141 17.5032 15.6358C17.7793 15.1575 17.6155 14.5459 17.1372 14.2698L13 11.8812V6C13 5.44772 12.5523 5 12 5Z" fill="#0F0F0F"></path> </g></svg>

                                    <span class="f-inter text-[15px] lg:text-[20px] font-[500] text-[#0D2927]">
                                        Last Online
                                    </span>
                                </div>

                            </th>

                            <th class="w-[20.333333%] px-2 py-2 text-right">

                                <div class="flex items-center gap-[10px] justify-end">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.5 2.5L8.39167 16.6417L10.4833 10.4833L16.6417 8.39167L2.5 2.5Z"
                                            stroke="#0D2927" stroke-width="1.66667" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M10.834 10.8335L15.834 15.8335" stroke="#0D2927"
                                            stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <span class="f-inter text-[15px] lg:text-[20px] font-[500] text-[#0D2927]">
                                        Action
                                    </span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="">

                        @forelse ($tablet as $tab)
                            <tr class="bg-[#EEF6F1] rounded-[4px] mb-3 py-4">
                                <td class="px-4 py-2 f-inter font-[500] text-[16px] ">{{ $tab->name }}</td>
                                <td class="px-4 py-2 text-left text-[14px] f-inter font-[400] text-[#3C4151]">
                                    {{ $tab->email }}</td>
                                <td class="px-4 py-2 text-left text-[14px] f-inter font-[400] text-[#3C4151]">
                                    {{ $tab->hashedPassword }}</td>
                                <td class="px-4 py-2 text-left text-[14px] f-inter font-[400] text-[#3C4151]">
                                    @if ($tab->login_time >= \Carbon\Carbon::now()->subMinutes(1))
                                        Online
                                    @else
                                        Offline
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-left text-[14px] f-inter font-[400] text-[#3C4151]">
                                    @if ($tab->login_time >= \Carbon\Carbon::now()->subMinutes(1))
                                        Online
                                    @else
                                        {{ \Carbon\Carbon::parse($tab->login_time)->diffForHumans() }}
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex justify-end pr-5">
                                        <a href="{{ route('tablet.delete', $tab->id) }}"
                                            onclick="return confirm('Are you sure ?')">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 4H3.33333H14" stroke="#AC2221" stroke-width="1.33333"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M12.6673 4.00016V13.3335C12.6673 13.6871 12.5268 14.0263 12.2768 14.2763C12.0267 14.5264 11.6876 14.6668 11.334 14.6668H4.66732C4.3137 14.6668 3.97456 14.5264 3.72451 14.2763C3.47446 14.0263 3.33398 13.6871 3.33398 13.3335V4.00016M5.33398 4.00016V2.66683C5.33398 2.31321 5.47446 1.97407 5.72451 1.72402C5.97456 1.47397 6.3137 1.3335 6.66732 1.3335H9.33398C9.68761 1.3335 10.0267 1.47397 10.2768 1.72402C10.5268 1.97407 10.6673 2.31321 10.6673 2.66683V4.00016"
                                                    stroke="#AC2221" stroke-width="1.33333" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M6.66602 7.3335V11.3335" stroke="#AC2221"
                                                    stroke-width="1.33333" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M9.33398 7.3335V11.3335" stroke="#AC2221"
                                                    stroke-width="1.33333" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg> </a>
                                        <a href="{{ route('tablet.update', $tab->id) }}">
                                            <svg class="h-5 w-6 ml-3 text-green-700" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
                                                <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center mt-4">
                                <td colspan="6">
                                    No tablets available yet!
                                </td>
                            </tr>
                            @endforelse

                    </tbody>
                </table>
            </div>
        </div>



    </div>
</x-app-layout>
