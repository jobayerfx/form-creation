<?php
namespace App\Repositories;

use App\Models\Form;

interface  FormRepositoryInterface
{
    public function getAllFormsForUser($user);

    public function createForm($user, $title, $description);

    public function getFormById($id);

}
