<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;
use App\User;
use App\Contact;
use View;

class TemplatesController extends Controller
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

        $templates = Template::all()->where('user_id', $user_id);
        return view('pages.campaign.template')->with('templates', $templates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.campaign.createTemplate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'temp_name' => 'required',
            'code'  => 'required',
        ));

        $template = new Template;
        $template->template_name = $request->temp_name;
        $template->template_text = $request->code;
        $template->user_id = auth()->user()->id;
        $template->save();

        return redirect('/templates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list_names = Contact::select('list_id')
            ->groupBy('list_id')
            ->where('user_id', auth()->user()->id)
            ->get();

        $contacts = Contact::all()
        ->where('user_id', auth()->user()->id);

        // $templates = Template::all()
        // ->where('user_id', $user_id)
        // ->where('id', $id);

        $templates = Template::find($id);

        View::share('selected_template', $templates->template_text);

        // return view('/email')
        //     ->with('list_names', $list_names)
        //     ->with('contacts', $contacts)
        //     ->with('template_content', $templates->template_text);

        return view('pages.campaign.create')
            ->with('list_names', $list_names)
            ->with('contacts', $contacts)
            ->with('template_content', $templates);
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
}
