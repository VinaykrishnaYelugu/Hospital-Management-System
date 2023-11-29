<?php 
  require ("fpdf/fpdf.php");
  include 'connect.php';

  $values3 = explode(",",$_GET["values3"]);
  $P_id = $values3[0];
  $a_no = $values3[1];
  $P_name = " ";

  $sql = "select * from `Appointments` where A_no='$a_no';";
  $result = mysqli_query($con,$sql);
  if( $result ){
      $row = mysqli_fetch_assoc($result);
      $Ad_id = $row['Ad_id'];
      $A_date = $row['A_date'];
      $A_time = $row['A_time'];
  }

  $sql = "select * from `Patients` where P_id='$P_id';";
  $result = mysqli_query($con,$sql);
  if( $result ){
      $row = mysqli_fetch_assoc($result);
      $P_name = $row['P_name'];
      $P_age = $row['P_age'];
      $P_gender = $row['P_gender'];
  }


  $appointment_info=[
        "a_no"=>"Appointment Number  : $a_no",
       "ad_id"=>"Appointed Doctor's Id  : $Ad_id",
      "a_date"=>"Appointment Date       : $A_date",
      "a_time"=>"Appointment Time       : $A_time",
       "ap_id"=>"Patient Id             : $P_id",
      "p_name"=>"Patient Name       : $P_name",
       "p_age"=>"Patient Age          : $P_age",
       "p_gender"=>"Patient Gender    : $P_gender",

       "total_amt"=>"5200.00",
       "words"=>"Rupees Five Thousand Two Hundred Only",
  ];

  $products_info=[];
  $med_info=[];
  
$sql = "select distinct disease from `decides` where Da_no='$a_no';";
$result = mysqli_query($con,$sql);
if( $result ){
    while( $row = mysqli_fetch_assoc($result))
    {
        $products_info[]=["name"=>$row['disease']];
    }
}

$sql = "select * from `medicines` where M_code in (select dm_code from `decides` where Da_no='$a_no');";
$result = mysqli_query($con,$sql);
if( $result ){
    while( $row = mysqli_fetch_assoc($result))
    {
        $med_info[]=["med_code"=>$row['M_code'],"med_name"=>$row['M_name'],"company"=>$row['company']];
    }
}

  
  class PDF extends FPDF
  {
    function Header(){
      
      $this->SetFont('Arial','B',20);
      $this->Cell(50,10,"MANIPAL HOSPITALS",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,"                                    ~~ Life's ON ~~",0,1);
      $this->SetFont('Arial','',10);
      $this->Cell(50,7,"Bangalore-Mysore Ring Road Junction Bannimantapa 'A' Layout",0,1);
      $this->Cell(50,7,"Siddique Nagar, Mandi Mohalla, Mysuru, Karnataka 570015.",0,1);
      $this->Cell(50,7,"Contact no : 8778731770, 9786517790",0,1);
      $this->Cell(50,7,"More info : www.manipalhospitals.org ",0,1);


      $this->SetY(18);
      $this->SetX(-60);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,10,"Medical Report",1,1,"C");
      
      //Display Horizontal line
      $this->Line(0,57,210,57);
    }

    
    
    function body($appointment_info,$products_info,$med_info){
      
      //Billing Details
      $this->SetY(60);
      $this->SetX(10);
      $this->SetFont('Arial','B',14);
      $this->Cell(80,10,"APPOINTMENT DETAILS ",1,1,"C");
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$appointment_info["a_no"],0,1);
      $this->Cell(50,7,$appointment_info["ad_id"],0,1);
      $this->Cell(50,7,$appointment_info["a_date"],0,1);
      $this->Cell(50,7,$appointment_info["a_time"],0,1);
      

      
      $this->SetY(70);
      $this->SetX(-80);
      $this->Cell(55,7,$appointment_info["ap_id"],0,10);
      $this->Cell(55,7,$appointment_info["p_name"],0,10);
      $this->Cell(55,7,$appointment_info["p_age"],0,10);    
      $this->Cell(55,7,$appointment_info["p_gender"],0,10);  
      
      //Display Horizontal line
      $this->Line(0,100,210,100);

      //Display Table headings
      $this->SetY(105);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(80,10,"DESIASES / SYMPTOMS",1,1,"C");

      
      //Display table product rows

      foreach($products_info as $row){
        $this->Cell(80,9,$row["name"],0,1);
      }

      $this->Line(0,165,210,165);

      $this->SetY(170);
      $this->SetX(10);

      $this->SetFont('Arial','B',12);
      $this->Cell(80,10,"MEDICINES",1,1,"C");

      $this->SetY(185);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,5,"Medicine code",1,0);
      $this->Cell(50,5,"Medicine name",1,0);
      $this->Cell(50,5,"Medicine company",1,0);

      $this->SetY(190);
      $this->SetX(10);
      $this->SetFont('Arial','',12);
      foreach($med_info as $row){
        $this->Cell(50,5,$row["med_code"],1,0);
        $this->Cell(50,5,$row["med_name"],1,0);
        $this->Cell(50,5,$row["company"],1,1);
      }
      
    }
    function Footer(){
      
      //set footer position
      $this->SetY(-30);
      $this->SetX(70);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,10,"------------ABC HOSPITALS----------",0,1,"L");
      $this->Ln(15);


      $this->SetY(-10);
      $this->SetX(10);
      $this->SetFont('Arial','',5);
      //Display Footer Text
      $this->Cell(0,10,"This report is a computer generated ",0,1,"C");
      
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($appointment_info,$products_info,$med_info);
  $pdf->Output();
?>