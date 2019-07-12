@extends('layouts.admin.admin_layout')
@section('main_content')
<section class="content-header">
      <div class="row">
        <div class="col-md-7">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Users</li>
            </ol>
        </div>
        <div class="col-md-5">
            <form action="admin/user/search" method="Get">
                <div class="input-group">
                    <input type="text" name="keyword" id="search-box" placeholder="Search..." class="form-control">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    </section>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users List</h3>
              <a href="admin/users/add" class="admin_btn_add btn btn-success">Add A New User</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td><a href="admin/user/p/{{$user->id}}">{{$user->username}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->gender}}</td>
                    <td>{{$user->role}}</td>
                    <td><i class="fa fa-pencil"></i> <a href="admin/users/edit/{{$user->id}}">Edit</a></td>
                    <td><i class="fa fa-trash-o"></i> <a href="admin/users/del{{$user->id}}">Delete</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$users->links()}}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection