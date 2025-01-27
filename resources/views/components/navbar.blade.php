<header class="w-full pt-3 px-5 bg-transparent">
    <section class="max-w-[1200px] mx-auto flex-between">    
        <a href="/" class="text-2xl font-bold tracking-tight text-[#222]">DreamJob</a>

        @if (!isset($is_auth))
            <section class="flexx space-x-5 text-[#222]">
                <a href="/find-jobs" class="hover:text-black hover:underline">Find Jobs</a>
                <a href="/companies" class="hover:text-black hover:underline">Companies</a>
                <a href="/find-salaries" class="hover:text-black hover:underline">Find Salaries</a>
            </section>

            <section class="flexx text-[#222] space-x-4">
                @auth
                    <form action="{{ route("auth.logout") }}" method="POST">
                        @csrf
                        <button type="submit" class="border-none outline-none text-red-500 font-semibold">Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="/login" class="hover:text-black hover:underline">Login</a>
                    <a href="/register" class="border-none outline-none bg-[#222] py-2 px-4 rounded-md text-white hover:opacity-90">
                        Register
                    </a>
                @endguest
            </section>
        @endif
    </section>
</header>