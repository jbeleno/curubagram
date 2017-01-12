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
 * CurubaGram Text Model
 *
 * @category	Models
 * @author		Juan Sebastián Beleño Díaz
 * @link		xxx
 */

class Text_model extends CI_Model {

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
	 * Register a new text with orthographic errors
	 *
	 * @param	string	$id_user	username that will identify the user
	 * @param	string	$text		text with orthographic errors
	 * @param 	string 	$source 	source of the text
	 * @return	array
	 */
    public function add($id_user, $text, $source)
    {
    	$data = array(
    		'content' => $text,
    		'source' => $source,
    		'date' => date("Y-m-d H:i:s")
    	);

        // Verify if the text is empty or short
        if(strlen($text) < 3)
        {
            return array(
                'status' => 'BAD',
                'msg' => '¡Lo sentimos! El texto es demasiado corto'
            );
        }

        // Verify if the text is too long
        if(strlen($text) > 512)
        {
            return array(
                'status' => 'BAD',
                'msg' => '¡Lo sentimos! El texto es demasiado largo. Intenta dividir el texto en varias partes y enviarlas por separado.'
            );
        }

        // Verify if the source is empty
        if(strlen($source) == 0)
        {
            return array(
                'status' => 'BAD',
                'msg' => '¡Lo sentimos! Debes escribir la fuente de origen del texto.'
            );
        }

    	// Handling the UUID as identifier
        $this->db->set('id', "UNHEX(REPLACE(UUID(),'-',''))", FALSE);
        $this->db->set('id_user', "UNHEX('".$id_user."')", FALSE);

        $this->db->insert('text', $data);

        return array('status' => 'OK');
    }

    // --------------------------------------------------------------------
    
    /**
	 * Get a random text with orthographic errors
	 *
	 * @return	array
	 */
    public function get_random_text()
    {
    	$query_text = 'SELECT HEX(id) as id, content, source FROM text ORDER BY RAND() LIMIT 1';
    	$query = $this->db->query($query_text);

    	$text = $query->row();
        
    	$this->session->set_userdata('id_text', $text->id);

        return array(
        	'status' => 'OK',
        	'text' => $text
        );
    }
}

/* End of file Text_model.php */
/* Location: ./application/Text_model.php */