@extends('layouts.admin.admin_layout')
@section('main_content')

    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="row">
        <div class="col-md-7">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">News</li>
            </ol>
        </div>
        <div class="col-md-5">
            <form action="admin/news/search" method="Get">
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
          		<h3 class="box-title">News List</h3>
              	<a href="admin/news/add" class="admin_btn_add btn btn-success">Add A News</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="60">ID</th>
                    <th width="200">Image</th>
                    <th>Title</th>
                    <th width="60">Edit</th>
                    <th width="60">Delete</th>
                  </tr>
                </thead>
                <tbody>
					@foreach($news as $n)
					<tr>
					<td>{{$n->id}}</td>
					<td>
						@if($n->image != '')
							<img src="upload/news/{{$n->image}}" width="200px" />
						@else
							No picture
						@endif
					</td>
					<td>{{$n->title}}</td>
					<td width="100"><i class="fa fa-pencil"></i> <a href="admin/news/edit/{{$n->id}}">Edit</a></td>
					<td width="100"><i class="fa fa-trash-o"></i> <a href="admin/news/del/{{$n->id}}" onclick="return confirm('Ban co muon xoa muc nay khong?')">Delete</a></td>
					</tr>
					@endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
@endsection