<?php declare(strict_types = 1);

namespace Contributte\Psr6;

use Nette\Caching\Cache;
use Nette\Caching\Storage;
use Psr\Cache\CacheItemPoolInterface;

class CachePoolFactory implements ICachePoolFactory
{

	private Storage $storage;

	public function __construct(Storage $storage)
	{
		$this->storage = $storage;
	}

	public function create(string $namespace): CacheItemPoolInterface
	{
		return new CachePool(new Cache($this->storage, $namespace));
	}

}
