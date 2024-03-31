<?php

namespace XWP\Contracts\Hook;

interface Context_Interface {
    /**
     * Format the context for display.
     *
     * @return string
     */
    public function display_name(): string;

    /**
     * Check if the current context is valid.
     *
     * @param  int $ctx The context to check.
     * @return bool
     */
    public function is_valid( int $ctx ): bool;
}
