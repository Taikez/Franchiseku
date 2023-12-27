<div class="modal fade" id="rateFranchiseModal" tabindex="-1" aria-labelledby="rateFranchiseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rateFranchiseModalLabel">Rate Franchise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <form action="{{ route('franchise.rate', $franchise->id) }}" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <h4 class="text-center">{{ $franchise->franchiseName }}</h4>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center align-items-center mb-5">
                                <div class="rate mx-auto">
                                    <input type="radio" id="star5" name="rating" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <textarea name="ratingComment" id="ratingComment" cols="30" rows="5"
                                    class="border border-2 rounded mb-3 w-100"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <input type="submit" id="rateFranchiseBtn"
                                    class="btn rounded rounded-pill w-100 text-white" onclick="showLoading()"
                                    value="Submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
