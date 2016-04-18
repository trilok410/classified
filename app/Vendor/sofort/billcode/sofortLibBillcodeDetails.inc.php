<?php
require_once(dirname(__FILE__).'../../core/sofortLibPaycodeDetailsAbstract.inc.php');

/**
 * @copyright 2010-2015 SOFORT GmbH
 *
 * @license Released under the GNU LESSER GENERAL PUBLIC LICENSE (Version 3)
 * @license http://www.gnu.org/licenses/lgpl.html
 */
class SofortLibBillcodeDetails extends SofortLibPaycodeDetailsAbstract {
	
	protected $_root = 'billcode';
	
	protected $_rootTag = 'billcode_request';
	
	
	/**
	 * Returns the responses billcode
	 *
	 * @return mixed|bool
	 */
	public function getBillcode() {
		return $this->_extractValue('billcode');
	}
	
	
	/**
	 * Setter for the billcode of the request
	 * 
	 * @param string $billcode
	 * @return SofortLibBillcodeDetails $this
	 */
	public function setBillcode($billcode) {
		$this->_parameters['billcode'] = $billcode;
		
		return $this;
	}
}