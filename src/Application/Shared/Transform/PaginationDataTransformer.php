<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Application\Shared\Transform;

use Eventscase\MovieRental\Application\Shared\Response\PaginationResponse;
use Knp\Component\Pager\Pagination\PaginationInterface;

final class PaginationDataTransformer
{
    public function transform(PaginationInterface $pager): PaginationResponse
    {
        $items = [];
        foreach ($pager->getItems() as $item) {
            $items[] = $item->transform();
        }

        return new PaginationResponse(
            $pager->getCurrentPageNumber(),
            $pager->getItemNumberPerPage(),
            intval(ceil($pager->getTotalItemCount() / $pager->getItemNumberPerPage())),
            $pager->getTotalItemCount(),
            $items
        );
    }
}