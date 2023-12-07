<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="purchaseModalLabel"><b>Purchase Content</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <form action="{{ route('education.purchase', $education->id) }}" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <!-- Tab List -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
                            <li class="nav-item">
                                <a data-toggle="pill" href="#nav-tab-card" class="nav-link active rounded-pill">
                                    <i class="fa fa-credit-card"></i>
                                    Credit Card
                                </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#nav-tab-paypal" class="nav-link rounded-pill">
                                    <i class="fa fa-paypal"></i>
                                    Paypal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#nav-tab-bank" class="nav-link rounded-pill">
                                    <i class="fa fa-university"></i>
                                    Bank Transfer
                                </a>
                            </li>
                        </ul>

                        <!-- Credit Card -->
                        <div class="tab-content">
                            <div id="nav-tab-card" class="tab-pane fade show active">
                                <form role="form">
                                    <div class="form-group text-start mb-3">
                                        <label for="username">Full name (on the card)</label>
                                        <input type="text" name="username" placeholder="Budi Dermawan" required
                                            class="form-control">
                                    </div>
                                    <div class="form-group text-start mb-3">
                                        <label for="cardNumber">Card number</label>
                                        <div class="input-group">
                                            <input type="text" name="cardNumber" placeholder="Your card number"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group text-start mb-3">
                                                <label><span class="hidden-xs">Expiration</span></label>
                                                <div class="input-group">
                                                    <input type="number" placeholder="MM" name=""
                                                        class="form-control" required>
                                                    <input type="number" placeholder="YY" name=""
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-4">
                                                <label title="Three-digits code on the back of your card">CVV
                                                    <i class="fa fa-question-circle"></i>
                                                </label>
                                                <input type="text" required class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit"
                                                class="btn btn-primary rounded rounded-pill w-100"><b>Pay</b>
                                                {{ number_format($education->educationPrice, 2) }} IDR</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Paypal -->
                            <div id="nav-tab-paypal" class="tab-pane fade">
                                <p>Paypal is easiest way to pay online</p>
                                <p>
                                    <button type="button" class="btn btn-primary rounded-pill"><i
                                            class="fa fa-paypal mr-2"></i> Log into my Paypal</button>
                                </p>
                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>

                            <!-- Bank Transfer -->
                            <div id="nav-tab-bank" class="tab-pane fade">
                                <dl>
                                    <dt>Bank</dt>
                                    <dd> Bank Central Asia</dd>
                                </dl>
                                <dl>
                                    <dt>Account number</dt>
                                    <dd>7775877975</dd>
                                </dl>
                                <dl>
                                    <dt>IBAN</dt>
                                    <dd>CZ7775877975656</dd>
                                </dl>
                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
