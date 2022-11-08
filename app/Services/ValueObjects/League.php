<?php

namespace App\Services\ValueObjects;

class League
{
    /**
     * @param string $name
     * @param MatchVO[] $matches
     */
    public function __construct(
        private readonly string $name,
        private readonly array $matches,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return MatchVO[]
     */
    public function getMatches(): array
    {
        return $this->matches;
    }
}
