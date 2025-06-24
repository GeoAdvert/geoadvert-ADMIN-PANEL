@extends('layouts.layout')
@push('title')
    Get Started
@endpush
@section('content')

    <div class="bg-gray-100 py-10 px-4 h-[100vh]">
      <!-- Title -->
      <div class="text-center mb-8">
        <h2 class="text-2xl font-bold">How do you want to start?</h2>
        <p class="font-bold text-[#000]">Choose the method that best suits your needs.</p>
      </div>

      <!-- Cards Grid -->
      {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[100px] max-w-8xl mx-auto">
        <!-- Card 1 -->
        <div class="box-grd text-white p-6 rounded-xl shadow">
          <a href="#" class="w-full h-full flex items-center justify-center flex-col gap-3 min-[340px]:text-left sm:text-center">
            <h3 class="font-semibold">Tailored packages for your industry</h3>
            <p class="text-[16px] sm:px-[20px]">
              Designed with the needs of specific companies in mind
            </p>
          </a>
        </div> --}}

        <!-- Card 2 -->
<div class="flex items-center justify-center bg-gray-100">
  <div class="box-grd text-white p-6 rounded-xl shadow bg-blue-600">
    <a href="{{ route('advertising.advertisingVideo') }}" class="w-full h-full flex items-center justify-start flex-col gap-3 min-[340px]:text-left sm:text-center">
      <h3 class="font-semibold">Choose the package yourself</h3>
      <p class="text-[16px] sm:px-[20px]">
        For companies that know what they want – choose only what you need and tailor <br> the campaign to your budget.
      </p>
    </a>
  </div>
</div>


        <!-- Card 3 -->
        {{-- <div class="box-grd text-white p-6 rounded-xl shadow">
          <a href="#" class="w-full h-full flex items-center justify-start flex-col gap-3 min-[340px]:text-left sm:text-center">
            <h3 class="font-semibold">Choose a solution with an expert</h3>
            <p class="text-[16px] sm:px-[20px]">
              Need help choosing the right option? In a short conversation, we’ll help you choose the option that best suits
              your goals.
            </p>
          </a>
        </div> --}}
      </div>
    </div>


@endsection
