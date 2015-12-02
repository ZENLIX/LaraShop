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

interface ExpressionInterface {
	/**
	 * check whether the expression matches an address
	 *
	 * @param  AddressInterface $address
	 * @return boolean
	 */
	public function matches(AddressInterface $address);
}
