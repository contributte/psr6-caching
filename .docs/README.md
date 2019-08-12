# Contributte PSR6 Caching

[PSR-6 (Caching Interface)](https://www.php-fig.org/psr/psr-6/) adapter for [Nette Caching](https://github.com/nette/caching)

## Content

- [Setup](#setup)
- [Usage](#usage)

## Setup

Install package

```bash
composer require contributte/psr6-caching
```

Register extension

```yaml
extensions:
  psr6: Contributte\Psr6\DI\Psr6CachingExtension
```

## Usage

Get `ICachePoolFactory` from DI

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

Rest is in [psr-6 documentation](https://www.php-fig.org/psr/psr-6/)
