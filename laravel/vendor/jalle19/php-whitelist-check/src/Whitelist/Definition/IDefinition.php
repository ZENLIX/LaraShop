<?php

namespace Whitelist\Definition;

/**
 * Interface for definitions
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
interface IDefinition
{

	/**
	 * Validates the definition and returns false if the definition is 
	 * invalid
	 */
	public function validate();

	/**
	 * Returns true if the value matches the definition
	 */
	public function match($value);
}
