@extends('layouts.admin.admin_layout')
@section('main_content')

<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Add A New Tag</h3>
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
          <form role="form" action="admin/tag/add" method="POST">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label>Tag</label>
              <input type="text" class="form-control" placeholder="New Tag here" name="tag">
            </div>
            <button type="submit" class="btn btn-default">Add</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </form>
        </div>
        <!-- /.box-body -->
  	</div>
</section>
@endsection