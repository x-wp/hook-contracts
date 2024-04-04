<?php
/**
 * Invokable interface file.
 *
 * @package eXtended WordPress
 * @subpackage Contracts\Hook
 */

namespace XWP\Contracts\Hook;

/**
 * Invokable interface. Used by actions and filters.
 *
 * @template T
 *
 * @property-read Invoke               $strategy Invocation strategy.
 * @property-read Initializable        $handler  Handler instance.
 * @property-read bool                 $invoked  Flag indicating if the hook has been invoked.
 * @property-read int                  $args     Number of arguments the hook accepts.
 * @property-read \ReflectionMethod<T> $reflector Reflector instance.
 */
interface Invokable extends Hookable {
    /**
     * Set the hook handler.
     *
     * @param  Initializable<T> $handler Handler instance.
     * @return static
     */
    public function set_handler( Initializable $handler ): static;

    /**
     * Check if the hook can be invoked.
     *
     * @return bool
     */
    public function can_invoke(): bool;

    /**
     * Invoke the hook.
     */
    public function invoke();
}
