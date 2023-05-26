<?php 

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DateHandlerService
{
    public function dateHandler($formSearch,SessionInterface $sessionInterface)
    {
        $differenceInDays = 0;

        $dateStart = $formSearch->get('start')->getData();
        $dateEnd = $formSearch->get('end')->getData();

        if ($dateStart instanceof \DateTimeInterface && $dateEnd instanceof \DateTimeInterface) {
            $selectedDateStart = $dateStart->format('Y-m-d');
            $selectedDateEnd = $dateEnd->format('Y-m-d');
            
            // Calcul de la différence en jours
            $differenceInDays = $dateEnd->diff($dateStart)->days;
            
            $sessionData = [
                'selected_date_start' => $selectedDateStart,
                'selected_date_end' => $selectedDateEnd,
                'difference_in_days' => $differenceInDays,
            ];
        
            //remplace les valeurs de session par le tableau $sessionData 
            $sessionInterface->replace($sessionData);
        } else {
            $sessionInterface->clear();
        }
    }
}


?>