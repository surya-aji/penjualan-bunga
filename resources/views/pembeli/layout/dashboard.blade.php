@extends('pembeli.layout.master')
@section('content')
<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="">
            <div class="content-body">
                <!-- E-commerce Content Section Starts -->
                <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                    <div>
                        <form  class="row mt-1" action="{{route('cari-kategori',)}}" method="GET">
                            @csrf
                            <div class="col-sm-11">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control search-product" name="cari" id="shop-search" placeholder="Cari Produk" aria-label="Search..." aria-describedby="shop-search" />
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{-- <i data-feather="search"></i> --}}
                                    Cari
                                </button>
                            </div>
                        </form>
                      
                    </div>
                </section>
                <!-- E-commerce Content Section Starts -->

                <!-- background Overlay when sidebar is shown  starts-->
                <div class="body-content-overlay"></div>
                <!-- background Overlay when sidebar is shown  ends-->

                <!-- E-commerce Search Bar Starts -->
                <!-- E-commerce Search Bar Ends -->

                <!-- E-commerce Products Starts -->
                <section id="ecommerce-products" class="grid-view">

                    @foreach ($kategori as $item)
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href={{route('halaman-kategori',$item->id)}}>
                                <img class="img-fluid card-img-top" src="{{asset('gambar-kategori/'. $item->gambar )}}" alt="img-placeholder" /></a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                            </div>
                            <h6 class="item-name">
                                <a class="text-body text-center" href={{route('halaman-kategori',$item->id)}}>{{$item->jenis_kategori}}</a>
                            </h6>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                            </div>
                            {{-- <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                <i data-feather="heart"></i>
                                <span>Wishlist</span>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a> --}}
                        </div>
                    </div>
                        
                    @endforeach


                    {{-- <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="app-ecommerce-details.html">
                                <img class="img-fluid card-img-top" src="{{asset('app-assets/images/pages/eCommerce/2.png')}}" alt="img-placeholder" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="item-rating">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                    </ul>
                                </div>
                                <div>
                                    <h6 class="item-price">$669.99</h6>
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="app-ecommerce-details.html">Apple iPhone 11 (64GB, Black)</a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Apple</a></span>
                            </h6>
                            <p class="card-text item-description">
                                The Apple iPhone 11 is a great smartphone, which was loaded with a lot of quality features. It comes with a
                                waterproof and dustproof body which is the key attraction of the device. The excellent set of cameras offer
                                excellent images as well as capable of recording crisp videos. However, expandable storage and a fingerprint
                                scanner would have made it a perfect option to go for around this price range.
                            </p>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price">$699.99</h4>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                <i data-feather="heart" class="text-danger"></i>
                                <span>Wishlist</span>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a>
                        </div>
                    </div>
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="app-ecommerce-details.html"><img class="img-fluid card-img-top" src="{{asset('app-assets/images/pages/eCommerce/3.png')}}" alt="img-placeholder" /></a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="item-rating">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                    </ul>
                                </div>
                                <div>
                                    <div class="item-cost">
                                        <h6 class="item-price">$999.99</h6>
                                    </div>
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="app-ecommerce-details.html">Apple iMac 27-inch</a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Apple</a></span>
                            </h6>
                            <p class="card-text item-description">
                                The all-in-one for all. If you can dream it, you can do it on iMac. It???s beautifully & incredibly intuitive and
                                packed with tools that let you take any idea to the next level. And the new 27-inch model elevates the
                                experience in way, with faster processors and graphics, expanded memory and storage, enhanced audio and video
                                capabilities, and an even more stunning Retina 5K display. It???s the desktop that does it all ??? better and faster
                                than ever.
                            </p>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price">$999.99</h4>
                                    <p class="card-text shipping"><span class="badge badge-pill badge-light-success">Free Shipping</span></p>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                <i data-feather="heart"></i>
                                <span>Wishlist</span>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a>
                        </div>
                    </div>
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="app-ecommerce-details.html">
                                <img class="img-fluid card-img-top" src="{{asset('app-assets/images/pages/eCommerce/4.png')}}" alt="img-placeholder" /></a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="item-rating">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                    </ul>
                                </div>
                                <div class="item-cost">
                                    <h6 class="item-price">$49.99</h6>
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="app-ecommerce-details.html">OneOdio A71 Wired Headphones</a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">OneOdio</a></span>
                            </h6>
                            <p class="card-text item-description">
                                Omnidirectional detachable boom mic upgrades the headphones into a professional headset for gaming, business,
                                podcasting and taking calls on the go. Better pick up your voice. Control most electric devices through voice
                                activation, or schedule a ride with Uber and order a pizza. OneOdio A71 Wired Headphones voice-controlled device
                                turns any home into a smart device on a smartphone or tablet.
                            </p>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price">$49.99</h4>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                <i data-feather="heart"></i>
                                <span>Wishlist</span>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a>
                        </div>
                    </div>
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="app-ecommerce-details.html">
                                <img class="img-fluid card-img-top" src="{{asset('app-assets/images/pages/eCommerce/5.png')}}" alt="img-placeholder" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="item-rating">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                    </ul>
                                </div>
                                <div class="item-cost">
                                    <h6 class="item-price">$999.99</h6>
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="app-ecommerce-details.html">
                                    Apple - MacBook Air?? (Latest Model) - 13.3" Display - Silver
                                </a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Apple</a></span>
                            </h6>
                            <p class="card-text item-description">
                                MacBook Air is a thin, lightweight laptop from Apple. MacBook Air features up to 8GB of memory, a
                                fifth-generation Intel Core processor, Thunderbolt 2, great built-in apps, and all-day battery life.1 Its thin,
                                light, and durable enough to take everywhere you go-and powerful enough to do everything once you get there,
                                better.
                            </p>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price">$999.99</h4>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                <i data-feather="heart" class="text-danger"></i>
                                <span>Wishlist</span>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a>
                        </div>
                    </div>
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="app-ecommerce-details.html">
                                <img class="img-fluid card-img-top" src="{{asset('app-assets/images/pages/eCommerce/6.png')}}" alt="img-placeholder" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="item-rating">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                    </ul>
                                </div>
                                <div class="item-cost">
                                    <h6 class="item-price">$429.99</h6>
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="app-ecommerce-details.html"> Switch Pro Controller </a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Sharp</a></span>
                            </h6>
                            <p class="card-text item-description">
                                The Nintendo Switch Pro Controller is one of the priciest "baseline" controllers in the current console
                                generation, but it's also sturdy, feels good to play with, has an excellent direction pad, and features
                                impressive motion sensors and vibration systems. On top of all of that, it uses Bluetooth, so you don't need an
                                adapter to use it with your PC.
                            </p>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price">$429.99</h4>
                                    <p class="card-text shipping"><span class="badge badge-pill badge-light-success">Free Shipping</span></p>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                <i data-feather="heart"></i>
                                <span>Wishlist</span>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a>
                        </div>
                    </div>
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="app-ecommerce-details.html">
                                <img class="img-fluid card-img-top" src="{{asset('app-assets/images/pages/eCommerce/7.png')}}" alt="img-placeholder" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="item-rating">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                    </ul>
                                </div>
                                <div class="item-cost">
                                    <h6 class="item-price">$129.29</h6>
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="app-ecommerce-details.html"> Google - Google Home - White/Slate fabric </a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Google</a></span>
                            </h6>
                            <p class="card-text item-description">
                                Simplify your everyday life with the Google Home, a voice-activated speaker powered by the Google Assistant. Use
                                voice commands to enjoy music, get answers from Google and manage everyday tasks. Google Home is compatible with
                                Android and iOS operating systems, and can control compatible smart devices such as Chromecast or Nest.
                            </p>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price">$129.29</h4>
                                    <p class="card-text shipping">
                                        <span class="badge badge-pill badge-light-success">Free Shipping</span>
                                    </p>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                <i data-feather="heart"></i>
                                <span>Wishlist</span>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a>
                        </div>
                    </div>
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="app-ecommerce-details.html">
                                <img class="img-fluid card-img-top" src="{{asset('app-assets/images/pages/eCommerce/8.png')}}" alt="img-placeholder" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="item-rating">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                    </ul>
                                </div>
                                <div class="item-cost">
                                    <h6 class="item-price">$7999.99</h6>
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="app-ecommerce-details.html"> Sony 4K Ultra HD LED TV </a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Apple</a></span>
                            </h6>
                            <p class="card-text item-description">
                                Sony 4K Ultra HD LED TV has 4K HDR Support. The TV provides clear visuals and provides distinct sound quality
                                and an immersive experience. This TV has Yes HDMI ports & Yes USB ports. Connectivity options included are HDMI.
                                You can connect various gadgets such as your laptop using the HDMI port. The TV comes with a 1 Year warranty.
                            </p>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price">$29.99</h4>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                <i data-feather="heart"></i>
                                <span>Wishlist</span>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a>
                        </div>
                    </div>
                    <div class="card ecommerce-card">
                        <div class="item-img text-center">
                            <a href="app-ecommerce-details.html">
                                <img class="img-fluid card-img-top" src="{{asset('app-assets/images/pages/eCommerce/9.png')}}" alt="img-placeholder" />
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="item-wrapper">
                                <div class="item-rating">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                    </ul>
                                </div>
                                <div class="item-cost">
                                    <h6 class="item-price">$14.99</h6>
                                </div>
                            </div>
                            <h6 class="item-name">
                                <a class="text-body" href="app-ecommerce-details.html"> OnePlus 7 Pro </a>
                                <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Philips</a></span>
                            </h6>
                            <p class="card-text item-description">
                                The OnePlus 7 Pro features a brand new design, with a glass back and front and curved sides. The phone feels
                                very premium but???s it???s also very heavy. The Nebula Blue variant looks slick but it???s quite slippery, which
                                makes single-handed use a real challenge. It has a massive 6.67-inch ???Fluid AMOLED??? display with a QHD+
                                resolution, 90Hz refresh rate and support for HDR 10+ content. The display produces vivid colours, deep blacks
                                and has good viewing angles.
                            </p>
                        </div>
                        <div class="item-options text-center">
                            <div class="item-wrapper">
                                <div class="item-cost">
                                    <h4 class="item-price">$14.99</h4>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                <i data-feather="heart"></i>
                                <span>Wishlist</span>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                <i data-feather="shopping-cart"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </a>
                        </div>
                    </div> --}}
                </section>
                <!-- E-commerce Products Ends -->

                <!-- E-commerce Pagination Starts -->
               
                <!-- E-commerce Pagination Ends -->

            </div>
        </div>
        {{-- <div class="sidebar-detached sidebar-left">
            <div class="sidebar">
                <!-- Ecommerce Sidebar Starts -->
                <div class="sidebar-shop">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6 class="filter-heading d-none d-lg-block">Filters</h6>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- Price Filter starts -->
                            <div class="multi-range-price">
                                <h6 class="filter-title mt-0">Multi Range</h6>
                                <ul class="list-unstyled price-range" id="price-range">
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="priceAll" name="price-range" class="custom-control-input" checked />
                                            <label class="custom-control-label" for="priceAll">All</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="priceRange1" name="price-range" class="custom-control-input" />
                                            <label class="custom-control-label" for="priceRange1">&lt;=$10</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="priceRange2" name="price-range" class="custom-control-input" />
                                            <label class="custom-control-label" for="priceRange2">$10 - $100</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="priceARange3" name="price-range" class="custom-control-input" />
                                            <label class="custom-control-label" for="priceARange3">$100 - $500</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="priceRange4" name="price-range" class="custom-control-input" />
                                            <label class="custom-control-label" for="priceRange4">&gt;= $500</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Price Filter ends -->

                            <!-- Price Slider starts -->
                            <div class="price-slider">
                                <h6 class="filter-title">Price Range</h6>
                                <div class="price-slider">
                                    <div class="range-slider mt-2" id="price-slider"></div>
                                </div>
                            </div>
                            <!-- Price Range ends -->

                            <!-- Categories Starts -->
                            <div id="product-categories">
                                <h6 class="filter-title">Categories</h6>
                                <ul class="list-unstyled categories-list">
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="category1" name="category-filter" class="custom-control-input" checked />
                                            <label class="custom-control-label" for="category1">Appliances</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="category2" name="category-filter" class="custom-control-input" />
                                            <label class="custom-control-label" for="category2">Audio</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="category3" name="category-filter" class="custom-control-input" />
                                            <label class="custom-control-label" for="category3">Cameras & Camcorders</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="category4" name="category-filter" class="custom-control-input" />
                                            <label class="custom-control-label" for="category4">Car Electronics & GPS</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="category5" name="category-filter" class="custom-control-input" />
                                            <label class="custom-control-label" for="category5">Cell Phones</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="category6" name="category-filter" class="custom-control-input" />
                                            <label class="custom-control-label" for="category6">Computers & Tablets</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="category7" name="category-filter" class="custom-control-input" />
                                            <label class="custom-control-label" for="category7">Health, Fitness & Beauty</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="category8" name="category-filter" class="custom-control-input" />
                                            <label class="custom-control-label" for="category8">Office & School Supplies</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="category9" name="category-filter" class="custom-control-input" />
                                            <label class="custom-control-label" for="category9">TV & Home Theater</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="category10" name="category-filter" class="custom-control-input" />
                                            <label class="custom-control-label" for="category10">Video Games</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- Categories Ends -->

                            <!-- Brands starts -->
                            <div class="brands">
                                <h6 class="filter-title">Brands</h6>
                                <ul class="list-unstyled brand-list">
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productBrand1" />
                                            <label class="custom-control-label" for="productBrand1">Insignia???</label>
                                        </div>
                                        <span>746</span>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productBrand2" checked />
                                            <label class="custom-control-label" for="productBrand2">Samsung</label>
                                        </div>
                                        <span>633</span>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productBrand3" />
                                            <label class="custom-control-label" for="productBrand3">Metra</label>
                                        </div>
                                        <span>591</span>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productBrand4" />
                                            <label class="custom-control-label" for="productBrand4">HP</label>
                                        </div>
                                        <span>530</span>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productBrand5" checked />
                                            <label class="custom-control-label" for="productBrand5">Apple</label>
                                        </div>
                                        <span>442</span>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productBrand6" />
                                            <label class="custom-control-label" for="productBrand6">GE</label>
                                        </div>
                                        <span>394</span>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productBrand7" />
                                            <label class="custom-control-label" for="productBrand7">Sony</label>
                                        </div>
                                        <span>350</span>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productBrand8" />
                                            <label class="custom-control-label" for="productBrand8">Incipio</label>
                                        </div>
                                        <span>320</span>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productBrand9" />
                                            <label class="custom-control-label" for="productBrand9">KitchenAid</label>
                                        </div>
                                        <span>318</span>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="productBrand10" />
                                            <label class="custom-control-label" for="productBrand10">Whirlpool</label>
                                        </div>
                                        <span>298</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- Brand ends -->

                            <!-- Rating starts -->
                            <div id="ratings">
                                <h6 class="filter-title">Ratings</h6>
                                <div class="ratings-list">
                                    <a href="javascript:void(0)">
                                        <ul class="unstyled-list list-inline">
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li>& up</li>
                                        </ul>
                                    </a>
                                    <div class="stars-received">160</div>
                                </div>
                                <div class="ratings-list">
                                    <a href="javascript:void(0)">
                                        <ul class="unstyled-list list-inline">
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li>& up</li>
                                        </ul>
                                    </a>
                                    <div class="stars-received">176</div>
                                </div>
                                <div class="ratings-list">
                                    <a href="javascript:void(0)">
                                        <ul class="unstyled-list list-inline">
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li>& up</li>
                                        </ul>
                                    </a>
                                    <div class="stars-received">291</div>
                                </div>
                                <div class="ratings-list">
                                    <a href="javascript:void(0)">
                                        <ul class="unstyled-list list-inline">
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li>& up</li>
                                        </ul>
                                    </a>
                                    <div class="stars-received">190</div>
                                </div>
                            </div>
                            <!-- Rating ends -->

                            <!-- Clear Filters Starts -->
                            <div id="clear-filters">
                                <button type="button" class="btn btn-block btn-primary">Clear All Filters</button>
                            </div>
                            <!-- Clear Filters Ends -->
                        </div>
                    </div>
                </div>
                <!-- Ecommerce Sidebar Ends -->

            </div>
        </div> --}}
    </div>
</div>
<!-- END: Content-->
@endsection