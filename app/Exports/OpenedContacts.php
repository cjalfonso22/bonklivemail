<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Campaign;
use App\Contact;

class OpenedContacts implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Contact::all();
    // }

    protected $campaign;

    public function __construct($id)
    {
        $this->campaign = Campaign::find($id);
    }

    public function view(): View
    {
        $showOpened = Contact::where('list_id', $this->campaign->listname)
            ->where('opened', '1')->get();

        return view('pages.campaign.export_opened')
            ->with('campaign', $this->campaign)
            ->with('showOpened', $showOpened);
    }
}
