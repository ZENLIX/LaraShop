<?php

namespace Whitelist\Definition;

/**
 * Represents a CIDR notation 
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
abstract class IPCIDR extends Definition
{

	protected $_subnet;

	public function validate()
	{
		try
		{
			$this->_subnet = \IpUtils\Factory::getExpression($this->_definition);
			
			// Check that we got a subnet expression and not something else
			if (!$this->_subnet instanceof \IpUtils\Expression\Subnet)
				return false;
		}
		catch (\Exception $e)
		{
			unset($e);
			return false;
		}

		return true;
	}

	public function match($value)
	{
		try
		{
			$address = \IpUtils\Factory::getAddress($value);
			return $this->_subnet->matches($address);
		}
		catch (\Exception $e)
		{
			unset($e);
			return false;
		}
	}

}
