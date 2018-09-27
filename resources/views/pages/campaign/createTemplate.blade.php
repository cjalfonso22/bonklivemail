@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1>Create New Template</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/campaigns">Campaign</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/campaigns/create">Create Campaign</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/templates">Choose Templates</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create New Template</li>
                </ol>
            </nav>

            <section class="create-templates-holder">
                <form action="{{ action('TemplatesController@store') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="temp_name">Template Name: </label>
                        <input type="text" class="form-control" id="temp_name" name="temp_name" placeholder="Template Name">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="code" name="code" placeholder="Paste your code here"></textarea>
                    </div>

                    <div class="create-btn-holder text-right">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>

                </form>
            </section>
        </div>
    </div>
@endsection