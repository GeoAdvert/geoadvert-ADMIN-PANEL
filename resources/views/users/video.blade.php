<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <title>Document</title>
    <style>
        /* opacity: 1;
            -webkit-transform: scale(0.999);
            transform: scale(0.999); */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .video-container {
            animation: fadeIn 3s;
            width: 100%;
            height: auto;
            padding: 0;
            top: 0;
            left: 0;
            margin: auto;

        }

        img,
        video {
            animation: fadeIn 3s;

        }

        #noVideosMessage {
            font-size: 1.5em;
            color: red;
            text-align: center;
            margin-top: 20px;
        }

        #quizContainer div {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
        }

        #quizContainer h3 {
            color: #333;
        }

        #quizContainer ul {
            list-style-type: none;
            padding: 0;
        }

        #quizContainer li {
            cursor: pointer;
            background-color: #fff;
            margin-top: 5px;
            padding: 5px;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body style="overflow: hidden">
    <button style="position: absolute;opacity: 0.3;
    right: 0.5rem;z-index: 1111111111111111111111111111;"
        id="fullscreenbtn" type="button"><svg style="width:2rem" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path
                d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
        </svg></button>

    <div class="video-container mt-2">
        <div class="flex justify-between mr-2 hidendivB">
            <a href="{{ route('index') }}" class="text-center text-2xl"><svg height="51px" id="Layer_1"
                    style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="51px"
                    xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <polygon points="352,128.4 319.7,96 160,256 160,256 160,256 319.7,416 352,383.6 224.7,256 " />
                </svg>
            </a>
        </div>
        <video autoplay muted id="mainVideo" style="display: none;width:100%;height:100vh">
        </video>
        <img src="" alt="" srcset="" id="mainImg" style="display: none;width:100%;height:100vh">
        <div id="noVideosMessage" style="display: none;"></div>

        <div id="quizModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
            style="display: none; z-index: 9999;">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full mx-4">
                <h2 id="quizQuestion" class="text-xl font-bold mb-4"></h2>
                <div id="quizContainer" class="space-y-4">
                    <div id="quizAnswer" class="w-full p-2 border rounded">Answer will appear here</div>
                    {{-- <button onclick="handleQuizAnswer()" class="w-full p-3 bg-blue-500 text-white rounded hover:bg-blue-600">Show Answer</button> --}}
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            var videoPlayer = document.getElementById("mainVideo"); // Corrected ID
            var noVideosMessage = document.getElementById('noVideosMessage');
            var img = document.getElementById("mainImg");
            var videos = [];
            var vedio = @json($ads);
            var quizzes = @json($quizzes);
            var independentAd = @json($independentAd);
            var currentQuizIndex = 0;
            var quizActive = false;
            var adCount = 0;
            var quizCount = 0; // Track the number of times quiz modal is shown
            var totalQuizLimit = independentAd.total_quiz || 3; // Default to 3 if not defined
            var totalAds = @json(config('services.total_ad'));
            let selectedAdvertisementId = null;
            var mediaQueue = []; // Store ads data
            var mediaIndex = 0; // Current index in mediaQueue
            var adDisplayCount = 0; // Track ads shown
            var maxAdsBeforeQuiz = @json(config('services.maxAdsBeforeQuiz')); // Number of ads before showing quiz
            let quizTimeout;

            $.each(vedio, function(index, item) {
                let mydata = {
                    src: "{{ asset('storage/media') }}/" + item.fileName,
                    type: item.fileType,
                    duration: item.videoDuration
                };
                // Use 'item' to access the current element in the loop
                videos.push(mydata);
            });



function showQuiz() {
    quizActive = true;

    // Clear any previous timeout to avoid multiple calls
    if (quizTimeout) {
        clearTimeout(quizTimeout);
    }

    // Set timeout to call fetchMediaData() after 10 seconds of inactivity
    quizTimeout = setTimeout(() => {
        console.log("No answer selected within 10 seconds. Fetching new media...");
        document.getElementById('quizModal').style.display = 'none';
        quizActive = false;
        fetchMediaData();
    }, 10000); // 10 seconds = 10000 ms

    // Quiz logic continues...
    const quizModal = document.getElementById('quizModal');
    const quizQuestion = document.getElementById('quizQuestion');
    const answerContainer = document.getElementById('quizAnswer');

    if (quizzes.length === 0 || !quizzes[currentQuizIndex]) {
        console.error("No quizzes available to show.");
        fetchMediaData();
        return;
    }

    const currentQuiz = quizzes[currentQuizIndex];

    quizQuestion.textContent = currentQuiz.question;
    answerContainer.innerHTML = '';

    currentQuiz.answers.forEach(answer => {
        let answerDiv = document.createElement('div');
        answerDiv.textContent = answer.ans;
        answerDiv.classList.add('answer');

        answerDiv.onclick = function () {
            clearTimeout(quizTimeout); // ✅ Cancel the timeout if user clicks
            handleQuizAnswer(answer.advertisement_id);
        };

        answerContainer.appendChild(answerDiv);
    });

    quizModal.style.display = 'flex';
    quizCount++;
}


            function handleQuizAnswer(advertisementId) {
                quizActive = false;
                console.log(`Advertisement ID to send: ${advertisementId}`);

                adCount = 0;
                document.getElementById('quizModal').style.display = 'none';

                currentQuizIndex = (currentQuizIndex + 1) % quizzes.length;

                console.log("Advertisement clicked:", advertisementId);
                selectedAdvertisementId = advertisementId;

                sendLocation(advertisementId);
            }

            function displayMediaQueue() {
                if (mediaQueue.length === 0) {
                    console.log("No media available.");
                    return;
                }

                // Adjust maxAdsBeforeQuiz based on available ads
                var adsToShow = Math.min(mediaQueue.length, maxAdsBeforeQuiz);

                if (adDisplayCount >= adsToShow) {
                    console.log("Showing Quiz after ads!");
                    showQuiz(); // Call quiz modal function
                    adDisplayCount = 0; // Reset ad counter
                    return;
                }

                var media = mediaQueue[mediaIndex]; // Get current media
                var videoPlayer = document.getElementById("mainVideo");
                var imgElement = document.getElementById("mainImg");
                var noVideosMessage = document.getElementById("noVideosMessage");

                // Hide previous content
                videoPlayer.style.display = 'none';
                imgElement.style.display = 'none';
                noVideosMessage.style.display = 'none';

                if (media.fileType === "video") {
                    videoPlayer.src = "{{ asset('storage/media') }}/" + media.fileName;
                    videoPlayer.style.display = 'block';
                    videoPlayer.play();

                    setTimeout(() => {
                        adDisplayCount++; // Increase ad count
                        mediaIndex++;

                        if (adDisplayCount >= adsToShow) {
                            console.log("Triggering Quiz after last ad!");
                            showQuiz();
                            adDisplayCount = 0; // Reset counter
                        } else {
                            if (mediaIndex < mediaQueue.length) {
                                displayMediaQueue();
                            } else {
                                mediaIndex = 0; // Restart queue if needed
                            }
                        }
                    }, media.videoDuration);
                } else if (media.fileType === "image") {
                    imgElement.src = "{{ asset('storage/media') }}/" + media.fileName;
                    imgElement.style.display = 'block';

                    setTimeout(() => {
                        adDisplayCount++; // Increase ad count
                        mediaIndex++;

                        if (adDisplayCount >= adsToShow) {
                            console.log("Triggering Quiz after last ad!");
                            showQuiz();
                            adDisplayCount = 0; // Reset counter
                        } else {
                            if (mediaIndex < mediaQueue.length) {
                                displayMediaQueue();
                            } else {
                                mediaIndex = 0; // Restart queue if needed
                            }
                        }
                    }, media.videoDuration);
                } else {
                    noVideosMessage.style.display = 'block';
                    noVideosMessage.innerText = 'No valid media available';
                }
            }

            // Function to send location and get media data
            function fetchMediaData() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        $.ajax({
                            url: "{{ route('getLocation') }}",
                            type: 'POST',
                            data: JSON.stringify({
                                latitude: latitude,
                                longitude: longitude,
                                // advertisement_id: null // Send null advertisement_id
                            }),
                            contentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log('Received Media Data:', response.data);

                                if (response.data.length > 0) {
                                    mediaQueue = response.data.map(item => ({
                                        fileName: item.fileName,
                                        fileType: item.fileType,
                                        videoDuration: item.videoDuration
                                    }));

                                    mediaIndex = 0; // Reset index
                                    adDisplayCount = 0; // Reset ad counter
                                    displayMediaQueue(); // Start displaying media
                                } else {
                                    console.log("No media found.");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching media:', error);
                            }
                        });
                    });
                } else {
                    console.error('Geolocation is not supported by this browser.');
                }
            }





            console.log(videos);

            function adCounter() {
                adCount++; // Increment the counter
                console.log(adCount);
                if (adCount >= totalAds) { // Check if two ads have been shown
                    showQuiz();
                    videoPlayer.style.display = 'none'; // Hide video player
                    img.style.display = 'none'; // Hide image
                    noVideosMessage.style.display = 'block'; // Show no videos message
                    noVideosMessage.innerText = 'No Ads available'; // Set the text


                    adCount = 0; // Reset the counter
                } else {
                    playNextVideo(); // Continue playing next video or image
                }
            }


            var videoIndex = 0;

            function playNextVideo() {
                if (videos.length === 0) {
                    // Display "No videos available" message
                    videoPlayer.style.display = 'none'; // Hide video player
                    img.style.display = 'none'; // Hide image
                    noVideosMessage.style.display = 'block'; // Show no videos message
                    noVideosMessage.innerText = 'No videos available'; // Set the text
                    return; // Exit the function
                }

                // Hide the no videos message if it was previously shown
                noVideosMessage.style.display = 'none';
                quizActive = true;
                if (videos.length > 0) {
                    if (videoIndex < videos.length) {
                        if (videos[videoIndex].type === 'video') {

                            var videoDuration = videos[videoIndex].duration ||
                                20000; // Use videoDuration or fallback to 20000ms (20 seconds)
                            console.log("Video Duration:", videoDuration);

                            videoPlayer.style.display = 'block';
                            img.style.display = 'none';
                            videoPlayer.src = videos[videoIndex].src;

                            triggerAjaxRequest(videos[videoIndex].id);

                            // Ensure the video starts playing
                            videoPlayer.play();

                            // Track the time elapsed while the video is playing
                            var elapsedTime = 0;

                            // Set an interval to track elapsed time and update it during video playback
                            var interval = setInterval(function() {
                                elapsedTime += 1000; // Increase elapsed time by 1 second (1000ms)

                                // Check if the video duration has been reached
                                if (elapsedTime >= videoDuration) {
                                    clearInterval(interval); // Stop the interval when the duration is reached
                                    adCounter(); // Move to the next ad
                                }
                            }, 1000); // Update every second (1000ms)

                            // Event listener to loop the video until the required videoDuration is reached
                            videoPlayer.addEventListener("ended", function() {
                                // If the total elapsed time is less than the video duration, loop the video
                                if (elapsedTime < videoDuration) {
                                    videoPlayer.currentTime = 0; // Reset to the beginning of the video
                                    videoPlayer.play(); // Play the video again
                                }
                            });

                            // Move to the next video in the playlist
                            videoIndex++;

                            // Call the ad counter
                        } else {
                            // Handle image item with its video duration
                            var time = videos[videoIndex].duration;

                            // Hide video player and show image
                            videoPlayer.style.display = 'none';
                            img.style.display = 'block';
                            img.src = videos[videoIndex].src;

                            triggerAjaxRequest(videos[videoIndex].id);

                            // Remove any previous video event listener
                            videoPlayer.addEventListener("ended", adCounter);
                            videoPlayer.removeEventListener("ended", playNextVideo);

                            // Move to the next item after the image duration
                            videoIndex++;

                            // Set a timeout to skip to the next video/image after the specified time
                            setTimeout(() => {
                                adCounter();

                            }, time); // Ensure the time is in milliseconds
                        }
                    } else {
                        // Restart the playlist if we are at the end
                        videoIndex = 0;
                        playNextVideo();
                    }
                } else {
                    // Call adCounter when there are no videos or images to play
                }
            }


            function triggerAjaxRequest(id) {
                $.ajax({
                    url: '{{ route('views') }}', // Your AJAX endpoint
                    type: 'POST', // HTTP method
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        id: id, // Send the id in the request body
                        action: 'view' // Action type
                    }),
                    success: function(response) {
                        console.log('Request was successful:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('There was an error with the AJAX request:', error);
                    }
                });
            }

            // videoPlayer.addEventListener("ended", playNextVideo);
            function handleMediaEnd() {
                videoIndex = (videoIndex + 1) % videos.length;
                showQuiz();
            }

            // Start playing the first video
            playNextVideo();
            showQuiz();





            var detectedLocation = false;
            var notDetectedLocation = false;

            function sendLocation() {
                if (!selectedAdvertisementId) {
                    console.log("No advertisement selected yet.");
                    return; // Do nothing if no advertisement is selected
                }
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        // console.log("location : ", latitude, longitude);
                        $.ajax({
                            url: "{{ route('getLocation') }}",
                            type: 'POST',
                            data: JSON.stringify({
                                latitude: latitude,
                                longitude: longitude,
                                advertisement_id: selectedAdvertisementId
                            }),
                            contentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // console.log('Location data sent successfully:', response.data);
                                // console.log(response.isLocationBased);
                                console.log('Ads Data: ' , response.data);
                                // updateVideoQueue(vedio);
                                // if (response.isLocationBased) {
                                    console.log('location base');
                                    if (!detectedLocation) {
                                        console.log('location base call');
                                        detectedLocation = false;
                                        notDetectedLocation = false;

                                        videos = [];
                                        // console.log(videos);
                                        $.each(response.data, function(index, item) {
                                            let mydata = {
                                                src: "{{ asset('storage/media') }}/" + item
                                                    .fileName,
                                                type: item.fileType,
                                                duration: item.videoDuration,
                                                distance: item.distance,
                                                id: item.id
                                            };
                                            // Use 'item' to access the current element in the loop
                                            videos.push(mydata);

                                        });

                                        console.log('Sorted Ads:', videos.map(v => ({
                                            tag: response.data.find(ad => ad.fileName === v
                                                .src.split('/').pop())?.tag,
                                            distance: v.distance
                                        })));
                                        videoIndex = 0
                                        playNextVideo()

                                    }

                                // } else {
                                //     console.log('none location base');
                                //     if (!notDetectedLocation) {

                                //         console.log('none location base call');
                                //         detectedLocation = false;
                                //         notDetectedLocation = true;
                                //         videos = [];
                                //         console.log(videos);
                                //         $.each(response.data, function(index, item) {
                                //             let mydata = {
                                //                 src: "{{ asset('storage/media') }}/" + item
                                //                     .fileName,
                                //                 type: item.fileType,
                                //                 duration: item.videoDuration,
                                //                 id: item.id
                                //             };
                                //             videos.push(mydata);

                                //             console.log('Sorted Ads:', videos.map(v => ({
                                //                 tag: response.data.find(ad => ad
                                //                     .fileName === v.src.split(
                                //                         '/').pop())?.tag,
                                //                 distance: v.distance
                                //             })));
                                //         });
                                //         videoIndex = 0
                                //         playNextVideo()
                                //     }


                                // }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error sending location data:', error);
                            }
                        });
                    });
                } else {
                    console.error('Geolocation is not supported by this browser.');
                }
            }
            // setInterval(sendLocation, 5000);



            $(document).ready(function() {
                $(document).on('click', '#fullscreenbtn', function() {

                    $(".hidendivB").css('display', 'none')
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen().catch(err => {

                        });
                    } else {
                        $(".hidendivB").css('display', 'inline')
                        document.exitFullscreen();
                    }
                });
            });
        </script>
        @include('profile.partials.login-status')
</body>

</html>
