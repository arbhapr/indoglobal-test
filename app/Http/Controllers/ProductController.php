<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name')->get();

        $data = [
            'products' => $products,
        ];
        return view('product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MCategory::orderBy('name')->get();
        $data = [
            'categories' => $categories,
        ];

        return view('product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'category_id' => ['required', 'exists:m_categories,id'],
                    'name'        => ['required'],
                    'qty'         => ['required', 'min:0'],
                    'price'       => ['required', 'min:0'],
                ],
                [
                    'qty.required' => 'The stock field is required.'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('errorForm', $validator->errors()->getMessages())
                    ->withInput();
            }
            $params = $validator->validate();

            $data = Product::create($params);

            DB::commit();
            return redirect()
                ->route('manage.product.index')
                ->with('success', 'Created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $categories = MCategory::orderBy('name')->get();
            $product = Product::findOrFail($id);

            $data = [
                'id' => $id,
                'item' => $product,
                'categories' => $categories,
            ];
            return view('product.edit', $data);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
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
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'category_id' => ['required', 'exists:m_categories,id'],
                    'name'        => ['required'],
                    'qty'         => ['required', 'min:0'],
                    'price'       => ['required', 'min:0'],
                ],
                [
                    'qty.required' => 'The stock field is required.'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('errorForm', $validator->errors()->getMessages())
                    ->withInput();
            }
            $params = $validator->validate();

            $data = Product::find($id)->update($params);

            DB::commit();
            return redirect()
                ->route('manage.product.index')
                ->with('success', 'Updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = Product::find($id)->delete();

            DB::commit();
            return redirect()
                ->route('manage.product.index')
                ->with('success', 'Updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }
}
