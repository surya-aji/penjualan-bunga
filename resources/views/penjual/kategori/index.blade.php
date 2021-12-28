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
                            <table id="ktgTB" class="">
                                <thead>
                                    <tr>
                                        <th>Jenis Kategori</th>
                                        <th>Gambar</th>
                                        <th>Gambar</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                              
                                <tbody>
                                    @foreach ($kategori as $item)
                                    <tr>
                                            <td>{{$item->jenis_kategori}}</td>
                                            <td><img src="{{asset('gambar-kategori/'. $item->gambar )}}" alt="no image" style="width:100px;" class="rounded-circle"></td>
                                            <td> 
                                              <form style="display: inline;" action="{{ route('kategori.destroy', $item->id) }}" method="post" onsubmit="return confirm('Yakin hapus data ?')" >
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger btn-icon">
                                                  <i data-feather="trash"></i>
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
                                                <input type="file" class="custom-file-input" id="customFile" name="gambar_kategori" required accept=".jpg, .png" required/>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Jenis Kategori</label>
                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="jenis_kategori" required />
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