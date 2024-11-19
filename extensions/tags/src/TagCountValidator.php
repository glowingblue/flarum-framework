<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Tags;

use Flarum\Foundation\AbstractValidator;

class TagCountValidator extends AbstractValidator
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $min;

    /**
     * @var int
     */
    protected $max;

    /**
     * @return string
     */
    protected function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    protected function getMin()
    {
        return $this->min;
    }

    /**
     * @param int $min
     * @return void
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * @return int
     */
    protected function getMax()
    {
        return $this->max;
    }

    /**
     * @param int $max
     * @return void
     */
    public function setMax($max)
    {
        $this->max = $max;
    }

    /**
     * {@inheritdoc}
     */
    protected function getRules()
    {
        $type = $this->type;
        $min = $this->min;
        $max = $this->max;

        return [
            "tag_count_{$type}" => [
                'numeric',
                "size:{$min}",
                "between:{$min},{$max}"
            ]
        ];
    }
}
