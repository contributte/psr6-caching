<?php declare(strict_types = 1);

namespace Tests\Cases\DI;

use Contributte\Psr6\CachePoolFactory;
use Contributte\Psr6\DI\Psr6CachingExtension;
use Contributte\Psr6\ICachePoolFactory;
use Contributte\Tester\Environment;
use Contributte\Tester\Toolkit;
use Contributte\Tester\Utils\ContainerBuilder;
use Nette\Bridges\CacheDI\CacheExtension;
use Nette\DI\Compiler;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$container = ContainerBuilder::of()
		->withCompiler(static function (Compiler $compiler): void {
			$compiler->addExtension('cache', new CacheExtension(Environment::getTestDir()));
			$compiler->addExtension('psr6', new Psr6CachingExtension());
		})
		->build();

	Assert::true($container->hasService('psr6.factory'));
	Assert::type(CachePoolFactory::class, $container->getService('psr6.factory'));
	Assert::type(CachePoolFactory::class, $container->getByType(ICachePoolFactory::class));
});
