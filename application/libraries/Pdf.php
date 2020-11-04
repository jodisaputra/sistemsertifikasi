<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once 'dompdf/autoload.inc.php';
// require_once 'dompdf/lib/Cpdf.php';


// use Dompdf\Dompdf;
// use Dompdf\Options;
use Dompdf\Dompdf;
use Dompdf\Options;


class Pdf extends Dompdf
{
	public function __construct()
	{
		parent::__construct();
		
	} 
}

?>