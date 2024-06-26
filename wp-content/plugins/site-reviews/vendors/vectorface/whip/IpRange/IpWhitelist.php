<?php

namespace GeminiLabs\Vectorface\Whip\IpRange;

/**
 * A class representing the list of whitelisted IP addresses.
 * @copyright Vectorface, Inc 2015
 * @author Daniel Bruce <dbruce1126@gmail.com>
 */
class IpWhitelist
{
    /** The whitelist key for IPv4 addresses */
    const IPV4 = 'ipv4';

    /** The whitelist key for IPv6 addresses */
    const IPV6 = 'ipv6';

    /** an array of Ipv4Range items */
    private array $ipv4Whitelist;

    /** an array of Ipv6Range items */
    private array $ipv6Whitelist;

    /**
     * Constructor for the class.
     * @param array $whitelists An array with two keys ('ipv4' and 'ipv6') with
     *        each key mapping to an array of valid IP ranges.
     */
    public function __construct(array $whitelists)
    {
        $this->ipv4Whitelist = $this->constructWhiteListForKey(
            $whitelists,
            self::IPV4,
            Ipv4Range::class
        );
        $this->ipv6Whitelist = $this->constructWhiteListForKey(
            $whitelists,
            self::IPV6,
            Ipv6Range::class
        );
    }

    /**
     * Returns whether the given IP address is within the whitelist.
     *
     * @param string $ipAddress A valid IPv4 or IPv6 address.
     * @return bool Returns true if the IP address matches one of the
     *         whitelisted IP ranges and false otherwise.
     */
    public function isIpWhitelisted(string $ipAddress): bool
    {
        // determine whether this IP is IPv4 or IPv6
        $isIpv4Address = filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        return $this->isIpInWhitelist(
            ($isIpv4Address) ? $this->ipv4Whitelist : $this->ipv6Whitelist,
            $ipAddress
        );
    }

    /**
     * Constructs the whitelist for the given key. Each element in the
     * whitelist gets mapped from a string to an instance of an Ipv4Range or
     * Ipv6Range.
     *
     * @param array $whitelist The input whitelist of ranges.
     * @param string $key The key to use from the input whitelist ('ipv4' or
     *        'ipv6').
     * @param string $class Each range string gets mapped to an instance of the
     *        specified $class.
     * @return array Returns an array of Ipv4Range or Ipv6Range elements.
     */
    private function constructWhiteListForKey(array $whitelist, string $key, string $class): array
    {
        if (!isset($whitelist[$key]) || !is_array($whitelist[$key])) {
            return [];
        }
        return array_map(function ($range) use ($class) {
            return new $class($range);
        }, array_values($whitelist[$key]));
    }

    /**
     * Returns whether the given IP address is in the given whitelist.
     *
     * @param array $whitelist The given whitelist.
     * @param string $ipAddress The given IP address.
     * @return bool Returns true if the IP address is in the whitelist and
     *         false otherwise.
     */
    private function isIpInWhitelist(array $whitelist, string $ipAddress): bool
    {
        foreach ($whitelist as $ipRange) {
            if ($ipRange->containsIp($ipAddress)) {
                return true;
            }
        }
        return false;
    }
}
