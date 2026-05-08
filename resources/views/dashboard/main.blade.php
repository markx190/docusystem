<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top: 50px;">
    <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                <!-- <h1 class="m-0 text-dark">Dashboard</h1> -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<main class="subs">
    <div class="container-fluid"> 
        <div class="row charts-docs">
            <div class="col-xl-12 ">
            <div class="card mb-4">  
            <div class="card-header subscription-h">
        <i class="fa fa-database"></i>
    Dashboard
</div> 
<div class="card-body docs-body">
    <div class="row">
    @if($user->account_type == 'Administrator')

    <div class="col-lg-3 col-6">
        <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $transCount }}</h3>
                    <p>Transactions</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-calculator "></i>
                </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-lg-3 col-6">
        <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $itemsCount }}</h3>
                        <p>Items</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                <a href="/manage_items" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        {{-- <div class="col-lg-3 col-6">
            <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>3</h3>
                        <p>Customers</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}
        {{-- <div class="col-lg-3 col-6">
            <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>3</h3>
                        <p>Sellers</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-android-contact"></i>
                    </div>
                <a href="/manage_transactions" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}
        @endif  

        @if($user->account_type == 'Admin')
        <div class="col-lg-3 col-6">
                <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>120</h3>
                                <p>Announcements</p>
                            </div>
                        <div class="icon">
                        <i class="ion ion-android-desktop"></i>
                    </div>
                <a href="/manage_transactions" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endif  

        @if($user->account_type == 'Admin')
        <div class="col-lg-3 col-6">
                <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>3,000,000.00</h3>
                                <p>SALES</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-calculator"></i>
                            </div>
                            <a href="/vcashonline/manage_transactions" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
        </div>
        @endif

                            </div>
                            
                            <div class="row mt-4">
    <!-- Donut Chart -->
    <div class="col-lg-6 col-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-pie"></i> Transactions Overview
            </div>
            <div class="card-body">
                <canvas id="transactionDonut" style="height:250px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Bar Chart -->
    <div class="col-lg-6 col-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-bar"></i> Items 
            </div>
            <div class="card-body">
                <canvas id="itemsBarChart" style="height:250px;"></canvas>
            </div>
        </div>
    </div>
</div>


                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .btn-group-xs > .btn, .btn-xs {
        padding: .25rem .4rem;
        font-size: .875rem;
        line-height: .5;
        border-radius: .2rem;
    }
    .t-th {
        font-size: 14px;
        font-family: "Montserrat", sans-serif;
        text-transform: uppercase;
        background-color: #BFBFBF;
        height: 2.3em;
        white-space: nowrap; 
    }
    .center {
        display: block;
        margin-left: auto;
        margin: auto;
        width: 100%;
    }  
    .subscription-h {
        background-color: #BFBFBF;
    }
    td { 
        white-space: nowrap; 
    }
</style>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
<script src="/admin_lte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/admin_lte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/admin_lte/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Donut Chart
    var ctxDonut = document.getElementById('transactionDonut').getContext('2d');
    var transactionDonut = new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending'],
            datasets: [{
                label: 'Transactions',
                data: [{{ $completedTrans }}, {{ $pendingTrans }}],
                backgroundColor: ['#28a745', '#ffc107'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.raw;
                        }
                    }
                }
            }
        }
    });

    // Bar Chart
    var ctxBar = document.getElementById('itemsBarChart').getContext('2d');
    var itemsBarChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: [
                @foreach($vItems as $item)
                    '{{ $item->item_name }}',
                @endforeach
            ],
            datasets: [{
                label: 'Orders per Item',
                data: [
                    @foreach($vItems as $item)
                        {{ $item->count }},
                    @endforeach
                ],
                backgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { title: { display: true, text: 'Item Name' }, ticks: { autoSkip: false } },
                y: { beginAtZero: true, title: { display: true, text: 'Number of Orders' } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

});
</script>


