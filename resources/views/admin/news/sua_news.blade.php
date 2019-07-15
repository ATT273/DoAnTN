@extends('layouts.admin.admin_layout')
@section('main_content')

<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Edit News</h3>
        </div>
        <!-- /.box-header -->
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
        <div class="box-body">
          <form role="form" action="admin/news/edit/{{$news->id}}" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" value="{{$news->title}}" name="title">
            </div>
            <div class="form-group">
              <label>Content</label>
              <textarea id="demo" name="content" class="ckeditor form-control" rows="10" cols="80">{{$news->content}}</textarea>
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" class="form-control" placeholder="New Category here" name="image">
            </div>
            @if($news->image != '')
            	<div class="img_block">
	                <img src="upload/news/{{$news->image}}" width="120px">
	                <div class="img_del">
	              		<a href="admin/news/delImage/{{$news->id}}" onclick="return confirm('Do you wanna delete this image?')"><i class="fa fa-times" aria-hidden="true"></i></a>
	                </div>
              	</div>
            @endif
            <br>
            <a href="admin/news/danhsach-news"><button type="button"class="btn btn-danger">Cancel</button></a>
            &nbsp;
            <button type="reset" class="btn btn-default">Reset</button>
            &nbsp;
            <button type="submit" class="btn btn-success">Update</button>
          </form>
        </div>
        <!-- /.box-body -->
  	</div>
</section>
@endsection