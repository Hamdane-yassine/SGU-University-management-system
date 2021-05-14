<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ChekEqualPasswd implements Rule
{
    protected string $ppassed;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $ppassed)
    {
        $this->ppassed = $ppassed;
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
        return $value == $this->ppassed;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Assurez-vous que les deux sont les identique';
    }
}
