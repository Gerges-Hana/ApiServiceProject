@extends('layouts.master')

@section('title')
    Companies
@endsection

@section('css')
@endsection

@section('searchField')
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="get" action="{{ route('companies-search') }}">
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
                    <div class="dataTable-container table-responsive text-nowrap">
                        <table class="table datatable dataTable-table table-hover table-striped ">
                            <thead >
                                <tr>
                                    <th scope="col" data-sortable="" class="m-2 ">
                                        <a class="m-2" href="#">#</a>
                                    </th>
                                    <th scope="col" data-sortable="" class="m-2 ">
                                        <a class="m-2" href="#">Name</a>
                                    </th>
                                    <th scope="col" data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">User Name</a>
                                    </th>
                                    <th scope="col" data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">Email</a>
                                    </th>

                                    <th scope="col" data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">Start Date</a>
                                    </th>
                                    <th scope="col" data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">Delivery Staff</a>
                                    </th>
                                    <th scope="col" data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">Adress</a>
                                    </th>
                                    <th scope="col" data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">Orders</a>
                                    </th>
                                    <th scope="col" data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">Waiting</a>
                                    </th>
                                    <th scope="col" data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">Done</a>
                                    </th>
                                    <th scope="col" data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">On Delivering</a>
                                    </th>
                                    <th scope="col" data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">Delete Company</a>
                                    </th>
                                    <th scope="col"  data-sortable="" class="m-2 text-center">
                                        <a class="m-2" href="#">Company Token </a>
                                    </th>


                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($companies as $comp)
                                    <tr class="">
                                        <th scope="row">{{ $count++ }}</th>
                                        <td>{{ $comp['name'] }}</td>
                                        <td>{{ $comp['userName'] }}</td>
                                        <td>{{ $comp['email'] }}</td>
                                        <td>{{ $comp['created_at'] }}</td>
                                        <td class="text-center">{{ $comp['count'] }}</td>{{--num of delivery --}}
                                        <td>{{ $comp['city'] }} _ {{ $comp['street'] }}</td>
                                        <td class="text-center">{{ $comp['order'] }}</td>{{--num of orders --}}
                                        <td class="text-center">{{ $comp['waiting'] }}</td>
                                        <td class="text-center">{{ $comp['delivered'] }}</td>
                                        <td class="text-center">{{ $comp['onDelivering'] }}</td>
                                        <td class="text-center">
                                            <form class="d-inline" action="{{ url("company/$comp->id") }}" method="POST">
                                                @csrf

                                                @method('DELETE')
                                                <input type="submit" class="btn btn-sm btn-danger" id="delete"
                                                    value="Delete">

                                            </form>

                                            {{-- <button type="button" class="btn btn-danger ">Delete</button> --}}

                                        </td>

                                        <td   class="" >
                                            {{ isset($comp['api_token']) ? $comp['api_token'] : 'apiKey' }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- End companies info table -->

                    <!-- Reports -->
                    <div class="col-12 py-5">
                        <div class="card ">
                            {{-- /// --}}
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                            {{-- /// --}}

                            <div class="card-body ">
                                <h5 class="card-title">Companies <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart" class=" overflow-hidden"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'orders waiting',
                                                data: [31, 40, 28, 51, 42, 82, 56],
                                            }, {
                                                name: 'orders deliverd',
                                                data: [11, 32, 45, 32, 34, 52, 41]
                                            }, {
                                                name: 'orders canceld',
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
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
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
@endsection
