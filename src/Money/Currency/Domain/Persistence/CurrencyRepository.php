<?php

declare(strict_types=1);

namespace Src\Money\Currency\Domain\Persistence;

use Src\Money\Currency\Domain\Aggregate\Currency;
use Src\Money\Currency\Domain\ValueObject\CurrencyId;

interface CurrencyRepository
{
    public function findOrFail(CurrencyId $id): Currency;

    public function findByCode(CurrencyId $id): Currency;
}
