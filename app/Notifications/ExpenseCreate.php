<?php

namespace App\Notifications;

use App\Models\Expenses;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExpenseCreate extends Notification
{
    use Queueable;

    private $expense;

    public function __construct(Expenses $expense)
    {
        $this->expense = $expense;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Despesa Cadastrada')
            ->markdown('emails.expense-create', ['expense' => $this->expense]);
    }
}
