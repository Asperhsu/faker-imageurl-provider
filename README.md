Placeholder Provider
====================

[placeholder](https://placeholder.com/) provider for [Faker](https://github.com/fzaninotto/Faker).


## Install
Install the PlaceholderProvider adding `asperhsu/faker-placeholder-provider` to your composer.json or from CLI:

```
$ composer require asperhsu/faker-placeholder-provider
```

## Usage

```php
$faker = Faker\Factory::create();
$faker->addProvider(new Asper\Faker\PlaceholderProvider($faker));

// size
$url = $faker->imageUrl(50); // https://via.placeholder.com/50
$url = $faker->imageUrl(50, 50); // https://via.placeholder.com/50
$url = $faker->imageUrl(50, 100); // https://via.placeholder.com/50x100

// format
// can be gif, jpeg, jpg or png
$url = $faker->imageUrl(50, 50, 'gif'); // https://via.placeholder.com/50.gif
$url = $faker->imageUrl(50, 50, 'jpg'); // https://via.placeholder.com/50.jpg
$url = $faker->imageUrl(50, 100, 'jpeg'); // https://via.placeholder.com/50x100.jpeg
$url = $faker->imageUrl(50, 100, 'png'); // https://via.placeholder.com/50x100.png

// background color
$url = $faker->imageUrl(50, null, 'png', '000000'); // https://via.placeholder.com/50.png/000000

// text color
$url = $faker->imageUrl(50, null, 'png', '000000', 'ffffff'); // https://via.placeholder.com/50.png/000000/FFFFFF

// text
$url = $faker->imageUrl(50, null, null, null, null, 'lorem ipsum'); // https://via.placeholder.com/50?text=lorem+ipsum
```
