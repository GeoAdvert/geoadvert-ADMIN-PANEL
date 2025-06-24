
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <title>Document</title>
    <style>
        .abcd:hover svg path{
            fill:white
        }
    </style>
</head>
<body>
    <div class="flex items-center justify-end py-2 px-2 ">
       <a href="{{ route('logout') }}"  style="font-weight:700"
   class=" rounded-[10px] px-4 py-2 text-red-500 flex gap-1 items-center abcd border-red-500 border  hover:text-white hover:border-white hover:bg-red-500"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
<svg style="width:2rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ff0000" d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 224c0 17.7 14.3 32 32 32s32-14.3 32-32l0-224zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"/></svg>
    {{ __('Log Out') }}
</a>

<!-- Add the logout form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

    </div>
    <div class="flex items-center justify-center mt-60">
        <a href="{{route('showAds')}}" class="text-center py-4 px-4 w-96 h-20 bg-[#228b22] rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 text-white text-4xl">Show Ads
        </a>
      </div>

      @include('profile.partials.login-status')
</body>
</html>

