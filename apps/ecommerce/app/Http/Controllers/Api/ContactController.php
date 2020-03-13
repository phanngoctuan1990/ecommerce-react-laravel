<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ContactsService;
use App\Http\Requests\ContactRequest;

class ContactController extends BaseApiController
{
    protected $contactService;

    /**
     * Create a new controller instance.
     *
     * @param ContactsService $contactService contact service
     *
     * @return void
     */
    public function __construct(ContactsService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        return $this->sendResponse(
            $this->contactService
                ->setRequest($request)
                ->store()
        );
    }
}
