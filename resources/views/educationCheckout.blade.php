@extends('layouts.app')

@section('main')
    @vite('resources/css/education.css')
x
    <div class="container my-4 text-center">
        <div class="col-md-6 col-sm-12 mx-auto">
            <div class="row">
                <div class="mx-auto">
                    <p class="fs-4 fw-bold">{{$education->educationTitle}} </p>
                    {{-- <p class="badge">{{$educationTransaction->transaction_status}}</p> --}}
                    @if ($educationTransaction->transaction_status == 'pending')
                    <p class="fs-5 fw-light badge bg-warning">Pending</p>
                    @elseif($educationTransaction->transaction_status == 'settlement')
                    <p class="fs-5 fw-light badge bg-success">Success</p>
                    @endif
                    <p>{{$education->educationShortDesc}}</p>
                    <img src="{{asset($education->educationThumbnail)}}" class="img-fluid" alt="">
                </div>
            </div>
    
            <div class="row mt-4">
                <div class="mx-auto">
                    <p class="fs-5 fw-light">Rp {{number_format($education->educationPrice, 0, ',', '.')}}</p>
                </div>
            </div>    
    
            <div class="row">
                <div class="mx-auto">
                    <a id="paymentButton" class="btn w-100 text-white rounded-pill mx-auto my-3">Make Payment</a>       
                </div>
            </div>
        </div>
    </div>


    {{-- passing data untuk midtrans --}}
    {{-- Route belom dibikin, nnti insert ke table transaksi aja --}}
    <form action="{{ route('callback.education.transaction') }}" id="paymentForm" method="POST">
        @csrf
        <input type="hidden" name="paymentJSON" id="paymentJSONCallback" />
        <input type="hidden" name="transactionId" id="transactionId" value="{{$educationTransaction->id}}"/>
        <input type="hidden" name="snapToken" id="snapToken" value="{{ $snapToken }}">
        <input type="hidden" name="educationId" id="educationId" value="{{ $education->id }}">
    </form>

    <script type="text/javascript">
        var payButton = document.getElementById('paymentButton');
        console.log('snapToken  = ' + $('#snapToken').val());

        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    sendResponseToForm(result)
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    sendResponseToForm(result)
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    sendResponseToForm(result)
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('You closed the popup without finishing the payment');
                }
            })
            // customer will be redirected after completing payment pop-up
        });

        function sendResponseToForm(result) {
            var value = document.getElementById('paymentJSONCallback').value;
            var jsonData = JSON.stringify(result);

            $("#paymentJSONCallback").val(jsonData);
            // alert(value); 
            $('#paymentForm').submit();
        }
    </script>
@endsection
