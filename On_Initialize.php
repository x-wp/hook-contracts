<?php
/**
 * On_Initialize interface file.
 *
 * @package eXtended WordPress
 * @subpackage Contracts\Hook
 */

namespace XWP\Contracts\Hook;

/**
 * When applied to a handler class, it will automatically call the `on_initialize` method.
 */
interface On_Initialize {
    /**
     * Function to be called on initialization.
     */
    public function on_initialize();
}
