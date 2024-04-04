<?php
/**
 * Hookable interface file.
 *
 * @package eXtended WordPress
 * @subpackage Contracts\Hook
 */

namespace XWP\Contracts\Hook;

/**
 * Hook decorator functionality.
 *
 * @template T
 *
 * ! Global properties shared among hooks and handlers
 *
 * @property-read string                    $tag           Hook name. Can use the `vsprinf` format in combination with `$modifiers`.
 * @property-read array|int|string|callable $priority      Hook priority. Can be a number, callable, or a string. Strings are treated as filters, which will be applied to the default priority.
 * @property-read int                       $context       Context bitmask determining where the hook can be invoked.
 * @property-read string|false              $requires      Prerequisite hook that must be invoked before this hook. Handler classname, or Classname, method array.
 * @property-read string|array|false        $modifiers     Replacement pairs for the tag name.
 * @property-read int                       $real_priority Actual priority of the hook.
 * @property-read array|callable|false      $conditional   Hook conditional. Callable which will be invoked to determine if the hook should be invoked.
 */
interface Hookable {
    /**
     * Indicates that a hook can be invoked in user-facing pages.
     *
     * @var int
     */
    public const CTX_FRONTEND = 1;  // 0000001

    /**
     * Indicates that a hook can be invoked in the admin area.
     *
     * @var int
     */
    public const CTX_ADMIN = 2;  // 0000010

    /**
     * Indicates that a hook can be invoked on AJAX requests.
     *
     * @var int
     */
    public const CTX_AJAX = 4;  // 0000100

    /**
     * Indicates that a hook can be invoked when a cron job is running.
     *
     * @var int
     */
    public const CTX_CRON = 8;  // 0001000

    /**
     * Indicates that a hook can be invoked on REST API requests.
     *
     * @var int
     */
    public const CTX_REST = 16; // 0010000

    /**
     * Indicates that a hook can be invoked when WP CLI is running.
     *
     * @var int
     */
    public const CTX_CLI = 32; // 0100000

    /**
     * Indicates that a hook can be invoked in any context.
     *
     * @var int
     */
    public const CTX_GLOBAL = 63; // 0111111

    /**
     * Hook type. Can be `handler`, `action` or `filter`.
     *
     * @var string
     */
    public const HOOK_TYPE = self::HOOK_TYPE;

    /**
     * Set the reflector
     *
     * @param  \Reflector $reflector Reflector instance.
     * @return static
     */
    public function set_reflector( \Reflector $reflector ): static;

    /**
     * Set the hook target.
     *
     * @param  array|T $target Hook target.
     * @return static
     */
    public function set_target( array|object $target ): static;
}
