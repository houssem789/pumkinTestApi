<?php

declare(strict_types=1);

namespace App\Tests\Path;

use App\Tests\Path\Path;
use PHPUnit\Framework\TestCase;

/**
 * @group test-path
 */
final class PathTest extends TestCase
{
    /**
     * @dataProvider provideDataTest
     */
    public function testExecuteFromProvider(string $initPath, string $cd, string $expected): void
    {
        $path = Path::from($initPath);
        $actual = $path->cd($cd)->current();
        self::assertEquals($expected, $actual);
    }
    public function provideDataTest(): iterable
    {
        yield 'Test should return same folder' => ['/home/pumpkin', '.', '/home/pumpkin'];
        yield 'Test should return root folder' => ['/home/pumpkin', '/', '/'];
        yield 'Test should return parent folder' => ['/home/pumpkin', '..', '/home'];
        yield 'Test should return new path' => ['/home/pumpkin', '/home/pumpkin-app', '/home/pumpkin-app'];
        yield 'Test should return from child path' => ['/home/pumpkin', '../pumpkin-app', '/home/pumpkin-app'];
        yield 'Test should return path from complex input' => ['/tmp/var/cache', '.././cache/../../../home/./../home/pumpkin/../pumpkin/Downloads', '/home/pumpkin/Downloads'];
    }
}