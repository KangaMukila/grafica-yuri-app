<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

/**
 * Semeia as configurações gerais do sistema. O nome "Gráfica Yuri" fica
 * gravado na base de dados (não no código), pelo que pode ser alterado
 * a qualquer momento em /admin/configuracoes sem precisar de deploy.
 */
class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::set('grafica_nome', 'Gráfica Yuri');
        Setting::set('grafica_telefone', '');
        Setting::set('grafica_email', '');
        Setting::set('grafica_endereco', '');
        Setting::set('grafica_logo', ''); // caminho da imagem, definido depois via upload
        Setting::set('site_publico_ativo', '1', 'boolean'); // catálogo público ativo desde a instalação
    }
}
