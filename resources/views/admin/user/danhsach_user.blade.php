@extends('layouts.admin.admin_layout')
@section('main_content')
<section class="content-header">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td><a href="admin/user/p/{{$user->id}}">{{$user->username}}</a></td>
                                    <td>{{$user->email}}</td>
                                    <td>@if($user->gender == 1) Male @elseif($user->gender == 0) Female @endif</td>
                                    <td>
                                        @if($user->role == 1) 
                                            Admin 
                                            <a href="admin/user/set-admin/{{$user->id}}"><button type="button" class="btn btn-default pull-right">Set as Customer</button></a> 
                                        @elseif($user->role == 0) 
                                            Customer 
                                            <a href="admin/user/set-admin/{{$user->id}}"><button type="button" class="btn btn-default pull-right">Set as Admin</button></a>
                                        @endif 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
@endsection