<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::get();

        $data = [
            'carts' => $carts,
        ];
        return view('cart.index', $data);
    }
    
    public function confirmToCart($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::where('qty', '>', 0)->findOrFail($id);

            $data = [
                'id' => $id,
                'product' => $product,
            ];
            return view('cart.confirm', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function addToCart(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'qty'         => ['required', 'min:0', 'max:' . $product->qty],
                'total_price' => ['required', 'numeric']
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('errorForm', $validator->errors()->getMessages())
                    ->withInput();
            }
            $params = $validator->validate();
            $params['product_id'] = $id;
            $params['user_id'] = Auth::user()->id;

            $data = Cart::create($params);

            $product->update([
                'qty' => $product->qty - $params['qty'],
            ]);

            DB::commit();
            return redirect()
                ->route('manage.product.index')
                ->with('success', 'Stored to cart successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }
}
