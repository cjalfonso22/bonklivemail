@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1>Contact Lists</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lists</li>
                </ol>
            </nav>

            @include('includes.messages')

            <div class="button-holder text-right">
                <a href="/contacts/add" class="btn btn-primary mt-1"><i class="fas fa-plus"></i> Add Contact</a>
                <a href="/contacts/create" class="btn btn-primary mt-1"><i class="fas fa-list-ul"></i> Create List</a>
                <a href="/contacts/import" class="btn btn-primary mt-1"><i class="fas fa-file-alt"></i> Import CSV File</a>
                <a href="/contacts/export" class="btn btn-primary mt-1"><i class="fas fa-file-excel"></i> Export Contacts</a>
            </div>

            <div class="lists-table table-responsive mt-3">
                <table class="table table-hover table-striped py-3 text-center">
                    <thead>
                        <tr>
                            <th scope="col">List Name</th>
                            <th scope="col">No. of Contacts</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Date Updated</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($list_names) > 0)
                            @foreach($list_names as $list_name=>$names)
                                @if($names[0]['user_id'] == Auth::user()->id)
                                    <tr>
                                        <td>{{$list_name}}</td>
                                        <td>{{count($names)}}</td>
                                        <td>{{$names[0]['created_at']}}</td>
                                        <td>{{$names[0]['updated_at']}}</td>
                                        <td class="icons">
                                            <a href="/contacts/destroyList/{{$list_name}}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr class="text-center">
                                <th colspan="6">No lists found</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- <div class="lists-table table-responsive mt-3">
                <table class="table table-hover table-striped py-3 text-center">
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date Added</th>
                            <th scope="col">Date Updated</th>
                            <th scope="col">List Name</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($contacts) > 0)
                            @foreach($contacts as $contact)
                            <tr>
                                <td>{{$contact->fname}}</td>
                                <td>{{$contact->lname}}</td>
                                <td>{{$contact->number}}</td>
                                <td>{{$contact->email}}</td>
                                <td>{{$contact->created_at}}</td>
                                <td>{{$contact->updated_at}}</td>
                                <td>{{$contact->list_id}}</td>
                                <td class="icons">
                                    <a href="/contacts/{{$contact->id}}/edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>

                                <td class="icons">
                                    {!!Form::open(['action' => ['ContactsController@destroy', $contact->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['class'=>'btn btn-info', 'type'=>'submit']) !!}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <th colspan="9">No contacts found</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div> --}}

        </div>
    </div>

@endsection