<?php
include('vendor/autoload.php');

use Midtrans\Config;
use Midtrans\Notification;

Config::$isProduction = false;
Config::$serverKey = 'SB-Mid-server-V6zxW1NBgvQtR26CzJmsumCM';
$notif = new Notification();
$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
echo $order_id;
