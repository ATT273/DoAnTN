@extends('layouts.admin.admin_layout')
@section('main_content')
<section class="content-header">
	<h1>
		User Profile
	</h1>
</section>
<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              
              <h3 class="profile-username text-center">{{$user->username}}</h3>

              <p class="text-muted text-center">
              		@if($user->role ==0)
						{{'Khach hang '}}
					@elseif($user->role == 1)
						{{'Admin'}}
					@endif
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Name:</b> &nbsp <a>{{$user->name}}</a>
                </li>
                <li class="list-group-item">
                  <b>Email:</b> &nbsp <a>{{$user->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Address:</b> &nbsp <a>{{$user->address}}</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
        <div class="box-body">
        	@if(count($bills) > 0)
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Create Date</th>
                    <th>Payment status</th>
                    <th>Transfer status</th>
                    <th>Total</th>
                    
                  </tr>
                </thead>
                <tbody>
                  {{-- @foreach($category as $cate)
                  <tr>
                    <td>{{$cate->id}}</td>
                    <td>{{$cate->name}}</td>
                    <td>{{$cate->lowcase_name}}</td>
                    <td><i class="fa fa-pencil"></i> <a href="admin/category/edit/{{$cate->id}}">Edit</a></td>
                    <td><i class="fa fa-trash-o"></i> <a href="admin/category/del/{{$cate->id}}" onclick="return confirm('Ban co muon xoa danh muc nay khong?')">Delete</a></td>
                  </tr>
                  @endforeach --}}
                </tbody>
              </table>
            @else
            	{{'Ban chua co don hang nao'}}
            @endif
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>

@endsection