@extends('layouts.admin.admin_layout')
@section('main_content')

<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Banner</h3>
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
          <form role="form" action="admin/slide/edit/{{$banner->id}}" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>News</label>
                        <select class="form-control" name="news_id">
                            @foreach($news as $n)
                                <option value="{{$n->id}}" @if($n->id == $banner->news_id) {{'selected'}} @endif>{{$n->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label>Banner Image (1920x530)</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
            </div>
            @if($banner->image != '')
                <div class="img_block">
                    <img src="upload/slide/{{$banner->image}}" width="120px">
                </div>
            @endif
            <br>
            <a href="admin/slide/danhsach-banner"><button type="button"class="btn btn-danger">Cancel</button></a>
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