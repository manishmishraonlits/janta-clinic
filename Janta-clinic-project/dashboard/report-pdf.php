<?php
require_once '../libs/fpdf/fpdf.php';
require_once '../config/config.php';
require_once '../src/Database.php';
require_once '../src/PatientManager.php';
require_once '../src/Patient.php';
require_once '../src/BillingManager.php';
require_once '../src/Billing.php';
require_once '../src/AppointmentManager.php';
require_once '../src/Appointment.php';
require_once '../src/ServiceManager.php';
require_once '../src/Service.php';
require_once '../src/BillingServiceManager.php';
$db = new Database();
$appointmentmanager = new AppointmentManager($db);
$appointmentcounttoday = $appointmentmanager->appointmentTakenToday();
$appointmentFuture = $appointmentmanager->AppointmentFuture();
$appointmentcountcompleted = $appointmentmanager->appointmentTakenCompleted();
$billingmanager = new BillingManager($db);
$billingtoday = $billingmanager->getMoneyCollectedToday();
$patienttotal = $_GET['id'];
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFillColor(41, 128, 185); // A nice blue color
        $this->Rect(0, 0, 210, 40, 'F');
        $this->SetFont('Arial', 'B', 30);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 20, 'Janta Clinic', 0, 1, 'C');
        $this->SetFont('Arial', '', 14);
        $this->Cell(0, 10, 'Daily Report', 0, 1, 'C');
        $this->Ln(10);
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
    function TableHeader()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(200, 220, 255);
        $this->Cell(80, 10, 'Description', 1, 0, 'C', true);
        $this->Cell(110, 10, 'Details', 1, 1, 'C', true);
    }
    function TableRow($desc, $details)
    {
        $this->SetFont('Arial', '', 12);
        $this->Cell(80, 10, $desc, 1);
        $this->Cell(110, 10, $details, 1, 1);
    }
}
// Create PDF object
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
// Table Header
$pdf->TableHeader();
// Today's Patients Registered
$pdf->TableRow("Today's Patients Registered", "{$patienttotal} new patient(s) registered today.");
// Today's Appointments Schedule
$pdf->TableRow("Today's Appointments Schedule", "{$appointmentcounttoday} appointments scheduled for today.");
// Today's Money Collected
$pdf->TableRow("Today's Money Collected", "Total amount collected today: Rs {$billingtoday}");
// Upcoming Appointments
$pdf->TableRow("Upcoming Appointments", "{$appointmentFuture} upcoming appointments.");
// Completed Appointments
$pdf->TableRow("Completed Appointments", "{$appointmentcountcompleted} appointments completed today.");
// Output the PDF
$pdf->Output('I', 'Janta_Clinic_Daily_Report.pdf');
