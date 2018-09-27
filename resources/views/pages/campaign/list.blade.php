@extends('layouts.app')

@section('content')
    @include('includes.sidenav')

    {{-- Right Content --}}
    <div class="body-right">
        <div class="container-fluid">
            <h1>Select List & Send</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/campaigns">Campaign</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/campaigns/create">Create Campaign</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Select List & Send</li>
                </ol>
            </nav>

            <section class="send-holder">
                <form action="">
                    <div class="form-group">
                      <label for="list">Select List:</label>
                      <select class="form-control" id="list">
                        <option>Batch 1</option>
                        <option>Batch 2</option>
                        <option>Batch 3</option>
                        <option>Batch 4</option>
                        <option>Batch 5</option>
                      </select>
                    </div>

                    <div class="list-preview table-responsive-sm mb-3">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Date Added</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>John</td>
                                    <td>Doe</td>
                                    <td>johndoe@mail.com</td>
                                    <td>5418529898</td>
                                    <td>Aug-23-2018 9:38AM</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>IPO Hotstock</td>
                                    <td>Greetings! We are Bonk Be.Live! Donwload our application, available on Android and IOS.</td>
                                    <td>500</td>
                                    <td>481</td>
                                    <td>Jul-28-2018 10:41AM</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td class="text-truncate">New Superstars Joining Bonk Be.Live!</td>
                                    <td class="text-truncate">Greetings! We are Bonk Be.Live! Donwload our application, available on Android and IOS.</td>
                                    <td>500</td>
                                    <td>481</td>
                                    <td>Jul-27-2018 3:56PM</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Invitation to Become a Shareholder</td>
                                    <td>Greetings! We are Bonk Be.Live! Donwload our application, available on Android and IOS.</td>
                                    <td>500</td>
                                    <td>481</td>
                                    <td>Aug-23-2018 9:38AM</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Invitation to Become a Shareholder</td>
                                    <td>Greetings! We are Bonk Be.Live! Donwload our application, available on Android and IOS.</td>
                                    <td>500</td>
                                    <td>481</td>
                                    <td>Aug-23-2018 9:38AM</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Invitation to Become a Shareholder</td>
                                    <td>Greetings! We are Bonk Be.Live! Donwload our application, available on Android and IOS.</td>
                                    <td>500</td>
                                    <td>481</td>
                                    <td>Aug-23-2018 9:38AM</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <input type="submit" class="form-control btn btn-success" value="Send">
                  </form>
            </section>
        </div>
    </div>
@endsection