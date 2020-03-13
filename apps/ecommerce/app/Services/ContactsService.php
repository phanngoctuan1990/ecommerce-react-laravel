<?php

namespace App\Services;

use App\Exceptions\ApiException;
use App\Contracts\Mail\VerifyMailAdapter;
use App\Repositories\Contacts\ContactsRepositoryInterface;

class ContactsService extends BaseService
{
    protected $request;
    protected $verifyMail;
    protected $contactRepository;

    /**
     * Create a new controller instance.
     *
     * @param VerifyMailAdapter           $verifyMail        verify mail
     * @param ContactsRepositoryInterface $contactRepository contact repository
     *
     * @return void
     */
    public function __construct(
        VerifyMailAdapter $verifyMail,
        ContactsRepositoryInterface $contactRepository
    ) {
        $this->verifyMail = $verifyMail;
        $this->contactRepository = $contactRepository;
    }

    /**
     * Set request
     *
     * @param Request $request request
     *
     * @return ContactsService
     */
    public function setRequest($request): ContactsService
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Store contact
     *
     * @return Contact|array
     */
    public function store()
    {
        $contact = $this->contactRepository
            ->setName($this->request['name'])
            ->setEmail($this->request['email'])
            ->firstByNameOrEmail();

        if ($contact) {
            throw new ApiException('You have already contacted. Please wait for me to respond', 400);
        }

        $verifyEmail = $this->verifyMail
            ->setEmail($this->request['email'])
            ->verify();

        $contactData = [
            'name' => $this->request['name'],
            'email' => $this->request['email'],
            'message' => $this->request['message'],
        ];

        if ($verifyEmail) {
            $contactData['is_valid'] = VerifyMailAdapter::IS_VALID;
        }

        return $this->contactRepository
            ->setContactData($contactData)
            ->store();
    }
}
