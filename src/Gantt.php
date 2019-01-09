<?php

namespace neethanz\Gantt;

use Laravel\Nova\Card;

class Gantt extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Create a new element.
     *
     * @param  string|null  $component
     * @return void
     */
    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->withMeta([
            'columns' => [],
            'rows' => [],
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @param array $columns
     * @return $this
     */
    public function setColumns(array $columns)
    {
        return $this->withMeta([
            'columns' => $columns
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @param $rows
     * @return $this
     */
    public function setRows($rows)
    {
        return $this->withMeta([
            'rows' => $rows
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'Gantt';
    }
}
