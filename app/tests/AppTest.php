<?php

namespace BareBones\Tests;

use BareBones\Tests\Pages\Page as TestPage;
use SilverStripe\Dev\FunctionalTest;

class AppTest extends FunctionalTest
{
    protected static $fixture_file = 'app/tests/fixtures.yml';

    private static $index = null;

    protected static $extra_dataobjects = [
        TestPage::class,
    ];

    protected $usesDatabase = true;

    protected function setUp()
    {
        $page = new TestPage(['Title' => "Home"]);
        $page->write();
        $page->publishRecursive();

        parent::setUp();
    }

    public function testViewHomePage()
    {
        $page = $this->get('/home');

        // Home page should load..
        $this->assertEquals(200, $page->getStatusCode());
    }
}
