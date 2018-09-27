@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">

            <h1>Edit Contact</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/contacts">Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Contact</li>
                </ol>
            </nav>
            
            @include('includes.messages')

            {!! Form::open(['action' => ['ContactsController@update', $contact->id], 'method' => 'POST']) !!}

            <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('fname', 'First Name')}}
                    {{Form::text('fname', $contact->fname, ['class' => 'form-control', 'placeholder' => 'Enter First Name'])}}
                </div>

                <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('lname', 'Last Name')}}
                    {{Form::text('lname', $contact->lname, ['class' => 'form-control', 'placeholder' => 'Enter Last Name'])}}
                </div>

                <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('number', 'Number')}}
                    {{Form::number('number', $contact->number, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number'])}}
                </div>

                <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('email', 'Email Address')}}
                    {{Form::email('email', $contact->email, ['class' => 'form-control', 'placeholder' => 'Enter Email Address'])}}
                </div>

                <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('list_id', 'List Group')}}
                    {{Form::text('list_id', $contact->list_id, ['class' => 'form-control', 'placeholder' => 'Enter List Group'])}}
                    <div class="text-center mt-4">
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    </div>
                </div>

            {!! Form::close() !!}
            
        </div>
    </div>



@endsection