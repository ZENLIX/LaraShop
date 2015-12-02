<?php

/**
 * Base class for all definition tests. We use this to force subclasses to 
 * implement certain tests.
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
abstract class DefinitionTest extends PHPUnit_Framework_Testcase
{

	/**
	 * @var IDefinition the definition class
	 */
	protected $_definition;

	/**
	 * Should test for exception when the constructor is called with an 
	 * empty string
	 */
	abstract public function testEmptyDefinition();

	/**
	 * Should test for exception when constructor is called with an invalid 
	 * definition string
	 */
	abstract public function testValidate();

}
