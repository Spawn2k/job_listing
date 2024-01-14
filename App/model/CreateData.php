<?php

namespace App\model;

use Faker\Factory;

class CreateData
{
    use Model;

    public array $fillable = [
        'user_id',
        'email',
        'tags',
        'state',
        'city',
        'benefits',
        'requirements',
        'title',
        'address',
        'description',
        'company',
        'phone',
        'name',
        'password',
        'salary',
    ];

    public array $tableStructure = [
        'id' => 'BIGINT UNSIGNED primary key AUTO_INCREMENT',
        'firstname' => 'VARCHAR(60) NOT NULL',
        'lastname' => 'VARCHAR(60) NOT NULL',
        'email' => 'VARCHAR(60) NOT NULL',
        'password' => 'VARCHAR(255) NOT NULL',
        'age' => 'int',
        'phone' => 'VARCHAR(60) NOT NULL'
    ];

    public function init(): self
    {
        $query = '';

        foreach ($this->tableStructure as $key => $value) {

            $query .= "$key $value, ";
        }

        $query = trim($query, ', ');

        $sql = "CREATE TABLE IF NOT EXISTS $this->table ($query)";

        $stmt = $this->db()->query($sql);

        return $this;
    }

    public function insertData(int $count = 0, array $data = []): self
    {
        $faker = Factory::create();
        $input = [];

        for ($i = 0; $i < $count; $i++) {
            $a = null;
            $b = null;

            foreach($data as $key => $value) {

                if(!is_array($value)) {
                    $input[$key] = $faker->{$value}();
                    continue;
                }

                if(count($value) > 1) {
                    $a = $value[1][0];

                    if (count($value[1]) > 1) {
                        $b = $value[1][1];
                    }

                    $input[$key] = $faker->{$value[0]}($a, $b);
                }

                if (is_array($value) && count($value) < 2) {
                    $input[$key] = $faker->{$value[0]};
                }
            };
            $this->insert($input);
        }

        return $this;
    }

    public function setTableStructure(array $structure = []): self
    {
        $this->tableStructure = $structure;
        return $this;
    }

    public function setTable(string $table): self
    {
        $this->table = $table;
        return $this;
    }

}
