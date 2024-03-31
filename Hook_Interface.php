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
     * Constructor.
     *
     * Properties should be readonly and publicly accessible.
     *
     * @param  string                     $tag         Hook tag.
     * @param  int                        $priority    Hook priority.
     * @param  int                        $context     Hook context.
     * @param  array|string|\Closure|null $conditional Hook conditional.
     * @param  string|array|false         $args        Tag replacement pairs.
     */
    public function __construct(
        string $tag,
        array|int|string $priority = 10,
        int $context = self::CTX_GLOBAL,
        array|string|\Closure|null $conditional = null,
        string|array|false $args = false,
    );

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
