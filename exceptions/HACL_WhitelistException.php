<?php
/*
 * Copyright (C) Vulcan Inc.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program.If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * @file
 * @ingroup HaloACL_Exception
 *
 * This file contains the class HACLWhitelistException.
 * 
 * @author Thomas Schweitzer
 * Date: 11.05.2009
 * 
 */
if ( !defined( 'MEDIAWIKI' ) ) {
	die( "This file is part of the HaloACL extension. It is not a valid entry point.\n" );
}

/**
 * Exceptions for the operations on whitelists of HaloACL.
 *
 */
class HACLWhitelistException extends HACLException {

	//--- Constants ---
	
	// There is no article for the given article names. 
	// Parameters:
	// 1 - array of article names
	const PAGE_DOES_NOT_EXIST = 1;	
	
	// An unauthorized user tries to modify the definition of the whitelist. 
	// Parameters:
	// 1 - name of the user
	const USER_CANT_MODIFY_WHITELIST = 2;
	

	/**
	 * Constructor of the whitelist exception.
	 *
	 * @param int $code
	 * 		A user defined error code.
	 */
    public function __construct($code = 0) {
    	$args = func_get_args();
    	// initialize super class
        parent::__construct($args);
    }
    
    protected function createMessage($args) {
    	$msg = "";
    	switch ($args[0]) {
    		case self::PAGE_DOES_NOT_EXIST:
    			$msg = "The articles with following names do not exist:\n" .
    			       implode(',', $args[1]) .
    			       "\nThese articles can not be added to the whitelist.";
    			break;
    		case self::USER_CANT_MODIFY_WHITELIST:
    			$msg = "The user $args[1] is not authorized to modify the Whitelist.";
    			break;
    			
    	}
    	return $msg;
    }
}
