@extends('layouts.layout')
@push('title')
    Customer Data
@endpush
@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-12">Customer data</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left and Center Column - Form -->
            <div class="min-[340px]-col-span-1 sm:col-span-2 bg-white min-[340px]:p-4 sm:p-8 rounded-lg shadow-lg">
               <form action="{{ route('customerData.store') }}" method="POST">
                @csrf
                 <div class="mb-6">
                    {{-- <div class="md:flex items-center md:space-x-6 mb-6">
                        <div class="flex items-center gap-3">
                            <input type="radio" id="private-person" class="accent-[#ED396C] w-5 h-5 rounded-full"
                                name="customer-type">
                            <label for="private-person">I am ordering as a private person</label>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="radio" id="company" class="accent-[#ED396C] w-5 h-5 rounded-full"
                                name="customer-type" checked>
                            <label for="company">I am ordering as a company or budgetary entity</label>
                        </div>
                    </div> --}}

                    <p class="mb-6">Fields marked with an asterisk (*) are required</p>

                    <div class=" mb-4 relative">
                        <label class="bg-white z-10 block text-gray-700 mb-2 absolute -top-2 left-2  px-1 text-sm">Select
                            country</label>
                        <select name="country"
                            class="relative w-full border border-[#000] px-3 py-2 focus:outline-none focus:border-pink-500">
                            <option value="Poland">Poland</option>
                            <option value="Germany">Germany</option>
                            <option value="UK">United Kingdom</option>
                            <option value="USA">United States</option>
                        </select>
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>

                    <div class="mb-4 relative">
                        <label
                            class="bg-white z-10 block text-gray-700 mb-2 absolute -top-2 left-2  px-1 text-sm">NIP</label>
                        <input type="text" name="nip"
                            class="relative w-full border border-[#000]  px-3 py-2 focus:outline-none focus:border-pink-500"
                            placeholder="---------">
                            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                    </div>

                    <div class="mb-4">

                        <input type="text" name="company"
                            class="w-full border border-[#000]  px-3 py-2 focus:outline-none focus:border-pink-500"
                            placeholder="Company/Entity">
                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                    </div>

                    <div class="mb-4">

                        <input type="email" name="email"
                            class="w-full border border-[#000]  px-3 py-2 focus:outline-none focus:border-pink-500"
                            placeholder="Email" >
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex flex-row gap-[20px] mb-4">
                        <div class="md:w-[60%]">

                            <input type="text" name="street"
                                class="w-full border border-[#000]   px-3 py-2 focus:outline-none focus:border-pink-500"
                                placeholder="Street*" >
                                <x-input-error :messages="$errors->get('street')" class="mt-2" />
                        </div>
                        <div class="md:w-[20%]">

                            <input type="text" name="house_no"
                                class="w-full border border-[#000]   px-3 py-2 focus:outline-none focus:border-pink-500"
                                placeholder="House number*" >
                                <x-input-error :messages="$errors->get('house_no')" class="mt-2" />
                        </div>
                        <div class="md:w-[20%]">

                            <input type="text" name="apartment_no"
                                class="w-full border border-[#000]  px-3 py-2 focus:outline-none focus:border-pink-500 "
                                placeholder="Apartment no">
                                <x-input-error :messages="$errors->get('apartment_no')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-row mb-4 gap-[20px]">
                        <div class="relative md:w-[30%]">
                            <label class="bg-white z-10 block text-gray-700 mb-2 absolute -top-2 left-2  px-1 text-sm">Zip
                                code*</label>
                            <input type="text" name="zip_code"
                                class="relative w-full border border-[#000] px-3 py-2 focus:outline-none focus:border-pink-500"
                                placeholder="----" >
                                <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
                        </div>
                        <div class="relative md:w-[70%]">
                            <label
                                class="bg-white z-10 block text-gray-700 mb-2 absolute -top-2 left-2  px-1 text-sm">Locality*</label>
                            <input type="text" name="locality"
                                class="relative w-full border border-[#000] px-3 py-2 focus:outline-none focus:border-pink-500"
                                >
                                <x-input-error :messages="$errors->get('locality')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex md:flex-row flex-col gap-[20px] mb-6">
                        <div class="relative md:w-[30%] w-[100%]">
                            <label
                                class="bg-white z-10 block text-gray-700 mb-2 absolute -top-2 left-2  px-1 text-sm">Directional*</label>
                            <select name="directional"
                                class="relative border border-[#000] px-3 py-2 focus:outline-none focus:border-pink-500 w-full">
                                <option value="Poland">Poland (+48)</option>
                                <option value="Germany">Germany (+49)</option>
                                <option value="UK">United Kingdom (+44)</option>
                                <option value="USA">United States (+1)</option>
                            </select>
                            <x-input-error :messages="$errors->get('directional')" class="mt-2" />
                        </div>
                        <div class="relative md:w-[70%] w-[100%]">
                            <label class="bg-white z-10 block text-gray-700 mb-2 absolute -top-2 left-2  px-1 text-sm">Phone
                                number*</label>
                            <input type="tel" name="phone_number"
                                class="relative border w-full border-[#000] px-3 py-2 focus:outline-none focus:border-pink-500"
                                placeholder="--- --- ---" >
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>
                    </div>

                    <p class="mb-6">The telephone number is required to process the order.</p>

                    <h2 class="text-2xl font-bold mb-4">Create an account - enjoy the benefits</h2>
                    <p class="mb-4">Just add a password to create an account in our store</p>

                    <div class="mb-6 relative mt-[20px]">
                        <label
                            class="z-10 block text-gray-700 mb-2 absolute -top-2 left-2 bg-[#fff] px-1 text-sm">Password</label>
                        <div class="relative">
                            <input id="password1" type="password" name="password"
                                class="w-full border border-black px-3 py-3 focus:outline-none focus:border-pink-500"
                                >
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <button type="button" class="absolute right-3 top-2 text-gray-500" data-toggle="password"
                                data-target="password1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path class="eye" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path class="eye" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- <p class="mb-6 text-sm">Password must contain: min. 8 characters + lower case letter + inertial
                        value + citral</p>

                    <p class="mb-4">Check why it's worth it</p> --}}

                    <button type="submit"
                        class="w-full max-w-[200px] block btn-pink mx-auto">Submit</button>
                </div>
               </form>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Value of products</span>
                        <span class=" ">772,56zł</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Delivery cost</span>
                        <span class=" ">0,00zł</span>
                    </div>
                    <div class="flex justify-between text-xl font-bold text-[#ED396C]">
                        <span>Together</span>
                        <span>772,56zł</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
