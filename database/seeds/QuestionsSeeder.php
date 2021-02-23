<?php

use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
                'id' => 1,
                'text' => '¿Qué te gustaría que agregaramos al informe?',
                'answer_type' => json_encode([
                    'type' => 'free_text'
                ])
            ],
            [
                'id' => 2,
                'text' => '¿La información es correcta?',
                'answer_type' => json_encode([
                    'type' => 'options',
                    'options' => ['Sí', 'No', 'Más o Menos']
                ])
            ],
            [
                'id' => 3,
                'text' => '¿Del 1 al 5, es rápido el sitio?',
                'answer_type' => json_encode([
                    'type' => 'options',
                    'options' => [1, 2, 3, 4, 5]
                ])
            ],
        ]);
    }
}
