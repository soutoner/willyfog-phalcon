<?php

namespace Models;

use App\Db\Seeds\Models\RecognizerSeeder;
use App\Models\Recognizer;
use FunctionalTester;

class RecognizerCest
{
    /**
     * @var Recognizer
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Recognizer();
        $this->model->assign(RecognizerSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    // tests
}
