<?php
/**
 * Hook_Manager_Interface interface file.
 *
 * @package XWP
 * @subpackage Contracts\Hook
 */

namespace XWP\Contracts\Hook;

/**
 * Allows handler and hook registration and invocation.
 */
interface Hook_Manager_Interface {
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
     * Register the handler methods.
     *
     * @param  object|\ReflectionClass $handler Handler instance, or handler reflection.
     * @return static
     */
    public function register_handler_methods( object $handler ): static;

    /**
     * Checks if a hook can be invoked.
     *
     * @param  Hook_Interface $hook Hook to check.
     * @return bool
     */
    public function can_invoke( Hook_Interface $hook ): bool;

    /**
     * Get handlers registered with the hook manager.
     *
     * @return array<string, Hook_Interface>
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
