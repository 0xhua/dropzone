<?php

namespace App\Http\Controllers;

use App\Helpers\SmsApiHelper;
use App\Models\da_info;
use App\Models\Item;
use App\Models\itemRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $data = User::select(
            'users.*',
            'da_infos.da_id',
            'da_infos.location_id',
            'locations.code'

        )
            ->leftJoin('da_infos', 'users.id', '=', 'da_infos.da_id')
            ->leftJoin('locations', 'da_infos.location_id', '=', 'locations.id')
            ->orderBy('users.name', 'asc')->paginate(5);
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'location_id' => 'required',
            'contact_no' => 'required',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Item::where('seller_id',$request->id)->delete();
        itemRequest::where('seller_id',$request->id)->delete();
        User::where('seller_id',$request->id)->delete();
        User::find($request->id)->delete();
        notify()->success('User successfully deleted');
        return back();
    }

    public function register_da(Request $request)
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

            $user = User::create($input);
            $da_info = new da_info();
            $da_info->location_id = $request->location_id;
            $da_info->da_id = $user->id;
            $da_info->save();
            $user->assignRole([4]);

            notify()->success('User successfully registered');
            return back();

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }

    }

    public function register_seller(Request $request)
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

            $user = User::create($input);
            $user->status_id = $request->status_id;
            $user->save();

            $token = $user->createToken('Laravel8PassportAuth')->accessToken;

            if ($request->wantsJson()) {
                return response()->json(['status' => 'success', 'message' => 'Item created successfully', 'token' => $token]);
            }

            notify()->success('User successfully registered');
            return back();

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }

    }

    public function register_buyer(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'phone_number' => ['required', 'regex:/(09)|(9)[0-9]{9}/'],
                'location_id' => 'required',
            ]);

            $seller = auth()->user();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->location_id = $request->location_id;
            $user->seller_id = $seller->id;
            $user->phone_number = $request->phone_number;

            $user->save();



            if ($request->wantsJson()) {
                DB::table('model_has_roles')->insert(
                    array('role_id' => '3',
                        'model_type' => 'App\Models\User',
                        'model_id' => $user->id,)
                );
                return response()->json(['status' => 'success', 'message' => 'Buyer successfully added']);
            }else{
                $user->assignRole([3]);
            }

            notify()->success('Buyer successfully registered');
            return back();

        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function userList(Request $request)
    {
        if (auth()->user()->hasRole(['Admin', 'seller'])) {

            $locations = \App\Models\Location::all();
            $data = User::select(
                'users.*',
                'locations.area',
                'ul.area as ucode'

            )
                ->leftJoin('da_infos', 'users.id', '=', 'da_infos.da_id')
                ->leftJoin('locations', 'users.location_id', '=', 'locations.id')
                ->leftJoin('locations as ul', 'users.location_id', 'ul.id')
                ->leftJoin('model_has_roles as role', 'users.id', 'role.model_id');
            if (auth()->user()->hasRole('seller')) {
                $data = $data->where('seller_id', auth()->id());
            }

            if(!is_null($request->search)){
                $data = $data->where('users.name', 'like', '%' . $request->search . '%');
            }

            $show_da = false;
            if(!is_null($request->da)) {
                $data = $data->whereHas('roles', function ($q) {
                    $q->whereName('da');
                });
                $show_da = true;
            }

            $show_seller = false;
            if(!is_null($request->seller)) {
                $data = $data->whereHas('roles', function ($q) {
                    $q->whereName('seller');
                });
                $show_seller = true;
            }

            $show_buyer = false;
            if(!is_null($request->buyer)) {
                $data = $data->whereHas('roles', function ($q) {
                    $q->whereName('buyer');
                });
                $show_seller = true;
            }



            if ($request->wantsJson()) {
                return response()->json(['location' => $locations, 'data' => $data->get()]);
            }


            $data = $data->orderBy('users.name', 'asc')->paginate(20);
            return view('userlist', compact(['data', 'locations','show_buyer','show_seller','show_da']))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        } else {
            return abort(403);
        }
    }

    //USER update = email contact no
    public function update_user(Request $request)
    {
        try {
            $user = User::query()->findOrFail($request->id);
            $user->email = $request->input('email', $user->email);
            $user->phone_number = $request->input('phone_no', $user->phone_number);

            if ($user->save()) {
                notify()->success('Buyer successfully updated');
                return back();
//                return response()->json(['status' => 'success', 'message' => 'User details updated successfully']);
            }

        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
//            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update_settings(Request $request)
    {
        try {
            $user = User::query()->findOrFail(auth()->id());
            $user->name = $request->input('name', $user->name);
            $user->email = $request->input('email', $user->email);
            $user->phone_number = $request->input('phone_no', $user->phone_no);
//            $user->password = Hash::make($request->input('password', $user->password));
            $user->password = ($request->filled('password') ? Hash::make($request->input('password')) : $user->password);

            if ($user->save()) {
                if ($request->wantsJson()) {
                    return response()->json(['status' => 'success', 'message' => 'User details updated successfully']);
                }
                notify()->success('User successfully updated');
                return back();
//                return response()->json(['status' => 'success', 'message' => 'User details updated successfully']);
            }

        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
            }
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
//            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function da_sellers()
    {
        $locations = \App\Models\Location::all();
        $da_loc = Auth::user();
        $da_sellers = User::select('users.*', 'locations.area', 'user_statuses.status')
            ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
            ->leftJoin('user_statuses', 'user_statuses.id', '=', 'users.status_id')
            ->where('locations.id', $da_loc->location_id)
            ->whereHas(
                'roles', function ($q) {
                $q->where('name', 'seller');
            })
            ->get();
        return view('da_sellers', [
            'da_sellers' => $da_sellers,
            'locations' => $locations,
            'da_loc' => $da_loc->location_id
        ]);
    }

    public function updateSellerStatus(Request $request)
    {
        try {
            $this->validate($request, [
                'id' => 'required',
                'status' => 'required',
            ]);

            $message = '';

            $user = User::query()->findOrFail($request->id);
            switch ($request->status) {
                case 1://set status to in approved
                    $user->status_id = 2;
                    $user->assignRole([2]);
                    $sms_message = "Congratulations ".$user->name.", You dropzone seller account is now activated";
                    $message = 'User successfully activated';
                    break;
                case 2://set status to in approved
                    $user->status_id = 1;
                    $sms_message = "Your dropzone registration has been rejected by the DA";
                    $message = 'User successfully deactivated';
                    break;
            }
            if ($user->save()) {
                if(!empty($sms_message)){
                    app(SmsApiHelper::class)->send_sms($user->phone_number,$sms_message);
                }
                notify()->success($message);
                return back();
            }
        } catch (\Exception $e) {
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }
}
