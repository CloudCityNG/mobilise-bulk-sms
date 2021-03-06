<?php

namespace Money\Formatter;

use Money\Exception\FormatterException;
use Money\Money;
use Money\MoneyFormatter;

/**
 * Formats a Money object using other Money formatters.
 *
 * @author Frederik Bosch <f.bosch@genkgo.nl>
 */
final class AggregateMoneyFormatter implements MoneyFormatter
{
    /**
     * @var MoneyFormatter[]
     */
    private $formatters = [];

    /**
     * @param MoneyFormatter[] $formatters
     */
    public function __construct(array $formatters)
    {
        foreach ($formatters as $currencyCode => $formatter) {
            if (false === $formatter instanceof MoneyFormatter) {
                throw new \InvalidArgumentException('All formatters must implement Money\MoneyFormatter');
            }
            $this->formatters[$currencyCode] = $formatter;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function format(Money $money)
    {
        $currencyCode = $money->getCurrency()->getCode();
        if (isset($this->formatters[$currencyCode])) {
            return $this->formatters[$currencyCode]->format($money);
        }

        if (isset($this->formatters['*'])) {
            return $this->formatters['*']->format($money);
        }

        throw new FormatterException('No formatter found for currency '.$currencyCode);
    }
}
