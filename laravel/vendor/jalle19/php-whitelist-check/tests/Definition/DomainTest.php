<?php

/**
 * Test for the domain definitions
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class DomainTest extends DefinitionTest
{

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testEmptyDefinition()
	{
		$this->_definition = new Whitelist\Definition\Domain('');
	}
	
	public function testValidate()
	{
		// do nothing here
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testValidateInvalidCharacters()
	{
		$this->_definition = new Whitelist\Definition\Domain('ag*');
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testValidateInvalidBeginning()
	{
		$this->_definition = new Whitelist\Definition\Domain('-otherwise-valid.com');
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testValidateInvalidEnd()
	{
		$this->_definition = new Whitelist\Definition\Domain('otherwise-valid-.com');
	}

	/**
	 * @dataProvider provider
	 */
	public function testMatch($expected, $definition, $value)
	{
		$this->assertEquals($expected, $definition->match($value));
	}

	public function provider()
	{
		return array(
			array(true,  new Whitelist\Definition\WildcardDomain('*.example.com'), 'sub.example.com'),
			array(true,  new Whitelist\Definition\WildcardDomain('*.example.com'), 'anothersub.example.com'),
			array(false,  new Whitelist\Definition\WildcardDomain('*.example.com'), 'sub.example.net'),
			array(false,  new Whitelist\Definition\WildcardDomain('*.example.com'), 'sub.anotherexample.com'),
			array(false,  new Whitelist\Definition\WildcardDomain('*.example.com'), 'localhost'),
			array(true,  new Whitelist\Definition\Domain('localhost'), 'localhost'),
			array(true,  new Whitelist\Definition\Domain('example.com'), 'example.com'),
			array(false, new Whitelist\Definition\Domain('example.com'), 'sub.example.com'),
			array(false, new Whitelist\Definition\Domain('example.com'), 'example2.com'),
		);
	}

}
