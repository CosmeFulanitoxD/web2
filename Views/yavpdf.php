<?php 
include 'plantilla.php';
require '../Modelos/Database.php';

$conn=mysqli_connect("127.0.0.1","admone","123","tienda");

$id = $_GET['id'];
$query="SELECT id_compra,cantidad,nombre 
FROM compra_detalle cd join productos p on cd.id_producto = p.id_producto 
WHERE id_compra = $id";
$resultado = $conn->query($query);
//echo $id;
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(20,10,'id',1,0,'C',1);
$pdf->Cell(90,10,'Producto',1,0,'C',1);
$pdf->Cell(70,10,'Cantidad',1,1,'C',1);

$pdf->SetFont('Arial','',10);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(20,10,$row['id_compra'],1,0,'C',1);
    $pdf->Cell(90,10,$row['nombre'],1,0,'C',1);
    $pdf->Cell(70,10,$row['cantidad'],1,1,'C',1);
}

$pdf->Output();

?>