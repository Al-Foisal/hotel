<?php

namespace App\Http\Controllers;

use App\Models\ResturantBilling;
use App\Models\ResturantMenuItemCategory;
use App\Models\ResturantTableSetup;
use App\Models\RoomOrApartmet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResturantBillingController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $search = $request->input('q');
        $data['billings'] = ResturantBilling::with('itemDetails')
            ->orWhereAny([
                'invoice_number',
                'customer_name',
                'customer_phone',
            ], 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        return view('resturant.billing.index', $data);
    }

    public function create()
    {
        $data = [];
        $data['tables'] = ResturantTableSetup::where('status', 'Available')->get();
        $data['rooms'] = RoomOrApartmet::get();
        return view('resturant.billing.create', $data);
    }

    public function store(Request $request)
    {
        $latest_bill = DB::table('resturant_billings')->orderBy('id', 'desc')->first();

        if (isset($latest_bill)) {
            $invoice_number = date("y") . str_pad((int) $latest_bill->invoice + 1, 5, "0", STR_PAD_LEFT);
            $invoice        = 1 + $latest_bill->invoice;
        } else {
            $invoice_number = date("y") . str_pad((int) 1, 5, "0", STR_PAD_LEFT);
            $invoice        = 1;
        }

        $billing = ResturantBilling::create([
            'invoice_number' => $invoice_number,
            'invoice' => $invoice,
            'customer_id' => $request->customer_id,
            'table_id' => $request->table_id,
            'room_or_apartment_id' => $request->room_or_apartment_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'total' => $request->totalAmount,
            'discount_type' => $request->discountType,
            'discount_amount' => $request->discountValue,
            'subtotal' => $request->subTotal,
            'paid_amount' => $request->paidAmount,
            'created_by' => auth()->user()->id,
        ]);

        foreach ($request->cart as $item) {
            $billing->itemDetails()->create([
                'resturant_billing_id' => $item['itemId'],
                'menu_item_id' => $item['itemId'],
                'menu_item_name' => $item['itemName'],
                'menu_item_quantity' => $item['itemQuantity'],
                'menu_item_price' => $item['itemUnitPrice'],
                'menu_item_total' => $item['itemTotalPrice'],
            ]);
        }

        $data = ResturantBilling::with(
            'itemDetails',
            'createdBy',
        )
            ->where('id', $billing->id)
            ->first();
        return $data;
    }

    public function show($id)
    {
        return view('resturant.billing.show', compact('id'));
    }

    /*
        * @param Request $request
        * @return \Illuminate\Http\JsonResponse
        */
    public function getMenuItem(Request $request)
    {
        $search = $request->input('search');

        $categories = ResturantMenuItemCategory::orWhereAny([
            'name'
        ], 'like', '%' . $search . '%')
            ->whereHas(
                'menuItems',
                function ($query) use ($search) {
                    $query->where('status', 'active');
                    if ($search) {
                        $query->whereAny([
                            'name'
                        ], 'like', '%' . $search . '%');
                    }
                }
            )->get();
        // dd($categories);    
        return view('resturant.billing.menu_items', compact('categories'));
    }
}
