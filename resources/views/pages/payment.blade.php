{{-- Blade Template (payment.blade.php) --}}
@extends('layouts.layout')
@push('title')
    Payment
@endpush
@push('styles')
    <style>
        .file-upload-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .file-input {
            display: none;
        }

        .file-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #ff6b9d;
        }

        .preview-container {
            margin-top: 20px;
            display: none;
        }

        .preview-image {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .preview-video {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .file-details {
            text-align: left;
            margin-top: 10px;
        }

        .file-details p {
            margin: 5px 0;
            color: #666;
        }

        .supported-formats {
            margin-top: 15px;
            color: #888;
            font-size: 14px;
        }

        .clear-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 14px;
        }

        .clear-btn:hover {
            background-color: #c82333;
        }

        .upload-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
            display: none;
        }

        .upload-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
            display: none;
        }

        .loading {
            display: none;
            margin-top: 10px;
        }

        .disabled-link {
            opacity: .45;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
@endpush

@section('content')
    <!-- Checkout Progress -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex min-[340px]:flex-col sm:flex-row justify-center gap-3 sm:space-x-4">
            <a href="{{ route('payment.index') }}"
                class="min-[340px]:!px-[40px] sm:px-[60px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full bg-[#ED396C] text-center text-[#fff]">Payment</a>
            {{-- <a href="{{ route('logins.index') }}"
                class="min-[340px]:!px-[40px] sm:px-[60px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full hover:bg-[#ED396C] text-center hover:text-[#fff]">My
                Details</a>
            @auth
                <a href="{{ route('summary.index') }}"
                    class="min-[340px]:!px-[40px] sm:px-[60px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full hover:bg-[#ED396C] text-center hover:text-[#fff]">Summary</a>
            @endauth --}}
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <!-- Package Information -->
            <div class="flex flex-col gap-5">
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                            fill="none">
                            <path
                                d="M20 2C20 11.9411 28.0588 20 38 20C28.0588 20 20 28.0588 20 38C20 28.0588 11.9411 20 2 20C7.331 20 12.1207 17.6824 15.4166 14"
                                stroke="#ED396C" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p>Stat Package - PLN net</p>
                </div>
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                            fill="none">
                            <path
                                d="M20 2C20 11.9411 28.0588 20 38 20C28.0588 20 20 28.0588 20 38C20 28.0588 11.9411 20 2 20C7.331 20 12.1207 17.6824 15.4166 14"
                                stroke="#ED396C" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p>Start Packed - 25,000 views - pln 375 net</p>
                </div>
            </div>
                    {{-- Price / totals ko dynamically dikhaane ke liye --}}
                    @php
                        $pkg = session('selected_package'); //  ['views'=> … , 'price'=> … ]  ya null
                        $price = $pkg['price'] ?? 0; // PLN
                        $delivery = 0; // yahan fix kiya hai (agar kabhī change ho to variable bana lo)
                        $together = $price + $delivery;

                        $paymentMedia = session('payment_media');
                        $hasUploadedFile = !empty($paymentMedia);
                    @endphp
            <!-- Ad Customization -->
            <div class="flex flex-col gap-5 mt-4">
                <div class="flex min-[340px]:flex-col sm:flex-row items-start gap-5">
                    <div class="flex flex-1 flex-col items-start gap-3">
                        <h2 class="text-2xl font-bold text-[#FF0000]">Add - On Standard displays:</h2>

                        <div>
                            <div class="flex items-center gap-3">
                                <input type="radio" id="own-graphics" name="graphics-option"
                                    class="accent-[#ED396C] w-5 h-5 rounded-full" checked>
                                <label for="own-graphics">I have my own Graphics:</label>
                            </div>
                        </div>
                        {{-- <p class="text-lg font-bold ml-8">1920 × 1920</p> --}}

                        <div class="file-upload-container">

                            <form id="fileUploadForm" enctype="multipart/form-data">
                                @csrf
                                                                <div class="f-inter flex flex-col mb-6">
                                    <h2 class="mb-1">Type</h2>

                                    <select name="type" id="type" class="bg-[#EEF6F1] border border-[#F3FFF2] py-4 px-3 text-[16px] font-[400] text-[#323232] rounded-[5px] placeholder-[#323232]">
                                        <option value="">Please Select</option>
                                        <option value="restaurant" {{ (isset($paymentMedia['ad_type']) && $paymentMedia['ad_type'] == 'restaurant') ? 'selected' : '' }}>Restaurant</option>
                                        <option value="hotel" {{ (isset($paymentMedia['ad_type']) && $paymentMedia['ad_type'] == 'hotel') ? 'selected' : '' }}>Hotel</option>
                                        <option value="banner" {{ (isset($paymentMedia['ad_type']) && $paymentMedia['ad_type'] == 'banner') ? 'selected' : '' }}>Banner</option>
                                    </select>

                                </div>
                                <h2>File Upload</h2>
                                <input type="file" id="fileInput" name="media_file" class="file-input"
                                    accept=".png,.jpg,.jpeg,.mp4" />

                                <button type="button" class="btn-pink"
                                    onclick="document.getElementById('fileInput').click()">
                                    Add PNG/JPG/MP4
                                </button>
                            </form>

                            <div class="supported-formats">
                                Supported formats: PNG, JPG, JPEG, MP4
                            </div>

                            <div class="loading" id="loadingIndicator">
                                <p>Uploading file...</p>
                            </div>

                            <div class="upload-success" id="uploadSuccess">
                                <p>File uploaded successfully!</p>
                            </div>

                            <div class="upload-error" id="uploadError">
                                <p id="errorMessage">Upload failed. Please try again.</p>
                            </div>

                            <div id="fileInfo" class="file-info" style="display: none;">
                                <div class="file-details" id="fileDetails"></div>
                                <button class="clear-btn" onclick="clearFile()">Clear File</button>
                            </div>

                            <div id="previewContainer" class="preview-container">
                                <h3>Preview:</h3>
                                <div id="preview"></div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="flex flex-1 flex-col items-start gap-3">
                        <h2 class="text-2xl font-bold text-[#FF0000]">About Order professional graphics +50 PLN</h2>
                        <div class="flex items-center gap-3">
                            <input type="radio" id="professional-graphics" name="graphics-option"
                                class="accent-[#ED396C] w-5 h-5 rounded-full">
                            <label for="professional-graphics">Order professional graphics</label>
                        </div>
                        <p>Within 24 hours of placing your order, our graphic designer will prepare a preliminary version of
                            the creation and<br> send it to your email address.</p>
                        <p>You have full control: you can accept it or submit corrections - we will implement them quickly,
                            so<br> that the final version is exactly what you need.</p>
                    </div> --}}
                </div>

                <!-- Rest of your content remains the same -->
                <!-- Discount Code -->
                {{-- <div class="flex min-[340px]:flex-col gap-4 lg:flex-row items-center w-[100%] max-w-[1000px]">
                    <label class="lg:mr-4">Discount code (enter if you have one)</label>
                    <div class="flex ">
                        <input type="text"
                            class="border border-[#000] rounded px-3 py-2 flex-grow focus:outline-none focus:border-pink-500"
                            placeholder="Enter the discount code">
                        <button class="btn-pink min-[340px]:ml-2 lg:ml-4">Apply</button>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="flex min-[340px]:flex-col min-[700px]:flex-row gap-4 justify-left lg:space-x-4 lg:40 xl:ms-60">
                    <button
                        class="px-[35px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full bg-[#ED396C] text-[#fff]">Fast
                        Online Transfer</button>
                    <button
                        class="px-[35px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full hover:bg-[#ED396C] hover:text-[#fff]">Payment
                        Card Online</button>
                    <button
                        class="px-[35px] py-1 border border-[#ED396C] text-[#ED396C] rounded-full hover:bg-[#ED396C] hover:text-[#fff]">Traditional
                        Transfer</button>
                </div> --}}

                <!-- Order Summary -->
                <div class="flex flex-col gap-3 w-[100%] max-w-[300px] ms-auto">


                    <div class="flex flex-col gap-3 w-[100%] max-w-[300px] ms-auto">
                        {{-- Value of products --}}
                        <div class="flex justify-between">
                            <span>Value of products</span>
                            <span class="font-bold">
                                {{ number_format($price, 2, ',', '.') }}zł
                            </span>
                        </div>

                        {{-- Delivery cost --}}
                        <div class="flex justify-between">
                            <span>Delivery cost</span>
                            <span class="font-bold">
                                {{ number_format($delivery, 2, ',', '.') }}zł
                            </span>
                        </div>

                        {{-- Together (Grand total) --}}
                        <div class="flex justify-between text-xl font-bold text-[#ED396C]">
                            <span>Together</span>
                            <span>
                                {{ number_format($together, 2, ',', '.') }}zł
                            </span>
                        </div>
                    </div>



                    {{-- Update the Next button section --}}
                    <div class="flex justify-center">
                        <a id="nextButton"
                            href="{{ route('logins.index') }}"
                            class="btn-pink px-[60px] {{ !$hasUploadedFile ? 'disabled-link' : '' }}">
                            Next
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Session data from server
        const sessionData = @json($paymentMedia);
        const hasUploadedFile = @json($hasUploadedFile);

        // DOM elements
        const fileInput = document.getElementById('fileInput');
        const fileInfo = document.getElementById('fileInfo');
        const fileDetails = document.getElementById('fileDetails');
        const previewContainer = document.getElementById('previewContainer');
        const preview = document.getElementById('preview');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const uploadSuccess = document.getElementById('uploadSuccess');
        const uploadError = document.getElementById('uploadError');
        const errorMessage = document.getElementById('errorMessage');
        const nextButton = document.getElementById('nextButton');
        const typeSelect = document.getElementById('type');

        // Initialize page on load
        document.addEventListener('DOMContentLoaded', function() {
            if (hasUploadedFile && sessionData) {
                // Show file info
                displaySessionFileInfo(sessionData);

                // Show preview if possible
                displaySessionPreview(sessionData);

                // Show success message
                uploadSuccess.style.display = 'block';

                // Enable next button
                nextButton.classList.remove('disabled-link');
            } else {
                nextButton.classList.add('disabled-link');
            }
        });


// Add this in your Blade template's script section
const appBaseUrl = @json(url('/'));

        function displaySessionPreview(data) {
    // Since files are stored in public directory, construct the correct URL
    // Remove the old base URL and use the correct path
   const fileUrl = `${appBaseUrl}/${data.file_path}`;

    preview.innerHTML = '';

    if (data.type === 'image') {
        const img = document.createElement('img');
        img.classList.add('preview-image');
        img.src = fileUrl;
        img.onerror = function() {
            console.error('Failed to load image:', fileUrl);
            // Show a placeholder or error message
            preview.innerHTML = '<p style="color: #666; padding: 20px; border: 2px dashed #ddd; border-radius: 8px;">Image preview not available<br><small>Path: ' + fileUrl + '</small></p>';
        };
        img.onload = function() {
            console.log('Image loaded successfully:', fileUrl);
        };
        preview.appendChild(img);
        previewContainer.style.display = 'block';
    } else if (data.type === 'video') {
        const video = document.createElement('video');
        video.classList.add('preview-video');
        video.controls = true;
        video.src = fileUrl;
        video.onerror = function() {
            console.error('Failed to load video:', fileUrl);
            // Show a placeholder or error message
            preview.innerHTML = '<p style="color: #666; padding: 20px; border: 2px dashed #ddd; border-radius: 8px;">Video preview not available<br><small>Path: ' + fileUrl + '</small></p>';
        };
        video.onloadeddata = function() {
            console.log('Video loaded successfully:', fileUrl);
        };
        preview.appendChild(video);
        previewContainer.style.display = 'block';
    }
}

// Also update the displaySessionFileInfo function to show more details
function displaySessionFileInfo(data) {
    const uploadedDate = new Date(data.uploaded_at);

    fileDetails.innerHTML = `
        <p><strong>File Name:</strong> ${data.original_name}</p>
        <p><strong>File Type:</strong> ${data.type} (${data.ad_type})</p>
        <p><strong>File Path:</strong> ${data.file_path}</p>
        <p><strong>Uploaded:</strong> ${uploadedDate.toLocaleString()}</p>
        <p><strong>Status:</strong> <span style="color: green;">✓ Uploaded Successfully</span></p>
    `;

    fileInfo.style.display = 'block';
}

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                displayFileInfo(file);
                displayPreview(file);
                uploadFile(file);
            }
        });

        function displayFileInfo(file) {
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            const fileType = file.type;
            const fileName = file.name;

            fileDetails.innerHTML = `
                <p><strong>File Name:</strong> ${fileName}</p>
                <p><strong>File Size:</strong> ${fileSize} MB</p>
                <p><strong>File Type:</strong> ${fileType}</p>
                <p><strong>Last Modified:</strong> ${new Date(file.lastModified).toLocaleString()}</p>
            `;

            fileInfo.style.display = 'block';
        }

        function displayPreview(file) {
            const fileType = file.type;
            preview.innerHTML = '';

            if (fileType.startsWith('image/')) {
                const img = document.createElement('img');
                img.classList.add('preview-image');
                img.src = URL.createObjectURL(file);
                img.onload = function() {
                    URL.revokeObjectURL(this.src);
                };
                preview.appendChild(img);
                previewContainer.style.display = 'block';
            } else if (fileType.startsWith('video/')) {
                const video = document.createElement('video');
                video.classList.add('preview-video');
                video.controls = true;
                video.src = URL.createObjectURL(file);
                video.onload = function() {
                    URL.revokeObjectURL(this.src);
                };
                preview.appendChild(video);
                previewContainer.style.display = 'block';
            }
        }

// Enhanced file upload function with better error handling and alerts
function uploadFile(file) {
    const formData = new FormData();
    const selectedType = typeSelect.value;

    // Client-side validation with alerts
    if (!selectedType) {
        // alert('Validation Error: Please select a type before uploading.');
        uploadError.style.display = 'block';
        errorMessage.textContent = 'Please select a type before uploading.';
        return;
    }

    // File size validation (10MB limit)
    const maxSize = 10 * 1024 * 1024; // 10MB in bytes
    if (file.size > maxSize) {
        // alert('Validation Error: File size must be less than 10MB.');
        uploadError.style.display = 'block';
        errorMessage.textContent = 'File size must be less than 10MB.';
        return;
    }

    // File type validation
    const allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'video/mp4'];
    if (!allowedTypes.includes(file.type)) {
        // alert('Validation Error: Please select a PNG, JPG, JPEG, or MP4 file.');
        uploadError.style.display = 'block';
        errorMessage.textContent = 'Please select a PNG, JPG, JPEG, or MP4 file.';
        return;
    }

    formData.append('media_file', file);
    formData.append('type', selectedType);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    // Hide previous messages
    uploadSuccess.style.display = 'none';
    uploadError.style.display = 'none';
    loadingIndicator.style.display = 'block';

    fetch('{{ route('payment.upload') }}', {
            method: 'POST',
            body: formData
        })
        .then(async response => {
            const data = await response.json();
            return {
                ok: response.ok,
                status: response.status,
                body: data
            };
        })
        .then(({ ok, status, body }) => {
            loadingIndicator.style.display = 'none';

            if (ok && body.success) {
                // Success case
                // alert('Success: File uploaded successfully!');
                uploadSuccess.style.display = 'block';
                nextButton.classList.remove('disabled-link');
            } else {
                // Handle different types of errors
                let errorMsg = 'Upload failed. Please try again.';

                if (body.errors) {
                    // Laravel validation errors
                    let validationErrors = [];
                    Object.keys(body.errors).forEach(field => {
                        validationErrors = validationErrors.concat(body.errors[field]);
                    });
                    errorMsg = 'Validation Errors:\n\n' + validationErrors.join('\n');
                } else if (body.message) {
                    // Custom error message
                    errorMsg = body.message;
                } else if (status === 413) {
                    // File too large
                    errorMsg = 'File is too large. Maximum size is 10MB.';
                } else if (status === 422) {
                    // Unprocessable entity (validation error)
                    errorMsg = 'Invalid file format or validation error.';
                }

                // alert('Upload Error: ' + errorMsg);
                uploadError.style.display = 'block';
                errorMessage.textContent = errorMsg;
                nextButton.classList.add('disabled-link');
            }
        })
        .catch(error => {
            loadingIndicator.style.display = 'none';
            console.error('Network error:', error);

            const networkErrorMsg = 'Network error. Please check your connection and try again.';
            // alert('Network Error: ' + networkErrorMsg);

            uploadError.style.display = 'block';
            errorMessage.textContent = networkErrorMsg;
            nextButton.classList.add('disabled-link');
        });
}

// Enhanced drag and drop with validation alerts
container.addEventListener('drop', function(e) {
    e.preventDefault();
    container.style.backgroundColor = 'white';

    const files = e.dataTransfer.files;
    if (files.length > 0) {
        const file = files[0];

        // Validate file type
        const supportedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'video/mp4'];
        if (!supportedTypes.includes(file.type)) {
            // alert('Validation Error: Please select a PNG, JPG, JPEG, or MP4 file.');
            return;
        }

        // Validate file size
        const maxSize = 10 * 1024 * 1024; // 10MB
        if (file.size > maxSize) {
            // alert('Validation Error: File size must be less than 10MB.');
            return;
        }

        // Validate type selection
        if (!typeSelect.value) {
            // alert('Validation Error: Please select a type before uploading.');
            return;
        }

        const dt = new DataTransfer();
        dt.items.add(file);
        fileInput.files = dt.files;

        displayFileInfo(file);
        displayPreview(file);
        uploadFile(file);
    }
});

// Enhanced file input change handler
fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        // Validate type selection first
        if (!typeSelect.value) {
            // alert('Validation Error: Please select a type before uploading.');
            // Clear the file input
            fileInput.value = '';
            return;
        }

        displayFileInfo(file);
        displayPreview(file);
        uploadFile(file);
    }
});

// Add validation to type selection
typeSelect.addEventListener('change', function() {
    // If there's already a file selected, show a message
    if (fileInput.files.length > 0) {
        // alert('Information: Type changed. Please re-upload your file to apply the new type.');
        clearFile();
    }
});

        function clearFile() {
            // UI ko turant reset karo
            fileInput.value = '';
            fileInfo.style.display = 'none';
            previewContainer.style.display = 'none';
            preview.innerHTML = '';
            uploadSuccess.style.display = 'none';
            uploadError.style.display = 'none';
            nextButton.classList.add('disabled-link');

            // Reset type dropdown
            typeSelect.value = '';

            // server ko bhi batao
            fetch('{{ route('payment.clear.file') }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
        }

        // Drag and drop functionality
        const container = document.querySelector('.file-upload-container');

        container.addEventListener('dragover', function(e) {
            e.preventDefault();
            container.style.backgroundColor = '#f0f8ff';
            container.style.borderColor = '#ff6b9d';
        });

        container.addEventListener('dragleave', function(e) {
            e.preventDefault();
            container.style.backgroundColor = 'white';
        });

        container.addEventListener('drop', function(e) {
            e.preventDefault();
            container.style.backgroundColor = 'white';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];

                const supportedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'video/mp4'];
                if (supportedTypes.includes(file.type)) {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    fileInput.files = dt.files;

                    displayFileInfo(file);
                    displayPreview(file);
                    uploadFile(file);
                } else {
                    alert('Please select a PNG, JPG, or MP4 file.');
                }
            }
        });

    </script>
@endpush
