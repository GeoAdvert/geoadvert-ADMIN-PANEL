@extends('layouts.layout')
@push('title')
    Login
@endpush
@push('styles')
    <style>
        .boxshad {
            background: #fff;
            box-shadow: 20px 20px 2px 5px rgba(255, 192, 203, 0.5);
        }

        .boxshadxd {
            box-shadow: -15px 15px 0px 0px rgba(255, 192, 203, 0.4);
        }
    </style>
@endpush
@section('content')
    <!-- Checkout Progress -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex min-[340px]:flex-col sm:flex-row justify-center gap-3 sm:space-x-4">
            <a href="{{ route('payment.index') }}"
                class="min-[340px]:!px-[40px] sm:px-[60px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full text-center hover:bg-[#ED396C] hover:text-[#fff]">Payment</a>
            <a href="{{ route('logins.index') }}"
                class="min-[340px]:!px-[40px] sm:px-[60px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full bg-[#ED396C]  text-center text-[#fff]">My
                Details</a>
            {{-- @auth
                <a href="{{ route('summary.index') }}"
                    class="min-[340px]:!px-[40px] sm:px-[60px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full hover:bg-[#ED396C] text-center hover:text-[#fff]">Summary</a>
            @endauth --}}
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-[100px]">
                <!-- Left Column - Login Form -->
                <div class="boxshad bg-white py-[20px] px-[30px]">
                    @guest
                        <h2 class="text-3xl font-bold mb-6">Login</h2>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="relative w-full">
                                <input type="hidden" hidden name="is_payment" id="is_payment" value="1">
                                <label class="absolute -top-2 left-2 bg-[#fff] px-1 text-sm text-gray-700">
                                    Email<span class="text-red-500">*</span>
                                </label>
                                <input type="email"
                                    class="w-full border border-black  bg-white pt-4 pb-2 px-2 focus:outline-none"
                                    name="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mb-6 relative mt-[20px]">
                                <label
                                    class="z-10 block text-gray-700 mb-2 absolute -top-2 left-2 bg-[#fff] px-1 text-sm">Password</label>
                                <div class="relative">
                                    <input id="password1" type="password"
                                        class="w-full border border-black px-3 py-3 focus:outline-none focus:border-pink-500"
                                        name="password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    <button type="button" class="absolute right-3 top-2 text-gray-500" data-toggle="password"
                                        data-target="password1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path class="eye" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path class="eye" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- <div class="mb-6">
                                <a href="#forgot-password" class="text-pink-500 hover:underline">I Forgot Password</a>
                            </div> --}}

                            <button type="submit"
                                class="flex justify-center text-center w-[100%] max-w-[180px] btn-pink mx-auto">Login</button>
                        </form>
                    @endguest
                    @auth
                        <div class="flex justify-center gap-3 !h-[35px]">
                            <a href="{{ route('summary.index') }}" class="btn-pink w-[100%] max-w-[120px] text-center">
                                Next
                            </a>
                        </div>

                    @endauth
                </div>

                <!-- Right Column - Create Account -->
                <div class="boxshadxd bg-white md:px-[80px] px-[20px] py-[20px]">
                    <h2 class="text-[16px] mb-6">Create An Account at GeoAdvert and gain:</h2>

                    <ul class="mb-8 space-y-4">
                        <li class="flex items-center">

                            <span>Ability to monitor results</span>
                        </li>
                        <li class="flex items-center">

                            <span>Weekly Reports</span>
                        </li>
                        <li class="flex items-center">

                            <span>Special Discount Codes</span>
                        </li>
                    </ul>

                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="mt-[5px]">
                            @csrf
                            <input type="hidden" hidden name="is_payment" id="is_payment" value="1">
                            <a href="{{ route('logout') }}" class="btn-pink w-[100%] max-w-[180px] text-center !h-[10px] ml-3"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    @endauth
                    @guest
                        <button onclick="window.location.href='{{ route('customerData.index') }}'" class="btn-pink">Create
                            An Account</button>
                    @endguest

                    {{-- <div class="border-t border-gray-200 pt-6 mt-[20px]">
                        <p class="mb-4">I don't have an account</p>
                        <p class="mb-4">Buy as a guest without creating an account</p>
                        <button class="btn-pink min-[340px]:px-[5px] sm:p-y-[0.5rem] sm:px-[1.5rem]">Continue
                            without logging in</button>
                    </div> --}}
                </div>
            </div>

            <div class="flex justify-center gap-[20px] mt-[100px]">
                <a href="{{ route('payment.index') }}" class="px-[60px] py-1 btn-pink">Back</a>
                {{-- <a href="{{ route('summary.index') }}" class="px-[60px] py-1 btn-pink">Next</a> --}}
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            document.querySelectorAll('[data-toggle="password"]').forEach(button => {
                button.addEventListener('click', () => {
                    const targetId = button.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const svg = button.querySelector('svg');

                    if (input.type === 'password') {
                        input.type = 'text';

                        svg.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.964 9.964 0 012.442-3.963M6.875 6.875A9.955 9.955 0 0112 5
            c4.478 0 8.268 2.943 9.542 7a9.963 9.963 0 01-4.387 5.036M15 12a3 3 0 01-4.243-4.243M3 3l18 18" />
        `;
                    } else {
                        input.type = 'password';

                        svg.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
            -1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        `;
                    }
                });
            });
        </script>
    @endpush
@endsection
