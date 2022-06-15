<?php
namespace App\Model;

use App\Entity\Currency;
use Symfony\Component\Uid\Ulid;

class CurrencyModel implements \Stringable
{
    public ?Ulid $id;
    public string $isoCode;
    public ?string $isoNumericCode;
    public ?string $commonName;
    public ?string $officialName;
    public ?string $symbol;

    public function __construct(Currency $currency)
    {
        $this->id = $currency->getId();
        $this->isoCode = $currency->getIsoCode();
        $this->isoNumericCode = $currency->getIsoNumericCode();
        $this->commonName = $currency->getCommonName();
        $this->officialName = $currency->getOfficialName();
        $this->symbol = $currency->getSymbol();
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }
}