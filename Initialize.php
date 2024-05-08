<?php // phpcs:disable PHPCompatibility.Variables.ForbiddenThisUseContexts, WordPress.NamingConventions.ValidFunctionName.MethodNameInvalid
/**
 * Invoke enum file.
 *
 * @package eXtended WordPress
 * @subpackage Contracts\Hook
 */

namespace XWP\Contracts\Hook;

/**
 * Determines initialization strategy for a Handler.
 */
enum Initialize: string {
    /**
     * Indicates that the handler should be initialized unconditionally.
     */
    case Unconditionally = 'unconditional';

    /**
     * Indicates that the handler should be initialized immediately.
     */
    case Immediately = 'immediate';

    /**
     * Indicates that the handler should be initialized on registration.
     */
    case Early = 'early';

    /**
     * Indicates that the handler should be initialized on demand.
     *
     * On demand will initialize the handler when the hook is registered.
     */
    case OnDemand = 'on-demand';

    /**
     * Indicates that the handler should be initialized on specified action.
     */
    case Deferred = 'deferred';

    /**
     * Special case for manually initialized handlers.
     */
    case Dynamically = 'dynamic';

    /**
     * Indicates that the handler should be initialized just in time.
     *
     * Just in time will initialize the handler just before the hook is invoked.
     */
    case JustInTime = 'just-in-time';

    /**
     * Check if the tag is valid for the initialization strategy.
     *
     * @param  string|null $tag Tag to check.
     * @return bool
     */
    public function isTagValid( ?string $tag ): bool {
        return match ( $this ) {
            self::OnDemand,
            self::JustInTime,
            self::Dynamically,
            self::Immediately => ! $tag,
            default => ! ! $tag,
        };
    }

    /**
     * Check if the handler hooks indirectly.
     *
     * @return bool
     */
    public function hooksIndirectly(): bool {
        return match ( $this ) {
            self::OnDemand,
            self::JustInTime => true,
            default => false,
        };
    }

    /**
     * Check if the handler is initialized on demand.
     *
     * @return bool
     */
    public function isOnDemand(): bool {
        return self::OnDemand === $this;
    }

    /**
     * Check if the handler is initialized just in time.
     *
     * @return bool
     */
    public function isJIT(): bool {
        return self::JustInTime === $this;
    }
}
