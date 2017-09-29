<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
	        $this->call(Deportes::class);
	        $this->command->info('Tabla de deportes alimentada satisfactoriamente');
	        $this->call(Modalidades::class);
	        $this->command->info('Tabla de modalidades alimentada satisfactoriamente');
	        $this->call(Categorias::class);
	        $this->command->info('Tabla de categorias alimentada satisfactoriamente');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

class Deportes extends Seeder
{
	public function run()
	{
		DB::table('deporte')->delete();
		DB::statement('ALTER TABLE deporte AUTO_INCREMENT = 1');
		DB::table('deporte')->insert([
			['nombre' => "ACTIVIDADES SUBACUÁTICAS"],
			['nombre' => "AJEDREZ"],
			['nombre' => "ARQUERÍA"],
			['nombre' => "ATLETISMO"],
			['nombre' => "BALONCESTO"],
			['nombre' => "BEISBOL"],
			['nombre' => "BILLAR"],
			['nombre' => "BOLO"],
			['nombre' => "BOXEO"],
			['nombre' => "CANOTAJE Y REMO"],
			['nombre' => "CICLISMO"],
			['nombre' => "ECUESTRE"],
			['nombre' => "ESGRIMA"],
			['nombre' => "FÚTBOL DE SALÓN"],
			['nombre' => "FÚTBOL"],
			['nombre' => "GIMNASIA"],
			['nombre' => "JUDO"],
			['nombre' => "KARATE DO"],
			['nombre' => "LUCHA OLIMPICA"],
			['nombre' => "LEVANTAMIENTO DE PESAS"],
			['nombre' => "NATACIÓN"],
			['nombre' => "PATINAJE"],
			['nombre' => "SOFTBOL"],
			['nombre' => "SQUASH"],
			['nombre' => "TAEKWONDO"],
			['nombre' => "TEJO"],
			['nombre' => "TENIS DE MESA"],
			['nombre' => "TENIS DE CAMPO"],
			['nombre' => "TIRO DEPORTIVO"],
			['nombre' => "TRIATHLON"],
			['nombre' => "VELA"],
			['nombre' => "VOLEIBOL"],
			['nombre' => "BADMINTON"],
			['nombre' => "AUTOMOVILISMO"],
			['nombre' => "BAILE DEPORTIVO"],
			['nombre' => "BALONMANO"],
			['nombre' => "BRIDGE"],
			['nombre' => "CHAZA"],
			['nombre' => "DEPORTES AEREOS"],
			['nombre' => "DISCAPACIDAD COGNITIVA"],
			['nombre' => "DISCAPACIDAD FÍSICA"],
			['nombre' => "ESCALADA DEPORTIVA"],
			['nombre' => "ESQUI NAUTICO"],
			['nombre' => "FISICOCULTURISMO"],
			['nombre' => "FOOTBALL AMERICANO"],
			['nombre' => "GOLF"],
			['nombre' => "HAPKIDO"],
			['nombre' => "JIUJITSU"],
			['nombre' => "KARTS"],
			['nombre' => "KICK BOXING"],
			['nombre' => "LIMITACIÓN VISUAL"],
			['nombre' => "MOTOCICLISMO"],
			['nombre' => "MOTONAUTICA"],
			['nombre' => "MUAY THAI"],
			['nombre' => "MUSHING"],
			['nombre' => "ORIENTACIÓN"],
			['nombre' => "PARALISIS CEREBRAL"],
			['nombre' => "PORRAS"],
			['nombre' => "RACQUETBALL"],
			['nombre' => "RUGBY"],
			['nombre' => "SEPAK TAKRAW"],
			['nombre' => "SORDOS"],
			['nombre' => "SURF"],
			['nombre' => "ULTIMATE"],
			['nombre' => "WUSHU"],
			['nombre' => "---"],
			['nombre' => "HOCKEY SOBRE HIELO"],
			['nombre' => "SAMBO"]
		]);
	}
}

class Modalidades extends Seeder
{
	public function run()
	{
		DB::table('modalidad')->delete();
		DB::statement('ALTER TABLE modalidad AUTO_INCREMENT = 1');
		DB::table('modalidad')->insert([
			[
				'id_deporte' => '15',
				'nombre' => 'FÚTBOL 8'
			],
			[
				'id_deporte' => '14',
				'nombre' => 'BANQUITAS 3X3'
			],
			[
				'id_deporte' => '5',
				'nombre' => 'BALONCESTO 3X3'
			],
			[
				'id_deporte' => '32',
				'nombre' => 'VOLEIBOL 4X4
			']
		]);
	}
}

class Categorias extends Seeder
{
	public function run()
	{
		DB::table('categoria')->delete();
		DB::statement('ALTER TABLE categoria AUTO_INCREMENT = 1');
		DB::table('categoria')->insert([
			[
				'id_modalidad' => '1',
				'nombre' => 'Unica'
			],
			[
				'id_modalidad' => '2',
				'nombre' => 'Unica'
			],
			[
				'id_modalidad' => '3',
				'nombre' => 'Unica'
			],
			[
				'id_modalidad' => '4',
				'nombre' => 'Unica'
			]
		]);
	}
}
