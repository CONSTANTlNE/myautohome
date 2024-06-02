<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Car;
use App\Models\Company;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
//    public function sse()
//    {
//        $userId = Auth::id();
//        $notifications = Notification::where('user_id', $userId)
//            ->where('read', false)
//            ->get();
//
////        dd($notifications->isNotEmpty());
//        // Send SSE headers
//        header('Content-Type: text/event-stream');
//        header('Cache-Control: no-cache');
//        header('Connection: keep-alive');
//
//
//        if ($notifications->isNotEmpty()) {
//            echo "data: " . $notifications->toJson() . "\n\n";
//            // Flush the output buffer
//            ob_flush();
//            flush();
//
//            // Sleep for a short while to avoid CPU overload
//            sleep(2);
//        } else {
//            echo "data: \n\n";
//            // Flush the output buffer
//            ob_flush();
//            flush();
//
//            // Sleep for a short while to avoid CPU overload
//            sleep(2);
//        }
//
//
//    }

    public function sse(Request $request)
    {
        // Set SSE headers
        return response()->stream(function () {
            $userId = Auth::id();

                $notifications = Notification::where('user_id', $userId)
                    ->where('read', false)
                    ->get();

                if ($notifications->isNotEmpty()) {
                    // Send notifications as SSE
                    echo "data: " . json_encode($notifications) . "\n\n";
                } else {
                    // Send an empty event to keep the connection alive
                    echo "data: \n\n";
                }

                // Flush the output buffer
                ob_flush();
                flush();

                // Sleep for a while to avoid CPU overload
                sleep(2);
//
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'Connection' => 'keep-alive',
        ]);
    }

    public function showheader(){

        $notifications = Notification::with('application.user')
        ->where('user_id', auth()->id())
            ->where('read', false)
            ->get();


        return view('htmx.htmxnotifications',compact('notifications'));
    }

    public function markAsRead(Request $request)
    {



        $notifications = Notification::where('user_id', auth()->id())->where('read', false)->get();

        foreach($notifications as $notification){
            $notification->read = true;
            $notification->save();
        }


          $authuser = auth()->user();
        $applications = Application::with([
            'client:id,name,mobile1,pid',
            'source:id,name',
            'status',
            'product:id,name',
//        'car:id,make',
            'comments.user:id,name',
            'user:id,name',

        ])->orderBy('created_at', 'desc')
            ->latest()
            ->limit(300)
            ->get();


//    return view('htmx.htmx' ,compact('companies','statuses','products','sources','applications','cars'));
        return view('htmx.htmx', compact('applications', 'authuser'));



    }
}
