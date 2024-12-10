@extends('dashboard.index')

@section('content')

<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi {{Auth::user()->name}}, welcome back!</h4>
                    <p>Today is {{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>

                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-money text-success border-success"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Revenue</div>
                            <div class="stat-digit">{{$totalTransactionAmount}} JD</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-user text-primary border-primary"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Total Customers</div>
                            <div class="stat-digit">{{$totalUsers}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-layout-grid2 text-pink border-pink"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Total Courses</div>
                            <div class="stat-digit">{{$totalCourses}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-book text-danger border-danger"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Total Teachers</div>
                            <div class="stat-digit">{{$totalTeachers}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row h-100" style="height: 100vh;">
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-block">
                        <h4 class="card-title">Revenue Growth</h4>
                        <canvas id="lineChart" data-months="{{ json_encode($months) }}" data-revenues="{{ json_encode($revenues) }}"
                            height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-block">
                        <h4 class="card-title">Course Enrollment</h4>
                        <canvas id="pieChart" data-course-names="{{ json_encode($courseNames) }}" data-student-counts="{{ json_encode($studentCounts) }}" width="300" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>


    </div>



</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    const canvas = document.getElementById('lineChart');
    const months = JSON.parse(canvas.getAttribute('data-months'));
    const revenues = JSON.parse(canvas.getAttribute('data-revenues'));



    const ctx = canvas.getContext('2d');
    const lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Monthly Revenue',
                data: revenues,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Months',
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Revenue (JD)',
                    }
                }
            }
        }
    });
</script>

<script>
    const pieChartCanvas = document.getElementById('pieChart');


    const courseNames = JSON.parse(pieChartCanvas.getAttribute('data-course-names'));
    const studentCounts = JSON.parse(pieChartCanvas.getAttribute('data-student-counts'));

    const ctx2 = pieChartCanvas.getContext('2d');
    const pieChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: courseNames,
            datasets: [{
                label: 'Students Enrolled',
                data: studentCounts,
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        }
    });
</script>

@endsection