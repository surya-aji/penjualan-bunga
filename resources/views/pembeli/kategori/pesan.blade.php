@extends('pembeli.layout.master')
@section('content')
<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
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
                                                    <input type="number" class="form-control" name="jumlah" id="basicInput" placeholder="Masukan Jumlah Pesanan" required />
                                                </div>
                                            <hr />
                                            <hr />
                                            <div class="d-flex flex-column flex-sm-row pt-1">
                                                <button type="submit" class="btn btn-primary btn-cart mr-0 mr-sm-1 mb-1 mb-sm-0">
                                                    <i data-feather="shopping-cart" class="mr-50"></i>
                                                    Masukan Ke Keranjang
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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




