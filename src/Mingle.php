<?php

namespace Ijpatricio\Mingle;
use Ijpatricio\Mingle\Contracts\HasMingles;
use Ijpatricio\Mingle\Concerns\InteractsWithMingles;
use Illuminate\Support\Facades\Vite;
use Livewire\Volt\CompileContext;

use function Livewire\Volt\{uses};
class Mingle
{

    public function volt() {
            if (class_exists('Livewire\Volt\CompileContext') === false) {
                return fn(): string => '';
            }
            uses([HasMingles::class, InteractsWithMingles::class]);
            $instance = CompileContext::instance();

            $resourcePath = resource_path();
            $path = 'resources'. str_replace($resourcePath, '', $instance->path);
            return fn(): string => $path . (Vite::isRunningHot() ? '?import' : '');
    }
}
