<?php declare(strict_types = 1);

namespace Tests\Contributte\Psr6\Unit\DI;

use Contributte\Psr6\CachePoolFactory;
use Contributte\Psr6\DI\Psr6CachingExtension;
use Contributte\Psr6\ICachePoolFactory;
use Nette\Bridges\CacheDI\CacheExtension;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use PHPUnit\Framework\TestCase;

class Psr6CachingExtensionTest extends TestCase
{

	public function testRegistration(): void
	{
		$container = $this->createContainer();
		$this->assertTrue($container->hasService('psr6.factory'));
		$this->assertInstanceOf(CachePoolFactory::class, $container->getService('psr6.factory'));
		$this->assertInstanceOf(CachePoolFactory::class, $container->getByType(ICachePoolFactory::class));
	}

	private function createContainer(): Container
	{
		$tempDir = __DIR__ . '/../../../temp/tests/';
		$loader = new ContainerLoader($tempDir . getmypid(), true);
		$class = $loader->load(static function (Compiler $compiler) use ($tempDir): void {
			$compiler->addExtension('cache', new CacheExtension($tempDir));
			$compiler->addExtension('psr6', new Psr6CachingExtension());
		}, random_bytes(10));

		/** @var Container $container */
		return new $class();
	}

}
