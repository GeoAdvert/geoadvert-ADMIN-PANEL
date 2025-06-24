@extends('layouts.layout')
@push('title')
    Standard Video
@endpush
@section('content')
        <div class="container mx-auto px-4">
            <div class="flex lg:flex-row flex-col gap-6">
                <!-- Left Column - Industry Types -->
                <div class=" lg:w-[20%] w-[100%]">
                    <div class="flex flex-col gap-4 min-[340px]:text-center sm:text-center lg:text-left">
                        {{-- <a href="#" class="industry-btn">Standard Advertising</a> --}}
                        <a href="{{ route('advertising.advertisingVideo') }}" class="industry-btn active-link">Advertisement Video</a>
                        {{-- <a href="#" class="industry-btn">Geolocation Advertising</a>
                        <a href="#" class="industry-btn">Advertising at specific hours</a>
                        <a href="#" class="industry-btn">Personalized advertising</a>
                        <a href="#" class="industry-btn">Choose the number of views yourself</a> --}}
                    </div>
                </div>

                <div class="flex flex-col gap-5 lg:w-[80%] w-[100%]">
                    <!-- Right Column - Content -->
                    <div class="w-[100%] max-w-[850px] mx-auto">

                        <div class="flex flex-col gap-3">
                            <h1 class="text-4xl font-bold text-center">
                                @if(request()->get('ads'))
                                    Purchase Additional Views
                                @else
                                    Purchase a subscription
                                @endif
                            </h1>
                            <div class="flex flex-col items-center gap-5 col-span-3 font-[600] w-full">
                                <div class="text-center">
                                    <p>
                                        @if(request()->get('ads'))
                                            Buy More Views for Your Advertisement
                                        @else
                                            Advertisement Video
                                        @endif
                                    </p>
                                </div>

                                {{-- @if(!request()->get('ads'))
                                <div class="flex min-[340px]:flex-col sm:flex-row items-center gap-3">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" class="w-4 h-4 accent-[#ED396C] text-white" name="seconds" id="15sec" checked>
                                        <label for="15sec" class="text-gray-400">15 Seconds</label>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <input type="radio" class="w-4 h-4 accent-[#ED396C] text-white" name="seconds" id="30sec">
                                        <label for="30sec" class="text-gray-400">30 Seconds</label>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <input type="radio" class="w-4 h-4 accent-[#ED396C] text-white" name="seconds" id="45sec">
                                        <label for="45sec" class="text-gray-400">45 Seconds</label>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <input type="radio" class="w-4 h-4 accent-[#ED396C] text-white" name="seconds" id="60sec">
                                        <label for="60sec" class="text-gray-400">60 Seconds</label>
                                    </div>
                                </div>
                                <div class="flex justify-center gap-4 mb-6 min-[340px]:w-[60%] sm:w-[30%]">
                                    <div class="relative w-full">
                                        <button data-dropdown-toggle="how-long-menu"
                                            class="w-full flex min-[340px]:justify-center sm:justify-evenly items-center bg-[#ED396C] text-white min-[340px]:py-1 sm:py-2 px-4 rounded-full hover:bg-pink-600 transition">
                                            How long
                                            <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        <div id="how-long-menu"
                                            class="absolute mt-2 w-full bg-white rounded-md shadow-md hidden z-20">
                                            <ul class="py-1 text-sm text-gray-700">
                                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">1 Week</a>
                                                </li>
                                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">1 Month</a>
                                                </li>
                                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">3 Months</a>
                                                </li>
                                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">6 Months</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                    <!-- Pricing Cards -->
                    <div
                        class="mt-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 rounded-2xl gap-5 sm:gap-auto">
                        <!-- Standard Package -->
                        <div class="pric">
                            <div class="flex flex-col gap-3">
                                <h3 class="font-bold text-sm">Standard Package</h3>
                                <p class="text-3xl font-bold mt-2">PLN1,125</p>
                                <ul class="space-y-5">
                                    <!-- List Item 1 -->
                                    <li class="flex items-start gap-3">
                                        <svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 16 16" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" fill="#e8e8e8" />
                                            <g clip-path="url(#clip0_10184_497)">
                                                <path
                                                    d="M11.8453 5.42682L6.92683 11.329L4.18848 8.51237L5.14447 7.58293L6.85056 9.33776L10.821 4.57324L11.8453 5.42682Z"
                                                    fill="#000" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_10184_497">
                                                    <rect width="8" height="8" fill="#000" transform="translate(4 4)" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <p class="break-all">100,000 views</p>
                                    </li>
                                </ul>
                            </div>
                            @if(request()->get('ads'))
                                <a href="{{ route('payment.checkout', ['ads' => request()->get('ads'), 'views' => 100000, 'price' => 1125]) }}"
                                   class="mt-6 bg-pink-500 text-white py-2 rounded-full hover:bg-pink-600 transition text-center">
                                    Buy Now
                                </a>
                            @else
                                <a href="{{ route('package.select', ['views' => 100000, 'price' => 1125]) }}"
                                   class="mt-6 bg-pink-500 text-white py-2 rounded-full hover:bg-pink-600 transition text-center">
                                    Buy Now
                                </a>
                            @endif
                        </div>

                        <!-- Start Package -->
                        <div class="pric">
                            <div class="flex flex-col gap-3">
                                <h3 class="font-bold text-sm">Start Package</h3>
                                <p class="text-3xl font-bold mt-2">PLN375</p>
                                <ul class="space-y-5">
                                    <!-- List Item 1 -->
                                    <li class="flex items-start gap-3">
                                        <svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 16 16" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" fill="#e8e8e8" />
                                            <g clip-path="url(#clip0_10184_497)">
                                                <path
                                                    d="M11.8453 5.42682L6.92683 11.329L4.18848 8.51237L5.14447 7.58293L6.85056 9.33776L10.821 4.57324L11.8453 5.42682Z"
                                                    fill="#000" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_10184_497">
                                                    <rect width="8" height="8" fill="#000" transform="translate(4 4)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="break-all">25,000 views</p>
                                    </li>
                                </ul>
                            </div>
                            @if(request()->get('ads'))
                                <a href="{{ route('payment.checkout', ['ads' => request()->get('ads'), 'views' => 25000, 'price' => 375]) }}"
                                   class="mt-6 bg-pink-500 text-white py-2 rounded-full hover:bg-pink-600 transition text-center">
                                    Buy Now
                                </a>
                            @else
                                <a href="{{ route('package.select', ['views' => 25000, 'price' => 375]) }}"
                                   class="mt-6 bg-pink-500 text-white py-2 rounded-full hover:bg-pink-600 transition text-center">
                                    Buy Now
                                </a>
                            @endif
                        </div>

                        <!-- Premium Package -->
                        <div class="pric">
                            <div class="flex flex-col gap-3">
                                <h3 class="font-bold text-sm">Premium Package</h3>
                                <p class="text-3xl font-bold mt-2">PLN2,400</p>
                                <ul class="space-y-3">
                                    <!-- List Item 1 -->
                                    <li class="flex items-start gap-3">
                                        <svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 16 16" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" fill="#e8e8e8" />
                                            <g clip-path="url(#clip0_10184_497)">
                                                <path
                                                    d="M11.8453 5.42682L6.92683 11.329L4.18848 8.51237L5.14447 7.58293L6.85056 9.33776L10.821 4.57324L11.8453 5.42682Z"
                                                    fill="#000" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_10184_497">
                                                    <rect width="8" height="8" fill="#000" transform="translate(4 4)" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <p class="break-all">250,000 views</p>
                                    </li>
                                </ul>
                            </div>
                            @if(request()->get('ads'))
                                <a href="{{ route('payment.checkout', ['ads' => request()->get('ads'), 'views' => 250000, 'price' => 2400]) }}"
                                   class="mt-6 bg-pink-500 text-white py-2 rounded-full hover:bg-pink-600 transition text-center">
                                    Buy Now
                                </a>
                            @else
                                <a href="{{ route('package.select', ['views' => 250000, 'price' => 2400]) }}"
                                   class="mt-6 bg-pink-500 text-white py-2 rounded-full hover:bg-pink-600 transition text-center">
                                    Buy Now
                                </a>
                            @endif
                        </div>

                        <!-- Ultra Package -->
                        <div class="pric">
                            <div class="flex flex-col gap-3">
                                <h3 class="font-bold text-sm">Ultra Package</h3>
                                <p class="text-3xl font-bold mt-2">PLN4,200</p>
                                <ul class="space-y-3">
                                    <!-- List Item 1 -->
                                    <li class="flex items-start gap-3">
                                        <svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 16 16" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" fill="#e8e8e8" />
                                            <g clip-path="url(#clip0_10184_497)">
                                                <path
                                                    d="M11.8453 5.42682L6.92683 11.329L4.18848 8.51237L5.14447 7.58293L6.85056 9.33776L10.821 4.57324L11.8453 5.42682Z"
                                                    fill="#000" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_10184_497">
                                                    <rect width="8" height="8" fill="#000" transform="translate(4 4)" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <p class="break-all">500,000 views</p>
                                    </li>
                                </ul>
                            </div>
                            @if(request()->get('ads'))
                                <a href="{{ route('payment.checkout', ['ads' => request()->get('ads'), 'views' => 500000, 'price' => 4200]) }}"
                                   class="mt-6 bg-pink-500 text-white py-2 rounded-full hover:bg-pink-600 transition text-center">
                                    Buy Now
                                </a>
                            @else
                                <a href="{{ route('package.select', ['views' => 500000, 'price' => 4200]) }}"
                                   class="mt-6 bg-pink-500 text-white py-2 rounded-full hover:bg-pink-600 transition text-center">
                                    Buy Now
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
