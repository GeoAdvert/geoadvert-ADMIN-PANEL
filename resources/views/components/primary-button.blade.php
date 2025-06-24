<button  {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-[#228B22] border border-transparent rounded-lg hover:bg-[#247324] focus:outline-none focus:ring']) }}>
    {{ $slot }}
</button>
