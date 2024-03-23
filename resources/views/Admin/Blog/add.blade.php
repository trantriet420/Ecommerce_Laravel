@extends('Admin.Layouts.app')
@section('content')
 <h1>add blog</h1>
    <div class="card">
        <div class="card-body">
          <!-- thông báo cập nhật thành công -->
                    @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                    @endif
                    
                    <!-- thông báo cập nhật thất bại -->
                    @if(session('error'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('error')}}
                            </div>
                    @endif
            <form class="form-horizontal form-material" action="{{route('Admin.Blog.add.post')}}" method='Post' enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                   <label class="col-md-12">Title</label>
                   <div class="col-md-12">
                        <input type="text" class="form-control form-control-line"  name="name"
                        >
                   </div>
               </div>
               <div class="form-group">
                   <label class="col-md-12">Image</label>
                   <div class="col-md-12">
                        <input type="file" class="form-control form-control-line"  name="image"
                        >
                   </div>
               </div>
               <div class="form-group">
                   <label class="col-md-12">Description</label>
                   <div class="col-md-12">
                        <input type="text" class="form-control form-control-line"  name="desciption"
                        >
                   </div>
               </div>
               <div class="form-group">
                   <label class="col-md-12">Content</label>
                   <div class="col-md-12">
                        <textarea class="form-control form-control-line" name="content" id="blog_add"></textarea>
                   </div>
               </div>
               <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success" >Create Blog</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 
@endsection