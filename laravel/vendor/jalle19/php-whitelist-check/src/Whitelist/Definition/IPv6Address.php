<?php

namespace Whitelist\Definition;

/**
 * Represents an IPv6 address definition
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class IPv6Address extends IPAddress
{

	public function validate()
	{
		return \IpUtils\Address\IPv6::isValid($this->_definition);
	}

}
