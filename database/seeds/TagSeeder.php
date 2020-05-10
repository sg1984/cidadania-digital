<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagsToInsert = [
            'algoritmos',
            'cidadania digital',
            'blockchain',
            'competências do século XXI',
            'database',
            'design',
            'plataformas digitais',
            'participação cívica',
            'dispositivos móveis',
            'inclusão digital',
            'ecologia da informação',
            'big data',
            'fake news',
            'mundos possíveis',
            'e-government',
            'governança digital',
            'games',
            'green data',
            'mudanças climáticas',
            'culturas ecológicas digitais',
            'medicina de dados',
            'direito à saúde',
            'saúde digital',
            'net-ativismo',
            'cultura hacker',
            'indígena',
            'pós-cidades',
            'redes de cidadania',
            'significados',
            'teorias',
            'conceitos',
            'software',
            'regulamentação de dados',
            'acesso de dados',
            'transliteracia',
            'educação 4.0',
            'inovação educacional',
        ];

        foreach ($tagsToInsert as $tag){
            DB::table('tags')->insert([
                    'name' => $tag,
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime(),
                ]
            );
        }
    }
}
