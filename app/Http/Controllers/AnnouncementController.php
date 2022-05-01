<?php

namespace App\Http\Controllers;

use App\Models\announcement;
use App\Models\da_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index(){
        $announcements = announcement::select('announcements.*', 'locations.area')
            ->leftJoin('locations','locations.id','=','announcements.location_id')
            ->get();
        return view('admin_updates',[
            'announcements'=>$announcements
        ]);
    }

    public function store(Request $request){
        try {
            $announcement = new announcement();
            $announcement->user_id = Auth::user()->id;
            if(auth()->user()->hasRole('da')){
                $da_loc = da_info::where('da_id', Auth::id())->firstOrFail();
                $announcement->location_id = $da_loc->location_id;
            }
            $announcement->announcement = $request->announcement;
            $announcement->save();

            notify()->success('Announcement successfully added');
            return back();
        }catch (\Exception $e){
            notify()->error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }

    }

    public function seller_updates(Request $request){
        $announcements = announcement::select('announcements.*', 'locations.area')
            ->leftJoin('locations','locations.id','=','announcements.location_id')
            ->where('announcements.location_id', Auth::user()->location_id)
            ->whereNull('announcements.location_id')
            ->get();

        if($request->wantsJson()){
            return response()->json(['status' => 'success', 'announcements' => $announcements]);
        }

        return view('updates',[
            'announcements'=>$announcements
        ]);
    }
}
