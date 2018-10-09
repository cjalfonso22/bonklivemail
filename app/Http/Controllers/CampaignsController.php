<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', 180);

use Illuminate\Http\Request;
use App\Campaign;
use App\User;
Use App\Contact;
Use App\Report;
use PHPMailer\PHPMailer;
use Mail;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use View;
use App\Exports\ContactsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OpenedContacts;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $contacts = Contact::where('id', $user_id)->sum('opened');


        $campaigns = Campaign::all();
        return view('pages.campaign')->with('campaigns', $user->campaigns)->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;

        $list_names = Contact::select('list_id')
            ->groupBy('list_id')
            ->where('user_id', auth()->user()->id)
            ->get();

        $contacts = Contact::all()
        ->where('user_id', auth()->user()->id);

        return view('pages.campaign.create')
        ->with('list_names', $list_names)
        ->with('contacts', $contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $this->validate($request, array(
            'camp_name' => 'required',
            'subject'  => 'required',
            'body' => 'required',
            'sent' => 'required'
        ));

        // Create Campaign
        $list = Contact::all()
            ->where('list_id', $request->select_list)
            ->where('user_id', $user_id);

        $campaign = new Campaign;
        $campaign->name = $request->camp_name;
        $campaign->subject = $request->subject;
        $campaign->body = $request->body;
        $campaign->sent = count($list);
        $campaign->user_id = $user_id;
        $campaign->listname = $request->select_list;
        $campaign->save();

        $selected_list = $request->select_list;
        $rawContacts = Contact::select('email')->where('user_id', $user_id)->where('list_id', $selected_list)->get();
        $contacts = $rawContacts
            ->where('user_id', $user_id)
            ->where('list_id', $selected_list);

        // GET ALL EMAILS FROM LIST AND SAVE TO ARRAY
        $array = '';
        $emails = [];

        for($x = 0; $x < count($rawContacts); $x++){
            $array = $rawContacts;
            $emails[$x] = $array[$x]['email'];
        }

        // $data = array('name'=>"Bonk Be.Live", "body" => "Test mail");
        // $successEmails = collect();

        // SEND MAIL
        // $failed = [];
        for($z = 0; $z < count($emails); $z++){
            $currentEmail = $emails[$z];
            $fname = Contact::select('fname')->where('user_id', $user_id)->where('email', $currentEmail)->get();
            $lname = Contact::select('lname')->where('user_id', $user_id)->where('email', $currentEmail)->get();
            View::share('currentEmail', $currentEmail);
            View::share('campaignId', $campaign->id);
            View::share('fname', $fname[0]['fname']);
            View::share('lname', $lname[0]['lname']);

            try{
                $contact = Contact::where('email', $currentEmail)->first();
                $contact->sent = true;
                \Mail::send('email',[], function($message) use ($currentEmail){
                    $message->to($currentEmail)
                    ->subject('Investment Proposal for a Social Media Streaming App');
                    $message->from('hello@boinklivemail.com','Bonk Be.Live');
                });
                // $successEmails->push($currentEmail);
                $contact->received = true;
                $contact->save();
            } catch(Exception $e){
                if(count(Mail::failures() > 0)){
                    // $failed[$z] = $currentEmail;
                    $contact->save();
                }
            }
            // sleep(60);
        }

        // GET TOTAL RECEIVED EMAILS
        $received = count($list) - count(Mail::failures());

        // SAVE DATA TO REPORTS TABLE
        $report = new Report;
        $report->campaign_id = $campaign->id;
        $report->sent = count($list);
        $report->received = $received;
        $report->user_id = $user_id;
        $report->blocked = count(Mail::failures());
        $report->save();

        return redirect('/campaigns')
            ->with('sent', 'Campaign Succeffully Sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::find($id);
        $showOpened = Contact::where('campaign_id', $id)->where('opened', '1')->get();
        return view('pages.campaign.show')
            ->with('campaign', $campaign)
            ->with('showOpened', $showOpened);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = auth()->user()->id;

        $list_names = Contact::select('list_id')
            ->groupBy('list_id')
            ->where('user_id', auth()->user()->id)
            ->get();

        $contacts = Contact::all()
        ->where('user_id', auth()->user()->id);

        $edit = Campaign::find($id);

        return view('pages.campaign.create')
        ->with('list_names', $list_names)
        ->with('contacts', $contacts)
        ->with('edit', $edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = Campaign::find($id);
        $campaign->delete();

        return redirect('/campaigns');
    }

    public function export($id)
    {
        // return "export";
        return Excel::download(new OpenedContacts($id), 'Opened-Contacts.csv');
    }
}
