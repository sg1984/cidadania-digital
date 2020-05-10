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
            'Algoritmos para a cidadania',
            'Blockchain para a cidadania',
            'Competencias para a cidadania do seculo XXI',
            'Database para a cidadania',
            'Design civico e plataformas digitais de participação',
            'Dispositivos moveis e inclusao digital para a cidadania',
            'Ecologia da informaçao: Big data, fake news e mundos possiveis',
            'E-governament Governanca digital',
            'Games para a cidadania',
            'Green data, mudanças climaticas e culturas ecológicas digitais',
            'Medicina de dados e direito à saude digital',
            'Net-ativismo e culturas haker',
            'Net-ativismo indigena',
            'Pós-cidades e redes de cidadanias',
            'Significados e teorias das novas formas de cidadania',
            'Software para a cidadania, regulamentaçao e acesso a dados',
            'Transliteracia para a cidadania digital',
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
