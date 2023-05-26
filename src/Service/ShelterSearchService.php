<?php 

namespace App\Service;

use App\Repository\ShelterRepository;

class ShelterSearchService
{
    private $shelterRepository;
    public function __construct(ShelterRepository $shelterRepository)
    {
        $this->shelterRepository = $shelterRepository;
    }

    public function searchShelterByCriteria($criteria)
    {
        $shelters = [];

        $criteriaNotEmpty = (
            isset($criteria['town']) ||
            isset($criteria['department']) ||
            isset($criteria['region']) ||
            (isset($criteria['interior']) && !$criteria['interior']->isEmpty()) ||
            (isset($criteria['exterior']) && !$criteria['exterior']->isEmpty()) ||
            (isset($criteria['services']) && !$criteria['services']->isEmpty())
        );

        if ($criteria && $criteriaNotEmpty) {

            $shelters = $this->shelterRepository->searchSheltersByCriteria($criteria);

        } else {
            
            $shelters = $this->shelterRepository->findAll();
        }

        return $shelters;
    }
}


?>