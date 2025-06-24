@section('title', 'Edit Sub Category')

<x-app-layout>
    <div class="pt-7">
        <div class="mb-6"></div>

        <div class="tabs-container f-inter mt-20">
            <div class="bg-[#F7F7F7] lg:w-[28rem] rounded-[2px] mt-[130px]"></div>

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

                <div class="md:hidden">
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
                            class="hidden lg:block align-middle rounded-full focus:shadow-outline-purple focus:outline-none f-plus text-[#228B22] text-[29px] font-[500]"
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

        <div class="bg-[#FFFFFF] rounded-[12px] pt-3 pb-8 px-4 mb-10">
            <h3 class="test-[#0D2927] f-plus font-[500] text-[24px] mb-6">Edit Sub Category</h3>
            <div class="lg:w-[35rem] mx-auto">
                <form action="{{ route('sub-category.update', $subCategory->id) }}" method="post" id="subCategoryForm">
                    @method('PUT')
                    @csrf

                    <!-- Category Selection -->
                    <div class="f-inter flex flex-col mb-6">
                        <label class="f-inter text-[16px] font-[400] text-[#0D2927] mb-1">Category</label>
                        <select name="category_id" id="category_id"
                            class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]">
                            <option value="">Please Select</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $subCategory->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Field Keys Selection -->
                    <div class="f-inter flex flex-col mb-6">
                        <label class="f-inter text-[16px] font-[400] text-[#0D2927] mb-1">Field Types</label>
                        <select name="fields_key[]" id="fields_key"
                            class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]"
                            multiple>
                            @php
                                $selectedFieldKeys = is_array($subCategory->fields_key)
                                    ? $subCategory->fields_key
                                    : json_decode($subCategory->fields_key ?? '[]', true);
                            @endphp
                            <option value="radio" {{ in_array('radio', $selectedFieldKeys) ? 'selected' : '' }}>Radio
                                Buttons</option>
                            <option value="select" {{ in_array('select', $selectedFieldKeys) ? 'selected' : '' }}>
                                Dropdown Select</option>
                            <option value="input" {{ in_array('input', $selectedFieldKeys) ? 'selected' : '' }}>Text
                                Input</option>
                            <option value="checkbox" {{ in_array('checkbox', $selectedFieldKeys) ? 'selected' : '' }}>
                                Checkboxes</option>
                        </select>
                        @error('fields_key')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Dynamic Field Configuration Area -->
                    <div id="dynamicFieldsContainer" class="mb-6">
                        <h4 class="f-inter text-[18px] font-[500] text-[#0D2927] mb-4">Configure Selected Fields</h4>
                        <div id="fieldConfigSections"></div>
                    </div>

                    <!-- Name -->
                    <div class="f-inter flex flex-col mb-6">
                        <label class="f-inter text-[16px] font-[400] text-[#0D2927] mb-1">Name</label>
                        <input type="text" name="name" value="{{ old('name', $subCategory->name) }}"
                            id="name"
                            class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]"
                            placeholder="Enter sub-category name">
                        @error('name')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="f-inter flex flex-col mb-6">
                        <label class="f-inter text-[16px] font-[400] text-[#0D2927] mb-1">Title</label>
                        <input type="text" name="title" value="{{ old('title', $subCategory->title) }}"
                            class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]"
                            placeholder="Enter display title">
                        @error('title')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="f-inter flex flex-col mb-6">
                        <label class="f-inter text-[16px] font-[400] text-[#0D2927] mb-1">Description</label>
                        <textarea name="description" id="description" cols="10" rows="5"
                            class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]">{{ old('description', $subCategory->description) }}</textarea>
                        @error('description')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="f-inter flex flex-col mb-6">
                        <label class="f-inter text-[16px] font-[400] text-[#0D2927] mb-1">Status</label>
                        <select name="status" id="status"
                            class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]">
                            <option value="">Please Select</option>
                            <option value="1" {{ $subCategory->status == true ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ $subCategory->status == false ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                        @error('status')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Hidden input for fields_value -->
                    <input type="hidden" name="fields_value" id="fields_value_input">

                    <!-- Submit Button -->
                    <div class="lg:w-[20rem] mx-auto mb-5 pb-5">
                        <button type="submit"
                            class="f-plus text-[16px] font-[500] text-[#FFFFFF] bg-[#228B22] rounded-[4px] py-3 w-full">
                            Update Sub Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include jQuery and Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Include TinyMCE -->
    <script src="https://unpkg.com/tinymce@6/tinymce.min.js"></script>

    <script>
        // Get fields value data from backend and handle different formats
        let fieldsValueData = {};

        try {
            // Get the raw data from backend
            let rawFieldsValue = @json($subCategory->fields_value ?? []);

            console.log('Raw fields_value from backend:', rawFieldsValue);

            // Handle different data formats
            if (typeof rawFieldsValue === 'string') {
                fieldsValueData = JSON.parse(rawFieldsValue);
            } else if (typeof rawFieldsValue === 'object' && rawFieldsValue !== null) {
                fieldsValueData = rawFieldsValue;
            } else {
                fieldsValueData = {};
            }

            console.log('Processed fieldsValueData:', fieldsValueData);

        } catch (error) {
            console.error('Error parsing fields_value:', error);
            fieldsValueData = {};
        }

        $(document).ready(function() {
            // Initialize Select2 for field keys
            $('#fields_key').select2({
                placeholder: "Select field types",
                allowClear: true
            });

            // Auto-generate slug from name
            $('#name').on('input', function() {
                var name = $(this).val();
                var slug = name.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                $('#slug').val(slug);
            });

            // Handle field type selection changes
            $('#fields_key').on('change', function() {
                generateFieldConfigurations();
            });

            // Initialize field configurations on page load
            generateFieldConfigurations();

            // Handle form submission
            $('#subCategoryForm').on('submit', function(e) {
                collectFieldsValueData();
            });

            // Initialize TinyMCE
            tinymce.init({
                selector: '#description',
                height: 300,
                readonly: false,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste help wordcount'
                ],
                toolbar: 'undo redo | formatselect | bold italic backcolor | \
                         alignleft aligncenter alignright alignjustify | \
                         bullist numlist outdent indent | removeformat | help'
            });
        });

        function generateFieldConfigurations() {
            var selectedFields = $('#fields_key').val() || [];
            var container = $('#fieldConfigSections');
            container.empty();

            console.log('Selected fields:', selectedFields);
            console.log('Available fieldsValueData:', fieldsValueData);

            if (selectedFields.length > 0) {
                $('#dynamicFieldsContainer').show();

                $.each(selectedFields, function(index, fieldType) {
                    console.log('Creating configuration for field type:', fieldType);
                    var fieldConfig = createFieldConfiguration(fieldType);
                    container.append(fieldConfig);
                });
            } else {
                $('#dynamicFieldsContainer').hide();
            }
        }

        function createFieldConfiguration(fieldType) {
            // Get existing data for this field type with better debugging
            var existingData = {
                label: '',
                values: ['']
            };

            if (fieldsValueData && typeof fieldsValueData === 'object' && fieldsValueData[fieldType]) {
                existingData = fieldsValueData[fieldType];
                console.log('Found existing data for', fieldType, ':', existingData);
            } else {
                console.log('No existing data found for', fieldType, '. Using defaults.');
            }

            // Ensure values is always an array
            if (!Array.isArray(existingData.values)) {
                existingData.values = existingData.values ? [existingData.values] : [''];
            }

            // Make sure we have at least one value field
            if (existingData.values.length === 0) {
                existingData.values = [''];
            }

            var fieldHtml = $('<div>', {
                class: 'field-config-section border border-gray-200 rounded-lg p-4 mb-4',
                'data-field-type': fieldType
            });

            // Header
            var header = $('<h5>', {
                class: 'f-inter text-[16px] font-[500] text-[#0D2927] mb-3 capitalize',
                text: fieldType.charAt(0).toUpperCase() + fieldType.slice(1) + ' Field Configuration'
            });

            // Label Input Section
            var labelDiv = $('<div>', { class: 'mb-4' });
            var labelLabel = $('<label>', {
                class: 'f-inter text-[14px] font-[400] text-[#0D2927] mb-1 block',
                text: 'Field Label (Optional)'
            });
            var labelInput = $('<input>', {
                type: 'text',
                class: 'field-label bg-[#EEF6F1] border border-[#F3FFF2] py-3 px-3 text-[14px] font-[400] text-[#323232] rounded-[5px] w-full',
                placeholder: 'Enter field label',
                value: existingData.label || ''
            });

            labelDiv.append(labelLabel).append(labelInput);

            // Values Section
            var valuesDiv = $('<div>', { class: 'mb-4' });
            var valuesLabel = $('<label>', {
                class: 'f-inter text-[14px] font-[400] text-[#0D2927] mb-2 block',
                text: 'Field Options/Values'
            });
            var valuesContainer = $('<div>', { class: 'field-values-container' });

            // Add existing values
            $.each(existingData.values, function(index, value) {
                console.log('Adding value field with value:', value);
                valuesContainer.append(createValueInput(value, index));
            });

            var addButton = $('<button>', {
                type: 'button',
                class: 'add-value-btn mt-2 bg-[#228B22] text-white px-3 py-1 rounded text-sm',
                text: '+ Add Option'
            });

            valuesDiv.append(valuesLabel).append(valuesContainer).append(addButton);

            // Preview Section
            var previewDiv = $('<div>', { class: 'field-preview' });
            var previewLabel = $('<label>', {
                class: 'f-inter text-[14px] font-[400] text-[#0D2927] mb-2 block',
                text: 'Preview:'
            });
            var previewContainer = $('<div>', {
                class: 'preview-container bg-gray-50 p-3 rounded'
            });

            previewDiv.append(previewLabel).append(previewContainer);

            // Build the complete field
            fieldHtml.append(header).append(labelDiv).append(valuesDiv).append(previewDiv);

            // Add event listeners using jQuery
            fieldHtml.on('click', '.add-value-btn', function() {
                var container = $(this).siblings('.field-values-container');
                var valueCount = container.children().length;
                container.append(createValueInput('', valueCount));
                updatePreview(fieldHtml, fieldType);
            });

            fieldHtml.on('click', '.remove-value-btn', function() {
                $(this).closest('.value-input-group').remove();
                updatePreview(fieldHtml, fieldType);
            });

            fieldHtml.on('input', '.field-label, .value-input', function() {
                updatePreview(fieldHtml, fieldType);
            });

            // Generate initial preview
            setTimeout(function() {
                updatePreview(fieldHtml, fieldType);
            }, 100);

            return fieldHtml;
        }

        function createValueInput(value, index) {
            var valueGroup = $('<div>', { class: 'value-input-group flex items-center mb-2' });

            var valueInput = $('<input>', {
                type: 'text',
                class: 'value-input bg-[#EEF6F1] border border-[#F3FFF2] py-2 px-3 text-[14px] font-[400] text-[#323232] rounded-[5px] flex-1',
                placeholder: 'Enter option value',
                value: value || ''
            });

            var removeButton = $('<button>', {
                type: 'button',
                class: 'remove-value-btn ml-2 bg-red-500 text-white px-2 py-1 rounded text-sm',
                text: '×'
            });

            valueGroup.append(valueInput).append(removeButton);
            return valueGroup;
        }

        function generateFieldPreview(fieldType, data) {
            var label = data.label || (fieldType.charAt(0).toUpperCase() + fieldType.slice(1) + ' Field');
            var values = data.values || [''];

            var preview = $('<div>');
            var labelElement = $('<label>', {
                class: 'block mb-2 font-medium',
                text: label
            });
            preview.append(labelElement);

            switch(fieldType) {
                case 'radio':
                    $.each(values, function(index, value) {
                        if (value && value.trim()) {
                            var radioDiv = $('<div>', { class: 'mb-1' });
                            var radioInput = $('<input>', {
                                type: 'radio',
                                name: 'preview_' + fieldType,
                                id: 'preview_' + fieldType + '_' + index,
                                disabled: true
                            });
                            var radioLabel = $('<label>', {
                                for: 'preview_' + fieldType + '_' + index,
                                class: 'ml-2',
                                text: value
                            });
                            radioDiv.append(radioInput).append(radioLabel);
                            preview.append(radioDiv);
                        }
                    });
                    break;

                case 'checkbox':
                    $.each(values, function(index, value) {
                        if (value && value.trim()) {
                            var checkboxDiv = $('<div>', { class: 'mb-1' });
                            var checkboxInput = $('<input>', {
                                type: 'checkbox',
                                id: 'preview_' + fieldType + '_' + index,
                                disabled: true
                            });
                            var checkboxLabel = $('<label>', {
                                for: 'preview_' + fieldType + '_' + index,
                                class: 'ml-2',
                                text: value
                            });
                            checkboxDiv.append(checkboxInput).append(checkboxLabel);
                            preview.append(checkboxDiv);
                        }
                    });
                    break;

                case 'select':
                    var select = $('<select>', {
                        class: 'bg-gray-100 border rounded px-3 py-2 w-full',
                        disabled: true
                    });
                    select.append($('<option>', { text: 'Please select...' }));
                    $.each(values, function(index, value) {
                        if (value && value.trim()) {
                            select.append($('<option>', { text: value }));
                        }
                    });
                    preview.append(select);
                    break;

                case 'input':
                    var input = $('<input>', {
                        type: 'text',
                        class: 'bg-gray-100 border rounded px-3 py-2 w-full',
                        placeholder: (values[0] && values[0].trim()) ? values[0] : 'Enter text...',
                        disabled: true
                    });
                    preview.append(input);
                    break;
            }

            return preview;
        }

        function updatePreview($fieldElement, fieldType) {
            var label = $fieldElement.find('.field-label').val();
            var values = [];

            $fieldElement.find('.value-input').each(function() {
                var value = $(this).val().trim();
                if (value) {
                    values.push(value);
                }
            });

            var data = { label: label, values: values };
            var previewHtml = generateFieldPreview(fieldType, data);
            $fieldElement.find('.preview-container').empty().append(previewHtml);
        }

        function collectFieldsValueData() {
            var fieldsData = {};

            $('.field-config-section').each(function() {
                var fieldType = $(this).data('field-type');
                var label = $(this).find('.field-label').val();
                var values = [];

                $(this).find('.value-input').each(function() {
                    var value = $(this).val().trim();
                    if (value) {
                        values.push(value);
                    }
                });

                fieldsData[fieldType] = {
                    label: label,
                    values: values
                };
            });

            console.log('Collected fields data:', fieldsData);
            $('#fields_value_input').val(JSON.stringify(fieldsData));
        }
    </script>
</x-app-layout>
