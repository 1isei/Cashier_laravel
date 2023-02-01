<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::doesntHave('cart')->where('stock', '>', 0)->get()->sortBy('name');
        $itemsInCart = Item::has('cart')->get()->sortByDesc('create_at');

        return view('main\transaction\transaction', [
            'items' => $items,
            'itemsInCart' => $itemsInCart
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'amount_paid' => 'required',
        ],[
            'amount_paid.required' => 'Masukkan Nominal'
        ]);

        Transaction::create($request->all());

        foreach(Cart::all() as $itemInCart){
            TransactionDetail::create([
                'transaction_id' => Transaction::latest()->first()->id,
                'item_id' => $itemInCart->item_id,
                'quantity' => $itemInCart->qty,
                'subtotal' => $itemInCart->item->price * $itemInCart->qty
            ]);
        }

        Cart::truncate();

        return redirect(route('transaction.show', Transaction::latest()->first()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::create($request->all());
        return redirect()->back()->with('status', 'Item added to cart.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $itemDetail = transaction::findOrFail($id);
        return view('main\transaction\transaction_detail', compact('itemDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        Cart::findOrFail($id)->update([
            'qty' => request('qty')
        ]);
        
        return redirect()->back()->with('status', 'Item updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->back()->with('status', 'Item removed from cart.');
    }

    public function history()
    {
        $histories = Transaction::all()->sortByDesc('create_at');
        return view('main\transaction\transaction_history', compact('histories'));
    }
}