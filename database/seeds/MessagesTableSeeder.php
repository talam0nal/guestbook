<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        DB::table('messages')->insert([
            'user_id' => '1',
            'parent_id' => '0',
            'text' => 'Первая пакистанская экспедиция в Антарктиду началась в январе 1991 года под эгидой Национального института океанографии (NIO). В ней приняли участие исследовательский корабль Бер Пайма и эсминец ВМФ Пакистана Tariq, на борту которых находились учёные и морские пехотинцы',
            'created_at' => Carbon::now(),
        ]);

        DB::table('messages')->insert([
            'user_id' => '2',
            'parent_id' => '1',
            'text' => 'Очень познавательно, спасибо',
            'created_at' => Carbon::now(),
        ]);

        DB::table('messages')->insert([
            'user_id' => '3',
            'parent_id' => '0',
            'text' => 'Antarctosuchus polyodon описан в 2014 году по голотипу AMNH 24411 — частичному черепу. Он найден в долине Гордон в центральной части Трансантарктических гор в нижних слоях формации Фремоу (конец нижнего или начало среднего триаса). Отложения, в которых была найдена окаменелость, включают также кости циногната, диадемодона и каннемейерид',
            'created_at' => Carbon::now(),
        ]);

        DB::table('messages')->insert([
            'user_id' => '3',
            'parent_id' => '0',
            'text' => 'Американская исполнительница Билли Айлиш (на фото) на 62-й церемонии «Грэмми» завоевала награды во всех четырёх основных номинациях',
            'created_at' => Carbon::now(),
        ]);

    }
}
