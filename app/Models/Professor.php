<?php

namespace App\Models;

use Phalcon\Mvc\Model\Validator\StringLength;
use Phalcon\Mvc\Model\Validator\Email;

class Professor extends BaseModel
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $nif;

    /**
     * @var string
     */
    public $email;

    /**
     * @var int
     */
    public $coordinator_id;

    /**
     * @var int
     */
    public $recognizer_id;

    public function initialize()
    {
        parent::initialize();

        $this->belongsTo(
            'coordinator_id',
            'App\Models\Coordinator',
            'id',
            [
                'alias'      => 'Coordinator',
                'foreignKey' => [
                    'allowNulls' => true
                ]
            ]
        );

        $this->belongsTo(
            'recognizer_id',
            'App\Models\Recognizer',
            'id',
            [
                'alias'      => 'Recognizer',
                'foreignKey' => [
                    'allowNulls' => true
                ]
            ]
        );
    }

    public function validation()
    {
        $this->validate(new StringLength([
            'field' => 'nif',
            'max'   => 12
        ]));

        $this->validate(new StringLength([
            'field' => 'name',
            'max'   => 25
        ]));

        $this->validate(new StringLength([
            'field' => 'surname',
            'max'   => 60
        ]));

        $this->validate(new StringLength([
            'field' => 'email',
            'max'   => 45
        ]));

        $this->validate(new Email(['field' => 'email']));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
