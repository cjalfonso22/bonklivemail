@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1>{{$category}} Report</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/statistics">Statistics</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$category}}</li>
                </ol>
            </nav>

            <section class="help-holder">
                <div class="panel-body">
                    {!! $chart->container() !!}
                </div>
            </section>

            <div class="lists-table table-responsive mt-3">
                <table class="table table-hover table-striped py-3 text-center">
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Number</th>
                            <th scope="col">Campaign Name</th>
                            <th scope="col">List Name</th>
                            <th scope="col">Date Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($contacts) > 0)
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$contact->fname}}</td>
                                    <td>{{$contact->lname}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->number}}</td>
                                    <td>campaign name</td>
                                    <td>{{$contact->list_id}}</td>
                                    <td>{{$contact->updated_at}}</td>
                                </tr>
                            @endforeach
                        @else
                        <tr class="text-center">
                            <th colspan="7">No lists found</th>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <a href="/statistics" class="btn btn-primary mt-4"><i class="fas fa-chevron-left"></i> Back</a>
        </div>
    </div>

@endsection

<script src="https://unpkg.com/vue"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
{!! $chart->script() !!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>