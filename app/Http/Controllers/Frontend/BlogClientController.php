<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\Models\Rate;
use Illuminate\Support\Facades\DB;
use App\Models\Comments;
use Image;



class BlogClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        //$blogList = Blog::paginate(3)->toArray(); // khi sử dụng phương thức toArray() với paginate(),  cần truy cập vào key 'data' để lấy dữ liệu và key 'links' để hiển thị các liên kết phân trang.

        //dd( $blogList['data']);

         $blogList = Blog::paginate(3);
        return view ('Frontend.Blog.blogList',compact('blogList'));
    }


    /**
     * Display the specified resource.
     */
    public function single(string $id)
    {
        
        $singleBlog = Blog::find($id)->toArray();
        //dd($singleBlog);

        // xử lí nút pre
        $preBlog = Blog::where('id','<', $id)->max('id');
        //dd($preBlog);

        //xử lí nút next
        $nextBlog = Blog::where('id','>', $id)->min('id');
        //dd($nextBlog);


        //Tính điểm trung bình cộng của lượt đánh giá
        /**
         * b1: viết một vòng for in ra 5 ngôi sao tại view blog single để tính trung bình cộng
           b2: viết sql lấy tất cả các điểm đánh giá(rate) của bảng rate-lấy id và trả về 1 mảng
           b3: tính trung bình cộng
         */
          
          $rating = Rate::where('id_blog', $id)->get()->toArray();
          //dd($rating);

          $so_diem_danh_gia = 0;
          $so_luot_danh_gia = count($rating);
          //dd($so_luot_danh_gia);

          foreach($rating as $Rating)
          {
            $so_diem_danh_gia += $Rating['rate'];
            //dd($so_diem_danh_gia);
          }

          $tbc = 0;
          if( $so_luot_danh_gia > 0 )
          {
            $tbc = $so_diem_danh_gia/$so_luot_danh_gia;
          }
          //dd($tbc);

        /** 
            Comment
            viết sql lấy mảng ra truyền vào view blogDetail
         */

        $commnts_Blog = Comments::where('id_blog', $id)->get()->toArray();
        //dd($commnts_Blog);


        return view ('Frontend.Blog.blogDetail',compact('singleBlog','preBlog','nextBlog','tbc','commnts_Blog'));
    }

    /**
     * rate: xử lí ajax ở controller
     */

    public function rate (Request $request)
    {
        $userId = Auth::id();

        
        // $rate = DB::table('rate')->insert([ // dùng DB fades
        //     'rate'=>$request->rate,
        //     'id_blog'=>$request->id_blog,
        //     'id_user'=>Auth::id(),
        // ]);

        $rate = new Rate; // Sử dụng model Rate
        $rate->rate = $request->rate;
        $rate->id_blog = $request->id_blog;
        $rate->id_user = $userId;
        $rate->save();
        return response()->json(['msg' =>  'bạn đã đánh giá thành công']);
       
        
    }

    public function comment (Request $request)
    {
        $userId = Auth::id();
        $userAvatar = Auth::user()->avatar;
        $userName = Auth::user()->name;

        $comments_insert = Comments::insert([
             'comment' =>$request->message,
             'id_blog' =>$request->id_blog,
             'id_user' =>Auth::id(),
             'avatar'  =>Auth::user()->avatar,
             'name'    =>Auth::user()->name,
             'level'   =>$request->level,
        ]);

        return redirect()->back()->with('success', __('bình luận thành công.'));
    }
   
}
