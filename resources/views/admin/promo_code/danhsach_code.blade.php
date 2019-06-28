@extends('layouts.admin.admin_layout')
@section('main_content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Promo Code</li>
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
              <h3 class="box-title">Promo Codes List</h3>
              <a href="admin/promo_code/add" class="admin_btn_add btn btn-success">Add A New Promo Code</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Fixed Amount</th>
                    <th>Percentage</th>
                    <th>Expiration Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($pcodes as $pcode)
                  <tr>
                    <td>{{$pcode->id}}</td>
                    <td>{{$pcode->name}}</td>
                    <td>{{$pcode->fixed}}</td>
                    <td>{{$pcode->percentage}}</td>
                    <td>{{$pcode->expiration_date}}</td>
                    <td><i class="fa fa-pencil"></i> <a href="admin/promo_code/edit/{{$pcode->id}}">Edit</a></td>
                    <td><i class="fa fa-trash-o"></i> <a href="admin/promo_code/del/{{$pcode->id}}" onclick="return confirm('Ban co muon xoa danh muc nay khong?')">Delete</a></td>
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