<x-client-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="px-10">
        <section class="flex-center w-full rounded-lg h-[150px] bg-[#222]">
            <section class="flexx h-[60px] bg-white rounded-xl pl-5">
                <section class="h-full border-r-2">
                    <section class="w-full h-full flex-center">
                        <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                        <input type="text" class="border-none outline-none bg-transparent py-2 px-4" placeholder="Search jobs...">
                    </section>
                </section>
                <section class="w-full h-full flex-center pl-5">
                    <i class="fa-solid fa-location-dot text-gray-500"></i>
                    <input type="text" class="border-none outline-none bg-transparent py-2 px-4" placeholder="Search jobs...">
                </section>
                <button class="bg-blue-500 h-full px-4 py-2 my-2 rounded-r-xl text-white">Search</button>
            </section>
        </section>


        <section class="mt-10 px-10">
            <section class="mb-7 flexx space-x-5">
                <i class="fa-solid fa-briefcase text-gray-500 text-xl"></i>
                <p class="text-[#222] text-lg font-semibold">Showing {{ count($data) }} jobs</p>
            </section>

            <section class="grid grid-cols-cards gap-y-10 gap-x-5">
                @foreach ($data as $job)
                    <article class="group shadow-sm rounded-md p-4 border border-gray-100">
                        <h1 class="text-lg text-[#222] font-medium group-hover:underline cursor-pointer">
                            {{ $job->job_position }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-2 line-clamp-3">
                            {{ $job->job_description }}
                        </p>
                        <section class="flexx flex-wrap mt-4">
                            @if (count(json_decode($job->job_skills_requirement, true)) <= 4)
                                @foreach (array_slice(json_decode($job->job_skills_requirement, true), 0, 4) as $skill)
                                    <p class="bg-gray-200 text-[#222] py-1 px-1.5 rounded-md text-sm mr-3 mb-2">
                                        {{ $skill }}
                                    </p>
                                @endforeach
                            @else
                                @foreach (array_slice(json_decode($job->job_skills_requirement, true), 0, 4) as $skill)
                                    <p class="bg-gray-200 text-[#222] py-1 px-1.5 rounded-md text-sm mr-3 mb-2">
                                        {{ $skill }}
                                    </p>
                                @endforeach
                                <p class="bg-gray-200 text-[#222] py-1 px-1.5 rounded-md text-sm mr-3 mb-2">
                                    +{{count(json_decode($job->job_skills_requirement, true)) - 4}}
                                </p>
                            @endif
                        </section>
                        <section class="mt-2 flexx space-x-5">
                            <section class="w-[70px] h-[70px]">
                                <img src="https://maxipro.co.id/wp-content/uploads/2022/01/logo-Maxipro-1024x1024.jpg" alt="" class="w-full h-full object-cover">
                            </section>
                            <section class="flex flex-col space-y-2">
                                <section class="flexx space-x-3">
                                    <i class="fa-solid fa-building text-gray-500 text-xs"></i>
                                    <p class="text-[13px] text-[#222]">Maxy .Inc</p>
                                </section>
                                <section class="flexx space-x-3">
                                    <i class="fa-solid fa-location-dot text-gray-500 text-xs"></i>
                                    <p class="text-[13px] text-[#222]">Jakarta, Indonesia</p>
                                </section>
                            </section>
                        </section>
                        <section class="mt-5 w-full flexx space-x-2">
                            <button class="bg-blue-500 w-full flex-1 py-2 px-4 rounded-md text-white text-sm hover:opacity-90">Apply Now</button>
                            <button class="bg-gray-200 w-full flex-1 py-2 px-4 rounded-md text-[#222] text-sm hover:opacity-90">Chat Message</button>
                        </section>
                    </article>
                @endforeach
            </section>
        </section>
    </section>
</x-client-layout>