<?php


namespace App\Contracts;


interface IBaseRepository
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

}
