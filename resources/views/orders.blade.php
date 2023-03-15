@extends('layouts.master')

@section('title')
Orders
@endsection

@section('css')
@endsection
@section('searchField')
<div class="search-bar">
    <form class="search-form d-flex align-items-center" method="get" action="{{ route('orderSearch') }}">
        <input type="text" name="query" placeholder="Search Company" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
</div>
@endsection
@section('content')
<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Companies info table -->
                <div class=" table-responsive table-responsive-lg text-nowrap">
                    <table class="table datatable dataTable-table table-hover table-striped">

                        <thead>
                            <tr>
                                <th class="  p-2" >
                                    <a href="#" class=" m-2">#</a>
                                </th>

                                <th class="  p-2" >
                                    <a href="#" class=" m-2">Company</a>
                                </th>

                                <th class="  p-2" >
                                    <a href="#" class=" m-2">delivery Guy</a>
                                </th>

                                <th class="  p-2" >
                                    <a href="#" class=" m-2">is Paid</a>
                                </th>

                                <th class="  p-2" >
                                    <a href="#" class=" m-2">delivary Fees</a>
                                </th>

                                <th class="  p-2" >
                                    <a href="#" class=" m-2">status</a>
                                </th>

                                <th class="  p-2" >
                                    <a href="#" class="text-center m-2">Address</a>
                                </th>


                                <th class="  p-2" >
                                    <a href="#" class=" m-2">totalPrice</a>
                                </th>
                                <th class="  p-2" >
                                    <a href="#" class=" text-center m-2">orderDate</a>
                                </th>
                                <th class="  p-2" >
                                    <a href="#" class=" m-2">clientName</a>
                                </th>
                                <th class="  p-2" >
                                    <a href="#" class=" m-2">client Phone</a>
                                </th>
                                <th class="  p-2" >
                                    <a href="#" class=" m-2">invoice Code</a>
                                </th>


                            </tr>
                        </thead>


                        <tbody class="table-striped" id="tb">
                            @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ ++$count }}</th>
                                <td>{{ $order->company->name}}</td>
                                <td>{{ isset($order->delivery) ? $order->delivery->name : '.NO.' }}</td>
                                <td>{{ $order->isPaid }}</td>
                                <td>{{ $order->delivaryFees }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->city }} _ {{ $order->street }}</td>
                                <td>{{ $order->totalPrice }}</td>
                                <td>{{ $order->orderDate }}</td>
                                <td class="text-center">{{ $order->clientName }}</td>
                                <td>{{ $order->clientPhone }}</td>
                                <td class="text-center">{{ $order->invoiceCode }}</td>
                            </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div><!-- End companies info table -->

                <!-- Reports -->
                <div class="col-12">
                    <div class="card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Orders <span>/Today</span></h5>

                            <!-- Line Chart -->
                            <div id="reportsChart" class=" overflow-hidden"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#reportsChart"), {
                                        series: [{
                                            name: 'orders waiting',
                                            data: [31, 40, 28, 51, 42, 82, 56],
                                        }, {
                                            name: 'orders delivered',
                                            data: [11, 32, 45, 32, 34, 52, 41]
                                        }, {
                                            name: 'orders cancelsd',
                                            data: [15, 11, 32, 18, 9, 24, 11]
                                        }],
                                        chart: {
                                            height: 350,
                                            type: 'area',
                                            toolbar: {
                                                show: false
                                            },
                                        },
                                        markers: {
                                            size: 4
                                        },
                                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                        fill: {
                                            type: "gradient",
                                            gradient: {
                                                shadeIntensity: 1,
                                                opacityFrom: 0.3,
                                                opacityTo: 0.4,
                                                stops: [0, 90, 100]
                                            }
                                        },
                                        dataLabels: {
                                            enabled: false
                                        },
                                        stroke: {
                                            curve: 'smooth',
                                            width: 2
                                        },
                                        xaxis: {
                                            type: 'datetime',
                                            categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z",
                                                "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z",
                                                "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                                                "2018-09-19T06:30:00.000Z"
                                            ]
                                        },
                                        tooltip: {
                                            x: {
                                                format: 'dd/MM/yy HH:mm'
                                            },
                                        }
                                    }).render();
                                });
                            </script>
                            <!-- End Line Chart -->

                        </div>

                    </div>

                    <!-- Budget Report -->
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body pb-0">
                            <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                            <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                        legend: {
                                            data: ['Allocated Budget', 'Actual Spending']
                                        },
                                        radar: {
                                            // shape: 'circle',
                                            indicator: [{
                                                    name: 'Sales',
                                                    max: 6500
                                                },
                                                {
                                                    name: 'Administration',
                                                    max: 16000
                                                },
                                                {
                                                    name: 'Information Technology',
                                                    max: 30000
                                                },
                                                {
                                                    name: 'Customer Support',
                                                    max: 38000
                                                },
                                                {
                                                    name: 'Development',
                                                    max: 52000
                                                },
                                                {
                                                    name: 'Marketing',
                                                    max: 25000
                                                }
                                            ]
                                        },
                                        series: [{
                                            name: 'Budget vs spending',
                                            type: 'radar',
                                            data: [{
                                                    value: [4200, 3000, 20000, 35000, 50000, 18000],
                                                    name: 'Allocated Budget'
                                                },
                                                {
                                                    value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                    name: 'Actual Spending'
                                                }
                                            ]
                                        }]
                                    });
                                });
                            </script>

                        </div>
                    </div><!-- End Budget Report -->
                </div><!-- End Reports -->

            </div>
        </div><!-- End Left side columns -->

    </div>
</section>
@endsection

@section('script')

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('928555a600410d91f730', {
        cluster: 'eu',
        encrypted: true
    });

    var channel = pusher.subscribe('channel-order');
    channel.bind('App\\Events\\ayNela', function(data) {
        // alert(JSON.stringify(data));
        // location.reload();
        let flag = "{{ isset($orders[0]) ? $orders[0]['status'] : 'not' }}" === 'waiting';
        if (flag) {
            console.log(1);
            loadTb(JSON.stringify(data));
        }
    });

    // data is json string
    function loadTb(data) {
        let tb = document.getElementById("tb");
        let info = JSON.parse(data);
        console.log(data);
        tb.innerHTML += `
        <tr>
            <th scope="row">{{ ++$count }}</th>
            <td>${info.companyId}</td>
            <td>...</td>
            <td>${info.isPaid}</td>
            <td>${info.delivaryFees}</td>
            <td>waiting</td>
            <td>${info.city}</td>
            <td>${info.street}</td>
            <td>${info.buildingNumber}</td>
            <td>${info.floorNumber}</td>
            <td>${info.apartmentNumber}</td>
            <td>${info.totalPrice}</td>
            <td>${info.orderDate}</td>
            <td>${info.clientName}</td>
            <td>${info.clientPhone}</td>
            <td>${info.invoiceCode}</td>
        </tr>
        `;

    }
</script>

@endsection
