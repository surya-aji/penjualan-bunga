@extends('pembeli.layout.master')
@section('content')
<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Checkout</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">eCommerce</a>
                                </li>
                                <li class="breadcrumb-item active">Checkout
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="bs-stepper checkout-tab-steps">
                <!-- Wizard starts -->
                <div class="bs-stepper-header">
                    <div class="step" data-target="#step-cart">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <i data-feather="shopping-cart" class="font-medium-3"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Keranjang</span>
                                <span class="bs-stepper-subtitle">Keranjang pemesanan anda</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i data-feather="chevron-right" class="font-medium-2"></i>
                    </div>
                    <div class="step" data-target="#step-address">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <i data-feather="home" class="font-medium-3"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Address</span>
                                <span class="bs-stepper-subtitle">Enter Your Address</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i data-feather="chevron-right" class="font-medium-2"></i>
                    </div>
                    <div class="step" data-target="#step-payment">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <i data-feather="credit-card" class="font-medium-3"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Payment</span>
                                <span class="bs-stepper-subtitle">Select Payment Method</span>
                            </span>
                        </button>
                    </div>
                </div>
                <!-- Wizard ends -->

                <div class="bs-stepper-content">
                    <!-- Checkout Place order starts -->
                    <div id="step-cart" class="content">
                        <div id="place-order" class="list-view product-checkout">
                            <!-- Checkout Place Order Left starts -->
                            <div class="checkout-items">
                                @if (!empty($pesanan) )
                                @foreach ($detail_pesanan as $item)
                                <div class="card ecommerce-card">
                                    <div class="item-img">
                                        <a href="app-ecommerce-details.html">
                                            <img src="{{asset('gambar-produk/'. $item->barang->gambar )}}" alt="img-placeholder" />
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="item-name">
                                            <h6 class="mb-0">{{$item->barang->nama_produk}}</h6>
                                        </div>
                                        {{-- <span class="text-success mb-1">In Stock</span> --}}
                                        <div class="item-quantity">
                                            <span class="quantity-title">Jumlah</span>
                                            <div class="input-group quantity-counter-wrapper">
                                                <input type="text" class="quantity-counter" value="{{$item->jumlah}}" />
                                            </div>
                                        </div>
                                        <span class="delivery-date text-muted">{{Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y')}}</span>
                                    </div>
                                    <div class="item-options text-center">
                                        <div class="item-name">
                                            <h6 class="mb-0">Harga: Rp.{{ number_format($item->jumlah_harga) }}</h6><br>
                                        </div>
                                        <form action="{{ route('hapus-keranjang', $item->id) }}" method="post" onsubmit="return confirm('Yakin hapus data ?')">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i data-feather="x" class="align-middle mr-25"></i>
                                                <span>Hapus Dari Keranjang</span>
                                            </button>
                                        </form>
                                       
                                    </div>
                                </div> 
                                
                                @endforeach
                                @endif
                               
                             
                            </div>
                            <!-- Checkout Place Order Left ends -->

                            <!-- Checkout Place Order Right starts -->
                            <div class="checkout-options">
                                <div class="card">
                                    <div class="card-body">
                                        <label class="section-label mb-1">Informasi Keranjang</label>
                                        
                                        <hr />
                                        <div class="price-details">
                                            <h6 class="price-title">Detail</h6>
                                            <ul class="list-unstyled">
                                                @if (!empty($pesanan) )
                                                @foreach ($detail_pesanan as $item)
                                                <li class="price-detail">
                                                    <div class="detail-title">{{$item->barang->nama_produk}} &nbsp X {{$item->jumlah}}</div>
                                                    <div class="detail-amt">Rp. {{ number_format($item->jumlah_harga)}}</div>
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>


                                            <hr />
                                            <ul class="list-unstyled">
                                                <li class="price-detail">
                                                    <div class="detail-title detail-total">Total Harga </div>
                                                    <div class="detail-amt font-weight-bolder">Rp.
                                                        @if (!empty($pesanan))
                                                        {{ number_format($pesanan->total_pembayaran) }}
                                                        @else
                                                        0
                                                        @endif
                                                       
                                                    </div>
                                                </li>
                                            </ul>
                                            <button type="button" class="btn btn-primary btn-block btn-next place-order">Lanjutkan</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Place Order Right ends -->
                            </div>
                        </div>
                        <!-- Checkout Place order Ends -->
                    </div>
                    <!-- Checkout Customer Address Starts -->
                    <div id="step-address" class="content">
                        <form id="checkout-address" class="list-view product-checkout">
                            <!-- Checkout Customer Address Left starts -->
                            <div class="card">
                                <div class="card-header flex-column align-items-start">
                                    <h4 class="card-title">Alamat Pengiriman</h4>
                                    <p class="card-text text-muted mt-25">Untuk Memastikan Bahwa benar Alamat anda</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="checkout-name">Full Name:</label>
                                                <input type="text" id="checkout-name" class="form-control" name="fname" placeholder="John Doe" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="checkout-number">Mobile Number:</label>
                                                <input type="number" id="checkout-number" class="form-control" name="mnumber" placeholder="0123456789" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="checkout-apt-number">Flat, House No:</label>
                                                <input type="number" id="checkout-apt-number" class="form-control" name="apt-number" placeholder="9447 Glen Eagles Drive" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="checkout-landmark">Landmark e.g. near apollo hospital:</label>
                                                <input type="text" id="checkout-landmark" class="form-control" name="landmark" placeholder="Near Apollo Hospital" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="checkout-city">Town/City:</label>
                                                <input type="text" id="checkout-city" class="form-control" name="city" placeholder="Tokyo" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="checkout-pincode">Pincode:</label>
                                                <input type="number" id="checkout-pincode" class="form-control" name="pincode" placeholder="201301" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="checkout-state">State:</label>
                                                <input type="text" id="checkout-state" class="form-control" name="state" placeholder="California" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group mb-2">
                                                <label for="add-type">Address Type:</label>
                                                <select class="form-control" id="add-type">
                                                    <option>Home</option>
                                                    <option>Work</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary btn-next delivery-address">Save And Deliver Here</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkout Customer Address Left ends -->

                            <!-- Checkout Customer Address Right starts -->
                            <div class="customer-card">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">John Doe</h4>
                                    </div>
                                    <div class="card-body actions">
                                        <p class="card-text mb-0">9447 Glen Eagles Drive</p>
                                        <p class="card-text">Lewis Center, OH 43035</p>
                                        <p class="card-text">UTC-5: Eastern Standard Time (EST)</p>
                                        <p class="card-text">202-555-0140</p>
                                        <button type="button" class="btn btn-primary btn-block btn-next delivery-address mt-2">
                                            Deliver To This Address
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkout Customer Address Right ends -->
                        </form>
                    </div>
                    <!-- Checkout Customer Address Ends -->

                    <!-- Checkout Payment Starts -->
                    <div id="step-payment" class="content">
                        <form id="checkout-payment" class="list-view product-checkout" onsubmit="return false;">
                            <div class="payment-type">
                                <div class="card">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Payment options</h4>
                                        <p class="card-text text-muted mt-25">Be sure to click on correct payment option</p>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-holder-name my-75">John Doe</h6>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customColorRadio1" name="paymentOptions" class="custom-control-input" checked />
                                            <label class="custom-control-label" for="customColorRadio1">
                                                US Unlocked Debit Card 12XX XXXX XXXX 0000
                                            </label>
                                        </div>
                                        <div class="customer-cvv mt-1">
                                            <div class="form-inline">
                                                <label class="mb-50" for="card-holder-cvv">Enter CVV:</label>
                                                <input type="password" class="form-control ml-sm-75 ml-0 mb-50 input-cvv" name="input-cvv" id="card-holder-cvv" />
                                                <button type="button" class="btn btn-primary btn-cvv ml-0 ml-sm-1 mb-50">Continue</button>
                                            </div>
                                        </div>
                                        <hr class="my-2" />
                                        <ul class="other-payment-options list-unstyled">
                                            <li class="py-50">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customColorRadio2" name="paymentOptions" class="custom-control-input" />
                                                    <label class="custom-control-label" for="customColorRadio2"> Credit / Debit / ATM Card </label>
                                                </div>
                                            </li>
                                            <li class="py-50">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customColorRadio3" name="paymentOptions" class="custom-control-input" />
                                                    <label class="custom-control-label" for="customColorRadio3"> Net Banking </label>
                                                </div>
                                            </li>
                                            <li class="py-50">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customColorRadio4" name="paymentOptions" class="custom-control-input" />
                                                    <label class="custom-control-label" for="customColorRadio4"> EMI (Easy Installment) </label>
                                                </div>
                                            </li>
                                            <li class="py-50">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customColorRadio5" name="paymentOptions" class="custom-control-input" />
                                                    <label class="custom-control-label" for="customColorRadio5"> Cash On Delivery </label>
                                                </div>
                                            </li>
                                        </ul>
                                        <hr class="my-2" />
                                        <div class="gift-card mb-25">
                                            <p class="card-text">
                                                <i data-feather="plus-circle" class="mr-50 font-medium-5"></i>
                                                <span class="align-middle">Add Gift Card</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="amount-payable checkout-options">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Price Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled price-details">
                                            <li class="price-detail">
                                                <div class="details-title">Price of 3 items</div>
                                                <div class="detail-amt">
                                                    <strong>$699.30</strong>
                                                </div>
                                            </li>
                                            <li class="price-detail">
                                                <div class="details-title">Delivery Charges</div>
                                                <div class="detail-amt discount-amt text-success">Free</div>
                                            </li>
                                        </ul>
                                        <hr />
                                        <ul class="list-unstyled price-details">
                                            <li class="price-detail">
                                                <div class="details-title">Amount Payable</div>
                                                <div class="detail-amt font-weight-bolder">$699.30</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Checkout Payment Ends -->
                    <!-- </div> -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection