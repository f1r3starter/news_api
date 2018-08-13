<?php


class CreatePostCest
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
    public function createPostViaAPI(\ApiTester $I)
    {
        $randomTitle = $this->faker->name;
        $I->sendPOST('http://localhost:8080/api/v1/posts', ['title' => $randomTitle, 'content' => 'blah', 'category_id' => 1]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED);
        $I->seeResponseIsJson();
        $I->seeResponseContains($randomTitle);
        $I->sendGET('http://localhost:8080/api/v1/posts');
        $I->seeResponseContains($randomTitle);
    }


}
