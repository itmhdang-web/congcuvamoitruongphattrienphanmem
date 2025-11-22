<?php

namespace App\Http\Controllers;

use App\Models\TableProduct;
use Illuminate\Http\Request;

class CartController extends Controller {

    public function userCartPage() {
        return view('.user.order.order');
    }

    private function addExistedProductInCart($productId = '', $quantity = 1) {
        $flag = false;
        $cart = session()->get('cart');
        if (!empty($cart) && $productId != '') {
            $quantity = ($quantity > 1) ? $quantity : 1;
            foreach ($cart as $index => $value) {
                if ($productId == $value['id_product']) {
                    $cart[$index]['quantity'] += $quantity;
                    $flag = true;
                    break;
                }
            }
            session()->put('cart', $cart);
        }
        return $flag;
    }

    public function addToCart(Request $req) {
        $productId = $req->id;
        $itemProduct = TableProduct::findOrFail($productId);

        $cart = session()->get('cart');
        if (!empty($cart)) {
            $cartMaxIdx = count($cart);
            if (!$this->addExistedProductInCart($productId, $req->quantity)) {
                $cart[$cartMaxIdx] = [
                    "name" => $itemProduct->name,
                    "quantity" => $req->quantity,
                    "price_regular" => $itemProduct->price_regular,
                    "price_sale" => $itemProduct->sale_price,
                    "image" => $itemProduct->photo,
                    "id_product" => $itemProduct->id
                ];
                session()->put('cart', $cart);
            }
        } else {
            $cart[0] = [
                "name" => $itemProduct->name,
                "quantity" => $req->quantity,
                "price_regular" => $itemProduct->price_regular,
                "price_sale" => $itemProduct->sale_price,
                "image" => $itemProduct->photo,
                "id_product" => $itemProduct->id
            ];
            session()->put('cart', $cart);
        }
        return response()->json(array('max' => count(session()->get('cart'))));
    }

    public function removeFromCart(Request $req) {
        if (session()->get('cart')) {
            $cart = session()->get('cart');
            foreach ($cart as $key => $value) {
                if ($cart[$key]['id_product'] == $req->id) {
                    unset($cart[$key]);
                    break;
                }
            }
            session()->put('cart', $cart);
        }
        return response()->json(session()->get('cart'));
    }

    public function updateCart(Request $req) {
        $tempCart = session()->get('cart');
        foreach ($tempCart as $index => $value) {
            if ($value['id_product'] == $req->id && $req->quantity > 0) {
                $tempCart[$index]['quantity'] = $req->quantity;
                break;
            }
        }
        session()->put('cart', $tempCart);

        $total = getOrderTotal();
        $totalText = formatMoney($total);

        $product = getProductInfo($req->id);
        $regular_price = formatMoney($product->price_regular * $req->quantity);
        $sale_price = formatMoney($product->sale_price * $req->quantity);

        return response()->json(array('regularPrice' => $regular_price, 'salePrice' => $sale_price, 'totalText' => $totalText));
    }
}
