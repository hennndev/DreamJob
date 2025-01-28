<aside class="sticky top-0 flex flex-col justify-between w-[250px] border-r border-gray-200 h-screen py-5 shadow-sm">
    <section class="flex flex-col flex-1">
        <h1 class="text-2xl font-bold tracking-tight text-center">DreamJob</h1>

        <section class="mt-14 px-6 flex flex-col space-y-3">
            <a 
                href="/employer/dashboard" 
                class="flexx px-6 py-2 rounded-md hover:bg-[#222] hover:text-white {{ request()->is("employer/dashboard*") ? "bg-[#222] text-white" : "" }}">
                <i class="fa-solid fa-house mr-3"></i>
                Dashboard
            </a>
            <a 
                href="/employer/job-listings" 
                class="flexx px-6 py-2 rounded-md hover:bg-[#222] hover:text-white {{ request()->is("employer/job-listings*") ? "bg-[#222] text-white" : "" }}">
                <i class="fa-solid fa-briefcase mr-3"></i>
                Job Listings
            </a>
            <a 
                href="/employer/applicants" 
                class="flexx px-6 py-2 rounded-md hover:bg-[#222] hover:text-white {{ request()->is("employer/applicants*") ? "bg-[#222] text-white" : "" }}">
                <i class="fa-solid fa-users mr-3"></i>
                Applicants
            </a>
        </section>
    </section>
    <section class="px-6 flex-center">
        <a href="/" class="border border-gray-300 rounded-md py-2 px-10 text-[#222] hover:bg-[#222] hover:text-white">Back to home</a>
    </section>
</aside>