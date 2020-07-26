<?php

namespace App\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Core\View;

class AdminOrderController
{

    //@param int $id
    public function editForm (int $id)
    {
       
        // Alle dazughörigen Daten aus der Datenbank abfragen
        $order = Order::find($id);
        $user = User::find($order->user_id);
        $delivery_address = Address::find($order->delivery_address_id);
        $invoice_address = Address::find($order->invoice_address_id);
        $payment = Payment::find($order->payment_id);

        // Daten an passenden View übergeben
        View::load('admin/orderForm', [
            'order' => $order,
            'user' => $user,
            'delivery_address' => $delivery_address,
            'invoice_address' => $invoice_address,
            'payment' => $payment
        ]);
    }

    //@param int $id
    public function edit (int $id)
    {
        
        // Order aus DB abfragen
        $order = Order::find($id);

        // Order Status mit dem eingegebenen Wert aus dem Formular überschreiben
        $order->status = $_POST['status'];

        // DeliveryAddress aus der DB abfragen
        $oldDeliveryAddress = Address::find($order->delivery_address_id);

        // Falls Werte im Formular von dem aus der DB abweichen, dann soll die neue Adresse gespeichert und übergeben werden
        if ($oldDeliveryAddress->address !== $_POST['delivery_address']) {
            $deliveryAddress = new Address();
            $deliveryAddress->user_id = $order->user_id;
            $deliveryAddress->address = $_POST['delivery_address'];
            $deliveryAddress->save();
            $order->delivery_address_id = $deliveryAddress->id;
        }

        // Falls Werte im Formular von dem aus der DB abweichen, dann soll die neue InvoiceAdresse gespeichert und übergeben werden
        $oldInvoiceAddress = Address::find($order->invoice_address_id);
        if ($oldInvoiceAddress->address !== $_POST['invoice_address']) {
            $invoiceAddress = new Address();
            $invoiceAddress->user_id = $order->user_id;
            $invoiceAddress->address = $_POST['invoice_address'];
            $invoiceAddress->save();
            $order->invoice_address_id = $invoiceAddress->id;
        }

        // Neue Daten in DB speichern
        $order->save();

        // Richtig redirecten
        header('Location: ' . BASE_URL . 'dashboard');
        exit;
    }

}
