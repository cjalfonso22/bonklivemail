@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1>Campaign</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Campaign</li>
                </ol>
            </nav>

            @include('includes.messages')

            <section class="campaign-holder">
                <div class="create-btn-holder">
                    <a href="/templates" class="btn btn-primary float-right mb-3"><i class="far fa-file"></i> Use Existing Template</a>
                    <a href="/campaigns/create" class="btn btn-primary float-right mb-3 mx-2"><i class="fas fa-plus"></i> New Campaign</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped py-3">
                        <thead>
                            <tr class="text-center">
                                {{-- <th scope="col"></th> --}}
                                <th scope="col">Campaign Name</th>
                                <th scope="col">Subject</th>
                                {{-- <th scope="col">Content</th> --}}
                                <th scope="col">List Name</th>
                                <th scope="col">Sent</th>
                                <th scope="col">Opened</th>
                                <th scope="col">Date</th>
                                {{-- <th scope="col">Show Opened</th> --}}
                                {{-- <th scope="col">Edit</th> --}}
                                <th scope="col">Report</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($campaigns) > 0)
                                @foreach($campaigns as $campaign)
                                    <tr class="text-center">
                                        {{-- <th scope="row">{{$campaign->id}}</th> --}}
                                        <td>{{$campaign->name}}</td>
                                        <td>{{$campaign->subject}}</td>
                                        {{-- <td>{{$campaign->body}}</td> --}}
                                        <td>{{$campaign->listname}}</td>
                                        <td class="text-center">{{$campaign->report->sent}}</td>
                                        <td class="text-center"><a href="campaigns/{{ $campaign->id }} "><i class="fas fa-eye"></i></a></td>
                                        <td class="text-center">{{$campaign->updated_at}}</td>
                                        {{-- <td><a href="campaigns/{{ $campaign->id }} "><i class="fas fa-eye"></i></a></td> --}}
                                        {{-- <td><a href="{{ route('campaigns.edit', $campaign->id) }}"><i class="far fa-edit"></i></a></td> --}}
                                        <td class="text-center"><a href="/statistics/{{$campaign->id}}"><i class="fa fa-chart-line"></i></a></td>
                                        <td class="icons text-center">
                                            {!!Form::open(['action' => ['CampaignsController@destroy', $campaign->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                <button type="submit"><i class="fas fa-trash"></i></button>
                                            {!!Form::close()!!}
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
            </section>

        </div>
    </div>
@endsection