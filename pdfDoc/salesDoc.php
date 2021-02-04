<?php
// session_start(); 
//  if(!isset($_SESSION['username'])){
//     header("location:../../");//if the username is incorrect or the session is destroyed then return to login page/index.php
//  }
 
require "../fpdf/fpdf.php";
include '../config/Database.php';
include '../action/Product.php';


/**
* 
*/
class pdfDocument extends FPDF
{

	function header(){
       
      ///  $this->Image('../pictures/logoo.png',10,6);
      date_default_timezone_set("Africa/Dar_es_Salaam");
		$product = new Product();
		$from = $_GET['from'];
		$to = $_GET['to'];

		$this->SetFont('Arial','B',14);
		$this->Cell(266,5,"PERFECT LIQUOR",0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,$from.' - '.$to." Total Sales ".number_format($product->sumSalesInterval($from,$to)).' /=Tshs',0,0,'C');
		
		$this->Ln(20);

	}
    
   
	function footer()
	{
		# code...
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C'); 

	}
   
	function headerTable(){
		$this->SetFont('Times','B',12);
		$this->Cell(75,10,'Product',1,0,'C');
		$this->Cell(45,10,'price',1,0,'C');
		$this->Cell(40,10,'Sale Type',1,0,'C');
		$this->Cell(45,10,'Quantity',1,0,'C');
		$this->Cell(30,10,'Discount',1,0,'C');
		$this->Cell(40,10,'Total',1,0,'C');
		$this->Ln();
	}

	function SlipDetails()
	{
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $today = date("Y-m-d");
        $product = new Product();
        $from = $_GET['from'];
        $to = $_GET['to'];
        // id	user_id	product_id	qty	bulk	price	total_price	discount	recept	type	dateSaved	created_at
        foreach ($product->fetchSalesInterval($from,$to) as  $data) {
			$productData = $product->productData($data['product_id']);
			$type = ($data['type'] == 'wsale') ? 'WholeSale' : 'Retail Sale' ;
			$bulk = ($data['type'] == 'wsale') ? $productData['bulk'] : 'items' ;
            $this->SetFont('Times','',12);
            $this->Cell(75,10,$productData['name'],1,0,'L');
            $this->Cell(45,10,number_format($data['price']),1,0,'L');
            $this->Cell(40,10,$type,1,0,'L');
            $this->Cell(45,10,$data['qty'].' '.$bulk,1,0,'L');
            $this->Cell(30,10,number_format($data['discount']),1,0,'L');
            $this->Cell(40,10,number_format($data['total_price']),1,0,'L');
            
            $this->Ln();
        }
       
    }

 }
$pdf = new pdfDocument();
$pdf-> AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();

$pdf->SlipDetails();


// I: send the file inline to the browser. The PDF viewer is used if available.
// D: send to the browser and force a file download with the name given by name.
// F: save to a local file with the name given by name (may include a path).
// S: return the document as a string.


$pdf->Output(date('Y-m-y',time()).'productdoc.pdf','I');