<?php

namespace App\Livewire;

use Ijpatricio\Mingle\HasMingles;
use Ijpatricio\Mingle\InteractsWithMingles;
use Livewire\Component;

class Foo extends Component implements HasMingles
{
    use InteractsWithMingles;

    public function component(): string
    {
        return 'resources/js/Foo.js';
    }

    public function mingleData()
    {
        return [
            'message' => 'Message in a bottle 🍾',
        ];
    }

    public function doubleIt($amount)
    {
        return $amount * 2;
    }
}