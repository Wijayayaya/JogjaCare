<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{
    public $module_title;
    public $module_name;
    public $module_path;
    public $module_icon;
    public $module_model;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Notifications';

        // module name
        $this->module_name = 'notifications';

        // directory path of the module
        $this->module_path = 'notifications';

        // module icon
        $this->module_icon = 'fas fa-bell';

        // module model name, path
        $this->module_model = "App\Models\User";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_action = 'List';

        $notifications = Auth::user()->notifications()->paginate();
        // $notifications = DatabaseNotification::paginate();
        // $unread_notifications_count = Auth::user()->unreadNotifications()->count();
        $unread_notifications_count = DatabaseNotification::whereNull('read_at')->count();

        return view(
            "backend.$module_path.index",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'notifications', 'unread_notifications_count')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_action = 'Show';

        $notification = Auth::user()->notifications()->where('id', $id)->first();

        // Mark as read
        $notification->markAsRead();

        return view(
            "backend.$module_path.show",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'notification')
        );
    }

    /**
     * Mark all notifications as read.
     *
     * @return Response
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return back();
    }

    /**
     * Delete all notifications.
     *
     * @return Response
     */
    public function deleteAll()
    {
        Auth::user()->notifications()->delete();

        return back();
    }
}