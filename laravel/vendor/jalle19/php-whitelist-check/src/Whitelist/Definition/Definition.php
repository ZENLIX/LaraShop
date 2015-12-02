<?php

namespace Whitelist\Definition;

/**
 * Base class for all definitions
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
abstract class Definition implements IDefinition
{

	/**
	 * @var string the actual definition
	 */
	protected $_definition;

	/**
	 * Class constructor. It stores the definition string and validates it.
	 * @param string $definition the definition
	 * @throws InvalidArgumentException if the definition is invalid
	 */
	public function __construct($definition)
	{
		$this->_definition = $definition;

		if (!$this->validate())
			throw new \InvalidArgumentException('The definition "'.$this->_definition.'" is invalid');
	}

}
