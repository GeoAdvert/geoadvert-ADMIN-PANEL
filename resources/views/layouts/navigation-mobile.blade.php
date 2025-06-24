<div
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
></div>
<aside
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 overflow-y-auto bg-white md:hidden"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
        @click.outside="closeSideMenu"
        @keydown.escape="closeSideMenu"
>
    <div class="py-4 text-gray-500 dark:text-gray-400">
     
        
        <ul class="mt-6">
            <li class="relative px-4"> 
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard','addtabs')">
                    <x-slot name="icon">
                        <svg class="ml-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="20" height="20" fill="url(#pattern0_16_971)"/>
                            <defs>
                            <pattern id="pattern0_16_971" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image0_16_971" transform="scale(0.01)"/>
                            </pattern>
                            <image id="image0_16_971" width="100" height="100" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAABtElEQVR4nO3dPU7DQBCGYd8DgTwT5SycgC7cJSXaCVV+DsFpCOIkgT7IkCJCiUxBMp+97yNtv57XKyeN3TQAAAAAAAAAAACVaRftvRV7YNnFZ9DNujeIhb17+J7lF59BN2uChM7NRpDIj0CQyB88QSJ/2ASJ/AETJPKHSpDIH6RUEAub/89f0PGzsDlBhBBEDEHEEEQMQcQQRAxBxBBEDEHEEEQMQcQQRAxBxBBEDEHEEEQMQcQQRAxBxBBEDEHEEEQMQcQQRAxBxBBEDEHEEEQMQcQQRAxBxBBEDEHEEEQMQcQQRAxBxBBEDEHEEKTGIB7+wtvm7E9vjOtmdY0grBB6tQbLtd51wnKC+Pk7bOfFl1Zs1i0PX1mxj6HcNOM6IcVfp8/Tm9/7nywmtx6+Td9fTUEsbHcqxnGUIZyU0QTx4su+6/Di6/R91hLEis36rqON9jF7nwQ5QpDr3l2rpoeHb7JPQE0n5KN7cJ+N8eR3Xvwze5/VBPGftT0V5RDjTWB/1QXZf/+0Lb7unheHZ8ZmCCdjtEF84IsgkR+BIDHwIHzyyLQ+eQQAAAAAAAAAANCMyxcKk1mmlyxlawAAAABJRU5ErkJggg=="/>
                            </defs>
                            </svg>
                            
                    </x-slot>
                    {{ __('Module Tablets') }}
                </x-nav-link>
            </li>

            <li class="relative px-4">
                <x-nav-link href="{{ route('adsmanagement') }}" :active="request()->routeIs('adsmanagement','adsmanagementadd')">
                    <x-slot name="icon">
                        <svg class="ml-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="20" height="20" fill="url(#pattern0_16_957)"/>
                            <defs>
                            <pattern id="pattern0_16_957" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image0_16_957" transform="scale(0.01)"/>
                            </pattern>
                            <image id="image0_16_957" width="100" height="100" xlink:href="data:image/png;base64,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"/>
                            </defs>
                            </svg>
                            
                    </x-slot>
                    {{ __('Ads Management') }}
                </x-nav-link>
            </li>

            {{-- <li class="relative px-4">
                <x-nav-link href="{{ route('geotargetads') }}" :active="request()->routeIs('geotargetads','geotargetadsadd')">
                    <x-slot name="icon">
                        <svg class="ml-2" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="20" height="20" fill="url(#pattern0_16_927)"/>
                            <defs>
                            <pattern id="pattern0_16_927" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image0_16_927" transform="scale(0.01)"/>
                            </pattern>
                            <image id="image0_16_927" width="100" height="100" xlink:href="data:image/png;base64,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"/>
                            </defs>
                            </svg>
                            
                    </x-slot>
                    {{ __('Geo targeted ads') }}
                </x-nav-link>
            </li> --}}

            {{-- <li class="relative px-6">
                <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                             stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                        </svg>
                    </x-slot>
                    {{ __('Ads as per Location ') }}
                </x-nav-link>
            </li> --}}

            {{-- <li class="relative px-6 py-3">
                <button class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        @click="toggleMultiLevelMenu" aria-haspopup="true">
                <span class="inline-flex items-center">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    <span class="ml-4">Two-level menu</span>
                </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isMultiLevelMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <a class="w-full" href="#">Child menu</a>
                        </li>
                    </ul>
                </template>
            </li> --}}
        </ul>
    </div>
</aside>
