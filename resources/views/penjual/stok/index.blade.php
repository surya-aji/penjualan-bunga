@extends('penjual.layout.master')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="dt-multilingual table">
                                <thead>
                                    <tr>
                                        <th>Tanggal Terjual</th>
                                        <th>Nama Pembeli</th>
                                        <th>Status Pembayaran</th>
                                        <th>Resi</th>
                                        <th>Status Dikirim</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pesanan as $item)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-backdrop="false" data-target="#backdrop{{$item->id}}">
                                                {{Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, D MMMM Y')}}
                                            </button></td>
                                        <td>{{$item->pesan->nama}}</td>
                                        <td>{{$item->status_pembayaran == 1 ? 'Telah Dibayar' : 'Belum Dibayar'}}</td>
                                        <td>
                                            @if ($item->resi == null)
                                            <button type="button" class="btn btn-primary data-submit" data-toggle="modal" data-target="#inlineForm{{$item->id}}">Kirim Resi</button>
                                            @else
                                            {{$item->resi}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_pembayaran == 1 && $item->status_pengiriman == 1)
                                                <button type="button" class="btn btn-success data-submit mr-1">Pesanan Dikirim</button>
                                            @elseif($item->status_pembayaran == 0 && $item->status_pengiriman == 0)
                                            <button type="button" class="btn btn-outline-primary data-submit mr-1 disabled">Menunggu Pembayaran</button>
                                            @else
                                            <form action="{{route('validasi-kirim',$item->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                            <button type="submit" class="btn btn-primary data-submit mr-1">Validasi Pengiriman</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Modal --}}
                                    <div class="modal fade text-left" id="backdrop{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel4">Detail Pembelian</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label class="form-label" for="basic-icon-default-post">Nama Pembeli</label>
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nama Pembeli" aria-label="John Doe" value="{{$item->pesan->nama}}" disabled />

                                                    <label class="form-label" for="basic-icon-default-post">Nomor Telepon</label>
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nama Pembeli" aria-label="John Doe" value="{{$item->pesan->no_telp}}" disabled />


                                                    <label class="form-label" for="basic-icon-default-post">Alamat</label>
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nama Pembeli" aria-label="John Doe" value="{{$item->alamat_lengkap}}" disabled />

                                                    <label class="form-label" for="basic-icon-default-post">Produk</label>
                                                    @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nama Pembeli" aria-label="John Doe" value="{{$i->barang->nama_produk}} Harga : Rp.{{$i->barang->harga_awal}} Dengan Jumlah : {{$i->jumlah}} 
                                                    " disabled /> <br>
                                                    @endforeach
                                                    <label class="form-label" for="basic-icon-default-post">Total Yang dibayar</label>
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" aria-label="John Doe" value="{{$item->total_pembayaran}}" disabled /><br>

                                                    @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                                        <img class="rounded" width="120" height="120" src="{{asset('gambar-produk/'. $i->barang->gambar )}}" alt="img-placeholder" />
                                                    @endforeach
                                                  
                                                   
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal Resi --}}
                                    <div class="modal fade text-left" id="inlineForm{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel33">Penambahan Resi</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{route('cetak-resi',$item->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <label>Resi: </label>
                                                        <div class="form-group">
                                                            <input type="text" placeholder="Nomor Resi" class="form-control" name="resi" />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Kirim Resi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    @endforeach


                                 
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Basic table -->

        </div>
    </div>
</div>


<!--/ Scroll - horizontal and vertical table -->

@endsection