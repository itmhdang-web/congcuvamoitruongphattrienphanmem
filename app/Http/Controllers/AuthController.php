<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\TableUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller {
    // =============================================================================
    // USER area
    // =============================================================================
    function loginPage() {
        return view('.user.login.login');
    }

    function loginUser(Request $req) {
        $role = TableUser::where('username', $req->username)->first();
        if (is_null($role)) {
            return redirect()->route('page-user-login')->with("error_message", "Tên tài khoản hoặc mật khẩu không chính xác!");
        }

        if (Auth::guard('user')->attempt($req->only(['username', 'password']))) {
            return redirect()->route('page-user-home');
        } else {
            return redirect()->route('page-user-login')->with("error_message", "Tên tài khoản hoặc mật khẩu không chính xác!");
        }

    }

    public function logoutUser(Request $req): RedirectResponse {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            Auth::logout();
            Session::flush();
            return redirect()->route('page-user-home');
        }

        return redirect()->route('page-user-home');
    }

    function userChangePasswordPage() {
        return view('.user.login.change_password');
    }

    function changeUserPassword(Request $req) {
        $user = TableUser::find(Auth::guard('user')->user()->id);

        $validator = Validator::make($req->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'renewpassword' => 'required|same:newpassword',
        ], [
            'oldpassword.required' => 'Bạn phải nhập mật khẩu cũ!',
            'newpassword.required' => 'Bạn phải nhập mật khẩu mới!',
            'newpassword.min' => 'Mật khẩu mới phải từ 8 ký từ tự trở lên',
            'renewpassword.required' => 'Bạn phải nhập mật khẩu mới!',
            'renewpassword.same' => 'Mật khẩu nhập lại phải trùng với mật khẩu mớ!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Hash::check($req->oldpassword, $user->password)) {
            return redirect()->back()->withErrors(['oldpassword' => 'Mật khẩu cũ của bạn chưa đúng!!!'])->withInput();
        }

        $user->password = Hash::make($req->newpassword);
        $user->save();

        return redirect()->route('page-user-login')->with('success', 'Mật khẩu đã được thay đổi thành công.');
    }

    public function userRegisterPage() {
        return view('.user.register.index');
    }

    public function registerUser(Request $req) {
        $tenYearsAgo = Carbon::now()->subYears(10)->format('Y-m-d');

        $validator = Validator::make($req->all(), [
            'username' => 'required|min:3|unique:table_user,username',
            'password' => 'required|min:8',
            'phone' => 'required|numeric|min:8',
            'email' => 'required|email|unique:table_user,email',
            'file' => 'nullable|image|max:5120',
            'fullname' => 'required',
            'gender' => 'nullable|numeric',
            'birthday' => 'required|date|before_or_equal:'.$tenYearsAgo,
            'address' => 'nullable',
        ], [
             'username.unique' => "Tên đăng nhập đã tồn tại! hãy chọn username khác!",
             'username.min' => 'Tên đăng nhập phải từ 3 ký tự trở lên!',
             'password.min' => 'Mật khẩu phải từ 8 ký tự trở lên!',
             'phone.min' => 'Số điện thoại phải là số mà từ 8 số trở lên!',
             'phone.numeric' => 'Số điện thoại phải là số mà từ 8 số trở lên!',
             'email.unique' => 'Email đã tồn tại! Hãy chọn email khác!',
             'file.max' => 'Dung lượng hình ảnh lớn. Dung lượng cho phép <= 5MB ~ 5120KB',
             'file.image' => 'Định dạng ảnh không đúng. Định dạng cho phép (.jpg|.png|.jpeg)',
             'birthday.before_or_equal' => 'Bạn phải từ 10 tuổi trở lên để đăng ký.',
             'birthday.required' => 'Vui lòng nhập ngày sinh của bạn.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $info = new TableUser();
        $info->name = $req->fullname;
        $info->role = 'user';
        $info->username = $req->username;
        $info->password = Hash::make($req->password);
        $info->email = $req->email;
        $info->phone = $req->phone;
        ($req->gender > 0) ? $info->gender = $req->gender : $info->gender = 0;
        $info->birthday = $req->birthday;
        $info->address = $req->address;

        if ($req->hasFile('file')) {
            $filename = 'avatar-' . Str::uuid() . '.' . $req->file('file')->getClientOriginalExtension();
            $req->file('file')->move(public_path('upload/avatar/'), $filename);
            $info->avatar = $filename;
        }

        $info->save();

        if (Auth::guard('user')->attempt($req->only(['username', 'password']))) {
            return redirect()->route('page-user-home');
        }
    }

}
