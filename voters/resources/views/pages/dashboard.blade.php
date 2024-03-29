@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
			   <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
		
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm text-primary mb-0 text-uppercase font-weight-bold">Welcome</p>
                                    <h5 class="font-weight-bolder">
                                        {{ old('firstname', auth()->user()->firstname) }} {{ old('lastname', auth()->user()->lastname) }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder"></span>
                                       {{ old('role', auth()->user()->role) }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Legislations</p>
                                    <h5 class="font-weight-bolder">
									{{$arr['total_legislations']}}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder"></span>
                                        since 2023
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-user-run text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Votes Casted</p>
                                    <h5 class="font-weight-bolder">
                                       {{$arr['total_votes_casted']}}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-danger text-sm font-weight-bolder"></span>
                                        since 2023
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-blue shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Positive Votes</p>
                                    <h5 class="font-weight-bolder">
                                         {{$arr['positive_votes']}}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder"></span> since 2023
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-app text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Legislation Trend</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>

                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100 active" style="background-image: url('./img/carousel-1.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">This is informative slide for The Voters Voices</h5>
                                    <p>This is informative slide for The Voters Voices</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('./img/carousel-2.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">This is informative slide for The Voters Voices</h5>
                                    <p>This is informative slide for The Voters Voices</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('./img/carousel-3.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-trophy text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">This is informative slide for The Voters Voices</h5>
                                    <p>This is informative slide for The Voters Voices</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Latest Legislations</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center uk-table-responsive uk-table-divider">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Legislation Name</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Legislation Description</th>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Vote</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($legislations as $legislation)
                                <tr>
                                    <td class="w-30">

                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                <i class="ni ni-box-2 text-white opacity-10"></i>
                                            </div>
											<span class="ln" id="n{{$legislation['id']}}" title="{{$legislation['legislation_description']}}" style="cursor:pointer">
                                            {{$legislation['legislation_name']}}
											</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                           {{$legislation['legislation_description']}}
                                        </div>
                                    </td>
                                    <td>
                                           <div class="">
                                                <label for="example-text-input" class="form-control-label">
                                                    <input type="radio" class="uk-radio vote" value="Yes" name="{{$legislation['id']}}" id="{{$legislation['id']}}" 
													@if($legislation['checked']=="Yes")
													checked
													@endif
													>
                                                    <span>Yes</span></label>
                                                <label for="example-text-input" class="form-control-label">
                                                    <input class="uk-radio vote" type="radio" value="No" name="{{$legislation['id']}}"
													@if($legislation['checked']=="No")
													checked
													@endif
													>
                                                    <span>No</span></label>  <label for="example-text-input" class="form-control-label">
                                                    <input type="radio" class="uk-radio vote" value="Proxy" name="{{$legislation['id']}}"
													@if($legislation['checked']=="Proxy")
													checked
													@endif
													>
                                                    <span>Proxy</span></label>
                                            </div>

                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button
                                                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                    class="ni ni-bold-right" aria-hidden="true"></i></button>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
		<button data-bs-toggle="modal" data-bs-target="#confirm_vote" id="openvote" hidden>.</button>
<button data-bs-toggle="modal" data-bs-target="#open_legi" id="openlegi" hidden>.</button>
<input type="hidden" id="legislation_id">
        @include('layouts.footers.auth.footer')
    </div>
	@include('modals.confirmvotemodal')
@include('modals.legislationmodal')
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Legislations",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
