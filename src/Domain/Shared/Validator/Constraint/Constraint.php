<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Shared\Validator\Constraint;

use Eventscase\MovieRental\Domain\Shared\Validator\Constraint\Exception\OptionConstraintNotFound;

abstract class Constraint
{
    public const MESSAGE_OPTION = 'message';

    protected $options;

    abstract protected function allowOptions(): array;

    abstract protected function validate($value): array;

    public function __construct(array $options = [])
    {
        $this->guard($options);

        $this->options = $options;
    }

    private function guard(array $options = [])
    {
        foreach ($options as $key => $value) {
            if (!in_array($key, $this->allowOptions())) {
                throw new OptionConstraintNotFound(sprintf('The option "%s" do not exist in constraint %s', $key, \get_class($this)));
            }
        }
    }
}