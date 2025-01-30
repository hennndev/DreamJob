@php
    // Mengambil data dan memastikan menjadi integer
    $total_data = $attributes->get('total_data');

    $currentPage = (int) request()->query('page', 1);
    $totalData = (int) $total_data; // Pastikan ini integer
    $totalPages = ceil($totalData / 5);
    $disableNext = ($currentPage >= $totalPages || $totalData <= 5);
@endphp

<section class="flex-center mt-14 mb-10">
    <nav aria-label="Page navigation example">
        <ul class="inline-flex -space-x-px text-sm">
            <li>
                <button 
                    id="previous-btn" 
                    @disabled(!request()->has("page"))
                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
            </li>
            <li>
                <button 
                    id="next-btn"
                    @disabled($disableNext) 
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">Next</button>
            </li>
        </ul>
    </nav>
</section>

<script>
    const LIMIT = 5
    let totalPages = @json($totalPages);

    const url = new URL(window.location.href)
    const params = new URLSearchParams(window.location.search)
    const queries = {}
    params.forEach((value, key) => {
        queries[key] = value
    });

    if(queries.page && (queries.page > totalPages)) {
        Object.keys(queries).forEach(key => {
            url.searchParams.set(key, queries[key])    
        })
        url.searchParams.delete("page")
        history.replaceState({}, "", url)
        location.reload()
    }

    let page = queries.page ? +queries.page < 1 || +queries.page === 1 ? 1 : +queries.page : 1

    if(queries.page && (+queries.page < 1 || +queries.page === 1)) {
        url.searchParams.delete("page")
        history.replaceState({}, "", url)
    }
    $("#previous-btn").click(function (e) { 
        Object.keys(queries).forEach(key => {
            url.searchParams.set(key, queries[key])    
        })
        if(page > 2) {
            page--
        } else {
            page = 1
        }
        if(page === 1 && params.has("page")) {
            url.searchParams.delete("page")
        } else {
            url.searchParams.set("page", page)
        }
        history.replaceState({}, "", url)
        location.reload()
    })


    $("#next-btn").click(function (e) { 
        page++
        Object.keys(queries).forEach(key => {
            url.searchParams.set(key, queries[key])    
        })
        url.searchParams.set("page", page)
        history.replaceState({}, "", url)
        location.reload()
    })
</script>