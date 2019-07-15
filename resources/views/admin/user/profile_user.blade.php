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
        </div>
        <!-- About Me Box -->
 {{--        <div class="box box-primary">
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
        </div> --}}
    <!-- /.box -->
    </div>
<!-- /.col -->
    <div class="col-md-9">
        <div class="box box-success">
            <div class="box-body">
                @if(count($bills) > 0)
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Create Date</th>
                                <th>Confirmation</th>
                                <th>Transfer status</th>
                                <th>Payment status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bills as $bill)
                                <tr>
                                    <td>{{$bill->id}}</td>
                                    <td>{{$bill->order_date}}</td>
                                    <td>
                                        @if($bill->confirmation == 0){{'Chua xac nhan'}}@endif
                                        @if($bill->confirmation == 1){{'Da xac nhan'}}@endif
                                    </td>
                                    <td>
                                        @if($bill->transfer_status == 0){{'Chua gui'}}@endif
                                        @if($bill->transfer_status == 1){{'Da gui'}}@endif
                                    </td>
                                    <td>
                                        @if($bill->payment_status == 0){{'Chua'}}@endif
                                        @if($bill->payment_status == 1){{'Da thanh toan'}}@endif
                                    </td>
                                    <td>@money($bill->total)</td>
                                    <td><i class="fa fa-search"></i> <a href="admin/bill/detail/{{$bill->id}}">Detail</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    {{'Ban chua co don hang nao'}}
                @endif
            </div>
        </div>
    </div>
</div>
</section>
@endsection