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
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CurubaGram Correction Model
 *
 * @category	Models
 * @author		Juan Sebastián Beleño Díaz
 * @link		xxx
 */
class Correction_model extends CI_Model {

	/**
	 * Constructor
	 *
	 * @return	void
	 */
	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
	
    // --------------------------------------------------------------------
    
    /**
	 * Register a new orthographic correction
	 *
	 * @param	string	$id_user	username that will identify the user
	 * @param	string	$id_text	text with orthographic errors
	 * @param 	string 	$correction	source of the text
	 * @return	array
	 */
    public function add($id_user, $id_text, $correction)
    {
        if(strlen($correction) == 0)
        {
            return array(
                'status' => 'BAD',
                'msg' => '¡Lo sentimos! no podemos aceptar una corrección vacía.'
            );
        }

    	$data = array(
    		'correction' => $correction,
    		'date' => date("Y-m-d H:i:s")
    	);

    	// Handling the UUID as identifier
        $this->db->set('id', "UNHEX(REPLACE(UUID(),'-',''))", FALSE);
        $this->db->set('id_user', "UNHEX('".$id_user."')", FALSE);
        $this->db->set('id_text', "UNHEX('".$id_text."')", FALSE);

        $this->db->insert('correction', $data);

        return array('status' => 'OK');
    }
}

/* End of file Correction_model.php */
/* Location: ./application/models/Correction_model.php */