<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{count($bills)}}</h3>
                <p>Today New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <div class="small-box-footer" id="show-orders">Show <i class="fa fa-arrow-circle-right"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>@money($report->gross_revenue)</h3>
                <p>Today Revenue</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
             <div class="small-box-footer" id="show-report">Show <i class="fa fa-arrow-circle-right"></i></div>
        </div>
    </div>
{{--     <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{count($users)}}</h3>
                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
             <div class="small-box-footer" id="show-users">Show <i class="fa fa-arrow-circle-right"></i></div>
        </div>
    </div> --}}
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{count($topProducts)}}</h3>
                <p>Top Products</p>
            </div>
            <div class="icon">
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
             <div class="small-box-footer" id="show-products">Show <i class="fa fa-arrow-circle-right"></i></div>
        </div>
    </div>
</div>