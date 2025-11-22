<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\ProductTypeRequest;
use App\Http\Requests\AddOrderRequest;
use Illuminate\Support\Str;
use App\Models\TableProduct;
use App\Models\TableComment;
use App\Models\TableOrder;
use App\Models\TableProductType;
use App\Models\TableUser;
use App\Models\TableOrderDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller {

    // ---------------- ADMIN ---------------- //
    // Sản phẩm //
    public function productListPage(Request $req) {
        $limit = 10;
        $dsProduct = TableProduct::latest()->paginate($limit);
        $current = $dsProduct->currentPage();
        $perSerial = $limit * ($current - 1);
        $serial = $perSerial + 1;
        return view('.admin.product.main.list', compact('dsProduct', 'serial'));
    }

    public function addProductPage() {
        $level1 = TableProductType::all();
        return view('.admin.product.main.add', compact('level1'));
    }

    public function addProduct(AddProductRequest $req) {
        $product = new TableProduct();
        $product->name = $req->tensp;
        $product->content = htmlspecialchars($req->noidung);
        $product->price_regular = (isset($req->giagoc) && !empty($req->giagoc)) ? str_replace(',', '', $req->giagoc) : 0;
        $product->sale_price = (isset($req->giamoi) && !empty($req->giamoi)) ? str_replace(",", "", $req->giamoi) : 0;
        $product->brand = $req->brand;
        ($req->type > 0) ? $product->id_type = $req->type : 0;

        if ($req->file != null) {
            // kiểm tra kích thước
            $size = $req->file->getSize();
            $sized = $size / 1024;
            if ($sized > 5120) {
                throw Exception("Dung lượng hình ảnh lớn. Dung lượng cho phép <= 5MB ~ 5120KB");
            }

            $extension = $req->file->getClientOriginalExtension();
            if ($extension == 'jpg' || $extension == 'png' || $extension = 'jpeg') {
                $filename = 'product-' . Uuid::uuid4() . '.' . $req->file->getClientOriginalExtension();
                $product->photo = $filename;
                $req->file->move(public_path('upload/product/'), $filename);
            } else {
                throw Exception("Định dạng ảnh không đúng. Định dạng cho phép (.jpg|.png|.jpeg)");
            }
        }

        $product->save();
        return redirect()->route('page-admin-product-list')->with('noti', 'Thêm sản phẩm thành công !!!');
    }

    public function updateProductPage(Request $req, $id) {
        $product = TableProduct::find($id);
        $level1 = TableProductType::all();

        return view('.admin.product.main.modify', ['detailSP' => $product], compact('level1'));
    }

    public function updateProduct(AddProductRequest $req, $id) {
        $product = TableProduct::find($id);
        if ($product == null) {
            throw Exception("không tìm thấy sản phẩm nào có ID = {$id} này");
        }
        $product->name = $req->tensp;
        $product->content = htmlspecialchars($req->noidung);
        $product->price_regular = (isset($req->giagoc) && !empty($req->giagoc)) ? str_replace(",", "", $req->giagoc) : 0;
        $product->sale_price = (isset($req->giamoi) && !empty($req->giamoi)) ? str_replace(",", "", $req->giamoi) : 0;
        $product->brand = $req->brand;
        ($req->type > 0) ? $product->id_type = $req->type : 0;

        if ($req->file != null) {
            $size = $req->file->getSize();
            $sized = $size / 1024;
            if ($sized > 5120) {
                throw Exception("Dung lượng hình ảnh lớn. Dung lượng cho phép <= 5MB ~ 5120KB");
            }
            $extension = $req->file->getClientOriginalExtension();
            if ($extension == 'jpg' || $extension == 'png' || $extension = 'jpeg') {
                $filename = 'product-' . Uuid::uuid4() . '.' . $req->file->getClientOriginalExtension();
                $product->photo = $filename;
                $req->file->move(public_path('upload/product/'), $filename);
            } else {
                throw Exception("Định dạng ảnh không đúng. Định dạng cho phép (.jpg|.png|.jpeg)");
            }
        }

        $product->save();

        return redirect()->route('page-admin-product-list');
    }

    public function removeProduct(Request $req) {
        $products = TableProduct::find($req->id);
        if ($products == null) {
            throw Exception("không tìm thấy sản phẩm nào có ID = {$req->id} này");
        }
        if (!empty($products->photo)) {
            $image_path = public_path('upload/product/' . $products->photo);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $products->delete();
    }

    public function searchProductAdmin(Request $req) {
        if ($req->keyword != null) {
            $limit = 10;
            $dsProduct = TableProduct::where('name', 'like', '%' . $req->keyword . '%')->latest()->paginate($limit);
            $current = $dsProduct->currentPage();
            $perSerial = $limit * ($current - 1);
            $serial = $perSerial + 1;
        }
        return view('.admin.product.main.list', compact('dsProduct', 'serial'));
    }

    // ---------------- ADMIN ---------------- //

    // ---------------- USER ---------------- //
    public function userProductPage(Request $req) {
        $limit = 8;
        $min_price = TableProduct::min('price_regular');
        $max_price = TableProduct::max('price_regular');
        $productTypes = TableProductType::all();
        $min_price_range = $min_price - 500000;
        $max_price_range = $max_price + 1000000;

        if (isset($_GET['productType'])) {
            $productTypeId = $_GET['productType'];
            $dsProduct = TableProduct::where('id_type', $productTypeId)->latest()->paginate($limit);
        } elseif (isset($_GET['start_price']) && $_GET['end_price']) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];

            $dsProduct = TableProduct::whereBetween('price_regular', [$min_price, $max_price])->latest()->paginate($limit);
        } else {
            $dsProduct = TableProduct::where('deleted_at', null)->latest()->paginate($limit);
        }

        return view('.user.product.product', compact('dsProduct', 'productTypes', 'min_price', 'max_price', 'max_price_range', 'min_price_range'));
    }


    public function searchProduct(Request $req) {
        if ($req->keyword != null) {
            $limit = 12;
            $dsProduct = TableProduct::where('deleted_at', null)
                ->where('name', 'like', '%' . $req->keyword . '%')
                ->latest()
                ->paginate($limit);
        }
        $productTypes = TableProductType::all();
        return view('.user.product.product', compact('dsProduct', 'productTypes'));
    }

    public function userProductDetailPage(Request $req, $id) {
        $id_order_product = TableOrderDetail::where('id_product', $id)->get();
        $detailProduct = TableProduct::where('deleted_at', null)->where('id', $id)->first();
        $detailProduct->view++;
        $detailProduct->save();
        return view('.user.product.detail', ['rowDetail' => $detailProduct], compact('id_order_product'));
    }

    public function addComment(Request $req, $id) {
        $id_product = TableOrderDetail::where('id_product', $id)
            ->where('id_user', Auth::guard('user')->user()->id)
            ->first();

        $id_user = $req->id_user;
        $product_id = $id;
        $content = $req->content;
        if ($id_user == $id_product->id_user) {
            $comment = new TableComment();
            $comment->id_user = Auth::guard('user')->user()->id;
            $comment->id_product = $product_id;
            $comment->content = $content;
            $comment->status = 1;
            $comment->save();
            echo 'Bình luận thành công';
        }
    }

    public function getComments(Request $req, $id) {
        $output = '';
        $data_id_comment = TableComment::get('id_user');
        $data_id_user = TableUser::whereIn('id', $data_id_comment)->find($data_id_comment);
        $dsComment = TableComment::where('id_product', $id)->where('status', 1)->get();

        foreach ($dsComment as $c => $comment) {
            foreach ($data_id_user as $u => $user) {
                if ($comment->id_user == $user->id) {
                    $output .=
                        '<div class="d-flex mb-3" id="style_comment">
                            <div class="col-sm-1" id="img-avatar">
                                <img width="100%" src="' . url('/upload/avatar/' . $user->avatar) . '" class="img-avatar" />
                            </div>
                            <div class="col-sm-11" id="content">
                                <span style="color: green">' . $user->name . '</span>
                                <span> ' . $comment->created_at->format('h:m d/m/Y ') . ' </span>
                                <p> ' . $comment->content . ' </p>
                            </div>
                        </div> ';
                }
            }
        }
        echo $output;
    }

    // ---------------- USER ---------------- //
}
