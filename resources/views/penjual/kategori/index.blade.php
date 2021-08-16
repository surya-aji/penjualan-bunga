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
                            <table class="datatables-basic table">
                                <thead>
                                    <tr>
                                        <th>Jenis Kategori</th>
                                        <th>Gambar</th>
                                        <th>Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                              
                                @foreach ($kategori as $item)
                                <tr>
                                        <td>{{$item->jenis_kategori}}</td>
                                        <td><img src="{{asset('gambar-kategori/'. $item->gambar )}}" alt="no image" style="width:100px;" class="rounded-circle"></td>
                                        <td>{{$item->nama_produk}}</td>
                                        <td> 
                                            {{-- <button class="btn btn-primary btn-icon">
                                            <a href="{{route('kategori.edit', $item->id)}}" type="button" role="button">
                                              <i data-feather="edit-2" style="color: white;"></i>
                                            </a>
                                          </button> --}}
                                          <form style="display: inline;" action="{{ route('kategori.destroy', $item->id) }}" method="post" onsubmit="return confirm('Yakin hapus data ?')" >
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-icon">
                                              <i data-feather="trash">a</i>
                                            </button>
                                          </form></td>  
                                          <td></td>
                                    </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Modal to add new record -->
                <div class="modal modal-slide-in fade" id="modals-slide-in">
                    <div class="modal-dialog sidebar-sm">
                        <form class="add-new-record modal-content pt-0" enctype="multipart/form-data" action="{{route('kategori.store')}}" method="POST" >
                            @csrf
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <div class="form-group">
                                    <div>
                                        <div class="form-group">
                                            <label for="customFile">Gambar</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="gambar_kategori" required accept=".jpg, .png"/>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Jenis Kategori</label>
                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="jenis_kategori" />
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