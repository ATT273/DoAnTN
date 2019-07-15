@extends('layouts.admin.admin_layout')
@section('main_content')
<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Category</h3>
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
        @if(session('loi'))
            <div class="alert alert-danger">
                {{session('loi')}}
            </div>
        @endif
        <div class="box-body">
          
          <form role="form" action="admin/category/edit/{{$category->id}}" method="POST">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label>Category- {{$category->name}}</label>
              <input type="text" class="form-control" placeholder="New Category here" name="category" value="{{$category->name}}">
            </div>
            <a href="admin/category/danhsach-danhmuc"><button type="button"class="btn btn-danger">Cancel</button></a>
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