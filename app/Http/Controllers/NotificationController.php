<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;
class NotificationController extends Controller
{
  public function __construct(){
    \Carbon\Carbon::setLocale('es');
  }
  
  public function get(){
    if( Auth::check() ){
      //return Notification::all();
      $unreadNotifications = Auth::user()->unreadNotifications;
      $fechaActual = date('Y-m-d');
      foreach ($unreadNotifications as $notification) {
        if($fechaActual != $notification->created_at->toDateString()){
          $notification->markAsRead(); 
        }
      }
      
      $notifications = Auth::user()->unreadNotifications;
      $notifications = $notifications->map(function($n){
        $n['time_ago'] = $n->created_at->diffForHumans();
        return $n;
      });
      
      return $notifications;
    }
    
    return [];
  }
  
  public function markAsRead(Request $request){
    Auth::user()->notifications()->whereId($request->id)->get()->markAsRead();
    return true;
  }
}
