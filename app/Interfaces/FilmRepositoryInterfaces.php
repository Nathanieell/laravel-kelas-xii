<?php

namespace App\Interfaces;

use App\Models\Film;

interface FilmRepositoryInterfaces
{
    public function index();
    public function getById($id);
    public function store(array $data);
}