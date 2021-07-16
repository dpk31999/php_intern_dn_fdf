<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileInfoRequest;
use App\Http\Requests\ProfilePassRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $cities = City::select('name')->get();

        $user = Auth::guard('web')->user();

        return view('profile', compact('user', 'cities'));
    }

    public function updateAvatar(Request $request)
    {
        $avatar = $request->avatar;

        if (File::exists(public_path('storage/' .  Auth::guard('web')->user()->avatar_path))) {
            File::delete(public_path('storage/' . Auth::guard('web')->user()->avatar_path));
        }

        $avatar_path = config('app.avatar_path') . '/' . time() . '.' . $avatar->getClientOriginalExtension();
        $path = public_path('/storage/' . config('app.avatar_path'));

        $avatar->move($path, $avatar_path);

        Auth::guard('web')->user()->avatar_path = $avatar_path;
        Auth::guard('web')->user()->save();

        return redirect()->route('profile.index');
    }

    public function updateInfomation(ProfileInfoRequest $request)
    {
        Auth::guard('web')->user()->name = $request->name;
        Auth::guard('web')->user()->phone = $request->phone ?? '';
        Auth::guard('web')->user()->city = $request->city ?? '';
        Auth::guard('web')->user()->address = $request->address ?? '';
        Auth::guard('web')->user()->save();

        return redirect()->back();
    }

    public function updatePassword(ProfilePassRequest $request)
    {
        if (!Hash::check($request->oldpassword, Auth::guard('web')->user()->password)) {
            return response()->json([
                'error' => trans('users.pass_not_match'),
            ], 422);
        }

        Auth::guard('web')->user()->password = Hash::make($request->password);
        Auth::guard('web')->user()->save();

        return response()->json([
            'message' => trans('users.change_pass_success'),
        ]);
    }
}
