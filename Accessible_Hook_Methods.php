<?php
/**
 * Accessible_Hook_Methods trait file.
 *
 * @package WP Utils
 * @subpackage Traits
 */

namespace XWP\Contracts\Hook;

/**
 * Allows making private methods of a class accessible from the outside.
 */
trait Accessible_Hook_Methods {
    /**
     * Array of registered hooks for a class.
     *
     * @var array
     */
    protected static array $hooks = array();

    /**
     * Magic method to call private methods which are hooked.
     *
     * @param  string $name      Method name.
     * @param  array  $arguments Method arguments.
     * @return mixed
     *
     * @throws \BadMethodCallException If the method does not exist or is not hooked.
     */
    public function __call( string $name, array $arguments ) {
        static::$hooks[ static::class ] ??= array();

        $should_throw = static::check_method_access( $this, $name );

        if ( false !== $should_throw ) {
            throw new \BadMethodCallException( \esc_html( $should_throw ) );
        }

        return \is_callable( array( 'parent', '__call' ) )
            ? parent::__call( $name, $arguments )
            : $this->$name( ...$arguments );
    }

    /**
     * Magic method to call private static methods which are hooked.
     *
     * @param  string $name      Method name.
     * @param  array  $arguments Method arguments.
     * @return mixed
     *
     * @throws \BadMethodCallException If the method does not exist or is not hooked.
     */
    public static function __callStatic( string $name, array $arguments ) {
        $should_throw = static::check_method_access( static::class, $name );

        if ( false !== $should_throw ) {
            throw new \BadMethodCallException( \esc_html( $should_throw ) );
        }

        return static::$name( ...$arguments );
    }

    /**
     * Checks if a method is callable.
     *
     * @param  string|object $class_or_obj Class name or object.
     * @param  string        $method       Method name.
     * @return string|false
     */
    protected static function check_method_access( string|object $class_or_obj, string $method ): string|false {
        $classname = \is_object( $class_or_obj ) ? $class_or_obj::class : $class_or_obj;

        return match ( true ) {
            ! \method_exists(
                $class_or_obj,
                $method,
            ) => 'Call to undefined method ' . $classname . '::' . $method,
            ! static::is_method_valid(
                $classname,
                $method,
            ) => 'Call to private method ' . $classname . '::' . $method,
            default => false,
        };
    }

    /**
     * Checks if a private / protected method is callable.
     *
     * @param  string $classname Class name.
     * @param  string $method    Method name.
     * @return bool
     */
    protected static function is_method_valid( string $classname, string $method ): bool {
        return \array_reduce(
            static::get_registered_hooks( $classname, $method ),
            static fn( bool $c, string $hook ) => $c || \doing_action( $hook ) || \doing_filter( $hook ),
            false,
        );
    }

    /**
     * Get the valid hooks for a class and method.
     *
     * @param  string $classname Class name.
     * @param  string $method    Method name.
     * @return array
     */
    protected static function get_registered_hooks( string $classname, string $method ): array {
        static::$hooks[ $classname ][ $method ] ??= \array_unique(
            \wp_list_pluck( static::get_manager()->get_hooks( $classname )[ $method ] ?? array(), 'tag' ),
        );

        return static::$hooks[ $classname ][ $method ];
    }

    /**
     * Get the hook manager instance.
     *
     * @return Hook_Manager_Interface
     */
    protected static function get_manager(): Hook_Manager_Interface {
        return \XWP\Hook\Hook_Manager::instance();
    }
}
