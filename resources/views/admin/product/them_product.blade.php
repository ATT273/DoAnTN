@extends('layouts.admin.admin_layout')
@section('main_content')

<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Add A New Product</h3>
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
          <form role="form" action="admin/product/add" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="product_name">
            </div>
            <div class="form-group">
              <label>Product Type</label>
              <select name="product_type" class="form-control">
              	@foreach($productTypes  as $prtype)
              		<option value="{{$prtype->id}}">{{$prtype->name}}</option>
              	@endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Unit</label>
              <input type="text" class="form-control"  name="product_unit">
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="text" class="form-control"  name="product_price">
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <input type="text" class="form-control"  name="product_qty">
            </div>
            <div class="form-group">
              <label>Promo Price</label>
              <input type="text" class="form-control"  name="product_promo">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea id="demo" name="product_desc" class="ckeditor form-control" rows="10" cols="80"></textarea>
            </div>
            <div class="form-group">
              <label>Images</label>
              <input type="file" name="product_img[]" multiple class="form-control">
            </div>
            <button type="submit" class="btn btn-default">Add</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </form>
        </div>
        <!-- /.box-body -->
  	</div>
</section>
@endsection