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
                            @foreach ($detail_pesanan as $i)
                                <img class="rounded" width="50" height="50" src="{{asset('gambar-produk/'. $i->barang->gambar )}}" alt="img-placeholder" />
                            @endforeach
                        </td>
                        <td>
                            @foreach ($detail_pesanan as $i)
                                {{$i->barang->nama_produk}}
                             @endforeach
                        </td>
                        <td>
                            @foreach ($detail_pesanan as $i)
                              {{$i->barang->nama_produk}} : Rp.{{ number_format($i->barang->harga_jual) }}
                             @endforeach
                        </td>
                        <td>
                            @foreach ($detail_pesanan as $i)
                                {{$i->barang->nama_produk}} : {{$i->jumlah}}
                             @endforeach
                        </td>
                        <td>Rp.{{ number_format($item->total_pembayaran + $item->ongkos_kirim) }}</td>
                        <td>@if($item->status_pembayaran == 0)
                            <a href="/buyer/pembelian/{{$item->id}}/detail" id="pay-button"   type="button" class="btn btn-danger btn-sm">Klik Untuk Bayar</a></td>
                            @else
                            <a href="/buyer/pembelian/{{$item->id}}/detail" id="pay-button"   type="button" class="btn btn-success btn-sm">Sudah Dibayar</a></td>
                            @endif
                        <td>{{$item->resi}}</td>
                        <td><span type="submit" class="btn btn-primary btn-sm">Diterima</span></td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
       </div>
    </div>
</div>
@endsection