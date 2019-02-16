<?php

namespace Jubby\Form\Constraints;

use Symfony\Component\Validator\Constraint;

class UniqueUsername extends Constraint
{
    public $message = 'The username "{{ username }}" is already taken. Please choose another one';
}
