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

use IpUtils\Expression\ExpressionInterface;

interface AddressInterface {
	/**
	 * get fully expanded address
	 *
	 * @return string
	 */
	public function getExpanded();

	/**
	 * get compact address representation
	 *
	 * @return string
	 */
	public function getCompact();

	/**
	 * get IP-specific chunks ([127,000,000,001] for IPv4 or [0000,0000,00ff,00ea,0001,...] for IPv6)
	 *
	 * @return array
	 */
	public function getChunks();

	/**
	 * check whether the address matches a given pattern/range
	 *
	 * @param  ExpressionInterface $expression
	 * @return boolean
	 */
	public function matches(ExpressionInterface $expression);
}
