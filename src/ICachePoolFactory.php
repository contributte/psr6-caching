<?php declare(strict_types = 1);

namespace Contributte\Psr6;

use Psr\Cache\CacheItemPoolInterface;

interface ICachePoolFactory
{

	public function create(string $namespace): CacheItemPoolInterface;

}
