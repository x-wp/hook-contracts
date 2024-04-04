<?php
/**
 * Hook_Manager_Interface interface file.
 *
 * @package eXtended WordPress
 * @subpackage Contracts\Hook
 */

namespace XWP\Contracts\Hook;

/**
 * Allows handler and hook registration and invocation.
 */
interface Invoker_Interface {
    /**
     * Get the hook manager instance.
     *
     * @return static
     */
    public static function instance(): static;

    /**
     * Register multiple handlers with the hook manager.
     *
     * @param  string|object ...$handlers Handlers to register.
     * @return static
     */
    public function register_handlers( string|object ...$handlers ): static;

    /**
     * Register a handler with the hook manager.
     *
     * @param  string $handler Handler to register.
     * @return static
     */
    public function register_handler( string $handler ): static;

    /**
     * Get handlers registered with the hook manager.
     *
     * @return array<string, Hookable>
     */
    public function get_handlers(): array;

    /**
     * Get hooks registered with the hook manager.
     *
     * If a handler classname is provided, only hooks for that handler are returned.
     *
     * @param  string|null $handler Optional. Handler name.
     * @return array
     */
    public function get_hooks( ?string $handler ): array;

    /**
     * Get the current context.
     *
     * @return Context_Interface
     */
    public function get_context(): Context_Interface;
}
