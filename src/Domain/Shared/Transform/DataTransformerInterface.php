<?php

namespace Eventscase\MovieRental\Domain\Shared\Transform;

interface DataTransformerInterface
{
    public function transform(): DataResponse;
}