<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjectsToInsert = [
            'Governança Digital',
            'NET-ativismo',
            'Mídia Nativa',
            'Sustentabilidade Digital (ODS)',
            'Fake News e Jornalismo Autônomo',
            'Transliteracy para a Cidadania no Sec XXI',
            'Transorganicidade',
            'Regulamentação e Acesso de Dados',
            'Direitos da Cidadania Digital',
            'Arquiteturas Digitais para Cidadania',
            'Ambientes Inteligentes (smart environments)',
            'Redes Digitais e Governança Descentralizada',
            'História da Cidadania Digital',
            'Cidadania e info-consumo',
            'Games, realidade aumentada e interatividade',
        ];

        foreach ($subjectsToInsert as $subject){
            DB::table('subjects')->insert([
                    'name' => $subject,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime(),
                ]
            );
        }
    }
}
