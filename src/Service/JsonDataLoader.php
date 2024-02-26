<?php // src/Service/JsonDataLoader.php

namespace App\Service;

use App\Entity\City;
use App\Entity\State;
use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;

class JsonDataLoader
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadCountriesFromJson(string $jsonFilePath): void
    {
        $jsonData = file_get_contents($jsonFilePath);
        $countriesData = json_decode($jsonData, true);

        foreach ($countriesData as $countryData) {
            $country = new Country();
            $country->setCode($countryData['ids']['fips']);
            $country->setName($countryData['long']['default']);

            // Persist the entity
            $this->entityManager->persist($country);
        }

        // Flush changes to the database
        $this->entityManager->flush();
    }

    public function loadStatesFromJson(string $jsonFilePath): void
    {
        $jsonData = file_get_contents($jsonFilePath);
        $statesData = json_decode($jsonData, true);

        foreach ($statesData as $stateData) {
            $state = new State();
            $state->setGeonames($stateData['ids']['geonames']);
            $state->setName($stateData['long']['default']);

            // Find the country by FIPS code
            $country = $this->entityManager->getRepository(Country::class)->findOneBy(['Code' => $stateData['parent']]);
            if ($country instanceof Country) {
                $state->setCountry($country);
            } else {
                // Handle the case where the country is not found
                // You can log an error, skip the state, or handle it in another way
                continue; // Skip this state
            }

            // Persist the entity
            $this->entityManager->persist($state);
        }

        // Flush changes to the database
        $this->entityManager->flush();
    }

    public function loadCitiesFromJson(string $jsonFilePath): void
    {
        $jsonData = file_get_contents($jsonFilePath);
        $citiesData = json_decode($jsonData, true);

        foreach ($citiesData as $cityData) {
            $city = new City();
            $city->setGeonames($cityData['ids']['geonames']);
            $city->setName($cityData['long']['default']);

            // Find the state by Geonames ID
            $state = $this->entityManager->getRepository(State::class)->findOneBy(['Geonames' => $cityData['parent']]);
            if ($state instanceof State) {
                $city->setState($state);
            } else {
                // Handle the case where the state is not found
                // You can log an error, skip the city, or handle it in another way
                continue; // Skip this city
            }

            // Find the country by FIPS code
            $country = $this->entityManager->getRepository(Country::class)->findOneBy(['Code' => $cityData['country']]);
            if ($country instanceof Country) {
                $city->setCountry($country);
            } else {
                // Handle the case where the country is not found
                // You can log an error, skip the city, or handle it in another way
                continue; // Skip this city
            }

            // Persist the entity
            $this->entityManager->persist($city);
        }

        // Flush changes to the database
        $this->entityManager->flush();
    }
}
