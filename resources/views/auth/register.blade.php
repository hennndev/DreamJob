<x-client-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:is_auth>{{ true }}</x-slot:is_auth>
    <section class="flex-center flex-col py-8 px-5">
        <section class="w-[700px] flex-end">
            <a href="/employer/register" class="mb-2 text-[#222] hover:underline hover:text-black">Are you an employer?</a>
        </section>
        <section class="w-[700px] border border-gray-300 px-14 py-10 rounded-xl">
            <form action="{{ route("auth.store") }}" method="POST">
                @csrf
                <section class="mb-5">
                    <h1 class="text-3xl font-bold text-[#222] tracking-tight mb-2">Register</h1>
                    <p class="text-gray-500">Enter your details account in below to create new account as <span class="font-semibold text-[#222]">candidate</span>.</p>
                </section>
                {{-- showing error message --}}
                @if($errors->has("error"))
                    <section class="bg-red-100 rounded-lg p-3 mb-3">
                        <p class="text-red-500">
                            {{ $errors->first("error") }}
                        </p>
                    </section>
                @endif
                {{-- showing success message --}}
                @if(session('success'))
                    <section class="bg-green-100 rounded-lg p-3 mb-3">
                        <p class="text-green-500">
                            {{ session("success") }}
                        </p>
                    </section>
                @endif
                {{-- name --}}
                <section class="flex flex-col space-y-1 mb-3">
                    <label for="username" class="text-[#222]">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old("name") }}"
                        placeholder="Place your name here as a candidate..." 
                        class="border border-gray-200 rounded-lg py-2 px-4 text-[#222] outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </section>
                {{-- email --}}
                <section class="flex flex-col space-y-1 mb-3">
                    <label for="email" class="text-[#222]">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old("email") }}"
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
                {{-- password confirm --}}
                <section class="flex flex-col space-y-1 mb-3">
                    <label for="password_confirmation" class="text-[#222]">Password Confirm</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Place your password confirm here..." 
                        class="border border-gray-200 rounded-lg py-2 px-4 text-[#222] outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </section>
                <button class="mt-5 w-full bg-[#222] rounded-md py-2 px-4 text-white hover:opacity-90">Register</button>
                <p class="text-center mt-2 text-sm text-gray-500">Already have an account? <a href="/login" class="text-blue-500 hover:underline">Login</a></p>
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