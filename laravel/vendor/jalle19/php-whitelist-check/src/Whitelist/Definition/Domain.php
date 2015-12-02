<?php

namespace Whitelist\Definition;

/**
 * Represents a domain definition
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Domain extends Definition
{

	public function validate()
	{
		// The domain name cannot be empty
		if (strlen($this->_definition) === 0)
			return false;

		// None of the parts in the domain name can contain invalid characters 
		// or begin/end with a dash
		foreach (explode('.', $this->_definition) as $part)
		{
			if (!preg_match('/^[a-zA-Z0-9-\.]+$/', $part) ||
					substr($part, 0, 1) === '-' ||
					substr($part, -1) === '-')
			{
				return false;
			}
		}

		return true;
	}

	public function match($value)
	{
		return $this->_definition === $value;
	}

}
