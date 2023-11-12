<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const MODEL_SHORTCUT = 'orders';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->book_id = $request->book_id;
        $order->save();

        return redirect()->back();
    }

    /**
     * Display a listing of the resource in dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboardIndex(Request $request)
    {
        // used while generating route names
        $modelShortcut = self::MODEL_SHORTCUT;

        // for search & counting on index pages
        $allItems = Order::select('id')->get();

        // Default parameters for ordering
        $orderBy = $request->orderBy ? $request->orderBy : 'created_at';
        $orderType = $request->orderType ? $request->orderType : 'desc';
        $activePage = $request->page ? $request->page : 1;

        $items = Order::orderBy($orderBy, $orderType)
                ->paginate(30, ['*'], 'page', $activePage)
                ->appends($request->except('page'));

        return view('dashboard.orders.index', compact('modelShortcut', 'allItems', 'items', 'orderBy', 'orderType', 'activePage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // used while generating route names
        $modelShortcut = self::MODEL_SHORTCUT;

        $item = Order::find($id);
        $item->new = false;
        $item->save();

        return view('dashboard.orders.edit', compact('modelShortcut', 'item'));
    }

    /**
     * Request for deleting items by id may come in integer type (single item destroy form) 
     * or in array type (multiple item destroy form)
     * That`s why we need to get them in array type and delete them by loop
     *
     * Checkout Model Boot methods deleting function 
     * Models relations also deleted on deleting function of Models Boot method
     * 
     * @param  int/array  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = (array) $request->id;

        foreach ($ids as $id) {
            Order::find($id)->delete();
        }

        return redirect()->route('orders.dashboard.index');
    }
}
