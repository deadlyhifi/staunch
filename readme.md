#Staunch

A WordPress plugin to prevent automatic updates on your live sites.

##Description

The plugin installs into the `mu-plugins` folder and will be activated in any environment that doesn’t have a an environment variable of `ENV = 'development'`.

##Installation

Install through Composer. If you're new to Composer I heartily recommend [Composer in WordPress](http://composer.rarst.net/), [Using Composer with WordPress](https://roots.io/using-composer-with-wordpress/), and [WordPress Packagist](http://wpackagist.org/).

You'll need to declare it within repositories of the `composer.json` file.

e.g.
```
"repositories": [
    {
      "type": "composer",
      "url": "http://wpackagist.org"
    },
    {
      "type": "vcs",
      "url": "https://github.com/deadlyhifi/staunch"
    }
…
```

and then require it

```
"require": {
    …
    "deadlyhifi/staunch": "1.*"
```

##Changelog

= 1.0 =
* Composer version of original.

##Credits
Originally forked from [bigfishdesign/staunch](https://github.com/bigfishdesign/staunch)
