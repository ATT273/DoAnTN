@extends('layouts.admin.admin_layout')
@section('main_content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="row">
        <div class="col-md-7">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Slide</li>
            </ol>
        </div>
        <div class="col-md-5">
            <form action="admin/slide/ajax/search" method="Get">
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
              <h3 class="box-title">Banner List</h3>
              <a href="admin/slide/add" class="admin_btn_add btn btn-success">Add A New Banner</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="60">ID</th>
                    <th width="200">Banner Image</th>
                    <th width="200">News</th>
                    <th>Excerpt</th>
                    <th width="80">Edit</th>
                    <th width="80">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($banners as $banner)
                  <tr>
                    <td width="60">{{$banner->id}}</td>
                    <td width="200">
                      @if($banner->image != '')
                        <img src="upload/slide/{{$banner->image}}" width="200px" />
                      @else
                        No picture
                      @endif
                    </td>
                    <td width="200">{{$banner->news->title}}</td>
                    <td>@excerpt($banner->news->content)</td>
                    <td width="80"><i class="fa fa-pencil"></i> <a href="admin/slide/edit/{{$banner->id}}">Edit</a></td>
                    <td width="80"><i class="fa fa-trash-o"></i> <a href="admin/slide/del/{{$banner->id}}" onclick="return confirm('Ban co muon xoa danh muc nay khong?')">Delete</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endsection