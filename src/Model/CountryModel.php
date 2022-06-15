<?php
namespace App\Model;

use App\Entity\Country;
use Symfony\Component\Uid\Ulid;

class CountryModel implements \Stringable
{
    public ?Ulid $id;
    public string $continentCode;
    public ?string $currencyCode;
    public string $iso2Code;
    public string $iso3Code;
    public int $isoNumericCode;
    public ?string $fipsCode;
    public ?int $callingCode;
    public $commonName;
    public $officialName;
    public $endonym;
    public $demonym;

    public function __construct(Country $country)
    {
        $this->id = $country->getId();
        $this->continentCode = $country->getContinentCode();
        $this->currencyCode = $country->getCurrencyCode();
        $this->iso2Code = $country->getIso2Code();
        $this->iso3Code = $country->getIso3Code();
        $this->isoNumericCode = $country->getIsoNumericCode();
        $this->fipsCode = $country->getFipsCode();
        $this->callingCode = $country->getCallingCode();
        $this->commonName = $country->getCommonName();
        $this->officialName = $country->getOfficialName();
        $this->endonym = $country->getEndonym();
        $this->demonym = $country->getDemonym();
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }
}