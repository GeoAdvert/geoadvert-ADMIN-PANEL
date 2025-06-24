@extends('layouts.layout')
@push('title')
    Summary
@endpush
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex min-[340px]:flex-col sm:flex-row justify-center gap-3 sm:space-x-4">
            <a href="{{ route('payment.index') }}"
                class="min-[340px]:!px-[40px] sm:px-[60px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full text-center hover:bg-[#ED396C] hover:text-[#fff]">Payment</a>
            <a href="{{ route('logins.index') }}"
                class="min-[340px]:!px-[40px] sm:px-[60px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full hover:bg-[#ED396C]  text-center hover:text-[#fff]">My
                Details</a>
            <a href="{{ route('summary.index') }}"
                class="min-[340px]:!px-[40px] sm:px-[60px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full bg-[#ED396C] text-center text-[#fff]">Summary</a>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <!-- Order Summary Table -->
         {{-- ===== wrapper flex, center karne ke liye ===== --}}
<div class="w-full flex justify-center">
    {{-- Order-summary + buttons --}}
    <div class="w-full max-w-[650px] flex flex-col gap-5">
        {{-- ---------- Table ---------- --}}
        <div class="boxshad bg-white p-5 sm:p-8 flex justify-between">
            <div class="flex flex-col gap-2">
                <span>Subscription Plan</span>
                <span>VAT (23%)</span>
                <span>Email</span>
                <span>Value of products</span>
                <span>Delivery cost</span>
                <span class="text-pink-500 font-bold">Together</span>
            </div>

            <div class="flex flex-col gap-2 text-right">
                <span>{{ number_format($price, 2, ',', '.') }}zł</span>
                <span>{{ number_format($vat, 2, ',', '.') }}zł</span>
                <span>{{ auth()->user()->email ?? '—' }}</span>
                <span>{{ number_format($price, 2, ',', '.') }}zł</span>
                <span>0,00zł</span>
                <span class="font-bold text-pink-500">
                    {{ number_format($total, 2, ',', '.') }}zł
                </span>
            </div>
        </div>

        {{-- ---------- Action Buttons ---------- --}}
        <div class="flex gap-5">
            <a href="{{ route('logins.index') }}" class="btn-pink flex-1">Back</a>

            <form action="{{ route('checkout') }}" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="redirect_back" value="{{ url()->current() }}">
                <button type="submit" class="btn-pink w-full">Checkout</button>
            </form>
        </div>
    </div>
</div>

        </div>
    </section>
@endsection
