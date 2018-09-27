@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1>Templates</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/campaigns">Campaign</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Choose Templates</li>
                </ol>
            </nav>

            <section class="templates-holder">
                <div class="create-btn-holder">
                    <a href="/campaigns" class="btn btn-primary mb-3 mx-2"><i class="fas fa-chevron-left"></i> Back</a>
                    <a href="/templates/create" class="btn btn-primary mb-3 mx-2 float-right"><i class="fas fa-plus"></i> Create Template</a>
                </div>

                <div class="row">
                    @if(count($templates) > 0)
                        @foreach($templates as $template)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="template-content">
                                            {!! $template->template_text !!}
                                        </div>
                                    </div>
                                    <div class="button-holder">
                                        <div class="d-table">
                                            <div class="v-align text-center">
                                                <a href="/templates/{{ $template->id }}" class="btn btn-primary">Use Template</a>
                                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="far fa-eye"></i></button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                            <p class="text-center">No templates found</p>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection