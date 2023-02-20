<?php

namespace Rintveld\Tests\Models;

use PHPUnit\Framework\TestCase;
use Rintveld\Models\ActionUri;

class ActionUriTest extends TestCase
{
    public function testWithoutQueryParameters(): void
    {
        $action = 'test-without-query-parameters';
        $uri = (new ActionUri($action))->uri();

        $this->assertEquals($action, $uri);
    }

    public function testWithQueryParameters(): void
    {
        $uri = (new ActionUri('test-with-query-parameters'))->addParameters(['id' => 1, 'test' => 123])->uri();

        $this->assertEquals('test-with-query-parameters?id=1&test=123', $uri);
    }
}
