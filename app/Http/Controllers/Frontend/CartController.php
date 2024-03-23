<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    // Initialize session
    public function __construct()
    {
        session_start();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session()->get('cart');
        //dd($cart);

        if(is_null($cart)) {
            $cart = [];
        }
        return view('Frontend.Cart.cartProduct',compact('cart'));
    }

     /**
     * Add to cart ajax.
     */
    public function add(Request $request)
    {

        $productId = $request->productId;
        
        $product = Products::find($productId);
        
        $cartQuantity = $request->cartQuanty;

        // Kiểm tra xem session đã tồn tại chưa, nếu chưa thì khởi tại một session với một mảng mới
        $sessionCart = session()->get('cart');
        if(!$sessionCart){
            $sessionCart = [];
        }

        // Kiểm tra xem giỏ hàng có sản phẩm chưa,
        if(isset($sessionCart[$request->productId])){
             # Nếu có sản phẩm trong giỏ hàng rồi, thì cập nhật thêm số lượng (tăng )
            $sessionCart[$request->productId]['quantity']++;
        }else{
            # Nếu chưa thì thêm sản phẩm vào giỏ hàng
           $sessionCart[$request->productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'hinhanh' => $product->hinhanh,
                'quantity' => 1,
            ];
        }

        
        //Lưu giỏ hàng vào session
        session()->put('cart', $sessionCart);
        // echo $productId;
        // exit;

        // $data = session()->all();
        // var_dump($data);
         //thông báo thành công
        return response()->json(['status' => 'success']);
    }
    

    public function changeProductQuantity (Request $request)
    {
        $idCart = $request->id;

        $quantityCart = $request->quantity;

        $functionCart = $request->function;

        $ajaxCart = session()->has('cart.' . $idCart);
        // echo $idCart;
        // exit;

        if($functionCart == 1){
           if($ajaxCart){

              $showCart = session()->put('cart.'.$idCart.'.quantity', $quantityCart);
              
           }
        }


        if ($functionCart == 2) {
            if( $quantityCart < 1){
               $subQty =  session()->forget('cart.'.$idCart);
            }else{
                $showCart = session()->put('cart.'.$idCart.'.quantity', $quantityCart);
            }
        }

        if($functionCart == 3){
            $deleteCart = session()->forget('cart.'.$idCart);
        }
        
        // $checkCart = session()->get('cart');
        // echo "<pre>";
        // var_dump($checkCart);
        return response()->json(['status' => 'success']);
    }
}
