<?php

declare(strict_types=1);

namespace DodopaymentsClient\Core\Contracts;

/**
 * @internal
 */
interface BasePage extends \Stringable
{
    /**
     * @return \Traversable<mixed>
     */
    public function pagingEachItem(): \Traversable;
}
