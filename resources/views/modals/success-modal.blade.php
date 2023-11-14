<!-- Add this where you want to display the modal in dashboard.blade.php -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Success!</h5>
        </div>
        <div class="modal-body">
          <!-- Display your success message here -->
          {{ session('successData.message') }}
        </div>
     
      </div>
    </div>
  </div>

<!-- Add this script to your main layout or the specific view where you include the modal -->
<script>
    $(document).ready(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();

            // Perform the AJAX request
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // Use the form's action attribute as the URL
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    // Show the modal if successful
                    if (response.message) {
                        // Set the success message dynamically
                        $('#successMessage').text(response.message);
                        $('#successModal').modal('show');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors if needed
                }
            });
        });
    });
</script>

<!-- Add these scripts before the closing </body> tag -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


  
  
