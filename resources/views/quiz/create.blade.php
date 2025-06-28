@section('title', 'Quiz Create')

<x-app-layout>
    <div class="pt-[5rem] overflow-x-hidden">

        <div class="tabs-container f-inter mt-10">


            <div
                class="container hidden lg:flex gap-[20px] justify-between items-center mt-[-7.5rem] mx-auto h-full text-[#228B22] md:justify-end bg-transparent py-3">

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

                    <svg width="168" height="38" viewBox="0 0 168 38" fill="none" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M42.176 31L46.368 19.08H48.704L52.896 31H50.88L49.968 28.328H45.12L44.192 31H42.176ZM45.664 26.648H49.392L47.28 20.408H47.808L45.664 26.648ZM54.9501 31V19.08H58.8541C60.0915 19.08 61.1635 19.3307 62.0701 19.832C62.9875 20.3227 63.6968 21.016 64.1981 21.912C64.6995 22.808 64.9501 23.848 64.9501 25.032C64.9501 26.2053 64.6995 27.2453 64.1981 28.152C63.6968 29.048 62.9875 29.7467 62.0701 30.248C61.1635 30.7493 60.0915 31 58.8541 31H54.9501ZM56.8381 29.32H58.8861C59.7288 29.32 60.4595 29.144 61.0781 28.792C61.7075 28.44 62.1928 27.944 62.5341 27.304C62.8755 26.664 63.0461 25.9067 63.0461 25.032C63.0461 24.1573 62.8701 23.4053 62.5181 22.776C62.1768 22.136 61.6968 21.64 61.0781 21.288C60.4595 20.936 59.7288 20.76 58.8861 20.76H56.8381V29.32ZM67.4495 31V19.08H69.2095L73.6895 25.288H72.8095L77.2095 19.08H78.9695V31H77.0975V21.304L77.8015 21.496L73.3055 27.64H73.1135L68.7135 21.496L69.3375 21.304V31H67.4495ZM82.0739 31V19.08H83.9619V31H82.0739ZM87.0733 31V19.08H88.5933L95.2813 28.312L94.5613 28.424V19.08H96.4333V31H94.9133L88.2733 21.704L88.9613 21.576V31H87.0733ZM102.978 31V19.08H107.314C108.114 19.08 108.818 19.2293 109.426 19.528C110.045 19.816 110.525 20.2427 110.866 20.808C111.208 21.3627 111.378 22.0293 111.378 22.808C111.378 23.576 111.202 24.2373 110.85 24.792C110.509 25.3467 110.034 25.7733 109.426 26.072C108.818 26.3707 108.114 26.52 107.314 26.52H104.866V31H102.978ZM104.866 24.84H107.362C107.789 24.84 108.162 24.7547 108.482 24.584C108.802 24.4133 109.053 24.1787 109.234 23.88C109.416 23.5707 109.506 23.208 109.506 22.792C109.506 22.376 109.416 22.0187 109.234 21.72C109.053 21.4107 108.802 21.176 108.482 21.016C108.162 20.8453 107.789 20.76 107.362 20.76H104.866V24.84ZM111.953 31L116.145 19.08H118.481L122.673 31H120.657L119.745 28.328H114.897L113.969 31H111.953ZM115.441 26.648H119.169L117.057 20.408H117.585L115.441 26.648ZM124.727 31V19.08H126.247L132.935 28.312L132.215 28.424V19.08H134.087V31H132.567L125.927 21.704L126.615 21.576V31H124.727ZM137.195 31V19.08H138.715L145.403 28.312L144.683 28.424V19.08H146.555V31H145.035L138.395 21.704L139.083 21.576V31H137.195ZM149.663 31V19.08H157.519V20.76H151.551V24.184H157.199V25.864H151.551V29.32H157.519V31H149.663ZM159.913 31V19.08H161.801V29.32H166.953V31H159.913Z"
                            fill="#22421A" />
                        <rect width="38" height="38" fill="url(#pattern0_16_3123)" />
                        <defs>
                            <pattern id="pattern0_16_3123" patternContentUnits="objectBoundingBox" width="1" height="1">
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
                            src="{{ asset('storage/storage/images/avatar.png') }}" alt="" @click="toggleProfileMenu"
                            @keydown.escape="closeProfileMenu" aria-label="Account" aria-haspopup="true">
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profile.edit') }}">
                            <x-slot name="icon">
                                <svg class="mr-3 w-4 h-4" aria-hidden="true" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
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
                                    <svg class="mr-3 w-4 h-4" aria-hidden="true" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                        stroke="currentColor">
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
            {{-- <a href="{{ route('quiz.create') }}"
                class="f-plus text-[16px] font-[500] text-[#228B22] flex items-center gap-[10px]">
                Add New Quiz <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect width="25" height="25" rx="3" fill="#228B22" />
                    <path d="M12.75 7V18.5" stroke="white" stroke-width="2" stroke-linecap="round" />
                    <path d="M18.5 12.75L7 12.75" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>

            </a> --}}
        </div>
        <div class="bg-[#FFFFFF] rounded-[12px] pt-3 pb-10 mb-10 px-4">
            <h3 class="text-[#0D2927] f-plus font-[500] text-[24px]">Add New Quiz</h3>


            <div class="overflow-x-auto">
                <div class="lg:w-[35rem] mx-auto">
                    <form method="post" action="{{ route('quiz.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="f-inter flex flex-col mb-6">
                            <label for="quiz_no" class="f-inter text-[16px] text-[#0D2927] mb-1 font-bold">Quiz
                                No.</label>
                            <x-text-input id="quiz_no" name="quiz_no" type="number"
                                class="mt-1 block w-full placeholder-[#323232]" :value="old('quiz_no')" required
                                autofocus placeholder="Enter Quiz No." />
                            @error('quiz_no')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="f-inter flex flex-col mb-6">
                            <label for="question"
                                class="f-inter text-[16px] text-[#0D2927] mb-1 font-bold">Question</label>
                            <textarea id="question" name="question" required
                                class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]"
                                placeholder="Enter Question">{{ old('question') }}</textarea>
                            @error('question')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="f-inter flex flex-col mb-6">
                            <label for="image" class="f-inter text-[16px] text-[#0D2927] mb-1 font-bold">Image</label>
                            <input id="image" name="image" type="file"
                                class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] w-full">
                            @error('image')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="ans" class="mb-6">
                            <div class="ansdiv">
                                <label class="f-inter mt-5 text-[16px] text-[#0D2927] mb-1 font-bold">Answer</label>
                                <div class="flex w-full items-center">
                                    <input required type="text" name="answers[]"
                                        class="bg-white flex-grow border border-[#F3FFF2] py-4 px-3 rounded-[5px]">

                                    <div class="flex items-center ml-4">
                                        <input required type="radio" id="is_correct_0" name="is_correct" value="0"
                                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300" checked>
                                        <label for="is_correct_0"
                                            class="ml-2 text-sm font-medium text-gray-700 whitespace-nowrap">Correct</label>
                                    </div>

                                    <button id="addnew" type="button" class="ml-4">
                                        <svg style="width: 20px; height: 20px;" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 448 512">
                                            <path style="fill:#228B22"
                                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="mt-3">
                                    <label class="f-inter mt-3 text-[16px] text-[#0D2927] mb-1 font-bold">Tag</label>
                                    <select name="tag[0][]" required multiple
                                        class="tags-select w-full bg-[#EEF6F1] border border-[#F3FFF2] text-[16px] font-[400] text-[#323232] rounded-[5px]">
                                        <option value="" disabled>Select a tag</option>
                                        @foreach ($advertiseMents as $advertiseMent)
                                        <option value="{{ $advertiseMent->id }}">{{ $advertiseMent->tag }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('answers')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="lg:w-[20rem] mx-auto mb-5 pb-5">
                            <button type="submit"
                                class="f-plus text-[16px] font-[500] text-white bg-[#228B22] rounded-[4px] py-3 w-full">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
    <script>
        $(document).ready(function() {
        $('.tags-select').select2();
        let answerIndex = 1;
        $("#addnew").on('click', function() {
            let tag = @json($advertiseMents);
            let options = `<option value="" disabled>Select a tag</option>`;
            tag.forEach(function(advertiseMent) {
                options += `<option value="${advertiseMent.id}">${advertiseMent.tag}</option>`;
            });

            let newAnswerBlock = `
            <div class="ansdiv mt-5">
                <label class="f-inter mt-5 text-[16px] text-[#0D2927] mb-1 font-bold">Answer</label>
                <div class="flex w-full items-center">
                    <input required type="text" name="answers[]"
                        class="bg-[#EEF6F1] flex-grow border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]">

                    <div class="flex items-center ml-4">
                        <input required type="radio" id="is_correct_${answerIndex}" name="is_correct" value="${answerIndex}"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                        <label for="is_correct_${answerIndex}" class="ml-2 text-sm font-medium text-gray-700 whitespace-nowrap">Correct</label>
                    </div>

                    <button class="ml-4 minusdiv" type="button">
                        <svg style="width: 15px; height: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="#ff0000" d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" />
                        </svg>
                    </button>
                </div>

                <div class="mt-3">
                    <label class="f-inter mt-3 text-[16px] text-[#0D2927] mb-1 font-bold">Tag</label>
                    <select name="tag[${answerIndex}][]" required multiple
                        class="tags-select w-full bg-[#EEF6F1] border border-[#F3FFF2] text-[16px] font-[400] text-[#323232] rounded-[5px]">
                        ${options}
                    </select>
                </div>
            </div>`;


            $("#ans").append(newAnswerBlock);

            $('.tags-select').select2();

            answerIndex++;
        });

            $(this).closest('.ansdiv').remove();
        });
    </script>

    {{-- <script>
        new TomSelect('.tags-select', {
            plugins: ['remove_button'],
            create: false, // set to true if you want to allow new tags
            maxItems: null, // unlimited selections
            placeholder: 'Select tags...',
            render: {
                option: function(data, escape) {
                    return `<div class="px-3 py-2">${escape(data.text)}</div>`;
                },
                item: function(data, escape) {
                    return `<div class="px-2">${escape(data.text)}</div>`;
                }
            }
        });
    </script> --}}



</x-app-layout>
