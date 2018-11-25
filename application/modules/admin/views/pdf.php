<?php 
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('My Title');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');

$pdf->AddPage();

$tbl = <<<EOD
<table border="1">
<tr>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
</tr>
<tr>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
</tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->Output('My-File-Name.pdf', 'I');
?>