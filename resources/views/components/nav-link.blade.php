@props(['active'])

@if($active)
    <span
        class="absolute inset-y-0 left-[12px] w-1 bg-[#353535] rounded-tl-lg rounded-bl-lg"
        aria-hidden="true"
    ></span>
@endif
<a @if($active) style="background: linear-gradient(90deg, #F1FFEF 0%, rgba(115, 245, 54, 0) 100%);" @endif {{ $attributes->merge(['class' => 'inline-flex items-center w-full text-sm font-semibold text-[#228B22] transition-colors py-3 duration-150 hover:text-gray-800']) }}>
    {{ $icon ?? '' }}
    <span class="ml-2">{{ $slot }}</span>
</a>
