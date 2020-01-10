Placeholder Provider
====================

imageurl provider for [Faker](https://github.com/fzaninotto/Faker).
- [Placeholder](https://placeholder.com/)
- [Fake images please?](https://fakeimg.pl/)


## Install
Install the PlaceholderProvider adding `asperhsu/faker-imageurl-provider` to your composer.json or from CLI:

```
$ composer require asperhsu/faker-imageurl-provider
```

## Usage

### Placeholder
```php
$faker = Faker\Factory::create();
$faker->addProvider(new Asper\Faker\PlaceholderProvider($faker));

// size
$url = $faker->imageUrl(50); // https://via.placeholder.com/50
$url = $faker->imageUrl(50, 50); // https://via.placeholder.com/50
$url = $faker->imageUrl(50, 100); // https://via.placeholder.com/50x100

// background color
$url = $faker->imageUrl(50, null, '000000'); // https://via.placeholder.com/50.png/000000

// text color
$url = $faker->imageUrl(50, null, '000000', 'ffffff'); // https://via.placeholder.com/50.png/000000/FFFFFF

// text
$url = $faker->imageUrl(50, null, null, null, 'lorem ipsum'); // https://via.placeholder.com/50?text=lorem+ipsum

// format
// can be gif, jpeg, jpg or png
$url = $faker->imageUrl(50, null, null, null, null, 'gif'); // https://via.placeholder.com/50.gif
$url = $faker->imageUrl(50, null, null, null, null, 'jpg'); // https://via.placeholder.com/50.jpg
$url = $faker->imageUrl(50, null, null, null, null, 'jpeg'); // https://via.placeholder.com/50.jpeg
$url = $faker->imageUrl(50, null, null, null, null, 'png'); // https://via.placeholder.com/50.png

// or use array
$url = $faker->imageUrl([
    'width' => null,
    'height' => null,
    'background' => null,
    'color' => null,
    'text' => null,
    'extension' => null,
]);
```

### Fake images please?
```php

$faker = Faker\Factory::create();
$faker->addProvider(new Asper\Faker\FakeImgProvider($faker));

// size
$url = $faker->imageUrl(50); // https://fakeimg.pl/50
$url = $faker->imageUrl(50, 50); // https://fakeimg.pl/50
$url = $faker->imageUrl(50, 100); // https://fakeimg.pl/50x100

// background color
$url = $faker->imageUrl(50, null, '000000'); // https://fakeimg.pl/50/000000

// text color
$url = $faker->imageUrl(50, null, '000000', 'ffffff'); // https://fakeimg.pl/50/000000/FFFFFF

// text
$url = $faker->imageUrl(50, null, null, null, 'lorem ipsum'); // https://fakeimg.pl/50?text=lorem+ipsum

// retina
$url = $faker->imageUrl(50, null, null, null, null, true); // https://fakeimg.pl/50?retina=1

// font
// font consts: FONT_LOBSTER, FONT_BEBAS, FONT_MUSEO, FONT_NOTO
$url = $faker->imageUrl(50, null, null, null, null, false, FakeImgProvider::FONT_NOTO); // https://fakeimg.pl/50?font=noto

// or use array
$url = $faker->imageUrl([
    'width' => null,
    'height' => null,
    'background' => null,
    'color' => null,
    'text' => null,
    'retina' => false,
    'font' => null,
]);
```