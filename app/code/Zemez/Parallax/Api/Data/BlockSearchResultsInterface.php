<?php

namespace Zemez\Parallax\Api\Data;

/**
 * Block search results interface.
 *
 * @package Zemez\Parallax\Api\Data
 */
interface BlockSearchResultsInterface
{
    /**
     * Get blocks list.
     *
     * @return \Zemez\Parallax\Api\Data\BlockInterface[]
     */
    public function getItems();

    /**
     * Set blocks list.
     *
     * @param \Zemez\Parallax\Api\Data\BlockInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}