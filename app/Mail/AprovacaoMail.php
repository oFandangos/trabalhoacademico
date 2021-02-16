<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use Uspdev\Replicado\Pessoa;

class AprovacaoMail extends Mailable
{
    use Queueable, SerializesModels;
    private $agendamento;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento)
    {   
        $this->agendamento = $agendamento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Parecer da defesa do trabalho acadêmico de {$this->agendamento->user->name}";

        return $this->view('emails.aprovacao')
        ->to(Pessoa::emailusp($this->agendamento->user->codpes))
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
        ]);    
    }
}
