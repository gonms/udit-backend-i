<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MiComandoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    
    protected $signature = 'app:mi-comando
        {userID : ID de usuario como argumento}
        {--user=1 : ID de usuario como opción con valor por defecto}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Descripción del comando';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /**
         * Formas de acceder a los argumentos y las opciones
         *
         * $opcion = $this->option('user');
         * $this->info('opcion pasada: ' . $opcion);
         * $argumento = $this->argument('userID');
         * $this->info('argumento pasado: ' . $argumento);
         * 
        */

        /**
         * Ask pregunta por un valor y lo almacena en una variable.
         * Como 2º parámetro se le puede pasar el valor por defecto.
         */
        $value = $this->ask('qué usuario quieres?', 1);
        $this->alert('valor pasado: ' . $value);

        /**
         * Confirm pide confirmación para continuar el código. Como 2º parámetro acepta el valor por defecto, que es false
         */
        $confirm = $this->confirm('Estás seguro de cargar los datos del usuario ' . $value . '?', true);

        if ($confirm) {
            $user = User::find($value);

            /**
             * info() muestra mensajes por la consola
             */
            $this->info('usuario: ' . $user->name);
            /**
             * Diferentes funciones para mostrar información por pantalla, en función del nivel de criticidad.
             * Cada función muestra el mensaje con unos estilos diferentes.
             * 
             * $this->warn()
             * $this->error()
             * $this->alert();
             * 
            */
        } else 
            $this->info('No has querido cargar los datos');
    }
}
