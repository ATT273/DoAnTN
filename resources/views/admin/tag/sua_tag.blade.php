@extends('layouts.admin.admin_layout')
@section('main_content')
<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Tag</h3>
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
          
          <form role="form" action="admin/tag/edit/{{$tag->id}}" method="POST">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label>Tag - {{$tag->name}}</label>
              <input type="text" class="form-control" name="tag" value="{{$tag->name}}">
            </div>
             <button type="reset" class="btn btn-danger">Cancel</button>
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-success">Update</button>
          </form>
        </div>
        <!-- /.box-body -->
    </div>
</section>
@endsection