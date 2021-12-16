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
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Alamat</th>
                                        <th>No Hp</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supp as $i=>$item)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->alamat}}</td>
                                        <td>{{$item->no_hp}}</td>
                                        <td>
                                          <form style="display: inline;" action="{{ route('data-supplier.destroy', $item->id) }}" method="post" onsubmit="return confirm('Yakin hapus data ?')" >
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-icon">
                                              <i data-feather="trash">a</i>
                                            </button>
                                          </form></td>
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
                        <form class="add-new-record modal-content pt-0" action="{{route('data-supplier.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Supplier</h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Nama Lengkap</label>
                                    <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="nama_supp" placeholder="Masukan Nama" aria-label="John Doe" />
                                </div>
                                      <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Alamat</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat_supp" rows="3" placeholder="Masukan Alamat Lengkap"></textarea>
                                      </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-email">No Hp</label>
                                    <input type="number" id="basic-icon-default-email" class="form-control dt-email" name="nohp_supp" placeholder="Nomor HP Aktif" />
                                </div>
                                <button type="submit" class="btn btn-primary data-submit mr-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <!--/ Basic table -->

        </div>
    </div>
</div>
@endsection