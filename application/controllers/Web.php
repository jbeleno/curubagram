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
 * CurubaGram Web Controller
 *
 * @category	Controllers
 * @author		Juan Sebastián Beleño Díaz
 * @link		xxx
 */
class Web extends CI_Controller {

	public function index()
	{
		$data_header = array('header_title' => 'CurubaGram');
		$data_footer = array('footer_msg' => 'Icons made by Madebyoliver from www.flaticon.com');

		$this->load->view('templates/header', $data_header, FALSE);
		$this->load->view('web/index');
		$this->load->view('templates/footer', $data_footer, FALSE);
	}

	public function correction()
	{
		$this->load->model('text_model');
		$results = $this->text_model->get_random_text();

		$data_header = array('header_title' => 'Corregir ortografía | CurubaGram');
		$data = array(
			'source' => $results['text']->source,
			'content' => $results['text']->content
		);
		$data_footer = array('footer_msg' => '');

		$this->load->view('templates/header', $data_header, FALSE);
		$this->load->view('web/correction', $data, FALSE);
		$this->load->view('templates/footer', $data_footer, FALSE);	
	}

	public function login()
	{
		$data_header = array('header_title' => 'Ingresar | CurubaGram');
		$data_footer = array('footer_msg' => '');

		$this->load->view('templates/header', $data_header, FALSE);
		$this->load->view('web/login');
		$this->load->view('templates/footer', $data_footer, FALSE);	
	}

	public function text()
	{
		$data_header = array('header_title' => 'Proponer textos con errores ortográficos | CurubaGram');
		$data_footer = array('footer_msg' => '');

		$this->load->view('templates/header', $data_header, FALSE);
		$this->load->view('web/propose');
		$this->load->view('templates/footer', $data_footer, FALSE);	
	}

	public function register()
	{
		$data_header = array('header_title' => 'Registro | CurubaGram');
		$data_footer = array('footer_msg' => '');

		$this->load->view('templates/header', $data_header, FALSE);
		$this->load->view('web/register');
		$this->load->view('templates/footer', $data_footer, FALSE);	
	}

	public function logout()
	{
		$this->load->model('user_model');
		$this->user_model->logout();

		redirect('/web/index/');
	}

}

/* End of file Web.php */
/* Location: ./application/controllers/Web.php */