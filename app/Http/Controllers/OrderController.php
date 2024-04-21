<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\Datatables;

class OrderController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $orders = Order::join('clients', 'clients.id_client', '=', 'orders.id_client')
                            ->select('orders.id_order', 'orders.id_client', 'clients.client_name', 'orders.item_name', 'orders.item_price', 'orders.date_order')
                            ->get();

            return Datatables::of($orders)
                ->addIndexColumn()
                ->addColumn('row_number', function ($row) {
                    static $i = 1;
                    return $i++;
                })
                ->addColumn('action', function ($row) {
                    if (Auth::user()->id_role == 1 || Auth::user()->id_role == 2) {
                        $html = '<a href="'. route('order.editdata', ['order' => $row]) .'" class="btn btn-warning btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </a>';
                        $html .= '&nbsp;';
                        $html .= '<form action="'. route('order.hapusdata', ['order' => $row]) .'" method="post" class="d-inline" onsubmit="return confirm(\'Yakin akan menghapus data?\')">';
                        $html .= csrf_field();
                        $html .= method_field('DELETE');
                        $html .= '<button type="submit" class="btn btn-danger btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>';
                        $html .= '</form>';
                    } else {
                        $html = '';
                    }

                    return $html;
                })
                ->rawColumns(['row_number', 'action'])
                ->make(true);
        }

        return view('order.index');
    }

    public function tambahdata() {
        $clients = Client::all();

        return view('order.tambah', ['clients' => $clients]);
    }

    public function simpandata(Request $request) {
        $request->validate([
            'namaKlien' => 'required',
            'namaItem' => 'required',
            'hargaItem' => 'required',
        ]);

        $new_order = new Order();
        $new_order->id_client = $request->namaKlien;
        $new_order->item_name = $request->namaItem;
        $new_order->item_price = $request->hargaItem;
        $new_order->date_order = Carbon::now();
        $new_order->save();

        return redirect()->route('order.index');
    }

    public function editdata(Order $order) {
        $clients = Client::all();
        $order_client_name = Order::join('clients', 'clients.id_client', '=', 'orders.id_client')
                                ->select('clients.client_name')
                                ->first();

        return view('order.edit', ['order' => $order, 'clients' => $clients, 'order_client_name' => $order_client_name]);
    }

    public function updatedata(Order $order, Request $request) {
        $request->validate([
            'namaKlien' => 'required',
            'namaItem' => 'required',
            'hargaItem' => 'required',
        ]);

        $order->id_client = $request->namaKlien;
        $order->item_name = $request->namaItem;
        $order->item_price = $request->hargaItem;
        $order->save();

        return redirect()->route('order.index');
    }

    public function hapusdata(Order $order) {
        $order->delete();

        return redirect()->route('order.index');
    }

    public function downloadpdf() {
        $orders = Order::join('clients', 'clients.id_client', '=', 'orders.id_client')
                            ->select('orders.id_order', 'orders.id_client', 'clients.client_name', 'orders.item_name', 'orders.item_price', 'orders.date_order')
                            ->get();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('order.pdf', ['orders' => $orders]));
        $mpdf->Output('data-pesanan.pdf', 'D');
    }
}
