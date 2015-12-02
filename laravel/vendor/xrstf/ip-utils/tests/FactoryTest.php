<?php
/*
 * Copyright (c) 2013, Christoph Mewes, http://www.xrstf.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

use IpUtils\Address\IPv4;
use IpUtils\Address\IPv6;
use IpUtils\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @dataProvider  validAddressProvider
	 */
	public function testGetAddress($address, $expected) {
		$address = Factory::getAddress($address);
		$this->assertInstanceOf($expected, $address);
	}

	public function validAddressProvider() {
		$v4 = 'IpUtils\Address\IPv4';
		$v6 = 'IpUtils\Address\IPv6';

		return array(
			array('0.0.0.0',   $v4),
			array('127.0.0.1', $v4),
			array('::1',       $v6),
			array('fe80::',    $v6)
		);
	}

	/**
	 * @dataProvider       invalidAddressProvider
	 * @expectedException  UnexpectedValueException
	 */
	public function testGetInvalidAddress($address) {
		Factory::getAddress($address);
	}

	public function invalidAddressProvider() {
		return array(
			array('0.0.0.300'),
			array('abc'),
			array(':hallo:welt::')
		);
	}

	/**
	 * @dataProvider  expressionProvider
	 */
	public function testGetExpression($expr, $expected) {
		$expr = Factory::getExpression($expr);
		$this->assertInstanceOf($expected, $expr);
	}

	public function expressionProvider() {
		$literal = 'IpUtils\Expression\Literal';
		$pattern = 'IpUtils\Expression\Pattern';
		$subnet  = 'IpUtils\Expression\Subnet';

		return array(
			array('0.0.0.0', $literal),
			array('::1',     $literal),
			array('fe80::1', $literal),

			array('0.0.0.0/8',  $subnet),
			array('::1/8',      $subnet),
			array('fe80::/128', $subnet),

			array('fe*::',     $pattern),
			array('::1:*',     $pattern),
			array('127.*.*.0', $pattern)
		);
	}
}
