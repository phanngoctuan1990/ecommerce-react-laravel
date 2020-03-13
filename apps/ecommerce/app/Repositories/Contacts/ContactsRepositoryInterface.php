<?php

namespace App\Repositories\Contacts;

interface ContactsRepositoryInterface
{
    /**
     * Set name
     *
     * @param string $name name
     */
    public function setName(string $name);

    /**
     * Set email
     *
     * @param string $email email
     */
    public function setEmail(string $email);

    /**
     * Set contact data
     *
     * @param array $data data
     */
    public function setContactData(array $data);

    /**
     * Fisrt by name or email
     */
    public function firstByNameOrEmail();

    /**
     * Store contact
     */
    public function store();
}
