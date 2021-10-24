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
                                        <th>Tanggal pembelian</th>
                                        <th>Tanggal penjualan</th>
                                        <th>Pembeli</th>
                                        <th>Keuntungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pesanan as $item)
                                    <tr>
                                        <td>
                                            @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                            {{Carbon\Carbon::parse($i->barang->tanggal_pembelian)->isoFormat('dddd, D MMMM Y')}} <br>
                                            @endforeach
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-backdrop="false" data-target="#backdrop{{$item->id}}">
                                                {{Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y')}}
                                            </button>
                                           
                                        </td>

                                        <td>
                                            {{$item->pesan->nama}}
                                          
                                        </td>

                                        <td>
                                            @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                            Rp. {{($i->barang->harga_jual * $i->jumlah) - ($i->barang->harga_awal * $i->jumlah)}} <br>
                                            @endforeach
                                        </td>
                                    </tr>

                                      {{-- Modal --}}
                                    <div class="modal fade text-left" id="backdrop{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel4">Detail Laporan</h4>
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
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nama Pembeli" aria-label="John Doe" value="{{$i->barang->nama_produk }}  x  {{$i->jumlah}} 
                                                    " disabled /> <br>
                                                    @endforeach


                                                    <label class="form-label" for="basic-icon-default-post">Harga Beli</label>
                                                    @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nama Pembeli" aria-label="John Doe" value="{{$i->barang->nama_produk }} = Rp. {{$i->barang->harga_awal }}  
                                                    " disabled /> <br>
                                                    @endforeach


                                                    <label class="form-label" for="basic-icon-default-post">Total Harga Beli</label>
                                                    @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nama Pembeli" aria-label="John Doe" value="Rp. {{$i->barang->harga_awal * $i->jumlah}}  
                                                    " disabled /> <br>
                                                    @endforeach
                                                  
                                                    <label class="form-label" for="basic-icon-default-post">Harga Jual</label>
                                                    @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nama Pembeli" aria-label="John Doe" value="{{$i->barang->nama_produk }} = Rp. {{$i->barang->harga_jual }}  
                                                    " disabled /> <br>
                                                    @endforeach

                                                    <label class="form-label" for="basic-icon-default-post">Total Harga Jual</label>
                                                    @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nama Pembeli" aria-label="John Doe" value="Rp. {{$i->barang->harga_jual * $i->jumlah}}  
                                                    " disabled /> <br>
                                                    @endforeach

                                                    <label class="form-label" for="basic-icon-default-post">Keuntungan</label>
                                                    
                                                    @foreach ($detail_pesanan->where('pesanan_id',$item->id) as $i)
                                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="Nama Pembeli" aria-label="John Doe" value="Rp. {{($i->barang->harga_jual * $i->jumlah) - ($i->barang->harga_awal * $i->jumlah)}}  
                                                    " disabled /> <br>
                                                    @endforeach
                                                    
                                                   
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div
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
@endsection
