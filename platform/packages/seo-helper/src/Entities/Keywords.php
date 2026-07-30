<?php

namespace Obii\SeoHelper\Entities;

use Obii\SeoHelper\Contracts\Entities\KeywordsContract;
use Obii\SeoHelper\Exceptions\InvalidArgumentException;
use Obii\SeoHelper\Helpers\Meta;
use Illuminate\Support\Str;

class Keywords implements KeywordsContract
{

    /**
     * The meta name.
     *
     * @var string
     */
    protected $name = 'keywords';

    /**
     * The meta content.
     *
     * @var string
     */
    protected $content = '';

    /**
     * The keywords max length.
     *
     * @var int
     */
    protected $max = 386;

    /**
     * Make Keywords instance.
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $this->set(theme_option('seo_keywords'));
        $this->setMax(config('packages.seo-helper.general.keywords.max', 386));
    }

    /**
     * Get raw keywords content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get keywords content.
     *
     * @return string
     */
    public function get()
    {
        return Str::limit($this->getContent(), $this->getMax());
    }

    /**
     * Set keywords content.
     *
     * @param string $content
     *
     * @return $this
     */
    public function set($content)
    {
        $this->content = trim(strip_tags($content));

        return $this;
    }

    /**
     * Get keywords max length.
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * Set keywords max length.
     *
     * @param int $max
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setMax($max)
    {
        $this->checkMax($max);

        $this->max = $max;

        return $this;
    }

    /**
     * Make a keywords instance.
     *
     * @param string $content
     * @param int $max
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public static function make($content, $max = 386)
    {
        return new self();
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function render()
    {
        if (!$this->hasContent()) {
            return '';
        }

        return Meta::make($this->name, $this->get())->render();
    }

    /**
     * Render the tag.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Check if keywords has content.
     *
     * @return bool
     */
    protected function hasContent()
    {
        return !empty($this->get());
    }

    /**
     * Check title max length.
     *
     * @param int $max
     *
     * @throws InvalidArgumentException
     */
    protected function checkMax($max)
    {
        if (!is_int($max)) {
            throw new InvalidArgumentException(
                'The keywords maximum length must be integer.'
            );
        }

        if ($max <= 0) {
            throw new InvalidArgumentException(
                'The keywords maximum length must be greater 0.'
            );
        }
    }
}
