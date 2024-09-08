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
$patientmanger = new PatientManager($db);
$appointmentmanger = new AppointmentManager($db);
$billingmanager = new BillingManager($db);
$billingserivcemanager = new BillingServiceManager($db);
$servicemanager = new ServiceManager($db);
$billing_id = $_GET['id'];
// Get billing instance
$billing = $billingmanager->getBillingId($billing_id);
$patient_id = $billing->getBillingPatientId();
// get patient instance
$patient = $patientmanger->getPatient($patient_id);
// Get appointment instance
$appointment = $appointmentmanger->getappointmentId($billing->getBillingAppointmentId());
$servicesid = $billingserivcemanager->getServicesBilling($billing_id);
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFillColor(240, 248, 255); // AliceBlue
        $this->Rect(0, 0, 210, 40, 'F');
        $this->SetFont('Arial', 'B', 28); // Increased from 24
        $this->SetTextColor(70, 130, 180); // SteelBlue
        $this->Cell(0, 20, 'Janta Clinic', 0, 1, 'C');
        $this->SetFont('Arial', '', 14); // Increased from 12
        $this->Cell(0, 10, 'Your Health, Our Priority', 0, 1, 'C');
        $this->Ln(20);
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10); // Increased from 8
        $this->SetTextColor(105, 105, 105); // DimGray
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 15);
// Invoice details
$pdf->SetFont('Arial', 'B', 14); 
$pdf->SetTextColor(70, 130, 180); // SteelBlue
$pdf->Cell(0, 10, 'INVOICE', 0, 1, 'R');
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', '', 12); // Increased from 10
$pdf->Cell(0, 6, "Invoice No: INV-$billing_id", 0, 1, 'R');
$pdf->Cell(0, 6, 'Date: ' . "{$billing->getBillingDate()}", 0, 1, 'R');
// Biller and Client details
$pdf->SetFont('Arial', 'B', 12); // Increased from 10
$pdf->Cell(90, 6, 'Billed From:', 0, 0);
$pdf->Cell(0, 6, 'Billed To:', 0, 1);
$pdf->SetFont('Arial', '', 12); // Increased from 10
$pdf->MultiCell(90, 6, "Janta Clinic Ltd.\nJuran Chapra\nMuzaffarpur, Bihar 54321\nEmail: janta@example.com", 0, 'L');
$pdf->SetXY($pdf->GetX() + 90, $pdf->GetY() - 24);
$pdf->MultiCell(0, 6, "{$patient->getFullName()}\n{$patient->getAddress()->getStreet()}\n{$patient->getAddress()->getCity()}, {$patient->getAddress()->getState()} \n{$patient->getAddress()->getZipcode()}", 0, 'L');
$pdf->Ln(10);
// Table Header
$pdf->SetFillColor(70, 130, 180); // SteelBlue
$pdf->SetTextColor(255);
$pdf->SetDrawColor(70, 130, 180); // SteelBlue
$pdf->SetLineWidth(.3);
$pdf->SetFont('Arial', 'B', 12); // Increased from 10
$pdf->Cell(100, 8, 'Service', 1, 0, 'C', true);
$pdf->Cell(45, 8, 'Quantity', 1, 0, 'C', true);
$pdf->Cell(45, 8, 'Price', 1, 1, 'C', true);
// Table Content
$pdf->SetFillColor(240, 248, 255); // AliceBlue
$pdf->SetTextColor(0);
$pdf->SetFont('Arial', '', 12); // Increased from 10
$services = [];
foreach($servicesid as $serviceid){
    $service = $servicemanager->getServiceId($serviceid);
    $sername = $service->getServiceName();
    $serprice = $service->getServiceCharge();
    $services[] = ["$sername",1,"$serprice"];
}
$fill = false;
foreach($services as $service) {
    $pdf->Cell(100, 8, $service[0], 'LR', 0, 'L', $fill);
    $pdf->Cell(45, 8, $service[1], 'LR', 0, 'C', $fill);
    $pdf->Cell(45, 8, '' . number_format($service[2], 2), 'LR', 1, 'R', $fill);
    $fill = !$fill;
}
// Table Footer
$pdf->SetFont('Arial', 'B', 12); // Increased from 10
$pdf->Cell(145, 8, 'Total', 1, 0, 'R', true);
$pdf->Cell(45, 8, 'Rs.' . number_format("{$billing->getTotalAmount()}", 2), 1, 1, 'R', true);
// Additional Notes
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12); // Increased from 10
$pdf->Cell(0, 6, 'Notes:', 0, 1);
$pdf->SetFont('Arial', '', 12); // Increased from 10
$pdf->MultiCell(0, 6, "Thank you for choosing Janta Clinic. Please pay within 30 days. For any queries, contact our billing department.", 0, 'L');
$pdf->Output('I', 'invoice.pdf');
