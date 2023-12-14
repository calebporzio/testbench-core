<?php

namespace Orchestra\Testbench\Attributes;

use Closure;
use Illuminate\Support\Collection;

final class CallbackCollection extends Collection
{
    /**
     * Handle attribute callbacks.
     *
     * @param  \Closure|null  $callback
     * @return void
     */
    public function handle(?Closure $callback = null): void
    {
        if ($this->isEmpty()) {
            return;
        }

        $this->each($callback ?? function ($attribute) {
            value($attribute);
        });
    }
}
