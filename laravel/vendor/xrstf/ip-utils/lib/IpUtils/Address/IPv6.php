<?php
/*
 * Copyright (c) 2013, Christoph Mewes, http://www.xrstf.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

namespace IpUtils\Address;

use IpUtils\Expression\Subnet;
use IpUtils\Expression\ExpressionInterface;

class IPv6 implements AddressInterface {
	protected $address;

	public function __construct($address) {
		if (!self::isValid($address)) {
			throw new \UnexpectedValueException('"'.$address.'" is no valid IPv6 address.');
		}

		$this->address = implode(':', array_map(function($b) {
			return sprintf('%04x', $b);
		}, unpack('n*', inet_pton($address))));
	}

	/**
	 * @param  string $addr
	 * @return boolean
	 */
	public static function isValid($address) {
		return filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
	}

	/**
	 * @param  int $netmask
	 * @return boolean
	 */
	public static function isValidNetmask($netmask) {
		return $netmask >= 1 && $netmask <= 128;
	}

	/**
	 * @return IPv6
	 */
	public static function getLoopback() {
		return new self('::1');
	}

	/**
	 * get fully expanded address
	 *
	 * @return string
	 */
	public function getExpanded() {
		return $this->address;
	}

	/**
	 * get compact address representation
	 *
	 * @return string
	 */
	public function getCompact() {
		return inet_ntop(inet_pton($this->address));
	}

	/**
	 * get IP-specific chunks ([ff,0,0,0,12,2001,ff,....])
	 *
	 * @return array
	 */
	public function getChunks() {
		return array_map(function($c) {
			return ltrim($c, '0') ?: '0';
		}, explode(':', $this->getExpanded()));
	}

	/**
	 * returns the compact representation
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getCompact();
	}

	/**
	 * check whether the IP points to the loopback (localhost) device
	 *
	 * @return boolean
	 */
	public function isLoopback() {
		return $this->matches(new Subnet('::1/128'));
	}

	/**
	 * check whether the IP is inside a private network
	 *
	 * @return boolean
	 */
	public function isPrivate() {
		return $this->matches(new Subnet('fc00::/7'));
	}

	/**
	 * check whether the address matches a given pattern/range
	 *
	 * @param  ExpressionInterface $expression
	 * @return boolean
	 */
	public function matches(ExpressionInterface $expression) {
		return $expression->matches($this);
	}
}
