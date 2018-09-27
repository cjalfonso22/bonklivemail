@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
                <h1>Statistics</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Statistics</li>
                </ol>
            </nav>

            @include('includes.messages')

            {{-- <div class="button-holder text-right mb-4">

            </div> --}}

            <div class="top-dashboard">
                <div class="row">
                    <div class="col-6 col-sm-4 col-xl-2">
                        <div class="campaign-summary" style="cursor: pointer;" onclick="window.location = '/statistics/category/sent'">
                            <div class="card bg-secondary mb-3">
                                <div class="card-body text-center">
                                    <h2>{{ $reports->sum('sent') }}</h2>
                                    <p>Total Sent</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-xl-2">
                        <div class="campaign-summary" style="cursor: pointer;" onclick="window.location = '/statistics/category/received'">
                            <div class="card bg-info mb-3">
                                <div class="card-body text-center">
                                    <h2>{{ $reports->sum('received') }}</h2>
                                    <p>Total Received</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-xl-2">
                        <div class="campaign-summary" style="cursor: pointer;" onclick="window.location = '/statistics/category/opened'">
                            <div class="card bg-primary mb-3">
                                <div class="card-body text-center">
                                    <h2>{{ $opened }}</h2>
                                    <p>Total Opened</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-sm-4 col-xl-2">
                        <div class="campaign-summary" style="cursor: pointer;" onclick="window.location = '/statistics/category/subscribed'">
                            <div class="card bg-success mb-3">
                                <div class="card-body text-center">
                                    <h2>{{ $reports->sum('subscribed') }}</h2>
                                    <p>Subscribers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-xl-2">
                        <div class="campaign-summary" style="cursor: pointer;" onclick="window.location = '/statistics/category/bounced'">
                            <div class="card orange mb-3">
                                <div class="card-body text-center">
                                    <h2>{{ $reports->sum('bounced') }}</h2>
                                    <p>Bounces</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-xl-2">
                        <div class="campaign-summary" style="cursor: pointer;" onclick="window.location = '/statistics/category/blocked'">
                            <div class="card bg-danger mb-3">
                                <div class="card-body text-center">
                                    <h2>{{ $reports->sum('blocked') }}</h2>
                                    <p>Blocks</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                {!! $chart->container() !!}
            </div>

        </div>
    </div>
@endsection


<script src="https://unpkg.com/vue"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
{!! $chart->script() !!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>