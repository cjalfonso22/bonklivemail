<?php

namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Contact;

class ContactsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Contact::all();
    // }
    public function view(): View
    {
        return view('pages.statistics.export')
                ->with('contacts', Contact::all());
    }
}
