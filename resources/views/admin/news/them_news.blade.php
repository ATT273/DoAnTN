@extends('layouts.admin.admin_layout')
@section('main_content')

<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Add A New News</h3>
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
          <form role="form" action="admin/news/add" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" placeholder="Title ..." name="title">
            </div>
            <div class="form-group">
              <label>Content</label>
              <textarea id="demo" name="content" class="ckeditor form-control" rows="10" cols="80"></textarea>
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" class="form-control" name="image">
            </div>
            <button type="submit" class="btn btn-success">Add</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </form>
        </div>
        <!-- /.box-body -->
  	</div>
</section>
@endsection