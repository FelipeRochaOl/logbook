<?php

namespace App\core;

use DateTime;
use Exception;
use IntlDateFormatter;

class DateFormat
{
    private DateTime $date;
    private string $locale;
    private string $timezone;

    /**
     * @throws Exception
     */
    public function __construct(string $date = 'now')
    {
        $this->setLocale('pt_BR');
        $this->setTimezone('America/Sao_Paulo');
        $this->date = new DateTime($date);
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }
    
    public function formatFullDatetime(): string
    {
        $formatter = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::LONG,
            IntlDateFormatter::SHORT,
            $this->timezone,
            IntlDateFormatter::GREGORIAN
        );
        return $formatter->format($this->date);
    }

    public function formatDate(): string
    {
        $formatter = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::SHORT,
            IntlDateFormatter::NONE,
            $this->timezone,
            IntlDateFormatter::GREGORIAN
        );
        return $formatter->format($this->date);
    }
}