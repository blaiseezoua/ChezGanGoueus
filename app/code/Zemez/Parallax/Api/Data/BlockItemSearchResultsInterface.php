<?php

namespace Zemez\Parallax\Api\Data;

/**
 * Block item search results interface.
 *
 * @package Zemez\Parallax\Api\Data
 */
interface BlockItemSearchResultsInterface
{
    /**
     * Get blocks list.
     *
     * @return \Zemez\Parallax\Api\Data\BlockItemInterface[]
     */
    public function getItems();

    /**
     * Set blocks list.
     *
     * @param \Zemez\Parallax\Api\Data\BlockItemInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}