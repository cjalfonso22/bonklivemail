<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\User;

use App\Exports\ContactsExport;
use Maatwebsite\Excel\Facades\Excel;

class ContactsController extends Controller
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyList($list_name)
    {
        foreach (Contact::where('list_id', $list_name)->get() as $contact) $contact->delete();
        return redirect('/contacts')->with('success', 'List Deleted');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('pages.lists.import_csv');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function uploadCSVFile(Request $request)
    {
        $this->validate($request, [
            'csv_file' => 'required',
            'list_id' => 'required'
        ]);

        $upload = $request->file('csv_file');
        $filePath = $upload->getRealPath();
        $file=fopen($filePath, 'r');
        $header=fgetcsv($file);

        $escapedHeader=[];

        foreach($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }

        while($columns=fgetcsv($file)) {
            foreach($columns as $key => $value) $value=preg_replace('/\D/','',$value);
            $data = array_combine($escapedHeader, $columns);

            $fname = (is_null($data['firstname']) || empty($data['firstname']) || strlen($data['firstname']) === 0) ? '' : $data['firstname'];
            $lname = (is_null($data['lastname']) || empty($data['lastname']) || strlen($data['lastname']) === 0) ? '' : $data['lastname'];
            $number = (is_null($data['number']) || empty($data['number']) || strlen($data['number']) === 0) ? '' : $data['number'];
            $email = (is_null($data['email']) || empty($data['email']) || strlen($data['email']) === 0) ? '' : $data['email'];

            // $contact = Contact::firstOrNew(['fname'=>$fname,'lname'=>$lname]);
            $contact = new Contact;
            $contact->fname=$fname;
            $contact->lname=$lname;
            $contact->number=$number;
            $contact->email=$email;
            $contact->list_id=$request->input('list_id');
            $contact->user_id=auth()->user()->id;
            $contact->opened=0;
            $contact->save();
        }

        return redirect('/contacts')
        ->with('success', 'File Imported Successfully');
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeList(Request $request)
    {
        $contact = null;
        $this->validate($request, ['list_id' => 'required']);
        $checkboxes = $request->input('contact_ids');
        foreach($checkboxes as $checkbox) {
            $contact = Contact::find($checkbox);
            $contact->list_id = $request->input('list_id');
            $contact->save();
        }

        return redirect('/contacts')->with('success', 'List Created');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addContact()
    {
        $contacts = Contact::all();
        return view('pages.lists.add_contact')->with('contacts', $contacts);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rawContacts = Contact::orderBy('updated_at','desc')->get();
        $contacts = $rawContacts->where('user_id', auth()->user()->id);
        $listNames = $rawContacts->groupBy('list_id');

        return view('pages.lists')
        ->with('contacts', $contacts)
        ->with('list_names', $listNames->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rawContacts = Contact::orderBy('updated_at','desc')->get();
        $contacts = $rawContacts->where('user_id', auth()->user()->id);
        return view('pages.lists.create_list')->with('contacts', $contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required'
        ]);

        $contact = new Contact;
        $contact->fname = $request->input('fname');
        $contact->lname = $request->input('lname');
        $contact->number = $request->input('number');
        $contact->email = $request->input('email');
        $contact->list_id = $request->input('list_id');
        $contact->user_id = auth()->user()->id;
        $contact->opened = 0;
        $contact->save();

        return redirect('/contacts')->with('success', 'Contact Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('pages.lists.edit_contact')->with('contact', $contact);
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
        $this->validate($request, [
            'fname' => 'required'
        ]);

        $contact = Contact::find($id);
        $contact->fname = $request->input('fname');
        $contact->lname = $request->input('lname');
        $contact->number = $request->input('number');
        $contact->email = $request->input('email');
        $contact->list_id = $request->input('list_id');
        $contact->user_id = auth()->user()->id;
        $contact->save();

        return redirect('/contacts')->with('success', 'Contact Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return redirect('/contacts')->with('success', 'Contact Deleted');
    }

    public function export()
    {
        return Excel::download(new ContactsExport, 'contacts.csv');
    }
}
