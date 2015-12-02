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

use IpUtils\Address\IPv4;
use IpUtils\Factory;

class IPv4Test extends \PHPUnit_Framework_TestCase {
	/**
	 * @dataProvider  addressProvider
	 */
	public function testIsValid($address, $expected) {
		$this->assertEquals($expected, IPv4::isValid($address));

		try {
			$addr = new IPv4($address);

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
			array('0.0.0.0',   true),
			array('127.0.0.1', true),

			array('127.0.0.300', false),
			array('127.0.000.1', false),
			array('127.0. 0.1',  false),
			array('127. ',       false),
			array('',            false),
			array('::1',         false),
			array('1.1.1.1/8',   false),
			array('1.-.1.1',     false)
		);
	}

	public function testGetExpanded() {
		$addr = new IPv4('127.0.0.1');
		$this->assertSame('127.0.0.1', $addr->getExpanded());
	}

	public function testGetCompact() {
		$addr = new IPv4('127.0.0.1');
		$this->assertSame('127.0.0.1', $addr->getCompact());
	}

	public function testToString() {
		$addr = new IPv4('127.0.0.1');
		$this->assertSame('127.0.0.1', (string) $addr);
	}

	/**
	 * @dataProvider  loopbackProvider
	 */
	public function testIsLoopback($address, $expected) {
		$address = new IPv4($address);
		$this->assertSame($expected, $address->isLoopback());
	}

	public function loopbackProvider() {
		return array(
			array('127.0.0.1', true),
			array('127.0.0.2', true),
			array('127.0.1.0', true),
			array('128.0.0.1', false)
		);
	}

	/**
	 * @dataProvider  chunkProvider
	 */
	public function testGetChunks($address, array $chunks) {
		$addr = new IPv4($address);
		$this->assertSame($chunks, $addr->getChunks());
	}

	public function chunkProvider() {
		return array(
			array('0.0.0.0',   array('0', '0', '0', '0')),
			array('127.0.0.1', array('127', '0', '0', '1'))
		);
	}

	/**
	 * @dataProvider  privateProvider
	 */
	public function testIsPrivate($address, $expected) {
		$addr = new IPv4($address);
		$this->assertSame($expected, $addr->isPrivate());
	}

	public function privateProvider() {
		return array(
			array('0.0.0.0',        false),
			array('192.168.100.15', true),
			array('10.0.0.0',       true),
			array('10.0.0.50',      true),
			array('10.0.1.50',      true),
			array('127.0.0.1',      false),
			array('172.16.0.1',     true),
			array('172.1.0.1',      false)
		);
	}

	public function testGetLoopback() {
		$this->assertTrue(IPv4::getLoopback()->isLoopback());
	}

	/**
	 * @dataProvider  multicastProvider
	 */
	public function testIsMulticast($address, $expected) {
		$addr = new IPv4($address);
		$this->assertSame($expected, $addr->isMulticast());
	}

	public function multicastProvider() {
		return array(
			array('224.0.0.1', true),
			array('220.0.0.2', false)
		);
	}

	/**
	 * @dataProvider  linkLocalProvider
	 */
	public function testIsLinkLocal($address, $expected) {
		$addr = new IPv4($address);
		$this->assertSame($expected, $addr->isLinkLocal());
	}

	public function linkLocalProvider() {
		return array(
			array('169.254.1.1', true),
			array('169.255.1.1', false),
		);
	}
}
