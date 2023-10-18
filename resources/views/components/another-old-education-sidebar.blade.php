{{-- CATEGORY --}}
<form action="{{ URL::current() }}" method="GET">
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Category</h5>
                <button type="submit" class="btn btn-primary btn-sm float-right">Filter</button>
            </div>
        </div>
        <a href="#cardCategoryContent" data-bs-toggle="collapse" aria-expanded="false" aria-controls="cardCategoryContent">
        </a>
        <div class="card-body">
            @foreach ($educationCategories as $educationCategory)
                @php
                    $checked = [];
                    if (isset($_GET['filterCategory'])) {
                        $checked = $_GET['filterCategory'];
                    }
                @endphp
                <div class="mb-1">
                    <input type="checkbox" name="filterCategory[]" value="{{ $educationCategory->id }}"
                        @if (in_array($educationCategory->id, $checked)) checked @endif>
                    {{ $educationCategory->educationCategory }}
                </div>
            @endforeach
        </div>
        <div class="collapse multi-collapse" id="cardCategoryContent">
        </div>
    </div>
</form>

{{-- PRICE RANGE --}}
<form action="{{ URL::current() }}" method="GET">
    <div class="card mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Price</h5>
                <button type="submit" class="btn btn-primary btn-sm float-right">Filter</button>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-1">
                <input type="radio" name="filterPrice" value="0">
                IDR 0.00 - IDR 50,000.00
            </div>
            <div class="mb-1">
                <input type="radio" name="filterPrice" value="0">
                IDR 50,000.00 - IDR 150,000.00
            </div>
            <div class="mb-1">
                <input type="radio" name="filterPrice" value="0">
                IDR 150,000.00 - IDR 250,000.00
            </div>
            <div class="mb-1">
                <input type="radio" name="filterPrice" value="0">
                Exceeds IDR 250,000.00
            </div>
        </div>
    </div>
</form>
