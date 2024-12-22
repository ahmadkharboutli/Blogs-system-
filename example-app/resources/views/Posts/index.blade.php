@extends('layouts.appLayouts')
@section('title') index @endsection

@section('content')

<main>
    <div class="container-fluid px-4 mb-4">
       <div class="d-flex justify-content-between">
        <h1 class="mt-4">Dashboard</h1>
       </div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active text-end">Profile</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Posts count</div>
                    <p class="text-center fw-bolder fs-1">   {{$posts->count()}}</p>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href={{route('posts.manage')}}>View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">Users count</div>
                    <p class="text-center fw-bolder fs-1">   {{$users->count()}}</p>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href={{route('posts.manage')}}>View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Researcher count</div>
                    <p class="text-center fw-bolder fs-1">{{$admins->count()}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart for posts
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart for users
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-margine-center">
            <a class="btn btn-outline-dark mx-auto" href="{{route('posts.manage')}}">manage the system</a>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch data from the server
        fetch('{{ route('chart.data') }}')
            .then(response => response.json())
            .then(data => {
                // Prepare the data for the charts
                const labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                const postValues = new Array(12).fill(0);
                const userValues = new Array(12).fill(0);

                data.posts.forEach(item => {
                    postValues[item.month - 1] = item.post_count;
                });

                data.users.forEach(item => {
                    userValues[item.monthUser - 1] = item.user_count;
                });

                // Set new default font family and font color to mimic Bootstrap's default styling
                Chart.defaults.global.defaultFontFamily =
                    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = "#292b2c";

                // Area Chart Example
                var ctxArea = document.getElementById("myAreaChart");
                var myLineChart = new Chart(ctxArea, {
                    type: "line",
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: "Posts",
                                lineTension: 0.3,
                                backgroundColor: "rgba(2,117,216,0.2)",
                                borderColor: "rgba(2,117,216,1)",
                                pointRadius: 5,
                                pointBackgroundColor: "rgba(2,117,216,1)",
                                pointBorderColor: "rgba(255,255,255,0.8)",
                                pointHoverRadius: 5,
                                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                                pointHitRadius: 50,
                                pointBorderWidth: 2,
                                data: postValues,
                            },
                        ],
                    },
                    options: {
                        scales: {
                            xAxes: [
                                {
                                    time: {
                                        unit: "month",
                                    },
                                    gridLines: {
                                        display: false,
                                    },
                                    ticks: {
                                        maxTicksLimit: 12,
                                    },
                                },
                            ],
                            yAxes: [
                                {
                                    ticks: {
                                        min: 0,
                                        maxTicksLimit: 5,
                                    },
                                    gridLines: {
                                        color: "rgba(0, 0, 0, .125)",
                                    },
                                },
                            ],
                        },
                        legend: {
                            display: false,
                        },
                    },
                });

                // Bar Chart Example
                var ctxBar = document.getElementById("myBarChart");
                var myBarChart = new Chart(ctxBar, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: "Users",
                                backgroundColor: "rgba(2,117,216,1)",
                                borderColor: "rgba(2,117,216,1)",
                                data: userValues,
                            },
                        ],
                    },
                    options: {
                        scales: {
                            xAxes: [
                                {
                                    time: {
                                        unit: "month",
                                    },
                                    gridLines: {
                                        display: false,
                                    },
                                    ticks: {
                                        maxTicksLimit: 12,
                                    },
                                },
                            ],
                            yAxes: [
                                {
                                    ticks: {
                                        min: 0,
                                        maxTicksLimit: 5,
                                    },
                                    gridLines: {
                                        color: "rgba(0, 0, 0, .125)",
                                    },
                                },
                            ],
                        },
                        legend: {
                            display: false,
                        },
                    },
                });
            });
    });
</script>

@endsection
