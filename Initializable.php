<?php
/**
 * Handler interface file.
 *
 * @package eXtended WordPress
 * @subpackage Contracts
 */

namespace XWP\Contracts\Hook;

use ReflectionClass;

/**
 * Handler interface.
 *
 * @template THndlr of object
 *
 * @property-read Initialize              $strategy    Invocation strategy.
 * @property-read class-string<THndlr>    $classname   Handler classname.
 * @property-read bool                    $initialized Indicates if the handler has been initialized.
 * @property THndlr|null                  $target      Handler target.
 *
 * @extends Hookable<THndlr,ReflectionClass<THndlr>>
 */
interface Initializable extends Hookable {
    /**
     * Set the classname.
     *
     * @param  class-string<THndlr> $classname Handler classname.
     * @return static
     */
    public function with_classname( string $classname ): static;

    /**
     * Set the handler instance.
     *
     * @param  THndlr $instance Handler instance.
     * @return static
     */
    public function with_target( object $instance ): static;

    /**
     * Get the handler instance.
     *
     * @return THndlr
     */
    public function get_target(): ?object;

    /**
     * Initializes the handler.
     *
     * @return static
     */
    public function initialize(): static;

    /**
     * Check if the handler can be initialized.
     *
     * @return bool
     */
    public function can_initialize(): bool;
}
