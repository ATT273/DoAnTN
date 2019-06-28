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
          <form role="form" action="admin/product/edit/{{$product->id}}" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="product_name" value="{{$product->name}}">
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
              <input type="text" class="form-control"  name="product_unit" value="{{$product->unit}}">
            </div>
            <div class="form-group">
              <label>Price</label>
              <input type="text" class="form-control"  name="product_price" value="{{$product->price}}">
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <input type="text" class="form-control"  name="product_qty" value="{{$product->quantity}}">
            </div>
            <div class="form-group">
              <label>Promo Price</label>
              <input type="text" class="form-control"  name="product_promo" value="{{$product->promo_price}}">
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea id="demo" name="product_desc" class="ckeditor form-control" rows="10" cols="80" value="">{{$product->description}}</textarea>
            </div>
            <div class="form-group">
              <label>Tags</label>
              <select name="tag[]" class="form-control select2-tag" multiple="multiple">
                @foreach($tags as $tag)
                  <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Images</label>
              <input type="file" name="product_img[]" multiple class="form-control">
            </div>
            <div class="product_img_edit">
                @foreach($images as $img)
                
	              	<div class="img_block">
	                <img src="upload/product/{{$img->name}}" width="120px">
	                <div class="img_del">
	                  <a href="admin/img_product/del/{{$img->id}}" onclick="return confirm('Do you wanna delete this image?')"><i class="fa fa-times" aria-hidden="true"></i></a>
	                </div>
	              	</div>
            
              	@endforeach
          	</div>
            
            <a href="admin/product/danhsach-sp"><button type="button"class="btn btn-danger">Cancel</button></a>
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
@section('script')
 <script type="text/javascript">
   $(document).ready(function(){
      $('.select2-tag').select2();
      $('.select2-tag').select2().val({!! json_encode($product->tag()->allRelatedIds()) !!}).trigger('change');
   });
 </script>
@endsection