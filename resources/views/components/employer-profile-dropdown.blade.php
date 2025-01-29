<i id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="fa-regular fa-circle-user text-2xl text-[#222] cursor-pointer"></i>

<div id="dropdown" class="z-10 border border-gray-200 hidden bg-white divide-y divide-gray-100 rounded-xl shadow-lg w-44">
    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
        <li>
            <a href="/employer/dashboard" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
        </li>
        <li>
            <a href="/employer/profile" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
        </li>
        <li>
            <a href="/employer/profile/edit-profile" class="block px-4 py-2 hover:bg-gray-100">Edit profile</a>
        </li>
        <li>
            <form action="{{ route("auth.logout") }}" method="POST">
                @csrf
                <button type="submit" class="block px-4 py-2 hover:bg-gray-100 outline-none w-full text-left">Logout</button>
            </form>
        </li>
    </ul>
</div>