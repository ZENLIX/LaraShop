<?php
/*
 * Copyright (c) 2013, Christoph Mewes, http://www.xrstf.de
 *
 * This file is released under the terms of the MIT license. You can find the
 * complete text in the attached LICENSE file or online at:
 *
 * http://www.opensource.org/licenses/mit-license.php
 */

namespace Address;

use IpUtils\Address\IPv6;
use IpUtils\Factory;

class IPv6Test extends \PHPUnit_Framework_TestCase {
	/**
	 * @dataProvider  addressProvider
	 */
	public function testIsValid($address, $expected) {
		$this->assertEquals($expected, IPv6::isValid($address));

		try {
			$addr = new IPv6($address);

			if ($expected === false) {
				$this->fail('Constructor should fail if invalid IP was given.');
			}
		}
		catch (\UnexpectedValueException $e) {
			if ($expected === true) {
				$this->fail('Constructor should not have thrown up.');
			}
		}
	}

	public function addressProvider() {
		return array(
			array('::1',       true),
			array('feee::0:1', true),

			array('muh',     false),
			array('muh::1',  false),
			array('',        false),
			array('1',       false),
			array('1:',      false),
			array('1:foo',   false),
			array('1.1.1.1', false),
			array('::1/123', false),
			array(': :1',    false)
		);
	}

	public function testGetExpanded() {
		$addr = new IPv6('::1');
		$this->assertSame('0000:0000:0000:0000:0000:0000:0000:0001', $addr->getExpanded());
	}

	public function testGetCompact() {
		$addr = new IPv6('0:0:0:0:0:0:0:1');
		$this->assertSame('::1', $addr->getCompact());
	}

	public function testToString() {
		$addr = new IPv6('0:0:0:0:0:0:0:1');
		$this->assertSame('::1', (string) $addr);
	}

	/**
	 * @dataProvider  loopbackProvider
	 */
	public function testIsLoopback($address, $expected) {
		$address = new IPv6($address);
		$this->assertSame($expected, $address->isLoopback());
	}

	public function loopbackProvider() {
		return array(
			array('0:0:0:0:0:0:0:1',  true),
			array('::1',              true),
			array('1::1',             false),
			array('2a01:198:603:0::', false)
		);
	}

	/**
	 * @dataProvider  chunkProvider
	 */
	public function testGetChunks($address, array $chunks) {
		$addr = new IPv6($address);
		$this->assertSame($chunks, $addr->getChunks());
	}

	public function chunkProvider() {
		return array(
			array('::1',              array('0', '0', '0', '0', '0', '0', '0', '1')),
			array('2a01:198:603:0::', array('2a01', '198', '603', '0', '0', '0', '0', '0'))
		);
	}

	/**
	 * @dataProvider  privateProvider
	 */
	public function testIsPrivate($address, $expected) {
		$addr = new IPv6($address);
		$this->assertSame($expected, $addr->isPrivate());
	}

	public function privateProvider() {
		return array(
			array('::1',               false),
			array('fc00::',            true),
			array('fc00::1',           true),
			array('fd00::1',           true),
			array('fc00:0:0:0:1::',    true),
			array('fc00:0:beaf:0:1::', true),

			array('fbff::',     false),
			array('fbff::ffff', false),
			array('fe01::beaf', false)
		);
	}

	public function testGetLoopback() {
		$this->assertTrue(IPv6::getLoopback()->isLoopback());
	}
}
