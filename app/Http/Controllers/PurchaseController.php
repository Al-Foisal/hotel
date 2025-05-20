<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Stock;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = [];
        $search = $request->input('q');
        $data['purchases'] = Purchase::withCount('itemDetails')
            ->orWhereAny([
                'invoice_number',
            ], 'like', '%' . $search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('quick-purchase.index', $data);
    }

    public function create(Request $request)
    {
        $data = [];
        $data['suppliers'] = Supplier::all();
        $data['products'] = Product::all();
        return view('quick-purchase.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'invoice_date' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $invoice = new Purchase();

            if ($request->hasFile('invoice_image')) {
                $image_file = $request->file('invoice_image');

                if ($image_file) {
                    $img_gen   = hexdec(uniqid());
                    $image_url = 'images/p_invoice/';
                    $image_ext = strtolower($image_file->getClientOriginalExtension());

                    $img_name      = $img_gen . '.' . $image_ext;
                    $invoice_image = $image_url . $img_gen . '.' . $image_ext;

                    $image_file->move($image_url, $img_name);
                }
            }


            $invoice->supplier_id        = $request->supplier_id;
            $invoice->invoice_date      = $request->invoice_date;
            $invoice->invoice_number    = $request->invoice_number;
            $invoice->invoice_image     = $invoice_image ?? '';
            $invoice->note              = $request->note;
            $invoice->discount          = $request->total_discount;
            $invoice->discount_type     = isset($request->total_discount_type) && $request->total_discount_type == 'on' ? 1 : null;
            $invoice->total             = $request->total_amount;
            $invoice->subtotal       = $request->grand_total;
            $invoice->due               = $request->grand_total;
            $invoice->created_by        = auth()->user()->id;
            $invoice->save();

            foreach ($request->product_id as $key => $product) {

                if ($product != null) {
                    $details = new PurchaseDetails();

                    $details->purchase_id = $invoice->id;
                    $details->product_id          = $product;
                    $details->buying_price        = $request->buying_price[$key];
                    $details->quantity            = $request->quantity[$key];
                    $details->discount            = $request->discount[$key];
                    $details->vat                 = $request->vat[$key];
                    $details->expired_date        = $request->expired_date[$key];
                    $details->total_price         = $request->total_price[$key];
                    $details->save();
                }
            }

            foreach ($request->product_id as $key => $product) {

                if ($request->expired_date[$key]) {
                    $stock = Stock::where('product_id', $product)
                        ->where('supplier_id', $invoice->supplier_id)
                        ->whereDate('expired_date', $request->expired_date[$key])
                        ->first();

                    if ($stock) {
                        $stock->quantity     = $stock->quantity + $request->quantity[$key]  ?? 0;
                        $stock->save();
                    } else {

                        $new_stock                      = new Stock();
                        $new_stock->product_id          = $product;
                        $new_stock->quantity            = $request->quantity[$key] ?? 0;
                        $new_stock->supplier_id          = $invoice->supplier_id;
                        $new_stock->expired_date        = $request->expired_date[$key];
                        $new_stock->save();
                    }
                }
            }

            DB::commit();

            return back()->withSuccess('Purchase created successfully');
        } catch (Exception $th) {
            DB::rollBack();

            return back()->withSuccess($th->getMessage());
        }
    }
}
