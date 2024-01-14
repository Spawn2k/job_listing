<?php

namespace App\form\rules;

// create new rules
// 1. create const with rule name like: public const RULE_REQUIRED = 'required';
// 2. create new rules method like: public function createRules
// 3. in the method return a new associative array like:
//      return [
//            'firstname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => '16']],
//            'lastname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '3']],
//        ];
// key is the name attribute of the input field, value of the array is the name of the rule


class Rules
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_UNIQUE = 'unique';
    public const RULE_MATCH = 'match';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_NUMERIC = 'numeric';
    public const RULE_UPDATE = 'update';


    public function createRules(): array
    {
        return [
            'title' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => '16']],
            'description' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '3']],
            'email' => [ self::RULE_REQUIRED, self::RULE_EMAIL],
            'salary' => [self::RULE_REQUIRED, self::RULE_NUMERIC],
            'requirements' => [self::RULE_REQUIRED ],
            'benefits' => [self::RULE_REQUIRED ],
            'tags' => [self::RULE_REQUIRED ],
            'company' => [self::RULE_REQUIRED ],
            'address' => [self::RULE_REQUIRED ],
            'city' => [self::RULE_REQUIRED ],
            'state' => [self::RULE_REQUIRED ],
            'phone' => [self::RULE_REQUIRED ],
        ];
    }

    public function updateRules(): array
    {
        return [
            'title' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => '16']],
            'description' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '3']],
            'email' => [ self::RULE_UPDATE, self::RULE_EMAIL],
            'salary' => [self::RULE_REQUIRED, self::RULE_NUMERIC],
            'requirements' => [self::RULE_REQUIRED ],
            'benefits' => [self::RULE_REQUIRED ],
            'tags' => [self::RULE_REQUIRED ],
            'company' => [self::RULE_REQUIRED ],
            'address' => [self::RULE_REQUIRED ],
            'city' => [self::RULE_REQUIRED ],
            'state' => [self::RULE_REQUIRED ],
            'phone' => [self::RULE_REQUIRED ],
        ];
    }

    public function createUser(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [ self::RULE_REQUIRED, self::RULE_EMAIL],
            'city' => [self::RULE_REQUIRED],
            'state' => [self::RULE_REQUIRED ],
            'password' => [self::RULE_REQUIRED ],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

}
