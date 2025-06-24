@extends('layouts.layout')
@push('title')
    My advertising
@endpush
@push('styles')
    <style>
        .bg-purple-600{
            background-color: #FFA4D1 !important;
        }
    </style>
@endpush
@section('content')
    <!-- Main Content -->
    <div class="min-[340px]:p-0 sm:p-6 max-w-5xl mx-auto">
        <!-- Heading -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">My Advertising Campaigns</h1>
            <h2 class="text-lg font-bold">Campaign 1</h2>
            <p class="text-sm text-gray-500 font-bold">Possibility to change name</p>
        </div>

        <!-- Table Title -->
        <h3 class="text-xl font-semibold mb-2">Advertisements</h3>

        <!-- Table -->
        <div class="bg-gray-100 px-4 pt-4 pb-[100px] rounded-md">
            <div class="grid grid-cols-3 font-semibold pb-2">
                <div>Uploaded File</div>
                <div class="text-center">File Type</div>
                <div class="text-right">Views</div>
            </div>
            @php
                $showBuyButton = false;
                $adsWithFullViews = [];
                foreach ($advertisments as $advertisment) {
                    if ($advertisment->views == $advertisment->advertisementView->count()) {
                        $showBuyButton = true;
                        $adsWithFullViews[] = $advertisment;
                    }
                }
            @endphp
            @forelse ($advertisments as $index=>$advertisment)
                @php
                    $fileExtension = pathinfo($advertisment->fileName, PATHINFO_EXTENSION);
                    $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'webp']);
                    $isVideo = in_array(strtolower($fileExtension), ['mp4', 'mov', 'webm']);
                @endphp

                <div class="grid grid-cols-3 items-center bg-pink-300 mt-2 p-2 rounded">
                    @if ($isImage)
                        <img src="{{ asset('storage/media/' . $advertisment->fileName) }}" alt=""
                            class="inline-block mr-2 cursor-pointer hover:opacity-80 transition-opacity border border-gray-300 rounded"
                            width="90" height="50">
                    @elseif($isVideo)
                        <video class="inline-block mr-2 w-[5rem] h-[5rem] cursor-pointer hover:opacity-80 transition-opacity border border-gray-300 rounded">
                            <source src="{{ asset('storage/media/' . $advertisment->fileName) }}">
                        </video>
                    @endif
                    <div class="text-center">{{ $advertisment->fileType }}</div>
                    <div class="text-right">
                        {{ number_format($advertisment->advertisementView->count()) }}/{{ number_format($advertisment->views) }}
                    </div>
                </div>
            @empty
             <div class="col-span-full text-center py-12">
                                <p class="text-gray-500">No advertisements found.</p>
                            </div>
            @endforelse

            <!-- Button -->
                        @if ($showBuyButton)
                <div class="flex justify-end mt-4">
                    <button onclick="openModal()"
                        class="bg-pink-500 text-white px-4 py-2 rounded-full hover:bg-pink-600 transition">
                        Buy More Views
                    </button>
                </div>
            @endif
        </div>
        {{ $advertisments->links() }}
    </div>

    <!-- Modal Overlay -->
    <div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <!-- Modal Container -->
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg w-full max-w-6xl max-h-[90vh] flex flex-col shadow-2xl">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Select Advertisement</h2>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="flex-1 overflow-y-auto p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @forelse ($adsWithFullViews as $advertisment)
                            @php
                                $fileExtension = pathinfo($advertisment->fileName, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'webp']);
                                $isVideo = in_array(strtolower($fileExtension), ['mp4', 'mov', 'webm']);
                            @endphp

                            <div class="border-2 border-gray-200 rounded-lg overflow-hidden hover:border-pink-300 transition-colors cursor-pointer"
                                 onclick="toggleAdSelection({{ $advertisment->id }})">

                                <!-- Media Container -->
                                <div class="relative bg-gray-100">
                                    @if ($isImage)
                                        <img src="{{ asset('storage/media/' . $advertisment->fileName) }}"
                                             alt="Advertisement"
                                             class="w-full h-40 object-cover">
                                    @elseif($isVideo)
                                        <div class="relative w-full h-40 bg-gray-200">
                                            <video class="w-full h-full object-cover"
                                                   controls
                                                   preload="metadata"
                                                   onclick="event.stopPropagation()">
                                                <source src="{{ asset('storage/media/' . $advertisment->fileName) }}" type="video/{{ $fileExtension }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    @endif

                                    <!-- Selection Indicator -->
                                    <div class="absolute top-2 right-2">
                                        <div id="checkbox-{{ $advertisment->id }}"
                                             class="w-6 h-6 border-2 border-white bg-white bg-opacity-80 rounded-md flex items-center justify-center shadow-lg">
                                            <svg class="w-4 h-4 text-pink-600 hidden" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Media Info -->
                                <div class="p-3 bg-white">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $advertisment->fileType }}</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Views: {{ number_format($advertisment->advertisementView->count()) }}/{{ number_format($advertisment->views) }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <p class="text-gray-500">No advertisements found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="border-t border-gray-200 px-6 py-4 bg-gray-50 rounded-b-lg">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <span id="selectedCount">0</span> advertisement selected
                        </div>
                        <div class="flex space-x-3">
                            <button onclick="closeModal()"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>
                            <button id="nextButton"
                                    onclick="proceedWithSelection()"
                                    disabled
                                    class="px-6 py-2 text-sm font-medium text-white bg-pink-500 border border-transparent rounded-md hover:bg-pink-600 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedAds = [];

        function openModal() {
            const modal = document.getElementById('modalOverlay');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('modalOverlay');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';

            // Reset selections
            selectedAds = [];
            updateUI();
        }

        function toggleAdSelection(adId) {
            // If the same ad is clicked again, deselect it
            if (selectedAds.length === 1 && selectedAds[0] === adId) {
                selectedAds = [];
            } else {
                // Set the selected ad to the new one (only one allowed)
                selectedAds = [adId];
            }

            updateUI();
        }


        function updateUI() {
            // Update selected count
            document.getElementById('selectedCount').textContent = selectedAds.length;

            // Update next button state
            const nextButton = document.getElementById('nextButton');
            nextButton.disabled = selectedAds.length === 0;

            // Update visual indicators
            @foreach ($adsWithFullViews as $advertisment)
                const checkbox{{ $advertisment->id }} = document.getElementById('checkbox-{{ $advertisment->id }}');
                const checkIcon{{ $advertisment->id }} = checkbox{{ $advertisment->id }}.querySelector('svg');
                const adContainer{{ $advertisment->id }} = checkbox{{ $advertisment->id }}.closest('.border-2');

                if (selectedAds.includes({{ $advertisment->id }})) {
                    checkIcon{{ $advertisment->id }}.classList.remove('hidden');
                    checkbox{{ $advertisment->id }}.classList.add('bg-pink-500', 'border-pink-500');
                    checkbox{{ $advertisment->id }}.classList.remove('bg-white', 'border-white');
                    adContainer{{ $advertisment->id }}.classList.add('border-pink-500', 'bg-pink-50');
                    adContainer{{ $advertisment->id }}.classList.remove('border-gray-200');
                } else {
                    checkIcon{{ $advertisment->id }}.classList.add('hidden');
                    checkbox{{ $advertisment->id }}.classList.remove('bg-pink-500', 'border-pink-500');
                    checkbox{{ $advertisment->id }}.classList.add('bg-white', 'border-white');
                    adContainer{{ $advertisment->id }}.classList.remove('border-pink-500', 'bg-pink-50');
                    adContainer{{ $advertisment->id }}.classList.add('border-gray-200');
                }
            @endforeach
        }

        function proceedWithSelection() {
            if (selectedAds.length === 0) {
                alert('Please select at least one advertisement.');
                return;
            }

            // Redirect with selected ad IDs
            const adIds = selectedAds.join(',');
            window.location.href = `{{ route('advertising.advertisingVideo') }}?ads=${adIds}`;
        }

        // Close modal when clicking overlay
        document.getElementById('modalOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>

@endsection
