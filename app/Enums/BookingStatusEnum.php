<?php 

namespace App\Enums;

enum BookingStatusEnum:string
{
    case PendingBooking = 'pending booking';
    case BookingAccepted = 'booking accepted';
    case BookingDeclined = 'booking declined';
    case PendingPayment = 'pending payment';
    case AwaitingConfirmation = 'awaiting confirmation';
    case PaymentConfirmed = 'payment confirmed';
    case PaymentNotConfirmed = 'payment not confirmed';
}