<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        $data = [
            'user' => $user
        ];
        return view('my_profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();

            $validator = Validator::make($request->all(), [
                'name'        => ['required'],
                'address'     => ['nullable'],
                'subdistrict' => ['nullable'],
                'district'    => ['nullable'],
                'city'        => ['nullable'],
                'province'    => ['nullable'],
                'postal_code' => ['nullable'],
                'password'    => ['nullable', 'confirmed'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->with('errorForm', $validator->errors()->getMessages())
                    ->withInput();
            }
            $params = $validator->validate();

            if (!is_null($params['password'])) {
                $params['password'] = bcrypt($params['password']);
            } else {
                unset($params['password']);
            }
            
            $user->update($params);
            $data = Auth::user()->profile()->update($params);

            DB::commit();
            return redirect()
                ->route('my-profile.edit')
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
