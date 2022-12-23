<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Software::factory()->create([
            'name' => 'Aleph',
            'applicationcategory' => 'ILS',
            'description' => '',
            'maintainer' => 'ExLibris',
            'license' => 'Software proprietário',
            'url' => 'https://www.exlibrisgroup.com/products/aleph-integrated-library-system'
        ]);
        \App\Models\Software::factory()->create([
            'name' => 'Folio',
            'applicationcategory' => 'LSP',
            'description' => '',
            'maintainer' => 'EBSCO',
            'license' => 'Software livre (Apache 2 open source license)',
            'url' => 'https://www.folio.org'
        ]);
        \App\Models\Software::factory()->create([
            'name' => 'DSpace',
            'applicationcategory' => 'Repositório Institucional',
            'description' => '',
            'maintainer' => 'LYRASIS',
            'license' => 'Software livre (DSpace Source Code BSD License)',
            'url' => 'https://dspace.lyrasis.org'
        ]);
        \App\Models\Software::factory()->create([
            'name' => 'Tematres',
            'applicationcategory' => 'Vocabulário controlado',
            'description' => '',
            'maintainer' => 'Diego Ferreyra',
            'license' => 'Software livre (GPLv2)',
            'url' => 'https://github.com/tematres/TemaTres-Vocabulary-Server'
        ]);
    }
}