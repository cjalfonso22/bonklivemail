@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1>Create List</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/contacts">Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Import CSV File</li>
                </ol>
            </nav>
            
            {!! Form::open(['action' => 'ContactsController@uploadCSVFile', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    <div class="form-group col-12 col-md-6 col-sm-8">
                        {{Form::label('list_id', 'List Name')}} <span class="text-danger">*</span>
                        {{Form::text('list_id', '', ['class' => 'form-control', 'placeholder' => 'Enter List Name'])}}
                    </div>

                    <label for="csv_file" class="col-md-4 control-label">Upload File <span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        {{Form::file('csv_file', ['class' => 'form-control'])}}
                    </div>

                    <div class="text-center mt-4">
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    </div>
                </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection