<x-client-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:is_auth>{{ true }}</x-slot:is_auth>
    <section class="flex-center flex-col py-8 px-5">
        <section class="w-[600px] flex-end">
            <a href="/forgot-password" class="mb-2 text-[#222] hover:underline hover:text-black">Forgot your password?</a>
        </section>
        <section class="w-[600px] border border-gray-300 px-14 py-10 rounded-xl">
            <form action="{{ route("auth.authenticate") }}" method="POST">
                @csrf
                <section class="mb-5">
                    <h1 class="text-3xl font-bold text-[#222] tracking-tight mb-2">Login</h1>
                    <p class="text-gray-500">Enter your details account in below.</p>
                </section>
                {{-- showing error message --}}
                @if($errors->has("error"))
                    <section class="bg-red-100 rounded-lg p-3 mb-3">
                        <p class="text-red-500">
                            {{ $errors->first("error") }}
                        </p>
                    </section>
                @endif
                {{-- email --}}
                <section class="flex flex-col space-y-1 mb-3">
                    <label for="email" class="text-[#222]">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old("email") || isset($keep_me_logged_in) ? $keep_me_logged_in : "" }}"
                        placeholder="Place your email here..." 
                        class="border border-gray-200 rounded-lg py-2 px-4 text-[#222] outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </section>
                {{-- password --}}
                <section class="flex flex-col space-y-1 mb-3">
                    <label for="password" class="text-[#222]">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Place your password here..." 
                        class="border border-gray-200 rounded-lg py-2 px-4 text-[#222] outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </section>
                <section class="flexx space-x-2 mt-1">
                    <input 
                        type="checkbox" 
                        id="keep_me_logged_in" 
                        name="keep_me_logged_in" 
                        {{ $keep_me_logged_in ? "checked" : "" }}
                        class="w-4 h-4">
                    <label for="keep_me_logged_in" class="text-[#222] text-sm">Keep me logged in</label>
                </section>
                <button class="mt-5 w-full bg-[#222] rounded-md py-2 px-4 text-white hover:opacity-90">Log In</button>
                <p class="text-center mt-2 text-sm text-gray-500">Don't have an account? <a href="/register" class="text-blue-500 hover:underline">Register</a></p>
            </form>

            <section class="flex flex-col space-y-4 mt-5">
                <button class="w-full bg-transparent border border-gray-400 rounded-md py-2 px-4 text-[#222] hover:opacity-90 flex-center text-center">
                    <i class="fa-brands fa-google mr-2 text-red-400"></i>
                    Log In with Google
                </button>
                <button class="w-full bg-transparent border border-gray-400 rounded-md py-2 px-4 text-[#222] hover:opacity-90 flex-center text-center">
                    <i class="fa-brands fa-x-twitter mr-2 text-black"></i>
                    Log In with X
                </button>
            </section>
        </section>
    </section>
</x-client-layout>