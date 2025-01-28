<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="px-10 pt-7">
        <a href="/employer/job-listings" class="border-none outline-none bg-gray-400 text-white py-2 px-4 rounded-md hover:opacity-90">Back to job listings</a>

        <section class="p-6 mt-7 mb-10 rounded-md border border-gray-300 shadow-sm">
            <form action="{{ route("employer.job_listings.store") }}" method="POST" class="flex flex-col">
                @csrf
                <section class="flex flex-col space-y-2 mb-5">
                    <label for="job_position">Job position</label>
                    <input 
                        type="text" 
                        id="job_position" 
                        name="job_position" 
                        value="{{ old("job_position") }}"
                        placeholder="Place job position here..." 
                        class="border border-gray-300 rounded-md py-2 px-4 focus:ring-2 focus:border-none focus:ring-[#222] outline-none">
                    @error('job_position')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </section>
                <section class="flex flex-col space-y-2 mb-5">
                    <label for="job_type">Job type</label>
                    <select 
                        id="job_type" 
                        name="job_type" 
                        value="{{ old("job_type") }}"
                        class="border border-gray-300 rounded-md py-2 px-4 focus:ring-2 focus:border-none focus:ring-[#222] outline-none">
                        <option value="">Choose job type</option>
                        <option value="full-time" {{ old("job_type") === "full-time" ? "selected" : "" }}>Full time</option>
                        <option value="part-time" {{ old("job_type") === "part-time" ? "selected" : "" }}>Part time</option>
                        <option value="freelance" {{ old("job_type") === "freelance" ? "selected" : "" }}>Freelance</option>
                        <option value="internship" {{ old("job_type") === "internship" ? "selected" : "" }}>Internship</option>
                    </select>
                    @error('job_type')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </section>
                <section class="flex flex-col space-y-2 mb-5">
                    <label for="job_salary">Job salary</label>
                    <input 
                        type="number" 
                        id="job_salary" 
                        name="job_salary" 
                        value="{{ old("job_salary") }}"
                        placeholder="Place job salary here..." class="border border-gray-300 rounded-md py-2 px-4 focus:ring-2 focus:border-none focus:ring-[#222] outline-none">
                    @error('job_salary')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </section>
                <section class="flex flex-col space-y-2 mb-5">
                    <label for="job_salary_type">Job salary type</label>
                    <select 
                        id="job_salary_type" 
                        name="job_salary_type" 
                        value="{{ old("job_salary_type") }}"
                        class="border border-gray-300 rounded-md py-2 px-4 focus:ring-2 focus:border-none focus:ring-[#222] outline-none">
                        <option value="">Choose job salary type</option>
                        <option value="fixed" {{ old("job_salary_type") === "fixed" ? "selected" : "" }}>Fixed</option>
                        <option value="negotiable" {{ old("job_salary_type") === "negotiable" ? "selected" : "" }}>Negotiable</option>
                    </select>
                    @error('job_salary_type')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </section>
                <section class="flex flex-col space-y-2 mb-5">
                    <label for="job_skill">Job skills requirement</label>
                    <input type="hidden" id="job_skills_requirement" name="job_skills_requirement">
                    <section class="flexx space-x-3">
                        <input type="text" id="job_skill" name="job_skill" placeholder="Place job skills requirement here..." class="border border-gray-300 rounded-md py-2 px-4 focus:ring-2 focus:border-none focus:ring-[#222] outline-none flex-1">
                        <button type="button" class="bg-[#222] text-white rounded-md py-2 px-4 hover:opacity-90 skill-add-btn">Add</button>
                    </section>
                    <section id="skills_array" class="flexx flex-wrap !mt-4">
                        @if(old("job_skills_requirement"))
                            @foreach (json_decode(old("job_skills_requirement"), true) as $skill)
                                <div class="relative text-[#222] border border-gray-200 rounded-md py-1.5 px-3 mr-4 mb-4">
                                    {{ $skill }}
                                    <i class="fa-solid fa-xmark absolute -top-1 -right-1 cursor-pointer skill-remove-btn"></i>
                                </div>
                            @endforeach
                        @endif
                    </section>
                    @error('job_skills_requirement')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </section>
                <section class="flex flex-col space-y-2 mb-5">
                    <label for="job_description">Job description</label>
                    <textarea rows="7" cols="7" id="job_description" name="job_description" placeholder="Place job description here..." class="border border-gray-300 rounded-md py-2 px-4 focus:ring-2 focus:border-none focus:ring-[#222] outline-none">{{ old("job_description") }}</textarea>
                    @error('job_description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </section>

                <button type="submit" class="bg-[#222] text-white rounded-md py-2 px-4 hover:opacity-90">Submit</button>
            </form>
        </section>
    </section>
</x-dashboard-layout>



<script>
    $(document).ready(function () {
        let skills = []
        
        if($("#skills_array").children().length > 0) {
            $("#skills_array").children().each(function() {
                const text = $(this).text().trim();
                skills.push(text)
                $("#job_skills_requirement").val(JSON.stringify(skills));
            })

            $(".skill-remove-btn").each(function() {
                $(this).click(function() {
                    const skill_removed =   $(this).parent().text().trim()
                    skills = skills.filter(skill => skill !== skill_removed)
                    $(this).parent().remove()
                    $("#job_skills_requirement").val(JSON.stringify(skills))
                })
            })
        } else {
            $("#job_skills_requirement").val(JSON.stringify(skills));
        }
        $(".skill-add-btn").click(function (e) { 
            let job_skill_value = $("#job_skill").val();
            if(job_skill_value.trim() && !skills.find(skill => skill === job_skill_value.trim())) {
                $("#skills_array").append(`
                    <div class="relative text-[#222] border border-gray-200 rounded-md py-1.5 px-3 mr-4 mb-4">
                        ${job_skill_value.trim()}
                        <i class="fa-solid fa-xmark absolute -top-1 -right-1 cursor-pointer skill-remove-btn"></i>
                    </div>
                `);
                skills.push(job_skill_value)
                $("#job_skill").val("")
                $("#job_skills_requirement").val(JSON.stringify(skills))
                $("#job_skill").focus();
            }   
            $(".skill-remove-btn").each(function() {
                $(this).click(function() {
                    const skill_removed =   $(this).parent().text().trim()
                    skills = skills.filter(skill => skill !== skill_removed)
                    $(this).parent().remove()
                    $("#job_skills_requirement").val(JSON.stringify(skills))
                })
            })
        });
    });
</script>