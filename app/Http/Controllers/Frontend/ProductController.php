<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // $getProducts = Products::find(4)->toArray();

        // $getArrImage = json_decode($getProducts['hinhanh'], true);
        // dd($getArrImage);

        $getProducts = Products::all()->toArray();
        //dd($getProducts);
        
        foreach($getProducts as &$productList){
              $productList['hinhanh'] = json_decode($productList['hinhanh'],true);
              //dd($productList['hinhanh']);
        }
        //dd($getProducts);
        return view('Frontend.Product.list',compact('getProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Category = Category::all()->toArray();
        $Brand = Brand::all()->toArray();
        return view('Frontend.Product.add',compact('Category','Brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);

        $mang_hinhAnh = [];

        if($request->hasfile('hinhanh')){

            foreach($request->file('hinhanh') as $image)
            {

                $name = $image->getClientOriginalName();
                $name_2 = "hinh84_".$image->getClientOriginalName();
                $name_3 = "hinh380_".$image->getClientOriginalName();

                $path = public_path('upload/products/' . $name);
                $path_2 = public_path('upload/products/' . $name_2);
                $path_3 = public_path('upload/products/' . $name_3);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(85,84)->save($path_2);
                Image::make($image->getRealPath())->resize(329,380)->save($path_3);

                $mang_hinhAnh[] = $name;
            }
        }

        // xử lý trạng thái
        $status = null;
        if ($request->sale == 0) {
            $status = 0; //New
        }elseif ($request->sale == 1) {
            $status = 1 ; //Sale
        }

        //đưa vào db
        $product = new Products();
        //$product->id_user = $request->id_user;
        $product->name=$request->name;
        $product->price=$request->price;
        $product->id_category=$request->Id_category;
        $product->id_brand=$request->Id_brand;
        $product->status=$status;
        $product->sale=$request->giaSale;
        $product->company=$request->company;
        $product->detail=$request->detail;

        $product->hinhanh=json_encode($mang_hinhAnh);
        $product->save();

        // dd($product);
        return redirect()->back()->with('success', __('created product!'));

    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Category = Category::all()->toArray();
        $Brand = Brand::all()->toArray();
        $editProduct = Products::find($id)->toArray();
        //dd($editProduct);
        $getArrImage = json_decode($editProduct['hinhanh'], true);
        //dd($getArrImage);
        return view('Frontend.Product.edit',compact('Category','Brand','editProduct','getArrImage'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        //dd($data);

        $updateProduct = Products::find($id)->toArray();
        //dd($updateProduct);

        //lấy ảnh ra từ chuỗi giải mã json
        $hinhCu = json_decode($updateProduct['hinhanh'],true);
        //dd($hinhCu);

        // lấy danh sách hình ảnh muốn xóa từ form
        $hinhXoa = $request->hinhCancel;
        //dd($hinhXoa );

        //lấy danh sách hình mới cập nhật thêm
        $hinhUpload = $request->hinhanh;
        //dd($hinhUpload);

        // nếu có hình ảnh muốn xóa
        if(!empty($hinhXoa)){
            // duyệt qua từng hình cũ
            foreach($hinhCu as $key => $hinh){
                // nếu hình này nằm trong số hình muốn xóa ( mảng)
                if(in_array($hinh, $hinhXoa)){
                     // thì xóa hình này khỏi danh sách hình cũ ( mảng json ban đầu)
                    unset($hinhCu[$key]);
                }
            }
            //ok thì Reset key của mảng hinhAnh_cu
            $hinhCu = array_values($hinhCu); 
            //dd($hinhCu);
        }

        //nếu có hình mới tải lên và tổng số các hình ( mới và cũ) của product không lớn hơn 3
          $mang_hinhAnh = [];
          // kiểm tra xe hinh up thêm có phải là mảng không
          $hinhUploadCount = is_array($hinhUpload) ? count($hinhUpload) : 0;
          //dd($hinhUploadCount);
          if(!empty($hinhUpload) && count($hinhCu) + $hinhUploadCount <= 3){
                // thì đưa hình ảnh mới được thêm vào mảng hình ảnh ban đầu ( $hinhCu)
                if($request->hasfile('hinhanh')){
                    foreach($request->file('hinhanh') as $image){
                        $name = $image->getClientOriginalName();
                        $name_2 = "hinh84_".$image->getClientOriginalName();
                        $name_3 = "hinh380_".$image->getClientOriginalName();

                        $path = public_path('upload/products/' . $name);
                        $path_2 = public_path('upload/products/' . $name_2);
                        $path_3 = public_path('upload/products/' . $name_3);

                        Image::make($image->getRealPath())->save($path);
                        Image::make($image->getRealPath())->resize(85,84)->save($path_2);
                        Image::make($image->getRealPath())->resize(329,380)->save($path_3);

                        $mang_hinhAnh[] = $name;
                    }
                    //dd($mang_hinhAnh);
                }

                //Gộp mảng mang_2chieu và hinhAnh_cu thành một.
                $hinhCu = array_merge($mang_hinhAnh,$hinhCu);
                //dd($hinhCu);

          }elseif (count($hinhCu) + $hinhUploadCount > 3) {
              # nếu tổng hình ảnh ( mới và cũ) lớn hơn 3 thì đưa ra thông báo lỗi: cập nhật thất bại
            return redirect()->back()->withErrors(['error' => _('Update product error.')]);

          }
        
        // xử lý trạng thái
        $status = null;
        if ($request->sale == 0) {
            $status = 0; //New
        }elseif ($request->sale == 1) {
            $status = 1 ; //Sale
        }


        // đua vào db sau khi đã edit
        $product = Products::find($id); 

        $product->name = $request->name;
        $product->price = $request->price;
        $product->id_category = $request->Id_category;
        $product->id_brand = $request->Id_brand;
        $product->status = $status;
        $product->sale = $request->giaSale;
        $product->company = $request->company;
        $product->detail = $request->detail;
        // Cập nhật hình ảnh
        $product->hinhanh = json_encode($hinhCu); // Sử dụng $hinhCu thay vì $mang_hinhAnh
        $product->save(); 


       return redirect()->back()->with('success', __('update successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Products::where('id',$id)->delete();
        return redirect('/Frontend/Client/Product');
    }
}
