<?php

namespace Controllers;

use App\Db\Seeds\Models\CitySeeder;
use App\Models\City;
use FunctionalTester;

class BaseControllerCest
{
    public $endpoint = '/v1/cities/';

    public function paginateReturnsPagination(FunctionalTester $I)
    {
        $I->sendGET($this->endpoint);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(City::find()->toArray());
    }

    public function paginateReturnsPaginationWithPage(FunctionalTester $I)
    {
        CitySeeder::Seed(true);
        $I->sendGET($this->endpoint, ['page' => '2']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['current' => 2]);
    }

    public function createResponseSuccesful(FunctionalTester $I)
    {
        $model_params = CitySeeder::ExtraSeeds(0);
        $I->sendPOST($this->endpoint, $model_params);
        $I->seeResponseCodeIs(201);
        $I->seeResponseContains('Created');
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            City::findFirstByName($model_params['name'])->toArray()
        );
    }

    public function createResponseWithErrors(FunctionalTester $I)
    {
        $model_params = CitySeeder::ExtraSeeds(0);
        $model_params['name'] = '';
        $I->sendPOST($this->endpoint, $model_params);
        $I->seeResponseCodeIs(409);
        $I->seeResponseIsJson();
        $I->seeResponseContains('data');
        $I->seeResponseContains('name');
        $I->assertGreaterThan(0, count(json_decode($I->grabResponse())->data));
    }

    public function updateResponseSuccessful(FunctionalTester $I)
    {
        $id = 1;
        $I->sendPUT($this->endpoint . $id, ['name' => 'Pepito']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContains('Updated');
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(City::findFirst($id)->toArray());
    }

    public function updateResponseWithErrors(FunctionalTester $I)
    {
        $id = 1;
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPUT($this->endpoint . $id, 'name=' . City::findFirst(2)->name);
        $I->seeResponseCodeIs(409);
        $I->seeResponseIsJson();
        $I->seeResponseContains('data');
        $I->seeResponseContains('name');
        $I->assertGreaterThan(0, count(json_decode($I->grabResponse())->data));
    }

    public function updateResponseWhenNotFound(FunctionalTester $I)
    {
        $id = 0;
        $I->sendPUT($this->endpoint . $id);
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
    }

    /**
     * DELETE.
     */
    public function deleteResponseSuccessful(FunctionalTester $I)
    {
        $id = 1;
        $I->sendDELETE($this->endpoint . $id);
        $I->seeResponseCodeIs(200);
        $I->seeResponseContains('Deleted');
        $I->seeResponseIsJson();
    }
    public function deleteResponseWhenNotFound(FunctionalTester $I)
    {
        $id = 0;
        $I->sendDELETE($this->endpoint . $id);
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
    }
}
