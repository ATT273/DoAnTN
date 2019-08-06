@extends('layouts.admin.admin_layout')
@section('main_content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="row">
        <div class="col-md-7">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Bill</li>
            </ol>
        </div>
        <div class="col-md-5">
        </div>
    </div>
</section>
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
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bills List</h3>
              {{-- <a href="admin/promo_code/add" class="admin_btn_add btn btn-success">Add A New Promo Code</a> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Order Date</th>
                    <th>Customer</th>
                    <th>Confirmation</th>
                    <th>Transfer Status</th>
                    <th>Payment Status</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($bills as $bill)
                  <tr>
                    <td><a href="admin/bill/detail/{{$bill->id}}">{{$bill->id}}</a></td>
                    <td>{{$bill->order_date}}</td>
                    <td><a href="admin/user/p/{{$bill->user->id}}">{{$bill->user->name}}</a></td>
                    <td>
                      @if($bill->confirmation == 0)<i class="fa fa-check status-default" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Chua xac nhan"></i>@endif
                      @if($bill->confirmation == 1)<i class="fa fa-check status-success" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Da xac nhan"></i>@endif
                    </td>
                    <td>
                      @if($bill->transfer_status == 0)<i class="fa fa-truck status-default fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Chua van chuyen"></i>@endif
                      @if($bill->transfer_status == 1)<i class="fa fa-truck status-success fa-lg" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Dang van chuyen">@endif
                    </td>
                    <td>
                      @if($bill->payment_status == 0)<i class="fa fa-credit-card status-default" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Chua thanh toan"></i>@endif
                      @if($bill->payment_status == 1)<i class="fa fa-credit-card status-success" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Da thanh toan"></i>@endif
                    </td>
                    <td>@money($bill->total)</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$bills->links()}}
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
    <!-- /.content -->
  @endsection
  @section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    });
    
  </script>
  @endsection