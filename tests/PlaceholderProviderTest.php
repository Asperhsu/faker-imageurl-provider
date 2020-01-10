<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Asper\Faker\PlaceholderProvider;

class PlaceholderProviderTest extends TestCase
{
    public $faker;

    protected function setUp(): void
    {
        $this->faker = \Faker\Factory::create();
        $this->faker->addProvider(new PlaceholderProvider($this->faker));
    }

    public function testImageUrlSize()
    {
        $this->assertEquals('https://via.placeholder.com/640', $this->faker->imageUrl());
        $this->assertEquals('https://via.placeholder.com/50', $this->faker->imageUrl(50));
        $this->assertEquals('https://via.placeholder.com/50', $this->faker->imageUrl(50, 50));
        $this->assertEquals('https://via.placeholder.com/50x100', $this->faker->imageUrl(50, 100));

        $this->assertEquals('https://via.placeholder.com/50', $this->faker->imageUrl([
            'width' => 50,
            'height' => 50,
        ]));
    }

    public function testImageUrlBackgroundColor()
    {
        $this->assertEquals('https://via.placeholder.com/50/000000', $this->faker->imageUrl(50, null, '000000'));

        $this->assertEquals('https://via.placeholder.com/50/000000', $this->faker->imageUrl([
            'width' => 50,
            'background' => '000000',
        ]));
    }

    public function testImageUrlTextColor()
    {
        $this->assertEquals('https://via.placeholder.com/50//FFFFFF', $this->faker->imageUrl(50, null, null, 'ffffff'));
        $this->assertEquals('https://via.placeholder.com/50//FFFFFF', $this->faker->imageUrl([
            'width' => 50,
            'color' => 'ffffff',
        ]));

        $this->assertEquals('https://via.placeholder.com/50/000000/FFFFFF', $this->faker->imageUrl(50, null, '000000', 'ffffff'));
        $this->assertEquals('https://via.placeholder.com/50/000000/FFFFFF', $this->faker->imageUrl([
            'width' => 50,
            'background' => '000000',
            'color' => 'ffffff',
        ]));
    }

    public function testImageUrlText()
    {
        $this->assertEquals('https://via.placeholder.com/50?text=lorem+ipsum', $this->faker->imageUrl(50, null, null, null, 'lorem ipsum'));
        $this->assertEquals('https://via.placeholder.com/50?text=lorem+ipsum', $this->faker->imageUrl([
            'width' => 50,
            'text' => 'lorem ipsum',
        ]));
    }

    public function testImageUrlFormat()
    {
        $this->assertEquals('https://via.placeholder.com/50.gif', $this->faker->imageUrl(50, null, null, null, null, 'gif'));
        $this->assertEquals('https://via.placeholder.com/50.jpg', $this->faker->imageUrl(50, null, null, null, null, 'jpg'));
        $this->assertEquals('https://via.placeholder.com/50.jpeg', $this->faker->imageUrl(50, null, null, null, null, 'jpeg'));
        $this->assertEquals('https://via.placeholder.com/50.png', $this->faker->imageUrl(50, null, null, null, null, 'png'));

        $this->assertEquals('https://via.placeholder.com/50.png', $this->faker->imageUrl([
            'width' => 50,
            'extension' => 'png',
        ]));
    }
}
