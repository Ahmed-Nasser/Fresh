<?php

namespace App\Http\Resources;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
          'id'    => (string) $user->id,
          'name'  => (string) $user->name,
          'email' => (string) $user->email,
        ];
    }
}
