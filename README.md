![](https://heatbadger.now.sh/github/readme/contributte/psr6-caching/)

<p align=center>
    <a href="https://github.com/contributte/psr6-caching/actions"><img src="https://badgen.net/github/checks/contributte/psr6-caching"></a>
    <a href="https://coveralls.io/r/contributte/psr6-caching"><img src="https://badgen.net/coveralls/c/github/contributte/psr6-caching"></a>
    <a href="https://packagist.org/packages/contributte/psr6-caching"><img src="https://badgen.net/packagist/dm/contributte/psr6-caching"></a>
    <a href="https://packagist.org/packages/contributte/psr6-caching"><img src="https://badgen.net/packagist/v/contributte/psr6-caching"></a>
</p>
<p align=center>
    <a href="https://packagist.org/packages/contributte/psr6-caching"><img src="https://badgen.net/packagist/php/contributte/psr6-caching"></a>
    <a href="https://github.com/contributte/psr6-caching"><img src="https://badgen.net/github/license/contributte/psr6-caching"></a>
    <a href="https://bit.ly/ctteg"><img src="https://badgen.net/badge/support/gitter/cyan"></a>
    <a href="https://bit.ly/cttfo"><img src="https://badgen.net/badge/support/forum/yellow"></a>
    <a href="https://contributte.org/partners.html"><img src="https://badgen.net/badge/sponsor/donations/F96854"></a>
</p>

<p align=center>
    Website 🚀 <a href="https://contributte.org">contributte.org</a> | Contact 👨🏻‍💻 <a href="https://f3l1x.io">f3l1x.io</a> | Twitter 🐦 <a href="https://twitter.com/contributte">@contributte</a>
</p>

PSR-6 (Caching Interface) adapter for [Nette Caching](https://github.com/nette/caching).

## Versions

| State       | Version | Branch   | Nette | PHP    |
|-------------|---------|----------|-------|--------|
| dev         | `^0.5`  | `master` | 3.3+  | `8.2+` |
| stable      | `^0.4`  | `master` | 3.3+  | `8.2+` |

## Installation

To install the latest version of `contributte/psr6-caching` use [Composer](https://getcomposer.org).

```bash
composer require contributte/psr6-caching
```

## Setup

Register extension:

```neon
extensions:
	psr6: Contributte\Psr6\DI\Psr6CachingExtension
```

## Usage

Get `ICachePoolFactory` from DI:

```php
use Contributte\Psr6\ICachePoolFactory;

class MyClass
{

	/** @var ICachePoolFactory */
	private $cachePoolFactory;

	public function __construct(ICachePoolFactory $cachePoolFactory) {
		$this->cachePoolFactory = $cachePoolFactory;
	}

	private function doSomething(): void
	{
		$cachePool = $this->cachePoolFactory->create('namespace');
	}

}
```

Rest is in [PSR-6 documentation](https://www.php-fig.org/psr/psr-6/).

## Development

See [how to contribute](https://contributte.org/contributing.html) to this package.

This package is currently maintaining by these authors.

<a href="https://github.com/vody105">
  <img width="80" height="80" src="https://avatars1.githubusercontent.com/u/22433893?v=4&s=80">
</a>

<a href="https://github.com/f3l1x">
  <img width="80" height="80" src="https://avatars2.githubusercontent.com/u/538058?v=4&s=80">
</a>

-----

Consider to [support](https://contributte.org/partners.html) **contributte** development team.
Also thank you for using this package.
