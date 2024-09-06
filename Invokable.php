<?php
/**
 * Invokable interface file.
 *
 * @package eXtended WordPress
 * @subpackage Contracts\Hook
 */

namespace XWP\Contracts\Hook;

use ReflectionMethod;

/**
 * Invokable interface. Used by actions and filters.
 *
 * @template THndlr of object
 *
 * @property-read Invoke                $strategy Invocation strategy.
 * @property-read Initializable<THndlr> $handler  Handler instance.
 * @property-read bool                  $invoked  Flag indicating if the hook has been invoked.
 * @property-read int                   $args     Number of arguments the hook accepts.
 *
 * @extends Hookable<THndlr,ReflectionMethod>
 */
interface Invokable extends Hookable {
    /**
     * Set the hook handler.
     *
     * @param  Initializable<THndlr> $handler Handler instance.
     * @return static
     */
    public function with_handler( Initializable $handler ): static;

    /**
     * Set the hook target.
     *
     * @param  string $method Method name.
     * @return static
     */
    public function with_target( string $method ): static;

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
