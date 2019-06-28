@extends('layouts.admin.admin_layout')
@section('main_content')

<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Add A New Promo Code</h3>
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
          <form role="form" action="admin/promo_code/add" method="POST">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label>Promo Code</label>
              <input type="text" class="form-control" placeholder="New Promo Code here" name="code_name">
            </div>
            <div class="form-group">
              <label>Type</label>
              <select name="code_type" class="form-control">
              	<option value="1">Fixed (VND)</option>
              	<option value="2">Percentage (%)</option>
              </select><br>
              <input type="text" class="form-control" placeholder="Enter discount amount" name="code_discount">
            </div>
            <div class="form-group">
              <label>Expiration Date</label>
              <input type="date" class="form-control" name="code_exp_date">
            </div>
            <button type="submit" class="btn btn-success">Add</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </form>
        </div>
        <!-- /.box-body -->
  	</div>
</section>
@endsection