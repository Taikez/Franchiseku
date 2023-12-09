@extends('layouts.app')

@section('main')
    @vite('resources/css/education.css')
    <div class="container-fluid">
        <div class="row">
            <div id="left-content" class="col-lg-7 col-md-7 col-sm-12 p-5">
                <div id="content-title" class="text-center mb-5">
                    <div data-aos="fade" data-aos-duration="800">
                        <h1 class="fw-bold mb-2" style="color: #015051">{{ $education->educationTitle }}</h1>
                    </div>
                    <div data-aos="fade" data-aos-duration="800">
                        <h6 class="mb-4" style="color: #015051">Home / Education / Detail</h6>
                        <div class="mb-4" style="width: 25%; height: 3px; background-color: #D9D9D9; margin: auto;"></div>
                    </div>
                </div>
                <div id="content-text" class="px-5">
                    <h5>{!! $education->educationShortDesc !!}</h5>
                    <p class="fw-lighter">{!! $education->educationDesc !!}</p>
                </div>
            </div>

            <div id="right-content" class="col-lg-5 col-md-5 col-sm-12 py-5 px-3">
                <div id="thumbnail-container" class="rounded" data-aos="fade" data-aos-duration="800">
                    @if (auth()->user() &&
                            auth()->user()->hasPurchasedEducationContent($education->id))
                        <h1>User bought this content!</h1>
                    @else
                        <img id="thumbnail" class="img-fluid rounded-3 opacity-50"
                            src="{{ asset($education->educationThumbnail) }}" alt="{{ $education->educationThumbnail }}">
                        <div id="overlay">
                            <span class="material-symbols-rounded fw-light text-black opacity-50" style="font-size: 5rem">
                                lock
                            </span>
                            <h5 class="mt-3 text-black opacity-50">This video is locked</h5>
                        </div>
                    @endif
                </div>
                <div id="content-details">
                    <h6 class="mt-3 fw-light" style="color: #01A7A3">by
                        {{ $education->educationAuthor }} |
                        {{ Carbon\Carbon::parse($education->created_at)->diffForHumans() }}
                    </h6>
                    <h3 class="fw-bold mt-3">Rp
                        {{ number_format($education->educationPrice, 2) }}</h3>
                    <h6 class="fw-light mt-3">Duration:
                        {{ $educationDuration }} minute(s)</h6>
                    <p class="text-muted mt-3">1000 people bought this</p>
                    <div class="text-center">
                        @include('layouts.flashMessage')
                        <div class="row">
                            @if (auth()->user() &&
                                    auth()->user()->hasPurchasedEducationContent($education->id))
                                @include('modals.rateEducationContentModal')
                                <div>
                                    <button type="button" id="rateEducationBtn"
                                        class="btn w-50 text-white rounded-pill mt-3 mb-2" data-bs-toggle="modal"
                                        data-bs-target="#ratingModal">Rate
                                        Content</button>
                                </div>
                            @else
                                <div>
                                    {{-- @include('modals.purchaseEducationContentModal') --}}
                                    {{-- <button type="button" id="purchaseEducationBtn"
                                        class="btn w-50 text-white rounded-pill mt-3 mb-2" id="pay-button" data-bs-toggle="modal"
                                        data-bs-target="#purchaseModal">Purchase
                                        Content</button> --}}
                                     <button id="pay-button" class="btn w-50 text-white btn-primary rounded-pill mt-3 mb-2">Pay!</button>
                                </div>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('education.index') }}" id="browseMoreContent" class="text-center mt-4">Browse
                                more
                                content</a>
                        </div>
                    </div>
                </div>
                @if (count($ratings) > 0)
                    <div id="ratingCarousel" class="carousel slide p-5 d-flex justify-content-center align-items-center"
                        data-bs-ride="carousel" data-aos="fade-down-right" data-aos-duration="800">
                        <div class="carousel-inner">
                            @foreach ($ratings as $rating)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div id="review-container" class="rounded-3 border border-2 p-5 mt-5"
                                        data-aos="fade-right" data-aos-duration="800">
                                        <div class="row d-flex justify-content-center mb-3">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <h4 class="fw-bold">{{ $rating->educationContent->educationTitle }}</h4>
                                                <h6 class="mt-3 fw-light" style="color: #01A7A3">
                                                    Rated by {{ $rating->user->name }} |
                                                    {{ Carbon\Carbon::parse($rating->created_at)->diffForHumans() }}
                                                </h6>
                                            </div>
                                            <div class="col-lg-6 col-md 6 col-sm-12">
                                                <div class="d-flex justify-content-center">
                                                    @for ($i = 1; $i <= $rating->rating; $i++)
                                                        <div id="star" class="px-2 fs-2 fw-bold">★ </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div id="line" class="col-12" style="height: 5px; background-color: #D9D9D9">
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-5 lh-lg">
                                                {{ $rating->comment }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#ratingCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#ratingCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <div class="col-lg-12 pb-3">
                        <div class="alert alert-warning w-100 mt-5" data-aos="zoom-in-left" data-aos-duration="800">No
                            rating
                            was
                            found for this education content!</div>
                    </div>
                @endif
            </div>
        </div>
        <div id="other-contents" class="row p-5">
            <h3 class="text-center fw-bold mb-5" data-aos="fade-down" data-aos-duration="800">You might also like</h3>
            <div class="row">
                @if ($otherEducations->count() == 0)
                    <div class="col-lg-12 pb-3" data-aos="fade" data-aos-duration="800">
                        <div class="alert alert-warning w-100">No education content found!</div>
                    </div>
                @else
                    @foreach ($otherEducations as $otherEducation)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-3" data-aos="fade-up" data-aos-duration="800">
                            <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                                style="overflow: hidden">
                                <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                    <img src="{{ asset($otherEducation->educationThumbnail) }}"
                                        alt="Education Content Banner" class="img-fluid w-100"
                                        style="object-fit: cover; height: 100%; width: 100%;">
                                </div>
                                <div class="p-3">
                                    <h3>{{ $otherEducation->educationTitle }}</h3>
                                    <p class="mb-2 text-muted">By {{ $otherEducation->educationAuthor }}</p>
                                    <span class="badge bg-info mb-3">
                                        {{ $otherEducation->category->educationCategory }}
                                    </span>
                                    <p class="mb-2">IDR {{ number_format($otherEducation->educationPrice, 2) }}</p>
                                    <p class="mb-2 text-muted" style="font-size: 12px;">
                                        {{ $otherEducation->educationShortDesc }}</p>
                                    <hr>
                                    <a href="{{ route('education.detail', $otherEducation->id) }}"
                                        class="d-flex justify-content-between">
                                        <div>
                                            Read More
                                        </div>
                                        <div>
                                            <span class="material-symbols-rounded">
                                                north_east
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>


    {{-- passing data untuk midtrans --}}
    {{-- Route belom dibikin, nnti insert ke table transaksi aja --}}
    <form action="{{route('post.education.transaction')}}" id="paymentForm" method="POST">
        @csrf
        <input type="text" name="paymentJSON" id="paymentJSONCallback"/>
    </form>


    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{$snapToken}}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            console.log(result);
            sendResponseToForm(result)
          },
          onPending: function(result){
            /* You may add your own implementation here */
            console.log(result);
            sendResponseToForm(result)
          },
          onError: function(result){
            /* You may add your own implementation here */
            console.log(result);
            sendResponseToForm(result)
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
            sendResponseToForm(result)
          }
        })
        // customer will be redirected after completing payment pop-up
      });


      function sendResponseToForm(result){
        var value =  document.getElementById('paymentJSONCallback').value;
        var jsonData = JSON.stringify(result);

        $("#paymentJSONCallback").val(jsonData);
        // alert(value); 
        $('#paymentForm').submit();
      }
    </script>
@endsection
