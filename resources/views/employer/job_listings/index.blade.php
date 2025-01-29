<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="px-10 pt-7">
        <section class="flex-end">
            <a href="/employer/job-listings/post-job" class="border-none outline-none bg-[#222] text-white py-2 px-4 rounded-md hover:opacity-90">Post new job</a>
        </section>


        <div class="flex flex-col mt-10">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y bg-white divide-gray-200">
                            <thead class="border border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Position</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Type</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Salary</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Created At</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Details</th>
                                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $job)
                                    <tr class="odd:bg-white even:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#222]">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#222]">
                                            {{ $job->job_position }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#222]">
                                            {{ $job->job_type }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#222]">
                                            {{ $job->job_salary }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#222]">
                                            {{ \Carbon\Carbon::parse($job->createdAt)->format("d/m/Y") }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-[#222]">
                                            <button class="border border-gray-200 rounded-md text-[#222] py-2 px-4 text-sm">Job Details</button>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium space-x-2">
                                            <a href="/employer/job-listings/edit-job/{{ $job->id }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Edit</a>
                                            <button type="button" data-job-id="{{ $job->id }}" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400 dark:focus:text-red-400 delete-job-btn">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (!$data || count($data) < 1) 
                            <div class="flex-center mt-20">
                                <p class="text-gray-500 text-sm">Job post has not available currently.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
          </div>
    </section>
</x-dashboard-layout>


<script>
    $(document).ready(function () {
        $(".delete-job-btn").each(function() {
            const id = $(this).data("job-id")
            $(this).click(function() {
                Swal.fire({
                    title: 'Are you sure want to remove this job?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "/employer/job-listings/" + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Removed!',
                                    'Your job post has been removed.',
                                    'success'
                                )
                                setTimeout(() => {
                                    location.reload()
                                }, 1000);
                            }
                        });
                    }
                });
            })
        })
    });
</script>