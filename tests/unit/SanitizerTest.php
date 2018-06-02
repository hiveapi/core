<?php

class SanitizerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

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

    protected function _before()
    {
        $this->transporter = new \HiveApi\CoreTest\Models\SanitizerTest\TestTransporter($this->testdata);
    }

    protected function _after()
    {
    }

    /**
     * @test
     */
    public function checkInputByKeys()
    {
        $name = $this->transporter->getInputByKey('data.name');
        $this->tester->assertEquals($this->testdata['data']['name'], $name);
    }

    /**
     * @test
     */
    public function checkInputByKeysWithUnknownKey()
    {
        $unknown = $this->transporter->getInputByKey('data.unknown.key');
        $this->tester->assertNull($unknown);
    }

    /**
     * @test
     */
    public function checkInputByKeyWithDefaultValue()
    {
        $default = $this->transporter->getInputByKey('data.unknown.key', 'default');
        $this->tester->assertEquals('default', $default);
    }

    /**
     * @test
     */
    public function checkInputByKeyWithArray()
    {
        $items = $this->transporter->getInputByKey('data.items');
        $this->tester->assertEquals(count($this->testdata['data']['items']), count($items));
    }

    /**
     * @test
     */
    public function sanitizeData()
    {
        $data = $this->transporter->sanitizeInput(['data']);
        $data = $data['data'];

        $this->tester->assertEquals($this->testdata['data'], $data);
    }

    /**
     * @test
     */
    public function sanitizeUnknownKeys()
    {
        $data = $this->transporter->sanitizeInput([
            'data.unknown.key',
            'meta.article.author',
        ]);

        $this->tester->assertEmpty($data['data']);
        $this->tester->assertEmpty($data['meta']);
    }

    /**
     * @test
     */
    public function sanitizeDataByKeys()
    {
        $data = $this->transporter->sanitizeInput([
            'data.name',
            'data.email',
            'data.items',
        ]);
        $data = $data['data'];

        $this->tester->assertEquals($this->testdata['data'], $data);
    }

    /**
     * @test
     */
    public function sanitizeItems()
    {
        $data = $this->transporter->sanitizeInput([
            'data.items'
        ]);
        $data = $data['data']['items'];

        $this->tester->assertEquals($this->testdata['data']['items'], $data);
    }
}