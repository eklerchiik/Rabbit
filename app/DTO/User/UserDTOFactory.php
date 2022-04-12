<?php

declare(strict_types=1);

namespace App\DTO\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserDTOFactory
{
    public function buildFromModel(User $user): UserDTO
    {
        return new UserDTO(
            $user->name
        );
    }

    public function buildFromModelCollection(Collection $users): array
    {
        $userDTOs = [];

        foreach ($users as $user) {
            $userDTOs[] = $this->buildFromModel($user);
        }

        return $userDTOs;
    }
}
