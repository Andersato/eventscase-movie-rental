<?php

declare(strict_types=1);

namespace Eventscase\MovieRental\Domain\Shared\Traits;

trait DateTimeTrait
{
    /**
     * @var \DateTimeImmutable|null
     */
    protected $createdAt;

    /**
     * @var \DateTimeImmutable|null
     */
    protected $updatedAt;

    /**
     * @var \DateTimeImmutable|null
     */
    protected $deletedAt;

    /**
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeImmutable $updatedAt
     *
     * @return DateTimeTrait
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTimeImmutable $deletedAt
     *
     * @return DateTimeTrait
     */
    public function setDeletedAt(\DateTimeImmutable $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
