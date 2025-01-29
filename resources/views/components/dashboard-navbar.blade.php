<header class="flex-between h-[70px] px-10 bg-white border-b border-gray-50 w-full shadow-sm">
    <section class="flexx space-x-10">
        <h1 class="text-xl font-semibold tracking-tight">{{ $title }}</h1>
        @if (isset($is_search))
            <x-search-input></x-search-input>
        @endif
    </section>   
    <x-employer-profile-dropdown></x-employer-profile-dropdown>
</header>