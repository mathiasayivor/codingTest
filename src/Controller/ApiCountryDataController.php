<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\Currency;
use App\Model\CountryModel;
use App\Model\CurrencyModel;
use App\Repository\CountryRepository;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

class ApiCountryDataController extends AbstractController
{
    #[Route('/api/country-data/add-country', name: 'app_api_add_country', methods: ['POST'])]
    public function addCountry(Request $request, EntityManagerInterface $em): JsonResponse
    {
        /** @var UploadedFile */
        $uploadedFile = $request->files->get('countries');

        if (!$uploadedFile instanceof UploadedFile || !in_array($uploadedFile->guessExtension(), ['txt', 'csv'])) {
            throw new NotAcceptableHttpException('A valid csv file containing countries list is required!');
        }

        $encoder = new CsvEncoder();
        $csv = mb_convert_encoding($encoder->decode($uploadedFile->getContent(), 'csv'), 'utf-8', 'auto');

        foreach ($csv as $countryCsv) {
            $countryCsv = (object) $countryCsv;

            $country = new Country();
            $country
                ->setContinentCode($countryCsv->continent_code)
                ->setCurrencyCode($countryCsv->currency_code ?: null)
                ->setIso2Code($countryCsv->iso2_code)
                ->setIso3Code($countryCsv->iso3_code)
                ->setIsoNumericCode($countryCsv->iso_numeric_code)
                ->setFipsCode($countryCsv->fips_code ?: null)
                ->setCallingCode($countryCsv->calling_code ?: null)
                ->setCommonName($countryCsv->common_name)
                ->setOfficialName($countryCsv->official_name)
                ->setEndonym($countryCsv->endonym)
                ->setDemonym($countryCsv->demonym ?: null);

            $em->persist($country);
        }

        $em->flush();

        return $this->json([
            'message' => 'Country data was uploaded successfully!'
        ]);
    }

    #[Route('/api/country-data/add-currency', name: 'app_api_add_currency', methods: ['POST'])]
    public function addCurrency(Request $request, EntityManagerInterface $em): JsonResponse
    {
        /** @var UploadedFile */
        $uploadedFile = $request->files->get('currencies');

        if (!$uploadedFile instanceof UploadedFile || !in_array($uploadedFile->guessExtension(), ['txt', 'csv'])) {
            throw new NotAcceptableHttpException('A valid csv file containing currencies list is required!');
        }

        $encoder = new CsvEncoder();
        $csv = mb_convert_encoding($encoder->decode($uploadedFile->getContent(), 'csv'), 'utf-8', 'auto');

        try {
            foreach ($csv as $currencyCsv) {
                $currencyCsv = (object) $currencyCsv;

                $currency = new Currency();
                $currency
                    ->setIsoCode($currencyCsv->iso_code)
                    ->setIsoNumericCode($currencyCsv->iso_numeric_code ?: null)
                    ->setCommonName($currencyCsv->common_name ?: null)
                    ->setOfficialName($currencyCsv->official_name ?: null)
                    ->setSymbol($currencyCsv->symbol ?: null);

                $em->persist($currency);
            }
        } catch (\Exception) {
            throw new NotAcceptableHttpException('Uploaded file is corrupt or invalid!');
        }

        $em->flush();

        return $this->json([
            'message' => 'Currency data was uploaded successfully!'
        ]);
    }

    #[Route('/api/country-data/list-countries/{page}', name: 'app_api_list_countries', methods: ['GET'])]
    public function listCountries(Request $request, CountryRepository $countryRepository, int $page = 1): JsonResponse
    {
        $rowsPerPage = 50;

        /**
         * TODO: Use query from request body to filter countries list
         */
        $queryBuilder = $countryRepository->createQueryBuilder('c');
        $countriesQuery = $queryBuilder
            ->getQuery()
            ->setFirstResult($rowsPerPage * ($page - 1))
            ->setMaxResults($rowsPerPage);

        $paginator = new Paginator($countriesQuery, false);
        $totalRowsCount = count($paginator);
        $pagesCount = ceil($totalRowsCount / $rowsPerPage);

        $countriesList = [];

        foreach ($paginator as $country) {
            $countriesList[] = new CountryModel($country);
        }

        return $this->json([
            'countries' => $countriesList,
            'page' => $page,
            'totalRowsCount' => $totalRowsCount,
            'rowsPerPage' => $rowsPerPage,
            'pagesCount' => $pagesCount,
        ]);
    }

    #[Route('/api/country-data/list-currencies/{page}', name: 'app_api_list_currencies', methods: ['GET'])]
    public function listCurrencies(Request $request, CurrencyRepository $currencyRepository, int $page = 1): JsonResponse
    {
        $rowsPerPage = 50;

        /**
         * TODO: Use query from request body to filter currencies list
         */
        $queryBuilder = $currencyRepository->createQueryBuilder('c');
        $currenciesQuery = $queryBuilder
            ->getQuery()
            ->setFirstResult($rowsPerPage * ($page - 1))
            ->setMaxResults($rowsPerPage);

        $paginator = new Paginator($currenciesQuery, false);
        $totalRowsCount = count($paginator);
        $pagesCount = ceil($totalRowsCount / $rowsPerPage);

        $currenciesList = [];

        foreach ($paginator as $currency) {
            $currenciesList[] = new CurrencyModel($currency);
        }

        return $this->json([
            'currencies' => $currenciesList,
            'page' => $page,
            'totalRowsCount' => $totalRowsCount,
            'rowsPerPage' => $rowsPerPage,
            'pagesCount' => $pagesCount,
        ]);
    }
}
