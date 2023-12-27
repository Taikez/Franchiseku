<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />

<div id="footer" class="container-fluid p-4 pt-5 bg-white" data-aos="fade" data-aos-duration="800">

    <div style="width: 90%; margin:auto;" class="align-items-center justify-center">

        <div id="logo" class="row">
            <div class="col-md-2 col-sm-12">
                <img class="img-fluid mb-4" src="{{ asset('homeImages/logo.png') }}" alt="Logo">
            </div>
            <p class="fs-4 fw-bold mb-5">Reach us</p>
        </div>

        <div id="footer-content" class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 mb-5">
                <div>
                    <div id="support" class="row d-flex align-items-center mb-3">
                        <div class="col-lg-1 col-md-1 col-sm-12">
                            <i class="material-symbols-rounded" style="color:#015051;">mail</i>
                        </div>
                        <div class="col-lg-6 col-md-10 col-sm-12 me-n1">
                            <p><span class="fw-bold me-3">Support:</span><br>adm.franchiseku@gmail.com</p>
                        </div>
                    </div>

                    <div id="location" class="row d-flex align-items-center mb-3">
                        <div class="col-lg-1 col-md-1 col-sm-12">
                            <i class="material-symbols-rounded" style="color:#015051;">location_on</i>
                        </div>
                        <div class="col-lg-6 col-md-10 col-sm-12 me-n1">
                            <p><span class="fw-bold me-3">Indonesia Office:</span> Jl. Soedirman No.15</p>
                        </div>
                    </div>

                    <div id="contact" class="row d-flex align-items-center mb-3">
                        <div class="col-lg-1 col-md-1 col-sm-12">
                            <i class="material-symbols-rounded" style="color:#015051;">smartphone</i>
                        </div>
                        <div class="col-lg-6 col-md-10 col-sm-12 me-n1">
                            <p><span class="fw-bold me-3">General:</span> +62 8865 4321 045</p>
                        </div>
                    </div>
                </div>
                <div id="social-media" class="row d-flex align-items-center mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <a href="www.facebook.com"><img class="social-media facebook img-fluid me-4"
                                src="{{ asset('homeImages/facebook.png') }}" alt="Facebook"></a>
                        <a href="www.twitter.com"><img class="social-media twitter img-fluid me-4"
                                src="{{ asset('homeImages/twitter.png') }}" alt="Twitter"></a>
                        <a href="www.instagram.com"><img class="social-media instagram img-fluid me-4"
                                src="{{ asset('homeImages/instagram.png') }}" alt="Instagram"></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <p><a href="{{ route('franchise') }}"
                        class="footer-link link-offset-2 link-underline link-underline-opacity-0">Franchise
                        List</a></p>
                <p><a href="{{ route('education.index') }}"
                        class="footer-link link-offset-2 link-underline link-underline-opacity-0">Education</a></p>
                <p><a href="{{ route('news') }}"
                        class="footer-link link-offset-2 link-underline link-underline-opacity-0">Business
                        News</a></p>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <p><a href="{{ route('aboutUs') }}"
                        class="footer-link link-offset-2 link-underline link-underline-opacity-0">About
                        FranchiseKu</a></p>
                <p><a href="#" class="footer-link link-offset-2 link-underline link-underline-opacity-0">Help
                        Center</a></p>
            </div>

            <div>
                <hr class="hr">

                <p>FranchiseKu 2023. All rights reserved</p>

                <hr class="hr">

                <p>All our franchise investment product that’s marketed through FranchiseKu Website is organize by PT
                    FranchiseKu Marketplace that’s currently on the go of settling terms & agreement with goverment
                    authorities</p>
            </div>
        </div>
    </div>
</div>
