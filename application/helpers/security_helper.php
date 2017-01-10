<?php
/**
 * CurubaGram
 *
 * An architecture to collect grammar corrections for spanish language
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016 - 2017, Juan Sebastián Beleño Díaz
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CurubaGram
 * @author	Juan Sebastián Beleño Díaz
 * @copyright	Copyright (c) 2017, Juan Sebastián Beleño Díaz
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/jbeleno
 * @since	Version 1.0.0
 * @filesource
 */

/**
 * CurubaGram Security Helper
 *
 * @category	Helpers
 * @author		Juan Sebastián Beleño Díaz
 * @link		xxx
 */


if(!function_exists('verify_encryption'))
{
	/**
	 * Verify whether a password match with a bcrypt hash or not
	 *
	 * @param	string	$data			data without encryption
	 * @param	string	$hash_bcrypt	bcrypt hash that will be matched against the data
	 * @return	bool
	 */
    function verify_encryption($data, $hash_bcrypt){
        if (password_verify($data, $hash_bcrypt)) 
            return TRUE;

        return FALSE;
    }
}

if(!function_exists('encrypt_data'))
{
	/**
	 * Encrypt the data using bcrypt
	 *
	 * @param	string	$data	data that will be encrypted
	 * @return	string 	a string with the data encrypted
	 */
	function encrypt_data($data){
        $options = [
            'cost' => HASH_COST,
        ];
        $hash_bcrypt = password_hash($data, PASSWORD_BCRYPT, $options);

        return $hash_bcrypt;
	}
}