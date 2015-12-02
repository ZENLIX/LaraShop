<?php
/*
 * Copyright (c) 2013, Christoph Mewes, http://www.xrstf.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

namespace IpUtils\Expression;

use IpUtils\Address\AddressInterface;
use IpUtils\Address\IPv4;
use IpUtils\Address\IPv6;
use IpUtils\Exception\InvalidExpressionException;

class Literal implements ExpressionInterface {
	protected $expression;

	public function __construct($expression) {
		$expression = strtolower(trim($expression));

		if (IPv4::isValid($expression)) {
			$ip = new IPv4($expression);
		}
		elseif (IPv6::isValid($expression)) {
			$ip = new IPv6($expression);
		}
		else {
			throw new InvalidExpressionException('Expression must be either a valid IPv4 or IPv6 address.');
		}

		$this->expression = $ip->getCompact();
	}

	/**
	 * check whether the expression matches an address
	 *
	 * @param  AddressInterface $address
	 * @return boolean
	 */
	public function matches(AddressInterface $address) {
		return $address->getCompact() === $this->expression;
	}
}
