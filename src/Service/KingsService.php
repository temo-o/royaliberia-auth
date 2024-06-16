<?php

namespace App\Service;

use App\Repository\KingsRepository;
use http\Exception;

class KingsService
{
    public function __construct(protected KingsRepository $kingsRepository)
    {
    }

    /**
     * @throws \Exception
     */
    public function getKings(): array
    {
        return $this->kingsRepository->getKingsByDate();
    }

    /**
     * @throws \Exception
     */
    public function getKingsClosure(): array
    {
        $rawResults = $this->kingsRepository->getKingsClosure();
        $finalResults = array();

        foreach ($rawResults as $result) {
            $finalResults[] = array(
                "person" => $result[0],
                "depth" => $result['depth']
            );
        }
        return $finalResults;
    }
}