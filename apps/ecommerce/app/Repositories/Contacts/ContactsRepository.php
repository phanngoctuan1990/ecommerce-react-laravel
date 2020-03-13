<?php

namespace App\Repositories\Contacts;

use App\Contact;

class ContactsRepository implements ContactsRepositoryInterface
{
    protected $name;
    protected $email;
    protected $contact;
    protected $contactData;

    /**
     * Construct ContactsRepository
     *
     * @param Contact $model model
     *
     * @return void
     */
    public function __construct(Contact $model)
    {
        $this->contact = $model;
    }

    /**
     * Set name
     *
     * @param string $name name
     */
    public function setName(string $name): ContactsRepository
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email email
     */
    public function setEmail(string $email): ContactsRepository
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Set contact data
     *
     * @param array $data data
     */
    public function setContactData(array $data): ContactsRepository
    {
        $this->contactData = $data;
        return $this;
    }

    /**
     * Store contact
     *
     * @return Contact
     */
    public function store(): Contact
    {
        return $this->contact->create($this->contactData);
    }

    /**
     * Fisrt contact by name or email
     *
     * @return Contact|null
     */
    public function firstByNameOrEmail()
    {
        return $this->contact
            ->where('email', $this->email)
            ->orWhere('name', $this->name)
            ->first();
    }
}
