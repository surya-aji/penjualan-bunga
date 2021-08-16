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
                        <h2 class="content-header-title float-left mb-0">Shop</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">eCommerce</a>
                                </li>
                                <li class="breadcrumb-item active">Shop
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
                    <!-- app e-commerce details start -->
                    <section class="app-ecommerce-details">
                        <div class="card">
                            <!-- Product Details starts -->
                            <div class="card-body">
                                <div class="row my-2">
                                    <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <img src="{{asset('gambar-produk/'. $barang->gambar )}}" class="img-fluid product-img" alt="product image" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <h4>{{$barang->nama_produk}}</h4>
                                        <div class="ecommerce-details-price d-flex flex-wrap mt-1">
                                            <h4 class="item-price mr-1">Rp.{{$barang->harga_jual}}</h4>
                                            <ul class="unstyled-list list-inline pl-1 border-left">
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            </ul>
                                        </div>
                                        <p class="card-text">Stok - <span class="text-success">{{$barang->stok}}</span></p>
                                        @if (session('stok'))
                                        <div class="alert alert-danger">
                                            {{ session('stok') }}
                                        </div>
                                    @endif
                                        <p class="card-text">
                                           {{$barang->deskripsi}}
                                        </p>
                                        <form action="{{route('masukan-keranjang',$barang->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <div class="form-group">
                                                    <label for="basicInput">Jumlah Pesanan</label>
                                                    <input type="number" class="form-control" name="jumlah" id="basicInput" placeholder="Masukan Jumlah Pesanan" />
                                                </div>
                                            <hr />
                                            <hr />
                                            <div class="d-flex flex-column flex-sm-row pt-1">
                                                <button type="submit" class="btn btn-primary btn-cart mr-0 mr-sm-1 mb-1 mb-sm-0" id="keranjang">
                                                    <i data-feather="shopping-cart" class="mr-50"></i>
                                                    Masukan Ke Keranjang
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Details ends -->
    
                            <!-- Item features starts -->
                            <div class="item-features">
                                <div class="row text-center">
                                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                                        <div class="w-75 mx-auto">
                                            <i data-feather="award"></i>
                                            <h4 class="mt-2 mb-1">100% Original</h4>
                                            <p class="card-text">Chocolate bar candy canes ice cream toffee. Croissant pie cookie halvah.</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                                        <div class="w-75 mx-auto">
                                            <i data-feather="clock"></i>
                                            <h4 class="mt-2 mb-1">10 Day Replacement</h4>
                                            <p class="card-text">Marshmallow biscuit donut dragée fruitcake. Jujubes wafer cupcake.</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                                        <div class="w-75 mx-auto">
                                            <i data-feather="shield"></i>
                                            <h4 class="mt-2 mb-1">1 Year Warranty</h4>
                                            <p class="card-text">Cotton candy gingerbread cake I love sugar plum I love sweet croissant.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Item features ends -->
    
                            <!-- Related Products starts -->
                            {{-- <div class="card-body">
                                <div class="mt-4 mb-2 text-center">
                                    <h4>Related Products</h4>
                                    <p class="card-text">People also search for this items</p>
                                </div>
                                <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0)">
                                                <div class="item-heading">
                                                    <h5 class="text-truncate mb-0">Apple Watch Series 6</h5>
                                                    <small class="text-body">by Apple</small>
                                                </div>
                                                <div class="img-container w-50 mx-auto py-75">
                                                    <img src="../../../app-assets/images/elements/apple-watch.png" class="img-fluid" alt="image" />
                                                </div>
                                                <div class="item-meta">
                                                    <ul class="unstyled-list list-inline mb-25">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                    <p class="card-text text-primary mb-0">$399.98</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0)">
                                                <div class="item-heading">
                                                    <h5 class="text-truncate mb-0">Apple MacBook Pro - Silver</h5>
                                                    <small class="text-body">by Apple</small>
                                                </div>
                                                <div class="img-container w-50 mx-auto py-50">
                                                    <img src="../../../app-assets/images/elements/macbook-pro.png" class="img-fluid" alt="image" />
                                                </div>
                                                <div class="item-meta">
                                                    <ul class="unstyled-list list-inline mb-25">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                    <p class="card-text text-primary mb-0">$2449.49</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0)">
                                                <div class="item-heading">
                                                    <h5 class="text-truncate mb-0">Apple HomePod (Space Grey)</h5>
                                                    <small class="text-body">by Apple</small>
                                                </div>
                                                <div class="img-container w-50 mx-auto py-75">
                                                    <img src="../../../app-assets/images/elements/homepod.png" class="img-fluid" alt="image" />
                                                </div>
                                                <div class="item-meta">
                                                    <ul class="unstyled-list list-inline mb-25">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                    <p class="card-text text-primary mb-0">$229.29</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0)">
                                                <div class="item-heading">
                                                    <h5 class="text-truncate mb-0">Magic Mouse 2 - Black</h5>
                                                    <small class="text-body">by Apple</small>
                                                </div>
                                                <div class="img-container w-50 mx-auto py-75">
                                                    <img src="../../../app-assets/images/elements/magic-mouse.png" class="img-fluid" alt="image" />
                                                </div>
                                                <div class="item-meta">
                                                    <ul class="unstyled-list list-inline mb-25">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    </ul>
                                                    <p class="card-text text-primary mb-0">$90.98</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0)">
                                                <div class="item-heading">
                                                    <h5 class="text-truncate mb-0">iPhone 12 Pro</h5>
                                                    <small class="text-body">by Apple</small>
                                                </div>
                                                <div class="img-container w-50 mx-auto py-75">
                                                    <img src="../../../app-assets/images/elements/iphone-x.png" class="img-fluid" alt="image" />
                                                </div>
                                                <div class="item-meta">
                                                    <ul class="unstyled-list list-inline mb-25">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                    <p class="card-text text-primary mb-0">$1559.99</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div> --}}
                            <!-- Related Products ends -->
                        </div>
                    </section>
                    <!-- app e-commerce details end -->
    
                </div>
            </div>
        </div>
        <!-- END: Content-->
    
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
    </div>
</div>
<!-- END: Content-->
@endsection