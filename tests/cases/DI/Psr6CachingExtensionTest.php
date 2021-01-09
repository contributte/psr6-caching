<?php declare(strict_types = 1);

namespace Tests\Contributte\Psr6\Unit\DI;

use Contributte\Psr6\CachePoolFactory;
use Contributte\Psr6\DI\Psr6CachingExtension;
use Contributte\Psr6\ICachePoolFactory;
use Nette\Bridges\CacheDI\CacheExtension;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Ninjify\Nunjuck\Toolkit;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

function createContainer(): Container
{
	$tempDir = TEMP_DIR;
	$loader = new ContainerLoader($tempDir, true);
	$class = $loader->load(static function (Compiler $compiler) use ($tempDir): void {
		$compiler->addExtension('cache', new CacheExtension($tempDir));
		$compiler->addExtension('psr6', new Psr6CachingExtension());
	}, random_bytes(10));

	return new $class();
}

Toolkit::test(function (): void {
	$container = createContainer();
	Assert::true($container->hasService('psr6.factory'));
	Assert::type(CachePoolFactory::class, $container->getService('psr6.factory'));
	Assert::type(CachePoolFactory::class, $container->getByType(ICachePoolFactory::class));
});
