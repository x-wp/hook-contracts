<?php //phpcs:disable PHPCompatibility.Variables.ForbiddenThisUseContexts
/**
 * Context enum file.
 *
 * @package
 * @subpackage Enum
 */

namespace XWP\Contracts\Hook;

/**
 * Determines the current WP execution context.
 */
enum Context: int implements Context_Interface {
    /**
     * Frontend context.
     */
    case Frontend = 1;

    /**
     * Admin context.
     */
    case Admin = 2;

    /**
     * AJAX context.
     */
    case Ajax = 4;

    /**
     * Cron context.
     */
    case Cron = 8;

    /**
     * REST API context.
     */
    case REST = 16;

    /**
     * WP CLI context.
     */
    case CLI = 32;

    /**
     * Global context.
     */
    case Global = 63;

    /**
     * Format the context for display.
     *
     * @return string
     */
    public function display_name(): string {
        return match ( $this ) {
            self::Frontend => 'Frontend',
            self::Admin    => 'Admin',
            self::Ajax     => 'Ajax',
            self::Cron     => 'Cron',
            self::REST     => 'REST',
            self::CLI      => 'CLI',
            self::Global   => 'Global',
        };
    }

    /**
     * Create a context from a slug.
     *
     * @param  string $ctx_slug The context slug.
     * @return Context
     */
    public static function fromSlug( string $ctx_slug ): Context {
        return match ( $ctx_slug ) {
            'front', 'frontend',
            'public', 'website'   => self::Frontend,
            'admin', 'dashboard',
            'administration'      => self::Admin,
            'ajax'                => self::Ajax,
            'cron'                => self::Cron,
            'rest'                => self::REST,
            'cli'                 => self::CLI,
            'global'              => self::Global,
        };
    }

    /**
     * Check if the current context is valid.
     *
     * @param  int $ctx The context to check.
     * @return bool
     */
    public function is_valid( int $ctx ): bool {
        return 0 !== ( $this->value & $ctx );
    }
}
