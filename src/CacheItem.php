<?php declare(strict_types = 1);

namespace Contributte\Psr6;

use DateInterval;
use DateTimeImmutable;
use DateTimeInterface;
use Nette\Caching\Cache;
use Psr\Cache\CacheItemInterface;

class CacheItem implements CacheItemInterface
{

	/** @var mixed[] */
	protected array $dependencies = [];

	protected string $key;

	protected mixed $value;

	protected bool $hit;

	public function getKey(): string
	{
		return $this->key;
	}

	public function get(): mixed
	{
		return $this->value;
	}

	public function isHit(): bool
	{
		return $this->hit;
	}

	public function set(mixed $value): static
	{
		$this->value = $value;

		return $this;
	}

	/**
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 */
	public function expiresAt(?DateTimeInterface $expiration): static
	{
		if ($expiration === null) {
			$this->dependencies[Cache::Expire] = null;

			return $this;
		}

		$this->dependencies[Cache::Expire] = $expiration->format('U.u');

		return $this;
	}

	/**
	 * @return static
	 */
	public function expiresAfter(int|DateInterval|null $time): static
	{
		if ($time === null) {
			$this->dependencies[Cache::Expire] = null;

			return $this;
		}

		if ($time instanceof DateInterval) {
			/** @var DateTimeImmutable $date */
			$date = DateTimeImmutable::createFromFormat('U', (string) time());
			$this->dependencies[Cache::Expire] = $date->add($time)->format('U');

			return $this;
		}

		$this->dependencies[Cache::Expire] = $time + time();

		// Infinite
		if ($time === 0) {
			unset($this->dependencies[Cache::Expire]);
		}

		return $this;
	}

	/**
	 * @return mixed[]
	 */
	public function getDependencies(): array
	{
		return $this->dependencies;
	}

	/**
	 * @param mixed[] $dependencies
	 */
	public function setDependencies(array $dependencies): self
	{
		$this->dependencies = $dependencies;

		return $this;
	}

}
