<?php
/**
 * Handler interface file.
 *
 * @package eXtended WordPress
 * @subpackage Contracts
 */

namespace XWP\Contracts\Hook;

/**
 * Handler interface.
 *
 * @template<T>
 *
 * @property-read Initialize          $strategy    Invocation strategy.
 * @property-read class-string>T>     $classname   Handler classname.
 * @property-read bool                $initialized Indicates if the handler has been initialized.
 * @property-read T|null              $target      Handler target.
 * @property-read \ReflectionClass<T> $reflector   Reflector instance.
 */
interface Initializable extends Hookable {
    /**
     * Set the classname.
     *
     * @param  class-string<T> $classname Handler classname.
     * @return static
     */
    public function set_classname( string $classname ): static;

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
