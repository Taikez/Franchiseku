<div class="modal fade" id="editFranchiseModal" tabindex="-1" aria-labelledby="editFranchiseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFranchiseModalLabel">Edit Franchise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('edit.franchise', $franchise->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="franchiseName">Franchise Name</label>
                        <input type="text" class="form-control @error('franchiseName') is-invalid @enderror"
                            id="franchiseName" name="franchiseName" value="{{ $franchise->franchiseName }}">
                        @error('franchiseName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="franchiseLocation">Franchise Location</label>
                        <input type="text" class="form-control @error('franchiseLocation') is-invalid @enderror"
                            id="franchiseLocation" name="franchiseLocation" value="{{ $franchise->franchiseLocation }}">
                        @error('franchiseLocation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="franchiseCategory">Franchise Category</label>
                        <select class="form-control @error('franchiseCategory') is-invalid @enderror"
                            id="franchiseCategory" name="franchiseCategory">
                            @foreach ($allFranchiseCategory as $item)
                                <option
                                    value="{{ $item->id }}"{{ old('franchiseCategory') == $item->franchiseCategory ? 'selected' : '' }}>
                                    {{ $item->franchiseCategory }}</option>
                            @endforeach
                        </select>
                        @error('franchiseCategory')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="franchisePrice">Price</label>
                        <input type="number" class="form-control @error('franchisePrice') is-invalid @enderror"
                            placeholder="Rp" id="franchisePrice" name="franchisePrice"
                            value="{{ $franchise->franchisePrice }}">
                        @error('franchisePrice')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="franchiseReport">Report</label>
                        <input id="franchiseReport" accept=".pdf, .doc, .docx, .xls, .xlsx, .zip" name="franchiseReport"
                            type="file" class="form-control @error('franchiseReport') is-invalid @enderror">
                        @error('franchiseReport')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Franchise Image  --}}
                    <div class="form-group mb-3">
                        <label for="example-text-input" class="col-sm-10 col-form-label">Franchise Logo</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="franchiseLogo" type="file" placeholder="Franchise Logo"
                                accept=".png, .jpg, .jpeg" id="image">
                            @error('franchiseLogo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Image Display  --}}
                    <div class="form-group mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <img id="showImage" style="width: 128px" class="rounded avatar-lg"
                                src="{{ url('upload/no_image.jpg') }}" alt="Card image cap">
                        </div>
                    </div>

                    <button type="submit" class="btn w-100 p-4 pt-1 pb-1 btn-primary rounded mt-4">Edit
                        Franchise</button>
                </form>
            </div>
        </div>
    </div>
</div>
