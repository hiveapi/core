<?php

namespace HiveApi\CoreTest\Tests\Unit;

use HiveApi\Core\Abstracts\Tests\Cests\BaseCest;
use HiveApi\CoreTest\Models\SanitizerTest\TestTransporter;
use HiveApi\CoreTest\Tests\UnitTester;

/**
 * @group core
 * @group unit
 */
class SanitizerTestCest extends BaseCest
{
    private $testdata = [
        'data' => [
            'name' => 'John',
            'email' => 'test@example.com',
            'items' => [
                ['id' => 1, 'name' => 'product 1'],
                ['id' => 2, 'name' => 'product 2'],
                ['id' => 3, 'name' => 'product 3'],
            ],
        ],
        'meta' => [
            'created' => '2018-06-02',
            'author' => 'johndoe',
        ],
    ];

    /** @var  \HiveApi\Core\Abstracts\Transporters\Transporter */
    private $transporter;

    public function _before()
    {
        $this->transporter = new TestTransporter($this->testdata);
    }

    public function _after()
    {
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function checkInputByKeys(UnitTester $I)
    {
        $name = $this->transporter->getInputByKey('data.name');
        $I->assertEquals($this->testdata['data']['name'], $name);
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function checkInputByKeysWithUnknownKey(UnitTester $I)
    {
        $unknown = $this->transporter->getInputByKey('data.unknown.key');
        $I->assertNull($unknown);
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function checkInputByKeyWithDefaultValue(UnitTester $I)
    {
        $default = $this->transporter->getInputByKey('data.unknown.key', 'default');
        $I->assertEquals('default', $default);
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function checkInputByKeyWithArray(UnitTester $I)
    {
        $items = $this->transporter->getInputByKey('data.items');
        $I->assertEquals(count($this->testdata['data']['items']), count($items));
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function sanitizeData(UnitTester $I)
    {
        $data = $this->transporter->sanitizeInput(['data']);
        $data = $data['data'];

        $I->assertEquals($this->testdata['data'], $data);
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function sanitizeUnknownKeys(UnitTester $I)
    {
        $data = $this->transporter->sanitizeInput([
            'data.unknown.key',
            'meta.article.author',
        ]);

        $I->assertEmpty($data['data']);
        $I->assertEmpty($data['meta']);
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function sanitizeDataByKeys(UnitTester $I)
    {
        $data = $this->transporter->sanitizeInput([
            'data.name',
            'data.email',
            'data.items',
        ]);
        $data = $data['data'];

        $I->assertEquals($this->testdata['data'], $data);
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function sanitizeItems(UnitTester $I)
    {
        $data = $this->transporter->sanitizeInput([
            'data.items'
        ]);
        $data = $data['data']['items'];

        $I->assertEquals($this->testdata['data']['items'], $data);
    }
}