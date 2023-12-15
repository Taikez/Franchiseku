@vite('resources/css/sidebar.css')
<div class="col-lg-3 col-md-3 col-sm-3 mb-3">
    <div class="accordion" id="accordionPanelsStayOpen" data-aos="fade" data-aos-duration="800">
        <a href="{{ route('education.index') }}" id="resetFilterButton"
            class="btn btn-danger w-100 border border-2 rounded rounded-2 mb-3 d-flex justify-content-center align-items-center fs-5 fw-light text-center">
            <span class="material-symbols-rounded">
                filter_alt_off
            </span>
            Reset Filter
        </a>
        <div class="accordion-item mb-3 border-2 rounded">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseOne">
                    <h5>Category</h5>
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    @if ($educationCategories->count() == 0)
                        <div class="col-lg-12 pb-3" data-aos="fade-down-right" data-aos-duration="800">
                            <div class="alert alert-warning w-100">No categories to be found!</div>
                        </div>
                    @else
                    @endif
                    @foreach ($educationCategories as $educationCategory)
                        <div id="categoryList" class="row d-flex align-items-center">
                            <a href="{{ route('education.all', ['category' => $educationCategory->id] + request()->except('category')) }}"
                                class="w-100 bg-transparent border-0 text-start fs-6 p-3">{{ $educationCategory->educationCategory }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="accordion-item border-top mb-3 border-2 rounded">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseTwo">
                    <h5>Price Range</h5>
                </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                    <div id="priceList" class="row d-flex align-items-center">
                        <a href="{{ route('education.index', ['minPrice' => 0, 'maxPrice' => 50000] + request()->except(['minPrice', 'maxPrice'])) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">IDR
                            0.00 - IDR 50,000.00</a>
                    </div>
                    <div id="priceList" class="row d-flex align-items-center">
                        <a href="{{ route('education.index', ['minPrice' => 50000, 'maxPrice' => 150000] + request()->except(['minPrice', 'maxPrice'])) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">IDR
                            50,000.00 - IDR 150,000.00</a>
                    </div>
                    <div id="priceList" class="row d-flex align-items-center">
                        <a href="{{ route('education.index', ['minPrice' => 150000, 'maxPrice' => 250000] + request()->except(['minPrice', 'maxPrice'])) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">IDR
                            150,000.00 - IDR 250,000.00</a>
                    </div>
                    <div id="priceList" class="row d-flex align-items-center">
                        <a href="{{ route('education.index', ['minPrice' => 250000] + request()->except(['minPrice', 'maxPrice'])) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">Exceeds IDR 250,000.00</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item border-top mb-3 border-2 rounded">
            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseThree">
                    <h5>Rating Range</h5>
                </button>
            </h2>
            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingThree">
                <div class="accordion-body">
                    <div id="ratingList" class="row d-flex align-items-center">
                        <a href="{{ route('education.all', ['rating' => 1]) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">1 Star</a>
                    </div>
                    <div id="ratingList" class="row d-flex align-items-center">
                        <a href="{{ route('education.all', ['rating' => 2]) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">2 Star</a>
                    </div>
                    <div id="ratingList" class="row d-flex align-items-center">
                        <a href="{{ route('education.all', ['rating' => 3]) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">3 Star</a>
                    </div>
                    <div id="ratingList" class="row d-flex align-items-center">
                        <a href="{{ route('education.all', ['rating' => 4]) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">4 Star</a>
                    </div>
                    <div id="ratingList" class="row d-flex align-items-center">
                        <a href="{{ route('education.all', ['rating' => 5]) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">5 Star</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
