@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1>Dashboard</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <div class="top-dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="campaign-summary">
                            <div class="card camp-card mb-3">
                                <div class="card-body text-center">
                                    <h1>{{count($campaigns)}}</h1>
                                    <p>Campaigns</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="list-summary">
                            <div class="card list-card mb-3">
                                <div class="card-body text-center">
                                    <h1>{{ count($list_names) }}</h1>
                                    <p>Lists</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="subs-summary">
                            <div class="card subs-card mb-3">
                                <div class="card-body text-center">
                                    <h1>{{count($subscribers)}}</h1>
                                    <p>Subscribers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="bottom-dashboard">
                <div class="row">

                    <div class="col-sm-12 mb-2">
                        <div class="card mb-2">
                            <h5 class="card-title campaign-title">Campaign Summary <a class="float-right" href="/campaigns"><i class="fas fa-ellipsis-v"></i></a></h5>
                            <div class="card-body table-responsive-sm">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            {{-- <th scope="col"></th> --}}
                                            <th scope="col">Campaign Name</th>
                                            <th scope="col">Title</th>
                                            {{-- <th scope="col">Content</th> --}}
                                            <th scope="col">List Name</th>
                                            <th scope="col">Sent</th>
                                            <th scope="col">Opened</th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col">Date Updated</th>
                                            <th scope="col">Report</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($campaigns) > 0)
                                            @foreach($campaigns as $campaign)
                                                <tr>
                                                    {{-- <th scope="row">{{$campaign->id}}</th> --}}
                                                    <td>{{$campaign->name}}</td>
                                                    <td>{{$campaign->subject}}</td>
                                                    {{-- <td>{{$campaign->body}}</td> --}}
                                                    <td>{{$campaign->listname}}</td>
                                                    <td>{{$campaign->report->sent}}</td>
                                                    <td><a href="campaigns/{{ $campaign->id }} "><i class="fas fa-eye"></i></a></td>
                                                    <td>{{$campaign->created_at}}</td>
                                                    <td>{{$campaign->updated_at}}</td>
                                                    <td>
                                                        <a href="/statistics/{{$campaign->id}}">
                                                            <i class="fa fa-chart-line"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="text-center">
                                                <th colspan="8">No results found</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-2">
                            <h5 class="card-title lists-title">List Summary <a class="float-right" href="/contacts"><i class="fas fa-ellipsis-v"></i></a></h5>
                            <div class="card-body table-responsive-sm">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">List Name</th>
                                            <th scope="col">No. of Contacts</th>
                                            {{-- <th scope="col">Date Uploaded</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($list_names) > 0)
                                            @foreach($list_names as $list_name=>$names)
                                                <tr>
                                                    <td>{{$list_name}}</td>
                                                    <td>{{ count($names) }}</td>
                                                    <td class="icons">
                                                    </td>
                                                    <td class="icons">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="text-center">
                                                <th colspan="3">No lists found</th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-2">
                            <h5 class="card-title report-title">Report Summary <a class="float-right" href="/statistics"><i class="fas fa-ellipsis-v"></i></a></h5>
                            <div class="card-body text-center h-100 d-table">
                                <div class="v-align h-100 d-table-cell align-middle">
                                    <div class="row h-100 align-items-center">
                                        <div class="col-sm-4 px-0">
                                            {{-- <i class="far fa-check-circle"></i> --}}
                                            <h1>{{$reports->sum('sent')}}</h1>
                                            <p><i class="far fa-check-circle"></i> Sent</p>
                                        </div>
                                        <div class="col-sm-4 px-0">
                                            {{-- <i class="fas fa-undo"></i> --}}
                                            <h1>{{ $reports->sum('bounced') }}</h1>
                                            <p><i class="fas fa-undo"></i> Bounced</p>
                                        </div>
                                        <div class="col-sm-4 px-0">
                                            {{-- <i class="far fa-envelope-open"></i> --}}
                                            <h1>{{ $opened }}</h1>
                                            <p><i class="far fa-envelope-open"></i> Opened</p>
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
@endsection
