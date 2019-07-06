@extends('layouts.admin.admin_layout')
@section('main_content')
	    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-md-7">
        {{-- San Pham
        <small>advanced tables</small> --}}
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Tables</a></li>
              <li class="active">Product Type</li>
            </ol>
        </div>
        <div class="col-md-5">
           <form action="admin/product/ajax/search" method="Get">
            {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
             <div class="input-group">
              <input type="text" name="keyword" id="search-box" placeholder="Search..." class="form-control">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </span>
            </div>
           </form>
            
        </div>
      </div>
    </section>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
          @foreach ($errors ->all() as $err)
              {{$err}}<br>
          @endforeach
        </div>
    @endif
    @if(session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}}

        </div>
    @endif
    @if(session('loi'))
        <div class="alert alert-danger">
            {{session('loi')}}

        </div>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Products List</h3>
              <a href="admin/product/add" class="admin_btn_add btn btn-success">Add A New Product</a>
              <a href="admin/product/test" class="admin_btn_add btn btn-success">Test date time</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="product-table">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Category</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                  <tr>
                  	<td>{{$product->id}}</td>
                  	<td><img src="upload/product/{{$product->productimg->first()["name"]}}" width="100px"></td>
                  	<td><a href="admin/product/view/{{$product->id}}">{{$product->name}}</a></td>
                  	<td>{{$product->product_type->name}}</td>
                  	<td>{{$product->product_type->category->name}}</td>
                    <td><i class="fa fa-pencil"></i> <a href="admin/product/edit/{{$product->id}}">Edit</a></td>
                    <td><i class="fa fa-trash-o"></i> <a href="admin/product/del/{{$product->id}}" onclick="return confirm('Ban co muon xoa danh muc nay khong?')">Delete</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$products->links()}}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
@section('script')
{{--   <script type="text/javascript">
    $(document).ready(function(){
            //alert('Đã chạy ngon');
            $("#search-box").change(function(){
                //lấy chính giá trị của thể loại
                var keyword=$(this).val();
               // alert(idTheLoai);
               //gọi trang ajax lên ,trang ajax tạo trong route
                $.get("admin/product/ajax/search/"+keyword,function(data){
                    $("#product-table").html(data);
                });
            });
        });
  </script> --}}
@endsection