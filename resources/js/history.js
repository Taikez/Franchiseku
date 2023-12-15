// history franchise filter date
$(document).ready(function () {
    $('#filterDate').on('click', function () {
        var startDateValue = $('#startDate').val();
        var endDateValue = $('#endDate').val();

        // Get the existing URL parameters
        var urlParams = new URLSearchParams(window.location.search);

        // Add or update the date parameters
        urlParams.set('startDate', startDateValue);
        urlParams.set('endDate', endDateValue);

        // Initialize URL
        var url = "?" + urlParams.toString()

        // Redirect or perform other actions with the generated URL
        window.location.href = url;
    });
});