<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blog = Blog::all()->toArray();
        //dd($blog);
        return view('Admin.Blog.list',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('Admin.Blog.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        // dd($data);
        $file = $request->image;
        //dd($file);
       
        //nếu có ảnh đưa lên thì đưa tên của ảnh vào mảng data và đưa vào đường dẫn upload/Admin/blog/img;
        if(!empty($file)){
            $data['image'] = $file->getClientOriginalName();
            //dd($data['image']);
        }
        
        //ínsert toàn bộ vào database
        
        $blog = new Blog();
        // dd($blog);

        if($blog::create($data)){
            //dd($blog::create($data));
             //nếu có file thì đưa vào đường dẫn với tên file
             if(!empty($file)){
                 $file->move('upload/Admin/blog/img', $file->getClientOriginalName());
             }
             // trả về trang blog với thông báo: thêm thành công
             return redirect('/Admin/Blog')->with('success',_('thêm thành công'));
        }else{
             return redirect('/Admin/Blog')->back()->with('error',_('thêm không thành công'));
        }
   
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
         $blogID = Blog::where('id',$id)->get();
         // dd($blogID);
        return view ('Admin.Blog.edit',compact('blogID'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->all();
        //dd($data);
         $file = $request->image;
        //dd($file);

    //nếu có ảnh đưa lên thì đưa tên của ảnh vào mảng data và đưa vào đường dẫn upload/Admin/blog/img;
        if(!empty($file)){
            $data['image'] = $file->getClientOriginalName();
            //dd($data['image']);
        }
        
        //update toàn bộ vào database( thay Eloquent)
        
        $blog = Blog::find($id);
        // dd($blog);

        if($blog->update($data)){
            
             //nếu có file thì đưa vào đường dẫn với tên file
             if(!empty($file)){
                 $file->move('upload/Admin/blog/img', $file->getClientOriginalName());
             }
             // trả về trang blog với thông báo: thêm thành công
             return redirect('/Admin/Blog')->with('success',_('chỉnh sửa thành công'));
        }else{
             return redirect()->back()->with('error',_('chỉnh sửa không thành công'));
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Blog::where('id',$id)->delete();
        return redirect('/Admin/Blog');
    }
}
