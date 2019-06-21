@extends('layouts.admin.admin_layout')
@section('main_content')
	    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{-- San Pham
        <small>advanced tables</small> --}}
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Product Type</li>
        </ol>
      </h1>
      
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
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}

        </div>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Category List</h3>
              <a href="admin/product_type/add" class="admin_btn_add btn btn-success">Add A New Product Type</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Type Name</th>
                    <th>Category</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($prtypes as $type)
                  <tr>
                    <td>{{$type->id}}</td>
                    <td>{{$type->name}}</td>
                    <td>{{$type->category->name}}</td>
                    <td><i class="fa fa-pencil"></i> <a href="admin/product_type/edit/{{$type->id}}">Edit</a></td>
                    <td><i class="fa fa-trash-o"></i> <a href="admin/product_type/del/{{$type->id}}" onclick="return confirm('Ban co muon xoa danh muc nay khong?')">Delete</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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