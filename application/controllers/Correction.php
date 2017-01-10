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
 * CurubaGram Correction Controller
 *
 * @category	Controllers
 * @author		Juan Sebastián Beleño Díaz
 * @link		xxx
 */
class Correction extends CI_Controller {

	public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();

        // Load correction model
        $this->load->model('correction_model');
    }

	public function add()
	{
		$id_user = @$this->session->userdata('id_user');
		$id_text = @$this->session->userdata('id_text');
		$correction = $this->input->post('correction');

		$this->output
	         ->set_content_type('application/json')
	         ->set_output(json_encode($this->correction_model->add(($id_user, $id_text, $correction)));
	}

}

/* End of file Correction.php */
/* Location: ./application/controllers/Correction.php */