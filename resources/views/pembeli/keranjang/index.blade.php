@extends('pembeli.layout.master')
@section('content')
<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
       
        <div class="content-body" >
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
                                <span class="bs-stepper-title">Alamat</span>
                                <span class="bs-stepper-subtitle">Konfirmasi Alamat</span>
                            </span>
                        </button>
                    </div>
                    <div class="line">
                        <i data-feather="chevron-right" class="font-medium-2"></i>
                    </div>
                    {{-- <div class="step" data-target="#step-payment">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <i data-feather="credit-card" class="font-medium-3"></i>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">Payment</span>
                                <span class="bs-stepper-subtitle">Select Payment Method</span>
                            </span>
                        </button>
                    </div> --}}
                </div>
                <!-- Wizard ends -->
                <div class="bs-stepper-content">
                    <!-- Checkout Place order starts -->
                    <div id="step-cart" class="content" >
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
                    @if (!empty($pesanan))       
                    <div id="step-address" class="content" style="padding: 5px;" >
                        <div class="row justify-content-center" style="background: #E6E2EB">
                            <div id="checkout-address" class="list-view product-checkout">
                                <div>
                                    <form  method="POST" action="{{route('check-out')}}" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Checkout Customer Address Left starts -->
                                        <div class="card">
                                            <div class="card-header flex-column align-items-start">
                                                <h4 class="card-title">Tambahkan Alamat Pengiriman</h4>
                                                <p class="card-text text-muted mt-25">Untuk Memastikan Bahwa benar Alamat anda</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    {{-- <div class="col-md-6 col-sm-12">
                                                        <label>Provinsi Asal</label>
                                                        <select  class="select2 form-control form-control-lg" name="provinsi_asal">
                                                            <option value="">--Provinsi--</option>
                                                            @foreach ($provinsi as $provin => $value)    
                                                            <option value="{{$provin}}">{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> --}}
                                                    <div class="col-md-6 col-sm-12">
                                                        {{-- <div class="form-group mb-2">
                                                            <label>Kota Asal</label>
                                                            <select class="select2 form-control form-control-lg" name="kota_asal">
                                                                <option value="">--Kota--</option>
                                                                @foreach ($kota as $kotas => $value)    
                                                                <option value="{{$kotas}}">{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        {{-- <div class="form-group mb-2">
                                                            <label>Provinsi Tujuan</label>
                                                            <select class="select2 form-control form-control-lg" name="provinsi_tujuan">
                                                                <option value="">--Provinsi--</option>
                                                                @foreach ($provinsi as $provin => $value)    
                                                                <option value="{{$provin}}">{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <label>Kota Anda</label>
                                                            <select class="select2 form-control form-control-lg" name="kota_tujuan">
                                                                <option value="">--Kota--</option>
                                                                @foreach ($kota as $kotas => $value)    
                                                                <option value="{{$kotas}}">{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <label>Kurir</label>
                                                            <select class="select2 form-control form-control-lg" name="kurir">
                                                                <option value="">--Kurir--</option>
                                                                @foreach ($kurir as $kurirs => $value)    
                                                                <option value="{{$kurirs}}">{{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="form-group mb-2">
                                                            <label for="exampleFormControlTextarea1">Detail Alamat</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukan Alamat Lengkap" name="detail_alamat"></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary btn-next delivery-address"> Simpan dan Kirim ke sini</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Checkout Customer Address Left ends -->
            
                                       
                                    </form>
                                </div>

                                <div>
                                    @if (!empty($alamat1->kota_satu))
                                    <form style="margin-bottom: 10px" class="checkout-options" method="POST" action="{{route('check-out')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Opsi Alamat 1</h4>
                                            </div>
                                            <div class="card-body actions">
                                                <p class="card-text mb-0">Alamat Terdaftar :</p>
                                                <select class="select2 form-control form-control-lg"  name="kota_tujuan">
                                                    <option selected value="{{$alamat1->kota_satu}}">{{$alamat1->nama_kota}}</option>
                                                </select>
                                                </span>                                                            
                                                <input style="border: none" type="text" class="form-control text-center" id="readonlyInput"  name="detail_alamat" value="{{Auth::user()->detail->alamat_pertama}}" />
                                                <p class="card-text">Nomor Telepon : {{Auth::user()->detail->no_telp}}</p>
                                                <div class="form-group mb-2">
                                                    <label>Kurir</label>
                                                    <select class="select2 form-control form-control-lg" name="kurir">
                                                        <option value="">--Kurir--</option>
                                                        @foreach ($kurir as $kurirs => $value)    
                                                        <option value="{{$kurirs}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block  mt-2">
                                                    Kirim ke sini
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                              
                                    @if (!empty($alamat2->kota_dua) )
                                    <form style="margin-bottom: 10px" class="checkout-options" method="POST" action="{{route('check-out')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Opsi Alamat 2</h4>
                                            </div>
                                            <div class="card-body actions">
                                                <p class="card-text mb-0">Alamat Terdaftar :</p>
                                                <select class="select2 form-control form-control-lg"  name="kota_tujuan">
                                                    <option value="{{$alamat2->kota_dua}}">{{$alamat2->nama_kota}}</option>
                                                </select>
                                                </span>                                                            
                                                <input style="border: none" type="text" class="form-control text-center" id="readonlyInput"  name="detail_alamat" value="{{Auth::user()->detail->alamat_kedua}}" />
                                                <p class="card-text">Nomor Telepon : {{Auth::user()->detail->no_telp}}</p>
                                                <div class="form-group mb-2">
                                                    <label>Kurir</label>
                                                    <select class="select2 form-control form-control-lg" name="kurir">
                                                        <option value="">--Kurir--</option>
                                                        @foreach ($kurir as $kurirs => $value)    
                                                        <option value="{{$kurirs}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block  mt-2">
                                                    Kirim ke sini
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                    

                                    @if (!empty($alamat3->kota_tiga))         
                                    <form style="margin-bottom: 10px" class="checkout-options" method="POST" action="{{route('check-out')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Opsi Alamat 3</h4>
                                            </div>
                                            <div class="card-body actions">
                                                <p class="card-text mb-0">Alamat Terdaftar :</p>
                                                <select class="select2 form-control form-control-lg" disabled name="kota_tujuan">
                                                    <option value="{{$alamat3->kota_tiga}}">{{$alamat3->nama_kota}}</option>
                                                </select>
                                                </span>                                                            
                                                <input style="border: none" type="text" class="form-control text-center" id="readonlyInput"  name="detail_alamat" value="{{Auth::user()->detail->alamat_ketiga}}" />
                                                <p class="card-text">Nomor Telepon : {{Auth::user()->detail->no_telp}}</p>
                                                <div class="form-group mb-2">
                                                    <label>Kurir</label>
                                                    <select class="select2 form-control form-control-lg" name="kurir">
                                                        <option value="">--Kurir--</option>
                                                        @foreach ($kurir as $kurirs => $value)    
                                                        <option value="{{$kurirs}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block  mt-2">
                                                    Kirim ke sini
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                   

                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    @endif
                    <!-- Checkout Payment Ends -->
                    <!-- </div> -->
                </div>
            </div>

        </div>
    </div>
</div>
{{-- 
<script>
     $(document).ready(function(){
        //active select2
        //ajax select kota asal
        $('select[name="province_origin"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/../../keranjang/'+ provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('select[name="city_origin"]').empty();
                        $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="city_origin"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
            }
        });
        //ajax select kota tujuan
        $('select[name="province_destination"]').on('change', function () {
            let provindeId = $(this).val();
            if (provindeId) {
                jQuery.ajax({
                    url: '/cities/'+provindeId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('select[name="city_destination"]').empty();
                        $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
                        $.each(response, function (key, value) {
                            $('select[name="city_destination"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
            }
        });
        //ajax check ongkir
        let isProcessing = false;
        $('.btn-check').click(function (e) {
            e.preventDefault();

            let token            = $("meta[name='csrf-token']").attr("content");
            let city_origin      = $('select[name=city_origin]').val();
            let city_destination = $('select[name=city_destination]').val();
            let courier          = $('select[name=courier]').val();
            let weight           = $('#weight').val();

            if(isProcessing){
                return;
            }

            isProcessing = true;
            jQuery.ajax({
                url: "/ongkir",
                data: {
                    _token:              token,
                    city_origin:         city_origin,
                    city_destination:    city_destination,
                    courier:             courier,
                    weight:              weight,
                },
                dataType: "JSON",
                type: "POST",
                success: function (response) {
                    isProcessing = false;
                    if (response) {
                        $('#ongkir').empty();
                        $('.ongkir').addClass('d-block');
                        $.each(response[0]['costs'], function (key, value) {
                            $('#ongkir').append('<li class="list-group-item">'+response[0].code.toUpperCase()+' : <strong>'+value.service+'</strong> - Rp. '+value.cost[0].value+' ('+value.cost[0].etd+' hari)</li>')
                        });

                    }
                }
            });

        });

    });
</script> 
--}}


@endsection