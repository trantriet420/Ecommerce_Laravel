<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Requests\SearchRequest;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $search = $request->input('search');
        // // Kiểm tra nếu không có từ khóa tìm kiếm thì hiển thị thông báo lỗi
        // if(trim($search) === '') {
        //     return redirect()->back()->with('error', 'Vui lòng nhập sản phẩm cần tìm.');
        // }

        // $searchResult = Products::where('name', 'like', '%' . $search . '%')->get(); 
          
          
        // foreach ($searchResult as $product) {
        //     $product->hinhanh = json_decode($product->hinhanh);
        // }
        
        return view ('Frontend.Search.Search');
    }

    

    
}
