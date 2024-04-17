<?php
include 'mpdf/mpdf.php';
// require_once __DIR__ . '/vendor/autoload.php';



$html = '
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Nama</th>
                <th>Donasi</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>';

$query = query("SELECT * FROM payments
                INNER JOIN posts ON posts.id_post=payments.id_post
                INNER JOIN users ON users.id_user=payments.id_user
                WHERE payments.status_payment='approve'
                ORDER BY payments.payment_date DESC");
while ($data = mysqli_fetch_array($query)) {
    $fullname = $data['fullname'];
    $post_title = $data['post_title'];
    $amount = number_format($data['amount'], 2);
    $date = date('d-m-Y', strtotime($data['payment_date']));

    $result .= '<tr>';
    $result .= '<td>' . $post_title . '</td>';
    $result .= '<td>' . $fullname . '</td>';
    $result .= '<td>' . $amount . '</td>';
    $result .= '<td>' . $date . '</td>';
    $result .= '</tr>';
}
$html .= $result;

$html .= '</tbody>
    </table>
    ';

$mpdf = new mpdf([
    'mode' => 'utf-8',
    'orientation' => 'p',
]);

$stylesheet = file_get_contents('assets/css/custom.css');

$mpdf->SetTitle('Laporan Keuangan Donatur');
$mpdf->SetHTMLHeader('
<div id="header">
    Laporan Keuangan Donatur
</div>');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);
$mpdf->Output('LaporanKeuangan.pdf', 'I');

// $pdf = new mpdf();
// $pdf->SetHeader('header');
// $pdf->WriteHTML('Hello World');
// $pdf->SetFooter('footer');
// $pdf->Output('MyPDF.pdf', 'I');
