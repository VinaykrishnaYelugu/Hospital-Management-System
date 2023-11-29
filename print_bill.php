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

  $bill_info=[];
  $totalbill_info;
  



  $sql = "select d.Dm_code as 'medicine_code',d.Da_no,m.M_name as 'medicine_name',count(d.Dm_code) as 'Quantity', sum(m.M_cost) as 'Individual Medicine cost'  from `decides` d,`medicines` m  where d.Dm_code=m.M_code and d.Da_no='$a_no' group by d.Dm_code ;";
  $result=mysqli_query($con,$sql);
   if( ($result) ){
        while( $row = mysqli_fetch_assoc($result))
        {
            $bill_info[]=["bm_code"=>$row['medicine_code'], "bm_name"=>$row['medicine_name'], "Quantity"=>$row['Quantity'], "Cost/pack"=>$row['Individual Medicine cost']];
        }
   }

   $total_cost = 0;
   $gst = 0;
   $total_bill = 0;
   $sql = "select sum(m.M_cost) as 'Total Bill'  from `decides` d,`medicines` m  where d.Dm_code=m.M_code and d.Da_no='$a_no';";
   $result = mysqli_query($con,$sql);
   if( $result ){
       $row = mysqli_fetch_assoc($result);
       $total_cost = $row['Total Bill'];
       $gst = 0.18*$total_cost;
       $total_bill = $total_cost+$gst;
   }

   $totalbill_info = [
    "total_cost"=>" Total Cost              :  $total_cost", 
           "gst"=>" GST                        :  $gst ",
    "total_bill"=>" TOTAL BILL  :  $total_bill"
    ];
  
  class PDF extends FPDF
  {
    function Header(){
      
      $this->SetFont('Arial','B',20);
      $this->Cell(50,10,"MANIPAL HOSPITALS",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,"                                      ~~ Life's ON ~~",0,1);
      $this->SetFont('Arial','',10);
      $this->Cell(50,7,"Bangalore-Mysore Ring Road Junction Bannimantapa 'A' Layout",0,1);
      $this->Cell(50,7,"Siddique Nagar, Mandi Mohalla, Mysuru, Karnataka 570015.",0,1);
      $this->Cell(50,7,"Contact no : 8778731770, 9786517790",0,1);
      $this->Cell(50,7,"More info : www.manipalhospitals.org ",0,1);

      
      $this->SetY(18);
      $this->SetX(-60);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,10,"Bill",1,1,"C");
      
      //Display Horizontal line
      $this->Line(0,57,210,57);
    }

    
    
    function body($appointment_info,$bill_info,$totalbill_info){
      
      
      $this->SetY(60);
      $this->SetX(10);
      $this->SetFont('Arial','B',14);
      $this->Cell(80,10,"APPOINTMENT DETAILS ",1,1,"C");
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$appointment_info["a_no"],0,1);
      $this->Cell(50,7,$appointment_info["ad_id"],0,1);
      $this->Cell(50,7,$appointment_info["a_date"],0,1);
      $this->Cell(50,7,$appointment_info["a_time"],0,1);
      
      
      $this->SetY(55);
      $this->SetX(-60);

      
     
      $this->SetY(70);
      $this->SetX(-80);
      $this->Cell(55,7,$appointment_info["ap_id"],0,10);
      $this->Cell(55,7,$appointment_info["p_name"],0,10);
      $this->Cell(55,7,$appointment_info["p_age"],0,10);    
      $this->Cell(55,7,$appointment_info["p_gender"],0,10);  
      
      //Display Horizontal line
      $this->Line(0,100,210,100);

      
      $this->SetY(105);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(80,10,"BILLING DETAILS",1,1,"C");

      
      //Display table product rows
      $this->SetY(120);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(45,5,"Medicine Code",1,0);
      $this->Cell(45,5,"Medicine Name",1,0);
      $this->Cell(45,5,"Quantity",1,0);
      $this->Cell(45,5,"Unit Price",1,0);

      $this->SetY(125);
      $this->SetX(10);
      $this->SetFont('Arial','',12);
      foreach($bill_info as $row){
        $this->Cell(45,5,$row["bm_code"],1,0);
        $this->Cell(45,5,$row["bm_name"],1,0);
        $this->Cell(45,5,$row["Quantity"],1,0);
        $this->Cell(45,5,$row["Cost/pack"],1,1);
      }

      $this->Line(0,210,210,210);



      $this->SetY(215);
      $this->SetX(110);
      $this->SetFont('Arial','B',12);
        $this->Cell(50,5,$totalbill_info['total_cost'],0,7);
        $this->Cell(50,5,$totalbill_info['gst'],0,7);
        $this->SetFont('Arial','B',16);
        $this->SetX(100);
        $this->Cell(80,10,$totalbill_info['total_bill'],1,1,"C");

      
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
  $pdf->body($appointment_info,$bill_info,$totalbill_info);
  $pdf->Output();
?>