<?php

/**
 * Tests for IPv4Address
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class IPv4AddressTest extends DefinitionTest
{

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testEmptyDefinition()
	{
		$this->_definition = new \Whitelist\Definition\IPv4Address('');
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testValidate()
	{
		$this->_definition = new \Whitelist\Definition\IPv4Address('not.an.ipv4.address');
	}

	/**
	 * @dataProvider provider
	 */
	public function testMatch($expected, $address)
	{
		$this->_definition = new \Whitelist\Definition\IPv4Address('192.168.1.1');
		$this->assertEquals($expected, $this->_definition->match($address));
	}

	public function provider()
	{
		return array(
			array(true, '192.168.1.1'),
			array(false, '192.168.1.2'),
		);
	}

}
