<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SampleLineChart;
use App\Report;
use App\User;
use App\Campaign;
use App\Contact;

class StatisticsController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $chart = new SampleLineChart;
        $reports = $user->reports;
        $dates = collect();
        $rawDates = $reports->pluck('updated_at');
        $opened = Contact::where('user_id', auth()->user()->id)->sum('opened');

        foreach($rawDates as $rawDate) $dates->push((string)$rawDate);

        $chart->labels($dates);
        $chart->dataset('Sent', 'line', $reports->pluck('sent'))->options(['color' => '#6c757d',]);
        $chart->dataset('Received', 'line', $reports->pluck('received'))->options(['color' => '#6cb2eb',]);
        $chart->dataset('Opened', 'line', $reports->pluck('opened'))->options(['color' => '#3490dc',]);
        $chart->dataset('Subscribed', 'line', $reports->pluck('subscribed'))->options(['color' => '#38c172',]);
        $chart->dataset('Bounced', 'line', $reports->pluck('bounced'))->options(['color' => '#f6993f',]);
        $chart->dataset('Blocked', 'line', $reports->pluck('blocked'))->options(['color' => '#e3342f',]);

        return view('pages.statistics')
            ->with('chart', $chart)
            ->with('reports', $reports)
            ->with('opened', $opened);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $report = $campaign->report;
        $chart = new SampleLineChart;
        $chart->labels([$campaign->name]);
        $chart->dataset('Sent', 'column', [$report->sent])->options(['color' => '#6c757d',]);
        $chart->dataset('Received', 'column', [$report->received])->options(['color' => '#6cb2eb',]);
        $chart->dataset('Opened', 'column', [$report->opened])->options(['color' => '#3490dc',]);
        $chart->dataset('Subscribed', 'column', [$report->subscribed])->options(['color' => '#38c172',]);
        $chart->dataset('Bounced', 'column', [$report->bounced])->options(['color' => '#f6993f',]);
        $chart->dataset('Blocked', 'column', [$report->blocked])->options(['color' => '#e3342f',]);
        return view('pages.statistics.show_report')
            ->with('campaign', $campaign)
            ->with('chart', $chart)
            ->with('report', $report);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function individual($type)
    {
        $user = User::find(auth()->user()->id);

        // $campaigns = Campaign::select('name', 'listname')
        //     // ->groupBy('name')
        //     ->where('user_id', $user->id)
        //     ->get();


        return view('pages.statistics.category_report')
            ->with('category', ucfirst($type))
            ->with('chart', $this->createChart($type, $user))
            ->with('contacts', $this->getContactsByType($type, $user));
    }

    public function createChart($type, $user) {
        $reports = $user->reports;
        $color = "";
        if ($type === 'sent') $color = "#6c757d";
        else if ($type === 'received') $color = "#6cb2eb";
        else if ($type === 'opened') $color = "#3490dc";
        else if ($type === 'subscribed') $color = "#38c172";
        else if ($type === 'bounced') $color = "#f6993f";
        else $color = "#e3342f";

        $dates = collect();
        $rawDates = $reports->pluck('updated_at');
        foreach($rawDates as $rawDate) $dates->push((string)$rawDate);

        $chart = new SampleLineChart;
        $chart->labels($dates);
        $chart->dataset(ucfirst($type),
                'column',
                $reports->pluck($type)
            )->options(['color' => $color]);

        return $chart;
    }

    public function getContactsByType($type, $user) {
        return Contact::all()
                ->where('user_id', $user->id)
                ->where($type, true);
    }
}
