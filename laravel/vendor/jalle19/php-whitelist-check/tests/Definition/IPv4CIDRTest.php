<?php

/**
 * Test for IPv4CIDR
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class IPv4CIDRTest extends DefinitionTest
{

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testEmptyDefinition()
	{
		$this->_definition = new \Whitelist\Definition\IPv4CIDR('');
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testValidate()
	{
		$this->_definition = new \Whitelist\Definition\IPv4CIDR('10.10.0.3');
	}

	/**
	 * @dataProvider provider
	 */
	public function testMatch($expected, $address)
	{
		$this->_definition = new \Whitelist\Definition\IPv4CIDR('10.10.0.0/16');
		$this->assertEquals($expected, $this->_definition->match($address));
	}

	public function provider()
	{
		return array(
			array(true, '10.10.1.1'),
			array(true, '10.10.76.1'),
			array(false, '110.1.76.1'),
		);
	}

}
