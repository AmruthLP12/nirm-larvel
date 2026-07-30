<?php

namespace Obii\SeoHelper\Contracts\Entities;

use Obii\SeoHelper\Contracts\RenderableContract;

interface KeywordsContract extends RenderableContract
{
    /**
     * Get raw keywords content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Get keywords content.
     *
     * @return string
     */
    public function get();

    /**
     * Set keywords content.
     *
     * @param string $content
     * @return $this
     */
    public function set($content);

    /**
     * Get keywords max length.
     *
     * @return int
     */
    public function getMax();

    /**
     * Set keywords max length.
     *
     * @param int $max
     * @return $this
     */
    public function setMax($max);

    /**
     * Make a keywords instance.
     *
     * @param string $content
     * @param int $max
     * @return $this
     */
    public static function make($content, $max = 155);
}
