<?php


class CreateCategoryCest
{
    /**
     * @var \Faker\Generator
     */
    private $faker;
    public function _before(\ApiTester $I)
    {
        $this->faker = Faker\Factory::create();
    }

    public function _after(\ApiTester $I)
    {
    }

    // tests
    public function CreateCategoryViaAPI(\ApiTester $I)
    {
        $randomTitle = $this->faker->name;
        $I->sendPOST('http://localhost:8000/api/v1/categories', ['name' => $randomTitle]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseContains($randomTitle);
        $I->sendGET('http://localhost:8000/api/v1/categories');
        $I->seeResponseContains($randomTitle);
    }

}
