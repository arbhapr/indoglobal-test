<?php

namespace App\Http\Controllers;

use App\Models\MCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = MCategory::orderBy('name')->get();

        $data = [
            'categories' => $categories,
        ];
        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            // 
        ];
        return view('category.create', $data);
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
            $validator = Validator::make($request->all(), [
                'name'    => ['required', 'unique:m_categories,name'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('errorForm', $validator->errors()->getMessages())
                    ->withInput();
            }
            $params = $validator->validate();

            $data = MCategory::create($params);

            DB::commit();
            return redirect()
                ->route('manage.category.index')
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $category = MCategory::findOrFail($id);
    
            $data = [
                'id' => $id,
                'category' => $category,
                'products' => $category->products,
            ];
            return view('category.show', $data);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
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
            $user = MCategory::findOrFail($id);
    
            $data = [
                'id' => $id,
                'item' => $user,
            ];
            return view('category.edit', $data);
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
            $validator = Validator::make($request->all(), [
                'name'    => ['required', 'unique:m_categories,name,'.$id],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('errorForm', $validator->errors()->getMessages())
                    ->withInput();
            }
            $params = $validator->validate();

            $data = MCategory::find($id)->update($params);

            DB::commit();
            return redirect()
                ->route('manage.category.index')
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
            MCategory::find($id)->products()->delete();
            $data = MCategory::find($id)->delete();

            DB::commit();
            return redirect()
                ->route('manage.category.index')
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
