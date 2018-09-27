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
                    <li class="breadcrumb-item active" aria-current="page">Create List</li>
                </ol>
            </nav>

            {!! Form::open(['action' => 'ContactsController@storeList', 'method' => 'POST']) !!}
                <div class="form-group col-12 col-md-5 col-sm-8">
                    {{Form::label('list_id', 'List Name')}}
                        <span class="text-danger">*</span>
                    {{Form::text('list_id', '', ['class' => 'form-control', 'placeholder' => 'Enter List Name'])}}
                </div>

                <div class="lists-table table-responsive mt-3">
                    <table class="table table-hover table-striped py-3 text-center">
                        <thead>
                            <tr>
                                <th scope="col">Check</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Date Updated</th>
                                <th scope="col">List Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($contacts) > 0)
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td scope="row">
                                            <input type="checkbox" id="{{$contact->id}}" name="contact_ids[]" value="{{$contact->id}}">
                                        </td>
                                        <td>{{$contact->fname}}</td>
                                        <td>{{$contact->lname}}</td>
                                        <td>{{$contact->number}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->created_at}}</td>
                                        <td>{{$contact->updated_at}}</td>
                                        <td>{{$contact->list_id}}</td>
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

                <div class="text-center mt-4">
                    {{Form::submit('Save List', ['class' => 'btn btn-primary'])}}
                </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection