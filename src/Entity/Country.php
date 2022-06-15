<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'ulid', unique: true)]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    private $id;

    #[ORM\Column(type: 'string', length: 2)]
    private $continentCode;

    #[ORM\Column(type: 'string', length: 3, nullable: true)]
    private $currencyCode;

    #[ORM\Column(type: 'string', length: 2)]
    private $iso2Code;

    #[ORM\Column(type: 'string', length: 3)]
    private $iso3Code;

    #[ORM\Column(type: 'integer')]
    private $isoNumericCode;

    #[ORM\Column(type: 'string', length: 2, nullable: true)]
    private $fipsCode;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $callingCode;

    #[ORM\Column(type: 'ascii_string', nullable: true)]
    private $commonName;

    #[ORM\Column(type: 'ascii_string', nullable: true)]
    private $officialName;

    #[ORM\Column(type: 'ascii_string', nullable: true)]
    private $endonym;

    #[ORM\Column(type: 'ascii_string', nullable: true)]
    private $demonym;

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getContinentCode(): ?string
    {
        return $this->continentCode;
    }

    public function setContinentCode(string $continentCode): self
    {
        $this->continentCode = $continentCode;

        return $this;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(?string $currencyCode): self
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    public function getIso2Code(): ?string
    {
        return $this->iso2Code;
    }

    public function setIso2Code(string $iso2Code): self
    {
        $this->iso2Code = $iso2Code;

        return $this;
    }

    public function getIso3Code(): ?string
    {
        return $this->iso3Code;
    }

    public function setIso3Code(string $iso3Code): self
    {
        $this->iso3Code = $iso3Code;

        return $this;
    }

    public function getIsoNumericCode(): ?int
    {
        return $this->isoNumericCode;
    }

    public function setIsoNumericCode(int $isoNumericCode): self
    {
        $this->isoNumericCode = $isoNumericCode;

        return $this;
    }

    public function getFipsCode(): ?string
    {
        return $this->fipsCode;
    }

    public function setFipsCode(?string $fipsCode): self
    {
        $this->fipsCode = $fipsCode;

        return $this;
    }

    public function getCallingCode(): ?int
    {
        return $this->callingCode;
    }

    public function setCallingCode(?int $callingCode): self
    {
        $this->callingCode = $callingCode;

        return $this;
    }

    public function getCommonName()
    {
        return $this->commonName;
    }

    public function setCommonName($commonName): self
    {
        $this->commonName = $commonName;

        return $this;
    }

    public function getOfficialName()
    {
        return $this->officialName;
    }

    public function setOfficialName($officialName): self
    {
        $this->officialName = $officialName;

        return $this;
    }

    public function getEndonym()
    {
        return $this->endonym;
    }

    public function setEndonym($endonym): self
    {
        $this->endonym = $endonym;

        return $this;
    }

    public function getDemonym()
    {
        return $this->demonym;
    }

    public function setDemonym($demonym): self
    {
        $this->demonym = $demonym;

        return $this;
    }
}
