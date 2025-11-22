<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTypeRequest;
use App\Models\TableProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller {

    public function productTypeListPage(Request $req) {
        $limit = 10;
        $dslevel2 = TableProductType::latest()->paginate($limit);
        $current = $dslevel2->currentPage();
        $perSerial = $limit * ($current - 1);
        $serial = $perSerial + 1;
        return view('.admin.product.type.list', compact('dslevel2', 'serial'));
    }

    public function addProductTypePage() {
        return view('.admin.product.type.add');
    }

    public function addProductType(ProductTypeRequest $req) {
        $productType = new TableProductType();
        $productType->name = $req->tendm;
        $productType->save();
        return redirect()->route('page-admin-type-list');
    }

    public function updateProductTypePage($id) {
        $productType = TableProductType::find($id);
        return view('.admin.product.type.modify', ['detailLV1' => $productType]);
    }

    public function updateProductType(ProductTypeRequest $req, $id) {
        $productType = TableProductType::find($id);
        if ($productType == null) {
            throw Exception("không tìm thấy danh mục nào có ID = {$id} này");
        }
        $productType->name = $req->tendm;
        $productType->save();
        return redirect()->route('page-admin-type-list');
    }

    public function removeProductType(Request $req) {
        $productType = TableProductType::find($req->id);
        if ($productType == null) {
            throw Exception("không tìm thấy sản phẩm có nào ID = {$req->id} này");
        }

        $productType->delete();
    }

    public function searchTypeAdmin(Request $req) {
        if ($req->keyword != null) {
            $limit = 10;
            $dslevel2 = TableProductType::where('name', 'like', '%' . $req->keyword . '%')->latest()->paginate($limit);
            $current = $dslevel2->currentPage();
            $perSerial = $limit * ($current - 1);
            $serial = $perSerial + 1;
        }
        return view('.admin.product.type.list', compact('dslevel2', 'serial'));
    }

}
