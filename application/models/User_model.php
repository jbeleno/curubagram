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
 * CurubaGram User Model
 *
 * @category	Models
 * @author		Juan Sebastián Beleño Díaz
 * @link		xxx
 */
class User_model extends CI_Model {

	/**
	 * Constructor
	 *
	 * @return	void
	 */
	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();

        // Loading security helper
        $this->load->helper('security');
    }

    // --------------------------------------------------------------------
    
    /**
	 * Register a new user
	 *
	 * @param	string	$username	username that will identify the user
	 * @param	string	$email		email that belongs to the user
	 * @param	string	$password	password of the user
	 * @return	array
	 */
    public function add($username, $email, $password)
    {
    	// Verify the username
    	$this->db->where('username', $username);
    	if($this->db->count_all_results('user'))
    	{
    		return array(
    			'status' => 'BAD',
    			'msg' => '¡Lo sentimos!, ya existe alguien registrado con ese nombre de usuario.'
    		);
    	}

    	// Verify the email
    	$this->db->where('email', $email);
    	if($this->db->count_all_results('user'))
    	{
    		return array(
    			'status' => 'BAD',
    			'msg' => '¡Lo sentimos!, ya existe alguien registrado con ese correo electrónico.'
    		);
    	}

        // Verify username length
        if(strlen($username) < 3){
            return array(
                'status' => 'BAD',
                'msg' => '¡Lo sentimos!, el nombre de usuario es muy corto.'
            );
        }

        // Verify password length
        if(strlen($password) < 6){
            return array(
                'status' => 'BAD',
                'msg' => '¡Lo sentimos!, la contraseña debe tener al menos 6 carácteres.'
            );
        }

        // Verify email format
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return array(
                'status' => 'BAD',
                'msg' => '¡Lo sentimos!, el correo electrónico no tiene el formato adecuado.'
            );
        }

    	$date = date("Y-m-d H:i:s");

    	$data = array(
    		'username' => $username,
    		'email' => $email,
    		'password' => encrypt_data($password),
    		'ip' => $this->input->ip_address(),
    		'date_registration' => $date,
    		'date_login' => $date
    	);

    	// Handling the UUID as identifier
        $this->db->set('id', "UNHEX(REPLACE(UUID(),'-',''))", FALSE);

        $this->db->insert('user', $data);

        // Get id
        $user_id = $this->db->insert_id();

        // Start session and store the username for future uses
    	$session_data = array(
            'id_user' => $user_id,
	        'username'  => $username,
	        'logged_in' => TRUE
		);

		$this->session->set_userdata($session_data);

        return array('status' => 'OK');
    }

    // --------------------------------------------------------------------
    
    /**
	 * Attemp of login of a user
	 *
	 * @param	string	$username	username that identify the user
	 * @param	string	$password	password of the user
	 * @return	array
	 */
    public function login($username, $password)
    {
    	$this->db->select('HEX(id) as id, password');
    	$this->db->where('username', $username);
    	$query = $this->db->get('user', 1, 0);

    	// Verify the username
    	if($query->num_rows() > 0)
    	{
    		$hash_password = $query->row()->password;
            $id_user =  $query->row()->id;

    		// Verify the password
    		if(verify_encryption($password, $hash_password))
    		{
    			// Update IP and date_login
    			$date = date("Y-m-d H:i:s");

		    	$data = array(
		    		'ip' => $this->input->ip_address(),
		    		'date_login' => $date
		    	);

		    	$this->db->where('username', $username);
		    	$this->db->update('user', $data);

		    	// Start session and store the username for future uses
		    	$session_data = array(
                    'id_user' => $id_user,
			        'username'  => $username,
			        'logged_in' => TRUE
				);

				$this->session->set_userdata($session_data);

				return array('status' => 'OK');
    		}
    		else
    		{
    			return array(
	    			'status' => 'BAD',
	    			'msg' => 'Usuario o contraseña incorrecta. Inténtalo de nuevo.'
	    		);
    		}
    	}
    	else
    	{
    		return array(
    			'status' => 'BAD',
    			'msg' => 'Usuario o contraseña incorrecta. Inténtalo de nuevo.'
    		);
    	}
    }

    // --------------------------------------------------------------------
    
    /**
	 * Logout of a user
	 *
	 * @return	array
	 */
    public function logout()
    {
    	$session_data = array('id_user', 'id_text', 'username', 'logged_in');
		$this->session->unset_userdata($session_data);
   	
    	return array('status' => 'OK');
    }
}

/* End of file User_model.php */
