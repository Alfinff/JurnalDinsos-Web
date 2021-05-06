<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Date;

class NotifikasiController extends Controller
{
    public function MarkAsRead(Request $request) {
        $notificationid = $request->notificationid;
        $url = $request->url;
        $notification = auth()->user()->notifications()->find($notificationid);
        if($notification) {
            if($notification->markAsRead()) {
                return redirect($url)->with(array(
                    'message'    => 'Notifikasi Telah Dibaca',
                    'alert-type' => 'success'
                ));
            } else {
                DatabaseNotification::where('id', $notificationid)->update([
        			'read_at' => Date::now(),
        		]);
                return redirect($url)->with(array(
                    'message'    => 'Notifikasi Telah Dibaca',
                    'alert-type' => 'success'
                ));
            }
        } else {
            return redirect()->back()->with(array(
                'message'    => 'Gagal Membaca Notifikasi',
                'alert-type' => 'error'
            ));
        }
    }
}
