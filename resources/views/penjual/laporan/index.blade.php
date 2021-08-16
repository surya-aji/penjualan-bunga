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
                                       <th>Tanggal Pembelian</th>
                                       <th>Gambar Produk</th>
                                       <th>Kategori</th>
                                       <th>Nama Produk</th>
                                       <th>Stok</th>
                                       <th>Harga Jual</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <td>Lorem</td>
                                   <td>Lorem</td>
                                   <td>Lorem</td>
                                   <td>Lorem</td>
                                   <td>Lorem</td>
                                   <td>Lorem</td>
                                   <td>Lorem</td>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
               <!-- Modal to add new record -->
               <div class="modal modal-slide-in fade" id="modals-slide-in">
                   <div class="modal-dialog sidebar-sm">
                       <form class="add-new-record modal-content pt-0">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                           <div class="modal-header mb-1">
                               <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                           </div>
                           <div class="modal-body flex-grow-1">
                               <div class="form-group">
                                   <label class="form-label" for="basic-icon-default-fullname">Stok</label>
                                   <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
                               </div>
                               <div class="form-group">
                                   <label class="form-label" for="basic-icon-default-post">Gambar Produk</label>
                                   <input type="text" id="basic-icon-default-post" class="form-control dt-post" placeholder="Web Developer" aria-label="Web Developer" />
                               </div>
                               <div class="form-group">
                                   <label class="form-label" for="basic-icon-default-email">Kategori</label>
                                   <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                                   <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                               </div>
                               <div class="form-group">
                                   <label class="form-label" for="basic-icon-default-date">Tanggal Pembelian</label>
                                   <input type="text" class="form-control dt-date" id="basic-icon-default-date" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                               </div>
                               <div class="form-group mb-4">
                                   <label class="form-label" for="basic-icon-default-salary">Harga Jual</label>
                                   <input type="text" id="basic-icon-default-salary" class="form-control dt-salary" placeholder="$12000" aria-label="$12000" />
                               </div>
                               <div class="form-group mb-4">
                                 <label class="form-label" for="basic-icon-default-salary">Harga Beli</label>
                                 <input type="text" id="basic-icon-default-salary" class="form-control dt-salary" placeholder="$12000" aria-label="$12000" />
                             </div>
                               <button type="button" class="btn btn-primary data-submit mr-1">Submit</button>
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