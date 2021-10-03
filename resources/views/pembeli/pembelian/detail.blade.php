@extends('pembeli.layout.master')
@section('content')

<div class="app-content content ecommerce-application">
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
                            <div class="detail-title">Tanggal</div>
                            <div class="detail-amt">{{$getdataPesan->tanggal}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Nomor Resi</div>
                            <div class="detail-amt">{{$getdataPesan->resi}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Harga Barang</div>
                            <div class="detail-amt">{{$getdataPesan->total_pembayaran}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Ongkos Kirim</div>
                            <div class="detail-amt">{{$getdataPesan->ongkos_kirim}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Nama Pemesan</div>
                            <div class="detail-amt">{{Auth::user()->name}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Email Pemesan</div>
                            <div class="detail-amt">{{Auth::user()->email}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Nomor Telephone Pemesan</div>
                            <div class="detail-amt">{{$ud->no_telp}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">alamat</div>
                            <div class="detail-amt">{{$getdataPesan->alamat_lengkap}}</div>
                        </li>
                    </ul>
                    @if($st == null)
                    <h6 class="price-title">Transaksi</h6>
                    <ul class="list-unstyled">
                        @if($status['transaction_status'] == 'settlement')
                        <li class="price-detail">
                            <div class="detail-title">Tanggal Dibayarkan</div>
                            <div class="detail-amt">{{$status['settlement_time']}}</div>
                        </li>
                        @else
                        <li class="price-detail">
                            <div class="detail-title">VA Number / Bill Key</div>
                            <div class="detail-amt">{{$status['bill_key']}}</div>
                        </li>
                        @endif
                        <li class="price-detail">
                            <div class="detail-title">Total yan harus dibayarkan pada bank/transfer</div>
                            <div class="detail-amt">{{$status['gross_amount']}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Status Transaksi</div>
                            <div class="detail-amt">{{$status['transaction_status']}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Waktu Transaksi</div>
                            <div class="detail-amt">{{$status['transaction_time']}}</div>
                        </li>
                        <li class="price-detail">
                            <div class="detail-title">Pembayaran Harus Dilakukan Sampai</div>
                            <div class="detail-amt">{{date('Y-m-d H:i:s', strtotime('+1 day', strtotime($status['transaction_time'])))}}</div>
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
                    @if($getdataPesan->status_pembayaran == 0)
                        <button id="pay-button" type="button" class="btn btn-primary btn-block">pay</button>    
                        <form  id="payment-form" action="Payment" method="get" class="form-horizontal">
                            <input type="hidden" name="result_data" id="result_data" value="">
                        </form>
                        <p style="color: red; padding-top: 10px;">!!Penting!!</p>
                        <p style="color: red; font-size: 12px;">*Setelah Melakukan Pembayaran, Segera Lakukan Konfirmasi Kepada Admin Untuk Memperbarui <b>Status Pembayaran</b> Anda </p>
                    @else    
                        <a href="/buyer/pembelian" type="button" class="btn btn-primary btn-block">back</a>    
                    @endif
                </div>
            </div>
        </div>
        <script type="text/javascript"
        src="https://app.midtrans.com/snap/snap.js"
        data-client-key="Mid-client-VZ6_1c1NIb0RNZnb">
        </script>
        <br>
        
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');
                
                function changeResultType(type,data){
                    $('#result-type').val(type);
                    $('#result-data').val(JSON.stringify(data));
                }
                
                snap.pay('<?= $st ?>', {
                    onSuccess: function(result){
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result){
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result){
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        </script>
    </div>
</div>

@endsection