@extends('penjual.layout.master')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table id="prdTB" class="">
                                <thead>
                                    <tr>
                                        <th>Tanggal Pembelian</th>
                                        <th>Gambar Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Harga Jual</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($produk as $item)
                                    <tr>
                                            <td>{{$item->tanggal_pembelian}}</td>
                                            <td><img src="{{asset('gambar-produk/'. $item->gambar )}}" alt="no image" style="width:100px;" class="rounded-circle"></td>
                                            <td>{{$item->nama_produk}}</td>
                                            <td>{{optional($item->produk)->jenis_kategori}}</td>
                                            <td>{{$item->stok}}</td>
                                            <td>{{$item->harga_jual}}</td>
                                            <td> 
                                                <button class="btn btn-primary btn-icon">
                                                <a href="{{route('produk.edit', $item->id)}}" type="button" role="button">
                                                  <i data-feather="edit-2" style="color: white;"></i>
                                                </a>
                                              </button>
                                              <form style="display: inline;" action="{{ route('produk.destroy', $item->id) }}" method="post" onsubmit="return confirm('Yakin hapus data ?')" >
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-icon">
                                                  <i data-feather="trash">a</i>
                                                </button>
                                              </form>
                                            </td>  
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal to add new record -->
                <div class="modal modal-slide-in fade" id="modals-slide-in">
                    <div class="modal-dialog sidebar-sm">
                        <form class="add-new-record modal-content pt-0" enctype="multipart/form-data" action="{{route('produk.store')}}" method="POST" >
                            @csrf
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <div class="form-group">
                                    <div>
                                        <div class="form-group">
                                            <label for="customFile">Gambar</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="gambar_produk" required accept=".jpg, .png"/>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="nama_produk" />
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label>Kategori</label>
                                        <select class="select2 form-control form-control-lg" name="kategori">
                                            @foreach ($kategori as $item)
                                            <option value="{{$item->id}}">{{$item->jenis_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label" for="basic-icon-default-salary">Berat Produk</label>
                                    <input type="number" id="basic-icon-default-salary" class="form-control dt-salary" name="berat" placeholder="Satuan Kg"/>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="fp-default">Tanggal</label>
                                        <input type="text" id="fp-default" name="tanggal_beli" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Stok</label>
                                    <input type="number" class="form-control dt-full-name" id="basic-icon-default-fullname" name="stok" placeholder="Kuantitas"  />
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Deskripsi</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi" placeholder="Masukan Deskripsi Produk"></textarea>
                                </div>
                                <div class="form-group">
                                        <label>Supplier</label>
                                        <select class="select2 form-control form-control-lg" name="supplier_id">
                                            @foreach ($supp as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                           
                                        </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label" for="basic-icon-default-salary">Harga Jual</label>
                                    <input type="number" id="basic-icon-default-salary" class="form-control dt-salary" name="harga_jual" />
                                </div>
                                <div class="form-group mb-4">
                                  <label class="form-label" for="basic-icon-default-salary">Harga Beli</label>
                                  <input type="number" id="basic-icon-default-salary" class="form-control dt-salary" name="harga_beli" />
                              </div>
                                <button type="submit" class="btn btn-primary data-submit mr-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- MODAL KATEGORI --}}
                
            </section>
            <!--/ Basic table -->

        </div>
    </div>
</div>

<!--/ Scroll - horizontal and vertical table -->

@endsection