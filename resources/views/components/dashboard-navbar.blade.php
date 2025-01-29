<header class="flex-between py-3 px-10 bg-white border-b border-gray-50 w-full shadow-sm">
    <section class="flexx space-x-10">
        <h1 class="text-xl font-semibold tracking-tight">{{ $title }}</h1>
        <x-search-input></x-search-input>
    </section>   
    <x-employer-profile-dropdown></x-employer-profile-dropdown>
</header>