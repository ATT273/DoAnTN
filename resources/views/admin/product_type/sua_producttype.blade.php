@extends('layouts.admin.admin_layout')
@section('main_content')

<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Product Type</h3>
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
          <form role="form" action="admin/product_type/edit/{{$prtypes->id}}" method="POST">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label>Category</label>
              <select name="category" class="form-control">
              	@foreach($categories as $cate)
              		<option value="{{$cate->id}}"
              			@if($cate->id == $prtypes->category->id)
              				{{'selected'}}
              			@endif
              		>{{$cate->name}}</option>
              	@endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Product Type</label>
              <input type="text" class="form-control" name="product_type" value="{{$prtypes->name}}">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </form>
        </div>
        <!-- /.box-body -->
  	</div>
</section>
@endsection