<?php

namespace App\Http\Controllers;

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
        $data = [
            "Ho Chi Minh City",
            "Hanoi",
            "Thanh Hoa",
            "Nghe An",
            "Dong Nai",
            "Binh Duong",
            "Hai Phong",
            "Hai Duong",
            "Dak Lak",
            "Thai Bình",
            "An Giang",
            "Bac Giang",
            "Tien Giang",
            "Nam Dinh",
            "Long An",
            "Kien Giang",
            "Dong Thap",
            "Gia Lai",
            "Quang Nam",
            "Phu Tho",
            "Binh Dinh",
            "Bac Ninh",
            "Quang Ninh",
            "Thai Nguyen",
            "Lam Dong",
            "Ha Tinh",
            "Ben Tre",
            "Son La",
            "Hung Yen",
            "Khanh Hoa",
            "Can Tho",
            "Binh Thuan",
            "Quang Ngai",
            "Ca Mau",
            "Da Nang",
            "Tay Ninh",
            "Vinh Phuc",
            "Soc Trang",
            "Ba Ria",
            "Thura Thien",
            "Vinh Long",
            "Bình Phuoc",
            "Tra Vinh",
            "Ninh Binh",
            "Bac Lieu",
            "Quang Binh",
            "Ha Giang",
            "Phu Yen",
            "Hoa Binh",
            "Ha Nam",
            "Yen Bai",
            "Tuyen Quang",
            "Lang Son",
            "Lao Cai",
            "Hau Giang",
            "Dak Nong",
            "Quang Tri",
            "Dien Bien",
            "Ninh Thuan",
            "Kon Tum",
            "Cao Bang",
            "Lai Chau",
            "Bac Kan",
        ];

        $user = Auth::guard('web')->user();

        return view('profile', compact('user', 'data'));
    }

    public function updateAvatar(Request $request)
    {
        $avatar = $request->avatar;

        if (File::exists(public_path('storage/' .  Auth::guard('web')->user()->avatar_path))) {
            File::delete(public_path('storage/' . Auth::guard('web')->user()->avatar_path));
        }

        $avatar_path = 'avatar_path/' . time() . '.' . $avatar->getClientOriginalExtension();
        $path = public_path('/storage/avatar_path');

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
                'error' => trans('users.pass-not-match'),
            ], 422);
        }

        Auth::guard('web')->user()->password = Hash::make($request->password);
        Auth::guard('web')->user()->save();


        return response()->json([
            'message' => trans('users.change-pass-success'),
        ]);
    }
}
