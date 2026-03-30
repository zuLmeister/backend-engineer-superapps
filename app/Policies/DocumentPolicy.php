<?php
namespace App\Policies;

use App\Auth\GenericUser;
use App\Models\Document;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
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

    public function view(GenericUser $user, Document $document)
    {
        return $this->isAllowed($user);
    }

    public function update(GenericUser $user, Document $document)
    {
        return $this->isAllowed($user);
    }

    public function delete(GenericUser $user, Document $document)
    {
        return $this->isAllowed($user);
    }
}