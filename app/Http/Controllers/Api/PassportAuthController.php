<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Item;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PassportAuthController extends Controller
{
    /**
     * Registration Req
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('Laravel8PassportAuth')->accessToken;

        return response()->json(['token' => $token], 200);
    }


    public function register_seller(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'location_id' => 'required',
                'phone_number' => ['required', 'regex:/(09)|(9)[0-9]{9}/'],
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            User::create($input);

            return response()->json(['status' => 'success', 'message' => 'User Registered successfully']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }

    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $role = null;
            $token = auth()->user()->createToken('Laravel8PassportAuth')->accessToken;
            if (auth()->user()->hasRole('seller')) {
                $role = 'seller';
            }elseif (auth()->user()->hasRole(['Admin','da'])){
                $role = 'non-seller';
            }
            return response()->json(
                [
                    'success' => true,
                    'token' => $token,
                    'role' => $role
                ], 200
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'error' => 'The provided credentials do not match our records.'
                ], 401);
        }
    }

    public function userInfo()
    {

        $user = auth()->user();

        return response()->json(['user' => $user], 200);

    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function scanQr(Request $request)
    {
        try {
            $item = Item::query();
            $item = $item
                ->select(
                    'items.id',
                    'items.code',
                    'items.date as drop_date',
                    'items.origin_id',
                    'buyer.name as buyer',
                    'seller.name as seller',
                    'o.area as origin',
                    'd.area as destination',
                    'items.fee', 'items.amount',
                    'paid_statuses.status as payment_status',
                    'item_statuses.status as status',
                    'approval_statuses.status as approval_status',
                    'items.approval_status_id',
                    'items.payment_status_id',
                    'items.claimed_date',
                    'items.status_id',
                    'items.df',
                    'items.tf'
                )
                ->leftJoin('approval_statuses', 'items.approval_status_id', '=', 'approval_statuses.id')
                ->leftJoin('paid_statuses', 'items.payment_status_id', '=', 'paid_statuses.id')
                ->leftJoin('item_statuses', 'items.status_id', '=', 'item_statuses.id')
                ->leftJoin('locations as o', 'items.destination_id', '=', 'o.id')
                ->leftJoin('locations as d', 'd.id', '=', 'items.origin_id')
                ->leftJoin('users as buyer', 'items.buyer_id', '=', 'buyer.id')
                ->leftJoin('users as seller', 'items.seller_id', '=', 'seller.id')
                ->where('items.code', '=', $request->code)
                ->first();
            return response()->json(['item' => $item]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }

    }
}
