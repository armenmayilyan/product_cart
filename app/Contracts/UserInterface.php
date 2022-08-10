<?php


namespace App\Contracts;


interface UserInterface
{
    /**
     * @param $email
     * @return mixed
     */

    public function emailCheck($email);

}
