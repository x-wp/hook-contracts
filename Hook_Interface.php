<?php
/**
 * Hook_Interface interface file.
 *
 * @package XWP
 * @subpackage Contracts\Hook
 */

namespace XWP\Contracts\Hook;

/**
 * Hook decorator functionality.
 *
 * @property-read string                    $tag         Hook name. Can use the `vsprinf` format in combination with `$modifiers`.
 * @property-read array|int|string|callable $priority    Hook priority. Can be a number, callable, or a string. Strings are treated as filters, which will be applied to the default priority.
 * @property-read int                       $context     Context bitmask determining where the hook can be invoked.
 * @property-read array|callable|false      $conditional Hook conditional. Callable which will be invoked to determine if the hook should be invoked.
 * @property-read string|false              $requires    Prerequisite hook that must be invoked before this hook. Handler classname, or Classname, method array.
 * @property-read string|array|false        $modifiers   Replacement pairs for the tag name.
 *
 * @property bool         $invoked Flag indicating if the hook has been invoked.
 * @property string|array $target  Hook target. Handler classname, or handler, method array.
 */
interface Hook_Interface {
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
     * Gets the parsed (actual) priority for a hook.
     *
     * Since hook priorities can be defined as a filter / callable actual priority is resolved at runtime just before the hook is invoked.
     *
     * @return int
     */
    public function get_priority(): int;

    /**
     * Applies the hook to a handler.
     *
     * @param  string|object $handler Handler to apply the hook to. Classname, or handler instance.
     * @return Hook_Manager_Interface
     */
    public function apply( string|object $handler ): Hook_Manager_Interface;

    /**
     * Get the hook manager instance.
     *
     * @return Hook_Manager_Interface
     */
    public function get_manager(): Hook_Manager_Interface;
}
