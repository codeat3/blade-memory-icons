<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Config;
use BladeUI\Icons\BladeIconsServiceProvider;
use Codeat3\BladeMemoryIcons\BladeMemoryIconsServiceProvider;

class CompilesIconsTest extends TestCase
{
    /** @test */
    public function it_compiles_a_single_anonymous_component()
    {
        $result = svg('memory-account')->toHtml();

        // Note: the empty class here seems to be a Blade components bug.
        $expected = <<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" fill="currentColor"><path d="M9 3H13V4H14V5H15V9H14V10H13V11H9V10H8V9H7V5H8V4H9V3M10 8V9H12V8H13V6H12V5H10V6H9V8H10M7 12H15V13H17V14H18V15H19V19H3V15H4V14H5V13H7V12M6 16H5V17H17V16H16V15H14V14H8V15H6V16Z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('memory-account', 'w-6 h-6 text-gray-500')->toHtml();

        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" fill="currentColor"><path d="M9 3H13V4H14V5H15V9H14V10H13V11H9V10H8V9H7V5H8V4H9V3M10 8V9H12V8H13V6H12V5H10V6H9V8H10M7 12H15V13H17V14H18V15H19V19H3V15H4V14H5V13H7V12M6 16H5V17H17V16H16V15H14V14H8V15H6V16Z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_styles_to_icons()
    {
        $result = svg('memory-account', ['style' => 'color: #555'])->toHtml();

        $expected = <<<'SVG'
            <svg style="color: #555" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" fill="currentColor"><path d="M9 3H13V4H14V5H15V9H14V10H13V11H9V10H8V9H7V5H8V4H9V3M10 8V9H12V8H13V6H12V5H10V6H9V8H10M7 12H15V13H17V14H18V15H19V19H3V15H4V14H5V13H7V12M6 16H5V17H17V16H16V15H14V14H8V15H6V16Z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_default_class_from_config()
    {
        Config::set('blade-memory-icons.class', 'awesome');

        $result = svg('memory-account')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" fill="currentColor"><path d="M9 3H13V4H14V5H15V9H14V10H13V11H9V10H8V9H7V5H8V4H9V3M10 8V9H12V8H13V6H12V5H10V6H9V8H10M7 12H15V13H17V14H18V15H19V19H3V15H4V14H5V13H7V12M6 16H5V17H17V16H16V15H14V14H8V15H6V16Z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_merge_default_class_from_config()
    {
        Config::set('blade-memory-icons.class', 'awesome');

        $result = svg('memory-account', 'w-6 h-6')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" fill="currentColor"><path d="M9 3H13V4H14V5H15V9H14V10H13V11H9V10H8V9H7V5H8V4H9V3M10 8V9H12V8H13V6H12V5H10V6H9V8H10M7 12H15V13H17V14H18V15H19V19H3V15H4V14H5V13H7V12M6 16H5V17H17V16H16V15H14V14H8V15H6V16Z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladeMemoryIconsServiceProvider::class,
        ];
    }
}
