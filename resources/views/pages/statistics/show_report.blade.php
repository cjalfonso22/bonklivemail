@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1>{{ $campaign->name }} Report</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/statistics">Statistics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $campaign->name }}</li>
                </ol>
            </nav>

            <section class="help-holder">
            <p>Campaign name: <b>{{ $campaign->name }}</b></p>
            <p>Campaign subject: <b>{{ $campaign->subject }}</b></p>
            <p>Updated at: <b>{{ $report->updated_at }}</b></p>
                <div class="panel-body">
                    {!! $chart->container() !!}
                </div>
            </section>
        </div>
    </div>

@endsection

<script src="https://unpkg.com/vue"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
{!! $chart->script() !!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>