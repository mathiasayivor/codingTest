<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'ulid', unique: true)]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    private $id;

    #[ORM\Column(type: 'string', length: 3)]
    private $isoCode;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $isoNumericCode;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $commonName;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $officialName;

    #[ORM\Column(type: 'ascii_string', nullable: true)]
    private $symbol;

    public function getId(): ?Ulid
    {
        return $this->id;
    }

    public function getIsoCode(): ?string
    {
        return $this->isoCode;
    }

    public function setIsoCode(string $isoCode): self
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    public function getIsoNumericCode(): ?int
    {
        return $this->isoNumericCode;
    }

    public function setIsoNumericCode(?int $isoNumericCode): self
    {
        $this->isoNumericCode = $isoNumericCode;

        return $this;
    }

    public function getCommonName(): ?string
    {
        return $this->commonName;
    }

    public function setCommonName(string $commonName): self
    {
        $this->commonName = $commonName;

        return $this;
    }

    public function getOfficialName(): ?string
    {
        return $this->officialName;
    }

    public function setOfficialName(string $officialName): self
    {
        $this->officialName = $officialName;

        return $this;
    }

    public function getSymbol()
    {
        return $this->symbol;
    }

    public function setSymbol($symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }
}
