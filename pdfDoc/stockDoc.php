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
       
		$this->SetFont('Arial','B',14);
		$this->Cell(266,5,"PERFECT LIQUOR",0,0,'C');
		$this->Ln();
		$this->SetFont('Times','',12);
		$this->Cell(276,10,"Product Stock Details ". date("Y-m-d"),0,0,'C');
		
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
		$this->Cell(60,10,'Quantity',1,0,'C');
		$this->Cell(30,10,'Buying Price',1,0,'C');
		$this->Cell(30,10,'Retail Price',1,0,'C');
		$this->Cell(30,10,'WholesalePrice',1,0,'C');
		$this->Cell(25,10,'W-Discount',1,0,'C');
		$this->Cell(25,10,'R-Discount',1,0,'C');
		$this->Ln();
	}

	function SlipDetails()
	{
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $today = date("Y-m-d");
        $product = new Product();
        //	id	product_id	quantity	bprice	rsale_price	wsale_price	rdiscount	wdiscount
        foreach ($product->fetchStock() as  $data) {
			$productData = $product->productData($data['product_id']);
			$bulkData = $product->bulkWithItermsDoc($data['quantity'],$productData['qty'],$data['product_id']);
            $this->SetFont('Times','',12);
            $this->Cell(75,10,$productData['name'],1,0,'L');
            $this->Cell(60,10,$bulkData,1,0,'L');
            $this->Cell(30,10,number_format($data['bprice']),1,0,'L');
            $this->Cell(30,10,number_format($data['rsale_price']),1,0,'L');
            $this->Cell(30,10,number_format($data['wsale_price']),1,0,'L');
            $this->Cell(25,10,number_format($data['wdiscount']),1,0,'L');
            $this->Cell(25,10,number_format($data['rdiscount']),1,0,'L');
            
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