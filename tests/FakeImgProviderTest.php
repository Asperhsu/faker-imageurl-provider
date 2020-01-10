<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Asper\Faker\FakeImgProvider;

class FakeImgProviderTest extends TestCase
{
    public $faker;

    protected function setUp(): void
    {
        $this->faker = \Faker\Factory::create();
        $this->faker->addProvider(new FakeImgProvider($this->faker));
    }

    public function testImageUrlSize()
    {
        $this->assertEquals('https://fakeimg.pl/640', $this->faker->imageUrl());
        $this->assertEquals('https://fakeimg.pl/50', $this->faker->imageUrl(50));
        $this->assertEquals('https://fakeimg.pl/50', $this->faker->imageUrl(50, 50));
        $this->assertEquals('https://fakeimg.pl/50x100', $this->faker->imageUrl(50, 100));

        $this->assertEquals('https://fakeimg.pl/50', $this->faker->imageUrl([
            'width' => 50,
            'height' => 50,
        ]));
    }

    public function testImageUrlBackgroundColor()
    {
        $this->assertEquals('https://fakeimg.pl/50/000000', $this->faker->imageUrl(50, null, '000000'));

        $this->assertEquals('https://fakeimg.pl/50/000000', $this->faker->imageUrl([
            'width' => 50,
            'background' => '000000',
        ]));
    }

    public function testImageUrlTextColor()
    {
        $this->assertEquals('https://fakeimg.pl/50//FFFFFF', $this->faker->imageUrl(50, null, null, 'ffffff'));
        $this->assertEquals('https://fakeimg.pl/50//FFFFFF', $this->faker->imageUrl([
            'width' => 50,
            'color' => 'ffffff',
        ]));

        $this->assertEquals('https://fakeimg.pl/50/000000/FFFFFF', $this->faker->imageUrl(50, null, '000000', 'ffffff'));
        $this->assertEquals('https://fakeimg.pl/50/000000/FFFFFF', $this->faker->imageUrl([
            'width' => 50,
            'background' => '000000',
            'color' => 'ffffff',
        ]));
    }

    public function testImageUrlText()
    {
        $this->assertEquals('https://fakeimg.pl/50?text=lorem+ipsum', $this->faker->imageUrl(50, null, null, null, 'lorem ipsum'));
        $this->assertEquals('https://fakeimg.pl/50?text=lorem+ipsum', $this->faker->imageUrl([
            'width' => 50,
            'text' => 'lorem ipsum',
        ]));
    }

    public function testImageUrlUseRetina()
    {
        $this->assertEquals('https://fakeimg.pl/50?retina=1', $this->faker->imageUrl(50, null, null, null, null, true));
        $this->assertEquals('https://fakeimg.pl/50?retina=1', $this->faker->imageUrl([
            'width' => 50,
            'retina' => true,
        ]));
    }

    public function testImageUrlUseFont()
    {
        $this->assertEquals('https://fakeimg.pl/50?font=lobster', $this->faker->imageUrl(50, null, null, null, null, false, FakeImgProvider::FONT_LOBSTER));
        $this->assertEquals('https://fakeimg.pl/50?font=bebas', $this->faker->imageUrl(50, null, null, null, null, false, FakeImgProvider::FONT_BEBAS));
        $this->assertEquals('https://fakeimg.pl/50?font=museo', $this->faker->imageUrl(50, null, null, null, null, false, FakeImgProvider::FONT_MUSEO));
        $this->assertEquals('https://fakeimg.pl/50?font=noto', $this->faker->imageUrl(50, null, null, null, null, false, FakeImgProvider::FONT_NOTO));

        $this->assertEquals('https://fakeimg.pl/50?font=noto', $this->faker->imageUrl([
            'width' => 50,
            'font' => FakeImgProvider::FONT_NOTO,
        ]));
    }
}
