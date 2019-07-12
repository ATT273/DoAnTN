@extends('layouts.admin.admin_layout')
@section('main_content')

<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Add A New Banner</h3>
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
          <form role="form" action="admin/slide/add" method="POST" enctype="multipart/form-data">
            <!-- text input -->
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
            	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            		<div class="form-group">
						<label>News</label>
						<select class="form-control" name="news_id">
							@foreach($news as $n)
								<option value="{{$n->id}}">{{$n->title}}</option>
							@endforeach
						</select>
            		</div>
            	</div>
            	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		            <div class="form-group">
						<label>Banner Image (1920x530)</label>
						<input type="file" class="form-control" name="image[]" required>
		            </div>
            	</div>
            </div>
            <button type="submit" class="btn btn-success">Add</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </form>
        </div>
        <!-- /.box-body -->
  	</div>
</section>
@endsection