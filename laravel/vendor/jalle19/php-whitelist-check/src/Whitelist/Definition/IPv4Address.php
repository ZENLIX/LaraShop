<?php

namespace Whitelist\Definition;

/**
 * Represents an IPv4 address definition
 *
 * @author Sam Stenvall <neggelandia@gmail.com>
 * @copyright Copyright &copy; Sam Stenvall 2014-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class IPv4Address extends IPAddress
{

	public function validate()
	{
		return \IpUtils\Address\IPv4::isValid($this->_definition);
	}

}
