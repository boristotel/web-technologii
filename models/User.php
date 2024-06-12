<?php

use Serializable;

class User implements Serializable
{

    private $name = "";
    private $email = "";
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function getUserName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function serialize()
    {
        return serialize(
            array(
                "name" => $this->name,
                "email" => $this->email
            )
        );
    }

    public function unserialize($data)
    {
        $unserialized = unserialize($data);
        $this->name = $unserialized["name"];
        $this->email = $unserialized["email"];
    }
}