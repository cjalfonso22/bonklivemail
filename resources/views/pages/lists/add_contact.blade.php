@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">

            <h1>Add Contact</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/contacts">Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Contact</li>
                </ol>
            </nav>
            
            {!! Form::open(['action' => 'ContactsController@store', 'method' => 'POST']) !!}

                <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('fname', 'First Name')}} <span class="text-danger">*</span>
                    {{Form::text('fname', '', ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => 'required'])}}
                </div>

                <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('lname', 'Last Name')}} <span class="text-danger">*</span>
                    {{Form::text('lname', '', ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => 'required'])}}
                </div>

                <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('number', 'Number')}} <span class="text-danger">*</span>
                    {{Form::number('number', '', ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'required' => 'required'])}}
                </div>

                <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('email', 'Email Address')}} <span class="text-danger">*</span>
                    {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Enter Email Address', 'required' => 'required'])}}
                </div>

                <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('list_id', 'List Group')}} <span class="text-danger">*</span>
                    {{Form::text('list_id', '', ['class' => 'form-control', 'placeholder' => 'Enter List Group', 'required' => 'required'])}}
                    <div class="text-center mt-4">
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    </div>
                </div>

            {!! Form::close() !!}
            
        </div>
    </div>



@endsection