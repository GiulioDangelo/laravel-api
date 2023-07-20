<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use App\Mail\MailToLead;
use App\Mail\MailToAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    private $validations = [
        'name'          => 'required|string|min:5|max:50',
        'email'         => 'required|email|max:255',
        'message'       => 'required|string',
        'newsletter'    => 'required|boolean',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->all();

        $validator = Validator::make($data, $this->validations);

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validator->errors(),
            ]);
        }

        $newLead = new Lead();
        $newLead->name = $data['name'];
        $newLead->email = $data['email'];
        $newLead->message = $data['message'];
        $newLead->newsletter = $data['newsletter'];
        $newLead->save();

        // inviare la email al lead per conferma ricezione richiesta
        Mail::to($newLead->email)->send(new MailToLead($newLead));

        // inviare la email all'aministratore per gestire la richiesta del lead
        Mail::to(env('ADMIN_ADDRESS', 'admin@boolpress.com'))->send(new MailToAdmin($newLead));


        // ritornare un valore di successo al frontend
        return response()->json([
            'success' => true,
        ]);

        // return response()->json([$request]);
    }

}
