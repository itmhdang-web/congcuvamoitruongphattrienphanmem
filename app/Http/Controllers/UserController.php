<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TableUser;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class UserController extends Controller {

    public function userListPage(Request $req) {
        $limit = 10;

        $builder = TableUser::where('role', '=', 'user');
        if (isset($req->keyword)) {
            $builder = $builder->where('name', 'like', '%' . $req->keyword. '%');
        }

        $dsUser = $builder->latest()->paginate($limit);
        $current = $dsUser->currentPage();
        $perSerial = $limit * ($current - 1);
        $serial = $perSerial + 1;
        return view('.admin.user_of_admin.list', compact('dsUser', 'serial'));
    }

    public function removeUser(Request $req) {
        $user = TableUser::find($req->id);
        if ($user == null) {
            return "không tìm thấy người dùng có ID = {$req->id} ";
        }

        $user->delete();
        return response()->json();
    }

    function userProfilePage() {
        return view('.user.login.update_info_user');
    }

    function updateProfile(Request $req) {
        $info = TableUser::where('id', Auth::guard('user')->user()->id)->first();
        $info->name = $req->fullname;
        $info->email = $req->email;
        $info->phone = $req->phone;
        ($req->gender > 0) ? $info->gender = $req->gender : $info->gender = 0;
        $info->birthday = $req->birthday;
        $info->address = $req->address;

        if ($req->file != null) {
            $size = $req->file->getSize();
            $sized = $size / 1024;
            if ($sized > 5120) {
                throw Exception("Dung lượng hình ảnh lớn. Dung lượng cho phép <= 5MB ~ 5120KB");
            }
            $extension = $req->file->getClientOriginalExtension();
            if ($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg') {
                $filename = 'avatar-' . Uuid::uuid4() . '.' . $req->file->getClientOriginalExtension();
                $info->avatar = $filename;
                $req->file->move(public_path('upload/avatar/'), $filename);
            } else {
                throw Exception("Định dạng ảnh không đúng. Định dạng cho phép (.jpg|.png|.jpeg)");
            }
        }
        $info->save();
        return back();
    }



}
