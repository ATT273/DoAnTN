@extends('layouts.admin.admin_layout')
@section('main_content')

<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Promo Code</h3>
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
          <form role="form" action="admin/promo_code/edit/{{$code->id}}" method="POST">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label>Promo Code</label>
              <input type="text" class="form-control" value="{{$code->name}}" name="code_name">
            </div>
            <div class="form-group">
              <label>Type</label>
              <select name="code_type" class="form-control">
              	<option value="1" @if($code->fixed != 0 ){{'selected'}}@endif>Fixed (VND)</option>
              	<option value="2" @if($code->percentage != 0 ){{'selected'}}@endif>Percentage (%)</option>
              </select><br>
              <input type="text" class="form-control" placeholder="Enter discount amount" 
              		value=" @if($code->fixed != 0 ){{$code->fixed}}@endif
              		@if($code->percentage != 0 ){{$code->percentage}}@endif" name="code_discount">
            </div>
            <div class="form-group">
              <label>Expiration Date</label>
              <input type="date" class="form-control" name="code_exp_date" value="{{$code->expiration_date}}">
            </div>
            <a href="admin/promo_code/danhsach-code"><button type="button"class="btn btn-danger">Cancel</button></a>
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