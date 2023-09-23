<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $orddata,$product,$productdata;
    //public $pdf;
    /**
     * Create a new message instance.
     */
    public function __construct($orddata,$product,$productdata)
    {
        $this->orddata = $orddata;
        $this->product = $product;
        $this->productdata = $productdata;
        //$this->pdf = $pdf;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: $this->orddata['title'],
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'mail.orderconfirm',
    //         with: $this->orddata
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [
    //         Attachment::fromData(fn () => $this->orddata['pdf']->output(), 'Report.pdf')
    //             ->withMime('application/pdf'),
    //     ];
    // }
    public function build()
    {
        $order = $this->orddata['order_id'];
        return $this->subject('Order Confirmation - '. $this->orddata['order_id'])
                    ->markdown('mail.orderconfirm');
                    //->attachData($this->pdf, 'invoice-'.$order.'.html');
    }
}
