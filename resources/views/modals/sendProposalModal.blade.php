<div class="modal fade" id="sendProposalModal" tabindex="-1" aria-labelledby="sendProposalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendProposalModalLabel">Send Proposal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <form action="{{ route('send.proposal', $franchise->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Add Proposal <span class="text-danger">*</span><span
                                class="text-secondary" style="font-size: 11px">.pdf, .doc,
                                .docx, .xls, .xlsx</span></label>
                        <input class="form-control" type="file" id="proposalFile" name="proposalFile"
                            value="{{ old('proposalFile') }}">
                        @error('proposalFile')
                            <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="col-12 text-center">
                            <label for="proposalDescription" class="form-label">Proposal Description <span
                                    class="text-secondary" style="font-size: 10px;">(optional)</span></label>
                            <textarea id="proposalDescription" name="proposalDescription" value="{{ old('proposalDescription') }}" cols="30"
                                rows="5" class="border border-2 rounded mb-3 w-100"></textarea>
                            @error('proposalDescription')
                                <span class="text-danger" style="font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="col-12 text-center">
                            <input type="submit" id="sendProposalBtn"
                                class="btn btn-info text-white rounded rounded-pill w-100" onclick="showLoading()"
                                value="Send Proposal">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
