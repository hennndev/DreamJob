<section class="w-[450px] flexx space-x-3 border border-gray-200 rounded-md py-0.5 pl-5 pr-1">
    <i class="fa-solid fa-magnifying-glass text-[#222] cursor-pointer search-btn"></i>
    <input type="text" id="search" placeholder="Search everything on here..." class="flex-1 outline-none text-[#222]">
    <button class="bg-blue-500 text-white rounded-md py-2 px-4 search-btn">Search</button>
</section>

<script>
    $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has("q")) {
            $("#search").val(urlParams.get("q"));
        }
        $("#search").on("input", function() { 
                const value = $(this).val()
                let url = new URL(location.href)
                if(value) {
                    url.searchParams.set("q", value)    
                } else {
                    url.searchParams.delete("q")
                }
                history.replaceState({}, "", url)
        }); 

       $(".search-btn").click(function (e) { 
            location.reload();
       });
    });
</script>