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
                    <li class="breadcrumb-item active" aria-current="page">Create Campaign</li>
                </ol>
            </nav>

            <form action="{{ action('CampaignsController@store') }}" method="POST">
                {{ csrf_field() }}
                <section class="editor">
                    <div class="form-holder">
                        <div class="form-group">
                            <label for="camp-name"><strong>Campaign Name:</strong></label>
                            @if(!empty($edit))
                                <input type="text" class="form-control" id="camp_name" name="camp_name" placeholder="Campaign Name" value="{{ $edit->name }}">
                            @else
                                <input type="text" class="form-control" id="camp_name" name="camp_name" placeholder="Campaign Name">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="subject"><strong>Subject: </strong></label>
                            @if(!empty($edit))
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="{{ $edit->subject }}">
                            @else
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="body"><strong>Content: </strong></label>
                            <div class="temp_content">
                                @if(!empty($template_content))
                                    {!! $template_content->template_text !!}
                                    <input type="hidden" id="body" name="body" value="{{ $template_content->template_text }}">
                                @endif

                                @if(!empty($edit))
                                    {!! $edit->body !!}
                                    <input type="hidden" id="body" name="body" value="{{ $edit->body }}">
                                @endif

                                @if(empty($edit) && empty($template_content))
                                    <textarea class="form-control" id="body" name="body" placeholder="Paste your code here"></textarea>
                                @endif
                                </div>
                            </div>
                    </div>
                </section>

                <section class="send-holder mt-3">
                        <div class="form-group">
                        <label for="list"><strong>Send To Group:</strong></label>
                        <select class="form-control" id="select_list" name="select_list">
                            <option>Select list here:</option>
                            @if(count($list_names) > 0)
                                @foreach($list_names as $list_name)
                                    <option value="{{ $list_name->list_id }}">{{ $list_name->list_id }}</option>
                                @endforeach
                            @else
                                <option>No list found</option>
                            @endif
                        </select>
                        <input type="hidden" name="sent" id="sent" value="0" />
                        </div>

                        {{-- <div class="individual_contact" id="individual_contact">
                            <label><strong>Send To Individual Subscribers:</strong></label>
                            <div class="list-preview table-responsive-sm mb-3">
                                <table class="table table-hover table-striped">
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
                                                    <td scope="row" class="text-center">
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
                        </div> --}}

                        <div class="create-btn-holder">
                            <a href="/campaigns" class="btn btn-primary mb-3 mx-2"><i class="fas fa-chevron-left"></i> Back</a>
                            <input type="submit" class="btn btn-success float-right" value="Send">
                        </div>
                </section>
            </form>
        </div>
    </div>
@endsection

