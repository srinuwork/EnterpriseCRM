<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = [
            'admin_login' => Setting::get('admin_login_enabled', '1'),
            'admin_register' => Setting::get('admin_register_enabled', '1'),
        ];
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        Setting::set('admin_login_enabled', $request->has('admin_login_enabled') ? '1' : '0');
        Setting::set('admin_register_enabled', $request->has('admin_register_enabled') ? '1' : '0');

        return back()->with('success', 'System security protocols updated successfully.');
    }
}
