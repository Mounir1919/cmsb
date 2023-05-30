<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChartComponent extends Component
{
    public $chartData;

    public function __construct($chartData)
    {
        $this->chartData = $chartData;
    }

    public function render()
    {
        return view('components.chart-component');
    }
}
