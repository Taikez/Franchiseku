@vite('resources/css/sidebar.css')
<div class="col-lg-3 col-md-3 col-sm-3 mb-3">
    <div class="accordion" id="accordionPanelsStayOpen" data-aos="fade" data-aos-duration="800">
        <a href="{{ route('history.education') }}" id="resetFilterButton"
            class="btn btn-danger w-100 border border-2 rounded rounded-2 mb-3 d-flex justify-content-center align-items-center fs-5 fw-light text-center">
            <span class="material-symbols-rounded">
                filter_alt_off
            </span>
            Reset Filter
        </a>
        <div class="accordion-item border-top mb-3 border-2 rounded">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseOne">
                    <h5>Payment Status</h5>
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    <div id="statusList" class="row d-flex align-items-center">
                        <a href="{{ route('history.education', ['status' => 'Requested'] + request()->except(['status'])) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">Proposal Sent</a>
                    </div>
                    <div id="statusList" class="row d-flex align-items-center">
                        <a href="{{ route('history.education', ['status' => 'Approved'] + request()->except(['status'])) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">Proposal Approved</a>
                    </div>
                    <div id="statusList" class="row d-flex align-items-center">
                        <a href="{{ route('history.education', ['status' => 'Rejected'] + request()->except(['status'])) }}"
                            class="w-100 bg-transparent border-0 text-start fs-6 p-3">Proposal Rejected</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item border-top mb-3 border-2 rounded">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseTwo">
                    <h5>Transaction Date</h5>
                </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                    <div class="input-group">
                        <input type="date" class="form-control" id="startDate" name="startDate"
                            placeholder="Start Date">
                        <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date">
                        <button class="btn btn-success" type="button" id="filterDate">&#10004;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
