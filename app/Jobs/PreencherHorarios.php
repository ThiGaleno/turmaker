<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Horario;
use App\Http\Controllers\TurmaController;
use App\Repositories\TurmaRepository;
use Illuminate\Support\Facades\Log;



class PreencherHorarios implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $id, $turmas;
    public function __construct($id, $turmas)
    {
        // $this->$turmaRepository;
        $this->id = $id;
        $this->turmas = $turmas;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TurmaRepository $turmaRepository)
    {
        $turmaRepository->preencherHorarios($this->id, $this->turmas);
    }
}
