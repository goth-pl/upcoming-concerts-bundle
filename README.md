# GothUpcomingConcertsBundle
This bundle adds the upcoming concerts list (for given artist) into Symfony 2 application.

In progress...

## Requirements
* PHP 7.0
* Symfony 2.8 or later

## Installation
TODO

Enable the bundle in app/AppKernel.php file:
```php
$bundles = array(
    // ...
    new Goth\UpcomingConcertsBundle\GothUpcomingConcertsBundle(),
);
```


The bundle contains a basic stylesheet for the list. You can use it adding it to your bundle:

```
bundles/gothupcomingconcerts/css/goth-upcoming-concerts.css
```

Copy assets to your `web` directory using one of these commands:

For Symfony 2.x:

```
php app/console assets:install --symlink
```

For Symfony 3.x:

```
php bin/console assets:install --symlink
```

Or you can write your own styles :)

## Providers
At this time the bundle delivers only BandsInTown provider. You have to specify your app_id in parameters.yml file
of your Symfony application. It can be anything, but should be a word that describes your application or company.

```yaml
parameters:
    goth_upcoming_concerts.bandsintown.app_id: YOUR_APP_ID
```

## Usage
Insert `{{ goth_upcoming_concerts_render('BAND_NAME') }}` wherever you want to put the list.
Change _BAND_NAME_ with the artist whose concerts you would like to show.

## Contributing
Bug reports and pull requests are welcome on GitHub at https://github.com/goth-pl/upcoming-concerts-bundle

## License

The gem is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).