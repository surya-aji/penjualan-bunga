@extends('penjual.layout.master')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
    <div class="checkout-options">
        <div class="card">
            <div class="card-body">
                <label class="section-label mb-1">Informasi Pesanan</label>
                
                <hr />
                <div class="price-details">
                    <h6 class="price-title">Detail</h6>
                    <ul class="list-unstyled">
                        <li class="price-detail">
                            <div class="detail-title">Nomor Resi : </div>
                            <div class="detail-amt font-weight-bolder">{{$getdataPesan->resi}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Harga Barang : </div>
                            <div class="detail-amt font-weight-bolder">{{$getdataPesan->total_pembayaran}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Ongkos Kirim : </div>
                            <div class="detail-amt font-weight-bolder">{{$getdataPesan->ongkos_kirim}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Nama Pemesan : </div>
                            <div class="detail-amt font-weight-bolder">{{Auth::user()->name}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Email Pemesan : </div>
                            <div class="detail-amt font-weight-bolder">{{Auth::user()->email}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Nomor Telephone Pemesan : </div>
                            <div class="detail-amt font-weight-bolder">{{$ud->no_telp}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">alamat : </div>
                            <div class="detail-amt font-weight-bolder">{{$getdataPesan->alamat_lengkap}}</div>
                        </li>
                    </ul>
                    @if($st == null)
                    <h6 class="price-title">Transaksi</h6>
                    <ul class="list-unstyled">
                        @if($status['transaction_status'] == 'settlement')
                        <li class="price-detail">
                            <div class="detail-title">Tanggal Dibayarkan : </div>
                            <div class="detail-amt font-weight-bolder">{{$status['settlement_time']}}</div>
                        </li>
                        @else
                        <li class="price-detail">
                            <div class="detail-title">VA Number / Bill Key: </div>
                            <div class="detail-amt font-weight-bolder">{{$status['bill_key']}}</div>
                        </li>
                        @endif
                        <li class="price-detail">
                            <div class="detail-title">Total yan harus dibayarkan pada bank/transfer : </div>
                            <div class="detail-amt font-weight-bolder">{{$status['gross_amount']}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Status Transaksi : </div>
                            <div class="detail-amt font-weight-bolder">{{$status['transaction_status']}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Waktu Transaksi : </div>
                            <div class="detail-amt font-weight-bolder">{{$status['transaction_time']}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Pembayaran Harus Dilakukan Sampai : </div>
                            <div class="detail-amt font-weight-bolder">{{date('Y-m-d H:i:s', strtotime('+1 day', strtotime($status['transaction_time'])))}}</div>
                        </li>
                    </ul>
                    @endif
                    <hr />
                    <ul class="list-unstyled">
                        <li class="price-detail">
                            <div class="detail-title detail-total">Total Harga </div>
                            <div class="detail-amt font-weight-bolder">Rp. {{ number_format($getdataPesan->total_pembayaran + $getdataPesan->ongkos_kirim) }}
                                
                            </div>
                        </li>
                    </ul>
                    @if($getdataPesan->status_pembayaran == '0')
                    <form class="form form-vertical" method="POST" action="/seller/penjualan/{{$getdataPesan->id}}/update" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-4">
                                    <label class="form-label" for="basic-icon-default-salary">Status Pembayaran</label>
                                    <select class="custom-select" name="status_pembayaran" id="status_pembayaran">
                                        <option value="0">Belum Bayar</option>
                                        <option value="1">Sudah Bayar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Ubah Status Pembayaran Untuk Verifikasi</button>
                    </form>
                    @else
                    <a href="/seller/penjualan" type="button" class="btn btn-primary btn-block">Ubah Status Pembayaran Untuk Verifikasi</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!--/ Scroll - horizontal and vertical table -->



@endsection