<?php

namespace Jubby\Form\Constraints;

use Symfony\Component\Validator\Constraint;

class UniqueEmail extends Constraint
{
    public $message = 'This email is already registered to an account.';
}
