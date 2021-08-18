

@extends('penjual.layout.master')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
         <!-- Basic Vertical form layout section start -->
         <section id="basic-vertical-layouts">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Produk</h4>
                        </div>
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="{{route("produk.update",$produk->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                                            <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="nama_produk_edit" value="{{$produk->nama_produk}}" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div>
                                                <label for="fp-default">Tanggal Pembelian</label>
                                                <input type="text" id="fp-default" name="tanggal_beli_edit" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" value="{{$produk->tanggal_pembelian}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <div class="form-group">
                                            <label>Kategori</label>
                                            <select class="select2 form-control form-control-lg" name="kategori_edit">
                                                @foreach ($kategori as $item)
                                                <option value="{{$item->id}}">{{$item->jenis_kategori}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="basic-icon-default-fullname">Stok</label>
                                            <input type="number" class="form-control dt-full-name" id="basic-icon-default-fullname" name="stok_edit" placeholder="Kuantitas" value="{{$produk->stok}}"  />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="basic-icon-default-fullname">Berat Produk</label>
                                            <input type="number" class="form-control dt-full-name" id="basic-icon-default-fullname" name="berat_edit" placeholder="Satuan Gram" value="{{$produk->berat}}"  />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-4">
                                            <label class="form-label" for="basic-icon-default-salary">Harga Beli</label>
                                            <input type="text" id="basic-icon-default-salary" class="form-control dt-salary" name="harga_beli_edit"  value="{{$produk->harga_jual}}"/>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group mb-4">
                                            <label class="form-label" for="basic-icon-default-salary">Harga Jual</label>
                                            <input type="text" id="basic-icon-default-salary" class="form-control dt-salary" name="harga_jual_edit" value="{{$produk->harga_awal}}"/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Vertical form layout section end -->


        </div>
    </div>
</div>

<!--/ Scroll - horizontal and vertical table -->

@endsection