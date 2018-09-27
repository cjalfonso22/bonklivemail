<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\Contact;
use App\User;
use DB;
use App\Report;
// use Mailgun\Mailgun;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        // DATABASE
        $campaigns = Campaign::all();

        // CONTACTS
        $rawContacts = Contact::orderBy('updated_at','desc')->where('user_id', $user_id)->get();
        $contacts = $rawContacts
            ->where('user_id', $user_id)
            ->groupBy('list_id');

        $subscribers = Contact::all()->where('user_id', $user_id);

        $sum = Campaign::where('user_id', $user_id)->sum('sent');
        $opened = Contact::where('user_id', $user_id)->sum('opened');

        $listNames = $rawContacts->groupBy('list_id');

        return view('dashboard')
        ->with('campaigns', $user->campaigns)
        ->with('sum', $sum)
        ->with('contacts', $contacts)
        ->with('list_names', $listNames->all())
        ->with('subscribers', $subscribers)
        ->with('reports', $user->reports)
        ->with('opened', $opened);
    }

}
