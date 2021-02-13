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
		$this->Cell(276,10,$from.' - '.$to."  Retail Sales and Profit Summary Report By Date",0,0,'C');
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
		$this->Cell(85,10,'Date',1,0,'C');
        $this->Cell(40,10,'Quantity',1,0,'C');
		$this->Cell(75,10,'Total Sales (Tshs)',1,0,'C');
		$this->Cell(75,10,'Total Profit (Tshs)',1,0,'C');
		$this->Ln();
	}

	function SlipDetails()
	{
        date_default_timezone_set("Africa/Dar_es_Salaam");
        $today = date("Y-m-d");
        $product = new Product();
        $from = $_GET['from'];
        $to = $_GET['to'];

		// SELECT SUM(sales.total_price) AS salesTotal, SUM((stock.bprice / products.qty)*sales.qty) AS kutoa , SUM(sales.qty) AS quantity FROM `sales`,products,stock  WHERE sales.type = 'wsale' AND sales.product_id = products.id AND stock.product_id = products.id GROUP BY sales.dateSaved
        // id	user_id	product_id	qty	bulk	price	total_price	discount	recept	type	dateSaved	created_at
		foreach ($product->fetchSalesRetailsaleSummaryInterval($from,$to) as  $data) {
			// dateSaved	salesTotal	kutoa	quantity 	
            $profit = $data['salesTotal'] - $data['kutoa'];
            $this->SetFont('Times','',12);
            $this->Cell(85,10,$data['dateSaved'],1,0,'L');
            $this->Cell(40,10,number_format($data['quantity']),1,0,'L');
            $this->Cell(75,10,number_format($data['salesTotal']),1,0,'L');
            $this->Cell(75,10,number_format($profit),1,0,'L');
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


$pdf->Output(date('Y-m-y',time()).'retail-sales-summary-report.pdf','I');