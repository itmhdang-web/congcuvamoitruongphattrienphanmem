<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOrderRequest;
use Exception;
use Illuminate\Http\Request;
use App\Models\TableOrder;
use App\Models\TableOrderDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class OrderController extends Controller {

    public function adminOrderListPage() {
        $limit = 10;
        $dsOrder = TableOrder::latest()->paginate($limit);
        $current = $dsOrder->currentPage();
        $perSerial = $limit * ($current - 1);
        $serial = $perSerial + 1;
        return view('.admin.order.order', compact('dsOrder', 'serial'));
    }

    public function adminSearchOrder(Request $req) {
        $limit = 10;
        $builder = TableOrder::query();

        if (isset($req->select_status_order) && !empty($req->select_status_order)) {
            $builder = $builder->where('status', $req->select_status_order);
        }

        if (isset($req->order_date)) {
            $builder = $builder->where('created_at', '>=', Carbon::parse($req->order_date)->startOfDay());
        }

        $dsOrder = $builder->latest()->paginate($limit);
        $current = $dsOrder->currentPage();
        $perSerial = $limit * ($current - 1);
        $serial = $perSerial + 1;
        return view('.admin.order.order', compact('dsOrder', 'serial'));
    }

    public function adminOrderDetailPage($id) {
        $limit = 10;
        $infoOrder = TableOrder::find($id);
        $dsOrderDetail = TableOrderDetail::where('id_order', $infoOrder->id)->latest()->paginate($limit);

        $current = $dsOrderDetail->currentPage();
        $perSerial = $limit * ($current - 1);
        $serial = $perSerial + 1;
        return view('.admin.order.detail', ['orderDetail' => $infoOrder], compact('dsOrderDetail', 'serial'));
    }

    public function userPurchaseHistoryPage(Request $req) {
        $limit = 5;
        $id = Auth::guard('user')->user()->id;
        $dsOrder = TableOrder::where('id_user', $id)->orderBy('created_at', 'DESC')->latest()->paginate($limit);

        $order = TableOrder::get('id');
        $order_detail = TableOrderDetail::whereIn('id_order', $order)->where('id_user', $id)->get();

        return view('.user.login.purchase_history', compact('dsOrder', 'order_detail'));
    }

    public function userPurchaseHistoryDetailPage(Request $req, $id) {
        $limit = 10;
        $infoOrder = TableOrder::find($id);

        if ($infoOrder->id_user != AUth::guard('user')->user()->id) {
            return redirect()->route("page-user-home");
        }

        $dsOrderDetail = TableOrderDetail::where('id_order', $infoOrder->id)->latest()->paginate($limit);
        $dsOrder = TableOrder::where('id', $infoOrder->id)->latest()->paginate($limit);

        return view('.user.login.purchase_history_detail', ['orderDetail' => $infoOrder,], compact('dsOrderDetail', 'dsOrder'));
    }

    public function addOrder(Request $req) {
        if (!empty(Auth::guard('user')->user()->id)) {
            $infoOrder = new TableOrder();
            $infoOrder->code = Uuid::uuid4();
            $infoOrder->id_user = Auth::guard('user')->user()->id;
            $infoOrder->fullname = $req->fullname;
            $infoOrder->phone = $req->phone;
            $infoOrder->address = $req->address;
            $infoOrder->email = $req->email;
            $infoOrder->payment = $req->paymentmethod;
            $infoOrder->status = 'pending';
            $infoOrder->total_price = getOrderTotal();
            $infoOrder->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $infoOrder->save();
            $cart = session()->get('cart');
            foreach ($cart as $key => $value) {
                $detailOrder = new TableOrderDetail();
                $detailOrder->id_order = $infoOrder->id;
                $detailOrder->id_product = $value['id_product'];
                $detailOrder->id_user = $infoOrder->id_user;
                $detailOrder->name_product = $value['name'];
                $detailOrder->photo_product = $value['image'];
                if ($value['price_sale'] > 0)
                    $detailOrder->price = $value['price_sale'];
                else
                    $detailOrder->price = $value['price_regular'];
                $detailOrder->quantity = $value['quantity'];
                $detailOrder->save();
            }
            if (session()->has('cart')) {
                session()->forget('cart');
            }
            // return redirect()->route('page-user-home');
            return response()->json();
        }
    }

    public function updateOrder(AddOrderRequest $req, $id) {
        $order = TableOrder::find($id);
        if ($order == null) {
            throw new Exception("không tìm thấy sản phẩm nào có ID = {$id} này");
        }
        $order->status = ($req->status != NULL) ? $req->status : 'pending';
        $order->save();
        return redirect()->route('page-admin-order-list');
    }

    public function cancelOrder(Request $req) {
        $data = $req->all();
        $userId = Auth::guard('user')->user()->id;
        $order = TableOrder::where('code', $data['code'])->first();
        if ($order == null || $order->id_user != $userId) {
            throw new Exception("Bạn không có quyền hủy order này!");
        }
        $order->status = "cancelled";
        $order->save();
    }

    public function payByVNPay(Request $req) {
        $name = $req->fullname;
        $email = $req->email;
        $phone = $req->phone;
        $address = $req->address;
        $requirements = (!empty($req->requirements)) ? $req->requirements : "Đã chuyển khoản qua VNPay";
        $method = $req->paymentmethod;
        $id_user = Auth::guard('user')->user()->id;
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/order/payment/vnpay/webhook/" . $name . "/" . $phone . "/" . $email . "/" . $address . "/" . $requirements . "/" . $method . "/" . $id_user;
        $vnp_TmnCode = config("payment.vnpay_code");
        $vnp_HashSecret = config("payment.vnpay_secret");

        $orderCode = Uuid::uuid4();
        $vnp_TxnRef = $orderCode;
        $vnp_OrderInfo = "Thanh toán hoá đơn" . $orderCode;
        $vnp_OrderType = "Thanh toán";
        $vnp_Amount = getOrderTotal() * 100;
        $vnp_Locale = "VN";
//        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_Inv_Phone = $phone;
        $vnp_Inv_Customer = $name;
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_Inv_Phone" => $vnp_Inv_Phone,
            "vnp_Inv_Customer" => $vnp_Inv_Customer,
        );

//        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
//            $inputData['vnp_BankCode'] = $vnp_BankCode;
//        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function returnVNPay(Request $req) {
        if (empty(Auth::guard('user')->user()->id)) {
            throw new Exception("Bạn không có quyền!");
        }

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $vnp_HashSecret = config("payment.vnpay_secret");
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash != $vnp_SecureHash || $_GET['vnp_ResponseCode'] != '00') {
            throw new Exception("Giao dịch không thành công!");
        }

        $infoOrder = new TableOrder();
        $infoOrder->code = $req->vnp_TxnRef;
        $infoOrder->id_user = $req->id_user;
        $infoOrder->fullname = $req->fullname;
        $infoOrder->phone = $req->phone;
        $infoOrder->address = $req->address;
        $infoOrder->email = $req->email;
        $infoOrder->content = $req->requirements;
        $infoOrder->payment = $req->paymentmethod;
        $infoOrder->status = 'paid';
        $infoOrder->total_price = $req->vnp_Amount / 100;
        $infoOrder->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $infoOrder->save();
        $cart = session()->get('cart');
        foreach ($cart as $key => $value) {
            $detailOrder = new TableOrderDetail();
            $detailOrder->id_order = $infoOrder->id;
            $detailOrder->id_user = $infoOrder->id_user;
            $detailOrder->id_product = $value['id_product'];
            $detailOrder->name_product = $value['name'];
            $detailOrder->photo_product = $value['image'];
            if ($value['price_sale'] > 0) {
                $detailOrder->price = $value['price_sale'];
            }
            else $detailOrder->price = $value['price_regular'];
            $detailOrder->quantity = $value['quantity'];
            $detailOrder->save();
        }
        if (session()->has('cart')) {
            session()->forget('cart');
        }

        return redirect()->route('page-user-order-list');
    }

}
