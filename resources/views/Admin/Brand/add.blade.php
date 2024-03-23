@extends('Admin.Layouts.app')
@section('content')
 <h1>add brand</h1>
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal form-material" action="{{route('Admin.brand.add.post')}}" method='Post' enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                   <label class="col-md-12">Title</label>
                   <div class="col-md-12">
                        <input type="text" class="form-control form-control-line"  name="name"
                        >
                   </div>
               </div>
               <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success" >Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 
@endsection