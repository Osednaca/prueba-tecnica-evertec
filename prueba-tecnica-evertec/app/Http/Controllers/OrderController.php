<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Dnetix\Redirection\PlacetoPay;
use App\Models\Order;
use Redirect;
use DateTime;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    //
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_document_type' => 'required',
            'customer_document' => 'required',
            'customer_email' => 'required|email',
            'customer_mobile' => 'required',
        ]);
        
        $reference   = time() . rand(1000,9999);;

        $status      = "CREATED";

        $price       = 50000.00;

        $description = "Producto de prueba Referencia $reference";

        $Order = Order::create(array_merge($request->all(), ['status' => $status,'reference' => $reference,'price' => $price,'description'=>$description]));

        return view('orders.summary')
            ->with('success', 'Order created successfully.')->with('order',$Order);
    } 
    
    public function pay(Request $request){
        $order_id = $request->order_id;

        $Order = DB::table('orders')
        ->select('orders.*')
        ->where('id',$order_id)
        ->get();

        $placetopay = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
            'rest' => [
                'timeout' => 45, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ]);
    
        $params = [
            "locale" => "es_CO",
            "buyer" => [
                "name" => $Order[0]->customer_name,
                "surname" => $Order[0]->customer_last_name,
                "email" => $Order[0]->customer_email,
                "documentType" => $Order[0]->customer_document_type,
                "document" => $Order[0]->customer_document,
                "mobile" => $Order[0]->customer_mobile
            ],
            "payment" => [
                    "reference" => $Order[0]->reference,
                    "description" => $Order[0]->description,
                    "amount" => [
                        "currency" => "COP",
                        "total" => $Order[0]->price
                    ],
                  "allowPartial" => false
            ],
                "expiration" => date('c', strtotime('+5 mins')),
                "returnUrl" => "http://127.0.0.1:8000/order/".$Order[0]->id,
                "ipAddress" => "127.0.0.1",
                "userAgent" => "PlacetoPay Sandbox"
        ];


        $response = $placetopay->request($params);
        if ($response->isSuccessful()) {
            $id_p2p = $response->requestId();
            $affected = DB::table('orders')
            ->where('id', $order_id)
            ->update(['id_p2p' => $id_p2p]);
            // Redirect the client to the processUrl or display it on the JS extension
            return Redirect::to($response->processUrl());
        } else {
            // There was some error so check the message and log it
            var_dump($response->status()->message());
            die;
        }
    }

    public function order(Request $request){
        $order_id = $request->id;

        $Order = DB::table('orders')
        ->select('orders.*')
        ->where('id',$order_id)
        ->get();

        $placetopay = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
            'rest' => [
                'timeout' => 45, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ]);

        $response = $placetopay->query($Order[0]->id_p2p);

        if ($response->isSuccessful()) {
            $status = $response->status()->status();

            // STORE THE status on the DB
            $affected = DB::table('orders')
            ->where('id', $order_id)
            ->update(['status' => $status]);

            return view('orders.status')
            ->with('status',$status)->with('order',$Order[0]);
        } else {
            // There was some error with the connection so check the message
            print_r($response->status()->message() . "\n");
        }
    }
}