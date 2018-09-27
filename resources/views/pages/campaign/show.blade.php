@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1>Create Campaign</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/campaigns">Campaign</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Preview</li>
                </ol>
            </nav>

            <section class="show-campaign">
                <div class="button-holder mb-3">
                    <a href="/campaigns" class="btn btn-primary">Back</a>
                <a href="/campaigns/export/{{ $campaign->id }}" class="btn btn-primary float-right mb-3"><i class="far fa-file"></i> Export Contacts</a>
                </div>
                {{-- <div class="template">
                        {!! $campaign->body !!}
                </div> --}}
                <div class="report">
                    <h3>Total: {{ count($showOpened)}}</h3>
                </div>
                <div class="table-responsive">
                        <table class="table table-hover table-striped py-3">
                            <thead>
                                <tr>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($showOpened) > 0)
                                    @foreach($showOpened as $show)
                                        <tr>
                                            <td>{{$show->fname}}</td>
                                            <td>{{$show->lname}}</td>
                                            <td>{{$show->email}}</td>
                                            <td>{{$show->number}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <th colspan="4">No results found</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
            </section>
        </div>
    </div>
@endsection