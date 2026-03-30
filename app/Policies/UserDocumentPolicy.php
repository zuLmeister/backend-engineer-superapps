<?php

namespace App\Policies;

use App\Auth\GenericUser;
use App\Models\UserDocument;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserDocumentPolicy
{
    use HandlesAuthorization;

    private function isAllowed(GenericUser $user): bool
    {
        return (int) $user->department_id === 10;
    }

    public function viewAny(GenericUser $user)
    {
        return $this->isAllowed($user);
    }
    public function view(GenericUser $user, UserDocument $doc)
    {
        return $this->isAllowed($user);
    }
    public function create(GenericUser $user)
    {
        return $this->isAllowed($user);
    }
    public function update(GenericUser $user, UserDocument $doc)
    {
        return $this->isAllowed($user);
    }
    public function delete(GenericUser $user, UserDocument $doc)
    {
        return $this->isAllowed($user);
    }
}
