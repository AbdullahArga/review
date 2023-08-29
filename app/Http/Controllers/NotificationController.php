<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(Request $request){

        $notifications=auth()->user()->notifications()->latest()->paginate(25);

        return NotificationResource::collection($notifications);
    }
    public function markAsRead(Request $request,$id){

        $notifications=auth()->user()->unreadNotifications()->where('id','=',$id)->update(['read_at' => now()]);

        return response()->json([
            'statue'=>'true',
        ],200);
    }
    public function delete(Request $request,$id){

        $notifications=auth()->user()->notifications()->where('id','=',$id)->delete();

        return response()->json([
            'statue'=>'true',
        ],200);
    }
}
