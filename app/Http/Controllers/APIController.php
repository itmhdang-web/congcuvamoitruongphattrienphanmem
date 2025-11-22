<?php

namespace App\Http\Controllers;

use App\Models\TableComment;
use App\Models\TableProduct;
use App\Models\TableProductType;
use App\Models\TableUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class APIController extends Controller {

    public function login($request) {
        if (Auth::guard('user')->attempt($request->only(['username', 'password']))) {
            return response()->json(Auth::guard('user')->user());
        } else {
            return response()->json(false);
        }
    }

    public function register($request) {
        $tenYearsAgo = Carbon::now()->subYears(10)->format('Y-m-d');

        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3|unique:table_user,username',
            'password' => 'required|min:8',
            'phone' => 'required|numeric|min:8',
            'email' => 'required|email|unique:table_user,email',
            'file' => 'nullable|image|max:5120',
            'fullname' => 'required',
            'gender' => 'nullable|numeric',
            'birthday' => 'required|date|before_or_equal:' . $tenYearsAgo,
            'address' => 'nullable',
        ],
         [
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
            return response()->json($validator->errors());
        }

        $info = new TableUser();
        $info->name = $request->fullname;
        $info->role = 'user';
        $info->username = $request->username;
        $info->password = Hash::make($request->password);
        $info->email = $request->email;
        $info->phone = $request->phone;
        ($request->gender > 0) ? $info->gender = $request->gender : $info->gender = 0;
        $info->birthday = $request->birthday;
        $info->address = $request->address;

        if ($request->hasFile('file')) {
            $filename = 'avatar-' . Str::uuid() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(public_path('upload/avatar/'), $filename);
            $info->avatar = $filename;
        }

        $info->save();

        if (Auth::guard('user')->attempt($request->only(['username', 'password']))) {
            return response()->json(Auth::guard('user')->user());
        }

        return response()->json(false);
    }

    public function getProducts($request) {
        if (isset($request->name)) {
            $products = TableProduct::where('name', 'like', '%' . $request . '%')->get();
        } else {
            $products = TableProduct::all();
        }
        return response()->json($products);
    }


    public function getProduct($id) {
        $product = TableProduct::find($id);
        return response()->json($product);
    }

    public function getProductComments($id) {
        $comments = TableComment::where('id_product', $id)->get();
        return response()->json($comments);
    }

    public function getCategories() {
        $categories = TableProductType::all();
        return response()->json($categories);
    }

    public function getCategory($id) {
        $category = TableProductType::find($id);
        return response()->json($category);
    }

}
