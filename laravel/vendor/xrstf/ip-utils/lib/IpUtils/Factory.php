<?php
/*
 * Copyright (c) 2013, Christoph Mewes, http://www.xrstf.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

namespace IpUtils;

use IpUtils\Address;
use IpUtils\Expression;

class Factory {
	public static function getAddress($address) {
		if (strpos($address, ':') === false) {
			return new Address\IPv4($address);
		}

		return new Address\IPv6($address);
	}

	public static function getExpression($expr) {
		if (strpos($expr, '/') === false) {
			if (strpos($expr, '*') === false) {
				return new Expression\Literal($expr);
			}

			return new Expression\Pattern($expr);
		}

		return new Expression\Subnet($expr);
	}
}
