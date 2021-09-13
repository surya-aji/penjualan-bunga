<?php

namespace App\Http\Controllers\Seller\order;

use App\DataProduk;
use App\Http\Controllers\Controller;
use App\Order;
use App\Pesanan;
use App\PesananDetail;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public $snapToken;
    public function index()
    {
        $pesanan = Pesanan::all();
        $getdataPesan = Pesanan::where('status',1)->first();
        $detail_pesanan = PesananDetail::where('pesanan_id',$getdataPesan->id)->get();
        
        return view('penjual.order.index',compact('pesanan', 'detail_pesanan'));
    }

    public function detail($id)
    {
        // midtrans
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'Mid-server-4apdLLraTf_v44fK9GBNptEK';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = true;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;  
        
        $pesanan = Pesanan::where('status',1)->where('id',$id)->get();
        $detail_produk = PesananDetail::where('barang_id', 2)->get();
        $barang[''] = DataProduk::find($id);
        
        $getdataPesan = Pesanan::where('status',1)->where('id',$id)->first();
        $detail_pesanan = PesananDetail::where('pesanan_id',$getdataPesan->id)->get();
        
        $this->user_detail = UserDetail::find(Auth::user()->id);
        $ud = $this->user_detail;
        
        if (!empty($getdataPesan)) {
            if ($getdataPesan->status_pembayaran == 0) {
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $getdataPesan->resi,
                        'gross_amount' => $getdataPesan->total_pembayaran + $getdataPesan->ongkos_kirim,
                    ),
                    'customer_details' => array(
                        'first_name' => '[Saudara/Saudari]',
                        'last_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'phone' => $this->user_detail->no_telp,
                    ),
                );
                $this->snapToken = \Midtrans\Snap::getSnapToken($params);
                $st = $this->snapToken;
                $status = 0;
                
            }elseif($getdataPesan->status_pembayaran == 1){
                $st = $this->snapToken;
                $status = \Midtrans\Transaction::status($getdataPesan->resi);
                $status = json_decode(json_encode($status), true);
                // dd($status);
                if($status['transaction_status'] == 'settlement'){
                    $this->gross_amount = $status['gross_amount'];
                    $this->transaction_status = $status['transaction_status'];
                    $transaction_time = $status['transaction_time'];
                    $this->dead_line = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));
                    
                }else{
                    $this->gross_amount = $status['gross_amount'];
                    $this->transaction_status = $status['transaction_status'];
                    $transaction_time = $status['transaction_time'];
                    $this->dead_line = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($transaction_time)));
                }
            }
            // dd($status);
        }
        return view('penjual.order.detail', compact('detail_produk', 'pesanan','barang', 'status', 'getdataPesan', 'ud', 'st'));
    }
    
    public function update(Request $request, $id)
    {
        $update = Pesanan::findorfail($id);
        $update->status_pembayaran = $request->status_pembayaran;
        $update->update();
        return redirect('/seller/penjualan');
    }

    public function FunctionName()
    {
        $getdataPesan = Pesanan::where('user_id',Auth::user()->id)->get();
        $status = \Midtrans\Transaction::status($getdataPesan->resi);
        $status = json_decode(json_encode($status), true);
        $order = new Order();
        $order->user_id = $getdataPesan->user_id;
        $order->tanggal = $getdataPesan->tanggal;
        $order->status = $getdataPesan->status;
        $order->ongkos_kirim = $getdataPesan->ongkos_kirim;
        $order->alamat_lengkap = $getdataPesan->alamat_lengkap;
        $order->resi = $getdataPesan->resi;
        $order->kurir = $getdataPesan->kurir;
        $order->layanan = $getdataPesan->layanan;
        $order->va_numbers = $status['va_numbers'][0]['va_number'];
        $order->bank = $status['va_numbers'][0]['bank'];
        $order->transaction_time = $status['transaction_time'];
        $order->gross_amount = $status['gross_amount'];
        $order->order_id = $status['order_id'];
        $order->payment_type = $status['payment_type'];
        $order->status_code = $status['status_code'];
        $order->transaction_status = $status['transaction_status'];
        $order->save();
    }
}
