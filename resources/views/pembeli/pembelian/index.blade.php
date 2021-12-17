@extends('pembeli.layout.master')
@section('content')
<div class="app-content content ecommerce-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
       <div class="row justify-content-center">
        <div class="card-datatable">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah Pembelian</th>
                        <th>SubTotal</th>
                        <th>Status Pembayaran</th>
                        <th>Nomor Resi</th>
                        <th>Status Pemesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanan as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y')}}</td>
                        <td>
                            @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                <img class="rounded" width="50" height="50" src="{{asset('gambar-produk/'. $i->barang->gambar )}}" alt="img-placeholder" />
                            @endforeach
                        </td>
                        <td>
                            @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                {{$i->barang->nama_produk}} <br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                              {{$i->barang->nama_produk}} : Rp.{{ number_format($i->barang->harga_jual) }} <br>
                             @endforeach
                        </td>
                        <td>
                            @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                {{$i->barang->nama_produk}} : {{$i->jumlah}} <br>
                             @endforeach
                        </td>
                        <td>Rp.{{ number_format($item->total_pembayaran + $item->ongkos_kirim) }}</td>
                        
                        {{-- @if($item->status_pembayaran == 0)
                        <td><a href="/buyer/pembelian/{{$item->id}}/detail" id="pay-button"   type="button" class="btn btn-danger btn-sm">Klik Untuk Bayar</a></td>
                        @else
                        <td><a href="/buyer/pembelian/{{$item->id}}/detail" id="pay-button"   type="button" class="btn btn-success btn-sm">Sudah Dibayar</a></td>
                        @endif --}}
                        
                        {{-- <td>
                            @if (!empty($item->resi))
                                {{$item->resi}}
                            @else
                            <button type="button" class="btn btn-outline-primary data-submit mr-1 disabled">Menunggu Konfirmasi Dari Penjual</button>
                            @endif
                        </td>
                        <td><button type="submit" class="btn btn-primary btn-next delivery-address">Diterima</button></td> --}}


                        <td>
                            @if($item->status_pembayaran == 0)
                                <a href="/buyer/pembelian/{{$item->id}}/detail" id="pay-button" type="button" class="btn btn-danger btn-sm" onclick="alert('Bila Halaman Tidak Berpindah Ke Halaman Pembayaran. Harap Konfirmasi Kepada admin untuk mengubah status pembayaran');">Klik Untuk Bayar</a>
                            @else
                                <a href="/buyer/pembelian/{{$item->id}}/detail" id="pay-button" type="button" class="btn btn-success btn-sm">Sudah Dibayar</a>
                            @endif
                        </td>
                        <td>{{$item->resi}}</td>
                        <td>
                            @if ($item->status_pengiriman == 2)
                            <button type="button" class="btn btn-success btn-sm disabled">Pesanan Diterima</button>
                            @elseif($item->status_pengiriman == 1)
                            <button type="button" class="btn btn-primary btn-sm disabled">Pesanan Sedang Dikirim</button>
                            @else
                            <form action="{{route('validasi-terima',$item->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Pesanan Diterima</button>
                            </form>
                            @endif
                           
                    </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       </div>
    </div>
</div>
@endsection