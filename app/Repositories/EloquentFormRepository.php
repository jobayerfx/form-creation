<?php

namespace App\Repositories;

use App\Models\Form;
use App\User;

class EloquentFormRepository implements FormRepositoryInterface
{
    public function getAllFormsForUser($user)
    {
        return Form::where('user_id', $user->id)
            ->orWhereHas('collaborationUsers', function ($query) use ($user) {
                $query->where('form_collaborators.user_id', $user->id);
            })
            ->latest()
            ->get();
    }

    public function createForm($user, $title, $description)
    {
        $form = new Form([
            'user_id' => $user->id,
            'title' => ucfirst($title),
            'description' => ucfirst($description),
            'status' => Form::STATUS_OPEN
        ]);

        $form->generateCode();
        $form->save();

        return $form;
    }

    public function getFormById($id)
    {
        return Form::findOrFail($id);
    }

    // Implement other methods here
}
