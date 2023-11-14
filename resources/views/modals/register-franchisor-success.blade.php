

<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register Franchisor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Franchisor Registered Successfully!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
    $(document).ready(function () {
        // Handle form submission using AJAX
        $('form').on('submit', function (e) {
            e.preventDefault();

            // Perform the AJAX request
            $.ajax({
                type: 'POST',
                url: '{{ route('store.franchisor') }}',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    // Show the modal if successful
                    if (response.message) {
                        $(response.modal).modal('show');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors if needed
                }
            });
        });
    });
 </script>
