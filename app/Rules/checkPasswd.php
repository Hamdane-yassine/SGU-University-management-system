<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class checkPasswd implements Rule
{
    protected User $user;
    protected int $attr;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(User $user, $attr = 1)
    {
        $this->user = $user;
        $this->attr = $attr;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $hash = $this->user->password;

        if ($attribute == 'current')
            return Hash::check($value, $hash);
        return !Hash::check($value, $hash);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->attr)
            return 'Vérifier que avez entrer votre mot de passe courant';
        return 'Utiliser un nouveau mot de passe';
    }
}
