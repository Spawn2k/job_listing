<?php

namespace App\form\auth;

use App\db\DbFactory;
use App\form\rules\Rules;
use Exception;

//how to validate
// 1. first create new private string. name of the variable must be exact the name of the input field attribute name
// if input field name='firstname' then the private string must be private string $firstname.
// 2. call the method loadData
// 3. call the method validate. The argument of the method must be the name from the Rules class method name
// like validate('createRules'). in the class Rules must be a method with the name public function createRules
// if the validation failed the method validate() will return false
// call $this->errors to get the error message;
// key of the array is the name attribute of the input field.
// value of they array is the error message.


class Validate extends Rules
{
    use DbFactory;
    private string $firstname = '';
    private string $lastname = '';
    private string $user_id = '';
    private string $password = '';
    private string $confirmPassword= '';
    private string $role = '';
    private int $admin = 0;
    private string $title = '';
    private string $description = '';
    private string $salry = '';
    private string $company = '';
    private string $address = '';
    private string $city = '';
    private string $sate = '';
    private string $phone = '';
    private string $requirements = '';
    private string $benefits = '';
    private string $email = '';
    private string $tags = '';

    private int $id = 0;
    public array $errors = [];

    protected string $table = '';

    public function validate(array $rulesSet): bool
    {
        //          $rules =  [
        //            'firstname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '16']],
        //            'email' => [self::RULE_UPDATE],
        //            'confirmPassword' => [self::RULE_MATCH, ['match' => 'password']],
        //        ];


        foreach ($rulesSet as $attribute => $rules) {
            $value = $this->{$attribute}; // $value = $this->firstname dont forget to call the method loadData first
            foreach ($rules as $rule) {
                $ruleName = $rule; // $ruleName = self::RULE_REQUIRED ('required');
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0]; // [self::RULE_MIN, 'max' => '16']] $ruleName = self::RULE_MIN
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) { // $ruleName === self::RULE_REQUIRED true && !value ($this->firstname)
                    $this->addErrors($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrors($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen(
                    $value
                ) < $rule['min']) { // $rule['min'] -> [self::RULE_MIN, 'min' => '3']] = 3;
                    $this->addErrors($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrors($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_UNIQUE && !$this->isUnique($attribute, $value)) {
                    $column = [];
                    $column['unique'] = $attribute; // ['unique' => 'email'];
                    $this->addErrors($attribute, self::RULE_UNIQUE, $column);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) { // $this->{$rule['match']} = $this->password
                    $this->addErrors($attribute, self::RULE_MATCH, $rule);
                }
                if ($ruleName === self::RULE_NUMERIC && !is_numeric($value)) {
                    $this->addErrors($attribute, self::RULE_NUMERIC);
                }
                if ($ruleName === self::RULE_UPDATE && !$this->isUniqueNot($attribute, $value, $this->id)) {
                    $column = [];
                    $column['unique'] = $attribute;
                    $this->addErrors($attribute, self::RULE_UNIQUE, $column);
                }
            }
        }
        return empty($this->errors);
    }

    public function addErrors(string $attribute, string $rule, array $params = []): void
    {
        // $this->errorMessages() = [ self::RULE_UNIQUE => '{unique} is already created'];
        $message = $this->errorMessages()[$rule] ?? ''; // $message = '{unique} is already created';
        // $params = ['unique' => 'email'];
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message); // $message = 'email is already created';
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email address',
            self::RULE_MIN => 'Min Length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_UNIQUE => '{unique} is already created',
            self::RULE_NUMERIC => 'This field accept only number',
            self::RULE_MATCH => 'This field must be the same as {match}'
        ];
    }

    public function loadData(array $data): void
    {
        //        ['firstname' =>'Jon Wick'];
        foreach ($data as $key => $value) {
            $this->{$key} = $value; // $this->firstname = 'Jon Wick';
        }
    }

    private function isUnique(string $key, string $value): bool
    {
        $query = "SELECT * FROM $this->table where $key = ?";
        $stm = $this->db()->prepare($query);
        $stm->execute([$value]);
        $data = $stm->fetchAll();
        return empty($data);
    }

    public function isUniqueNot(string $key, string $value, string|int $id): bool
    {
        $data = [];
        $data[$key] = $value;
        $data['id'] = $id;
        $sql = "Select * from $this->table where $key = :$key and id != :id";
        try {
            $stmt = $this->db()->prepare($sql);
            $stmt->execute($data);
            $result = $stmt->fetchAll();
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        return empty($result);
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }

}
