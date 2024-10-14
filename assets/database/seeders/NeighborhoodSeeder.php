<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NeighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Neighborhood::create([
            'id' => 1,
            'name' => 'Palermo Hollywood',
            'city_id' => 1,
        ]);

        Neighborhood::create([
            'id' => 2,
            'name' => 'Palermo Soho',
            'city_id' => 1,
        ]);

        Neighborhood::create([
            'id' => 3,
            'name' => 'Palermo Chico',
            'city_id' => 1,
        ]);

        Neighborhood::create([
            'id' => 4,
            'name' => 'Las Cañitas',
            'city_id' => 1,
        ]);

        Neighborhood::create([
            'id' => 5,
            'name' => 'Botánico',
            'city_id' => 1,
        ]);

        Neighborhood::create([
            'id' => 6,
            'name' => 'Barrio Parque',
            'city_id' => 1,
        ]);

        Neighborhood::create([
            'id' => 7,
            'name' => 'Palermo Nuevo',
            'city_id' => 1,
        ]);

        Neighborhood::create([
            'id' => 8,
            'name' => 'Palermo Viejo',
            'city_id' => 1,
        ]);

        //Belgrano

        Neighborhood::create([
            'id' => 9,
            'name' => 'Belgrano R',
            'city_id' => 2,
        ]);

        Neighborhood::create([
            'id' => 10,
            'name' => 'Belgrano C',
            'city_id' => 2,
        ]);

        Neighborhood::create([
            'id' => 11,
            'name' => 'Belgrano Chico',
            'city_id' => 2,
        ]);

        Neighborhood::create([
            'id' => 12,
            'name' => 'Barrio Chino',
            'city_id' => 2,
        ]);

        Neighborhood::create([
            'id' => 13,
            'name' => 'Barrio Parque General Belgrano',
            'city_id' => 2,
        ]);


        //Caballito

        Neighborhood::create([
            'id' => 14,
            'name' => 'Caballito Norte',
            'city_id' => 3,
        ]);

        Neighborhood::create([
            'id' => 15,
            'name' => 'Caballito Sur',
            'city_id' => 3,
        ]);

        Neighborhood::create([
            'id' => 16,
            'name' => 'Cid Campeador',
            'city_id' => 3,
        ]);

        Neighborhood::create([
            'id' => 17,
            'name' => 'Parque Rivadavia',
            'city_id' => 3,
        ]);

        Neighborhood::create([
            'id' => 18,
            'name' => 'Primera Junta',
            'city_id' => 3,
        ]);

        //Almagro

        Neighborhood::create([
            'id' => 19,
            'name' => 'Almagro Norte',
            'city_id' => 8,
        ]);

        Neighborhood::create([
            'id' => 20,
            'name' => 'Almagro Sur',
            'city_id' => 8,
        ]);


            //Flores

        Neighborhood::create([
            'id' => 21,
            'name' => 'Flores Norte',
            'city_id' => 20,
        ]);

        Neighborhood::create([
            'id' => 22,
            'name' => 'Flores Sur',
            'city_id' => 20,
        ]);

        //Floresta

        Neighborhood::create([
            'id' => 23,
            'name' => 'Floresta Norte',
            'city_id' => 21,
        ]);

        Neighborhood::create([
            'id' => 24,
            'name' => 'Floresta Sur',
            'city_id' => 21,
        ]);

        //Mataderos

        Neighborhood::create([
            'id' => 25,
            'name' => 'Naón',
            'city_id' => 25,
        ]);

        Neighborhood::create([
            'id' => 26,
            'name' => 'Los Perales',
            'city_id' => 25,
        ]);

        //Nuñez


        Neighborhood::create([
            'id' => 27,
            'name' => 'Lomas de Nuñez',
            'city_id' => 28,
        ]);


        //Retiro


        Neighborhood::create([
            'id' => 28,
            'name' => 'Puerto Retiro',
            'city_id' => 37,
        ]);


    //Tigre

        Neighborhood::create([
            'id' => 29,
            'name' => 'Nordelta',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 30,
            'name' => 'Villanueva',
            'city_id' => 58,
        ]);


        Neighborhood::create([
            'id' => 31,
            'name' => 'Tigre Centro',
            'city_id' => 58,
        ]);


        Neighborhood::create([
            'id' => 32,
            'name' => 'General Pacheco',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 33,
            'name' => 'Rincon del milberg',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 34,
            'name' => 'Altos de Del Viso',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 35,
            'name' => 'Benavidez',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 36,
            'name' => 'Delta',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 37,
            'name' => 'Dique Luján',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 38,
            'name' => 'Distrito Tigre Sur',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 39,
            'name' => 'Don Torcuato',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 40,
            'name' => 'El Talar',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 41,
            'name' => 'Green Oak',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 42,
            'name' => 'Lomas de Benavidez',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 43,
            'name' => 'Puertos del Lago Marinas',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 44,
            'name' => 'Puertas del Lago Vistas',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 45,
            'name' => 'Ricardo Rojas',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 46,
            'name' => 'Rincon',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 47,
            'name' => 'San Joaquín',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 48,
            'name' => 'Santa Bárbara',
            'city_id' => 58,
        ]);

        Neighborhood::create([
            'id' => 49,
            'name' => 'Troncos del Talar',
            'city_id' => 58,
        ]);

        //Pilar

        Neighborhood::create([
            'id' => 50,
            'name' => 'Pilar del Este',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 51,
            'name' => 'Pilar Centro',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 52,
            'name' => 'Manuel Alberti',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 53,
            'name' => 'Villa Rosa',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 54,
            'name' => 'Del Viso',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 55,
            'name' => '46 Plaza',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 56,
            'name' => 'Agosto',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 57,
            'name' => 'Alto del Molino',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 58,
            'name' => 'Altos de Campo Grande',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 59,
            'name' => 'Altos de Morra',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 60,
            'name' => 'Altos de Tortuga',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 61,
            'name' => 'Altos del Golf',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 62,
            'name' => 'Altos del Golf Aranjuez',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 63,
            'name' => 'Altos del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 64,
            'name' => 'Altos del Trebolar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 65,
            'name' => 'Apart del Pinazo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 66,
            'name' => 'Araucarias',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 67,
            'name' => 'Arcos del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 68,
            'name' => 'Altos del Trebolar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 69,
            'name' => 'Apart del Pinazo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 70,
            'name' => 'Araucarias',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 71,
            'name' => 'Arcos del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 72,
            'name' => 'Armenia',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 73,
            'name' => 'Aromas de Saraví',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 74,
            'name' => 'Aston Village',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 75,
            'name' => 'Atlético Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 76,
            'name' => 'Augusta',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 77,
            'name' => 'Ayres del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 78,
            'name' => 'Ayres Plaza',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 79,
            'name' => 'Ayres Vila',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 80,
            'name' => 'Barrio Abierto Cañada Plaza',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 81,
            'name' => 'Barrio Cerrado Casuarinas de Guido',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 82,
            'name' => 'Barrio Cerrado Nuevo Zelaya',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 83,
            'name' => 'Barrio Nuevo Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 84,
            'name' => 'Barrio Parque Almirante Irizar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 85,
            'name' => 'Barrio Parque Amancay',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 86,
            'name' => 'Barrio Parque del Viso',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 87,
            'name' => 'Ricardo Rojas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 88,
            'name' => 'Barrio San Antonio',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 89,
            'name' => 'Bermudas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 90,
            'name' => 'Bosque Alto',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 91,
            'name' => 'Bosque Chico',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 92,
            'name' => 'Boulevard del Sol',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 93,
            'name' => 'Boulevares',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 94,
            'name' => 'Bouquet',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 95,
            'name' => 'Brujas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 96,
            'name' => 'Buen Retiro',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 97,
            'name' => 'California Village',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 98,
            'name' => 'Campo Argentino de Golf',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 99,
            'name' => 'Campo Chico',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 100,
            'name' => 'Campo Grande',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 101,
            'name' => 'Campus Vista',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 102,
            'name' => 'Carmel',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 103,
            'name' => 'Casablanca',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 104,
            'name' => 'Casas del Alto',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 105,
            'name' => 'Casas del Bosque',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 106,
            'name' => 'Casas del Parque',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 107,
            'name' => 'Casas del Prado',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 108,
            'name' => 'Chacras del ocho',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 109,
            'name' => 'Chacras del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 110,
            'name' => 'Club Bamboo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 111,
            'name' => 'Club de Campo Larena - Los Quinchos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 112,
            'name' => 'Cocowok',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 113,
            'name' => 'Concord Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 114,
            'name' => 'Condominio Pilaris',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 115,
            'name' => 'Country Club El Jagüel',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 116,
            'name' => 'CUBA Fátima',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 117,
            'name' => 'Cumbre de Rosas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 118,
            'name' => 'De Las Quintas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 119,
            'name' => 'de Vicenzo C.C.',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 120,
            'name' => 'Derqui',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 121,
            'name' => 'Ecoaldea',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 122,
            'name' => 'El Alazán',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 123,
            'name' => 'El Barranco',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 124,
            'name' => 'El Boulevard',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 125,
            'name' => 'El Castro',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 126,
            'name' => 'El Establo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 127,
            'name' => 'El Estribo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 128,
            'name' => 'El Hornero',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 129,
            'name' => 'El jagüel (Pilar)',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 130,
            'name' => 'El Lucero',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 131,
            'name' => 'El Mirasol',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 132,
            'name' => 'El Molino',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 133,
            'name' => 'El Patacón',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 134,
            'name' => 'El Portillo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 135,
            'name' => 'El Recodo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 136,
            'name' => 'El Rincon de la Retama',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 137,
            'name' => 'El Silencio',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 138,
            'name' => 'El Tejar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 139,
            'name' => 'El Zorzal',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 140,
            'name' => 'Estancia La Casualidad',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 141,
            'name' => 'Estancia San Miguel',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 142,
            'name' => 'Farm Club',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 143,
            'name' => 'Farm House',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 144,
            'name' => 'Freixas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 145,
            'name' => 'Fátima',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 146,
            'name' => 'Galápagos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 147,
            'name' => 'Green Park',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 148,
            'name' => 'Green Soul',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 149,
            'name' => 'Green Village',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 150,
            'name' => 'Guido',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 151,
            'name' => 'Habitat Residencias',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 152,
            'name' => 'Haras del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 153,
            'name' => 'Hi 42.5',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 154,
            'name' => 'Jardines de Saraví',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 155,
            'name' => 'La Aguada',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 156,
            'name' => 'La Agustina',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 157,
            'name' => 'La Angelica',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 158,
            'name' => 'La Arboleda',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 159,
            'name' => 'La Buena Vista',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 160,
            'name' => 'La Caballeriza',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 161,
            'name' => 'La Campiña',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 162,
            'name' => 'La Carmela',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 163,
            'name' => 'La Cascada',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 164,
            'name' => 'La Casualidad',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 165,
            'name' => 'La Cautiva de Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 166,
            'name' => 'La Cañada de Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 167,
            'name' => 'La Chacra',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 168,
            'name' => 'La Cuesta',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 169,
            'name' => 'La Delfina',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 170,
            'name' => 'La Emilia',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 171,
            'name' => 'La Escondida (Pilar)',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 172,
            'name' => 'La Esperanza',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 173,
            'name' => 'La Herradura',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 174,
            'name' => 'La Isla',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 175,
            'name' => 'La Legua',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 176,
            'name' => 'La Lomada',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 177,
            'name' => 'La Lomita',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 178,
            'name' => 'La Lonja',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 179,
            'name' => 'La Martinica',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 180,
            'name' => 'La Masía',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 181,
            'name' => 'La Matilda',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 182,
            'name' => 'La Merecida',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 183,
            'name' => 'La Montura',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 184,
            'name' => 'La Nativa',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 185,
            'name' => 'La Nazarena',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 186,
            'name' => 'La Paz y El Rec (Est de Pilar)',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 187,
            'name' => 'La Peregrina',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 188,
            'name' => 'La Pilarica',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 189,
            'name' => 'La Pradera',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 190,
            'name' => 'La Pradera II',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 191,
            'name' => 'La Quadra',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 192,
            'name' => 'La Ranita',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 193,
            'name' => 'La Retama',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 194,
            'name' => 'La Rinconada',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 195,
            'name' => 'La Rivera',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 196,
            'name' => 'La Tapera',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 197,
            'name' => 'La Tranquera',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 198,
            'name' => 'Lago de Manzanares',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 199,
            'name' => 'Larena',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 200,
            'name' => 'Las Acacias',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 201,
            'name' => 'Las Araucarias',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 202,
            'name' => 'Los Beatrices',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 203,
            'name' => 'Las Bresias',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 204,
            'name' => 'Las Brisas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 205,
            'name' => 'Las Calas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 206,
            'name' => 'Las Campanillas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 207,
            'name' => 'Las Cañitas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 208,
            'name' => 'Las Condes',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 209,
            'name' => 'Las Liebres',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 210,
            'name' => 'Las Marías Club de Polo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 211,
            'name' => 'Las Orquídeas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 212,
            'name' => 'Las Pircas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 213,
            'name' => 'Las Recovas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 214,
            'name' => 'Las Secoyas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 215,
            'name' => 'Liquidambar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 216,
            'name' => 'Little Ranch',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 217,
            'name' => 'Lomas de Fátima',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 218,
            'name' => 'Lomas de Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 219,
            'name' => 'Los Alamos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 220,
            'name' => 'Los Alcanfores',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 221,
            'name' => 'Los Boulevares',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 222,
            'name' => 'Los Cachorros',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 223,
            'name' => 'Los Cerrillos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 224,
            'name' => 'Los Cuatro Ombúes',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 225,
            'name' => 'Los Eucaliptos(Pilar)',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 226,
            'name' => 'Los Fresnos (Pilar)',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 227,
            'name' => 'Los Geranios',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 228,
            'name' => 'Los Girasoles',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 229,
            'name' => 'Los Jazmines',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 230,
            'name' => 'Los lagartos Country Club',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 231,
            'name' => 'Los Laureles',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 232,
            'name' => 'Los Leños',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 233,
            'name' => 'Los Montes - Pueblo Cardón',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 234,
            'name' => 'Los Palenques',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 235,
            'name' => 'Los Pilares',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 236,
            'name' => 'Los Pinos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 237,
            'name' => 'Los Potrillos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 238,
            'name' => 'Los Quinchos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 239,
            'name' => 'Los Sauces',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 240,
            'name' => 'Los Senderos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 241,
            'name' => 'Los Tacos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 242,
            'name' => 'Los Tres Coniles',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 243,
            'name' => 'Los Troncos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 244,
            'name' => 'Luis Lagomarsino',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 245,
            'name' => 'Manzanares',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 246,
            'name' => 'Manzanares Chico',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 247,
            'name' => 'Manzone',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 248,
            'name' => 'Mapuche',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 249,
            'name' => 'Maquinaval',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 250,
            'name' => 'Maquinista Savio',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 251,
            'name' => 'Martindale',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 252,
            'name' => 'Matices',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 253,
            'name' => 'Mayling',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 254,
            'name' => 'Metro Champagnat Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 255,
            'name' => 'Molino Blanca',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 256,
            'name' => 'Montecarlo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 257,
            'name' => 'Nano',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 258,
            'name' => 'North Ville',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 259,
            'name' => 'Office Park Norte',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 260,
            'name' => 'Palmas del Sol',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 261,
            'name' => 'Papiros',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 262,
            'name' => 'Parque Industrial',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 263,
            'name' => 'Parque Peró',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 264,
            'name' => 'Pebbel Beach',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 265,
            'name' => 'Pellegrini Village',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 266,
            'name' => 'Petrel Village',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 267,
            'name' => 'Pevero',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 268,
            'name' => 'Pilar del Lago',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 269,
            'name' => 'Pilar Garden',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 270,
            'name' => 'Pilar Golf',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 271,
            'name' => 'Pilar Green Park',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 272,
            'name' => 'Pilar Joven',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 273,
            'name' => 'Pilar Nuevo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 274,
            'name' => 'Pilar Plaza',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 275,
            'name' => 'Pilar Privado',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 276,
            'name' => 'Pilar Village',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 277,
            'name' => 'Pilara',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 278,
            'name' => 'Pinares',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 279,
            'name' => 'Premium Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 280,
            'name' => 'Princess',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 281,
            'name' => 'Pueblo Caamaño',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 282,
            'name' => 'Pueyrredón',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 283,
            'name' => 'Retiro del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 284,
            'name' => 'Rincón de Los Alerces',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 285,
            'name' => 'Rincón de de Los Alerces',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 286,
            'name' => 'Rincón de Los Alerces',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 287,
            'name' => 'Rincón de Morra II',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 288,
            'name' => 'Rincón de Morra III',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 289,
            'name' => 'Rincón de Morra IV',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 290,
            'name' => 'Rincón de Morra V',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 291,
            'name' => 'Roble Joven',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 292,
            'name' => 'Robles del Monarca',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 293,
            'name' => 'S.H.A.',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 294,
            'name' => 'San Francisco (Pilar)',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 295,
            'name' => 'San Gerónimo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 296,
            'name' => 'San Javier - Los Cerrillos',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 297,
            'name' => 'San Joaquín',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 298,
            'name' => 'San José de los Talas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 299,
            'name' => 'San Pablo',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 300,
            'name' => 'Santa Catalina C.C.',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 301,
            'name' => 'Santa María del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 302,
            'name' => 'Santa Rosa',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 303,
            'name' => 'Santa Silvina',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 304,
            'name' => 'Santa Teresa',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 305,
            'name' => 'Santo Tomás',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 306,
            'name' => 'Saravi Village ',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 307,
            'name' => 'Sausalito',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 308,
            'name' => 'Segundas Colinas',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 309,
            'name' => 'Senderos 1',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 310,
            'name' => 'Senderos 2',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 311,
            'name' => 'Sociedad Hebraica',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 312,
            'name' => 'Solares del Norte',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 313,
            'name' => 'Solares del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 314,
            'name' => 'Sociedad Hebraica',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 315,
            'name' => 'Solares del Norte',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 316,
            'name' => 'Solares del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 317,
            'name' => 'Soles del Pilar',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 318,
            'name' => 'Sonnen Landvilla',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 319,
            'name' => 'Springdale',
            'city_id' => 59,
        ]);


        Neighborhood::create([
            'id' => 320,
            'name' => 'St. Matthew`s',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 321,
            'name' => 'Stradivarius',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 322,
            'name' => 'Taxoudium',
            'city_id' => 59,
        ]);


        Neighborhood::create([
            'id' => 323,
            'name' => 'Terrazas de Ayres',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 324,
            'name' => 'Terrazas de Morra',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 325,
            'name' => 'Terrazas del Lago',
            'city_id' => 59,
        ]);


        Neighborhood::create([
            'id' => 326,
            'name' => 'Tortugas Chico',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 327,
            'name' => 'Tortugas Garden',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 328,
            'name' => 'Tortugas I y II',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 329,
            'name' => 'Tortugas III (Quinta la Jimena Barrio Cerrado)',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 330,
            'name' => 'Uka-Land',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 331,
            'name' => 'Villa Astolfi',
            'city_id' => 59,
        ]);


        Neighborhood::create([
            'id' => 332,
            'name' => 'Villa del Lago',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 333,
            'name' => 'Village Country Club',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 334,
            'name' => 'Village Golf & Tennis',
            'city_id' => 59,
        ]);


        Neighborhood::create([
            'id' => 335,
            'name' => 'Vohe',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 336,
            'name' => 'Windsor Park',
            'city_id' => 59,
        ]);

        Neighborhood::create([
            'id' => 337,
            'name' => 'Xolares',
            'city_id' => 59,
        ]);


        Neighborhood::create([
            'id' => 338,
            'name' => 'Zelaya',
            'city_id' => 59,
        ]);


        //Escobar



        Neighborhood::create([
            'id' => 339,
            'name' => 'Puertos',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 340,
            'name' => 'El Cantón',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 341,
            'name' => 'Loma Verde',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 342,
            'name' => 'San Matías',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 343,
            'name' => 'Ingeniero Maschwitz',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 344,
            'name' => 'Acacias Blancas',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 345,
            'name' => 'Alamo Alto',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 346,
            'name' => 'Altavista',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 347,
            'name' => 'Altos de Matheu',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 348,
            'name' => 'Altos Don Segundo',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 349,
            'name' => 'Amarras de Escobar',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 350,
            'name' => 'Aranjuez',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 351,
            'name' => 'Aranzazu',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 352,
            'name' => 'Barrio 24 de Febrero',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 353,
            'name' => 'Barrio Parque Matheu',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 354,
            'name' => 'Barrio Privado el Ensueño',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 355,
            'name' => 'Belén de Escobar',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 356,
            'name' => 'Benavidez Greens',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 357,
            'name' => 'Chacras del Cazador',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 358,
            'name' => 'El Cantón',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 359,
            'name' => 'Civis Tortuguitas',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 360,
            'name' => 'Club Manuel Belgrano',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 361,
            'name' => 'Club Privado Loma Verde',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 362,
            'name' => 'Cube',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 363,
            'name' => 'El Aike',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 364,
            'name' => 'El Aromo',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 365,
            'name' => 'El Cazador',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 366,
            'name' => 'El Cazal',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 367,
            'name' => 'El Naudir',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 368,
            'name' => 'El Nogal',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 369,
            'name' => 'El Pequeño Aromo',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 370,
            'name' => 'El Recodo',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 371,
            'name' => 'Fincas de Maschwitz',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 372,
            'name' => 'Fincas del Lago',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 373,
            'name' => 'Garín',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 374,
            'name' => 'Haras Santa María',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 375,
            'name' => 'Jardines de Escobar',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 376,
            'name' => 'Jardín Náutico Escobar',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 377,
            'name' => 'La Aldea',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 378,
            'name' => 'La Arboleda',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 379,
            'name' => 'La Barra Village',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 380,
            'name' => 'La Candelaria',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 381,
            'name' => 'La Pista',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 382,
            'name' => 'Las Brisas',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 383,
            'name' => 'Las Magnolias',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 384,
            'name' => 'Los Angeles Village',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 385,
            'name' => 'Los Aromos',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 386,
            'name' => 'Los Caracoles',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 387,
            'name' => 'Los Horneros',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 388,
            'name' => 'Los Naranjos',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 389,
            'name' => 'Los Nogales',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 390,
            'name' => 'Los Robles de Maschwitz',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 391,
            'name' => 'Maquinista Savio',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 392,
            'name' => 'Marinas Maschwitz',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 393,
            'name' => 'Maschwitz Country Club',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 394,
            'name' => 'Maschwitz Privado',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 395,
            'name' => 'Maschwitz Village',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 396,
            'name' => 'Matheu',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 397,
            'name' => 'Miraflores',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 398,
            'name' => 'Náutico Escobar',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 399,
            'name' => 'Palmer`s Cottage',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 400,
            'name' => 'Parque Altavista',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 401,
            'name' => 'Pigeón Club',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 402,
            'name' => 'Puerto Paraná',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 403,
            'name' => 'Punta Parana',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 404,
            'name' => 'Rincón de Maschwitz',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 405,
            'name' => 'River Oak`s',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 406,
            'name' => 'Riviera Park',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 407,
            'name' => 'San Andres',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 408,
            'name' => 'San Carlos',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 409,
            'name' => 'San Lucas Village',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 410,
            'name' => 'San Matías Altos de Maschwitz',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 411,
            'name' => 'Santa Isabél',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 412,
            'name' => 'Santa María Club de Campo',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 413,
            'name' => 'Septiembre',
            'city_id' => 60,
        ]);


        Neighborhood::create([
            'id' => 414,
            'name' => 'Villa Olivos',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 415,
            'name' => 'Weekend',
            'city_id' => 60,
        ]);

        Neighborhood::create([
            'id' => 416,
            'name' => 'Ynca Huasi',
            'city_id' => 60,
        ]);

        //Vicente Lopez

        Neighborhood::create([
            'id' => 417,
            'name' => 'Olivos',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 418,
            'name' => 'Florida',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 419,
            'name' => 'Vicente López',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 420,
            'name' => 'Munro',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 421,
            'name' => 'La Lucila',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 422,
            'name' => 'Carapachay',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 423,
            'name' => 'Florida Oeste',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 424,
            'name' => 'Horizons',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 425,
            'name' => 'Lomas de Florida',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 426,
            'name' => 'Solares de Olivos',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 427,
            'name' => 'Talar de Florida',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 428,
            'name' => 'Villa Adelina',
            'city_id' => 61,
        ]);

        Neighborhood::create([
            'id' => 429,
            'name' => 'Villa Martelli',
            'city_id' => 61,
        ]);

        //San Isidro

        Neighborhood::create([
            'id' => 430,
            'name' => 'Martínez',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 431,
            'name' => 'San Isidro Centro',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 432,
            'name' => 'Béccar',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 433,
            'name' => 'Acassuso',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 434,
            'name' => 'Boulogne Sur Mer',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 435,
            'name' => 'Altos de la Merced',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 436,
            'name' => 'Amancay (Santa Rita)',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 437,
            'name' => 'Arboris Laslomas',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 438,
            'name' => 'Ayres Chico',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 439,
            'name' => 'Ayres de San Isidro',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 440,
            'name' => 'Barrancas al Río',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 441,
            'name' => 'Barrancas de San Isidro',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 442,
            'name' => 'Barrio Cerrado Las Marías',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 443,
            'name' => 'Beccar Central',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 444,
            'name' => 'Beccar Plaza',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 445,
            'name' => 'Boating',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 446,
            'name' => 'Carlos Tejedor',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 447,
            'name' => 'Casa del Puerto',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 448,
            'name' => 'Casas de la Ribera',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 449,
            'name' => 'Claridad',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 450,
            'name' => 'El Portal',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 451,
            'name' => 'El Solar de San Isidro',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 452,
            'name' => 'El Talar de Martínez',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 453,
            'name' => 'Espacio Lomas',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 454,
            'name' => 'Gascón y beiró',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 455,
            'name' => 'GreenLands',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 456,
            'name' => 'Haras de Alvear',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 457,
            'name' => 'Horqueta Chica',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 458,
            'name' => 'Jardines Beccar',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 459,
            'name' => 'Jardines de San Isidro',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 460,
            'name' => 'Jockey Chico',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 461,
            'name' => 'La Alameda 2',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 462,
            'name' => 'La Arbolada',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 463,
            'name' => 'La Candelaria (San Isidro)',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 464,
            'name' => 'La Claridad',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 465,
            'name' => 'La Embajada',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 466,
            'name' => 'La Esquina',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 467,
            'name' => 'La Fábrica (martinez)',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 468,
            'name' => 'La Horqueta',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 469,
            'name' => 'La Loma ',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 470,
            'name' => 'La Merced',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 471,
            'name' => 'La Mercet',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 472,
            'name' => 'La Mercet Golf',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 473,
            'name' => 'La Posta',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 474,
            'name' => 'La Rotonda',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 475,
            'name' => 'Las Brujas',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 476,
            'name' => 'Las Casas Village',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 477,
            'name' => 'Las Casuarinas',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 478,
            'name' => 'Las Lomas Village',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 479,
            'name' => 'Las Terrazas',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 480,
            'name' => 'Lomas Golf',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 481,
            'name' => 'Los Aromos',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 482,
            'name' => 'Los Cipreses',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 483,
            'name' => 'Los Eucaliptus (San Isidro)',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 484,
            'name' => 'Los Faroles ',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 485,
            'name' => 'Los Patricios',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 486,
            'name' => 'Los Robles (San Isidro)',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 487,
            'name' => 'Barrio Cerrado Las Marías',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 488,
            'name' => 'Los Tilos',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 489,
            'name' => 'Nuevas Casuarinas',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 490,
            'name' => 'Obras Sanitarias',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 491,
            'name' => 'Pasionaria',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 492,
            'name' => 'Punta Chica',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 493,
            'name' => 'Quartier Lomas de la Horqueta',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 494,
            'name' => 'Quince Robles',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 495,
            'name' => 'Quinta de Atalaya',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 496,
            'name' => 'San Benito (La Horqueta)',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 497,
            'name' => 'San Isidro Catedral',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 498,
            'name' => 'San Isidro Central',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 499,
            'name' => 'San Isidro Joven',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 500,
            'name' => 'San Isidro Loft',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 501,
            'name' => 'San Isidro Loft',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 502,
            'name' => 'San Isidro Plaza',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 503,
            'name' => 'San José',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 504,
            'name' => 'San Juan (San Isidro)',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 505,
            'name' => 'Santa Clara (San Isidro)',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 506,
            'name' => 'Santa Paula (Boulogne)',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 507,
            'name' => 'Santa Rita',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 508,
            'name' => 'Solares de San Isidro',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 509,
            'name' => 'Terrazas del Sol',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 510,
            'name' => 'Torres de Beccar',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 511,
            'name' => 'Villa Adelina',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 512,
            'name' => 'Village Las Lomas',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 513,
            'name' => 'Virasoro Village',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 514,
            'name' => 'Barrio Cerrado Las Marías',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 515,
            'name' => 'Washington',
            'city_id' => 62,
        ]);

        Neighborhood::create([
            'id' => 516,
            'name' => 'Árboris La Horqueta',
            'city_id' => 62,
        ]);


        //Campana

        Neighborhood::create([
            'id' => 517,
            'name' => 'Campana',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 518,
            'name' => 'La Reserva Cardales',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 519,
            'name' => 'Alto Los Cardales',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 520,
            'name' => 'El Campo - Fincas Exclusivas Cardales',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 521,
            'name' => 'Los Cardenales Country Club',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 522,
            'name' => 'Barrio Parque Las Lomadas',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 523,
            'name' => 'Barrio Parque Natura',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 524,
            'name' => 'Cardales Village',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 525,
            'name' => 'Cardenales Village',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 526,
            'name' => 'Carpinchos de Otamendi',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 527,
            'name' => 'Chacras de la Reserva Barrio Privado',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 528,
            'name' => 'Chacra El Chaja',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 529,
            'name' => 'Cinco Esquinas',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 530,
            'name' => 'Colonia de Chacras Barrio',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 531,
            'name' => 'Colonia de Chacras de Río Luján',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 532,
            'name' => 'El Bosque',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 533,
            'name' => 'El Cardal',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 534,
            'name' => 'El Jagüel del Monte',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 535,
            'name' => 'El Morejón',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 536,
            'name' => 'Las Calandrias',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 537,
            'name' => 'Las Colinas de Otamendi',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 538,
            'name' => 'Las Praderas',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 539,
            'name' => 'Lomas del Río Lujan',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 540,
            'name' => 'Los Cardales',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 541,
            'name' => 'Matisse Barrio Privado',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 542,
            'name' => 'Monet Barrio Privado',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 543,
            'name' => 'Monte Verde',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 544,
            'name' => 'Puerto Palmas',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 545,
            'name' => 'Reserva Barrio Privado',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 546,
            'name' => 'Río Luján',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 547,
            'name' => 'San Jacinto',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 548,
            'name' => 'San Jorge',
            'city_id' => 63,
        ]);

        Neighborhood::create([
            'id' => 549,
            'name' => 'Santa Brigida',
            'city_id' => 63,
        ]);

       //Exaltación de la Cruz

       Neighborhood::create([
            'id' => 550,
            'name' => 'Los Cardales',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 551,
            'name' => 'Capilla del Señor',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 552,
            'name' => 'Parada Robles',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 553,
            'name' => 'Barrio Parque Sakura',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 554,
            'name' => 'El Remanso',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 555,
            'name' => 'Arroyo de La Cruz',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 556,
            'name' => 'Barrio Parque La Verdad',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 557,
            'name' => 'Carlos Lemee',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 558,
            'name' => 'Cañada Chica',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 559,
            'name' => 'Chacras de la Cruz',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 560,
            'name' => 'Chacras de Martín Fierro',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 561,
            'name' => 'Chacras del Molino',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 562,
            'name' => 'Chenaut',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 563,
            'name' => 'Comarca del Sol',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 564,
            'name' => 'Diego Gaynor',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 565,
            'name' => 'El Solar de Capilla',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 566,
            'name' => 'El Zorzal',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 567,
            'name' => 'Etchegoyen',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 568,
            'name' => 'Gobernador Andonaegui',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 569,
            'name' => 'Haras el Malacate',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 570,
            'name' => 'Indio Cuá Golf Club',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 571,
            'name' => 'La Amanecida',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 572,
            'name' => 'La Arbolada de Capilla',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 573,
            'name' => 'La Codorniz',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 574,
            'name' => 'La Macarena',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 575,
            'name' => 'Las Lilas',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 576,
            'name' => 'Las Vizcachas',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 577,
            'name' => 'Los Pinos',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 578,
            'name' => 'Molino Blanco',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 579,
            'name' => 'Parada La Lata- La Loma',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 580,
            'name' => 'Parada Orlando',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 581,
            'name' => 'Parque Exaltación',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 582,
            'name' => 'Parque Jularó',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 583,
            'name' => 'Pavón',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 584,
            'name' => 'Pinares Country Club',
            'city_id' => 64,
        ]);

        Neighborhood::create([
            'id' => 585,
            'name' => 'San Joaquín',
            'city_id' => 64,
        ]);

        //General San Martin

        Neighborhood::create([
            'id' => 586,
            'name' => 'Villa Ballester',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 587,
            'name' => 'José León Suárez',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 588,
            'name' => 'San Martín Centro',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 589,
            'name' => 'Villa Ballester',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 590,
            'name' => 'José León Suárez',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 591,
            'name' => 'San Martín Centro',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 592,
            'name' => 'San Andrés',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 593,
            'name' => 'Villa Lynch',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 594,
            'name' => 'Barrio Parque General San Martín',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 595,
            'name' => 'Billinghurst',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 596,
            'name' => 'Ciudad Del Libertador',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 597,
            'name' => 'Loma Hermosa',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 598,
            'name' => 'Villa Chacabuco',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 599,
            'name' => 'Villa Coronel Zapiola',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 600,
            'name' => 'Villa General Las Heras',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 601,
            'name' => 'Villa General Necochea',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 602,
            'name' => 'Villa General Sucre',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 603,
            'name' => 'Villa General Tomas Guido',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 604,
            'name' => 'Villa Godoy Cruz',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 605,
            'name' => 'Villa Granaderos de San Martín',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 606,
            'name' => 'Villa Gregoria Matorras',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 607,
            'name' => 'Villa Libertad',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 608,
            'name' => 'Villa Maipu',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 609,
            'name' => 'Villa Marques de Aguado',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 610,
            'name' => 'Villa Monteagudo',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 611,
            'name' => 'Villa Parque F Alcorta',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 612,
            'name' => 'Villa Parque San Lorenzo',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 613,
            'name' => 'Villa Puerreydon',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 614,
            'name' => 'Villa Remedios de Escalada',
            'city_id' => 65,
        ]);

        Neighborhood::create([
            'id' => 615,
            'name' => 'Villa Yapeyu',
            'city_id' => 65,
        ]);

        //Jose C Paz

        Neighborhood::create([
            'id' => 616,
            'name' => 'Josè C Paz Centro',
            'city_id' => 66,
        ]);

        Neighborhood::create([
            'id' => 617,
            'name' => 'Tortuguitas',
            'city_id' => 66,
        ]);

        Neighborhood::create([
            'id' => 618,
            'name' => 'Barrio Parque Peró',
            'city_id' => 66,
        ]);

        Neighborhood::create([
            'id' => 619,
            'name' => 'Del Viso',
            'city_id' => 66,
        ]);


        //Malvinas Argentinas


        Neighborhood::create([
            'id' => 620,
            'name' => 'Tortuguitas',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 621,
            'name' => 'Los Polvorines',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 622,
            'name' => 'Área de Promoción EL Triángulo',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 623,
            'name' => 'San Jorge Village',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 624,
            'name' => 'Ingeniero Pablo Nogués',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 625,
            'name' => 'Argentino Golf Club',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 626,
            'name' => 'Barrio Parque Peró',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 627,
            'name' => 'CUBA',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 628,
            'name' => 'Cuba Country Villa de Mayo',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 629,
            'name' => 'El Florido Barrio Parque',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 630,
            'name' => 'El Recodo',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 631,
            'name' => 'Grand Bourg',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 632,
            'name' => 'Ingeniero Adolfo Sordeaux',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 633,
            'name' => 'Las Beatrices',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 634,
            'name' => 'Las Magnolias',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 635,
            'name' => 'Los Abedules I',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 636,
            'name' => 'Los Abedules II',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 637,
            'name' => 'Los Olivares',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 638,
            'name' => 'Malvinas Argentinas Centro',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 639,
            'name' => 'San Carlos Country Club',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 640,
            'name' => 'Santa María de los Olivos',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 641,
            'name' => 'San Carlos Country Club',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 642,
            'name' => 'Santa Marría de los Olivos',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 643,
            'name' => 'Tierras Altas',
            'city_id' => 67,
        ]);

        Neighborhood::create([
            'id' => 644,
            'name' => 'Villa de Mayo',
            'city_id' => 67,
        ]);


        // San Fernando

        Neighborhood::create([
            'id' => 645,
            'name' => 'San Fernando Centro',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 646,
            'name' => 'Victoria',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 647,
            'name' => 'Punta Chica',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 648,
            'name' => 'Virreyes',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 649,
            'name' => 'Buena Vista',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 650,
            'name' => 'Altos de San Fernando',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 651,
            'name' => 'Bahía del Sol',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 652,
            'name' => 'Barrancas de Victoria',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 653,
            'name' => 'Barrio Cerrado Marina Canestrari',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 654,
            'name' => 'Barrio Parque El Talar',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 655,
            'name' => 'Buen Puerto',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 656,
            'name' => 'Complejo Habitacional San Fernando',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 657,
            'name' => 'Duplex del Sol',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 658,
            'name' => 'El Trebol',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 659,
            'name' => 'Infico',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 660,
            'name' => 'Islas',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 661,
            'name' => 'La Damasia',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 662,
            'name' => 'Los Fresnos de San Fernando',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 663,
            'name' => 'Los Sauces',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 664,
            'name' => 'Marina del Norte',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 665,
            'name' => 'Marinas del Sol',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 666,
            'name' => 'Palmas del Paraná',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 667,
            'name' => 'Rincón del Arca',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 668,
            'name' => 'Santa Clara (San Fernando)',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 669,
            'name' => 'Tres Horquetas',
            'city_id' => 68,
        ]);

        Neighborhood::create([
            'id' => 670,
            'name' => 'Windbells',
            'city_id' => 68,
        ]);


        //San Miguel

        Neighborhood::create([
            'id' => 671,
            'name' => 'San Miguel Centro',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 672,
            'name' => 'Bella Vista',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 673,
            'name' => 'Buenos Aires Village',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 674,
            'name' => 'Santa María',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 675,
            'name' => 'Altos de San José',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 676,
            'name' => 'Campo de Mayo',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 677,
            'name' => 'Chacra Alcalá',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 678,
            'name' => 'Country Ranch',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 679,
            'name' => 'El Cortijo',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 680,
            'name' => 'El Lago',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 681,
            'name' => 'El Pato Verde',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 682,
            'name' => 'La Pradera de San Ignacio',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 683,
            'name' => 'Los Berros',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 684,
            'name' => 'Los Fresnos (San Miguel)',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 685,
            'name' => 'Los Plátanos',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 686,
            'name' => 'Portal del Sol',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 687,
            'name' => 'Pradera de San Ignacio',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 688,
            'name' => 'San Ambrosio',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 689,
            'name' => 'San Miguel de Ghiso',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 690,
            'name' => 'San Miguel Oeste',
            'city_id' => 69,
        ]);

        Neighborhood::create([
            'id' => 691,
            'name' => 'Villa Victoria',
            'city_id' => 69,
        ]);

        //Zárate

        Neighborhood::create([
            'id' => 692,
            'name' => 'Zárate Centro',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 693,
            'name' => 'Lima',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 694,
            'name' => 'Chacras del Paraná',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 695,
            'name' => ' Nuevo Zárate',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 696,
            'name' => 'Escalada',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 697,
            'name' => 'Barrio Saavedra',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 698,
            'name' => 'Chacras de Olivia',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 699,
            'name' => 'Country Club el Casco',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 700,
            'name' => 'El Aduar',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 701,
            'name' => 'El Casco',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 702,
            'name' => 'Estancia Las Palmas',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 703,
            'name' => 'Estancia Smithfield',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 704,
            'name' => 'Las Achiras',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 705,
            'name' => 'Las Nazarenas',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 706,
            'name' => 'Paraná',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 707,
            'name' => 'Puerto Panal',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 708,
            'name' => 'Santiago de Baradero',
            'city_id' => 70,
        ]);

        Neighborhood::create([
            'id' => 709,
            'name' => 'Smithfield',
            'city_id' => 70,
        ]);


        //La Plata

        Neighborhood::create([
            'id' => 710,
            'name' => 'La Plata Centro',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 711,
            'name' => 'City Bell',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 712,
            'name' => 'Manuel B Gonnet',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 713,
            'name' => 'Villa Elisa',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 714,
            'name' => 'Los Hornos ',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 715,
            'name' => 'Abasto',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 716,
            'name' => 'Altos de San Lorenzo',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 717,
            'name' => 'Arturo Seguí',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 718,
            'name' => 'Villa Elvira',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 719,
            'name' => 'Ringuelet',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 720,
            'name' => 'Tolosa',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 721,
            'name' => 'San Carlos',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 722,
            'name' => 'Etcheverry',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 723,
            'name' => 'Gorina',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 724,
            'name' => 'José Hernandez',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 725,
            'name' => 'Lisandro Olmos',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 726,
            'name' => 'Villa Garibaldi',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 727,
            'name' => 'Villa Parque Sicardi',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 728,
            'name' => 'El Peligro',
            'city_id' => 71,
        ]);

        Neighborhood::create([
            'id' => 729,
            'name' => 'Ignacio Correas',
            'city_id' => 71,
        ]);


        //Lomas de Zamora

        Neighborhood::create([
            'id' => 730,
            'name' => 'Lomas de Zamora Centro',
            'city_id' => 72,
        ]);

        Neighborhood::create([
            'id' => 731,
            'name' => 'Banfield',
            'city_id' => 72,
        ]);

        Neighborhood::create([
            'id' => 732,
            'name' => 'Temperley',
            'city_id' => 72,
        ]);

        Neighborhood::create([
            'id' => 733,
            'name' => 'Llavallol',
            'city_id' => 72,
        ]);

        Neighborhood::create([
            'id' => 734,
            'name' => 'Turdera',
            'city_id' => 72,
        ]);

        Neighborhood::create([
            'id' => 735,
            'name' => 'San José',
            'city_id' => 72,
        ]);

        Neighborhood::create([
            'id' => 736,
            'name' => 'Villa Albertina',
            'city_id' => 72,
        ]);

        Neighborhood::create([
            'id' => 737,
            'name' => 'Villa Centenario',
            'city_id' => 72,
        ]);

        Neighborhood::create([
            'id' => 738,
            'name' => 'Villa Fiorito',
            'city_id' => 72,
        ]);

        //Lanus

        Neighborhood::create([
            'id' => 739,
            'name' => 'Lanús Oeste',
            'city_id' => 73,
        ]);

        Neighborhood::create([
            'id' => 740,
            'name' => 'Lanús Este',
            'city_id' => 73,
        ]);

        Neighborhood::create([
            'id' => 741,
            'name' => 'Remedios de Escalada',
            'city_id' => 73,
        ]);

        Neighborhood::create([
            'id' => 742,
            'name' => 'Valentín Alsina',
            'city_id' => 73,
        ]);

        Neighborhood::create([
            'id' => 743,
            'name' => 'Lanús Centro',
            'city_id' => 73,
        ]);

        Neighborhood::create([
            'id' => 744,
            'name' => 'Gerli',
            'city_id' => 73,
        ]);

        Neighborhood::create([
            'id' => 745,
            'name' => 'Monte Chingolo',
            'city_id' => 73,
        ]);

        //Quilmes

        Neighborhood::create([
            'id' => 746,
            'name' => 'Quilmes Centro ',
            'city_id' => 74,
        ]);

        Neighborhood::create([
            'id' => 747,
            'name' => 'Quilmes Oeste',
            'city_id' => 74,
        ]);

        Neighborhood::create([
            'id' => 748,
            'name' => 'Bernal Este',
            'city_id' => 74,
        ]);

        Neighborhood::create([
            'id' => 749,
            'name' => 'Bernal Oeste',
            'city_id' => 74,
        ]);

        Neighborhood::create([
            'id' => 750,
            'name' => 'Don Bosco',
            'city_id' => 74,
        ]);

        Neighborhood::create([
            'id' => 751,
            'name' => 'Ezpeleta',
            'city_id' => 74,
        ]);

        Neighborhood::create([
            'id' => 752,
            'name' => 'San Francisco Solano',
            'city_id' => 74,
        ]);

        Neighborhood::create([
            'id' => 753,
            'name' => 'Villa la Florida',
            'city_id' => 74,
        ]);


        //Avellaneda

        Neighborhood::create([
            'id' => 755,
            'name' => 'Wilde',
            'city_id' => 77,
        ]);

        Neighborhood::create([
            'id' => 756,
            'name' => 'Avellaneda Centro',
            'city_id' => 77,
        ]);

        Neighborhood::create([
            'id' => 757,
            'name' => 'Sarandi',
            'city_id' => 77,
        ]);

        Neighborhood::create([
            'id' => 758,
            'name' => 'Dock Sud',
            'city_id' => 77,
        ]);

        Neighborhood::create([
            'id' => 759,
            'name' => 'Villa Dominico',
            'city_id' => 77,
        ]);

        Neighborhood::create([
            'id' => 760,
            'name' => 'Crucecita',
            'city_id' => 77,
        ]);

        Neighborhood::create([
            'id' => 761,
            'name' => 'Gerli',
            'city_id' => 77,
        ]);

        Neighborhood::create([
            'id' => 762,
            'name' => 'Piñeyro',
            'city_id' => 77,
        ]);



        //Almirante Brown

        Neighborhood::create([
            'id' => 763,
            'name' => 'Adrogue',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 764,
            'name' => 'Burzaco',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 765,
            'name' => 'Longchamps',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 766,
            'name' => 'José Mármol',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 767,
            'name' => 'Glew',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 768,
            'name' => 'Claypole',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 769,
            'name' => 'Don Orione',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 770,
            'name' => 'Malvinas Argentinas',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 771,
            'name' => 'Ministro Rivadavia',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 772,
            'name' => 'Rafael Calzada',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 773,
            'name' => 'San Francisco Solano',
            'city_id' => 76,
        ]);

        Neighborhood::create([
            'id' => 774,
            'name' => 'San José',
            'city_id' => 76,
        ]);


        //Berazategui



        Neighborhood::create([
            'id' => 775,
            'name' => 'Berazategui Centro',
            'city_id' => 78,
        ]);

        Neighborhood::create([
            'id' => 776,
            'name' => 'Berazategui Oeste',
            'city_id' => 78,
        ]);

        Neighborhood::create([
            'id' => 777,
            'name' => 'Sourigues Centro',
            'city_id' => 78,
        ]);

        Neighborhood::create([
            'id' => 778,
            'name' => 'Platanos Centro',
            'city_id' => 78,
        ]);

        Neighborhood::create([
            'id' => 779,
            'name' => 'Barrio Maritimo Centro',
            'city_id' => 78,
        ]);

        Neighborhood::create([
            'id' => 780,
            'name' => 'Guillermo Hudson Centro',
            'city_id' => 78,
        ]);

        Neighborhood::create([
            'id' => 781,
            'name' => 'Juan Maria Gutierrez Centro',
            'city_id' => 78,
        ]);

        Neighborhood::create([
            'id' => 782,
            'name' => 'Pereyra',
            'city_id' => 78,
        ]);

        Neighborhood::create([
            'id' => 783,
            'name' => 'El Pato',
            'city_id' => 78,
        ]);

        Neighborhood::create([
            'id' => 784,
            'name' => 'Ranelagh Centro',
            'city_id' => 78,
        ]);

        //Berisso

        Neighborhood::create([
            'id' => 785,
            'name' => 'Berisso Centro',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 786,
            'name' => 'Los Talas ',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 787,
            'name' => 'Villa Argüello',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 788,
            'name' => 'La Balandra',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 789,
            'name' => 'Barrio Banco Provincia',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 790,
            'name' => 'Barrio El Carmen Este',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 791,
            'name' => 'Barrio El Carmen Oeste',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 792,
            'name' => 'Barrio Obrero',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 793,
            'name' => 'Barrio Universitario',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 794,
            'name' => 'Juan B Justo',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 795,
            'name' => 'Los Catorce',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 796,
            'name' => 'Palo Blanco',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 797,
            'name' => 'Villa Banco Constructor',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 798,
            'name' => 'Villa Dolores',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 799,
            'name' => 'Villa España',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 800,
            'name' => 'Villa Banco Constructor',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 801,
            'name' => 'Villa Dolores',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 802,
            'name' => 'Villa España',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 803,
            'name' => 'Villa Independencia',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 804,
            'name' => 'Villa Nueva',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 805,
            'name' => 'Villa Porteña',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 806,
            'name' => 'Villa Progreso',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 807,
            'name' => 'Villa San Carlos',
            'city_id' => 79,
        ]);

        Neighborhood::create([
            'id' => 808,
            'name' => 'Villa Zula',
            'city_id' => 79,
        ]);

        //Ezeiza

        Neighborhood::create([
            'id' => 809,
            'name' => 'Canning',
            'city_id' => 75,
        ]);

        Neighborhood::create([
            'id' => 810,
            'name' => 'Ezeiza Centro',
            'city_id' => 75,
        ]);

        Neighborhood::create([
            'id' => 811,
            'name' => 'La Unión',
            'city_id' => 75,
        ]);

        Neighborhood::create([
            'id' => 812,
            'name' => 'Tristán Suárez',
            'city_id' => 75,
        ]);

        Neighborhood::create([
            'id' => 813,
            'name' => 'Carlos Spegazzini',
            'city_id' => 75,
        ]);

        Neighborhood::create([
            'id' => 814,
            'name' => 'Aluen',
            'city_id' => 75,
        ]);

        Neighborhood::create([
            'id' => 815,
            'name' => 'La Deseada',
            'city_id' => 75,
        ]);

        Neighborhood::create([
            'id' => 816,
            'name' => 'Estancia Villa María',
            'city_id' => 75,
        ]);

        Neighborhood::create([
            'id' => 817,
            'name' => 'Vicente Melazzi',
            'city_id' => 75,
        ]);

       //Cañuelas

       Neighborhood::create([
            'id' => 818,
            'name' => 'Cañuelas Centro',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 819,
         'name' => 'Máximo Paz',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 820,
            'name' => 'Alejandro Petíon',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 821,
            'name' => 'Uribalarrea',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 822,
            'name' => 'La Taquara',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 823,
            'name' => 'Altos del Carmen',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 824,
            'name' => 'Campos de Cañuelas',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 825,
            'name' => 'Chacras de Cañuelas',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 826,
            'name' => 'Chacras de la Trinidad',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 827,
            'name' => 'Chacras de Uribelarrea',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 828,
            'name' => 'Club de Chacras de Chaparral',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 829,
            'name' => 'El Maitén',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 830,
            'name' => 'El Matejón',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 831,
            'name' => 'El Palomar',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 832,
            'name' => 'El Taladro',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 833,
            'name' => 'Gobernador Udaondo',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 834,
            'name' => 'La Casona',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 835,
            'name' => 'La Cupla',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 836,
            'name' => 'La Federala',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 837,
            'name' => 'La Martona',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 838,
            'name' => 'Las Cañuelas',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 839,
            'name' => 'Santa Rosa',
            'city_id' => 80,
        ]);

        Neighborhood::create([
            'id' => 840,
            'name' => 'Vicente Casares',
            'city_id' => 80,
        ]);

        //Ensenada

        Neighborhood::create([
            'id' => 841,
            'name' => 'Ensenada Centro',
            'city_id' => 81,
        ]);

        Neighborhood::create([
            'id' => 842,
            'name' => 'Punta Lara',
            'city_id' => 81,
        ]);

        Neighborhood::create([
            'id' => 843,
            'name' => 'Dique 1',
            'city_id' => 81,
        ]);

        Neighborhood::create([
            'id' => 844,
            'name' => 'Isla Santiago',
            'city_id' => 81,
        ]);

        Neighborhood::create([
            'id' => 845,
            'name' => 'Villa Catella',
            'city_id' => 81,
        ]);

        Neighborhood::create([
            'id' => 846,
            'name' => 'Haras Punta Lara',
            'city_id' => 81,
        ]);

        //Esteban Echeverría

        Neighborhood::create([
            'id' => 847,
            'name' => 'MonteGrande',
            'city_id' => 82,
        ]);

        Neighborhood::create([
            'id' => 848,
            'name' => 'Canning',
            'city_id' => 82,
        ]);

        Neighborhood::create([
            'id' => 849,
            'name' => 'Luis Guillón',
            'city_id' => 82,
        ]);

        Neighborhood::create([
            'id' => 850,
            'name' => '9 de abril',
            'city_id' => 82,
        ]);

        Neighborhood::create([
            'id' => 851,
            'name' => 'El Jagüel',
            'city_id' => 82,
        ]);

        Neighborhood::create([
            'id' => 852,
            'name' => 'Vicente Casares',
            'city_id' => 82,
        ]);



        //Florencio Varela

        Neighborhood::create([
            'id' => 853,
            'name' => 'Florencio Varela Centro',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 854,
            'name' => 'Bosques',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 855,
            'name' => 'Ingeniero Juan Allan',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 856,
            'name' => 'La Capilla',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 857,
            'name' => 'Villa Vatteone',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 858,
            'name' => 'Chacabuco',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 859,
            'name' => 'El Molino',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 860,
            'name' => 'Gobernador Julio A Costa',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 861,
            'name' => 'Ing Ardigó',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 862,
            'name' => 'La Pepsi',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 863,
            'name' => 'San Nicolas',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 864,
            'name' => 'Villa Brown',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 865,
            'name' => 'Villa San Luis',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 866,
            'name' => 'Villa Santa Rosa',
            'city_id' => 83,
        ]);

        Neighborhood::create([
            'id' => 867,
            'name' => 'Zeballos',
            'city_id' => 83,
        ]);

        //Presidente Peron

        Neighborhood::create([
            'id' => 868,
            'name' => 'Guernica',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 869,
            'name' => 'San Eliseo',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 870,
            'name' => 'El Rebenque',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 871,
            'name' => 'La Alameda',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 872,
            'name' => 'El Paraíso',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 873,
            'name' => '2 de abril',
            'city_id' => 84,
        ]);


        Neighborhood::create([
            'id' => 874,
            'name' => 'America Unida',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 875,
            'name' => 'Country & Club San Cirano',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 876,
            'name' => 'Lagos de San Eliseo',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 877,
            'name' => 'Malibú',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 878,
            'name' => 'Parque Industrial Presidente Peron',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 879,
            'name' => 'Santo Domingo',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 880,
            'name' => 'Tiempos de Canning',
            'city_id' => 84,
        ]);

        Neighborhood::create([
            'id' => 881,
            'name' => 'Villa Numancia',
            'city_id' => 84,
        ]);

       //San Vicente

        Neighborhood::create([
            'id' => 882,
            'name' => 'San Vicente Centro',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' =>883,
            'name' => 'Fincas de San Vicente',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 884,
            'name' => 'El Lauquen',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 885,
            'name' => 'Alejandro Korn',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 886,
            'name' => 'Santa Clara al Sur',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 887,
            'name' => 'Bosque de San Vicente',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 888,
            'name' => 'Campo Daromy',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 889,
            'name' => 'Chacras Urbanas II',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 890,
            'name' => 'Club de Campo El Candil',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 891,
            'name' => 'Cruz del Sur',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 892,
            'name' => 'Domselaar',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 893,
            'name' => 'Laguna del Sauce',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 894,
            'name' => 'O.H.A Macabi',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 895,
            'name' => 'Principado Ciudad Náutica',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 896,
            'name' => 'San Lucas',
            'city_id' => 85,
        ]);

        Neighborhood::create([
            'id' => 897,
            'name' => 'San Vicente Golf',
            'city_id' => 85,
        ]);

        //Rosario

        Neighborhood::create([
            'id' => 898,
            'name' => 'Distrito Centro',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 899,
            'name' => 'Abasto',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 900,
            'name' => 'Martin',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 901,
            'name' => 'Echesortu',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 902,
            'name' => 'Pichincha',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 903,
            'name' => 'Aguadas Barrio Privado',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 904,
            'name' => 'Alberdi',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 905,
            'name' => 'Arroyito',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 906,
            'name' => 'Azcuénaga',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 907,
            'name' => 'Belgrano',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 908,
            'name' => 'Bella Vista',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 909,
            'name' => 'Del Parque',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 910,
            'name' => 'Distrito Noroeste',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 911,
            'name' => 'Distrito Norte',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 912,
            'name' => 'Distrito Oeste',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 913,
            'name' => 'Distrito Sudoeste',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 914,
            'name' => 'Distrito Sur',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 915,
            'name' => 'Empalme Graneros',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 916,
            'name' => 'España y Hospitales',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 917,
            'name' => 'F.O.N.A.V.I',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 918,
            'name' => 'Fisherton',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 919,
            'name' => 'Godoy',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 920,
            'name' => 'Jorge Cura',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 921,
            'name' => 'La Florida',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 922,
            'name' => 'La Siberia',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 923,
            'name' => 'La Tablada',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 924,
            'name' => 'Las Delicias',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 925,
            'name' => 'Las Flores',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 926,
            'name' => 'Las Heras',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 927,
            'name' => 'Lisandro de la Torre',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 928,
            'name' => 'Ludueña',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 929,
            'name' => 'Moderno',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 930,
            'name' => 'Parque Casado',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 931,
            'name' => 'Parque Field',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 932,
            'name' => 'Puerto Norte',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 933,
            'name' => 'Refinerías',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 934,
            'name' => 'República de la Sexta',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 935,
            'name' => 'Roque Sáenz Peña',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 936,
            'name' => 'Rucci',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 937,
            'name' => 'Saladillo',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 938,
            'name' => 'Sarmiento',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 939,
            'name' => 'Sorrento',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 940,
            'name' => 'Tiro Suizo',
            'city_id' => 86,
        ]);

        Neighborhood::create([
            'id' => 941,
            'name' => 'Triángulo',
            'city_id' => 86,
        ]);

        //Santa Fe

        Neighborhood::create([
            'id' => 942,
            'name' => 'Distrito Centro',
            'city_id' => 87,
        ]);

        Neighborhood::create([
            'id' => 943,
            'name' => 'Distrito Suroeste',
            'city_id' => 87,
        ]);

        Neighborhood::create([
            'id' => 944,
            'name' => 'Distrito Norte',
            'city_id' => 87,
        ]);

        Neighborhood::create([
            'id' => 945,
            'name' => 'Distrito Este',
            'city_id' => 87,
        ]);

        Neighborhood::create([
            'id' => 946,
            'name' => 'Distrito Noroeste',
            'city_id' => 87,
        ]);

        Neighborhood::create([
            'id' => 947,
            'name' => 'Distrito La Costa',
            'city_id' => 87,
        ]);

        Neighborhood::create([
            'id' => 948,
            'name' => 'Distrito Oeste',
            'city_id' => 87,
        ]);

        Neighborhood::create([
            'id' => 949,
            'name' => 'La Tatenguita',
            'city_id' => 87,
        ]);

        //Funes

        Neighborhood::create([
            'id' => 950,
            'name' => 'Zona 9',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 951,
            'name' => 'Zona 10',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 952,
            'name' => 'Zona 3',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 953,
            'name' => 'Zona 15',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 955,
            'name' => 'Zona 8',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 956,
            'name' => 'Vida',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 957,
            'name' => 'Zona 1',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 958,
            'name' => 'Zona 11',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 959,
            'name' => 'Zona 12',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 960,
            'name' => 'Zona 13',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 961,
            'name' => 'Zona 14',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 962,
            'name' => 'Zona 16',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 963,
            'name' => 'Zona 2',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 964,
            'name' => 'Zona 4',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 965,
            'name' => 'Zona 5',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 966,
            'name' => 'Zona 6',
            'city_id' => 88,
        ]);

        Neighborhood::create([
            'id' => 967,
            'name' => 'Zona 7',
            'city_id' => 88,
        ]);

        //Roldán

        Neighborhood::create([
            'id' => 968,
            'name' => 'Puerto Roldán',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 969,
            'name' => 'Tierra de Sueños III',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 970,
            'name' => 'Las Acequias',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 971,
            'name' => 'Acequias del Aire',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 972,
            'name' => 'El Molino',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 973,
            'name' => 'Alto Residencial',
            'city_id' => 89,
        ]);


        Neighborhood::create([
            'id' => 974,
            'name' => 'Alto Verde',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 975,
            'name' => 'Altos de Pellegrini',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 976,
            'name' => 'Altos del Este',
            'city_id' => 89,
        ]);


        Neighborhood::create([
            'id' => 977,
            'name' => 'América',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 978,
            'name' => 'Arrabal',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 979,
            'name' => 'Barrio Cerrado Aires de Campo',
            'city_id' => 89,
        ]);


        Neighborhood::create([
            'id' => 980,
            'name' => 'Beaudrix',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 981,
            'name' => 'Bosque Azul',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 982,
            'name' => 'Broff',
            'city_id' => 89,
        ]);


        Neighborhood::create([
            'id' => 983,
            'name' => 'Capra',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 984,
            'name' => 'Chacra Los Raigales',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 985,
            'name' => 'Cotitos R',
            'city_id' => 89,
        ]);


        Neighborhood::create([
            'id' => 986,
            'name' => 'Cotos de la Alameda',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 987,
            'name' => 'Cotos de Unanhue',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 988,
            'name' => 'Don Quijote',
            'city_id' => 89,
        ]);


        Neighborhood::create([
            'id' => 989,
            'name' => 'El Charquito',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 990,
            'name' => 'El Cielo',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 991,
            'name' => 'El Cruce',
            'city_id' => 89,
        ]);


        Neighborhood::create([
            'id' => 992,
            'name' => 'El Descanso',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 993,
            'name' => 'El Edén',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 994,
            'name' => 'El Troncal',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 995,
            'name' => 'Fontanet',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 996,
            'name' => 'Haras Viejo Tombo',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 997,
            'name' => 'La Estancia II',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 998,
            'name' => 'Las Estacas',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 999,
            'name' => 'La Estacas 1',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1000,
            'name' => 'Las Palmeras',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1001,
            'name' => 'Las Tardes',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1002,
            'name' => 'Los Aromos',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1003,
            'name' => 'Los Cedros',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1004,
            'name' => 'Los Indios',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1005,
            'name' => 'Los Olmos',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1006,
            'name' => 'Los Rosales',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1007,
            'name' => 'Marcos Ateca',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1008,
            'name' => 'María Esther',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1009,
            'name' => 'Mazzoni de B.',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1010,
            'name' => 'Maíz',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1011,
            'name' => 'Mi Sosiego',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1012,
            'name' => 'Muradore',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1013,
            'name' => 'Nadine',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1014,
            'name' => 'Parque Esmeralda',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1015,
            'name' => 'Plan Federal',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1016,
            'name' => 'Posta 16',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1017,
            'name' => 'Prados del Sol',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1018,
            'name' => 'Prosperty Lands',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1019,
            'name' => 'Pucará Los Búhos',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1020,
            'name' => 'Punta Chacra',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1021,
            'name' => 'Punta Chacra 2',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1022,
            'name' => 'San Andrés',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1023,
            'name' => 'San Eduardo I',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1024,
            'name' => 'San Javier',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1025,
            'name' => 'Santa Teresa',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1026,
            'name' => 'Santo Domingo',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1027,
            'name' => 'Talleres',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1028,
            'name' => 'Tierra de Sueños',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1029,
            'name' => 'Tierra de Sueños I',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1030,
            'name' => 'Tierra de Sueños II',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1031,
            'name' => 'Travattore Giandoménico',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1032,
            'name' => 'Tu Lugar',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1033,
            'name' => 'Villa Alda',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1034,
            'name' => 'Villa Alicia',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1035,
            'name' => 'Villa Celina',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1036,
            'name' => 'Villa Flores',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1037,
            'name' => 'Villa Lourdes I',
            'city_id' => 89,
        ]);

        Neighborhood::create([
            'id' => 1038,
            'name' => 'Villa Lourdes II ',
            'city_id' => 89,
        ]);

        //Granadero Baigorria

        Neighborhood::create([
            'id' => 1039,
            'name' => 'Granadero Baigorria ',
            'city_id' => 90,
        ]);

        //9 de Julio

        Neighborhood::create([
            'id' => 1040,
            'name' => '9 de Julio ',
            'city_id' => 91,
        ]);

        //Aarón Castellanos

        Neighborhood::create([
            'id' => 1041,
            'name' => 'Aarón Castellanos ',
            'city_id' => 92
            ,
        ]);

        //Acebal

        Neighborhood::create([
            'id' => 1042,
            'name' => 'Acebal ',
            'city_id' => 93,
        ]);

        //Aguará Grande

        Neighborhood::create([
            'id' => 1043,
            'name' => 'Aguará Grande ',
            'city_id' => 94,
        ]);

        //Albarellos

        Neighborhood::create([
            'id' => 1044,
            'name' => 'Albarellos ',
            'city_id' => 95,
        ]);

        //Alcorta

        Neighborhood::create([
            'id' => 1045,
            'name' => 'Alcorta ',
            'city_id' => 96,
        ]);

        //Aldao

        Neighborhood::create([
            'id' => 1046,
            'name' => 'Aldao ',
            'city_id' => 97,
        ]);

        //Alejandra

        Neighborhood::create([
            'id' => 1047,
            'name' => 'Alejandra ',
            'city_id' => 98,
        ]);

        //Alto Verde

        Neighborhood::create([
            'id' => 1048,
            'name' => 'Alto Verde ',
            'city_id' => 99,
        ]);

        //Altos Del Sauce

        Neighborhood::create([
            'id' => 1049,
            'name' => 'Altos del Sauce ',
            'city_id' => 100,
        ]);

        //Alvear

        Neighborhood::create([
            'id' => 1050,
            'name' => 'Alvear ',
            'city_id' => 101,
        ]);

        //Ambrosetti

        Neighborhood::create([
            'id' => 1051  ,
            'name' => 'Ambrosetti ',
            'city_id' => 102,
        ]);

        //Amenábar

        Neighborhood::create([
            'id' => 1052,
            'name' => 'Amenábar ',
            'city_id' => 103,
        ]);

        //Angeloni

        Neighborhood::create([
            'id' => 1053,
            'name' => 'Angeloni ',
            'city_id' =>104,
        ]);

        //Angélica

        Neighborhood::create([
            'id' => 1054,
            'name' => 'Angélica ',
            'city_id' => 105,
        ]);

        //Arequito

        Neighborhood::create([
            'id' => 1055,
            'name' => 'Arequito ',
            'city_id' => 106,
        ]);

        //Arminda

        Neighborhood::create([
            'id' => 1056,
            'name' => 'Arminda ',
            'city_id' => 107,
        ]);

        //Armstrong

        Neighborhood::create([
            'id' => 1057,
            'name' => 'Armstrong ',
            'city_id' => 108,
        ]);

        //Arocena

        Neighborhood::create([
            'id' => 1058,
            'name' => 'Arocena ',
            'city_id' => 109,
        ]);

        //Aromos

        Neighborhood::create([
            'id' => 1059,
            'name' => 'Aromos ',
            'city_id' => 110,
        ]);

        //Arroyo Aguiar

        Neighborhood::create([
            'id' => 1060,
            'name' => 'Arroyo Aguiar ',
            'city_id' => 111,
        ]);

        //Arroyo Ceibal

        Neighborhood::create([
            'id' => 1061,
            'name' => 'Arroyo Ceibal ',
            'city_id' => 112,
        ]);

        //Arroyo Leyes

        Neighborhood::create([
            'id' => 1062,
            'name' => 'Arroyo Leyes ',
            'city_id' => 113,
        ]);

        //Arroyo Seco

        Neighborhood::create([
            'id' => 1063,
            'name' => 'Arroyo Seco ',
            'city_id' => 114,
        ]);

        //Arrufó

        Neighborhood::create([
            'id' => 1064,
            'name' => 'Arrufó ',
            'city_id' => 115,
        ]);

        //Arteaga

        Neighborhood::create([
            'id' => 1065,
            'name' => 'Arteaga ',
            'city_id' => 116,
        ]);

        //Ascochinga

        Neighborhood::create([
            'id' => 1066,
            'name' => 'Ascochinga ',
            'city_id' => 117,
        ]);

        //Ataliva

        Neighborhood::create([
            'id' => 1067,
            'name' => 'Ataliva ',
            'city_id' => 118,
        ]);

        //Aurelia

        Neighborhood::create([
            'id' => 1068,
            'name' => 'Aurelia ',
            'city_id' => 119,
        ]);

        //Avellaneda

        Neighborhood::create([
            'id' => 1069,
            'name' => 'Avellaneda ',
            'city_id' => 120,
        ]);

        //Barrancas

        Neighborhood::create([
            'id' => 1070,
            'name' => 'Barrancas ',
            'city_id' => 121,
        ]);

        //Barrio La guardia

        Neighborhood::create([
            'id' => 1071,
            'name' => 'Barrio La Guardia',
            'city_id' => 122,
        ]);

        //Bauer y Sigel

        Neighborhood::create([
            'id' => 1072,
            'name' => 'Bauer y Sigel ',
            'city_id' => 123,
        ]);

        //Bella Italia

        Neighborhood::create([
            'id' => 1073,
            'name' => 'Bella Italia ',
            'city_id' => 124,
        ]);

        //Beravebú

        Neighborhood::create([
            'id' => 1074,
            'name' => 'Beravevú',
            'city_id' => 125,
        ]);

        //Berna

        Neighborhood::create([
            'id' => 1075,
            'name' => 'Berna',
            'city_id' => 126,
        ]);

        //Bernardo de Irigoyen

        Neighborhood::create([
            'id' => 1076,
            'name' => 'Bernardo de Irigoyen',
            'city_id' => 127,
        ]);

        //Bigand

        Neighborhood::create([
            'id' => 1077,
            'name' => 'Bigand',
            'city_id' => 128,
        ]);

        //Bombal

        Neighborhood::create([
            'id' => 1078,
            'name' => 'Bombal',
            'city_id' => 129,
        ]);

        //Bouquet

        Neighborhood::create([
            'id' => 1079,
            'name' => 'Bouquet',
            'city_id' => 130,
        ]);

        //Bustinza

        Neighborhood::create([
            'id' => 1080,
            'name' => 'Arroyo Seco',
            'city_id' => 131,
        ]);

        //Cabal

        Neighborhood::create([
            'id' => 1081,
            'name' => 'Cabal',
            'city_id' => 132,
        ]);

        //Cacique Ariacaiquín

        Neighborhood::create([
            'id' => 1082,
            'name' => 'Cacique Ariacaiquín',
            'city_id' => 133,
        ]);

        //Cafferata

        Neighborhood::create([
            'id' => 1083,
            'name' => 'Cafferata',
            'city_id' => 134,
        ]);

        //Caima

        Neighborhood::create([
            'id' => 1084,
            'name' => 'Caima',
            'city_id' => 135,
        ]);

        //Calchaqui

        Neighborhood::create([
            'id' => 1085,
            'name' => 'Calchaquí',
            'city_id' => 136,
        ]);

        //Campo Andino

        Neighborhood::create([
            'id' => 1086,
            'name' => 'Campo Andino',
            'city_id' => 137,
        ]);

        //Campo Piaggio

        Neighborhood::create([
            'id' => 1087,
            'name' => 'Campo Piaggio',
            'city_id' => 138,
        ]);

        //Candioti

        Neighborhood::create([
            'id' => 1088,
            'name' => 'Candioti',
            'city_id' => 139,
        ]);

        //Capitán Bermúdez

        Neighborhood::create([
            'id' => 1089,
            'name' => 'Capitán Bermúdez',
            'city_id' => 140,
        ]);

        //Capivara

        Neighborhood::create([
            'id' => 1090,
            'name' => 'Capivara',
            'city_id' => 141,
        ]);

        //Carcarañá

        Neighborhood::create([
            'id' => 1091,
            'name' => 'Carcarañá',
            'city_id' => 142,
        ]);

        //Carlos Pellegrini

        Neighborhood::create([
            'id' => 1092,
            'name' => 'Carlos Pellegrini',
            'city_id' => 143,
        ]);

        //Carmen

        Neighborhood::create([
            'id' => 1093,
            'name' => 'Carmen',
            'city_id' => 144,
        ]);

        //Carmen del Sauce

        Neighborhood::create([
            'id' => 1094,
            'name' => 'Carmen del Sauce',
            'city_id' => 145,
        ]);

        //Carreras

        Neighborhood::create([
            'id' => 1095,
            'name' => 'Carreras',
            'city_id' => 146,
        ]);

        //Carrizales

        Neighborhood::create([
            'id' => 1096,
            'name' => 'Carrizales',
            'city_id' => 147,
        ]);

        //Casalegno

        Neighborhood::create([
            'id' => 1097,
            'name' => 'Casalegno',
            'city_id' => 148,
        ]);

        //Casas

        Neighborhood::create([
            'id' => 1098,
            'name' => 'Casas',
            'city_id' => 149,
        ]);

        //Casilda

        Neighborhood::create([
            'id' => 1099,
            'name' => 'Casilda',
            'city_id' => 150,
        ]);

        //Castelar

        Neighborhood::create([
            'id' => 1100,
            'name' => 'Castelar',
            'city_id' => 151,
        ]);

        //Castellanos

        Neighborhood::create([
            'id' => 1101,
            'name' => 'Castellanos',
            'city_id' => 152,
        ]);

        //Cayastacitos

        Neighborhood::create([
            'id' => 1102,
            'name' => 'Cayastacitos',
            'city_id' => 153,
        ]);

        //Cayastá

        Neighborhood::create([
            'id' => 1103,
            'name' => 'Cayastá',
            'city_id' => 154,
        ]);

        //Cañada de Gómez

        Neighborhood::create([
            'id' => 1104,
            'name' => 'Cañada de Gómez',
            'city_id' => 155,
        ]);

        //Cañada del Uncle

        Neighborhood::create([
            'id' => 1105,
            'name' => 'Cañada del Uncle',
            'city_id' => 156,
        ]);

        //Cañada Ombú

        Neighborhood::create([
            'id' => 1106,
            'name' => 'Cañada Ombú',
            'city_id' => 157,
        ]);

        //Cañada Rica

        Neighborhood::create([
            'id' => 1107,
            'name' => 'Cañada Rica',
            'city_id' => 158,
        ]);

        //Cañada Rosquín

        Neighborhood::create([
            'id' => 1108,
            'name' => 'Cañada Rosquín',
            'city_id' => 159,
        ]);

        //Centeno

        Neighborhood::create([
            'id' => 1109,
            'name' => 'Centeno',
            'city_id' => 160,
        ]);

        //Cepeda

        Neighborhood::create([
            'id' => 1110,
            'name' => 'Cepeda',
            'city_id' => 161,
        ]);

        //Ceres

        Neighborhood::create([
            'id' => 1111,
            'name' => 'Ceres',
            'city_id' => 162,
        ]);

        //Chabás

        Neighborhood::create([
            'id' => 1112,
            'name' => 'Chabás',
            'city_id' => 163,
        ]);

        //Chapuy

        Neighborhood::create([
            'id' => 1113,
            'name' => 'Chapuy',
            'city_id' => 164,
        ]);

        //Chañar Ladeado

        Neighborhood::create([
            'id' => 1114,
            'name' => 'Chañar Ladeado',
            'city_id' => 165,
        ]);

        //Chovet

        Neighborhood::create([
            'id' => 1115,
            'name' => 'Chovet',
            'city_id' => 166,
        ]);

        //Christophersen

        Neighborhood::create([
            'id' => 1116,
            'name' => 'Chistophersen',
            'city_id' => 167,
        ]);

        //Classon

        Neighborhood::create([
            'id' => 1117,
            'name' => 'Classon',
            'city_id' => 168,
        ]);

        //Colastiné

        Neighborhood::create([
            'id' => 1118,
            'name' => 'Distrito La Costa',
            'city_id' => 169,
        ]);

        //Colonia Ana

        Neighborhood::create([
            'id' => 1119,
            'name' => 'Colonia Ana',
            'city_id' => 170,
        ]);

        //Colonia Belgrano

        Neighborhood::create([
            'id' => 1120,
            'name' => 'Colonia Belgrano',
            'city_id' => 172,
        ]);

        //Colonia Bicha

        Neighborhood::create([
            'id' => 1121,
            'name' => 'Colonia Bicha',
            'city_id' => 173,
        ]);

        //Colonia Bigand

        Neighborhood::create([
            'id' => 1122,
            'name' => 'Colonia Bigand',
            'city_id' => 174,
        ]);

        //Colonia Bossi

        Neighborhood::create([
            'id' => 1123,
            'name' => 'Colonia Bossi',
            'city_id' => 175,
        ]);

        //Colonia Cavour

        Neighborhood::create([
            'id' => 1124,
            'name' => 'Colonia Cavour',
            'city_id' => 176,
        ]);

        //Colonia Cello

        Neighborhood::create([
            'id' => 1125,
            'name' => 'Colonia Cello',
            'city_id' => 177,
        ]);

        //Colonia Clara

        Neighborhood::create([
            'id' => 1126,
            'name' => 'Colonia Clara',
            'city_id' => 178,
        ]);

        //Colonia Dolores

        Neighborhood::create([
            'id' => 1127,
            'name' => 'Colonia Dolores',
            'city_id' => 179,
        ]);

        //Colonia Dos Rosas

        Neighborhood::create([
            'id' => 1128,
            'name' => 'Colonia Dos Rosas',
            'city_id' => 180,
        ]);

        //Colonia Durán

        Neighborhood::create([
            'id' => 1129,
            'name' => 'Colonia Durán',
            'city_id' => 181,
        ]);

        //Colonia Iturraspe

        Neighborhood::create([
            'id' => 1130,
            'name' => 'Colonia Iturraspe',
            'city_id' => 182,
        ]);

        //Colonia Margarita

        Neighborhood::create([
            'id' => 1131,
            'name' => 'Colonia Margarita',
            'city_id' => 183,
        ]);

        //Colonia Mascias

        Neighborhood::create([
            'id' => 1132,
            'name' => 'Colonia Mascias',
            'city_id' => 184,
        ]);

        //Colonia Raquel

        Neighborhood::create([
            'id' => 1133,
            'name' => 'Colonia Raquel',
            'city_id' => 185,
        ]);

        //Colonia Rosa

        Neighborhood::create([
            'id' => 1134,
            'name' => 'Colonia Rosa',
            'city_id' => 186,
        ]);

        //Colonia San José

        Neighborhood::create([
            'id' => 1135,
            'name' => 'Colonia San José',
            'city_id' => 187,
        ]);

        //Constanza

        Neighborhood::create([
            'id' => 1136,
            'name' => 'Constanza',
            'city_id' => 188,
        ]);

        //Constituyentes

        Neighborhood::create([
            'id' => 1137,
            'name' => 'Constituyentes',
            'city_id' => 189,
        ]);

        //Coronda

        Neighborhood::create([
            'id' => 1138,
            'name' => 'Coronda',
            'city_id' => 190,
        ]);

        //Coronel Arnold

        Neighborhood::create([
            'id' => 1139,
            'name' => 'Coronel Arnold',
            'city_id' => 191,
        ]);

        //Coronel Bogado

        Neighborhood::create([
            'id' => 1140,
            'name' => 'Coronel Bogado',
            'city_id' => 192,
        ]);

        //Coronel Fraga

        Neighborhood::create([
            'id' => 1141,
            'name' => 'Coronel Fraga',
            'city_id' => 193,
        ]);

        //Coronel Rodolfo S Domínguez

        Neighborhood::create([
            'id' => 1142,
            'name' => 'Coronel Rodolfo S Domínguez',
            'city_id' => 194,
        ]);

        //Correa

        Neighborhood::create([
            'id' => 1143,
            'name' => 'Correa',
            'city_id' => 195,
        ]);

        //Crispi

        Neighborhood::create([
            'id' => 1144,
            'name' => 'Crispi',
            'city_id' => 196,
        ]);

        //Cululú

        Neighborhood::create([
            'id' => 1145,
            'name' => 'Cululú',
            'city_id' => 197,
        ]);

        //Curupaity

        Neighborhood::create([
            'id' => 1146,
            'name' => 'Curupaity',
            'city_id' => 198,
        ]);

       //Desvío Arijón

        Neighborhood::create([
            'id' => 1147,
            'name' => 'Desvío Arijón',
            'city_id' => 199,
        ]);

        //Díaz

        Neighborhood::create([
            'id' => 1148,
            'name' => 'Díaz',
            'city_id' => 200,
        ]);

        //Egusquiza

        Neighborhood::create([
            'id' => 1149,
            'name' => 'Egusquiza',
            'city_id' => 201,
        ]);

        //El Arazá

        Neighborhood::create([
            'id' => 1150,
            'name' => 'El Arazá',
            'city_id' => 202,
        ]);

        //El Rabón

        Neighborhood::create([
            'id' => 1151,
            'name' => 'El Rabón',
            'city_id' => 203,
        ]);

        //El Sombrerito

        Neighborhood::create([
            'id' => 1152,
            'name' => 'El Sombrerito',
            'city_id' => 204,
        ]);

        //El Trébol

        Neighborhood::create([
            'id' => 1153,
            'name' => 'El Trébol',
            'city_id' => 205,
        ]);

        //Elisa

        Neighborhood::create([
            'id' => 1154,
            'name' => 'Elisa',
            'city_id' => 206,
        ]);

        //Elortondo

        Neighborhood::create([
            'id' => 1155,
            'name' => 'Elortondo',
            'city_id' => 207,
        ]);

        //Emilia

        Neighborhood::create([
            'id' => 1156,
            'name' => 'Emilia',
            'city_id' => 208,
        ]);

        //Empalme San Carlos

        Neighborhood::create([
            'id' => 1157,
            'name' => 'Empalme San Carlos',
            'city_id' => 209,
        ]);

        //Empalme Villa Constitución

        Neighborhood::create([
            'id' => 1158,
            'name' => 'Empalme Villa Constitución',
            'city_id' => 210,
        ]);

        //Esmeralda

        Neighborhood::create([
            'id' => 1159,
            'name' => 'Esmeralda',
            'city_id' => 211,
        ]);

        //Esperanza

        Neighborhood::create([
            'id' => 1160,
            'name' => 'Esperanza',
            'city_id' => 212,
        ]);

        //Estacíon Maria Juana

        Neighborhood::create([
            'id' => 1161,
            'name' => 'Estación Maria Juana',
            'city_id' => 213,
        ]);

        //Estación Clucellas

        Neighborhood::create([
            'id' => 1162,
            'name' => 'Estacion Clucellas',
            'city_id' => 214,
        ]);

        //Estación la Carolina

        Neighborhood::create([
            'id' => 1163,
            'name' => 'Estacion La Carolina',
            'city_id' => 215,
        ]);

        //Esteban Rams

        Neighborhood::create([
            'id' => 1164,
            'name' => 'Esteban Rams',
            'city_id' => 216,
        ]);

        //Esther

        Neighborhood::create([
            'id' => 1165,
            'name' => 'Esther',
            'city_id' => 217,
        ]);

        //Eusebia y Carolina

        Neighborhood::create([
            'id' => 1166,
            'name' => 'Eusebia y carolina',
            'city_id' => 218,
        ]);

        //Eustolia

        Neighborhood::create([
            'id' => 1167,
            'name' => 'Eustolia',
            'city_id' => 219,
        ]);

        //Felicia

        Neighborhood::create([
            'id' => 1168,
            'name' => 'Felicia',
            'city_id' => 220,
        ]);

        //Fidela

        Neighborhood::create([
            'id' => 1169,
            'name' => 'Fidela',
            'city_id' => 221,
        ]);

        //Fighiera

        Neighborhood::create([
            'id' => 1170,
            'name' => 'Fighiera',
            'city_id' => 222,
        ]);

        //Firmat

        Neighborhood::create([
            'id' => 1171,
            'name' => 'Firmat',
            'city_id' => 223,
        ]);

        //Florencia

        Neighborhood::create([
            'id' => 1172,
            'name' => 'Florencia',
            'city_id' => 224,
        ]);

        //Fortín Guaycurú

        Neighborhood::create([
            'id' => 1173,
            'name' => 'Fortín Guaycurú',
            'city_id' => 225,
        ]);

        //Fortín Olmos

        Neighborhood::create([
            'id' => 1174,
            'name' => 'Fortín Olmos',
            'city_id' => 226,
        ]);

        //Franck

        Neighborhood::create([
            'id' => 1175,
            'name' => 'Franck',
            'city_id' => 227,
        ]);

        //Fray Luis Beltrán

        Neighborhood::create([
            'id' => 1176,
            'name' => 'Fray Luis Beltrán',
            'city_id' => 228,
        ]);

        //Frontera

        Neighborhood::create([
            'id' => 1177,
            'name' => 'Frontera',
            'city_id' => 229,
        ]);

        //Fuentes

        Neighborhood::create([
            'id' => 1178,
            'name' => 'Fuentes',
            'city_id' => 230,
        ]);

        //Gaboto

        Neighborhood::create([
            'id' => 1179,
            'name' => 'Gaboto',
            'city_id' => 231,
        ]);


        //Garibaldi

        Neighborhood::create([
            'id' => 1180,
            'name' => 'Garibaldi',
            'city_id' => 234,
        ]);

        //Gato Colorado

        Neighborhood::create([
            'id' => 1181,
            'name' => 'Gato Colorado',
            'city_id' => 235,
        ]);

        //General Gelly

        Neighborhood::create([
            'id' => 1182,
            'name' => 'General Gelly',
            'city_id' => 236,
        ]);

        //General Lagos

        Neighborhood::create([
            'id' => 1183,
            'name' => 'General Lagos',
            'city_id' => 237,
        ]);

        //Gessler

        Neighborhood::create([
            'id' => 1184,
            'name' => 'Gessler',
            'city_id' => 238,
        ]);

        //Gobernador Crespo

        Neighborhood::create([
            'id' => 1185,
            'name' => 'Gobernador Crespo',
            'city_id' => 239,
        ]);

        //Godoy

        Neighborhood::create([
            'id' => 1186,
            'name' => 'Godoy',
            'city_id' => 240,
        ]);

        //Golondrina

        Neighborhood::create([
            'id' => 1187,
            'name' => 'Golondrina',
            'city_id' => 241,
        ]);

        //Gregoria Pérez de Denis

        Neighborhood::create([
            'id' => 1188,
            'name' => 'Gregoria Pérez de Denis',
            'city_id' => 242,
        ]);

        //Grutly

        Neighborhood::create([
            'id' => 1189,
            'name' => 'Grutly',
            'city_id' => 243,
        ]);

        //Guadalupe Norte

        Neighborhood::create([
            'id' => 1190,
            'name' => 'Guadalupe Norte',
            'city_id' => 244,
        ]);

        //Gálvez

        Neighborhood::create([
            'id' => 1191,
            'name' => 'Gálvez',
            'city_id' => 245,
        ]);

        //Gödeken

        Neighborhood::create([
            'id' => 1192,
            'name' => 'Gödeken',
            'city_id' => 246,
        ]);

        //Helvecia

        Neighborhood::create([
            'id' => 1193,
            'name' => 'Helvecia',
            'city_id' => 247,
        ]);

        //Hersilia

        Neighborhood::create([
            'id' => 1194,
            'name' => 'Hersilia',
            'city_id' => 248,
        ]);

        //Hipatía

        Neighborhood::create([
            'id' => 1195,
            'name' => 'Hipatía',
            'city_id' => 249,
        ]);

        //Huanqueros

        Neighborhood::create([
            'id' => 1196,
            'name' => 'Huanqueros',
            'city_id' => 250,
        ]);

        //Hugentobler

        Neighborhood::create([
            'id' => 1197,
            'name' => 'Hugentobler',
            'city_id' => 251,
        ]);

        //Hughes

        Neighborhood::create([
            'id' => 1198,
            'name' => 'Hughes',
            'city_id' => 252,
        ]);

        //Humberto Primo

        Neighborhood::create([
            'id' => 1199,
            'name' => 'Humboldt',
            'city_id' => 253,
        ]);

        //Humboldt

        Neighborhood::create([
            'id' => 1200,
            'name' => 'Humboldt',
            'city_id' => 254,
        ]);

        //Ibarlucea

        Neighborhood::create([
            'id' => 1201,
            'name' => 'Ibarlucea',
            'city_id' => 255,
        ]);

        //Ingeniero Chanourdie

        Neighborhood::create([
            'id' => 1203,
            'name' => 'Ingeniero Chanourdie',
            'city_id' => 256,
        ]);

        //Intiyaco

        Neighborhood::create([
            'id' => 1204,
            'name' => 'Intiyaco',
            'city_id' => 257,
        ]);

        //Iriondo

        Neighborhood::create([
            'id' => 1205,
            'name' => 'Iriondo',
            'city_id' => 258,
        ]);

        //Ituzaingó

        Neighborhood::create([
            'id' => 1206,
            'name' => 'Ituzaingó',
            'city_id' => 259,
        ]);

        //Jacinto L Aráuz

        Neighborhood::create([
            'id' => 1207,
            'name' => 'Jacinto L Aráuz',
            'city_id' => 260,
        ]);

        //Josefina

        Neighborhood::create([
            'id' => 1208,
            'name' => 'Josefina',
            'city_id' => 261,
        ]);

        //Juan Bernabé Molina

        Neighborhood::create([
            'id' => 1209,
            'name' => 'Juan Bernabé Molina',
            'city_id' => 262,
        ]);

        //Juan de Garay

        Neighborhood::create([
            'id' => 1210,
            'name' => 'Juan de Garay',
            'city_id' => 263,
        ]);

        //Juncal

        Neighborhood::create([
            'id' => 1211,
            'name' => 'Juncal',
            'city_id' => 264,
        ]);

        //La Brava

        Neighborhood::create([
            'id' => 1212,
            'name' => 'La Brava',
            'city_id' => 265,
        ]);

        //La Cabral

        Neighborhood::create([
            'id' => 1213,
            'name' => 'La Cabral',
            'city_id' => 266,
        ]);

        //La Camila

        Neighborhood::create([
            'id' => 1214,
            'name' => 'La Camila',
            'city_id' => 267,
        ]);

        //La Chispa

        Neighborhood::create([
            'id' => 1215,
            'name' => 'La Chispa',
            'city_id' => 268,
        ]);

        //La Gallareta

        Neighborhood::create([
            'id' => 1216,
            'name' => 'La Gallareta',
            'city_id' => 269,
        ]);

        //La Lucila

        Neighborhood::create([
            'id' => 1217,
            'name' => 'La Lucila',
            'city_id' => 270,
        ]);

        //La Pelada

        Neighborhood::create([
            'id' => 1218,
            'name' => 'La Pelada',
            'city_id' => 271,
        ]);

        //La Penca y Caraguatá

        Neighborhood::create([
            'id' => 1219,
            'name' => 'La Penca y Caraguatá',
            'city_id' => 272,
        ]);

        //La Rubia

        Neighborhood::create([
            'id' => 1220,
            'name' => 'La Rubia',
            'city_id' => 273,
        ]);

        //La Sarita

        Neighborhood::create([
            'id' => 1221,
            'name' => 'La Sarita',
            'city_id' => 274,
        ]);

        //La Vanguardia

        Neighborhood::create([
            'id' => 1222,
            'name' => 'La Vanguardia',
            'city_id' => 275,
        ]);

        //Labordeboy

        Neighborhood::create([
            'id' => 1223,
            'name' => 'Labordeboy',
            'city_id' => 276,
        ]);

        //Laguna Paiva

        Neighborhood::create([
            'id' => 1224,
            'name' => 'Laguna Paiva',
            'city_id' => 277,
        ]);

        //Landeta

        Neighborhood::create([
            'id' => 1225,
            'name' => 'Landeta',
            'city_id' => 278,
        ]);

        //Lanteri

        Neighborhood::create([
            'id' => 1226,
            'name' => 'Lanteri',
            'city_id' => 279,
        ]);

        //Larrechea

        Neighborhood::create([
            'id' => 1228,
            'name' => 'Larrechea',
            'city_id' => 280,
        ]);

        //Las Avispas

        Neighborhood::create([
            'id' => 1229,
            'name' => 'Las Avispas',
            'city_id' => 281,
        ]);

        //Las Bandurrias

        Neighborhood::create([
            'id' => 1230,
            'name' => 'Las Bandurrias',
            'city_id' => 282,
        ]);

        //Las Garzas

        Neighborhood::create([
            'id' => 1231,
            'name' => 'Las Garzas',
            'city_id' => 283,
        ]);

        //Las Palmeras

        Neighborhood::create([
            'id' => 1232,
            'name' => 'Las Palmeras',
            'city_id' => 284,
        ]);

        //Las Parejas

        Neighborhood::create([
            'id' => 1233,
            'name' => 'Las Parejas',
            'city_id' => 285,
        ]);

        //Las Petacas

        Neighborhood::create([
            'id' => 1234,
            'name' => 'Las Petacas',
            'city_id' => 286,
        ]);

        //Las Rosas

        Neighborhood::create([
            'id' => 1235,
            'name' => 'Las Rosas',
            'city_id' => 287,
        ]);

        //Las Toscas

        Neighborhood::create([
            'id' => 1236,
            'name' => 'Las Toscas',
            'city_id' => 288,
        ]);

        //Las Tunas

        Neighborhood::create([
            'id' => 1237,
            'name' => 'Las Tunas',
            'city_id' => 289,
        ]);

        //Lassaga

        Neighborhood::create([
            'id' => 1238,
            'name' => 'Lassaga',
            'city_id' => 290,
        ]);

        //Lazzarino

        Neighborhood::create([
            'id' => 1239,
            'name' => 'Lazzarino',
            'city_id' => 291,
        ]);

        //Lehmann

        Neighborhood::create([
            'id' => 1240,
            'name' => 'Lehmann',
            'city_id' => 292,
        ]);

        //Llambí Campbell

        Neighborhood::create([
            'id' => 1241,
            'name' => 'Llambí Campbell',
            'city_id' => 293,
        ]);

        //Logroño

        Neighborhood::create([
            'id' => 1242,
            'name' => 'Logroño',
            'city_id' => 294,
        ]);

        //Loma Alta

        Neighborhood::create([
            'id' => 1243,
            'name' => 'Loma Alta',
            'city_id' => 295,
        ]);

        //Los Amores

        Neighborhood::create([
            'id' => 1244,
            'name' => 'Los Amores',
            'city_id' => 296,
        ]);

        //Los Laureles

        Neighborhood::create([
            'id' => 1245,
            'name' => 'Los Laureles',
            'city_id' => 297,
        ]);

        //Los Quirquinchos

        Neighborhood::create([
            'id' => 1246,
            'name' => 'Los Quirquinchos',
            'city_id' => 298,
        ]);

        //Lucio V Lopez

        Neighborhood::create([
            'id' => 1247,
            'name' => 'Lucio V Lopez',
            'city_id' => 299,
        ]);

        //Luis Palacios

        Neighborhood::create([
            'id' => 1248,
            'name' => 'Luis Palacios',
            'city_id' => 300,
        ]);

        //Lopez

        Neighborhood::create([
            'id' => 1249,
            'name' => 'Lopez',
            'city_id' => 301,
        ]);

        //Maciel

        Neighborhood::create([
            'id' => 1250,
            'name' => 'Maciel',
            'city_id' => 302,
        ]);

        //Maggiolo

        Neighborhood::create([
            'id' => 1251,
            'name' => 'Maggiolo',
            'city_id' => 303,
        ]);

        //Malabrigo

        Neighborhood::create([
            'id' => 1252,
            'name' => 'Malabrigo',
            'city_id' => 304,
        ]);

        //Manucho

        Neighborhood::create([
            'id' => 1253,
            'name' => 'Manucho',
            'city_id' => 305,
        ]);

        //Marcelino Escalada

        Neighborhood::create([
            'id' => 1254,
            'name' => 'Marcelino Escalada',
            'city_id' => 306,
        ]);

        //Margarita

        Neighborhood::create([
            'id' => 1255,
            'name' => 'Margarita',
            'city_id' => 307,
        ]);

        //María Juana

        Neighborhood::create([
            'id' => 1256,
            'name' => 'María Juana',
            'city_id' => 308,
        ]);

        //María Luisa

        Neighborhood::create([
            'id' => 1257,
            'name' => 'María Luisa',
            'city_id' => 309,
        ]);

        //María Susana

        Neighborhood::create([
            'id' => 1258,
            'name' => 'María Susana',
            'city_id' => 310,
        ]);

        //María Teresa

        Neighborhood::create([
            'id' => 1259,
            'name' => 'María Teresa',
            'city_id' => 311,
        ]);

        //Matilde

        Neighborhood::create([
            'id' => 1260,
            'name' => 'Matilde',
            'city_id' => 312,
        ]);

        //Mauá

        Neighborhood::create([
            'id' => 1261,
            'name' => 'Mauá',
            'city_id' => 313,
        ]);

        //Melincué

        Neighborhood::create([
            'id' => 1262,
            'name' => 'Melincué',
            'city_id' => 314,
        ]);

        //Miguel Torres

        Neighborhood::create([
            'id' => 1263,
            'name' => 'Miguel Torres',
            'city_id' => 315,
        ]);

        //Moisés Ville

        Neighborhood::create([
            'id' => 1264,
            'name' => 'Moises Ville',
            'city_id' => 316,
        ]);

        //Monigotes

        Neighborhood::create([
            'id' => 1265,
            'name' => 'Monigotes',
            'city_id' => 317,
        ]);

        //Monje

        Neighborhood::create([
            'id' => 1266,
            'name' => 'Monje',
            'city_id' => 318,
        ]);

        //Monte Flores

        Neighborhood::create([
            'id' => 1267,
            'name' => 'Monte Flores',
            'city_id' => 319,
        ]);

        //Monte Oscuridad

        Neighborhood::create([
            'id' => 1268,
            'name' => 'Monte Oscuridad',
            'city_id' => 320,
        ]);

        //Monte Vera

        Neighborhood::create([
            'id' => 1269,
            'name' => 'Monte Vera',
            'city_id' => 321,
        ]);

        //Montefiore

        Neighborhood::create([
            'id' => 1270,
            'name' => 'Montefiore',
            'city_id' => 322,
        ]);

        //Montes de Oca

        Neighborhood::create([
            'id' => 1271,
            'name' => 'Montes de Oca',
            'city_id' => 323,
        ]);

        //Murphy

        Neighborhood::create([
            'id' => 1272,
            'name' => 'Murphy',
            'city_id' => 324,
        ]);

        //Máximo Paz

        Neighborhood::create([
            'id' => 1273,
            'name' => 'Máximo Paz',
            'city_id' => 325,
        ]);

        //Naré

        Neighborhood::create([
            'id' => 1274,
            'name' => 'Naré',
            'city_id' => 326,
        ]);

        //Nelson

        Neighborhood::create([
            'id' => 1275,
            'name' => 'Nelson',
            'city_id' => 327,
        ]);

        //Nicanor Molinas

        Neighborhood::create([
            'id' => 1276,
            'name' => 'Nicanor Molinas',
            'city_id' => 328,
        ]);

        //Nuevo Torino

        Neighborhood::create([
            'id' => 1277,
            'name' => 'Nuevo Torino',
            'city_id' => 329,
        ]);



        //Palacios

        Neighborhood::create([
            'id' => 1279,
            'name' => 'Palacios',
            'city_id' => 331,
        ]);

        //Paraje Chaco Chico

        Neighborhood::create([
            'id' => 1280,
            'name' => 'Paraje Chaco Chico',
            'city_id' => 332,
        ]);

        //Paraje La Costa

        Neighborhood::create([
            'id' => 1281,
            'name' => 'Paraje La Costa',
            'city_id' => 333,
        ]);

        //Pavón

        Neighborhood::create([
            'id' => 1282,
            'name' => 'Pavón',
            'city_id' => 334,
        ]);

        //Pavón Arriba

        Neighborhood::create([
            'id' => 1283,
            'name' => 'Pavón Arriba',
            'city_id' => 335,
        ]);

        //Pedro Gomez Cello

        Neighborhood::create([
            'id' => 1284,
            'name' => 'Pedro Gómez Cello',
            'city_id' => 336,
        ]);

        //Peyrano

        Neighborhood::create([
            'id' => 1285,
            'name' => 'Peyrano',
            'city_id' => 337,
        ]);

        //Piamonte

        Neighborhood::create([
            'id' => 1286,
            'name' => 'Piamonte',
            'city_id' => 338,
        ]);

        //Pilar

        Neighborhood::create([
            'id' => 1287,
            'name' => 'Pilar',
            'city_id' => 339,
        ]);

        //Piñero

        Neighborhood::create([
            'id' => 1288,
            'name' => 'Piñero',
            'city_id' => 340,
        ]);

        //Plaza Clucellas

        Neighborhood::create([
            'id' => 1289,
            'name' => 'Plaza Clucellas',
            'city_id' => 341,
        ]);

        //Pozo Borrado

        Neighborhood::create([
            'id' => 1290,
            'name' => 'Pozo Borrado',
            'city_id' => 342,
        ]);

        //Presidente Roca

        Neighborhood::create([
            'id' => 1291,
            'name' => 'Presidente Roca',
            'city_id' => 343,
        ]);

        //Progreso

        Neighborhood::create([
            'id' => 1292,
            'name' => 'Progreso',
            'city_id' => 344,
        ]);

        //Providencia

        Neighborhood::create([
            'id' => 1293,
            'name' => 'Providencia',
            'city_id' => 345,
        ]);

        //Pueblo Andino

        Neighborhood::create([
            'id' => 1294,
            'name' => 'Pueblo Andino',
            'city_id' => 346,
        ]);

        //Pueblo Esther

        Neighborhood::create([
            'id' => 1296,
            'name' => 'Pueblo Esther',
            'city_id' => 347,
        ]);

        //Pueblo Irigoyen

        Neighborhood::create([
            'id' => 1298,
            'name' => 'Pueblo Irigoyen',
            'city_id' => 348,
        ]);

        //Pueblo Marini

        Neighborhood::create([
            'id' => 1299,
            'name' => 'Pueblo Marini',
            'city_id' => 349,
        ]);

        //Pueblo Muñoz

        Neighborhood::create([
            'id' => 1300,
            'name' => 'Pueblo Muñoz',
            'city_id' => 350,
        ]);

        //Pueblo Uranga

        Neighborhood::create([
            'id' => 1301,
            'name' => 'Pueblo Uranga',
            'city_id' => 351,
        ]);

        //Puerto Aragón

        Neighborhood::create([
            'id' => 1302,
            'name' => 'Puerto Aragón',
            'city_id' => 352,
        ]);

        //Puerto General San Martín

        Neighborhood::create([
            'id' => 1303,
            'name' => 'Puerto General San Martín',
            'city_id' => 353,
        ]);

        //Pujato

        Neighborhood::create([
            'id' => 1304,
            'name' => 'Pujato',
            'city_id' => 354,
        ]);

        //Pujato Norte

        Neighborhood::create([
            'id' => 1305,
            'name' => 'Pujato Norte',
            'city_id' => 355,
        ]);

        //Pérez

        Neighborhood::create([
            'id' => 1306,
            'name' => 'Pérez',
            'city_id' => 356,
        ]);

        //Rafaela

        Neighborhood::create([
            'id' => 1307,
            'name' => 'Rafaela',
            'city_id' => 357,
        ]);

        //Ramayón

        Neighborhood::create([
            'id' => 1308,
            'name' => 'Ramayón',
            'city_id' => 358,
        ]);

        //Ramona

        Neighborhood::create([
            'id' => 1309,
            'name' => 'Ramona',
            'city_id' => 359,
        ]);

        //Reconquista

        Neighborhood::create([
            'id' => 1310,
            'name' => 'Reconquista',
            'city_id' => 360,
        ]);

        //Recreo

        Neighborhood::create([
            'id' => 1311,
            'name' => 'Recreo',
            'city_id' => 361,
        ]);

        //Ricardone

        Neighborhood::create([
            'id' => 1312,
            'name' => 'Ricardone',
            'city_id' => 362,
        ]);

        //Rincón Potrero

        Neighborhood::create([
            'id' => 1314,
            'name' => 'Rincón Potrero',
            'city_id' => 363,
        ]);

        //Rivadavia

        Neighborhood::create([
            'id' => 1315,
            'name' => 'Rivadavia',
            'city_id' => 364,
        ]);

        //Romang

        Neighborhood::create([
            'id' => 1316,
            'name' => 'Romang',
            'city_id' => 365,
        ]);

        //Rueda

        Neighborhood::create([
            'id' => 1317,
            'name' => 'Rueda',
            'city_id' => 366,
        ]);

        //Rufino

        Neighborhood::create([
            'id' => 1318,
            'name' => 'Rufino',
            'city_id' => 367,
        ]);

        //Sa Pereira

        Neighborhood::create([
            'id' => 1319,
            'name' => 'Sa Pereyra',
            'city_id' => 368,
        ]);

        //Saguier

        Neighborhood::create([
            'id' => 1320,
            'name' => 'Saguier',
            'city_id' => 369,
        ]);

        //Saladero Mariano Cabal

        Neighborhood::create([
            'id' => 1321,
            'name' => 'Saladero Mariano Cabal',
            'city_id' => 370,
        ]);

        //Salto Grande

        Neighborhood::create([
            'id' => 1322,
            'name' => 'Salto Grande',
            'city_id' => 371,
        ]);

        //San Agustín

        Neighborhood::create([
            'id' => 1323,
            'name' => 'San Agustín',
            'city_id' => 372,
        ]);

        //San Antonio

        Neighborhood::create([
            'id' => 1324,
            'name' => 'San Antonio ',
            'city_id' => 373,
        ]);

        //San Antonio de Obligado

        Neighborhood::create([
            'id' => 1325,
            'name' => 'San Antonio de Obligado',
            'city_id' => 374,
        ]);

        //San Bernardo

        Neighborhood::create([
            'id' => 1326,
            'name' => 'San Bernardo',
            'city_id' => 375,
        ]);

        //San Carlos Centro

        Neighborhood::create([
            'id' => 1327,
            'name' => 'San Carlos Centro',
            'city_id' => 376,
        ]);

        //San Carlos Norte

        Neighborhood::create([
            'id' => 1328,
            'name' => 'San Carlos Norte',
            'city_id' => 377,
        ]);

        //San Carlos Sud

        Neighborhood::create([
            'id' => 1329,
            'name' => 'San Carlos Sud',
            'city_id' => 378,
        ]);

        //San Cristóbal

        Neighborhood::create([
            'id' => 1330,
            'name' => 'San Cristóbal',
            'city_id' => 379,
        ]);

        //San Eduardo

        Neighborhood::create([
            'id' => 1331,
            'name' => 'San Eduardo',
            'city_id' => 380,
        ]);

        //San Eugenio

        Neighborhood::create([
            'id' => 1332,
            'name' => 'San Eugenio',
            'city_id' => 381,
        ]);

        //San Fabián

        Neighborhood::create([
            'id' => 1333,
            'name' => 'San Fabián',
            'city_id' => 382,
        ]);

        //San Francisco de Santa Fe

        Neighborhood::create([
            'id' => 1334,
            'name' => 'San Francisco de Santa Fe',
            'city_id' => 383,
        ]);

        //San Genaro

        Neighborhood::create([
            'id' => 1335,
            'name' => 'San Genaro',
            'city_id' => 384,
        ]);

        //San Gregorio

        Neighborhood::create([
            'id' => 1336,
            'name' => 'San Gregorio',
            'city_id' => 385,
        ]);

        //San Guillermo

        Neighborhood::create([
            'id' => 1337,
            'name' => 'San Guillermo',
            'city_id' => 386,
        ]);

        //San Javier

        Neighborhood::create([
            'id' => 1338,
            'name' => 'San Javier',
            'city_id' => 387,
        ]);

        //San Jerónimo del Sauce

        Neighborhood::create([
            'id' => 1339,
            'name' => 'San Jerónimo del Sauce',
            'city_id' => 388,
        ]);

        //San Jerónimo del Sauce

        Neighborhood::create([
            'id' => 1340,
            'name' => 'San Jerónimo Norte',
            'city_id' => 389,
        ]);

        //San Jerónimo Sud

        Neighborhood::create([
            'id' => 1341,
            'name' => 'San Jerónimo Sud',
            'city_id' => 390,
        ]);

        //San Jorge

        Neighborhood::create([
            'id' => 1342,
            'name' => 'San Jorge',
            'city_id' => 391,
        ]);

        //San José de la Esquina

        Neighborhood::create([
            'id' => 1343,
            'name' => 'San José de la Esquina',
            'city_id' => 392,
        ]);

        //San José del Rincón

        Neighborhood::create([
            'id' => 1344,
            'name' => 'San José del Rincón',
            'city_id' => 393,
        ]);

        //San Justo

        Neighborhood::create([
            'id' => 1345,
            'name' => 'San Justo',
            'city_id' => 394,
        ]);

        //San Lorenzo

        Neighborhood::create([
            'id' => 1346,
            'name' => 'San Lorenzo',
            'city_id' => 395,
        ]);

        //San Mariano

        Neighborhood::create([
            'id' => 1347,
            'name' => 'San Mariano',
            'city_id' => 396,
        ]);

        //San Martín de las Escobas

        Neighborhood::create([
            'id' => 1348,
            'name' => 'San Martín de las Escobas',
            'city_id' => 397,
        ]);

        //San Martín Norte

        Neighborhood::create([
            'id' => 1349,
            'name' => 'San Martín Norte',
            'city_id' => 398,
        ]);

        //San Vicente

        Neighborhood::create([
            'id' => 1350,
            'name' => 'San Vicente',
            'city_id' => 399,
        ]);

        //Sancti Spiritu

        Neighborhood::create([
            'id' => 1351,
            'name' => 'Sancti Spiritu',
            'city_id' => 400,
        ]);

        //SanFord

        Neighborhood::create([
            'id' => 1352,
            'name' => 'Sanford',
            'city_id' => 401,
        ]);

        //Santa Clara de Buena Vista

        Neighborhood::create([
            'id' => 1353,
            'name' => 'Santa Clara de Buena Vista',
            'city_id' => 402,
        ]);

        //Santa Clara de Saguier

        Neighborhood::create([
            'id' => 1354,
            'name' => 'Santa Clara de Saguier',
            'city_id' => 403,
        ]);

        //Santa Isabel

        Neighborhood::create([
            'id' => 1355,
            'name' => 'Santa Isabel',
            'city_id' => 404,
        ]);

        //Santa Margarita

        Neighborhood::create([
            'id' => 1356,
            'name' => 'Santa Margarita',
            'city_id' => 405,
        ]);

        //Santa Maria Centro

        Neighborhood::create([
            'id' => 1357,
            'name' => 'Santa Maria Centro',
            'city_id' => 406,
        ]);

        //Santa Maria Norte

        Neighborhood::create([
            'id' => 1358,
            'name' => 'Santa Maria Norte',
            'city_id' => 407,
        ]);

        //Santa Rosa de Calchines

        Neighborhood::create([
            'id' => 1359,
            'name' => 'Santa Rosa de Calchines',
            'city_id' => 408,
        ]);

        //Santa Teresa

        Neighborhood::create([
            'id' => 1360,
            'name' => 'Santa Teresa',
            'city_id' => 409,
        ]);

        //Santo Domingo

        Neighborhood::create([
            'id' => 1361,
            'name' => 'Santo Domingo',
            'city_id' => 410,
        ]);

        //Santo Tomé

        Neighborhood::create([
            'id' => 1362,
            'name' => 'Santo Tomé',
            'city_id' => 411,
        ]);

        //Santurce

        Neighborhood::create([
            'id' => 1364,
            'name' => 'Santurce',
            'city_id' => 412,
        ]);

        //Sargento Cabral

        Neighborhood::create([
            'id' => 1365,
            'name' => 'Sargento Cabral',
            'city_id' => 413,
        ]);

        //Sarmiento

        Neighborhood::create([
            'id' => 1366,
            'name' => 'Sarmiento',
            'city_id' => 414,
        ]);

        //Sastre

        Neighborhood::create([
            'id' => 1367,
            'name' => 'Sastre',
            'city_id' => 415,
        ]);

        //Sauce Viejo

        Neighborhood::create([
            'id' => 1368,
            'name' => 'Sauce Viejo',
            'city_id' => 416,
        ]);

        //Serodino

        Neighborhood::create([
            'id' => 1369,
            'name' => 'Serodino',
            'city_id' => 417,
        ]);

        //Silva

        Neighborhood::create([
            'id' => 1370,
            'name' => 'Silva',
            'city_id' => 418,
        ]);

        //Soldini

        Neighborhood::create([
            'id' => 1371,
            'name' => 'Soldini',
            'city_id' => 419,
        ]);

        //Soledad

        Neighborhood::create([
            'id' => 1372,
            'name' => 'Soledad',
            'city_id' => 420,
        ]);

        //Souto Mayor

        Neighborhood::create([
            'id' => 1373,
            'name' => 'Soutomayor',
            'city_id' => 421,
        ]);

        //Suardi

        Neighborhood::create([
            'id' => 1374,
            'name' => 'Suardi',
            'city_id' => 422,
        ]);

        //Sunchales

        Neighborhood::create([
            'id' => 1375,
            'name' => 'Sunchales',
            'city_id' => 423,
        ]);

        //Susana

        Neighborhood::create([
            'id' => 1376,
            'name' => 'Susana',
            'city_id' => 424,
        ]);

        //Tacuarendi

        Neighborhood::create([
            'id' => 1377,
            'name' => 'Tacuarendi',
            'city_id' => 425,
        ]);

        //Tacural

        Neighborhood::create([
            'id' => 1378,
            'name' => 'Tacural',
            'city_id' => 426,
        ]);

        //Tacurales

        Neighborhood::create([
            'id' => 1379,
            'name' => 'Tarcurales ',
            'city_id' => 427,
        ]);

        //Tartagal

        Neighborhood::create([
            'id' => 1380,
            'name' => 'Tartagal',
            'city_id' => 428,
        ]);

        //Teodelina

        Neighborhood::create([
            'id' => 1381,
            'name' => 'Teodelina',
            'city_id' => 429,
        ]);

        //Theobald

        Neighborhood::create([
            'id' => 1382,
            'name' => 'Theobald',
            'city_id' => 430,
        ]);

        //Timbues

        Neighborhood::create([
            'id' =>1383,
            'name' => 'Timbues',
            'city_id' => 431,
        ]);

        //Toba

        Neighborhood::create([
            'id' => 1384,
            'name' => 'Toba',
            'city_id' => 432,
        ]);

        //Tortugas

        Neighborhood::create([
            'id' => 1385,
            'name' => 'Tortugas',
            'city_id' => 433,
        ]);

        //Tostado

        Neighborhood::create([
            'id' => 1386,
            'name' => 'Tostado',
            'city_id' => 434,
        ]);

        //Totoras

        Neighborhood::create([
            'id' => 1387,
            'name' => 'Totoras',
            'city_id' => 435,
        ]);

        //traill

        Neighborhood::create([
            'id' => 1388,
            'name' => 'Traill',
            'city_id' => 436,
        ]);

        //Venado Tuerto

        Neighborhood::create([
            'id' => 1389,
            'name' => 'Venado Tuerto',
            'city_id' => 437,
        ]);

        //Vera

        Neighborhood::create([
            'id' => 1390,
            'name' => 'Vera',
            'city_id' => 438,
        ]);

        //Vera y pintado

        Neighborhood::create([
            'id' => 1391,
            'name' => 'Vera y Pintado',
            'city_id' => 439,
        ]);

        //Videla

        Neighborhood::create([
            'id' => 1392,
            'name' => 'Videla',
            'city_id' => 440,
        ]);

        //Vila

        Neighborhood::create([
            'id' => 1394,
            'name' => 'Vila',
            'city_id' => 441,
        ]);

        //Villa Amelia

        Neighborhood::create([
            'id' => 1395,
            'name' => 'Villa Amelia',
            'city_id' => 442,
        ]);

        //Villa Ana

        Neighborhood::create([
            'id' => 1396,
            'name' => 'Villa Ana',
            'city_id' => 443,
        ]);

        //Villa Cañas

        Neighborhood::create([
            'id' => 1397,
            'name' => 'Villa Cañas',
            'city_id' => 444,
        ]);

        //Villa Constitución

        Neighborhood::create([
            'id' => 1398,
            'name' => 'Villa Constitución',
            'city_id' => 445,
        ]);

        //Villa Eloisa

        Neighborhood::create([
            'id' => 1399,
            'name' => 'Villa Eloisa',
            'city_id' => 46,
        ]);

        //Villa Elvira

        Neighborhood::create([
            'id' => 1400,
            'name' => 'Villa Elvira',
            'city_id' => 447,
        ]);

        //Villa Estela

        Neighborhood::create([
            'id' => 1401,
            'name' => 'Villa Estela',
            'city_id' => 448,
        ]);

        //Villa Gobernador Galvez

        Neighborhood::create([
            'id' => 1402,
            'name' => 'Villa Gobernador Galvez',
            'city_id' => 449,
        ]);

        //Villa Guillermina

        Neighborhood::create([
            'id' => 1403,
            'name' => 'Villa Guillermina',
            'city_id' => 450,
        ]);

        //Villa Laura

        Neighborhood::create([
            'id' => 1404,
            'name' => 'Villa Laura',
            'city_id' => 451,
        ]);

        //Villa Minetti

        Neighborhood::create([
            'id' => 1405,
            'name' => 'Villa Minetti',
            'city_id' => 452,
        ]);

        //Villa Mugueta

        Neighborhood::create([
            'id' => 1406,
            'name' => 'Villa Muguetta',
            'city_id' => 453,
        ]);

        //Villa Ocampo

        Neighborhood::create([
            'id' => 1407,
            'name' => 'Villa Ocampo',
            'city_id' => 454,
        ]);

       //Villa San josé

       Neighborhood::create([
            'id' => 1408,
            'name' => 'Villa San José',
            'city_id' => 455,
        ]);

        //Villa Saralegui

        Neighborhood::create([
            'id' => 1409,
            'name' => 'Villa Saralegui',
            'city_id' => 456,
        ]);

        //Villa Trinidad

        Neighborhood::create([
            'id' => 1410,
            'name' => 'Villa Trinidad',
            'city_id' => 457,
        ]);

        //Villada

        Neighborhood::create([
            'id' => 1411,
            'name' => 'Villada',
            'city_id' => 458,
        ]);

        //WheelWhright

        Neighborhood::create([
            'id' => 1412,
            'name' => 'Wheelwhright',
            'city_id' => 459,
        ]);

        //Zavalla

        Neighborhood::create([
            'id' => 1413,
            'name' => 'Zavalla',
            'city_id' => 460,
        ]);

        //Zenón Pereyra

        Neighborhood::create([
            'id' => 1414,
            'name' => 'Zenón Pereyra',
            'city_id' => 461,
        ]);

        //Álvarez

        Neighborhood::create([
            'id' => 1415,
            'name' => 'Álvarez',
            'city_id' => 462,
        ]);

        //Ángel Gallardo

        Neighborhood::create([
            'id' => 1416,
            'name' => 'Ángel Gallardo',
            'city_id' => 463,
        ]);

        //Ñanducita

        Neighborhood::create([
            'id' => 1417,
            'name' => 'Ñanducita',
            'city_id' => 464,
        ]);

       //Bahía Blanca

        Neighborhood::create([
            'id' => 1418,
            'name' => 'Centro',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1419,
            'name' => 'Naposta',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1420,
            'name' => 'Cabildo',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1421,
            'name' => 'General Daniel Cerri',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1422,
            'name' => 'Universitario',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1423,
            'name' => 'Alférez San Martin',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1424,
            'name' => 'Altos del Pinar',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1425,
            'name' => 'Altos Palihue',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1426,
            'name' => 'Altos Sánchez',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1427,
            'name' => 'Avellaneda',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1428,
            'name' => 'Bosque Alto',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1429,
            'name' => 'Centro Norte',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1430,
            'name' => 'Centro Oeste',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1431,
            'name' => 'Centro Sudeste',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1432 ,
            'name' => 'Centro Sudoeste',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1433,
            'name' => 'Colorado',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1434,
            'name' => 'Cooperación',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1435,
            'name' => 'Corti',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1436,
            'name' => 'Don Carlos',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1437,
            'name' => 'El Nacional',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1438,
            'name' => 'Estomba',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1439,
            'name' => 'Grübein',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1440,
            'name' => 'La Viticola',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1441,
            'name' => 'Latino',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1442,
            'name' => 'Los Almendros',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1443,
            'name' => 'Namuncurá',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1444,
            'name' => 'Nueva Belgrano',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1445,
            'name' => 'Pacífico',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1446,
            'name' => 'Paihuén',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1448,
            'name' => 'Parque Industrial',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1449,
            'name' => 'Parque Quintana',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1450,
            'name' => 'Parque Sesquicentenario',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1451,
            'name' => 'Rosendo López',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1452,
            'name' => 'San Cayetano',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1453,
            'name' => 'San Jorge',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1454,
            'name' => 'Santa Margarita',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1455,
            'name' => 'Universitario',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1456,
            'name' => 'Villa Belgrano',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1457,
            'name' => 'Villa Bordeau',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1458,
            'name' => 'Villa Duprat',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1459,
            'name' => 'Villa Espora - Base Aeronaval',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1460,
            'name' => 'Villa Floresta',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1461,
            'name' => 'Villa Harding Green',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1462,
            'name' => 'Villa Irupé',
            'city_id' => 465,
        ]);

        Neighborhood::create([
            'id' => 1463,
            'name' => 'Villa Stella Maris',
            'city_id' => 465,
        ]);

        //Balcarce

        Neighborhood::create([
            'id' => 1464,
            'name' => 'Balcarce',
            'city_id' => 466,
        ]);

        Neighborhood::create([
            'id' => 1465,
            'name' => 'San Agustin',
            'city_id' => 466,
        ]);

        Neighborhood::create([
            'id' => 1466,
            'name' => 'Los Pinos',
            'city_id' => 466,
        ]);


        Neighborhood::create([
            'id' => 1468,
            'name' => 'Napoleofú',
            'city_id' => 466,
        ]);

        Neighborhood::create([
            'id' => 1469,
            'name' => 'Bosch',
            'city_id' => 466,
        ]);

        Neighborhood::create([
            'id' => 1470,
            'name' => 'Ramos Otero',
            'city_id' => 466,
        ]);

        //Lobos

        Neighborhood::create([
            'id' => 1471,
            'name' => 'Lobos',
            'city_id' => 467,
        ]);

        Neighborhood::create([
            'id' => 1472,
            'name' => 'Lobos: Cabecera del Partido',
            'city_id' => 467,
        ]);

        Neighborhood::create([
            'id' => 1473,
            'name' => 'Salvador María',
            'city_id' => 467,
        ]);

        Neighborhood::create([
            'id' => 1474,
            'name' => 'Empalme Lobos',
            'city_id' => 467,
        ]);

        Neighborhood::create([
            'id' => 1475,
            'name' => 'Zapiola',
            'city_id' => 467,
        ]);

        Neighborhood::create([
            'id' => 1476,
            'name' => 'Santa María de Lobos',
            'city_id' => 467,
        ]);

        //Tandil

        Neighborhood::create([
            'id' => 1477,
            'name' => 'Tandil',
            'city_id' => 468,
        ]);

        Neighborhood::create([
            'id' => 1478,
            'name' => 'Gardey',
            'city_id' => 468,
        ]);

        Neighborhood::create([
            'id' => 1479,
            'name' => 'María Ignacia',
            'city_id' => 468,
        ]);

        Neighborhood::create([
            'id' => 1480,
            'name' => 'Cerro Leones',
            'city_id' => 468,
        ]);

        Neighborhood::create([
            'id' => 7892,
            'name' => 'Azucena',
            'city_id' => 468,

        ]);

        Neighborhood::create([
            'id' => 7893,
            'name' => 'De la Canal',
            'city_id' => 468,

        ]);

        Neighborhood::create([
            'id' => 7894,
            'name' => 'Desvío Aguirre',
            'city_id' => 468,

        ]);

        Neighborhood::create([
            'id' => 7895,
            'name' => 'Fulton',
            'city_id' => 468,

        ]);

        Neighborhood::create([
            'id' => 7896,
            'name' => 'Iraola',
            'city_id' => 4202,

        ]);

        Neighborhood::create([
            'id' => 7897,
            'name' => 'Numancia',
            'city_id' => 4202,

        ]);

        //Chascomús

        Neighborhood::create([
            'id' => 1481,
            'name' => 'Chascomús',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1482,
            'name' => 'Puerto Chascomús',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1483,
            'name' => 'Manuel José Cobo (Estación Lezama)',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1484,
            'name' => 'Laguna Vitel',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1485,
            'name' => 'Barrio Parque Girado',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1486,
            'name' => '30 de Mayo',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1487,
            'name' => 'Acceso Norte',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1488,
            'name' => 'Adela',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1489,
            'name' => 'Anahí',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1490,
            'name' => 'Atilio Pessagno',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1491,
            'name' => 'Baldomero Fernández Moreno',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1492,
            'name' => 'Caballo Blanco',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1493,
            'name' => 'Centro',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1494,
            'name' => 'Club de Campo Lomas Chascomús',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1495,
            'name' => 'Club San Huberto',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1496,
            'name' => 'Colón',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1497,
            'name' => 'Comandante Giribone',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1498,
            'name' => 'Comipini',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1499,
            'name' => 'Don Cipriano',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1500,
            'name' => 'El Algarrobo',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1501,
            'name' => 'El Hueco',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1502,
            'name' => 'El Ipora',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1503,
            'name' => 'El Porteño',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1504,
            'name' => 'El Tambor',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1505,
            'name' => 'Esteban Echeverría',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1506,
            'name' => 'Fátima',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1507,
            'name' => 'Golf Chascomús Country Club',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1508,
            'name' => 'Gándara',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1509,
            'name' => 'Jardín',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1510,
            'name' => 'La Concordia',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1511,
            'name' => 'La Esmeralda',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1512,
            'name' => 'La Liberata',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1513,
            'name' => 'La Noria Chica',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1514,
            'name' => 'La Pampita',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1515,
            'name' => 'Las Violetas',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1516,
            'name' => 'Libres del Sud',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1517,
            'name' => 'Lomas Altas',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1518,
            'name' => 'Los Aromos',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1519,
            'name' => 'Los Sauces',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1520,
            'name' => 'Monasterio',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1521,
            'name' => 'Obispado',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1522,
            'name' => 'Paraje El Destino',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1523,
            'name' => 'Parque Chascomús',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1524,
            'name' => 'Pedro N Escribano',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1525,
            'name' => 'San José',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1526,
            'name' => 'San Juan Bautista',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1527,
            'name' => 'San Luis',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1528,
            'name' => 'San Nicolás',
            'city_id' => 469,
        ]);

        Neighborhood::create([
            'id' => 1529,
            'name' => 'Villa Luján',
            'city_id' => 469,
        ]);


        //Acevedo

        Neighborhood::create([
            'id' => 1530,
            'name' => 'Acevedo',
            'city_id' => 470,
        ]);

        //Adolfo Alsina

        Neighborhood::create([
            'id' => 1531,
            'name' => 'Carhué',
            'city_id' => 471,
        ]);

        Neighborhood::create([
            'id' => 1532,
            'name' => 'Villa Maza',
            'city_id' => 471,
        ]);

        Neighborhood::create([
            'id' => 1533,
            'name' => 'Rivera',
            'city_id' => 471,
        ]);

        //Adolfo Gonzales Chaves

        Neighborhood::create([
            'id' => 1534,
            'name' => 'De la Garma',
            'city_id' => 472,
        ]);

        Neighborhood::create([
            'id' => 1535,
            'name' => 'Adolfo Gonzales Chaves',
            'city_id' => 472,
        ]);

        //Agustina

        Neighborhood::create([
            'id' => 1536,
            'name' => 'Agustina',
            'city_id' => 473,
        ]);

        //Agustín Roca

        Neighborhood::create([
            'id' => 1537,
            'name' => 'Agustín Roca',
            'city_id' => 474,
        ]);

        //Alberti

        Neighborhood::create([
            'id' => 1538,
            'name' => 'Alberti',
            'city_id' => 475,
        ]);

        //Alfonzo

        Neighborhood::create([
            'id' => 1539,
            'name' => 'Alfonzo',
            'city_id' => 476,
        ]);

        //Antonio Carboni

        Neighborhood::create([
            'id' => 1540,
            'name' => 'Antonio Carboni',
            'city_id' => 477,
        ]);

        //Arrecifes

        Neighborhood::create([
            'id' => 1541,
            'name' => 'Arrecifes',
            'city_id' => 478,
        ]);

        Neighborhood::create([
            'id' => 1542,
            'name' => 'Viña',
            'city_id' => 478,
        ]);

        Neighborhood::create([
            'id' => 1543,
            'name' => 'Todd',
            'city_id' => 478,
        ]);

        //Ayacucho

        Neighborhood::create([
            'id' => 1544,
            'name' => 'Ayacucho',
            'city_id' => 479,
        ]);

        Neighborhood::create([
            'id' => 1545,
            'name' => 'Solanet',
            'city_id' => 479,
        ]);

        //Azul

        Neighborhood::create([
            'id' => 1546,
            'name' => 'Azul',
            'city_id' => 480,
        ]);

        Neighborhood::create([
            'id' => 1547,
            'name' => 'Cacharí',
            'city_id' => 480,
        ]);

        Neighborhood::create([
            'id' => 1548,
            'name' => 'Chillar',
            'city_id' => 480,
        ]);

        Neighborhood::create([
            'id' => 1549,
            'name' => 'Ariel',
            'city_id' => 480,
        ]);

        //Baradero

        Neighborhood::create([
            'id' => 1550,
            'name' => 'Baradero',
            'city_id' => 481,
        ]);

        Neighborhood::create([
            'id' => 1551,
            'name' => 'Quebradas',
            'city_id' => 481,
        ]);

        Neighborhood::create([
            'id' => 1552,
            'name' => 'Santa Coloma',
            'city_id' => 481,
        ]);

        Neighborhood::create([
            'id' => 1553,
            'name' => 'Villa Alsina (Estación Alsina)',
            'city_id' => 481,
        ]);

        Neighborhood::create([
            'id' => 1554,
            'name' => 'Irineo Portela',
            'city_id' => 481,
        ]);

        //Batán

        Neighborhood::create([
            'id' => 1555,
            'name' => 'Batán',
            'city_id' => 482,
        ]);

       //Benito Juárez

       Neighborhood::create([
            'id' => 1556,
            'name' => 'Benito Juárez',
            'city_id' => 483,
        ]);

        Neighborhood::create([
            'id' => 1557,
            'name' => 'Villa Cacique (Est Alfredo Fortabat)',
            'city_id' => 483,
        ]);

        //Bolívar

        Neighborhood::create([
            'id' => 1558,
            'name' => 'Villa Lynch Pueyrredón',
            'city_id' => 484,
        ]);

        Neighborhood::create([
            'id' => 1559,
            'name' => 'Mariano Unzué',
            'city_id' => 484,
        ]);

        Neighborhood::create([
            'id' => 1560,
            'name' => 'San Carlos de Bolívar',
            'city_id' => 484,
        ]);

        Neighborhood::create([
            'id' => 1561,
            'name' => 'Bolívar (Cabecera)',
            'city_id' => 484,
        ]);

        Neighborhood::create([
            'id' => 1562,
            'name' => 'Urdampilleta',
            'city_id' => 484,
        ]);

        Neighborhood::create([
            'id' => 1563,
            'name' => 'Hale',
            'city_id' => 484,
        ]);

        Neighborhood::create([
            'id' => 1564,
            'name' => 'Juan F Ibarra',
            'city_id' => 484,
        ]);

        Neighborhood::create([
            'id' => 1565,
            'name' => 'Paula (Est La Paula)',
            'city_id' => 484,
        ]);

        Neighborhood::create([
            'id' => 1566,
            'name' => 'Pirovano',
            'city_id' => 484,
        ]);

        Neighborhood::create([
            'id' => 1567,
            'name' => 'Vallimanca',
            'city_id' => 484,
        ]);

        Neighborhood::create([
            'id' => 1568,
            'name' => 'Villa Sanz',
            'city_id' => 484,
        ]);

        //Bragado

        Neighborhood::create([
            'id' => 1569,
            'name' => 'Bragado',
            'city_id' => 485,
        ]);

        Neighborhood::create([
            'id' => 1570,
            'name' => 'Máximo Fernández',
            'city_id' => 485,
        ]);

        Neighborhood::create([
            'id' => 1571,
            'name' => 'Mechita',
            'city_id' => 485,
        ]);

        Neighborhood::create([
            'id' => 1572,
            'name' => 'Comodoro Py',
            'city_id' => 485,
        ]);

        Neighborhood::create([
            'id' => 1573,
            'name' => 'Olascoaga',
            'city_id' => 485,
        ]);

        Neighborhood::create([
            'id' => 1574,
            'name' => 'Asamblea',
            'city_id' => 485,
        ]);

        Neighborhood::create([
            'id' => 1575,
            'name' => 'General Eduardo O`brien',
            'city_id' => 485,
        ]);

        Neighborhood::create([
            'id' => 1576,
            'name' => 'Irala',
            'city_id' => 485,
        ]);

        Neighborhood::create([
            'id' => 1577,
            'name' => 'La Limpia',
            'city_id' => 485,
        ]);

        Neighborhood::create([
            'id' => 1578,
            'name' => 'Warnes',
            'city_id' => 485,
        ]);

        //Capitán Sarmiento

        Neighborhood::create([
            'id' => 1579,
            'name' => 'Capitán Sarmiento',
            'city_id' => 486,
        ]);

        Neighborhood::create([
            'id' => 1580,
            'name' => 'La Luisa',
            'city_id' => 486,
        ]);

        //Carlos Casares

        Neighborhood::create([
            'id' => 1581,
            'name' => 'Carlos Casares',
            'city_id' => 487,
        ]);

        Neighborhood::create([
            'id' => 1582,
            'name' => 'La Sofía',
            'city_id' => 487,
        ]);

        //Carlos Tejedor

        Neighborhood::create([
            'id' => 1583,
            'name' => 'Carlos Tejedor',
            'city_id' => 488,
        ]);

        Neighborhood::create([
            'id' => 1584,
            'name' => 'Esteban de Luca',
            'city_id' => 488,
        ]);

        Neighborhood::create([
            'id' => 1585,
            'name' => 'Timote',
            'city_id' => 488,
        ]);

        //Carmen de Areco

        Neighborhood::create([
            'id' => 1586,
            'name' => 'Carmen de Areco',
            'city_id' => 489,
        ]);

        //Carmen de Patagones

        Neighborhood::create([
            'id' => 1587,
            'name' => 'Bahía San Blas',
            'city_id' => 490,
        ]);

        Neighborhood::create([
            'id' => 1588,
            'name' => 'Carmen de Patagones',
            'city_id' => 490,
        ]);

        Neighborhood::create([
            'id' => 1589,
            'name' => 'Stroeder 1975',
            'city_id' => 490,
        ]);

        Neighborhood::create([
            'id' => 1590,
            'name' => 'Villalonga 3705',
            'city_id' => 490,
        ]);

        //Castelli

        Neighborhood::create([
            'id' => 1591,
            'name' => 'Castelli',
            'city_id' => 491,
        ]);

        Neighborhood::create([
            'id' => 1592,
            'name' => 'Cerro de La Gloria',
            'city_id' => 491,
        ]);

        Neighborhood::create([
            'id' => 1593,
            'name' => 'Centro Guerrero',
            'city_id' => 491,
        ]);

        //Chacabuco

        Neighborhood::create([
            'id' => 1594,
            'name' => 'Rawson',
            'city_id' => 492,
        ]);

        Neighborhood::create([
            'id' => 1595,
            'name' => 'Castilla',
            'city_id' => 492,
        ]);

        Neighborhood::create([
            'id' => 1596,
            'name' => 'Chacabuco',
            'city_id' => 492,
        ]);

        //Chivilcoy

        Neighborhood::create([
            'id' => 1597,
            'name' => 'Chivilcoy',
            'city_id' => 493,
        ]);

        Neighborhood::create([
            'id' => 1598,
            'name' => 'La Rica',
            'city_id' => 493,
        ]);

        Neighborhood::create([
            'id' => 1599,
            'name' => 'San Sebastián',
            'city_id' => 493,
        ]);

        //Colinas Verdes

        Neighborhood::create([
            'id' => 1600,
            'name' => 'Colinas Verdes',
            'city_id' => 494,
        ]);

        //Colón

        Neighborhood::create([
            'id' => 1601,
            'name' => 'Colón',
            'city_id' => 495,
        ]);

        //Comandante Nicanor Otamendi

        Neighborhood::create([
            'id' => 1602,
            'name' => 'Comandante Nicanor Otamendi',
            'city_id' => 485,
        ]);

        //Coronel Dorrego

        Neighborhood::create([
            'id' => 1603,
            'name' => 'Coronel Dorrego',
            'city_id' => 497,
        ]);

        Neighborhood::create([
            'id' => 1604,
            'name' => 'Oriente',
            'city_id' => 497,
        ]);

        Neighborhood::create([
            'id' => 1605,
            'name' => 'Aparicio',
            'city_id' => 497,
        ]);

        //Coronel Pringles

        Neighborhood::create([
            'id' => 1606,
            'name' => 'Coronel Pringles',
            'city_id' => 498,
        ]);

        //Coronel Rosales

        Neighborhood::create([
            'id' => 1607,
            'name' => 'Bajo Hondo',
            'city_id' => 499,
        ]);

        //Coronel Suárez

        Neighborhood::create([
            'id' => 1608,
            'name' => 'Coronel Suárez',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1609,
            'name' => 'Piñeyro',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1610,
            'name' => 'Santa Trinidad',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1611,
            'name' => 'San José',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1612,
            'name' => 'Villa Arcadia',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1613,
            'name' => 'Bathurts',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1614,
            'name' => 'Cascada',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1615,
            'name' => 'Cura Malal',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1616,
            'name' => 'D´Orbigny',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1617,
            'name' => 'Huanguelén',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1618,
            'name' => 'Ombú',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1619,
            'name' => 'Otoño',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1620,
            'name' => 'Pasman',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1621,
            'name' => 'Primavera',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1622,
            'name' => 'Quiñihual',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1623,
            'name' => 'Santa María',
            'city_id' => 500,
        ]);

        Neighborhood::create([
            'id' => 1624,
            'name' => 'Zoilo',
            'city_id' => 500,
        ]);

        //Coronel Vidal

        Neighborhood::create([
            'id' => 1625,
            'name' => 'Coronel Vidal',
            'city_id' => 501,
        ]);

        //Daireaux

        Neighborhood::create([
            'id' => 1626,
            'name' => 'Daireaux',
            'city_id' => 502,
        ]);

        Neighborhood::create([
            'id' => 1627,
            'name' => 'Salazar Mouras',
            'city_id' => 502,
        ]);

        Neighborhood::create([
            'id' => 1628,
            'name' => 'Arboledas',
            'city_id' => 502,
        ]);

        //De la Garma

        Neighborhood::create([
            'id' => 1629,
            'name' => 'De la Garma',
            'city_id' => 503,
        ]);

        //Dolores

        Neighborhood::create([
            'id' => 1630,
            'name' => 'Dolores',
            'city_id' => 504,
        ]);

        //Dos Hermanos

        Neighborhood::create([
            'id' => 1631,
            'name' => 'Dos Hermanos',
            'city_id' => 505,
        ]);

        //Dussaud

        Neighborhood::create([
            'id' => 1632,
            'name' => 'Dussaud',
            'city_id' => 506,
        ]);

        //El Boquerón

        Neighborhood::create([
            'id' => 1633,
            'name' => 'El Boquerón',
            'city_id' => 507,
        ]);

        //El Peregrino

        Neighborhood::create([
            'id' => 1634,
            'name' => 'El Peregrino',
            'city_id' => 508,
        ]);

        //El Socorro

        Neighborhood::create([
            'id' => 1635,
            'name' => 'El Socorro',
            'city_id' => 509,
        ]);

        //Elvira

        Neighborhood::create([
            'id' => 1636,
            'name' => 'Elvira',
            'city_id' => 510,
        ]);

        //Estación Camet

        Neighborhood::create([
            'id' => 1637,
            'name' => 'Estación Camet',
            'city_id' => 511,
        ]);

        //Florentino Ameghino

        Neighborhood::create([
            'id' => 1638,
            'name' => 'Ameghino',
            'city_id' => 512,
        ]);

        Neighborhood::create([
            'id' => 1639,
            'name' => 'Porvenir',
            'city_id' => 512,
        ]);

        //Fortín Mercedes

        Neighborhood::create([
            'id' => 1640,
            'name' => 'Fortín Mercedes',
            'city_id' => 513,
        ]);

        //General Alvarado

        Neighborhood::create([
            'id' => 1641,
            'name' => 'General Alvarado',
            'city_id' => 514,
        ]);

        //General Alvear

        Neighborhood::create([
            'id' => 1642,
            'name' => 'General Alvear',
            'city_id' => 515,
        ]);

        //General Arenales

        Neighborhood::create([
            'id' => 1643,
            'name' => 'Ferré',
            'city_id' => 516,
        ]);

        //General Belgrano

        Neighborhood::create([
            'id' => 1644,
            'name' => 'Chas',
            'city_id' => 517,
        ]);

        //General Granada

        Neighborhood::create([
            'id' => 1645,
            'name' => 'General Granada',
            'city_id' => 518,
        ]);

        //General Guido

        Neighborhood::create([
            'id' => 1646,
            'name' => 'General Guido',
            'city_id' => 519,
        ]);

        //General Hornos

        Neighborhood::create([
            'id' => 1647,
            'name' => 'General Hornos',
            'city_id' => 520,
        ]);

        //General Lamadrid

        Neighborhood::create([
            'id' => 1648,
            'name' => 'General Lamadrid',
            'city_id' => 521,
        ]);

        Neighborhood::create([
            'id' => 1649,
            'name' => 'La Colina',
            'city_id' => 521,
        ]);

        //General Las Heras

        Neighborhood::create([
            'id' => 1650,
            'name' => 'General Las Heras',
            'city_id' => 522,
        ]);

        Neighborhood::create([
            'id' => 1651,
            'name' => 'Villars',
            'city_id' => 522,
        ]);

        Neighborhood::create([
            'id' => 1652,
            'name' => 'Plomer',
            'city_id' => 522,
        ]);

        Neighborhood::create([
            'id' => 1653,
            'name' => 'General Hornos',
            'city_id' => 522,
        ]);

        Neighborhood::create([
            'id' => 1654,
            'name' => 'La Choza',
            'city_id' => 522,
        ]);

        Neighborhood::create([
            'id' => 1655,
            'name' => 'Enrique Fynn',
            'city_id' => 522,
        ]);

        Neighborhood::create([
            'id' => 1656,
            'name' => 'General Las Heras',
            'city_id' => 522,
        ]);

        Neighborhood::create([
            'id' => 1657,
            'name' => 'Lozano',
            'city_id' => 522,
        ]);

        //General Lavalle

        Neighborhood::create([
            'id' => 1658,
            'name' => 'General Lavalle',
            'city_id' => 523,
        ]);

        Neighborhood::create([
            'id' => 1659,
            'name' => 'Chacras de Gral Lavalle',
            'city_id' => 523,
        ]);

        //General Madariaga

        Neighborhood::create([
            'id' => 1660,
            'name' => 'General Juan Madariaga',
            'city_id' => 524,
        ]);

        //General Paz

        Neighborhood::create([
            'id' => 1661,
            'name' => 'Ranchos',
            'city_id' => 525,
        ]);

        Neighborhood::create([
            'id' => 1662,
            'name' => 'Loma Verde',
            'city_id' => 525,
        ]);

        Neighborhood::create([
            'id' => 1663,
            'name' => 'Villanueva',
            'city_id' => 525,
        ]);

        Neighborhood::create([
            'id' => 1664,
            'name' => 'Barrío Río Salado',
            'city_id' => 525,
        ]);

        //General Pinto

        Neighborhood::create([
            'id' => 1665,
            'name' => 'General Pinto',
            'city_id' => 526,
        ]);

        //General Puerreydon

        Neighborhood::create([
            'id' => 1666,
            'name' => 'Barrío Los Acantilados',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1667,
            'name' => 'Sierra de los Padres',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1668,
            'name' => 'Las Margaritas',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1669,
            'name' => 'El Tejado',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1670,
            'name' => 'Barrio San Eduardo',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1671,
            'name' => 'Barrio 2 de Abril',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1672,
            'name' => 'Colinas Verdes',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1673,
            'name' => 'Colonia Barragán',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1674,
            'name' => 'El Coyunco',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1675,
            'name' => 'El Dorado',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1676,
            'name' => 'El Sosiego',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1677,
            'name' => 'Gloria de la Pelegrina',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1678,
            'name' => 'La Adela',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1679,
            'name' => 'Las Quintas',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1680,
            'name' => 'Loma Alta',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1681,
            'name' => 'Los Ortiz',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1682,
            'name' => 'Los Zorzales',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1683,
            'name' => 'San Francisco',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1684,
            'name' => 'Santa Angela',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1685,
            'name' => 'Santa Isabel',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1686,
            'name' => 'Santa Paula',
            'city_id' => 527,
        ]);

        Neighborhood::create([
            'id' => 1687,
            'name' => 'Valle Hermoso',
            'city_id' => 527,
        ]);

        //General Viamonte

        Neighborhood::create([
            'id' => 1688,
            'name' => 'Los Toldos',
            'city_id' => 528,
        ]);

        //General Villegas

        Neighborhood::create([
            'id' => 1689,
            'name' => 'Santa Regina',
            'city_id' => 529,
        ]);

        Neighborhood::create([
            'id' => 1690,
            'name' => 'General Villegas',
            'city_id' => 529,
        ]);

        //Guamini

        Neighborhood::create([
            'id' => 1691,
            'name' => 'Guamini',
            'city_id' => 530,
        ]);

        Neighborhood::create([
            'id' => 1692,
            'name' => 'Laguna Alsina',
            'city_id' => 530,
        ]);

        Neighborhood::create([
            'id' => 1693,
            'name' => 'Guaminí',
            'city_id' => 530,
        ]);

        Neighborhood::create([
            'id' => 1694,
            'name' => 'Casbas',
            'city_id' => 530,
        ]);

        //Guerrico

        Neighborhood::create([
            'id' => 1695,
            'name' => 'Pergamino',
            'city_id' => 531,
        ]);

        //Günther

        Neighborhood::create([
            'id' => 1697,
            'name' => 'Günther',
            'city_id' => 532,
        ]);

        //Hipólito Yrigoyen

        Neighborhood::create([
            'id' => 1698,
            'name' => 'Henderson',
            'city_id' => 533,
        ]);

        //Ingeniero Balbin

        Neighborhood::create([
            'id' => 1699,
            'name' => 'Ingeniero Balbín',
            'city_id' => 534,
        ]);

        //Ingeniero White

        Neighborhood::create([
            'id' => 1700,
            'name' => 'Ingeniero White',
            'city_id' => 535,
        ]);

        //Iriarte

        Neighborhood::create([
            'id' => 1701,
            'name' => 'Iriarte',
            'city_id' => 536,
        ]);

        //J A de la Peña

        Neighborhood::create([
            'id' => 1702,
            'name' => 'J A de la Peña',
            'city_id' => 537,
        ]);

        //José Santos Arévalo

        Neighborhood::create([
            'id' => 1703,
            'name' => 'José Santos Arévalo',
            'city_id' => 538,
        ]);

        //Juan Eulogio Barra

        Neighborhood::create([
            'id' => 1704,
            'name' => 'Juan Eulogio Barra',
            'city_id' => 539,
        ]);

        //Junín

        Neighborhood::create([
            'id' => 1705,
            'name' => 'Junín',
            'city_id' => 540,
        ]);

        //La Violeta

        Neighborhood::create([
            'id' => 1706,
            'name' => 'La Violeta',
            'city_id' => 541,
        ]);

        //Laguna de los Padres

        Neighborhood::create([
            'id' => 1707,
            'name' => 'Laguna de los Padres',
            'city_id' => 542,
        ]);

        //Laprida

        Neighborhood::create([
            'id' => 1708,
            'name' => 'Santa Elena',
            'city_id' => 543,
        ]);

        //Las Chacras

        Neighborhood::create([
            'id' => 1709,
            'name' => 'Las Chacras',
            'city_id' => 544,
        ]);

        //Las Flores

        Neighborhood::create([
            'id' => 1710,
            'name' => 'Las Flores',
            'city_id' => 545,
        ]);

        Neighborhood::create([
            'id' => 1711,
            'name' => 'Rosas',
            'city_id' => 545,
        ]);

        Neighborhood::create([
            'id' => 1712,
            'name' => 'Pardo',
            'city_id' => 545,
        ]);

        Neighborhood::create([
            'id' => 1713,
            'name' => 'El Gualichu',
            'city_id' => 545,
        ]);

        //Leandro N Alem

        Neighborhood::create([
            'id' => 1714,
            'name' => 'Vedia',
            'city_id' => 546,
        ]);

        Neighborhood::create([
            'id' => 1715,
            'name' => 'Juan Bautista Alberdi',
            'city_id' => 546,
        ]);

        //Lezama

        Neighborhood::create([
            'id' => 1716,
            'name' => 'Lezama',
            'city_id' => 547,
        ]);

        //Lincoln

        Neighborhood::create([
            'id' => 1717,
            'name' => 'Lincoln',
            'city_id' => 548,
        ]);

        Neighborhood::create([
            'id' => 1718,
            'name' => 'Pasteur',
            'city_id' => 548,
        ]);

        Neighborhood::create([
            'id' => 1719,
            'name' => 'Bermúdez',
            'city_id' => 548,
        ]);

        Neighborhood::create([
            'id' => 1720,
            'name' => 'Roberts',
            'city_id' => 548,
        ]);

        Neighborhood::create([
            'id' => 1721,
            'name' => 'Carlos Salas',
            'city_id' => 548,
        ]);

        Neighborhood::create([
            'id' => 1722,
            'name' => 'Arenaza',
            'city_id' => 548,
        ]);

        Neighborhood::create([
            'id' => 1723,
            'name' => 'Balsa',
            'city_id' => 548,
        ]);

        Neighborhood::create([
            'id' => 1724,
            'name' => 'Bayauca',
            'city_id' => 548,
        ]);

        Neighborhood::create([
            'id' => 1725,
            'name' => 'Coronel Matínez de Hoz',
            'city_id' => 548,
        ]);


        Neighborhood::create([
            'id' => 1726,
            'name' => 'Fortín Vigilancia',
            'city_id' => 548,
        ]);

        Neighborhood::create([
            'id' => 1727,
            'name' => 'Las Toscas',
            'city_id' => 548,
        ]);

        Neighborhood::create([
            'id' => 1728,
            'name' => 'Triunvirato',
            'city_id' => 548,
        ]);

        //Lobería

        Neighborhood::create([
            'id' => 1729,
            'name' => 'Lobería',
            'city_id' => 549,
        ]);



        Neighborhood::create([
            'id' => 1731,
            'name' => 'El Moro',
            'city_id' => 549,
        ]);

        //Los Toldos

        Neighborhood::create([
            'id' => 1732,
            'name' => 'Los Toldos',
            'city_id' => 550,
        ]);

        //Los Ángeles

        Neighborhood::create([
            'id' => 1733,
            'name' => 'Los Ángeles',
            'city_id' => 551,
        ]);

        //M Benitez

        Neighborhood::create([
            'id' => 1734,
            'name' => 'M Benitez',
            'city_id' => 552,
        ]);

        //Magdalena

        Neighborhood::create([
            'id' => 1735,
            'name' => 'Magdalena',
            'city_id' => 553,
        ]);

        Neighborhood::create([
            'id' => 1736,
            'name' => 'General Mansilla',
            'city_id' => 553,
        ]);

        Neighborhood::create([
            'id' => 1737,
            'name' => 'Los Naranjos',
            'city_id' => 553,
        ]);

        Neighborhood::create([
            'id' => 1738,
            'name' => 'Vieytes',
            'city_id' => 553,
        ]);

        Neighborhood::create([
            'id' => 1739,
            'name' => 'Atalaya',
            'city_id' => 553,
        ]);

        Neighborhood::create([
            'id' => 1740,
            'name' => 'Arditi',
            'city_id' => 553,
        ]);

        Neighborhood::create([
            'id' => 1741,
            'name' => 'Empalme',
            'city_id' => 553,
        ]);

        Neighborhood::create([
            'id' => 1742,
            'name' => 'Roberto J Payró',
            'city_id' => 553,
        ]);

        //Maguirre

        Neighborhood::create([
            'id' => 1743,
            'name' => 'Maguirre',
            'city_id' => 554,
        ]);

        //Maipú

        Neighborhood::create([
            'id' => 1744,
            'name' => 'Maipú',
            'city_id' => 555,
        ]);

        Neighborhood::create([
            'id' => 1745,
            'name' => 'Las Armas',
            'city_id' => 555,
        ]);

        //Mar Chiquita

        Neighborhood::create([
            'id' => 1746,
            'name' => 'La Caleta',
            'city_id' => 556,
        ]);

        Neighborhood::create([
            'id' => 1747,
            'name' => 'La Armonía',
            'city_id' => 556,
        ]);

        Neighborhood::create([
            'id' => 1748,
            'name' => 'Camet Norte',
            'city_id' => 556,
        ]);
        Neighborhood::create([
            'id' =>1749,
            'name' => 'Coronel Vidal',
            'city_id' => 556,
        ]);
        Neighborhood::create([
            'id' => 1750,
            'name' => 'Calfucurá',
            'city_id' => 556,
        ]);
        Neighborhood::create([
            'id' => 1751,
            'name' => 'Frente Mar',
            'city_id' => 556,
        ]);

        Neighborhood::create([
            'id' => 1752,
            'name' => 'La Baliza',
            'city_id' => 556,
        ]);

        Neighborhood::create([
            'id' => 1753,
            'name' => 'Nahuel Rucá',
            'city_id' => 556,
        ]);

        Neighborhood::create([
            'id' => 1754,
            'name' => 'Parque Mar Chiquita',
            'city_id' => 556,
        ]);

        Neighborhood::create([
            'id' => 1755,
            'name' => 'Vivoratá',
            'city_id' => 556,
        ]);

        //Mechongue

        Neighborhood::create([
            'id' => 1756,
            'name' => 'Mechongué',
            'city_id' => 557,
        ]);

        //Membrillar

        Neighborhood::create([
            'id' => 1757,
            'name' => 'Membrillar',
            'city_id' => 558,
        ]);

        //Mercedes

        Neighborhood::create([
            'id' => 1758,
            'name' => 'Mercedes',
            'city_id' => 559,
        ]);

        Neighborhood::create([
            'id' => 1759,
            'name' => 'Altos de Mercedes',
            'city_id' => 559,
        ]);

        Neighborhood::create([
            'id' => 1760,
            'name' => 'Chacras de Mercedes',
            'city_id' => 559,
        ]);

        Neighborhood::create([
            'id' => 1761,
            'name' => 'Tomas Jofre',
            'city_id' => 559,
        ]);

        //Navarro

        Neighborhood::create([
            'id' => 1762,
            'name' => 'Navarro',
            'city_id' => 560,
        ]);

        Neighborhood::create([
            'id' => 1763,
            'name' => 'Las Marianas',
            'city_id' => 560,
        ]);

        //Norberto de la Riestra

        Neighborhood::create([
            'id' => 1764,
            'name' => 'Norberto de la Riestra',
            'city_id' => 561,
        ]);

        // Nueve de Julio

        Neighborhood::create([
            'id' => 1765,
            'name' => 'Nueve de Julio',
            'city_id' => 562,
        ]);

        Neighborhood::create([
            'id' => 1766,
            'name' => 'Villa General Fournier',
            'city_id' => 562,
        ]);

        //Ocampo

        Neighborhood::create([
            'id' => 1767,
            'name' => 'Ocampo',
            'city_id' => 563,
        ]);

        //Ortiz Basualdo

        Neighborhood::create([
            'id' => 1768,
            'name' => 'Ortiz Basualdo',
            'city_id' => 565,
        ]);

        //Pavón

        Neighborhood::create([
            'id' => 1769,
            'name' => 'Pavón',
            'city_id' => 566,
        ]);

        //Pazos Kanki

        Neighborhood::create([
            'id' => 1770,
            'name' => 'Pazos Kanki',
            'city_id' => 567,
        ]);

        //Pedernales

        Neighborhood::create([
            'id' => 1771,
            'name' => 'Pedernales',
            'city_id' => 568,
        ]);

        //Pedro Luro

        Neighborhood::create([
            'id' => 1772,
            'name' => 'Pedro Luro',
            'city_id' => 569,
        ]);

        //Pehuajó

        Neighborhood::create([
            'id' => 1773,
            'name' => 'Pehuajó',
            'city_id' => 570,
        ]);

        Neighborhood::create([
            'id' => 1774,
            'name' => 'Juan José Paso',
            'city_id' => 570,
        ]);

        Neighborhood::create([
            'id' => 1775,
            'name' => 'Francisco Madero',
            'city_id' => 570,
        ]);

        //Pellegrini

        Neighborhood::create([
            'id' => 1776,
            'name' => 'Pellegrini',
            'city_id' => 571,
        ]);

        Neighborhood::create([
            'id' => 1777,
            'name' => 'Bocayuva',
            'city_id' => 571,
        ]);

        //Pergamino

        Neighborhood::create([
            'id' => 1778,
            'name' => 'Pergamino',
            'city_id' => 572,
        ]);

        //Pieres

        Neighborhood::create([
            'id' => 1779,
            'name' => 'Pieres',
            'city_id' => 573,
        ]);

        //Pigüé

        Neighborhood::create([
            'id' => 1780,
            'name' => 'Pigüé',
            'city_id' => 574,
        ]);

        //Pila

        Neighborhood::create([
            'id' => 1781,
            'name' => 'Pila',
            'city_id' => 575,
        ]);

        Neighborhood::create([
            'id' => 1782,
            'name' => 'Real Audiencia',
            'city_id' => 575,
        ]);

        Neighborhood::create([
            'id' => 1783,
            'name' => 'Casalins',
            'city_id' => 575,
        ]);

        //Pinzón

        Neighborhood::create([
            'id' => 1784,
            'name' => 'Pinzón',
            'city_id' => 576,
        ]);

        //Puan

        Neighborhood::create([
            'id' => 1785,
            'name' => 'Puan',
            'city_id' => 577,
        ]);

        Neighborhood::create([
            'id' => 1786,
            'name' => 'Darregueira',
            'city_id' => 577,
        ]);

        //Punta Indio

        Neighborhood::create([
            'id' => 1787,
            'name' => 'Verónica',
            'city_id' => 578,
        ]);

        Neighborhood::create([
            'id' => 1788,
            'name' => 'Punta del Indio',
            'city_id' => 578,
        ]);

        Neighborhood::create([
            'id' => 1789,
            'name' => 'Las Tahonas',
            'city_id' => 578,
        ]);

        Neighborhood::create([
            'id' => 1790,
            'name' => 'Pipinas',
            'city_id' => 578,
        ]);

        Neighborhood::create([
            'id' => 1791,
            'name' => 'Álvarez Jonte',
            'city_id' => 578,
        ]);

        Neighborhood::create([
            'id' => 1792,
            'name' => 'Monte Veloz',
            'city_id' => 578,
        ]);

        //Ramallo

        Neighborhood::create([
            'id' => 1793,
            'name' => 'Ramallo',
            'city_id' => 579,
        ]);

        Neighborhood::create([
            'id' => 1794,
            'name' => 'Villa Ramallo',
            'city_id' => 579,
        ]);

        Neighborhood::create([
            'id' => 1795,
            'name' => 'El Paraíso',
            'city_id' => 579,
        ]);

        Neighborhood::create([
            'id' => 1796,
            'name' => 'Pérez Millán',
            'city_id' => 579,
        ]);

        //Rancagua

        Neighborhood::create([
            'id' => 1797,
            'name' => 'Rancagua',
            'city_id' => 580,
        ]);

        //Ranchos

        Neighborhood::create([
            'id' => 1798,
            'name' => 'Ranchos',
            'city_id' => 581,
        ]);

        //Rauch

        Neighborhood::create([
            'id' => 1799,
            'name' => 'Rauch',
            'city_id' => 582,
        ]);

        //Rivadavia

        Neighborhood::create([
            'id' => 1800,
            'name' => 'Fortín Olavarria',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1801,
            'name' => 'Gonzalez Moreno',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1802,
            'name' => 'Roosevelt',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1803,
            'name' => 'Parajes',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1804,
            'name' => 'América',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1805,
            'name' => 'Badano',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1806,
            'name' => 'Cerrito',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1807,
            'name' => 'Condarco',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1808,
            'name' => 'Mira Pampa',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1809,
            'name' => 'San Mauricio',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1810,
            'name' => 'Sansinena',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1811,
            'name' => 'Sundblad',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1812,
            'name' => 'Vadano',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1813,
            'name' => 'Valentín Gómez',
            'city_id' => 583,
        ]);

        Neighborhood::create([
            'id' => 1814,
            'name' => 'Villa Sena',
            'city_id' => 583,
        ]);

        //Rojas

        Neighborhood::create([
            'id' => 1815,
            'name' => 'Rojas',
            'city_id' => 584,
        ]);

        Neighborhood::create([
            'id' => 1816,
            'name' => 'Rafael Obligado',
            'city_id' => 584,
        ]);

        Neighborhood::create([
            'id' => 1817,
            'name' => 'Roberto Cano',
            'city_id' => 584,
        ]);

        Neighborhood::create([
            'id' => 1818,
            'name' => 'Villa Manuel Pomar',
            'city_id' => 584,
        ]);

        Neighborhood::create([
            'id' => 1819,
            'name' => 'Guido Spano',
            'city_id' => 584,
        ]);

        Neighborhood::create([
            'id' => 1820,
            'name' => 'Hunter',
            'city_id' => 584,
        ]);

        Neighborhood::create([
            'id' => 1821,
            'name' => 'La Beba',
            'city_id' => 584,
        ]);

        Neighborhood::create([
            'id' => 1822,
            'name' => 'Los Indios',
            'city_id' => 584,
        ]);

        Neighborhood::create([
            'id' => 1823,
            'name' => 'Sol de Mayo',
            'city_id' => 584,
        ]);

        //Roque Pérez

        Neighborhood::create([
            'id' => 1824,
            'name' => 'Roque Pérez',
            'city_id' => 585,
        ]);

        Neighborhood::create([
            'id' => 1825,
            'name' => 'Carlos Beguerie',
            'city_id' => 585,
        ]);

        //Saavedra

        Neighborhood::create([
            'id' => 1826,
            'name' => 'Saavedra',
            'city_id' => 586,
        ]);

        Neighborhood::create([
            'id' => 1827,
            'name' => 'Pigüé',
            'city_id' => 586,
        ]);

        //Saladillo

        Neighborhood::create([
            'id' => 1828,
            'name' => 'Saladillo',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1829,
            'name' => 'Álvarez de Toledo',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1830,
            'name' => 'Del Carril',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1831,
            'name' => 'Cazón',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1832,
            'name' => 'Saladillo Norte',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1833,
            'name' => 'El Mangrullo',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1834,
            'name' => 'Emiliano Reynoso',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1835,
            'name' => 'Esther',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1836,
            'name' => 'Gobernador Ortiz de Rosas',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1837,
            'name' => 'José R Sojo',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1838,
            'name' => 'Juan José Blaquier',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1839,
            'name' => 'La Barrancosa',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1840,
            'name' => 'La Campana',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1841,
            'name' => 'La Margarita',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1842,
            'name' => 'La Mascota',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1843,
            'name' => 'La Razón',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1844,
            'name' => 'Polvaderas',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1845,
            'name' => 'San Benito',
            'city_id' => 587,
        ]);

        Neighborhood::create([
            'id' => 1846,
            'name' => 'San Blas',
            'city_id' => 587,
        ]);

        //Salliqueló

        Neighborhood::create([
            'id' => 1847,
            'name' => 'Salliqueló',
            'city_id' => 588,
        ]);

        //Saltó

        Neighborhood::create([
            'id' => 1848,
            'name' => 'Salto',
            'city_id' => 589,
        ]);

        Neighborhood::create([
            'id' => 1849,
            'name' => 'Gahan ',
            'city_id' => 589,
        ]);

        Neighborhood::create([
            'id' => 1850,
            'name' => 'Arroyo Dulce',
            'city_id' => 589,
        ]);

        Neighborhood::create([
            'id' => 1851,
            'name' => 'La Invencible',
            'city_id' => 589,
        ]);

        Neighborhood::create([
            'id' => 1852,
            'name' => 'Berdier',
            'city_id' => 589,
        ]);

        Neighborhood::create([
            'id' => 1853,
            'name' => 'Coronel Isleño',
            'city_id' => 589,
        ]);

        Neighborhood::create([
            'id' => 1854,
            'name' => 'Inés indart',
            'city_id' => 589,
        ]);

        Neighborhood::create([
            'id' => 1855,
            'name' => 'Monroe',
            'city_id' => 589,
        ]);

        //San Andrés de Giles

        Neighborhood::create([
            'id' => 1856,
            'name' => 'San Andrés de Giles ',
            'city_id' => 590,
        ]);

        Neighborhood::create([
            'id' => 1857,
            'name' => 'Cucullú',
            'city_id' => 589,
        ]);

        Neighborhood::create([
            'id' => 1858,
            'name' => 'Solís',
            'city_id' => 590,
        ]);

        Neighborhood::create([
            'id' => 1859,
            'name' => 'Villa Ruiz',
            'city_id' => 590,
        ]);



        Neighborhood::create([
            'id' => 1860,
            'name' => 'Azcuénaga',
            'city_id' => 590,
        ]);

        Neighborhood::create([
            'id' => 1861,
            'name' => 'Barrio El Candil',
            'city_id' => 590,
        ]);

        Neighborhood::create([
            'id' => 1862,
            'name' => 'Chacras de San Andrés',
            'city_id' => 590,
        ]);

        Neighborhood::create([
            'id' => 1863,
            'name' => 'El Cóndor',
            'city_id' => 590,
        ]);

        //San Antonio de Areco

        Neighborhood::create([
            'id' => 1864,
            'name' => 'San Antonio de Areco',
            'city_id' => 591,
        ]);

        Neighborhood::create([
            'id' => 1865,
            'name' => 'Villa Lía',
            'city_id' => 591,
        ]);

        Neighborhood::create([
            'id' => 1866,
            'name' => 'Duggan',
            'city_id' => 591,
        ]);

        Neighborhood::create([
            'id' => 1867,
            'name' => 'Paraje Vagues',
            'city_id' => 591,
        ]);

        //San Cayetano

        Neighborhood::create([
            'id' => 1868,
            'name' => 'San Cayetano',
            'city_id' => 592,
        ]);

        //San Miguel Monte

        Neighborhood::create([
            'id' => 1869,
            'name' => 'Estancia Benquerencia',
            'city_id' => 593,
        ]);

        Neighborhood::create([
            'id' => 1870,
            'name' => 'San Miguel del Monte',
            'city_id' => 593,
        ]);

        Neighborhood::create([
            'id' => 1871,
            'name' => 'Chacras de Abbot',
            'city_id' => 593,
        ]);

        Neighborhood::create([
            'id' => 1872,
            'name' => 'Abbot',
            'city_id' => 593,
        ]);

        Neighborhood::create([
            'id' => 1873,
            'name' => 'Zona Rural',
            'city_id' => 593,
        ]);

        Neighborhood::create([
            'id' => 1874,
            'name' => 'Chacras de San Pablo',
            'city_id' => 593,
        ]);

        Neighborhood::create([
            'id' => 1875,
            'name' => 'San Humberto',
            'city_id' => 593,
        ]);

        Neighborhood::create([
            'id' => 1876,
            'name' => 'Zenón Videla Dorna, 64 hab',
            'city_id' => 593,
        ]);

        //San Nicolas de los Arroyos

        Neighborhood::create([
            'id' => 1877,
            'name' => 'San Nicolás de los Arroyos',
            'city_id' => 594,
        ]);

        Neighborhood::create([
            'id' => 1878,
            'name' => 'Campos Salles',
            'city_id' => 594,
        ]);

        //San Pedro

        Neighborhood::create([
            'id' => 1879,
            'name' => 'San Pedro',
            'city_id' => 595,
        ]);

        Neighborhood::create([
            'id' => 1880,
            'name' => 'Gobernador Castro',
            'city_id' => 595,
        ]);

        Neighborhood::create([
            'id' => 1881,
            'name' => 'Santa Lucía',
            'city_id' => 595,
        ]);

        Neighborhood::create([
            'id' => 1882,
            'name' => 'Río Tala',
            'city_id' => 595,
        ]);

        Neighborhood::create([
            'id' => 1883,
            'name' => 'Obligado',
            'city_id' => 596,
        ]);

        Neighborhood::create([
            'id' => 1884,
            'name' => 'Apart Club San Pedro',
            'city_id' => 596,
        ]);

        Neighborhood::create([
            'id' => 1885,
            'name' => 'Beladrich',
            'city_id' => 596,
        ]);

        Neighborhood::create([
            'id' => 1886,
            'name' => 'Colonia Vélaz',
            'city_id' => 596,
        ]);

        Neighborhood::create([
            'id' => 1887,
            'name' => 'Ingeniero Moneta',
            'city_id' => 596,
        ]);

        Neighborhood::create([
            'id' => 1888,
            'name' => 'La Buena Moza',
            'city_id' => 596,
        ]);

        Neighborhood::create([
            'id' => 1889,
            'name' => 'Pueblo Doyle',
            'city_id' => 596,
        ]);

        //Suipacha

        Neighborhood::create([
            'id' => 1890,
            'name' => 'Suipacha',
            'city_id' => 597,
        ]);

        //Tapalque

        Neighborhood::create([
            'id' => 1891,
            'name' => 'Tapalqué',
            'city_id' => 598,
        ]);

        //Tordillo

        Neighborhood::create([
            'id' => 1892,
            'name' => 'Tordillo',
            'city_id' => 599,
        ]);

        //Torquinst

        Neighborhood::create([
            'id' => 1893,
            'name' => 'Sierra de la Ventana ',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1894,
            'name' => 'Saldungaray ',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1895,
            'name' => 'Villa Ventana ',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1896,
            'name' => 'Tornquist',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1897,
            'name' => 'Chasicó ',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1898,
            'name' => 'Berraondo ',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1899,
            'name' => 'Choique',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1900,
            'name' => 'Estomba',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1901,
            'name' => 'García del Río',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1902,
            'name' => 'Las Verbenas ',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1903,
            'name' => 'Nueva Roma',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1904,
            'name' => 'Parque Cerro Ceferino ',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1905,
            'name' => 'Pelicura',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1906,
            'name' => 'Tres Picos',
            'city_id' => 600,
        ]);

        Neighborhood::create([
            'id' => 1907,
            'name' => 'Villa Serrana La Gruta',
            'city_id' => 600,
        ]);

       //Trenque Lauquen

         Neighborhood::create([
            'id' => 1908,
            'name' => 'Trenque Lauquen',
            'city_id' => 601,
        ]);

        Neighborhood::create([
            'id' => 1909,
            'name' => 'Beruti',
            'city_id' => 601,
        ]);

        Neighborhood::create([
            'id' => 1910,
            'name' => 'Treinta de Agosto',
            'city_id' => 601,
        ]);

        Neighborhood::create([
            'id' => 1911,
            'name' => 'Girodias',
            'city_id' => 601,
        ]);

        //Tres Arroyos

        Neighborhood::create([
            'id' => 1912,
            'name' => 'Tres Arroyos',
            'city_id' => 602,
        ]);

        Neighborhood::create([
            'id' => 1913,
            'name' => 'Copetonas ',
            'city_id' => 602,
        ]);

        Neighborhood::create([
            'id' => 1914,
            'name' => 'Orense',
            'city_id' => 602,
        ]);

        Neighborhood::create([
            'id' => 1915,
            'name' => 'Micaela Cascallares',
            'city_id' => 602,
        ]);

        //Tres Lomas


        Neighborhood::create([
            'id' => 1916,
            'name' => 'Tres Lomas',
            'city_id' => 603,
        ]);

        //Tres Picos

        Neighborhood::create([
            'id' => 1917,
            'name' => 'Tres Picos',
            'city_id' => 604,
        ]);

        //Tres Sargentos

        Neighborhood::create([
            'id' => 1918,
            'name' => 'Tres Sargentos',
            'city_id' => 605,
        ]);

        //Urdampilleta

        Neighborhood::create([
            'id' => 1919,
            'name' => 'Urdampilleta',
            'city_id' => 606,
        ]);

        //Urquiza

        Neighborhood::create([
            'id' => 1920,
            'name' => 'Urquiza',
            'city_id' => 607,
        ]);

        //Veinticinco de Mayo

        Neighborhood::create([
            'id' => 1921,
            'name' => 'Del Valle',
            'city_id' => 608,
        ]);

        Neighborhood::create([
            'id' => 1922,
            'name' => 'Veinticinco de Mayo ',
            'city_id' => 608,
        ]);

        Neighborhood::create([
            'id' => 1923,
            'name' => 'San Enrique',
            'city_id' => 608,
        ]);

        Neighborhood::create([
            'id' => 1924,
            'name' => 'Valdés ',
            'city_id' => 608,
        ]);

        //Venado Tuerto

        Neighborhood::create([
            'id' => 1925,
            'name' => 'Venado Tuerto',
            'city_id' => 609,
        ]);

        //Villa General Salvio

        Neighborhood::create([
            'id' => 1926,
            'name' => 'Villa General Salvio',
            'city_id' => 610,
        ]);

        //Villa Ramallo

        Neighborhood::create([
            'id' => 1927,
            'name' => 'Villa Ramallo',
            'city_id' => 611,
        ]);

        //Villalonga

        Neighborhood::create([
            'id' => 1928,
            'name' => 'Villalonga',
            'city_id' => 612,
        ]);

        //Villarino

        Neighborhood::create([
            'id' => 1929,
            'name' => 'Médanos',
            'city_id' => 613,
        ]);

        Neighborhood::create([
            'id' => 1930,
            'name' => 'Mayor Buratovich ',
            'city_id' => 613,
        ]);

        Neighborhood::create([
            'id' => 1931                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ,
            'name' => 'Argerich',
            'city_id' => 613,
        ]);

        Neighborhood::create([
            'id' => 1932,
            'name' => 'Hilario Ascasubi ',
            'city_id' => 613,
        ]);

        Neighborhood::create([
            'id' => 1933,
            'name' => 'Pedro Luro',
            'city_id' => 613,
        ]);

        Neighborhood::create([
            'id' => 1934,
            'name' => 'Colonia San Adolfo ',
            'city_id' => 613,
        ]);

        Neighborhood::create([
            'id' => 1935,
            'name' => 'Juan Cousté',
            'city_id' => 613,
        ]);

        Neighborhood::create([
            'id' => 1936,
            'name' => 'Laguna Chasicó ',
            'city_id' => 613,
        ]);

        Neighborhood::create([
            'id' => 1937,
            'name' => 'Teniente Origone',
            'city_id' => 613,
        ]);

        //Zapiola

        Neighborhood::create([
            'id' => 1938,
            'name' => 'Zapiola',
            'city_id' => 614,
        ]);

        //Mar del Plata

        Neighborhood::create([
            'id' => 1939,
            'name' => 'Centro',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1940,
            'name' => 'La Perla',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1941,
            'name' => 'Chauvín',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1942,
            'name' => 'Güemes ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1943,
            'name' => 'Plaza Colón',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1944,
            'name' => '2 de Abril ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1945,
            'name' => 'Alem',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1946,
            'name' => 'Alfar',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1947,
            'name' => 'Ameghino Florentino',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1948,
            'name' => 'Antártida Argentina',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1949,
            'name' => 'Arenas del Sur',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1950,
            'name' => 'Arroyo Chapadmalal',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1951,
            'name' => 'Autódromo',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1952,
            'name' => 'Bajos de Anchorena ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1953,
            'name' => 'Barrio 9 de Julio',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1955,
            'name' => 'Barrio Aeroparque',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1956,
            'name' => 'Barrio Alto Camet',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1957,
            'name' => 'Barrio Alvarado ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1958,
            'name' => 'Barrio Belisario Roldán',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1959,
            'name' => 'Barrio Camet ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1960,
            'name' => 'Barrio Ciento Ochenta',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1961,
            'name' => 'Barrio el Jardin',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1962,
            'name' => 'Barrio EL Martillo',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1963,
            'name' => 'Barrio El Progreso ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1964,
            'name' => 'Barrio el Sosiego',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1965,
            'name' => 'Barrio Etchepare ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1966,
            'name' => 'Barrio Fortunato de La Plaza',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1967,
            'name' => 'Barrio Jorge Newberry ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1968,
            'name' => 'Barrio La Armonía',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1969,
            'name' => 'Barrio La Florida',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1970,
            'name' => 'Barrio La Juanita',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1971,
            'name' => 'Barrio la Perla Norte ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1972,
            'name' => 'Barrio Las Farolas',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1973,
            'name' => 'Barrio las Lilas ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1974,
            'name' => 'Barrio Las Margaritas',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1975,
            'name' => 'Barrio Libertad',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1976,
            'name' => 'Barrio Lomas de Santa Cecilia',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1977,
            'name' => 'Barrio Los Tilos ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1978,
            'name' => 'Barrio López de Gomara',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1979,
            'name' => 'Barrio Ostende ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1980,
            'name' => 'Barrio San Jose',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1981,
            'name' => 'Barrio San Juan',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1982,
            'name' => 'Barrio San Julian',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1983,
            'name' => 'Barrio San Salvador',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1984,
            'name' => 'Barrio Santa Celina',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1985,
            'name' => 'Barrio Santa Isabel',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1986,
            'name' => 'Barrio Santa Mónica',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1987,
            'name' => 'Barrio Santa Rita',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1988,
            'name' => 'Barrio Sarmiento',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1989,
            'name' => 'Barrio Zacagnini',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1990,
            'name' => 'Batán',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1991,
            'name' => 'Bernardino Rivadavia',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1992,
            'name' => 'Bosque Alegre',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1993,
            'name' => 'Bosque Grande',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1995,
            'name' => 'Bosque Peralta Ramos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1996,
            'name' => 'Barrio San Jose',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1997,
            'name' => 'Cabo Corrientes',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1998,
            'name' => 'Caisamar',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 1999,
            'name' => 'Camino A Necochea',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' =>2000,
            'name' => 'Caribe',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2001,
            'name' => 'Cerrito',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2002,
            'name' => 'Cerrito Sur',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2003,
            'name' => 'Cerrito y San Salvador',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2004,
            'name' => 'Chapadmalal',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2005,
            'name' => 'Colina Alegre',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2006,
            'name' => 'Colina de Peralta Ramos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2007,
            'name' => 'Colonia Barragan',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2008,
            'name' => 'Constitución',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2009,
            'name' => 'Coronel Dorrego',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2010,
            'name' => 'De La Plaza Fortunato',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2011,
            'name' => 'De Las Heras Juan Gregorio',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2012,
            'name' => 'Del Puerto',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2013,
            'name' => 'Divino Rostro',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2014,
            'name' => 'Barrio San Jose',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2015,
            'name' => 'Dos Bosco',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2016,
            'name' => 'Don Emilio',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2017,
            'name' => 'El Boqueron',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2018,
            'name' => 'El Colmenar',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2019,
            'name' => 'El Gaucho',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2020,
            'name' => 'El Jardin De Peralta ',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2021,
            'name' => 'El Jardin de Peralta Ramos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2022,
            'name' => 'El Jardín de Stella Maris',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2023,
            'name' => 'El Marquesado',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2024,
            'name' => 'Estacion Norte',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2025,
            'name' => 'Estacón Camet',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2026,
            'name' => 'Estación Chapadmalal',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2027,
            'name' => 'Estacíon Ferroautomotora',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2028,
            'name' => 'Estación Terminal',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2029,
            'name' => 'Estrada',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2030,
            'name' => 'Estrada Jose Manuel',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2031,
            'name' => 'Faro Norte',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2032,
            'name' => 'Felix U Camet',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2033,
            'name' => 'Fray Luis Beltran',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2034,
            'name' => 'Funes y San Lorenzo',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2035,
            'name' => 'General Belgrano',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2036,
            'name' => 'General Pueyrredón',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2037,
            'name' => 'General Roca',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2038,
            'name' => 'General San Martin',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2039,
            'name' => 'Gral San Martin',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2040,
            'name' => 'Grosellar',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2041,
            'name' => 'Hermitage',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2042,
            'name' => 'Hipodromo',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2043,
            'name' => 'José Hernández' ,
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2044,
            'name' => 'Juramento',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2045,
            'name' => 'La Germana',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2046,
            'name' => 'La Gloria de la Peregrina',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2047,
            'name' => 'La Herradura',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2048,
            'name' => 'La Peregrina',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2049,
            'name' => 'La Trinidad',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2050,
            'name' => 'Las Americas',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2051,
            'name' => 'Las Avenidas',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2052,
            'name' => 'Las Canteras',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2053,
            'name' => 'Las Dalias',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2054,
            'name' => 'Las Retamas',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2055,
            'name' => 'Leandro N Alem',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2056,
            'name' => 'Lomas de Batan',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2057,
            'name' => 'Lomas Del Golf',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2058,
            'name' => 'Los Acantilados',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2059,
            'name' => 'Los Andes',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2060,
            'name' => 'Los Pinares',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2061,
            'name' => 'Los Troncos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2062,
            'name' => 'Macrocentro',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2063,
            'name' => 'Malvinas Argentinas',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2064,
            'name' => 'Mataderos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2065,
            'name' => 'Materno',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2066,
            'name' => 'Montemar',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2067,
            'name' => 'Mundialista',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2068,
            'name' => 'Nueva Pompeya',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2069,
            'name' => 'Nuevo Golf',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2070,
            'name' => 'Parque Camet',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2071,
            'name' => 'Parque El Casal',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2072,
            'name' => 'Parque Hermoso y Valle Hermoso',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2073,
            'name' => 'Parque Independencia',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2074,
            'name' => 'Parque Industrial',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2075,
            'name' => 'Parque Lago',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2076,
            'name' => 'Parque Luro',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2077,
            'name' => 'Parque Montemar - El Grosellar',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2078,
            'name' => 'Parque Palermo',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2099,
            'name' => 'Parque Peña',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2100,
            'name' => 'Peralta Ramos Oeste',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2101,
            'name' => 'Pinos de Anchorena',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2102,
            'name' => 'Playa Chapadmalal',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2103,
            'name' => 'Playa Chica',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2104,
            'name' => 'Playa Grande',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2105,
            'name' => 'Playa Los Lobos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2106,
            'name' => 'Playa Varese',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2107,
            'name' => 'Plaza Mitre',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2108,
            'name' => 'Plaza Peralta Ramos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2109,
            'name' => 'Plaza Peralta Ramos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2110,
            'name' => 'Plaza Rocha',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2111,
            'name' => 'Pompeya',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2112,
            'name' => 'Primera Junta',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2113,
            'name' => 'Puerto',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2114,
            'name' => 'Punta Iglesia',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2115,
            'name' => 'Punta Mogotes',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2116,
            'name' => 'Quebrada de Peralta Ramos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2117,
            'name' => 'Regional',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2118,
            'name' => 'Rivadavia Bernardino',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2119,
            'name' => 'Roldán Belisario',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2120,
            'name' => 'Rumencó Los Álamos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2121,
            'name' => 'San Antonio',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2122,
            'name' => 'San Carlos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2123,
            'name' => 'San Cayetano',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2124,
            'name' => 'San Eduardo de Chapadmalal',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2125,
            'name' => 'San Eduardo del Mar',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2126,
            'name' => 'San Jacinto',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2127,
            'name' => 'San Jorge',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2128,
            'name' => 'San José',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2129,
            'name' => 'San Juan',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2130,
            'name' => 'San Patricio',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2131,
            'name' => 'Santa Cecilia',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2132,
            'name' => 'Santa Paula',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2133,
            'name' => 'Santa Rosa De Lima',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2134,
            'name' => 'San Rosa del Mar',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2135,
            'name' => 'Sata Rosa del Mar de Peralta Ramos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2136,
            'name' => 'Shopping Los Gallegos',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2137,
            'name' => 'Sierra de los Padres',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2138,
            'name' => 'Sociego',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2139,
            'name' => 'Stella Maris',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2140,
            'name' => 'Sánchez Florencio',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2141,
            'name' => 'Termas Huinco',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2142,
            'name' => 'Terminal Nueva',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2143,
            'name' => 'Torreón',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2144,
            'name' => 'Tribunales',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2145,
            'name' => 'Villa Lourdes',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2146,
            'name' => 'Villa Primera',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2147,
            'name' => 'Villa Serrana',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2148,
            'name' => 'Virgen de Luján',
            'city_id' => 615,
        ]);

        Neighborhood::create([
            'id' => 2149,
            'name' => 'Área Centro',
            'city_id' => 615,
        ]);

        //Pinamar

        Neighborhood::create([
            'id' => 2150,
            'name' => 'Centro',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2151,
            'name' => 'La Herradura',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2152,
            'name' => 'Zona Duplex',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2153,
            'name' => 'Centro Playa',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2154,
            'name' => 'Norte Playa',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2155,
            'name' => 'Alamos',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2156,
            'name' => 'Alamos II',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2157,
            'name' => 'Aromos',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2158,
            'name' => 'Balneario CR',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2159,
            'name' => 'Barrio Cerrado Pinamar Norte',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2160,
            'name' => 'Barrio Cerrado Terrazas al Golf',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2161,
            'name' => 'Barrio Obrero',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2162,
            'name' => 'Bosques',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2163,
            'name' => 'Bunge Oeste',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2164,
            'name' => 'Centro-Golf',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2165,
            'name' => 'Golf Viejo',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2166,
            'name' => 'La Frontera',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2167,
            'name' => 'Lasalle',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2168,
            'name' => 'Linea de Mar (N)',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2169,
            'name' => 'Linea de Mar (S)',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2170,
            'name' => 'Mar de Ostende',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2171,
            'name' => 'Nayades I',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2172,
            'name' => 'Nayades II',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2173,
            'name' => 'Norte Tennis Ranch',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2174,
            'name' => 'Penelope',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2175,
            'name' => 'Pinamar Chico',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2176,
            'name' => 'Punta Médanos Pueblo Marítimo',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2177,
            'name' => 'Rincon del Tridente',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2178,
            'name' => 'San Jose',
            'city_id' => 616,
        ]);

        Neighborhood::create([
            'id' => 2179,
            'name' => 'Sur Playa',
            'city_id' => 616,
        ]);

        //Costa Esmeralda

        Neighborhood::create([
            'id' => 2180,
            'name' => 'Costa Esmeralda',
            'city_id' => 617,
        ]);

        //Villa Gesell

        Neighborhood::create([
            'id' => 2181,
            'name' => 'Colonia Marina',
            'city_id' => 618,
        ]);

        //San Bernardo

        Neighborhood::create([
            'id' => 2182,
            'name' => 'San Bernardo',
            'city_id' => 619,
        ]);

        //Aguas Verdes

        Neighborhood::create([
            'id' => 2183,
            'name' => 'AguasVerdes',
            'city_id' => 620,
        ]);

        //Arenas Verdes

        Neighborhood::create([
            'id' => 2184,
            'name' => 'Arenas Verdes',
            'city_id' => 621,
        ]);

        //Atlantida

        Neighborhood::create([
            'id' => 2185,
            'name' => 'Atlántida',
            'city_id' => 622,
        ]);

        //Balneario Costa Bonita

        Neighborhood::create([
            'id' => 2186,
            'name' => 'Balneario Costa Bonita',
            'city_id' => 623,
        ]);

        //Balneario Los Angeles

        Neighborhood::create([
            'id' => 2187,
            'name' => 'Balneario Los Angeles',
            'city_id' => 624,
        ]);

        //Balneario Marisol

        Neighborhood::create([
            'id' => 2188,
            'name' => 'Balneario Marisol',
            'city_id' => 625,
        ]);

        //Balneario Orense

        Neighborhood::create([
            'id' => 2189,
            'name' => 'Sur Playa',
            'city_id' => 626,
        ]);

        //Balneario Sauce Grande

        Neighborhood::create([
            'id' => 2190,
            'name' => 'Balneario Sauce Grande',
            'city_id' => 627,
        ]);

        //Camet

        Neighborhood::create([
            'id' => 2191,
            'name' => 'Camet',
            'city_id' => 628,
        ]);

        //Camet Norte

        Neighborhood::create([
            'id' => 2192,
            'name' => 'Norte',
            'city_id' => 629,
        ]);

        //Carilo

        Neighborhood::create([
            'id' => 2193,
            'name' => 'Bosques',
            'city_id' => 630,
        ]);

        //Centinela del Mar

        Neighborhood::create([
            'id' => 2194,
            'name' => 'Centinela del Mar',
            'city_id' => 631,
        ]);

        //Chapadmalal

        Neighborhood::create([
            'id' => 2195,
            'name' => 'Santa Isabel',
            'city_id' => 632,
        ]);

        Neighborhood::create([
            'id' => 2196,
            'name' => 'San Eduardo del Mar',
            'city_id' => 632,
        ]);

        Neighborhood::create([
            'id' => 2197,
            'name' => 'Barranca de los Lobos',
            'city_id' => 632,
        ]);

        Neighborhood::create([
            'id' => 2198,
            'name' => 'Centro',
            'city_id' => 632,
        ]);

        Neighborhood::create([
            'id' => 2199,
            'name' => 'El Marquesado',
            'city_id' => 632,
        ]);

        Neighborhood::create([
            'id' => 2200,
            'name' => 'Highland Park',
            'city_id' => 632,
        ]);

        Neighborhood::create([
            'id' => 2201,
            'name' => 'La Arboleda',
            'city_id' => 632,
        ]);

        Neighborhood::create([
            'id' => 2202,
            'name' => 'Marayui',
            'city_id' => 632,
        ]);

        Neighborhood::create([
            'id' => 2203,
            'name' => 'San Eduardo de Chapadmalal',
            'city_id' => 632,
        ]);

        //Claromeco

        Neighborhood::create([
            'id' => 2204,
            'name' => 'Claromecó',
            'city_id' => 633,
        ]);

        //Costa Azul

        Neighborhood::create([
            'id' => 2205,
            'name' => 'Costa Azul',
            'city_id' => 634,
        ]);

        //Costa Chica

        Neighborhood::create([
            'id' => 2206,
            'name' => 'Costa Chica',
            'city_id' => 635,
        ]);

        //Costa del Este

        Neighborhood::create([
            'id' => 2207,
            'name' => 'Costa del Este',
            'city_id' => 636,
        ]);

        //Dunamar

        Neighborhood::create([
            'id' => 2208,
            'name' => 'Dunamar',
            'city_id' => 637,
        ]);

        //Frente Mar

        Neighborhood::create([
            'id' => 2209,
            'name' => 'Frente Mar',
            'city_id' => 638,
        ]);

        //La Lucila del Mar

        Neighborhood::create([
            'id' => 2210,
            'name' => 'Dunamar',
            'city_id' => 639,
        ]);

        //Las Gaviotas

        Neighborhood::create([
            'id' => 2211,
            'name' => 'Las Gaviotas',
            'city_id' => 640,
        ]);

        //Las Toninas

        Neighborhood::create([
            'id' => 2212,
            'name' => 'Las Toninas',
            'city_id' => 641,
        ]);

        //Mar Azul

        Neighborhood::create([
            'id' => 2213,
            'name' => 'Centro',
            'city_id' => 642,
        ]);

        //Mar Chiquita

        Neighborhood::create([
            'id' => 2214,
            'name' => 'Mar de Cobo',
            'city_id' => 643,
        ]);

        Neighborhood::create([
            'id' => 2215,
            'name' => 'Coronel Vidal',
            'city_id' => 643,
        ]);

        Neighborhood::create([
            'id' => 2216,
            'name' => 'Villa Mar Chiquita',
            'city_id' => 643,
        ]);

        Neighborhood::create([
            'id' => 2217,
            'name' => 'La Caleta',
            'city_id' => 643,
        ]);

        //Mar de Ajó

        Neighborhood::create([
            'id' => 2218,
            'name' => 'Mar de Ajó',
            'city_id' => 644,
        ]);

        //Mar de las Pampas

        Neighborhood::create([
            'id' => 2219,
            'name' => 'Manzana Uno',
            'city_id' => 645,
        ]);

        //Mar del Sur

        Neighborhood::create([
            'id' => 2220,
            'name' => 'Mar del Sur',
            'city_id' => 646,
        ]);

        //Mar del Tuyu

        Neighborhood::create([
            'id' => 2221,
            'name' => 'Mar del Tuyú',
            'city_id' => 647,
        ]);

        //Miramar

        Neighborhood::create([
            'id' => 2222,
            'name' => 'Centro - Zona 1',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2223,
            'name' => 'Parquemar',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2224,
            'name' => 'Las Lomas',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2225,
            'name' => 'Centro -Zona 4 ',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2226,
            'name' => 'Centro - Zona 2',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2227,
            'name' => '25 de Mayo',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2228,
            'name' => 'Belgrano',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2229,
            'name' => 'Centro - Zona 3',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2230,
            'name' => 'Centro - Zona 5',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2231,
            'name' => 'Copacabana',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2232,
            'name' => 'El Paraíso',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2233,
            'name' => 'El Progreso',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2234,
            'name' => 'La Baliza',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2235,
            'name' => 'Las Flores',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2236,
            'name' => 'Las Palmas',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2237,
            'name' => 'Los Patricios',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2238,
            'name' => 'Los Pinos',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2239,
            'name' => 'Oeste',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2240,
            'name' => 'Parque Bristol',
            'city_id' => 648,
        ]);

        Neighborhood::create([
            'id' => 2241,
            'name' => 'San Martín',
            'city_id' => 648,
        ]);

        //Monte Hermoso

        Neighborhood::create([
            'id' => 2242,
            'name' => 'Centro',
            'city_id' => 649,
        ]);

        Neighborhood::create([
            'id' => 2243,
            'name' => 'Las Dunas',
            'city_id' => 649,
        ]);

        Neighborhood::create([
            'id' => 2244,
            'name' => 'Las Lomas',
            'city_id' => 649,
        ]);

        Neighborhood::create([
            'id' => 2245,
            'name' => 'Monte del Este',
            'city_id' => 649,
        ]);

        Neighborhood::create([
            'id' => 2246,
            'name' => 'Aldea del Este',
            'city_id' => 649,
        ]);

        Neighborhood::create([
            'id' => 2247,
            'name' => 'FONAVI ',
            'city_id' => 649,
        ]);

        Neighborhood::create([
            'id' => 2248,
            'name' => 'los Eucaliptos',
            'city_id' => 649,
        ]);

        Neighborhood::create([
            'id' => 2249,
            'name' => 'Parque Dufaur',
            'city_id' => 649,
        ]);

        Neighborhood::create([
            'id' => 2250,
            'name' => 'San Martín',
            'city_id' => 649,
        ]);

        Neighborhood::create([
            'id' => 2251,
            'name' => 'Villa Caballero',
            'city_id' => 649,
        ]);

        //Montecarlo

        Neighborhood::create([
            'id' => 2252,
            'name' => 'Montecarlo',
            'city_id' => 650,
        ]);

        //Necochea

        Neighborhood::create([
            'id' => 2253,
            'name' => 'Necochea',
            'city_id' => 651,
        ]);

        //Nueva Atlantis

        Neighborhood::create([
            'id' => 2254,
            'name' => 'Nueva Atlantis',
            'city_id' => 652,
        ]);

        //Ostende

        Neighborhood::create([
            'id' => 2255,
            'name' => 'Ostende',
            'city_id' => 653,
        ]);

        //Pehuen-có

        Neighborhood::create([
            'id' => 2256,
            'name' => 'Pehuen-có',
            'city_id' => 654,
        ]);

       //Pinar del Sol

        Neighborhood::create([
            'id' => 2257,
            'name' => 'Pinar del Sol',
            'city_id' => 655,
        ]);

        //Playa Dorada

        Neighborhood::create([
            'id' => 2258,
            'name' => 'Playa Dorada',
            'city_id' => 656,
        ]);

        //Pueblo Darwin

        Neighborhood::create([
            'id' => 2259,
            'name' => 'Pueblo Darwin',
            'city_id' => 657,
        ]);

        //Punta Alta

        Neighborhood::create([
            'id' => 2260,
            'name' => 'Punta ALta',
            'city_id' => 658,
        ]);

        //Punta Médanos

        Neighborhood::create([
            'id' => 2261,
            'name' => 'Punta Médanos',
            'city_id' => 659,
        ]);

        //Quequén

        Neighborhood::create([
            'id' => 2262,
            'name' => 'Punta Médanos',
            'city_id' => 660,
        ]);

        //Reta

        Neighborhood::create([
            'id' => 2263,
            'name' => 'Reta',
            'city_id' => 661,
        ]);

        //San Cayetano

        Neighborhood::create([
            'id' => 2264,
            'name' => 'San Cayetano',
            'city_id' => 662,
        ]);

        //San Clemente del tuyu

        Neighborhood::create([
            'id' => 2265,
            'name' => 'Playa Grande',
            'city_id' => 663,
        ]);

        Neighborhood::create([
            'id' => 2266,
            'name' => 'Altos del Mar Golf',
            'city_id' => 663,
        ]);

        Neighborhood::create([
            'id' => 2267,
            'name' => 'Km314',
            'city_id' => 663,
        ]);

        //Santa Clara del Mar

        Neighborhood::create([
            'id' => 2268,
            'name' => 'Norte',
            'city_id' => 664,
        ]);

        Neighborhood::create([
            'id' => 2269,
            'name' => 'Sur',
            'city_id' => 664,
        ]);

        //Santa Elena

        Neighborhood::create([
            'id' => 2270,
            'name' => 'Santa Elena',
            'city_id' => 665,
        ]);

        //Santa Teresita

        Neighborhood::create([
            'id' => 2271,
            'name' => 'Villa Dominico',
            'city_id' => 666,
        ]);

        //Valeria del Mar

        Neighborhood::create([
            'id' => 2272,
            'name' => 'Valeria del Mar',
            'city_id' => 667,
        ]);

        //Villa General Arias

        Neighborhood::create([
            'id' => 2273,
            'name' => 'Villa General Arias',
            'city_id' => 668,
        ]);

        //Villarobles

        Neighborhood::create([
            'id' => 2274,
            'name' => 'Villarobles',
            'city_id' => 669,
        ]);

        //Capayán

        Neighborhood::create([
            'id' => 2275,
            'name' => 'Capayan',
            'city_id' => 672,
        ]);

        //La Mesada de Zárate

        Neighborhood::create([
            'id' => 2276,
            'name' => 'La Mesada de Zárate',
            'city_id' => 670,
        ]);

        //San Nicolás

        Neighborhood::create([
            'id' => 2277,
            'name' => 'San Nicolás',
            'city_id' => 673,
        ]);

        //Tinogasta

        Neighborhood::create([
            'id' => 2278,
            'name' => 'Tinogasta',
            'city_id' => 674,
        ]);

        //San Fernando del Valle de Catamarca

        Neighborhood::create([
            'id' => 2279,
            'name' => 'San Fernando del Valle de Catamarca',
            'city_id' => 671,
        ]);

        //Achalco

        Neighborhood::create([
            'id' => 2280,
            'name' => 'Achalco',
            'city_id' => 675,
        ]);

        //Aconquija

        Neighborhood::create([
            'id' => 2281,
            'name' => 'Aconquija',
            'city_id' => 676,
        ]);

        //Acostilla

        Neighborhood::create([
            'id' => 2282,
            'name' => 'Acostilla',
            'city_id' => 677,
        ]);

        //Adolfo E Carranza

        Neighborhood::create([
            'id' => 2283,
            'name' => 'Adolfo E Carranza',
            'city_id' => 678,
        ]);

        //Agua Amarilla

        Neighborhood::create([
            'id' => 2284,
            'name' => 'Agua Amarilla',
            'city_id' => 679,
        ]);

        //Agua Blanca

        Neighborhood::create([
            'id' => 2285,
            'name' => 'Agua Blanca',
            'city_id' => 680,
        ]);

        //Agua Caliente

        Neighborhood::create([
            'id' => 2286,
            'name' => 'Agua Caliente',
            'city_id' => 681,
        ]);

        //Agua Colorada

        Neighborhood::create([
            'id' => 2287,
            'name' => 'Agua Colorada',
            'city_id' => 682,
        ]);

        //Agua de las Palomas

        Neighborhood::create([
            'id' => 2288,
            'name' => 'Agua de las Palomas',
            'city_id' => 683,
        ]);

        //Agua del Monte

        Neighborhood::create([
            'id' => 2289,
            'name' => 'Agua del Monte',
            'city_id' => 684,
        ]);

        //Agua Quemada

        Neighborhood::create([
            'id' => 2290,
            'name' => 'Agua Quemada',
            'city_id' => 685,
        ]);

        //Agua Verde

        Neighborhood::create([
            'id' => 2291,
            'name' => 'Agua verde',
            'city_id' => 686,
        ]);

        //Aguas Blancas

        Neighborhood::create([
            'id' => 2292,
            'name' => 'Aguas Blancas',
            'city_id' => 687,
        ]);

        //Albigasta

        Neighborhood::create([
            'id' => 2293,
            'name' => 'Albigasta',
            'city_id' => 688,
        ]);

        //Algarrobal

        Neighborhood::create([
            'id' => 2294,
            'name' => 'Algarrobal',
            'city_id' => 689,
        ]);

        //Alijilán

        Neighborhood::create([
            'id' => 2295,
            'name' => 'Alijilán',
            'city_id' => 690,
        ]);

        //Allegas

        Neighborhood::create([
            'id' => 2296,
            'name' => 'Allegas',
            'city_id' => 691,
        ]);

        //Altos de las Juntas

        Neighborhood::create([
            'id' => 2297,
            'name' => 'Alto de las Juntas',
            'city_id' => 692,
        ]);

        //Alto Verde

        Neighborhood::create([
            'id' => 2298,
            'name' => 'Alto Verde',
            'city_id' => 693,
        ]);

        //Amadores

        Neighborhood::create([
            'id' => 2299,
            'name' => 'Amadores',
            'city_id' => 694,
        ]);

        //Amanao

        Neighborhood::create([
            'id' => 2300,
            'name' => 'Amanao',
            'city_id' => 695,
        ]);

        //Amaucala

        Neighborhood::create([
            'id' => 2301,
            'name' => 'Amaucala',
            'city_id' => 696,
        ]);

        //Ampajango

        Neighborhood::create([
            'id' => 2302,
            'name' => 'Ampajango',
            'city_id' => 697,
        ]);

        //Ampajango Banda

        Neighborhood::create([
            'id' => 2303,
            'name' => 'Ampajango Banda',
            'city_id' => 698,
        ]);

        //Ampolla

        Neighborhood::create([
            'id' => 2304,
            'name' => 'Ampolla',
            'city_id' => 699,
        ]);

        //Ancasti

        Neighborhood::create([
            'id' => 2305,
            'name' => 'Ancasti',
            'city_id' => 700,
        ]);

        //Ancastillo

        Neighborhood::create([
            'id' => 2306,
            'name' => 'Ancastillo',
            'city_id' => 701,
        ]);

        //Andalgalá

        Neighborhood::create([
            'id' => 2307,
            'name' => 'Andalgalá',
            'city_id' => 702,
        ]);

        //Andalhualá

        Neighborhood::create([
            'id' => 2308,
            'name' => 'Andalhualá',
            'city_id' => 703,
        ]);

        //Angostura

        Neighborhood::create([
            'id' => 2309,
            'name' => 'Angostura',
            'city_id' => 704,
        ]);

        //Anillaco

        Neighborhood::create([
            'id' => 2310,
            'name' => 'Anillaco',
            'city_id' => 705,
        ]);

        //Anjuli

        Neighborhood::create([
            'id' => 2311,
            'name' => 'Anjuli',
            'city_id' => 706,
        ]);

        //Anquincila

        Neighborhood::create([
            'id' => 2312,
            'name' => 'Anquincila',
            'city_id' => 707,
        ]);

        //Antapoca

        Neighborhood::create([
            'id' => 2313,
            'name' => 'Antapoca',
            'city_id' => 708,
        ]);

        //Antinaco

        Neighborhood::create([
            'id' => 2314,
            'name' => 'Antinaco',
            'city_id' => 709,
        ]);

        //Antofagasta de la Sierra

        Neighborhood::create([
            'id' => 2315,
            'name' => 'Antofagasta de la Sierra',
            'city_id' => 710,
        ]);

        //Antofalla

        Neighborhood::create([
            'id' => 2316,
            'name' => 'Antofalla',
            'city_id' => 711,
        ]);

        //Asampay

        Neighborhood::create([
            'id' => 2317,
            'name' => 'Asampay',
            'city_id' => 712,
        ]);

        //Atravesada

        Neighborhood::create([
            'id' => 2318,
            'name' => 'Atravesada',
            'city_id' => 713,
        ]);

        //Ayapaso

        Neighborhood::create([
            'id' => 2319,
            'name' => 'Ayapaso',
            'city_id' => 714,
        ]);

        //Bajo Hondo

        Neighborhood::create([
            'id' => 2320,
            'name' => 'Bajo Hondo',
            'city_id' => 715,
        ]);

        //Balcozna

        Neighborhood::create([
            'id' => 2321,
            'name' => 'Balcozna',
            'city_id' => 716,
        ]);

        //Balde de la Punta

        Neighborhood::create([
            'id' => 2322,
            'name' => 'Balde de la Punta',
            'city_id' => 717,
        ]);

        //Banda de Lucero

        Neighborhood::create([
            'id' => 2323,
            'name' => 'Banda de Lucero',
            'city_id' => 718,
        ]);

        //Barranca Larga

        Neighborhood::create([
            'id' => 2324,
            'name' => 'Barranca Larga',
            'city_id' => 719,
        ]);

        //Barrialito

        Neighborhood::create([
            'id' => 2325,
            'name' => 'Barrialito',
            'city_id' => 720,
        ]);

        //Barrio Artaza

        Neighborhood::create([
            'id' => 2326,
            'name' => 'Barrio Artaza',
            'city_id' => 721,
        ]);

        //Barrio Bancario

        Neighborhood::create([
            'id' => 2327,
            'name' => 'Barrio Bancario',
            'city_id' => 722,
        ]);

        //Barrio El Molino

        Neighborhood::create([
            'id' => 2328,
            'name' => 'Barrio El Molino',
            'city_id' => 723,
        ]);

        //Barrio Las Lomas

        Neighborhood::create([
            'id' => 2329,
            'name' => 'Barrio Las Lomas',
            'city_id' => 724,
        ]);

        //Barrio Los Nacimientos

        Neighborhood::create([
            'id' => 2330,
            'name' => 'Barrio Los Nacimientos',
            'city_id' => 725,
        ]);

        //Bañado de Ovanta

        Neighborhood::create([
            'id' => 2331,
            'name' => 'Bañado de Ovanta',
            'city_id' => 726,
        ]);

        //Belén

        Neighborhood::create([
            'id' => 2332,
            'name' => 'Belén',
            'city_id' => 727,
        ]);

        //Buena Vista

        Neighborhood::create([
            'id' => 2333,
            'name' => 'Buena Vista',
            'city_id' => 728,
        ]);

        //Caballa

        Neighborhood::create([
            'id' => 2334,
            'name' => 'Caballa',
            'city_id' => 729,
        ]);

        //Cabra Ciénaga

        Neighborhood::create([
            'id' => 2335,
            'name' => 'Cabra Ciénaga',
            'city_id' => 730,
        ]);

        //Calaste

        Neighborhood::create([
            'id' => 2336,
            'name' => 'Calaste',
            'city_id' => 731,
        ]);

        //Calera del Sauce

        Neighborhood::create([
            'id' => 2337,
            'name' => 'Calera del Sauce',
            'city_id' => 732,
        ]);

        //Campo el Pucará

        Neighborhood::create([
            'id' => 2338,
            'name' => 'Campo el Pucará',
            'city_id' => 733,
        ]);

        //Campo Garriga

        Neighborhood::create([
            'id' => 2339,
            'name' => 'Campo Garriga',
            'city_id' => 734,
        ]);

        //Cana Cruz

        Neighborhood::create([
            'id' => 2340,
            'name' => 'Cana Cruz',
            'city_id' => 735,
        ]);

        //Cantera Cerrito

        Neighborhood::create([
            'id' => 2341,
            'name' => 'Cantera Cerrito',
            'city_id' => 736,
        ]);

        //Cantera la Esperanza

        Neighborhood::create([
            'id' => 2342,
            'name' => 'Cantera la Esperanza',
            'city_id' => 737,
        ]);

        //Canteras Esquiu

        Neighborhood::create([
            'id' => 2343,
            'name' => 'Canteras Esquiu',
            'city_id' => 738,
        ]);

        //Capilla del Rosario

        Neighborhood::create([
            'id' => 2344,
            'name' => 'Capilla del Rosario',
            'city_id' => 739,
        ]);

        //Casa de Abajo

        Neighborhood::create([
            'id' => 2345,
            'name' => 'Casa de Abajo',
            'city_id' => 740,
        ]);

        //Casa de Piedra

        Neighborhood::create([
            'id' => 2346,
            'name' => 'Casa de Piedra',
            'city_id' => 741,
        ]);

        //Casa el Medio

        Neighborhood::create([
            'id' => 2347,
            'name' => 'Casa el Medio',
            'city_id' => 742,
        ]);

        //Casa Quemada

        Neighborhood::create([
            'id' => 2348,
            'name' => 'Casa Quemada',
            'city_id' => 743,
        ]);

        //Casa Santa

        Neighborhood::create([
            'id' => 2349,
            'name' => 'Casa Santa',
            'city_id' => 744,
        ]);

        //Casas Viejas

        Neighborhood::create([
            'id' => 2350,
            'name' => 'Casas Viejas',
            'city_id' => 745,
        ]);

        //Caspichango

        Neighborhood::create([
            'id' => 2351,
            'name' => 'Caspichango',
            'city_id' => 746,
        ]);

        //Cañada de Ipizca

        Neighborhood::create([
            'id' => 2352,
            'name' => 'Cañada de Ipizca',
            'city_id' => 747,
        ]);

        //Cañada de Páez

        Neighborhood::create([
            'id' => 2353,
            'name' => 'Cañada de Páez',
            'city_id' => 748,
        ]);

        //Cañada Larga

        Neighborhood::create([
            'id' => 2354,
            'name' => 'Cañada Larga',
            'city_id' => 749,
        ]);

        //Cañada Verde

        Neighborhood::create([
            'id' => 2355,
            'name' => 'Cañada Verde',
            'city_id' => 750,
        ]);

        //Cerco del Palo

        Neighborhood::create([
            'id' => 2356,
            'name' => 'Cerco del Palo',
            'city_id' => 751,
        ]);

        //Cerro Colorado

        Neighborhood::create([
            'id' => 2357,
            'name' => 'Cerro Colorado',
            'city_id' => 752,
        ]);

        //Cerro Negro

        Neighborhood::create([
            'id' => 2358,
            'name' => 'Cerro Negro',
            'city_id' => 753,
        ]);

        //Chafi

        Neighborhood::create([
            'id' => 2359,
            'name' => 'Chafi',
            'city_id' => 754,
        ]);

        //Chaquiago

        Neighborhood::create([
            'id' => 2360,
            'name' => 'Chaquiago',
            'city_id' => 755,
        ]);

        //Chaupiyaco

        Neighborhood::create([
            'id' => 2361,
            'name' => 'Chaupiyaco',
            'city_id' => 756,
        ]);

        //Chavarría

        Neighborhood::create([
            'id' => 2362,
            'name' => 'Chavarría',
            'city_id' => 757,
        ]);

        //Chañar Laguna

        Neighborhood::create([
            'id' => 2363,
            'name' => 'Chañar Laguna',
            'city_id' => 758,
        ]);

        //Chañar Punco

        Neighborhood::create([
            'id' => 2364,
            'name' => 'Chañar Punco',
            'city_id' => 759,
        ]);

        //Chañarito

        Neighborhood::create([
            'id' => 2365,
            'name' => 'Chañarito',
            'city_id' => 760,
        ]);

        //Chinocan

        Neighborhood::create([
            'id' => 2366,
            'name' => 'Chinocan',
            'city_id' => 761,
        ]);

        //Chiquero Viejo

        Neighborhood::create([
            'id' => 2367,
            'name' => 'Chiquero Viejo',
            'city_id' => 762,
        ]);

        //Choya

        Neighborhood::create([
            'id' => 2368,
            'name' => 'Choya',
            'city_id' => 763,
        ]);

        //Choya Viejo

        Neighborhood::create([
            'id' => 2369,
            'name' => 'Choya Viejo',
            'city_id' => 764,
        ]);

        //Chuchucaruana

        Neighborhood::create([
            'id' => 2370,
            'name' => 'Chuchucaruana',
            'city_id' => 765,
        ]);

        //Chumbicha

        Neighborhood::create([
            'id' => 2371,
            'name' => 'Chumbicha',
            'city_id' => 766,
        ]);

        //Chuquisaca

        Neighborhood::create([
            'id' => 2372,
            'name' => 'Chuquisaca',
            'city_id' => 767,
        ]);

        //Chusco

        Neighborhood::create([
            'id' => 2373,
            'name' => 'Chusco',
            'city_id' => 768,
        ]);

        //Ciénaga de Abajo

        Neighborhood::create([
            'id' => 2374,
            'name' => 'Ciénaga de Abajo',
            'city_id' => 769,
        ]);

        //Cienaga el Pozo

        Neighborhood::create([
            'id' => 2375,
            'name' => 'Cienaga el Pozo',
            'city_id' => 770,
        ]);

        //Cienaga Grande

        Neighborhood::create([
            'id' => 2376,
            'name' => 'Cienaga Grande',
            'city_id' => 771,
        ]);

        //Cienaga Larga

        Neighborhood::create([
            'id' => 2377,
            'name' => 'Cienaga Larga',
            'city_id' => 772,
        ]);

        //Club Caza y Pesca

        Neighborhood::create([
            'id' => 2378,
            'name' => 'Club Caza y Pesca',
            'city_id' => 773,
        ]);

        //Collagasta

        Neighborhood::create([
            'id' => 2379,
            'name' => 'Collagasta',
            'city_id' => 774,
        ]);

        //Colonia Alijian

        Neighborhood::create([
            'id' => 2380,
            'name' => 'Colonia Alijian',
            'city_id' => 775,
        ]);

        //Colonia de Achalco

        Neighborhood::create([
            'id' => 2381,
            'name' => 'Colonia de Achalco',
            'city_id' => 776,
        ]);

        //Colonia del Valle

        Neighborhood::create([
            'id' => 2382,
            'name' => 'Colonia del Valle',
            'city_id' => 777,
        ]);

        //Colonia de Jojoba

        Neighborhood::create([
            'id' => 2383,
            'name' => 'Colonia de Jojoba',
            'city_id' => 778,
        ]);

        //Colonia Nueva Coneta

        Neighborhood::create([
            'id' => 2384,
            'name' => 'Colonia Nueva Coneta',
            'city_id' => 779,
        ]);

        //Colorado

        Neighborhood::create([
            'id' => 2385,
            'name' => 'Colorado',
            'city_id' => 780,
        ]);

        //Colpes

        Neighborhood::create([
            'id' => 2386,
            'name' => 'Colpes',
            'city_id' => 781,
        ]);

        //Concepción

        Neighborhood::create([
            'id' => 2387,
            'name' => 'Concepción',
            'city_id' => 782,
        ]);

        //Conejo

        Neighborhood::create([
            'id' => 2388,
            'name' => 'Conejo',
            'city_id' => 783,
        ]);

        //Coneta

        Neighborhood::create([
            'id' => 2389,
            'name' => 'Coneta',
            'city_id' => 784,
        ]);

        //Copacabana

        Neighborhood::create([
            'id' => 2390,
            'name' => 'Copacabana',
            'city_id' => 785,
        ]);

        //Cordobita

        Neighborhood::create([
            'id' => 2391,
            'name' => 'Cordobita',
            'city_id' => 786,
        ]);

        //Corpus Yaco

        Neighborhood::create([
            'id' => 2392,
            'name' => 'Corpus Yaco',
            'city_id' => 787,
        ]);

        //Corral de Piedra

        Neighborhood::create([
            'id' => 2393,
            'name' => 'Corral de Piedra',
            'city_id' => 788,
        ]);

        //Corral Grande

        Neighborhood::create([
            'id' => 2394,
            'name' => 'Corral Grande',
            'city_id' => 789,
        ]);

        //Corral Quemado

        Neighborhood::create([
            'id' => 2395,
            'name' => 'Corral Quemado',
            'city_id' => 790,
        ]);

        //Corralito

        Neighborhood::create([
            'id' => 2396,
            'name' => 'Corralito',
            'city_id' => 791,
        ]);

        //Cortaderas

        Neighborhood::create([
            'id' => 2397,
            'name' => 'Cortaderas',
            'city_id' => 792,
        ]);

        //Costa de Reyes

        Neighborhood::create([
            'id' => 2398,
            'name' => 'Costa de Reyes',
            'city_id' => 793,
        ]);

        //Cuchinoque

        Neighborhood::create([
            'id' => 2399,
            'name' => 'Cuchinoque',
            'city_id' => 794,
        ]);

        //Cueva Amarilla

        Neighborhood::create([
            'id' => 2400,
            'name' => 'Cueva Amarilla',
            'city_id' => 795,
        ]);

        //Culampaja

        Neighborhood::create([
            'id' => 3102,
            'name' => 'Culampaja',
            'city_id' => 796,
        ]);

        //Condor Huasi

        Neighborhood::create([
            'id' => 3103,
            'name' => 'Cóndoy Huasi',
            'city_id' => 797,
        ]);

        //Dos Pocitos

        Neighborhood::create([
            'id' => 3104,
            'name' => 'Dos Pocitos',
            'city_id' => 798,
        ]);

        //El Abra

        Neighborhood::create([
            'id' => 3105,
            'name' => 'El Abra',
            'city_id' => 799,
        ]);

        //El Alamito

        Neighborhood::create([
            'id' => 3106,
            'name' => 'El Alamito',
            'city_id' => 800,
        ]);

        //El Algarrobito

        Neighborhood::create([
            'id' => 3107,
            'name' => 'El Algarrobito',
            'city_id' => 801,
        ]);

        //El Alto

        Neighborhood::create([
            'id' => 3108,
            'name' => 'El Alto',
            'city_id' => 802,
        ]);

        //El Angosto

        Neighborhood::create([
            'id' => 3109,
            'name' => 'El Angosto',
            'city_id' => 803,
        ]);

        //El Arbolito

        Neighborhood::create([
            'id' => 3110,
            'name' => 'El Arbolito',
            'city_id' => 804,
        ]);

        //El Aybal

        Neighborhood::create([
            'id' => 3111,
            'name' => 'El Aybal',
            'city_id' => 805,
        ]);

        //El Bajo

        Neighborhood::create([
            'id' => 3112,
            'name' => 'El Bajo',
            'city_id' => 806,
        ]);

        //El Barreal

        Neighborhood::create([
            'id' => 3113,
            'name' => 'El Barreal',
            'city_id' => 807,
        ]);

        //El Barrealito

        Neighborhood::create([
            'id' => 3114,
            'name' => 'El Barrealito',
            'city_id' => 808,
        ]);

        //El Bastidor

        Neighborhood::create([
            'id' => 3115,
            'name' => 'El Bastidor',
            'city_id' => 809,
        ]);

        //El Bañado

        Neighborhood::create([
            'id' => 3116,
            'name' => 'El Bañado',
            'city_id' => 810,
        ]);

        //El Bello

        Neighborhood::create([
            'id' => 3117,
            'name' => 'El Bello',
            'city_id' => 811,
        ]);

        //El Bolsón

        Neighborhood::create([
            'id' => 3118,
            'name' => 'El Bolsón',
            'city_id' => 812,
        ]);

        //El Bosquecillo

        Neighborhood::create([
            'id' => 3119,
            'name' => 'El Bosquecillo',
            'city_id' => 813,
        ]);

        //El Bracho

        Neighborhood::create([
            'id' => 3120,
            'name' => 'El Bracho',
            'city_id' => 814,
        ]);

        //El Breal

        Neighborhood::create([
            'id' => 3121,
            'name' => 'El Breal',
            'city_id' => 815,
        ]);

        //El Cachiyuyo

        Neighborhood::create([
            'id' => 3122,
            'name' => 'El Cachiyuyo',
            'city_id' => 816,
        ]);

        //El Cajón

        Neighborhood::create([
            'id' => 3123,
            'name' => 'El Cajón',
            'city_id' => 817,
        ]);

        //El Calvario

        Neighborhood::create([
            'id' => 3124,
            'name' => 'El Calvario',
            'city_id' => 818,
        ]);

        //El Carrizal

        Neighborhood::create([
            'id' => 3125,
            'name' => 'El Carrizal',
            'city_id' => 819,
        ]);

        //El Cebil

        Neighborhood::create([
            'id' => 3126,
            'name' => 'El Cebil',
            'city_id' => 820,
        ]);

        //El Cercado

        Neighborhood::create([
            'id' => 3127,
            'name' => 'El Cercado',
            'city_id' => 821,
        ]);

        //El Cerrito

        Neighborhood::create([
            'id' => 3128,
            'name' => 'El Cerrito',
            'city_id' => 822,
        ]);

        //El Chaguaral

        Neighborhood::create([
            'id' => 3129,
            'name' => 'El Chaguaral',
            'city_id' => 823,
        ]);

        //El Chañaral

        Neighborhood::create([
            'id' => 3130,
            'name' => 'El Chañaral',
            'city_id' => 824,
        ]);

        //El Chorrito

        Neighborhood::create([
            'id' => 3131,
            'name' => 'El Chorrito',
            'city_id' => 825,
        ]);

        //El Chorro

        Neighborhood::create([
            'id' => 3132,
            'name' => 'El Chorro',
            'city_id' => 826,
        ]);

        //El Chuapi


        //El Comedor

        Neighborhood::create([
            'id' => 3133,
            'name' => 'El Comedor',
            'city_id' => 828,
        ]);

        //El Corral

        Neighborhood::create([
            'id' => 3134,
            'name' => 'El Corral',
            'city_id' => 829,
        ]);

        //El Descanso

        Neighborhood::create([
            'id' => 3135,
            'name' => 'El Descanso',
            'city_id' => 830,
        ]);

        //El Desmonte

        Neighborhood::create([
            'id' => 3136,
            'name' => 'El Desmonte',
            'city_id' => 831,
        ]);

        //El Dique

        Neighborhood::create([
            'id' => 3137,
            'name' => 'El Dique',
            'city_id' => 832,
        ]);

        //El Divisadero

        Neighborhood::create([
            'id' => 3138,
            'name' => 'El Divisadero',
            'city_id' => 833,
        ]);

        //El Durazno

        Neighborhood::create([
            'id' => 3139,
            'name' => 'El Durazno',
            'city_id' => 834,
        ]);

        //El Eje

        Neighborhood::create([
            'id' => 3140,
            'name' => 'El Eje',
            'city_id' => 835,
        ]);

        //El Empalme

        Neighborhood::create([
            'id' => 3141,
            'name' => 'El Empalme',
            'city_id' => 836,
        ]);

        //El Espinillo

        Neighborhood::create([
            'id' => 3142,
            'name' => 'El Espinillo',
            'city_id' => 837,
        ]);

        //El Faldeo

        Neighborhood::create([
            'id' => 3143,
            'name' => 'El Faldeo',
            'city_id' => 838,
        ]);

        //El Hornito

        Neighborhood::create([
            'id' => 3144,
            'name' => 'El Hornito',
            'city_id' => 839,
        ]);

        //El Huayco

        Neighborhood::create([
            'id' => 3145,
            'name' => 'El Huayco',
            'city_id' => 840,
        ]);

        //El Hueco

        Neighborhood::create([
            'id' => 3146,
            'name' => 'El Hueco',
            'city_id' => 841,
        ]);

        //El Jote

        Neighborhood::create([
            'id' => 3147,
            'name' => 'El Jote',
            'city_id' => 842,
        ]);

        //El jumeal

        Neighborhood::create([
            'id' => 3148,
            'name' => 'El Jumeal',
            'city_id' => 843,
        ]);

        //El Lampazo

        Neighborhood::create([
            'id' => 3149,
            'name' => 'El Lampazo',
            'city_id' => 844,
        ]);

        //El Lindero

        Neighborhood::create([
            'id' => 3150,
            'name' => 'El Lindero',
            'city_id' => 845,
        ]);

        //El Milagro

        Neighborhood::create([
            'id' => 3151,
            'name' => 'El Milagro',
            'city_id' => 846,
        ]);

        //El Mojón

        Neighborhood::create([
            'id' => 3152,
            'name' => 'El Mojón',
            'city_id' => 847,
        ]);

        //El Molino

        Neighborhood::create([
            'id' => 3153,
            'name' => 'El Molino',
            'city_id' => 848,
        ]);

        //El Medano

        Neighborhood::create([
            'id' => 3154,
            'name' => 'El Medano',
            'city_id' => 849,
        ]);

        //El Pantanillo

        Neighborhood::create([
            'id' => 3155,
            'name' => 'El Pantanillo',
            'city_id' => 850,
        ]);

        //El Pantanito

        Neighborhood::create([
            'id' => 3156,
            'name' => 'El Pantanito',
            'city_id' => 851,
        ]);

        //El Parana

        Neighborhood::create([
            'id' => 3157,
            'name' => 'El Parana',
            'city_id' => 852,
        ]);

        //El Parque

        Neighborhood::create([
            'id' => 3158,
            'name' => 'El Parque',
            'city_id' => 853,
        ]);

        //El Pero

        Neighborhood::create([
            'id' => 3159,
            'name' => 'El Pero',
            'city_id' => 854,
        ]);

        //El Peñon

        Neighborhood::create([
            'id' => 3160,
            'name' => 'El Peñon',
            'city_id' => 855,
        ]);

        //El Pintado

        Neighborhood::create([
            'id' => 3161,
            'name' => 'El Pintado',
            'city_id' => 856,
        ]);

        //El Piquillín

        Neighborhood::create([
            'id' => 3162,
            'name' => 'El Piquillín',
            'city_id' => 857,
        ]);

        //El Polear

        Neighborhood::create([
            'id' => 3163,
            'name' => 'El Polear',
            'city_id' => 858,
        ]);

        //El Portezuelo

        Neighborhood::create([
            'id' => 3164,
            'name' => 'El Portezuelo',
            'city_id' => 859,
        ]);

        //El Potrero

        Neighborhood::create([
            'id' => 3165,
            'name' => 'El Potrero',
            'city_id' => 860,
        ]);

        //El Pueblito

        Neighborhood::create([
            'id' => 3166,
            'name' => 'El Pueblito',
            'city_id' => 861,
        ]);

        //El Puestito

        Neighborhood::create([
            'id' => 3167,
            'name' => 'El Puestito',
            'city_id' => 862,
        ]);

        //El Puesto

        Neighborhood::create([
            'id' => 3168,
            'name' => 'El Puesto',
            'city_id' => 863,
        ]);

        //El Quebrachal

        Neighborhood::create([
            'id' => 3169,
            'name' => 'El Quebrachal',
            'city_id' => 864,
        ]);

        //El Quebrachito

        Neighborhood::create([
            'id' => 3170,
            'name' => 'El Quebrachito',
            'city_id' => 865,
        ]);

        //El Quebracho

        Neighborhood::create([
            'id' => 3171,
            'name' => 'El Quebracho',
            'city_id' => 866,
        ]);

        //El Quemado

        Neighborhood::create([
            'id' => 3172,
            'name' => 'El Quemado',
            'city_id' => 867,
        ]);

        //El Quimilo

        Neighborhood::create([
            'id' => 3173,
            'name' => 'El Quimilo',
            'city_id' => 868,
        ]);

        //El Quimivil

        Neighborhood::create([
            'id' => 3174,
            'name' => 'El Quimivil',
            'city_id' => 869,
        ]);

        //El Retiro

        Neighborhood::create([
            'id' => 3175,
            'name' => 'El Retiro',
            'city_id' => 870,
        ]);

        //El Ricón

        Neighborhood::create([
            'id' => 3176,
            'name' => 'El Ricón',
            'city_id' => 871,
        ]);

        //El Rincón

        Neighborhood::create([
            'id' => 3177,
            'name' => 'El Rincón',
            'city_id' => 872,
        ]);

        //El Rodeo

        Neighborhood::create([
            'id' => 3178,
            'name' => 'El Rodeo',
            'city_id' => 873,
        ]);

        //El Rodeíto

        Neighborhood::create([
            'id' => 3179,
            'name' => 'El Rodeíto',
            'city_id' => 874,
        ]);

        //El Rosario

        Neighborhood::create([
            'id' => 3180,
            'name' => 'El Rosario',
            'city_id' => 875,
        ]);

        //El Saladito

        Neighborhood::create([
            'id' => 3181,
            'name' => 'El Saladito',
            'city_id' => 876,
        ]);

        //El Salado

        Neighborhood::create([
            'id' => 3182,
            'name' => 'El Salado',
            'city_id' => 877,
        ]);

        //El Sauce

        Neighborhood::create([
            'id' => 3183,
            'name' => 'El Sauce',
            'city_id' => 878,
        ]);

        //El Saucesito

        Neighborhood::create([
            'id' => 3184,
            'name' => 'El Saucesito',
            'city_id' => 879,
        ]);

        //El Shincal

        Neighborhood::create([
            'id' => 3185,
            'name' => 'El Shincal',
            'city_id' => 880,
        ]);

        //El Silo

        Neighborhood::create([
            'id' => 3186,
            'name' => 'El Silo',
            'city_id' => 881,
        ]);

        //El Sosiego

        Neighborhood::create([
            'id' => 3187,
            'name' => 'El Sosiego',
            'city_id' => 882,
        ]);

        //El Sunchal

        Neighborhood::create([
            'id' => 3188,
            'name' => 'El Sunchal',
            'city_id' => 883,
        ]);

        //El Suncho

        Neighborhood::create([
            'id' => 3189,
            'name' => 'El Suncho',
            'city_id' => 884,
        ]);

        //El Tabique

        Neighborhood::create([
            'id' => 3190,
            'name' => 'El Tabique',
            'city_id' => 885,
        ]);

        //El Taco

        Neighborhood::create([
            'id' => 3191,
            'name' => 'El Taco',
            'city_id' => 886,
        ]);

        //El Tajamar

        Neighborhood::create([
            'id' => 3192,
            'name' => 'El Tajamar',
            'city_id' => 887,
        ]);

        //El Talarcito

        Neighborhood::create([
            'id' => 3193,
            'name' => 'El Talarcito',
            'city_id' => 888,
        ]);

        //El Talita

        Neighborhood::create([
            'id' => 3194,
            'name' => 'El Talita',
            'city_id' => 889,
        ]);

        //El Tesoro de Abajo

        Neighborhood::create([
            'id' => 3195,
            'name' => 'El Tesoro de Abajo',
            'city_id' => 890,
        ]);

        //El Totoral

        Neighborhood::create([
            'id' => 3196,
            'name' => 'El Totoral',
            'city_id' => 891,
        ]);

        //El Triguito

        Neighborhood::create([
            'id' => 3197,
            'name' => 'El Triguito',
            'city_id' => 892,
        ]);

        //El Vallecito

        Neighborhood::create([
            'id' => 3198,
            'name' => 'El Vallecito',
            'city_id' => 893,
        ]);

        //El Zapallar

        Neighborhood::create([
            'id' => 3199,
            'name' => 'El Zapallar',
            'city_id' => 894,
        ]);

        //Empalme Rutas 157 y 60

        Neighborhood::create([
            'id' => 3200,
            'name' => 'Empalme Rutas 157 y 60',
            'city_id' => 895,
        ]);

        //Encrucijada

        Neighborhood::create([
            'id' => 3201,
            'name' => 'Encrucijada',
            'city_id' => 896,
        ]);

        //Entre Ríos

        Neighborhood::create([
            'id' => 3202,
            'name' => 'Entre Ríos',
            'city_id' => 897,
        ]);

        //Esquiú

        Neighborhood::create([
            'id' => 3203,
            'name' => 'Esquiú',
            'city_id' => 898,
        ]);

        //Estancia Albigasta

        Neighborhood::create([
            'id' => 3204,
            'name' => 'Estancia Albigasta',
            'city_id' => 899,
        ]);

        //Estancia de Jerez

        Neighborhood::create([
            'id' => 3205,
            'name' => 'El Sosiego',
            'city_id' => 900,
        ]);

        //Famatanca

        Neighborhood::create([
            'id' => 3206,
            'name' => 'Famatanca',
            'city_id' => 901,
        ]);

        //Fiambalá

        Neighborhood::create([
            'id' => 3207,
            'name' => 'Fiambalá',
            'city_id' => 902,
        ]);

        //Finca Juan JGil

        Neighborhood::create([
            'id' => 3208,
            'name' => 'Finca Juan JGil',
            'city_id' => 903,
        ]);

        //Formosa

        Neighborhood::create([
            'id' => 3209,
            'name' => 'Formosa',
            'city_id' => 904,
        ]);

        //Francisco Lorenzo

        Neighborhood::create([
            'id' => 3210,
            'name' => 'Francisco Lorenzo',
            'city_id' => 905,
        ]);

        //Fray Mamerto Esquiú

        Neighborhood::create([
            'id' => 3211,
            'name' => 'Fray Mamerto Esquiú',
            'city_id' => 906,
        ]);

        //Fuerte Quemado

        Neighborhood::create([
            'id' => 3212,
            'name' => 'Fuerte Quemado',
            'city_id' => 907,
        ]);

        //Garay

        Neighborhood::create([
            'id' => 3213,
            'name' => 'Garay',
            'city_id' => 908,
        ]);

        //Grumi

        Neighborhood::create([
            'id' => 3214,
            'name' => 'Grumi',
            'city_id' => 909,
        ]);

        //Guachin

        Neighborhood::create([
            'id' => 3215,
            'name' => 'Guachin',
            'city_id' => 910,
        ]);

        //Guanaschi

        Neighborhood::create([
            'id' => 3216,
            'name' => 'Guanaschi',
            'city_id' => 911,
        ]);

        //Guay Cóndor

        Neighborhood::create([
            'id' => 3217,
            'name' => 'Guay Cóndor',
            'city_id' => 912,
        ]);

        //Guayamba

        Neighborhood::create([
            'id' => 3218,
            'name' => 'Guayamba',
            'city_id' => 913,
        ]);

        //Higuera El Alumbre

        Neighborhood::create([
            'id' => 3219,
            'name' => 'Higuera El Alumbre',
            'city_id' => 914,
        ]);

        //Huaico Honco

        Neighborhood::create([
            'id' => 3220,
            'name' => 'Huaico Honco',
            'city_id' => 915,
        ]);


        //Hualfín

        Neighborhood::create([
            'id' => 3221,
            'name' => 'Hualfín',
            'city_id' => 916,
        ]);

        //Huasayaco

        Neighborhood::create([
            'id' => 3222,
            'name' => 'Huasayaco',
            'city_id' => 917,
        ]);


        //Huaycama

        Neighborhood::create([
            'id' => 3223,
            'name' => 'Huaycama',
            'city_id' => 918,
        ]);

        //Huillapima



        //Incahuasi

        Neighborhood::create([
            'id' => 3224,
            'name' => 'Incahuasi',
            'city_id' => 928,
        ]);

        //Infanzon

        Neighborhood::create([
            'id' => 3225,
            'name' => 'Infanzón',
            'city_id' => 929,
        ]);

        //Ipizca

        Neighborhood::create([
            'id' => 3226,
            'name' => 'Ipizca',
            'city_id' => 930,
        ]);

        //Jabala

        Neighborhood::create([
            'id' => 3227,
            'name' => 'Jabala',
            'city_id' => 931,
        ]);

        //Jacipunco

        Neighborhood::create([
            'id' => 3228,
            'name' => 'Jacipunco',
            'city_id' => 932,
        ]);

        //Kilómetro 1017

        Neighborhood::create([
            'id' => 3229,
            'name' => 'Kilómetro 1017',
            'city_id' => 933,
        ]);

        //Kilómetro 969

        Neighborhood::create([
            'id' => 3230,
            'name' => 'Kilometro 969',
            'city_id' => 934,
        ]);

        //La Abroncha

        Neighborhood::create([
            'id' => 3231,
            'name' => 'La Abroncha',
            'city_id' => 935,
        ]);

        //La Aguada

        Neighborhood::create([
            'id' => 3232,
            'name' => 'La Aguada',
            'city_id' => 936,
        ]);

        //La Aguadita

        Neighborhood::create([
            'id' => 3233,
            'name' => 'La Aguadita',
            'city_id' => 937,
        ]);

        //La Bajada

        Neighborhood::create([
            'id' => 3234,
            'name' => 'La Bajada',
            'city_id' => 938,
        ]);

        //La Banda

        Neighborhood::create([
            'id' => 3235,
            'name' => 'La Banda',
            'city_id' => 939,
        ]);

        //La Barroza

        Neighborhood::create([
            'id' => 3236,
            'name' => 'La Barroza',
            'city_id' => 940,
        ]);

        //La Bebida

        Neighborhood::create([
            'id' => 3237,
            'name' => 'La Bebida',
            'city_id' => 941,
        ]);

        //La Bomba

        Neighborhood::create([
            'id' => 3238,
            'name' => 'La Bomba',
            'city_id' => 942,
        ]);

        //La Brea

        Neighborhood::create([
            'id' => 3239,
            'name' => 'La Brea',
            'city_id' => 943,
        ]);

        //La Calera

        Neighborhood::create([
            'id' => 3240,
            'name' => 'La Calera',
            'city_id' => 944,
        ]);

        //La Candelaria

        Neighborhood::create([
            'id' => 3241,
            'name' => 'La Candelaria',
            'city_id' => 945,
        ]);

        //La Carpintería

        Neighborhood::create([
            'id' => 3242,
            'name' => 'La Carpintería',
            'city_id' => 946,
        ]);

        //La Carrera

        Neighborhood::create([
            'id' => 3243,
            'name' => 'La Carrera',
            'city_id' => 947,
        ]);

        //La Carreta

        Neighborhood::create([
            'id' => 3244,
            'name' => 'La Carreta',
            'city_id' => 948,
        ]);

        //La Cañada

        Neighborhood::create([
            'id' => 3245,
            'name' => 'La Cañada',
            'city_id' => 949,
        ]);

        //La Chilca

        Neighborhood::create([
            'id' => 3246,
            'name' => 'La Chilca',
            'city_id' => 950,
        ]);

        //La Cienaguita

        Neighborhood::create([
            'id' => 3247,
            'name' => 'La Cienaguita',
            'city_id' => 951,
        ]);

        //La Ciénaga

        Neighborhood::create([
            'id' => 3248,
            'name' => 'La Ciénaga',
            'city_id' => 952,
        ]);

        //La Ciénaga de Abajo

        Neighborhood::create([
            'id' => 3249,
            'name' => 'La Ciénaga de Abajo',
            'city_id' => 953,
        ]);

        //La Ciénaga de Arriba

        Neighborhood::create([
            'id' => 3250,
            'name' => 'La Ciénaga de Arriba',
            'city_id' => 954,
        ]);

        //La Corrida

        Neighborhood::create([
            'id' => 3251,
            'name' => 'La Corrida',
            'city_id' => 955,
        ]);

        //La Corderita

        Neighborhood::create([
            'id' => 3252,
            'name' => 'La Corderita',
            'city_id' => 956,
        ]);

        //La Costa

        Neighborhood::create([
            'id' => 3253,
            'name' => 'La Costa',
            'city_id' => 957,
        ]);

        //La Cuchilla

        Neighborhood::create([
            'id' => 3254,
            'name' => 'La Cuchilla',
            'city_id' => 958 ,
        ]);

        //La Cuesta

        Neighborhood::create([
            'id' => 3255,
            'name' => 'La Cuesta',
            'city_id' => 959,
        ]);

        //La Cuesta de Tatón

        Neighborhood::create([
            'id' => 3256,
            'name' => 'La Cuesta de Tatón',
            'city_id' => 960,
        ]);

        //La Dorada

        Neighborhood::create([
            'id' => 3257,
            'name' => 'La Dorada',
            'city_id' => 961,
        ]);

        //La Esquina

        Neighborhood::create([
            'id' => 3258,
            'name' => 'La Esquina',
            'city_id' => 962,
        ]);

        //La Estancia

        Neighborhood::create([
            'id' => 3259,
            'name' => 'La Chilca',
            'city_id' => 963,
        ]);

        //La Estrella

        Neighborhood::create([
            'id' => 3260,
            'name' => 'La Estrella',
            'city_id' => 964,
        ]);

        //La Falda

        Neighborhood::create([
            'id' => 3261,
            'name' => 'La Falda',
            'city_id' => 965,
        ]);

        //La Falda de San Antonio

        Neighborhood::create([
            'id' => 3262,
            'name' => 'La Falda de San Antonio',
            'city_id' => 966,
        ]);

        //La Florida

        Neighborhood::create([
            'id' => 3263,
            'name' => 'La Florida',
            'city_id' => 967,
        ]);

        //La Granja

        Neighborhood::create([
            'id' => 3264,
            'name' => 'La Granja',
            'city_id' => 968,
        ]);

        //La Guadita

        Neighborhood::create([
            'id' => 3265,
            'name' => 'La Guadita',
            'city_id' => 969,
        ]);

        //La Guardia

        Neighborhood::create([
            'id' => 3266,
            'name' => 'La Guardia',
            'city_id' => 970,
        ]);

        //La Higuera

        Neighborhood::create([
            'id' => 3267,
            'name' => 'La Higuera',
            'city_id' => 971,
        ]);

        //La Higuerita

        Neighborhood::create([
            'id' => 3268,
            'name' => 'La Higuerita',
            'city_id' => 972,
        ]);

        //La Horqueta de Abajo

        Neighborhood::create([
            'id' => 3269,
            'name' => 'La Horqueta de Abajo',
            'city_id' => 973,
        ]);

        //La Horqueta de Arriba

        Neighborhood::create([
            'id' => 3270,
            'name' => 'La Horqueta de Arriba',
            'city_id' => 974,
        ]);

        //La Hoyada

        Neighborhood::create([
            'id' => 3271,
            'name' => 'La Hoyada',
            'city_id' => 975,
        ]);

        //La Huerta

        Neighborhood::create([
            'id' => 3272,
            'name' => 'La Huerta',
            'city_id' => 976,
        ]);

        //La Isla

        Neighborhood::create([
            'id' => 3273,
            'name' => 'La Isla',
            'city_id' => 977,
        ]);

        //La Jornada

        Neighborhood::create([
            'id' => 3274,
            'name' => 'La Jornada',
            'city_id' => 978,
        ]);

        //La Libertad

        Neighborhood::create([
            'id' => 3275,
            'name' => 'La Libertad',
            'city_id' => 979,
        ]);

        //La Loma

        Neighborhood::create([
            'id' => 3276,
            'name' => 'La Loma',
            'city_id' => 980,
        ]);

        //La Lomita

        Neighborhood::create([
            'id' => 3277,
            'name' => 'La Lomita',
            'city_id' => 981,
        ]);

        //La Majada

        Neighborhood::create([
            'id' => 3278,
            'name' => 'La Majada',
            'city_id' => 982,
        ]);

        //La Maravilla

        Neighborhood::create([
            'id' => 3279,
            'name' => 'La Maravilla',
            'city_id' => 983,
        ]);

        //La Merced

        Neighborhood::create([
            'id' => 3280,
            'name' => 'La Merced',
            'city_id' => 984,
        ]);

        //La Mesada

        Neighborhood::create([
            'id' => 3281,
            'name' => 'La Mesada',
            'city_id' => 985,
        ]);

        //La Montoza

        Neighborhood::create([
            'id' => 3282,
            'name' => 'La Montoza',
            'city_id' => 986,
        ]);

        //La Ovejería

        Neighborhood::create([
            'id' => 3283,
            'name' => 'La Ovejería',
            'city_id' => 987,
        ]);

        //La Parada

        Neighborhood::create([
            'id' => 3284,
            'name' => 'La Parada',
            'city_id' => 988,
        ]);

        //La Pastora

        Neighborhood::create([
            'id' => 3285,
            'name' => 'La Pastora',
            'city_id' => 989,
        ]);

        //La Patilla

        Neighborhood::create([
            'id' => 3286,
            'name' => 'La Patilla',
            'city_id' => 990,
        ]);

        //La Piedra Larga

        Neighborhood::create([
            'id' => 3287,
            'name' => 'La Piedra Larga',
            'city_id' => 991,
        ]);

        //La Porfía

        Neighborhood::create([
            'id' => 3288,
            'name' => 'La Porfía',
            'city_id' => 992,
        ]);

        //La Posición

        Neighborhood::create([
            'id' => 3289,
            'name' => 'La Posición',
            'city_id' => 993,
        ]);

        //La Posta

        Neighborhood::create([
            'id' => 3290,
            'name' => 'La Posta',
            'city_id' => 994,
        ]);

        //La Puerta

        Neighborhood::create([
            'id' => 3291,
            'name' => 'La Puerta',
            'city_id' => 995,
        ]);

        //La Puntilla

        Neighborhood::create([
            'id' => 3292,
            'name' => 'La Puntilla',
            'city_id' => 996,
        ]);

        //La Quebrada

        Neighborhood::create([
            'id' => 3293,
            'name' => 'La Quebrada',
            'city_id' => 997,
        ]);

        //La Quebrada del Cerco

        Neighborhood::create([
            'id' => 3294,
            'name' => 'La Quebrada del Cerco',
            'city_id' => 998,
        ]);

        //La Quebrada Honda


        Neighborhood::create([
            'id' => 3295,
            'name' => 'La Quebrada Honda',
            'city_id' => 999,
        ]);

        //La Quebradita

        Neighborhood::create([
            'id' => 3296,
            'name' => 'La Quebradita',
            'city_id' => 1000,
        ]);

        //La Quinta

        Neighborhood::create([
            'id' => 3297,
            'name' => 'La Quinta',
            'city_id' => 1001,
        ]);

        //La Ramada

        Neighborhood::create([
            'id' => 3298,
            'name' => 'La Ramada',
            'city_id' => 1002,
        ]);

        //La Ramadita

        Neighborhood::create([
            'id' => 3299,
            'name' => 'La Ramadita',
            'city_id' => 1003,
        ]);

        //La Rinconada

        Neighborhood::create([
            'id' => 3300,
            'name' => 'La Rinconada',
            'city_id' => 1004,
        ]);

        //La Rita

        Neighborhood::create([
            'id' => 3301,
            'name' => 'La Rita',
            'city_id' => 1005,
        ]);

        //La Sala

        Neighborhood::create([
            'id' => 3302,
            'name' => 'La Sala',
            'city_id' => 1006,
        ]);

        //La Sarnosa

        Neighborhood::create([
            'id' => 3303,
            'name' => 'La Sarnosa',
            'city_id' => 1007,
        ]);

        //La Sombrilla

        Neighborhood::create([
            'id' => 3304,
            'name' => 'La Sombrilla',
            'city_id' => 1008,
        ]);

        //La Tercena

        Neighborhood::create([
            'id' => 3305,
            'name' => 'La Tercena',
            'city_id' => 1009,
        ]);

        //La Tercera

        Neighborhood::create([
            'id' => 3306,
            'name' => 'La Tercera',
            'city_id' => 1010,
        ]);

        //La Tigra

        Neighborhood::create([
            'id' => 3307,
            'name' => 'La Tigra',
            'city_id' => 1011,
        ]);

        //La Toma

        Neighborhood::create([
            'id' => 3308,
            'name' => 'La Toma',
            'city_id' => 1012,
        ]);

        //La Tuna

        Neighborhood::create([
            'id' => 3309,
            'name' => 'La Tuna',
            'city_id' => 1013,
        ]);

        //La Tunita

        Neighborhood::create([
            'id' => 3310,
            'name' => 'La Tunita',
            'city_id' => 1014,
        ]);

        //La Tusca

        Neighborhood::create([
            'id' => 3311,
            'name' => 'La Tusca',
            'city_id' => 1015,
        ]);

        //La Valentina

        Neighborhood::create([
            'id' => 3312,
            'name' => 'La Valentina',
            'city_id' => 1016,
        ]);

        //La Viña

        Neighborhood::create([
            'id' => 3313,
            'name' => 'La Viña',
            'city_id' => 1017,
        ]);

        //La Viñita

        Neighborhood::create([
            'id' => 3314,
            'name' => 'La Viñita',
            'city_id' => 1018,
        ]);

        //La Zarza

        Neighborhood::create([
            'id' => 3315,
            'name' => 'La Zarza',
            'city_id' => 1019,
        ]);

        //Laguna Grande

        Neighborhood::create([
            'id' => 3316,
            'name' => 'Laguna Grande',
            'city_id' => 1020,
        ]);

        //Lagunita

        Neighborhood::create([
            'id' => 3317,
            'name' => 'Lagunita',
            'city_id' => 1021,
        ]);

        //Lampacito

        Neighborhood::create([
            'id' => 3318,
            'name' => 'Lampacito',
            'city_id' => 1022,
        ]);

        //Las Agüitas

        Neighborhood::create([
            'id' => 3319,
            'name' => 'Las Agüitas',
            'city_id' => 1023,
        ]);

        //Las Barrancas

        Neighborhood::create([
            'id' => 3320,
            'name' => 'Las Barrancas',
            'city_id' => 1024,
        ]);

        //Las Bateas

        Neighborhood::create([
            'id' => 3321,
            'name' => 'Las Bateas',
            'city_id' => 1025,
        ]);

        //Las Cananas

        Neighborhood::create([
            'id' => 3322,
            'name' => 'Las Cananas',
            'city_id' => 1026,
        ]);

        //Las Cañadas

        Neighborhood::create([
            'id' => 3323,
            'name' => 'La Cañadas',
            'city_id' => 1027,
        ]);

        //Las Cañas

        Neighborhood::create([
            'id' => 3324,
            'name' => 'Las Cañas',
            'city_id' => 1028,
        ]);

        //Las Chacritas

        Neighborhood::create([
            'id' => 3325,
            'name' => 'Las Chacritas',
            'city_id' => 1029,
        ]);

        //La Cuestecilla

        Neighborhood::create([
            'id' => 3326,
            'name' => 'La Cuestecilla',
            'city_id' => 1030,
        ]);

        //Las Cuevas

        Neighborhood::create([
            'id' => 3327,
            'name' => 'Las Cuevas',
            'city_id' => 1031,
        ]);

        //Las Encrucijadas

        Neighborhood::create([
            'id' => 3328,
            'name' => 'Las Encrucijadas',
            'city_id' => 1032,
        ]);

        //Las Esquinas

        Neighborhood::create([
            'id' => 3329,
            'name' => 'Las Esquinas',
            'city_id' => 1033,
        ]);

        //Las Flores

        Neighborhood::create([
            'id' => 3330,
            'name' => 'Las Flores',
            'city_id' => 1034,
        ]);

        //Las Granadadillas

        Neighborhood::create([
            'id' => 3331,
            'name' => 'Las Granadillas',
            'city_id' => 1035,
        ]);

        //Las Higueras

        Neighborhood::create([
            'id' => 3332,
            'name' => 'Las Higueras',
            'city_id' => 1036,
        ]);

        //Las Higueritas

        Neighborhood::create([
            'id' => 3333,
            'name' => 'Las Higueritas',
            'city_id' => 1037,
        ]);

        //Las Huertas

        Neighborhood::create([
            'id' => 3334,
            'name' => 'Las Huertass',
            'city_id' => 1038,
        ]);

        //Las Juntas

        Neighborhood::create([
            'id' => 3335,
            'name' => 'Las Juntas',
            'city_id' => 1039,
        ]);

        //Las Lajas

        Neighborhood::create([
            'id' => 3336,
            'name' => 'Las Lajas',
            'city_id' => 1040,
        ]);

        //Las Lomas

        Neighborhood::create([
            'id' => 3337,
            'name' => 'Las Lomas',
            'city_id' => 1041,
        ]);

        //Las Lomitas

        Neighborhood::create([
            'id' => 3338,
            'name' => 'Las Lomitas',
            'city_id' => 1042,
        ]);

        //Las Malvinas

        Neighborhood::create([
            'id' => 3339,
            'name' => 'Las Malvinas',
            'city_id' => 1043,
        ]);

        //Las Mesadas

        Neighborhood::create([
            'id' => 3340,
            'name' => 'Las Mesadas',
            'city_id' => 1044,
        ]);

        //Las Mojarras

        Neighborhood::create([
            'id' => 3341,
            'name' => 'Las Esquinas',
            'city_id' => 1045,
        ]);

        //Las Morcillas

        Neighborhood::create([
            'id' => 3342,
            'name' => 'Las Morcillas',
            'city_id' => 1046,
        ]);

        //Las Palmas

        Neighborhood::create([
            'id' => 3343,
            'name' => 'Las Palmas',
            'city_id' => 1047,
        ]);

        //Las Palmitas

        Neighborhood::create([
            'id' => 3344,
            'name' => 'Las Palmitas',
            'city_id' => 1048,
        ]);

        //Las Peñas

        Neighborhood::create([
            'id' => 3345,
            'name' => 'Las Peñas',
            'city_id' => 1049,
        ]);

        //Las Piedras Blancas

        Neighborhood::create([
            'id' => 3346,
            'name' => 'LasPiedras Blancas',
            'city_id' => 1050,
        ]);

        //Las Piedritas

        Neighborhood::create([
            'id' => 3347,
            'name' => 'Las Piedritas',
            'city_id' => 1051,
        ]);

        //Las Rosas

        Neighborhood::create([
            'id' => 3348,
            'name' => 'Las Rosas',
            'city_id' => 1052,
        ]);

        //Las Ruditas

        Neighborhood::create([
            'id' => 3349,
            'name' => 'Las Ruditas',
            'city_id' => 1053,
        ]);

        //Las Tejas

        Neighborhood::create([
            'id' => 3350,
            'name' => 'Las Tejas',
            'city_id' => 1054,
        ]);

        //Las Termas

        Neighborhood::create([
            'id' => 3351,
            'name' => 'Las Termas',
            'city_id' => 1055,
        ]);

        //Las Toscas

        Neighborhood::create([
            'id' => 3352,
            'name' => 'Las Toscas',
            'city_id' => 1056,
        ]);

        //Las Tunas

        Neighborhood::create([
            'id' => 3353,
            'name' => 'Las Tunas',
            'city_id' => 1057,
        ]);

        //Lavalle

        Neighborhood::create([
            'id' => 3354,
            'name' => 'Lavalle',
            'city_id' => 1058,
        ]);

        //Loconte

        Neighborhood::create([
            'id' => 3355,
            'name' => 'Loconte',
            'city_id' => 1059,
        ]);

        //Loma Bola

        Neighborhood::create([
            'id' => 3356,
            'name' => 'Loma Bola',
            'city_id' => 1060,
        ]);

        //Loma Cortada

        Neighborhood::create([
            'id' => 3357,
            'name' => 'Loma Cortada',
            'city_id' => 1061,
        ]);

        //Loma de las Tordillas

        Neighborhood::create([
            'id' => 3358,
            'name' => 'Loma de las Tordillas',
            'city_id' => 1062,
        ]);

        //Loma Pelada

        Neighborhood::create([
            'id' => 3359,
            'name' => 'Loma Pelada',
            'city_id' => 1063,
        ]);

        //Londres

        Neighborhood::create([
            'id' => 3360,
            'name' => 'Londres',
            'city_id' => 1064,
        ]);

        //Loro Huasi

        Neighborhood::create([
            'id' => 3361,
            'name' => 'Loro Huasi',
            'city_id' => 1065,
        ]);

        //Los Algarrobos

        Neighborhood::create([
            'id' => 3362,
            'name' => 'Los Algarrobos',
            'city_id' => 1066,
        ]);

        //Los Altos

        Neighborhood::create([
            'id' => 3363,
            'name' => 'Los Altos',
            'city_id' => 1067,
        ]);

        //Los Balverdi

        Neighborhood::create([
            'id' => 3364,
            'name' => 'Los Balverdi',
            'city_id' => 1068,
        ]);

        //Los Barrionuevos

        Neighborhood::create([
            'id' => 3365,
            'name' => 'Las Esquinas',
            'city_id' => 1069,
        ]);

        //Los Bastidores

        Neighborhood::create([
            'id' => 3366,
            'name' => 'Los Bastidores',
            'city_id' => 1070,
        ]);

        //Los Cano

        Neighborhood::create([
            'id' => 3367,
            'name' => 'Los Cano',
            'city_id' => 1071,
        ]);

        //Los Castillos

        Neighborhood::create([
            'id' => 3368,
            'name' => 'Los Castillos',
            'city_id' => 1072,
        ]);

        //Los Colorados

        Neighborhood::create([
            'id' => 3369,
            'name' => 'Las Esquinas',
            'city_id' => 1073,
        ]);

        //Los Corrales

        Neighborhood::create([
            'id' => 3370,
            'name' => 'Los Corrales',
            'city_id' => 1074,
        ]);

        //Los Divisaderos

        Neighborhood::create([
            'id' => 3371,
            'name' => 'Los Divisaderos',
            'city_id' => 1075,
        ]);

        //Los Hoyitos

        Neighborhood::create([
            'id' => 3372,
            'name' => 'Los Hoyitos',
            'city_id' => 1076,
        ]);

        //Los Maidana

        Neighborhood::create([
            'id' => 3373,
            'name' => 'Las Maidana',
            'city_id' => 1077,
        ]);

        //Los Membrillos

        Neighborhood::create([
            'id' => 3374,
            'name' => 'Los Membrillos',
            'city_id' => 1078,
        ]);

        //Los Mertecos

        Neighborhood::create([
            'id' => 3375,
            'name' => 'Los Mertecos',
            'city_id' => 1079,
        ]);

        //Los Mistoles

        Neighborhood::create([
            'id' => 3376,
            'name' => 'Los Mistoles',
            'city_id' => 1080,
        ]);

        //Los Mogotes

        Neighborhood::create([
            'id' => 3377,
            'name' => 'Los Mogotes',
            'city_id' => 1081,
        ]);

        //Los Molles

        Neighborhood::create([
            'id' => 3378,
            'name' => 'Los Molles',
            'city_id' => 1082,
        ]);

        //Los Morales

        Neighborhood::create([
            'id' => 3379,
            'name' => 'Los Morales',
            'city_id' => 1083,
        ]);

        //Los Nacimientos

        Neighborhood::create([
            'id' => 3380,
            'name' => 'Los Nacimientos',
            'city_id' => 1084,
        ]);

        //Los Narvaez

        Neighborhood::create([
            'id' => 3381,
            'name' => 'Los Narvaez',
            'city_id' => 1085,
        ]);

        //Los Navarros

        Neighborhood::create([
            'id' => 3382,
            'name' => 'Los navarros',
            'city_id' => 1086,
        ]);

        //Los Pequillines

        Neighborhood::create([
            'id' => 3383,
            'name' => 'Los Pequillines',
            'city_id' => 1087,
        ]);

        //Los Ortices

        Neighborhood::create([
            'id' => 3384,
            'name' => 'Los Ortices',
            'city_id' => 1088,
        ]);

        //Los Potrerillos

        Neighborhood::create([
            'id' => 3385,
            'name' => 'Los Potrecillos',
            'city_id' => 1089,
        ]);

        //Los Pozos

        Neighborhood::create([
            'id' => 3386,
            'name' => 'Los Pozos',
            'city_id' => 1090,
        ]);

        //Los Quinteros

        Neighborhood::create([
            'id' => 3387,
            'name' => 'Los Quinteros',
            'city_id' => 1091,
        ]);

        //Los Quirquinchos

        Neighborhood::create([
            'id' => 3388,
            'name' => 'Los Quiquinchos',
            'city_id' => 1092,
        ]);

        //Los Raigones

        Neighborhood::create([
            'id' => 3389,
            'name' => 'Los Raigones',
            'city_id' => 1093,
        ]);

        //Los Ranchillos

        Neighborhood::create([
            'id' => 3390,
            'name' => 'Los Ranchillos',
            'city_id' => 1094,
        ]);

        //Los Robledos

        Neighborhood::create([
            'id' => 3391,
            'name' => 'Los Robledos',
            'city_id' => 1095,
        ]);

        //Los Sauces

        Neighborhood::create([
            'id' => 3392,
            'name' => 'Los Sauces',
            'city_id' => 1096,
        ]);

        //Los Talas

        Neighborhood::create([
            'id' => 3393,
            'name' => 'Los Talas',
            'city_id' => 1097,
        ]);

        //Los Tarquitos

        Neighborhood::create([
            'id' => 3394,
            'name' => 'Los Tarquitos',
            'city_id' => 1098,
        ]);

        //Los Troncos

        Neighborhood::create([
            'id' => 3395,
            'name' => 'Los Troncos',
            'city_id' => 1099,
        ]);

        //Los Varela

        Neighborhood::create([
            'id' => 3396,
            'name' => 'Los Varela',
            'city_id' => 1100,
        ]);

        //Los Alamos

        Neighborhood::create([
            'id' => 3397,
            'name' => 'Los Alamos',
            'city_id' => 1101,
        ]);

        //Los Angeles

        Neighborhood::create([
            'id' => 3398,
            'name' => 'Los Angeles',
            'city_id' => 1102,
        ]);

        //Manantiales

        Neighborhood::create([
            'id' => 3399,
            'name' => 'Manantiales',
            'city_id' => 1103,
        ]);

        //Mariguaca

        Neighborhood::create([
            'id' => 3400,
            'name' => 'MAriguaca',
            'city_id' => 1104,
        ]);

        //Maria Elena

        Neighborhood::create([
            'id' => 3401,
            'name' => 'Maria Elena',
            'city_id' => 1105,
        ]);

        //Medanitos

        Neighborhood::create([
            'id' => 3402,
            'name' => 'Medanitos',
            'city_id' => 1106,
        ]);

        //Mira Flores

        Neighborhood::create([
            'id' => 3403,
            'name' => 'Mira Flores',
            'city_id' => 1107,
        ]);

        //Monte Potrero

        Neighborhood::create([
            'id' => 3404,
            'name' => 'Monte Potrero',
            'city_id' => 1108,
        ]);

        //Monte Redondo

        Neighborhood::create([
            'id' => 3405,
            'name' => 'Monte Redondo',
            'city_id' => 1109,
        ]);

        //Mutquin

        Neighborhood::create([
            'id' => 3406,
            'name' => 'Mutquin',
            'city_id' => 1110,
        ]);

        //Navaguin

        Neighborhood::create([
            'id' => 3407,
            'name' => 'Navaguin',
            'city_id' => 1111,
        ]);

        //Nueva Coneta

        Neighborhood::create([
            'id' => 3408,
            'name' => 'Nueva Coneta',
            'city_id' => 1112,
        ]);

        //Ojo de Agua

        Neighborhood::create([
            'id' => 3409,
            'name' => 'Ojo de Agua',
            'city_id' => 1113,
        ]);

        //Olta

        Neighborhood::create([
            'id' => 3410,
            'name' => 'Olta',
            'city_id' => 1114,
        ]);

        //Orquera

        Neighborhood::create([
            'id' => 3411,
            'name' => 'Orquera',
            'city_id' => 1115,
        ]);


        //Ovanta

        Neighborhood::create([
            'id' => 3413,
            'name' => 'Ovanta',
            'city_id' => 1117,
        ]);

        //Oyola

        Neighborhood::create([
            'id' => 3414,
            'name' => 'Oyola',
            'city_id' => 1118,
        ]);

        //Paclin

        Neighborhood::create([
            'id' => 3415,
            'name' => 'Paclin',
            'city_id' => 1119,
        ]);

        //Pajanguillo

        Neighborhood::create([
            'id' => 3416,
            'name' => 'Pajanguillo',
            'city_id' => 1120,
        ]);

        //Palermo

        Neighborhood::create([
            'id' => 3417,
            'name' => 'Palermo',
            'city_id' => 1121,
        ]);

        //Pablo Blanco

        Neighborhood::create([
            'id' => 3418,
            'name' => 'Pablo Blanco',
            'city_id' => 1122,
        ]);

        //Palo Labrado

        Neighborhood::create([
            'id' => 3419,
            'name' => 'Palo Labrado',
            'city_id' => 1123,
        ]);

        //Palo Santo

        Neighborhood::create([
            'id' => 3420,
            'name' => 'Palo Santo',
            'city_id' => 1124,
        ]);

        //Palo Seco

        Neighborhood::create([
            'id' => 3421,
            'name' => 'Palo Seco',
            'city_id' => 1125,
        ]);

        //Paloma Yaco

        Neighborhood::create([
            'id' => 3422,
            'name' => 'Paloma Yaco',
            'city_id' => 1126,
        ]);

        //Pampa Blanca

        Neighborhood::create([
            'id' => 3423,
            'name' => 'Pampa Blanca',
            'city_id' => 1127,
        ]);

        //Pampa Cienaga

        Neighborhood::create([
            'id' => 3424,
            'name' => 'Pampa Cienaga',
            'city_id' => 1128,
        ]);

        //Papachacra

        Neighborhood::create([
            'id' => 3425,
            'name' => 'Papachacra',
            'city_id' => 1129,
        ]);

        //Payahuaico

        Neighborhood::create([
            'id' => 3426,
            'name' => 'Payahuaico',
            'city_id' => 1130,
        ]);

        //Paycuqui

        Neighborhood::create([
            'id' => 3427,
            'name' => 'Paycuqui',
            'city_id' => 1131,
        ]);

        //Pecanitas

        Neighborhood::create([
            'id' => 3428,
            'name' => 'Pecanitas',
            'city_id' => 1132,
        ]);

        //Pena

        Neighborhood::create([
            'id' => 3429,
            'name' => 'Pena',
            'city_id' => 1133,
        ]);

        //Pichanal

        Neighborhood::create([
            'id' => 3430,
            'name' => 'Pichanal',
            'city_id' => 1134,
        ]);

        //Piedra Parada

        Neighborhood::create([
            'id' => 3431,
            'name' => 'Piedra Parada',
            'city_id' => 1135,
        ]);

        //Piedra Pintada

        Neighborhood::create([
            'id' => 3432,
            'name' => 'Piedra Pintada',
            'city_id' => 1136,
        ]);

        //Polcos

        Neighborhood::create([
            'id' => 3433,
            'name' => 'Polcos',
            'city_id' => 1137,
        ]);

        //Pomancillo Este

        Neighborhood::create([
            'id' => 3435,
            'name' => 'Pomancillo Este',
            'city_id' => 1138,
        ]);

        //Pomancillo Oeste

        Neighborhood::create([
            'id' => 3436,
            'name' => 'Pomancillo Oeste',
            'city_id' => 1139,
        ]);

        //Poman

        Neighborhood::create([
            'id' => 3437,
            'name' => 'Poman',
            'city_id' => 1140,
        ]);

        //Potropiana

        Neighborhood::create([
            'id' => 3438,
            'name' => 'Potropiana',
            'city_id' => 1141,
        ]);

        //Pozo de Abajo

        Neighborhood::create([
            'id' => 3439,
            'name' => 'Pozo de Abajo',
            'city_id' => 1142,
        ]);

        //Pozo de la Orilla

        Neighborhood::create([
            'id' => 3440,
            'name' => 'Piedra Parada',
            'city_id' => 1143,
        ]);

        //Pozo de la Piedra

        Neighborhood::create([
            'id' => 3441,
            'name' => 'Pozo de la Piedra',
            'city_id' => 1144,
        ]);

        //Pozo del Mistol

        Neighborhood::create([
            'id' => 3442,
            'name' => 'Pozo del Mistol',
            'city_id' => 1145,
        ]);

        //Pozo El Mistol

        Neighborhood::create([
            'id' => 3443,
            'name' => 'Pozo El Mistol',
            'city_id' => 1146,
        ]);

        //Pozo Grande

        Neighborhood::create([
            'id' => 3444,
            'name' => 'Pozo Grande',
            'city_id' => 1147,
        ]);

        //Pozo Lindo

        Neighborhood::create([
            'id' => 3445,
            'name' => 'Pozo Lindo',
            'city_id' => 1148,
        ]);

        //Pozo Tigre


        //Pozos Cavados

        Neighborhood::create([
            'id' => 3446,
            'name' => 'Pozos Cavados',
            'city_id' => 1150,
        ]);

        //Puerta de Corral Quemado

        Neighborhood::create([
            'id' => 3447,
            'name' => 'Puerta de Corral Quemado',
            'city_id' => 1151,
        ]);

        //Puerta de Molle Yaco

        Neighborhood::create([
            'id' => 3448,
            'name' => 'Puerta de Molle Yaco',
            'city_id' => 1152,
        ]);

        //Puerta de San Jose

        Neighborhood::create([
            'id' => 3449,
            'name' => 'Puerta de San Jose',
            'city_id' => 1153,
        ]);

        //Puerta Grande

        Neighborhood::create([
            'id' => 3450,
            'name' => 'Puerta Grande',
            'city_id' => 1154,
        ]);

        //Puerto Fernandez

        Neighborhood::create([
            'id' => 3451,
            'name' => 'Puerto Fernandez',
            'city_id' => 1155,
        ]);

        //Puerto Carrizo

        Neighborhood::create([
            'id' => 3452,
            'name' => 'Puesto Carrizo',
            'city_id' => 1156,
        ]);

        //Puesto de Acevedo

        Neighborhood::create([
            'id' => 3453,
            'name' => 'Puesto de Acevedo',
            'city_id' => 1157,
        ]);

        //Puesto de leiva

        Neighborhood::create([
            'id' => 3454,
            'name' => 'Puesto de Leiva',
            'city_id' => 1158,
        ]);

        //Puesto de Miranda

        Neighborhood::create([
            'id' => 3455,
            'name' => 'Puesto de Miranda',
            'city_id' => 1159,
        ]);

        //Puesto de Nazar

        Neighborhood::create([
            'id' => 3456,
            'name' => 'Puesto de Nazar',
            'city_id' => 1160,
        ]);

        //Puesto de Siman

        Neighborhood::create([
            'id' => 3457,
            'name' => 'Puesto de Siman',
            'city_id' => 1161,
        ]);

        //Puesto de Vera

        Neighborhood::create([
            'id' => 3458,
            'name' => 'Puesta de Vera',
            'city_id' => 1162,
        ]);

        //Puesto del Medio

        Neighborhood::create([
            'id' => 3459,
            'name' => 'Puesto del Medio',
            'city_id' => 1163,
        ]);



        //Puesto El Leoncito

        Neighborhood::create([
            'id' => 3460,
            'name' => 'Puesto El Leoncito',
            'city_id' => 1165,
        ]);

        //Puesto El Medio

        Neighborhood::create([
            'id' => 3461,
            'name' => 'Puesto el Medio',
            'city_id' => 1166,
        ]);

        //Puesto Gracian

        Neighborhood::create([
            'id' => 3462,
            'name' => 'Puesto Gracian',
            'city_id' => 1167 ,
        ]);

        //Puesto Grande

        Neighborhood::create([
            'id' => 3463,
            'name' => 'Puesto Grande',
            'city_id' => 1168,
        ]);

        //Puesto Helado

        Neighborhood::create([
            'id' => 3464,
            'name' => 'Puesto Helado',
            'city_id' => 1169,
        ]);

        //Puesto La Cruz

        Neighborhood::create([
            'id' => 3465,
            'name' => 'Puesto La Cruz',
            'city_id' => 1170,
        ]);

        //Puesto La Morada

        Neighborhood::create([
            'id' => 3466,
            'name' => 'Puesto La Morada',
            'city_id' => 1171,
        ]);

        //Puesto La Viuda

        Neighborhood::create([
            'id' => 3467,
            'name' => 'Puesto La Viuda',
            'city_id' => 1172,
        ]);

        //Puesto los Carrizos

        Neighborhood::create([
            'id' => 3468,
            'name' => 'Puesto Los Carrizos',
            'city_id' => 1173,
        ]);

        //Puesto Los Molinos

        Neighborhood::create([
            'id' => 3469,
            'name' => 'Puesto los Molinos',
            'city_id' => 1174,
        ]);

        //Puesto Mascareño

        Neighborhood::create([
            'id' => 3470,
            'name' => 'Piedra Parada',
            'city_id' => 1175,
        ]);

        //Puesto Mi Refugio

        Neighborhood::create([
            'id' => 3471,
            'name' => 'Puesto Mi Refugio',
            'city_id' => 1176,
        ]);

        //Puesto Nuevo

        Neighborhood::create([
            'id' => 3472,
            'name' => 'Puesto Nuevo',
            'city_id' => 1177,
        ]);

        //Puesto Ponce

        Neighborhood::create([
            'id' => 3473,
            'name' => 'Puesto Ponce',
            'city_id' => 1178,
        ]);

        //Puesto Ruminoque

        Neighborhood::create([
            'id' => 3474,
            'name' => 'Puesto Ruminoque',
            'city_id' => 1179,
        ]);

        //Puesto Sabatea

        Neighborhood::create([
            'id' => 3475,
            'name' => 'Puesto Sabatea',
            'city_id' => 1180,
        ]);

        //Puesto Santa Rosa

        Neighborhood::create([
            'id' => 3476,
            'name' => 'Puesto Santa Rosa',
            'city_id' => 1181,
        ]);

        //Puesto Serafin

        Neighborhood::create([
            'id' => 3477,
            'name' => 'Puesto Serafin',
            'city_id' => 1182,
        ]);

        //Puesto Sin Nombre

        Neighborhood::create([
            'id' => 3478,
            'name' => 'Puesto Sin Nombre',
            'city_id' => 1183,
        ]);

        //Puesto Capayan

        Neighborhood::create([
            'id' => 3479,
            'name' => 'Puesto Capayan',
            'city_id' => 1184,
        ]);

        //Puesto de Concepción

        Neighborhood::create([
            'id' => 3480,
            'name' => 'Puesto de Concepción',
            'city_id' => 1185,
        ]);

        //Pum Huasi

        Neighborhood::create([
            'id' => 3481,
            'name' => 'Pum Huasi',
            'city_id' => 1186,
        ]);

        //Punta de Balasto

        Neighborhood::create([
            'id' => 3482,
            'name' => 'Punta de Balasto',
            'city_id' => 1187,
        ]);

        //Puesto del Agua

        Neighborhood::create([
            'id' => 3483,
            'name' => 'Puesto del Agua',
            'city_id' => 1188,
        ]);

        //Quebrachos Blancos

        Neighborhood::create([
            'id' => 3484,
            'name' => 'Quebrachos Blancos',
            'city_id' => 1189,
        ]);

        //Quebrada Belen

        Neighborhood::create([
            'id' => 3485,
            'name' => 'Quebrada Belén',
            'city_id' => 1190,
        ]);


        //Quebrada el Cura

        Neighborhood::create([
            'id' => 3486,
            'name' => 'Quebrada El Cura',
            'city_id' => 1192,
        ]);

        //Quiros

        Neighborhood::create([
            'id' => 3487,
            'name' => 'Quiros',
            'city_id' => 1193,
        ]);

        //Ramblones

        Neighborhood::create([
            'id' => 3488,
            'name' => 'Ramblones',
            'city_id' => 1194,
        ]);

        //Recreo

        Neighborhood::create([
            'id' => 3489,
            'name' => 'Recreo',
            'city_id' => 1195,
        ]);

        //Rodeo Chiquito

        Neighborhood::create([
            'id' => 3490,
            'name' => 'Rodeo Chiquito',
            'city_id' => 1196,
        ]);

        //Rodeo Grande

        Neighborhood::create([
            'id' => 3491,
            'name' => 'Piedra Parada',
            'city_id' => 1197,
        ]);

        //Ruta 13

        Neighborhood::create([
            'id' => 3492,
            'name' => 'Ruta 13',
            'city_id' => 1198,
        ]);

        //Rio Chico

        Neighborhood::create([
            'id' => 3493,
            'name' => 'Rio Chico',
            'city_id' => 1199,
        ]);

        //Río Colorado

        Neighborhood::create([
            'id' => 3494,
            'name' => 'Río Colorado',
            'city_id' => 1200,
        ]);

        //Rio de la Puerta

        Neighborhood::create([
            'id' => 3495,
            'name' => 'Rio de la Puerta',
            'city_id' => 1201,
        ]);

        //Rio de las Casas Viejas

        Neighborhood::create([
            'id' => 3496,
            'name' => 'Rio de las Casa Viejas',
            'city_id' => 1202,
        ]);

        //Río Los Morteros

        Neighborhood::create([
            'id' => 3497,
            'name' => 'Rio los Morteros',
            'city_id' => 1203,
        ]);

        //Rio Potrero

        Neighborhood::create([
            'id' => 3498,
            'name' => 'Rio Potrero',
            'city_id' => 1204,
        ]);

        //Salauca

        Neighborhood::create([
            'id' => 3499,
            'name' => 'Salauca',
            'city_id' => 1205,
        ]);

        //Salcito

        Neighborhood::create([
            'id' => 3500,
            'name' => 'Salcito',
            'city_id' => 1206,
        ]);

        //San Agustin

        Neighborhood::create([
            'id' => 3501,
            'name' => 'San Agustin',
            'city_id' => 1207,
        ]);

        //San Antonio (Paclin)

        Neighborhood::create([
            'id' => 3502,
            'name' => 'San Antonio (Paclin)',
            'city_id' => 1208,
        ]);

        //San Bernardo

        Neighborhood::create([
            'id' => 3503,
            'name' => 'San Bernardo',
            'city_id' => 1209,
        ]);

        //San Carlos

        Neighborhood::create([
            'id' => 3504,
            'name' => 'San Carlos',
            'city_id' => 1210,
        ]);

        //San Fernando

        Neighborhood::create([
            'id' => 3505,
            'name' => 'San Fernando',
            'city_id' => 1211,
        ]);

        //San Francisco

        Neighborhood::create([
            'id' => 3506,
            'name' => 'San Francisco',
            'city_id' => 1212,
        ]);

        //San Gabriel

        Neighborhood::create([
            'id' => 3507,
            'name' => 'San Gabriel',
            'city_id' => 1213,
        ]);

        //San Geronimo

        Neighborhood::create([
            'id' => 3508,
            'name' => 'San Geronimo',
            'city_id' => 1214,
        ]);

        //San Isidro

        Neighborhood::create([
            'id' => 3509,
            'name' => 'San Isidro',
            'city_id' => 1215,
        ]);

        //San Jeronimo

        Neighborhood::create([
            'id' => 3510,
            'name' => 'San Jeronimo',
            'city_id' => 1216,
        ]);

        //San José

        Neighborhood::create([
            'id' => 3511,
            'name' => 'San José',
            'city_id' => 1217,
        ]);

        //San Jose Banda

        Neighborhood::create([
            'id' => 3512,
            'name' => 'San Jose Banda',
            'city_id' => 1218,
        ]);

        //San Jose Norte

        Neighborhood::create([
            'id' => 3513,
            'name' => 'San Jose Norte',
            'city_id' => 1219,
        ]);

        //San Jose Villa

        Neighborhood::create([
            'id' => 3514,
            'name' => 'San Jose Villa',
            'city_id' => 1220,
        ]);

        //San Lorenzo

        Neighborhood::create([
            'id' => 3515,
            'name' => 'San Lorenzo',
            'city_id' => 1221,
        ]);

        //San Martin

        Neighborhood::create([
            'id' => 3516,
            'name' => 'San Martín',
            'city_id' => 1222,
        ]);

        //San Pablo

        Neighborhood::create([
            'id' => 3517,
            'name' => 'San Pablo',
            'city_id' => 1223,
        ]);

        //San Pedro

        Neighborhood::create([
            'id' => 3518,
            'name' => 'San Pedro',
            'city_id' => 1224,
        ]);

        //San Ramon

        Neighborhood::create([
            'id' => 3519,
            'name' => 'San Ramon',
            'city_id' => 1225,
        ]);

        //San Salvador

        Neighborhood::create([
            'id' => 3520,
            'name' => 'San Salvador',
            'city_id' => 1226,
        ]);

        //Santa Ana

        Neighborhood::create([
            'id' => 3521,
            'name' => 'Santa Ana',
            'city_id' => 1227,
        ]);

        //Santa Cruz

        Neighborhood::create([
            'id' => 3522,
            'name' => 'Santa Cruz',
            'city_id' => 1228,
        ]);

        //Santa María

        Neighborhood::create([
            'id' => 3523,
            'name' => 'Santa María',
            'city_id' => 1229,
        ]);

        //Santa Rosa

        Neighborhood::create([
            'id' => 3524,
            'name' => 'Santa Rosa',
            'city_id' => 1230,
        ]);

        //Santo Domingo

        Neighborhood::create([
            'id' => 3525,
            'name' => 'Santo Domingo',
            'city_id' => 1231,
        ]);

        //Santo Tomas

        Neighborhood::create([
            'id' => 3526,
            'name' => 'Santo Tomas',
            'city_id' => 1232,
        ]);

        //Sauce Guacho

        Neighborhood::create([
            'id' => 3527,
            'name' => 'Sauce Huacho',
            'city_id' => 1233,
        ]);

        //Saujil

        Neighborhood::create([
            'id' => 3528,
            'name' => 'Saujil',
            'city_id' => 1234,
        ]);

        //Sicha

        Neighborhood::create([
            'id' => 3529,
            'name' => 'Sicha',
            'city_id' => 1235,
        ]);

        //Simogasta

        Neighborhood::create([
            'id' => 3530,
            'name' => 'Simogasta',
            'city_id' => 1236,
        ]);

        //Singuil

        Neighborhood::create([
            'id' => 3531,
            'name' => 'Singuil',
            'city_id' => 1237,
        ]);

        //Sisi Huasi

        Neighborhood::create([
            'id' => 3532,
            'name' => 'Sisi Huasi',
            'city_id' => 1238,
        ]);

        //Sol de Mayo

        Neighborhood::create([
            'id' => 3533,
            'name' => 'Sol de Mayo',
            'city_id' => 1239,
        ]);

        //Sumalao

        Neighborhood::create([
            'id' => 3534,
            'name' => 'Sumalao',
            'city_id' => 1240,
        ]);

        //Sumampa

        Neighborhood::create([
            'id' => 3535,
            'name' => 'Sumampa',
            'city_id' => 1241,
        ]);

        //Tabigasta

        Neighborhood::create([
            'id' => 3536,
            'name' => 'Tabigasta',
            'city_id' => 1242,
        ]);

        //San Tacana

        Neighborhood::create([
            'id' => 3537,
            'name' => 'San Tacana',
            'city_id' => 1243,
        ]);

        //Taco Yaco

        Neighborhood::create([
            'id' => 3538,
            'name' => 'Taco Yaco',
            'city_id' => 1244,
        ]);

        //Taco Yacu

        Neighborhood::create([
            'id' => 3539,
            'name' => 'Taco Yacu',
            'city_id' => 1245,
        ]);

        //Talaguada

        Neighborhood::create([
            'id' => 3540,
            'name' => 'Talaguada',
            'city_id' => 1246,
        ]);

        //Talasi

        Neighborhood::create([
            'id' => 3541,
            'name' => 'Talasi',
            'city_id' => 1247,
        ]);

        //Talcutan

        Neighborhood::create([
            'id' => 3542,
            'name' => 'Talcutan',
            'city_id' => 1248,
        ]);

        //Tapso

        Neighborhood::create([
            'id' => 3543,
            'name' => 'Tapso',
            'city_id' => 1249,
        ]);

        //Tascana

        Neighborhood::create([
            'id' => 3544,
            'name' => 'Tascana',
            'city_id' => 1250,
        ]);

        //Taton

        Neighborhood::create([
            'id' => 3545,
            'name' => 'Taton',
            'city_id' => 1251,
        ]);

        //Telaritos

        Neighborhood::create([
            'id' => 3546,
            'name' => 'Telaritos',
            'city_id' => 1252,
        ]);

        //Tierra Verde

        Neighborhood::create([
            'id' => 3547,
            'name' => 'Tierra Verde',
            'city_id' => 1253,
        ]);

        //Tintigasta

        Neighborhood::create([
            'id' => 3548,
            'name' => 'Tintigasta',
            'city_id' => 1254,
        ]);

        //Totorilla

        Neighborhood::create([
            'id' => 3549,
            'name' => 'Totorilla',
            'city_id' => 1255,
        ]);

        //Trampasacha

        Neighborhood::create([
            'id' => 3550,
            'name' => 'Trampasacha',
            'city_id' => 1256,
        ]);

        //Trapiche

        Neighborhood::create([
            'id' => 3551,
            'name' => 'Trapiche',
            'city_id' => 1257,
        ]);

        //Tras Río

        Neighborhood::create([
            'id' => 3552,
            'name' => 'Tras Río',
            'city_id' => 1258,
        ]);

        //Tres Sauces

        Neighborhood::create([
            'id' => 3553,
            'name' => 'Tres Sauces',
            'city_id' => 1259,
        ]);

        //Vacas Muertas

        Neighborhood::create([
            'id' => 3554,
            'name' => 'Vacas Muertas',
            'city_id' => 1260,
        ]);


        Neighborhood::create([
            'id' => 3555,
            'name' => 'Vilisman',
            'city_id' => 1264,
        ]);

        //Villa Capayan

        Neighborhood::create([
            'id' => 3556,
            'name' => 'Villa Capayan',
            'city_id' => 1265,
        ]);

        //Villa Coyantes

        Neighborhood::create([
            'id' => 3557,
            'name' => 'Villa Coyantes',
            'city_id' => 1266,
        ]);

        //Villa de Balcozna

        Neighborhood::create([
            'id' => 3558,
            'name' => 'Villa de Balcozna',
            'city_id' => 1267,
        ]);

        //Villa Dolores

        Neighborhood::create([
            'id' => 3559,
            'name' => 'Villa Dolores',
            'city_id' => 1268,
        ]);

        //Villa Dolores

        Neighborhood::create([
            'id' => 3560,
            'name' => 'Villa Dolores',
            'city_id' => 1269,
        ]);

        //Villa El Alto

        Neighborhood::create([
            'id' => 3561,
            'name' => 'Villa el Alto',
            'city_id' => 1270,
        ]);

        //Villa Isabel

        Neighborhood::create([
            'id' => 3562,
            'name' => 'Villa Isabel',
            'city_id' => 1271,
        ]);

        //Villa Las Pirquitas

        Neighborhood::create([
            'id' => 3563,
            'name' => 'Villa las Pirquitas',
            'city_id' => 1272,
        ]);

        //Villa Los Corderos

        Neighborhood::create([
            'id' => 3564,
            'name' => 'Villa los Corderos',
            'city_id' => 1273,
        ]);

        //Villa Lujan

        Neighborhood::create([
            'id' => 3565,
            'name' => 'Villa Lujan',
            'city_id' => 1274,
        ]);

        //Villa Real

        Neighborhood::create([
            'id' => 3566,
            'name' => 'Villa Real',
            'city_id' => 1275,
        ]);

        //Villa Vil

        Neighborhood::create([
            'id' => 3567,
            'name' => 'Villa Vil',
            'city_id' => 1276,
        ]);

        //Villapa de Arriba

        Neighborhood::create([
            'id' => 3568,
            'name' => 'Villapa de Arriba',
            'city_id' => 1277,
        ]);

        //Yaco Yaci

        Neighborhood::create([
            'id' => 3569,
            'name' => 'Yaco Yaci',
            'city_id' => 1278,
        ]);

        //Yapes

        Neighborhood::create([
            'id' => 3570,
            'name' => 'Yapes',
            'city_id' => 1279,
        ]);

        //Yerba Buena

        Neighborhood::create([
            'id' => 3571,
            'name' => 'Yerba Buena',
            'city_id' => 1280,
        ]);

        //Zanjón de Apocango

        Neighborhood::create([
            'id' => 3572,
            'name' => 'Zanjón de Apocango',
            'city_id' => 1281,
        ]);

        //Chaco (Resistencia)

        Neighborhood::create([
            'id' => 3573,
            'name' => 'Centro',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3574,
            'name' => 'Macrocentro',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3575,
            'name' => 'Microcentro',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3576,
            'name' => 'Zona Hipermercado',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3577,
            'name' => 'Zona U.N.N.E',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3578,
            'name' => 'Alberdi Juan Bautista',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3579,
            'name' => 'Ammter',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3580,
            'name' => 'Amudoch',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3581,
            'name' => 'Anunciación',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3582,
            'name' => 'Aramburu',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3583,
            'name' => 'Atlántico Sur',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3584,
            'name' => 'Barberan',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3585,
            'name' => 'Belgranor',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3586,
            'name' => 'Bittel',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3587,
            'name' => 'Cacique Pelayo',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3588,
            'name' => 'Cacui',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3589,
            'name' => 'California',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3590,
            'name' => 'Carpincho Macho',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3591,
            'name' => 'Cosecha',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3592,
            'name' => 'Cosmetologos',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3593,
            'name' => 'Empresario',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3594,
            'name' => 'España',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3595,
            'name' => 'Evita',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3596,
            'name' => 'Foecyt',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3597,
            'name' => 'Fontana',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3598,
            'name' => 'Golf Club',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3599,
            'name' => 'Gral Aramburu',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3600,
            'name' => 'Gral Güemes',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3601,
            'name' => 'Gral Obligado',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3602,
            'name' => 'Guiraldes',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3603,
            'name' => 'H. Irigoyen',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3604,
            'name' => 'Hernandez',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3605,
            'name' => 'Incone',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3606,
            'name' => 'Independencia',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3607,
            'name' => 'Italia',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3608,
            'name' => 'Italo-Argentino',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3609,
            'name' => 'Jesus Maria',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3610,
            'name' => 'Judicial',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3611,
            'name' => 'La California',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3612,
            'name' => 'La Fabril',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3613,
            'name' => 'La Liguria',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3614,
            'name' => 'La Ribera',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3615,
            'name' => 'La Rubita',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3616,
            'name' => 'Las Malvinas',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3617,
            'name' => 'Llaponagat',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3618,
            'name' => 'Los Cisnes',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3619,
            'name' => 'Los Troncos',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3620,
            'name' => 'Loteria Chaqueña',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3621,
            'name' => 'Loteria Chaqueña II',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3622,
            'name' => 'Luzuriaga',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3623,
            'name' => 'Metalurgico',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3624,
            'name' => 'Mons. De Carlo',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3625,
            'name' => 'Monte Alto',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3626,
            'name' => 'Mujeres Argentinas',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3627,
            'name' => 'Municipales',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3628,
            'name' => 'Mupesa',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3629,
            'name' => 'Nazaret',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3630,
            'name' => 'Nerberry',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3631,
            'name' => 'Nueva Esperanza',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3632,
            'name' => 'Nueva Provincia',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3633,
            'name' => 'Nueva Resistencia',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3634,
            'name' => 'Parque Autodromo',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3635,
            'name' => 'Parque Independencia',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3636,
            'name' => 'Parque Los Pinos',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3637,
            'name' => 'Paykin',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3638,
            'name' => 'Pellegrini',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3639,
            'name' => 'Perón',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3640,
            'name' => 'Piccili',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3641,
            'name' => 'Policial',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3642,
            'name' => 'Portal Arboledas',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3643,
            'name' => 'Presidencia Roque Saenz Peña',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3644,
            'name' => 'Provincias Unidas',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3645,
            'name' => 'Provino',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3646,
            'name' => 'Puerti Tirol',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3647,
            'name' => 'Raota',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3648,
            'name' => 'Ruta 11',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3649,
            'name' => 'Ruta 16',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3650,
            'name' => 'Río Manso',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3651,
            'name' => 'S.O.E.S.G y P.E.',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3652,
            'name' => 'San Cayetano',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3653,
            'name' => 'San Diego',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3654,
            'name' => 'San Fernando',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3655,
            'name' => 'San Javier',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3656,
            'name' => 'San Miguel',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3657,
            'name' => 'San Pablo',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3658,
            'name' => 'San Pantaleon',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3659,
            'name' => 'San Valentin',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3660,
            'name' => 'Santa Catalina',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3661,
            'name' => 'Santa Ines',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3662,
            'name' => 'Santa Rita',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3663,
            'name' => 'Supe',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3664,
            'name' => 'Toba',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3665,
            'name' => 'U.P.C.P',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3666,
            'name' => 'Udocha',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3667,
            'name' => 'UPCP II',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3668,
            'name' => 'Valussi',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3669,
            'name' => 'Vargas II',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3670,
            'name' => 'Vargas III',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3671,
            'name' => 'Velez Sarfield',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3672,
            'name' => 'Villa Adelante',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3673,
            'name' => 'Villa Aeropuerto',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3674,
            'name' => 'Villa Alberdi',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3675,
            'name' => 'Villa Allin',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3676,
            'name' => 'Villa Altabe',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3677,
            'name' => 'Villa Alvear',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3678,
            'name' => 'Villa Asunción',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3679,
            'name' => 'Villa Avalos',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3680,
            'name' => 'Villa Barbetti',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3681,
            'name' => 'Villa Camila',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3682,
            'name' => 'Villa Camors',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3683,
            'name' => 'Villa Centenario',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3684,
            'name' => 'Villa Central Norte',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3685,
            'name' => 'Villa Chica',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3686,
            'name' => 'Villa Concepción',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3687,
            'name' => 'Villa Cortez',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3688,
            'name' => 'Villa Cristo Rey',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3689,
            'name' => 'Villa del Carmen',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3690,
            'name' => 'Villa del Oeste',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3691,
            'name' => 'Villa del Parque',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3692,
            'name' => 'Villa Don Alberto',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3693,
            'name' => 'Villa Don Andres',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3694,
            'name' => 'Villa Don Enrique',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3695,
            'name' => 'Villa Don Rafael',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3696,
            'name' => 'Villa Don Santiago',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3697,
            'name' => 'Villa Donovan',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3698,
            'name' => 'Villa el Bolsón',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3699,
            'name' => 'Villa El Dorado',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3700,
            'name' => 'Villa El Tala',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3701,
            'name' => 'Villa Elba',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3702,
            'name' => 'Villa Elisa',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3703,
            'name' => 'Villa Encarnación',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3704,
            'name' => 'Villa Ercilia',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3705,
            'name' => 'Villa Eva María',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3706,
            'name' => 'Villa Fabiana',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3707,
            'name' => 'Villa Fabril',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3708,
            'name' => 'Villa Facundo',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3709,
            'name' => 'Villa Federal',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3710,
            'name' => 'Villa Florida',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3711,
            'name' => 'Villa Floruani',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3712,
            'name' => 'Villa Gallino',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3713,
            'name' => 'Villa Ghio',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3714,
            'name' => 'Villa Gonzalito',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3715,
            'name' => 'Villa Gral Mitre',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3716,
            'name' => 'Villa Inmaculada',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3717,
            'name' => 'Villa Irigoyen',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3718,
            'name' => 'Villa Itati',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3719,
            'name' => 'Villa Juan de Garay',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3720,
            'name' => 'Villa La Isla',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3721,
            'name' => 'Villa Libertad',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3722,
            'name' => 'Villa Los Lirios',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3723,
            'name' => 'Villa Los Teros',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3724,
            'name' => 'Villa Luisa',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3725,
            'name' => 'Villa Mariano Moreno',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3726,
            'name' => 'Villa Marin',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3727,
            'name' => 'Villa María',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3728,
            'name' => 'Villa Monona',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3729,
            'name' => 'Villa Nueva',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3730,
            'name' => 'Villa Odorico',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3731,
            'name' => 'Villa Oro',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3732,
            'name' => 'Villa Palermo I',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3733,
            'name' => 'Villa Palermo II',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3734,
            'name' => 'Villa Pegoraro',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3735,
            'name' => 'Villa Elisa',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3736,
            'name' => 'Villa Perrando',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3737,
            'name' => 'Villa Progreso',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3738,
            'name' => 'Villa Prosperidad',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3739,
            'name' => 'Villa Puppo',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3740,
            'name' => 'Villa Rawson',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3741,
            'name' => 'Villa Rio Negro',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3742,
            'name' => 'Villa Roger Balet',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3743,
            'name' => 'Villa Río Araza',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3744,
            'name' => 'Villa San Antonio',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3745,
            'name' => 'Villa San Isidro',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3746,
            'name' => 'Villa San Juan',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3747,
            'name' => 'Villa San Martín',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3748,
            'name' => 'Villa San Domingo',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3749,
            'name' => 'Villa Sarmiento',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3750,
            'name' => 'Villa Elisa',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3751,
            'name' => 'Villa Sarmiento',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3752,
            'name' => 'Villa Seitor',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3753,
            'name' => 'Villa Teniente Saavedra',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3754,
            'name' => 'Villa Universidad',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3755,
            'name' => 'Villa V.O.B',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3756,
            'name' => 'Vivienda 100',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3757,
            'name' => 'Vivienda 102',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3758,
            'name' => 'Vivienda 110',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3759,
            'name' => 'Vivienda 125',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3760,
            'name' => 'Vivienda 130',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3761,
            'name' => 'Vivienda 150',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3762,
            'name' => 'Vivienda 152',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3763,
            'name' => 'Vivienda 164',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3764,
            'name' => 'Vivienda 185',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3765,
            'name' => 'Vivienda 222',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3766,
            'name' => 'Vivienda 240',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3767,
            'name' => 'Vivienda 244',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3768,
            'name' => 'Vivienda 263',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3769,
            'name' => 'Vivienda 48',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3770,
            'name' => 'Zona Aeropuerto',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3771,
            'name' => 'Zona Parque Avalos',
            'city_id' => 1282,
        ]);

        Neighborhood::create([
            'id' => 3772,
            'name' => 'Zona Residencial',
            'city_id' => 1282,
        ]);

        //Colonia Benitez

        Neighborhood::create([
            'id' => 3773,
            'name' => 'Colonia Benitez',
            'city_id' => 1283,
        ]);

       //Avia Terai

        Neighborhood::create([
            'id' => 3774,
            'name' => 'Avia Terai',
            'city_id' => 1284,
        ]);

        //Barranqueras

        Neighborhood::create([
            'id' => 3775,
            'name' => 'Barranqueras',
            'city_id' => 1285,
        ]);

        //Basail

        Neighborhood::create([
            'id' => 3776,
            'name' => 'Basail',
            'city_id' => 1286,
        ]);

        //Campo Largo

        Neighborhood::create([
            'id' => 3777,
            'name' => 'Campo Largo',
            'city_id' => 1287,
        ]);

        //Capitán Solari

        Neighborhood::create([
            'id' => 3778,
            'name' => 'Capitán Solari',
            'city_id' => 1288,
        ]);

        //Charadai

        Neighborhood::create([
            'id' => 3779,
            'name' => 'Charadai',
            'city_id' => 1289,
        ]);

        //Charata

        Neighborhood::create([
            'id' => 3780,
            'name' => 'Charata',
            'city_id' => 1290,
        ]);

        //Chorotis

        Neighborhood::create([
            'id' => 3781,
            'name' => 'Chorotis',
            'city_id' => 1291,
        ]);

        //Ciervo Petiso

        Neighborhood::create([
            'id' => 3782,
            'name' => 'Ciervo Petiso',
            'city_id' => 1292,
        ]);

        //Colonia Aborigen

        Neighborhood::create([
            'id' => 3783,
            'name' => 'Colonia Aborigen',
            'city_id' => 1293,
        ]);

        //Colonia Elisa

        Neighborhood::create([
            'id' => 3784,
            'name' => 'CColonia Elisa',
            'city_id' => 1294,
        ]);

        //Colonia Popular

        Neighborhood::create([
            'id' => 3785,
            'name' => 'Colonia Popular',
            'city_id' => 1295,
        ]);

        //Colonias Unidas

        Neighborhood::create([
            'id' => 3786,
            'name' => 'Colonias Unidas',
            'city_id' => 1296,
        ]);

        //Concepción del Bermejo

        Neighborhood::create([
            'id' => 3787,
            'name' => 'Concepcion del Bermejo',
            'city_id' => 1297,
        ]);

        //Coronel Du Graty

        Neighborhood::create([
            'id' => 3788,
            'name' => 'Coronel Du Graty',
            'city_id' => 1298,
        ]);

        //Corzuela

        Neighborhood::create([
            'id' => 3789,
            'name' => 'Corzuela',
            'city_id' => 1299,
        ]);

        //Cote Lai

        Neighborhood::create([
            'id' => 3790,
            'name' => 'Cote Lai',
            'city_id' => 1300,
        ]);

        //Cuatro Árboles

        Neighborhood::create([
            'id' => 3791,
            'name' => 'Cuatro Árboles',
            'city_id' => 1301,
        ]);

        //El Cebilar

        Neighborhood::create([
            'id' => 3792,
            'name' => 'El Cebilar',
            'city_id' => 1302,
        ]);

        //El Sauzalito

        Neighborhood::create([
            'id' => 3793,
            'name' => 'El Sauzalito',
            'city_id' => 1303,
        ]);

        //Enrique Uríen

        Neighborhood::create([
            'id' => 3794,
            'name' => 'Enrique Uríen',
            'city_id' => 1304,
        ]);

        //Fuerte Esperanza

        Neighborhood::create([
            'id' => 3795,
            'name' => 'Fuerte Esperanza',
            'city_id' => 1305,
        ]);

        // Gancedo

        Neighborhood::create([
            'id' => 3796,
            'name' => 'Gancedo',
            'city_id' => 1306,
        ]);

        //General Capdevila

        Neighborhood::create([
            'id' => 3797,
            'name' => 'General Capdevila',
            'city_id' => 1307,
        ]);

        //General Jose de San Martín

        Neighborhood::create([
            'id' => 3798,
            'name' => 'General Jose de San Martín',
            'city_id' => 1308,
        ]);

        //General Pinedo

        Neighborhood::create([
            'id' => 3799,
            'name' => 'General Pinedo',
            'city_id' => 1309,
        ]);

        //General Vedia

        Neighborhood::create([
            'id' => 3800,
            'name' => 'General Vedia',
            'city_id' => 1310,
        ]);

        //Hermoso Campo

        Neighborhood::create([
            'id' => 3801,
            'name' => 'Hermoso Campo',
            'city_id' => 1311,
        ]);

        //Ingeniero Barbet

        Neighborhood::create([
            'id' => 3802,
            'name' => 'Ingeniero Barbet',
            'city_id' => 1312,
        ]);

        //Isla del Cerrito

        Neighborhood::create([
            'id' => 3803,
            'name' => 'Isla del Cerrito',
            'city_id' => 1313,
        ]);

        //Juan José Castelli

        Neighborhood::create([
            'id' => 3804,
            'name' => 'Juan José Castelli',
            'city_id' => 1314,
        ]);

        //La Clotilde

        Neighborhood::create([
            'id' => 3805,
            'name' => 'La Clotilde',
            'city_id' => 1315,
        ]);

        //La Eduvigis

        Neighborhood::create([
            'id' => 3806,
            'name' => 'La Eduvigis',
            'city_id' => 1316,
        ]);

        //La Escondida

        Neighborhood::create([
            'id' => 3807,
            'name' => 'La Escondida',
            'city_id' => 1317,
        ]);

        //La Leonesa

        Neighborhood::create([
            'id' => 3808,
            'name' => 'La Leonesa',
            'city_id' => 1318,
        ]);

        //La Tambora

        Neighborhood::create([
            'id' => 3809,
            'name' => 'La Tambora',
            'city_id' => 1319,
        ]);

        //La Tigra

        Neighborhood::create([
            'id' => 3810,
            'name' => 'La Tigra',
            'city_id' => 1320,
        ]);

        //La Verde

        Neighborhood::create([
            'id' => 3811,
            'name' => 'La Verde',
            'city_id' => 1321,
        ]);

        //Laguna Blanca

        Neighborhood::create([
            'id' => 3812,
            'name' => 'Laguna Blanca',
            'city_id' => 1322,
        ]);

        //Laguna Limpia

        Neighborhood::create([
            'id' => 3813,
            'name' => 'Laguna Limpia',
            'city_id' => 1323,
        ]);

        //Lapachito

        Neighborhood::create([
            'id' => 3814,
            'name' => 'Lapachito',
            'city_id' => 1324,
        ]);

        //Las Breñas

        Neighborhood::create([
            'id' => 3815,
            'name' => 'Las Breñas',
            'city_id' => 1325,
        ]);

        //Las Garcitas

        Neighborhood::create([
            'id' => 3816,
            'name' => 'Las Garcitas',
            'city_id' => 1326,
        ]);

        //Las Palmas

        Neighborhood::create([
            'id' => 3817,
            'name' => 'Las Palmas',
            'city_id' => 1327,
        ]);

        //Los Frentones

        Neighborhood::create([
            'id' => 3818,
            'name' => 'Los Frentones',
            'city_id' => 1328,
        ]);

        //Machagai

        Neighborhood::create([
            'id' => 3819,
            'name' => 'Machagai',
            'city_id' => 1329,
        ]);

        //Makallé

        Neighborhood::create([
            'id' => 3820,
            'name' => 'Makallé',
            'city_id' => 1330,
        ]);

        //Margarita Belén

        Neighborhood::create([
            'id' => 3821,
            'name' => 'Margarita Belén',
            'city_id' => 1331,
        ]);

        //Miraflores

        Neighborhood::create([
            'id' => 3822,
            'name' => 'Miraflores',
            'city_id' => 1332,
        ]);

        //Misión Nueva Pompeya

        Neighborhood::create([
            'id' => 3823,
            'name' => 'Misión Nueva Pompeya',
            'city_id' => 1333,
        ]);

        //Napalpí

        Neighborhood::create([
            'id' => 3824,
            'name' => 'Napalpí',
            'city_id' => 1334,
        ]);

        //Napenay

        Neighborhood::create([
            'id' => 3825,
            'name' => 'Napenay',
            'city_id' => 1335,
        ]);


        //Pampa Almirón

        Neighborhood::create([
            'id' => 3827,
            'name' => 'Pampa Almirón',
            'city_id' => 1337,
        ]);

        //Pampa del Indio

        Neighborhood::create([
            'id' => 3828,
            'name' => 'Pampa del Indio',
            'city_id' => 1338,
        ]);

        //Pampa del Infierno

        Neighborhood::create([
            'id' => 3829,
            'name' => 'Pampa del Infierno',
            'city_id' => 1339,
        ]);

        //Presidencia de la Plaza

        Neighborhood::create([
            'id' => 3830,
            'name' => 'Presidencia de la Plaza',
            'city_id' => 1340,
        ]);

        //Presidencia Roca

        Neighborhood::create([
            'id' => 3831,
            'name' => 'Presidencia Roca',
            'city_id' => 1341,
        ]);

        //Puerto Bermejo

        Neighborhood::create([
            'id' => 3832,
            'name' => 'Puerto Bermejo',
            'city_id' => 1342,
        ]);

        //Puerto Eva Perón

        Neighborhood::create([
            'id' => 3833,
            'name' => 'Puerto Eva Perón',
            'city_id' => 1343,
        ]);

        //Puerto Vilelas

        Neighborhood::create([
            'id' => 3834,
            'name' => 'Puerto Vilelas',
            'city_id' => 1344,
        ]);

        //Quitillipi

        Neighborhood::create([
            'id' => 3835,
            'name' => 'Quitillipi',
            'city_id' => 1345,
        ]);

        //Samuhú

        Neighborhood::create([
            'id' => 3836,
            'name' => 'Samuhú',
            'city_id' => 1346,
        ]);

        //San Bernardo

        Neighborhood::create([
            'id' => 3837,
            'name' => 'San Bernardo',
            'city_id' => 1347,
        ]);

        //Santa Sylvina

        Neighborhood::create([
            'id' => 3838,
            'name' => 'Santa Sylvina',
            'city_id' => 1348,
        ]);

        //Taco Pozo

        Neighborhood::create([
            'id' => 3839,
            'name' => 'Taco Pozo',
            'city_id' => 1349,
        ]);

        //Tres Isletas

        Neighborhood::create([
            'id' => 3840,
            'name' => 'Tres Isletas',
            'city_id' => 1350,
        ]);

        //Tres Palmas

        Neighborhood::create([
            'id' => 3841,
            'name' => 'Tres Palmas',
            'city_id' => 1351,
        ]);

        //Villa Berthet

        Neighborhood::create([
            'id' => 3842,
            'name' => 'Villa Berthet',
            'city_id' => 1352,
        ]);

        //Villa Río Bermejito

        Neighborhood::create([
            'id' => 3843,
            'name' => 'Villa Río Bermejito',
            'city_id' => 1353,
        ]);

        //Villa Ángela

        Neighborhood::create([
            'id' => 3844,
            'name' => 'Villa Ángela',
            'city_id' => 1354,
        ]);

        //Corrientes

        Neighborhood::create([
            'id' => 3845,
            'name' => 'Corrientes',
            'city_id' => 1355,
        ]);

        //Ituzaingo

        Neighborhood::create([
            'id' => 3846,
            'name' => 'Ituzaingó',
            'city_id' => 1356,
        ]);

        //Paso de la Patría

        Neighborhood::create([
            'id' => 3847,
            'name' => 'Paso de la Patria',
            'city_id' => 1357,
        ]);

        //Esquina

        Neighborhood::create([
            'id' => 3848,
            'name' => 'Esquina',
            'city_id' => 1358,
        ]);

        //Mercedes

        Neighborhood::create([
            'id' => 3849,
            'name' => 'Mercedes',
            'city_id' => 1359,
        ]);

        //Barrio Esperanza

        Neighborhood::create([
            'id' => 3850,
            'name' => 'Barrio Esperanza',
            'city_id' => 1360,
        ]);

        //Berón de Astrada

        Neighborhood::create([
            'id' => 3852,
            'name' => 'Berón de Astrada',
            'city_id' => 1361,
        ]);

        //Bonpland

        Neighborhood::create([
            'id' => 3853,
            'name' => 'Bonpland',
            'city_id' => 1362,
        ]);

        //Chavarria

        Neighborhood::create([
            'id' => 3854,
            'name' => 'Chavarría',
            'city_id' => 1363,
        ]);

        //Colonia Carlos Pellegrini

        Neighborhood::create([
            'id' => 3855,
            'name' => 'Colonia Carlos Pellegrini',
            'city_id' => 1364,
        ]);

        //Colonia Libertad

        Neighborhood::create([
            'id' => 3856,
            'name' => 'Colonia Libertad',
            'city_id' => 1365,
        ]);

        //Colonia Liebig´s

        Neighborhood::create([
            'id' => 3857,
            'name' => 'Colonia Liebig´s',
            'city_id' => 1366,
        ]);

        //Colonia Santa Rosa

        Neighborhood::create([
            'id' => 3858,
            'name' => 'Colonia Santa Rosa',
            'city_id' => 1367,
        ]);

        //Concepción

        Neighborhood::create([
            'id' => 3859,
            'name' => 'Concepción',
            'city_id' => 1368,
        ]);

        //Costa Santa Lucía

        Neighborhood::create([
            'id' => 3860,
            'name' => 'Costa Santa Lucía',
            'city_id' => 1369,
        ]);

        //Cruz de los Milagros

        Neighborhood::create([
            'id' => 3861,
            'name' => 'Cruz de Los Milagros',
            'city_id' => 1370,
        ]);

        //Curuzú Cuatiá

        Neighborhood::create([
            'id' => 3862,
            'name' => 'Curuzú Cuatiá',
            'city_id' => 1371,
        ]);

        //Empedrado

        Neighborhood::create([
            'id' => 3863,
            'name' => 'Empedrado',
            'city_id' => 1372,
        ]);

        //Estacion Torrent

        Neighborhood::create([
            'id' => 3864,
            'name' => 'Estacíon Torrent',
            'city_id' => 1373,
        ]);

        //Felipe Yofré

        Neighborhood::create([
            'id' => 3865,
            'name' => 'Felipe Yofré',
            'city_id' => 1374,
        ]);

        //Garruchos

        Neighborhood::create([
            'id' => 3866,
            'name' => 'Garruchos',
            'city_id' => 1375,
        ]);

        //General Alvear

        Neighborhood::create([
            'id' => 3867,
            'name' => 'General Alvear',
            'city_id' => 1376,
        ]);

        //Gobernador Juan E Martínez

        Neighborhood::create([
            'id' => 3868,
            'name' => 'Gobernador Juan E Martínez',
            'city_id' => 1377,
        ]);

        //Gobernador Virasoro

        Neighborhood::create([
            'id' => 3869,
            'name' => 'Gobernador Virasoro',
            'city_id' => 1378,
        ]);

        //Goya

        Neighborhood::create([
            'id' => 3870,
            'name' => 'Goya',
            'city_id' => 1379,
        ]);

        //Guaraní

        Neighborhood::create([
            'id' => 3871,
            'name' => 'Guaraní',
            'city_id' => 1380,
        ]);

        //Guaviraví

        Neighborhood::create([
            'id' => 3872,
            'name' => 'Guaviraví',
            'city_id' => 1381,
        ]);

        //Herlitzka

        Neighborhood::create([
            'id' => 3873,
            'name' => 'Herlizka',
            'city_id' => 1382,
        ]);

        //Itatí

        Neighborhood::create([
            'id' => 3874,
            'name' => 'Itatí',
            'city_id' => 1383,
        ]);

        //Itá Ibaté

        Neighborhood::create([
            'id' => 3875,
            'name' => 'Itá Ibaté',
            'city_id' => 1384,
        ]);

        //José Rafael Gómez

        Neighborhood::create([
            'id' => 3876,
            'name' => 'José Rafael Gómez',
            'city_id' => 1385,
        ]);

        //Juan Pujol

        Neighborhood::create([
            'id' => 3877,
            'name' => 'Juan Pujol',
            'city_id' => 1386,
        ]);

        //La Cruz

        Neighborhood::create([
            'id' => 3878,
            'name' => 'La Cruz',
            'city_id' => 1387,
        ]);

        //Laguna Brava

        Neighborhood::create([
            'id' => 3879,
            'name' => 'Laguna Brava',
            'city_id' => 1388,
        ]);

        //Lavalle

        Neighborhood::create([
            'id' => 3880,
            'name' => 'Lavalle',
            'city_id' => 1389,
        ]);

        //Lomas de Vallejos

        Neighborhood::create([
            'id' => 3881 ,
            'name' => 'Lomas de Vallejos',
            'city_id' => 1390,
        ]);

        //Loreto

        Neighborhood::create([
            'id' => 3882,
            'name' => 'Loreto',
            'city_id' => 1391,
        ]);

        //Mariano I Loza

        Neighborhood::create([
            'id' => 3883,
            'name' => 'Mariano I Loza',
            'city_id' => 1392,
        ]);

        //Mburucuyá

        Neighborhood::create([
            'id' => 3884,
            'name' => 'Mburucuyá',
            'city_id' => 1393,
        ]);

        //Mocoretá

        Neighborhood::create([
            'id' => 3885,
            'name' => 'Mocoret',
            'city_id' => 1394,
        ]);

        //Monte Caseros

        Neighborhood::create([
            'id' => 3886,
            'name' => 'Monte Caseros',
            'city_id' => 1395,
        ]);

        //Nuestra Señora del Rosario de Caá Catí

        Neighborhood::create([
            'id' => 3887,
            'name' => 'Nuestra Señora del Rosario de Caá Catí',
            'city_id' => 1396,
        ]);

        //Nueve de Julio

        Neighborhood::create([
            'id' => 3888,
            'name' => 'Nueve de Julio',
            'city_id' => 1397,
        ]);


        //Palmar Grande

        Neighborhood::create([
            'id' => 3890,
            'name' => 'Palmar Grande',
            'city_id' => 1399,
        ]);

        //Parada Pucheta

        Neighborhood::create([
            'id' => 3891,
            'name' => 'Parada Pucheta',
            'city_id' => 1400,
        ]);

        //Paso de los Libres

        Neighborhood::create([
            'id' => 3892,
            'name' => 'Paso de los Libres',
            'city_id' => 1401,
        ]);

        //Pedro R Fernández

        Neighborhood::create([
            'id' => 3893,
            'name' => 'Pedro R Fernández',
            'city_id' => 1402,
        ]);

        //Perugorria

        Neighborhood::create([
            'id' => 3894,
            'name' => 'Perugorria',
            'city_id' => 1404,
        ]);

        //Pueblo Libertador

        Neighborhood::create([
            'id' => 3895,
            'name' => 'Pueblo Libertador',
            'city_id' => 1405,
        ]);

        //Ramada Paso

        Neighborhood::create([
            'id' => 3896,
            'name' => 'Ramada Paso',
            'city_id' => 1406,
        ]);

        //Riachuelo

        Neighborhood::create([
            'id' => 3897,
            'name' => 'Riachuelo',
            'city_id' => 1407,
        ]);

        //Saladas

        Neighborhood::create([
            'id' => 3898,
            'name' => 'Saladas',
            'city_id' => 1408,
        ]);

        //San Antonio

        Neighborhood::create([
            'id' => 3899,
            'name' => 'San Antonio',
            'city_id' => 1409,
        ]);

        //San Carlos

        Neighborhood::create([
            'id' => 3900,
            'name' => 'San Carlos',
            'city_id' => 1410,
        ]);

        //San Cayetano

        Neighborhood::create([
            'id' => 3901,
            'name' => 'San Cayetano',
            'city_id' => 1411,
        ]);

        //San Cosme

        Neighborhood::create([
            'id' => 3902,
            'name' => 'San Cosme',
            'city_id' => 1412,
        ]);

        //San Lorenzo

        Neighborhood::create([
            'id' => 3903,
            'name' => 'San Lorenzo',
            'city_id' => 1413,
        ]);

        //San Luis del Palmar

        Neighborhood::create([
            'id' => 3904,
            'name' => 'San Luis del Palmar',
            'city_id' => 1414,
        ]);

        //San Miguel

        Neighborhood::create([
            'id' => 3905,
            'name' => 'San Miguel',
            'city_id' => 1415,
        ]);

        //San Roque

        Neighborhood::create([
            'id' => 3906,
            'name' => 'San Roque',
            'city_id' => 1416,
        ]);

        //Santa Ana de los Huácaras

        Neighborhood::create([
            'id' => 3907,
            'name' => 'Santa Ana de los Huácaras',
            'city_id' => 1417,
        ]);

        //Santa Lucía

        Neighborhood::create([
            'id' => 3908,
            'name' => 'Santa Lucía',
            'city_id' => 1418,
        ]);

        //Santo Tomé

        Neighborhood::create([
            'id' => 3909,
            'name' => 'Santo Tomé',
            'city_id' => 1419,
        ]);

        //Sauce

        Neighborhood::create([
            'id' => 3910,
            'name' => 'Sauce',
            'city_id' => 1420,
        ]);

        //Tabay

        Neighborhood::create([
            'id' => 3911,
            'name' => 'Tabay',
            'city_id' => 1421,
        ]);

        //Tacuaral

        Neighborhood::create([
            'id' => 3912,
            'name' => 'Tacuaral',
            'city_id' => 1422,
        ]);

        //Tapebicuá

        Neighborhood::create([
            'id' => 3913,
            'name' => 'Tapebicuá',
            'city_id' => 1423,
        ]);

        //Tatacuá

        Neighborhood::create([
            'id' => 3914,
            'name' => 'Tatacuá',
            'city_id' => 1424,
        ]);

        //Villa Olivari

        Neighborhood::create([
            'id' => 3915,
            'name' => 'Villa Olivari',
            'city_id' => 1425,
        ]);

        //Yahape

        Neighborhood::create([
            'id' => 3916,
            'name' => 'Yahape',
            'city_id' => 1426,
        ]);

        //Yapeyu

        Neighborhood::create([
            'id' => 3917,
            'name' => 'Yapeyú',
            'city_id' => 1427,
        ]);

        //Yataytí Calle

        Neighborhood::create([
            'id' => 3918,
            'name' => 'Yataytí Calle',
            'city_id' => 1428,
        ]);

        //Cordoba

        Neighborhood::create([
            'id' => 3919,
            'name' => 'Nueva Córdoba',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3920,
            'name' => 'Centro',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3921,
            'name' => 'General Paz',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3922,
            'name' => 'Alberdi',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3923,
            'name' => 'Alto Alberdi',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3924,
            'name' => '16 de Noviembre',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3925,
            'name' => '1º de Mayo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3926,
            'name' => '20 de Junio',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3927,
            'name' => 'A.A.T.R.A.',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3928,
            'name' => 'Acosta',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3929,
            'name' => 'Aeronaútico',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3930,
            'name' => 'Alborada',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3931,
            'name' => 'Alejandro Carbó',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3932,
            'name' => 'Alejandro Centeno',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3933,
            'name' => 'Alem',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3934,
            'name' => 'Almirante Brown',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3935,
            'name' => 'Alta Córdoba',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3936,
            'name' => 'Altamira',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3937,
            'name' => 'Alto Hermoso',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3938,
            'name' => 'Alto Palermo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3939,
            'name' => 'Alto Sud San Vicente',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3940,
            'name' => 'Alto Verde',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3941,
            'name' => 'Alto Villasol',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3942,
            'name' => 'Altos de General Paz',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3943,
            'name' => 'Altos de Manantiales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3944,
            'name' => 'Altos de San Martín',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3945,
            'name' => 'Altos de Santa Ana',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3946,
            'name' => 'Altos de Villa Cabrera',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3947,
            'name' => 'Altos de Vélez Sársfield',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3948,
            'name' => 'Altos del Chateau',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3949,
            'name' => 'Altos Sud',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3950,
            'name' => 'Ameghino Norte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3951,
            'name' => 'Ameghino Sud',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3952,
            'name' => 'Ameghino Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3953,
            'name' => 'Ampliacion Altamira',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3954,
            'name' => 'Ampliacion América',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3955,
            'name' => 'Ampliación Matienzo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3956,
            'name' => 'Ampliación Palmar',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3957,
            'name' => 'Ampliación Pueyrredón',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3958,
            'name' => 'Ampliación Vélez Sársfield',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3959,
            'name' => 'Apeadero La Tablada',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3960,
            'name' => 'Argüello',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3961,
            'name' => 'Argüello Lourdes',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3962,
            'name' => 'Argüello Norte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3963,
            'name' => 'Arturo Capdevila',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3964,
            'name' => 'ATE',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3965,
            'name' => 'Atlántico',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3966,
            'name' => 'Autódromo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3967,
            'name' => 'Avellaneda',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3968,
            'name' => 'Ayacucho',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3969,
            'name' => 'Ayres del Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3970,
            'name' => 'Bajada San Roque',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3971,
            'name' => 'Bajo Chico',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3972,
            'name' => 'Bajo Galán',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3973,
            'name' => 'Bajo General Paz',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3974,
            'name' => 'Bajo Palermo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3975,
            'name' => 'Bajo Pueyrredon',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3976,
            'name' => 'Balcarce',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3977,
            'name' => 'Balcones del Chateau',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3978,
            'name' => 'Barranca Yaco',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3979,
            'name' => 'Barrancas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3980,
            'name' => 'Barrancas del Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3981,
            'name' => 'Barranquitas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3982,
            'name' => 'Barrio Norte 2',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3983,
            'name' => 'Barrio Privado Chateau Carreras',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3984,
            'name' => 'Bella Vista',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3985,
            'name' => 'Bella Vista',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3986,
            'name' => 'Bella Vista Oeste',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3987,
            'name' => 'Benjamín Cabral',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3988,
            'name' => 'Bialet Massé',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3989,
            'name' => 'Blas Pascal',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3990,
            'name' => 'Brigadier San Martín',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3991,
            'name' => 'Brisas de Manantiales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3992,
            'name' => 'Cabaña del Pilar',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3993,
            'name' => 'Cabildo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3994,
            'name' => 'Ciudad de los Niños',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3995,
            'name' => 'Ciudad De Mis Sueños',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3996,
            'name' => 'Ciudad Obispo Angelelli',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3997,
            'name' => 'Ciudadela',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3998,
            'name' => 'Claros del Bosque',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 3999,
            'name' => 'Claros Village',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4000,
            'name' => 'Cofico',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4001,
            'name' => 'Colinas del Cerro',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4002,
            'name' => 'Colonia Lola',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4003,
            'name' => 'Colón',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4004,
            'name' => 'Comandante Espora',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4005,
            'name' => 'Comarca Allende',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4006,
            'name' => 'Comercial',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4007,
            'name' => 'Congreso',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4008,
            'name' => 'Consorcio Esperanza',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4009,
            'name' => 'Coronel Olmedo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4010,
            'name' => 'Corral de Palos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4011,
            'name' => 'Costas de Manantiales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4012,
            'name' => 'Country Cañuelas Village',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4013,
            'name' => 'Country Costa Verde',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4014,
            'name' => 'Country Fortin del Pozo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4015,
            'name' => 'Country Jockey Club',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4016,
            'name' => 'Country Ranch Club',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4017,
            'name' => 'Crisol',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4018,
            'name' => 'Crisol Norte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4019,
            'name' => 'Crisol Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4020,
            'name' => 'Cupani',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4021,
            'name' => 'Cáceres',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4022,
            'name' => 'Cárcano',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4023,
            'name' => 'Deán Funes',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4024,
            'name' => 'Distrito Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4025,
            'name' => 'DOCTA',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4026,
            'name' => 'Don Bosco',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4027,
            'name' => 'Ducasse',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4028,
            'name' => 'Ejército Argentino',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4029,
            'name' => 'El Bosque',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4030,
            'name' => 'El Cerrito',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4031,
            'name' => 'El Chingolo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4032,
            'name' => 'El Chingolo 2',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4033,
            'name' => 'El Chingolo 4',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4034,
            'name' => 'El Quebrachal',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4035,
            'name' => 'El Quebracho',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4036,
            'name' => 'El Refugio',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4037,
            'name' => 'El Trébol',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4038,
            'name' => 'El Viejo Algarrobo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4039,
            'name' => 'Empalme',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4040,
            'name' => 'Escobar',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4041,
            'name' => 'Estación Flores',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4042,
            'name' => 'Estancia la Carolina',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4043,
            'name' => 'Estancia La Lucila',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4044,
            'name' => 'Eva Perón',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4045,
            'name' => 'Ferrer',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4046,
            'name' => 'Ferreyra',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4047,
            'name' => 'Ferroviario Mitre',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4048,
            'name' => 'Fincas 1',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4049,
            'name' => 'Fincas del Sur I',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4050,
            'name' => 'Fincas del Sur II',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4051,
            'name' => 'General Arenales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4052,
            'name' => 'General Artigas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4053,
            'name' => 'General Belgrano',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4054,
            'name' => 'General Bustos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4055,
            'name' => 'General Deheza',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4056,
            'name' => 'General Mosconi',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4057,
            'name' => 'General Pringles',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4058,
            'name' => 'General Pueyrredón',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4059,
            'name' => 'General Savio',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4060,
            'name' => 'Granadero Pringles',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4061,
            'name' => 'Granja de Claret',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4062,
            'name' => 'Granja de Funes',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4063,
            'name' => 'Granja de Claret',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4064,
            'name' => 'Granja de Funes',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4065,
            'name' => 'Greenville',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4066,
            'name' => 'Greenville II',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4067,
            'name' => 'Guiñazú',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4068,
            'name' => 'Guiñazú Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4069,
            'name' => 'Güemes',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4070,
            'name' => 'Hipódromo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4071,
            'name' => 'Hipólito Yrigoyen',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4072,
            'name' => 'Hortensia',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4073,
            'name' => 'Inaudi',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4074,
            'name' => 'Independencia',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4075,
            'name' => 'Industrial Oeste',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4076,
            'name' => 'Iponá',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4077,
            'name' => 'IPV Argüello',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4078,
            'name' => 'Irupé',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4079,
            'name' => 'Ituzaingó',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4080,
            'name' => 'Jardines del Jockey',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4081,
            'name' => 'Jardines del Olmo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4082,
            'name' => 'Jardín',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4083,
            'name' => 'Jardín Arenales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4084,
            'name' => 'Jardín Claret',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4085,
            'name' => 'Jardín del Pilar',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4086,
            'name' => 'Jardín del Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4087,
            'name' => 'Jarsín Espinosa',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4088,
            'name' => 'Jardín Inglés',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4089,
            'name' => 'Jerónimo Luis de Cabrera',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4090,
            'name' => 'Jockey Club',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4091,
            'name' => 'Jorge Newbery',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4092,
            'name' => 'José Hernández',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4093,
            'name' => 'José Ignacio Díaz',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4094,
            'name' => 'José Ignacio Rucci',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4095,
            'name' => 'Juan B. Justo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4096,
            'name' => 'Juan Pablo 2',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4097,
            'name' => 'Juan XXIII',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4098,
            'name' => 'Juniors',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4099,
            'name' => 'Kairos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4100,
            'name' => 'Kennedy IACC',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4101,
            'name' => 'La Calandria',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4102,
            'name' => 'La Carolina',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4103,
            'name' => 'La Cascada Country Golf',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4104,
            'name' => 'La Catalina Urbanizacion Residencial',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4105,
            'name' => 'La Dorotea',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4106,
            'name' => 'La Ernestina',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4107,
            'name' => 'La Floresta',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4108,
            'name' => 'La France',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4109,
            'name' => 'La Fraternidad',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4110,
            'name' => 'La Luisita',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4111,
            'name' => 'La Rosella Villa',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4112,
            'name' => 'La Salle',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4113,
            'name' => 'La Santina',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4114,
            'name' => 'La Unidad',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4115,
            'name' => 'Lamadrid',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4116,
            'name' => 'Las Cañitas Villa Urbana',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4117,
            'name' => 'Las Dahlias',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4118,
            'name' => 'Las Dalias',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4119,
            'name' => 'Las Delicias',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4120,
            'name' => 'Las Flores',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4121,
            'name' => 'Las Lilas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4122,
            'name' => 'Las Magdalenas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4123,
            'name' => 'Las Magnolias',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4124,
            'name' => 'Las Margaritas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4125,
            'name' => 'Las Marías',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4126,
            'name' => 'Las Moras',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4127,
            'name' => 'Las Palmas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4128,
            'name' => 'Las Playas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4129,
            'name' => 'Las Rosas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4130,
            'name' => 'Las Tejas del Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4131,
            'name' => 'Las Violetas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4132,
            'name' => 'Liceo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4133,
            'name' => 'Liceo General Paz',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4134,
            'name' => 'Livette Chateu Córdoba',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4135,
            'name' => 'Lomas de la Carolina',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4136,
            'name' => 'Lomas de los Carolinos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4137,
            'name' => 'Lomas de San Matín',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4138,
            'name' => 'Lomas del Chateau',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4139,
            'name' => 'Lomas del Suquía',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4140,
            'name' => 'Lorenzini',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4141,
            'name' => 'Los Alamos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4142,
            'name' => 'Los Boulevares',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4143,
            'name' => 'Los Ceibos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4144,
            'name' => 'Los Eucaliptus',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4145,
            'name' => 'Las Filtros',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4146,
            'name' => 'Los Fresnos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4147,
            'name' => 'Las Gigantes',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4148,
            'name' => 'Los Granados',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4149,
            'name' => 'Los Hornillos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4150,
            'name' => 'Los Jacarandales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4151,
            'name' => 'Los Josefinos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4152,
            'name' => 'Los Mimbres',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4153,
            'name' => 'Los Naranjos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4154,
            'name' => 'Los Olmos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4155,
            'name' => 'Los Olmos Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4156,
            'name' => 'Los Paraísos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4157,
            'name' => 'Los Plátanos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4158,
            'name' => 'Los Robles',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4159,
            'name' => 'Los Sauces',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4160,
            'name' => 'Los Ángeles',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4161,
            'name' => 'Lourdes',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4162,
            'name' => 'Maipú',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4163,
            'name' => 'Maldonado',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4164,
            'name' => 'Manantiales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4165,
            'name' => 'Manantiales Country',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4166,
            'name' => 'Mansos del Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4167,
            'name' => 'Marcos Sastre',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4168,
            'name' => 'Merechal',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4169,
            'name' => 'Mariano Balcarce',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4170,
            'name' => 'Mariano Fragueiro',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4171,
            'name' => 'Marqués de Sobremonte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4172,
            'name' => 'María Lastenia',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4173,
            'name' => 'Matienzo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4174,
            'name' => 'Maurizzi',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4175,
            'name' => 'Maüller',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4176,
            'name' => 'Mercantil',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4177,
            'name' => 'Mirador',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4178,
            'name' => 'Miradores de Manantiales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4179,
            'name' => 'Miradores de Manantiales II',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4180,
            'name' => 'Miralta',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4182,
            'name' => 'Mirizzi',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4183,
            'name' => 'Montecristo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4184,
            'name' => 'Müller',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4185,
            'name' => 'Nobu Town',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4186,
            'name' => 'Nuestro Hogar II',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4187,
            'name' => 'Nueva Italia',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4188,
            'name' => 'Nuevo Argüello',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4189,
            'name' => 'Nuevo Poeta Lugones',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4190,
            'name' => 'Nuevo URCA',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4191,
            'name' => 'Obrero',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4192,
            'name' => 'Observatorio',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4193,
            'name' => 'Olivos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4194,
            'name' => 'Ombú',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4195,
            'name' => 'Oña',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4196,
            'name' => 'Padre Claret',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4197,
            'name' => 'Palmar',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4198,
            'name' => 'Palmas de Claret',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4199,
            'name' => 'Panamericano',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4200,
            'name' => 'Parque Alameda',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4201,
            'name' => 'Parque Atlántica',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4202,
            'name' => 'Parque Capital',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4203,
            'name' => 'Parque Chacabuco',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4204,
            'name' => 'Parque Corema',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4205,
            'name' => 'Parque del Este',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4206,
            'name' => 'Parque Futura',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4207,
            'name' => 'Parque Guayaquil',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4208,
            'name' => 'Parque Horizonte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4209,
            'name' => 'Parque Latino',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4210,
            'name' => 'Parque Liceo Primera Sección ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4211,
            'name' => 'Parque Liceo Segunda Sección',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4212,
            'name' => 'Parque Liceo Tercera Sección',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4213,
            'name' => 'Parque Los Molinos ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4214,
            'name' => 'Parque República',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4215,
            'name' => 'Parque San Carlos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4216,
            'name' => 'Parque San Vicente ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4217,
            'name' => 'Parque Tablada',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4218,
            'name' => 'Parque Vélez Sársfield',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4219,
            'name' => 'Paso de los Andes ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4220,
            'name' => 'Patria',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4221,
            'name' => 'Patricios Este',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4222,
            'name' => 'Patricios Norte ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4223,
            'name' => 'Patricios Oeste',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4224,
            'name' => 'Piana',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4225,
            'name' => 'Piedras Blancas ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4226,
            'name' => 'Pinares del Claret',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4227,
            'name' => 'Poesta Lugones',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4228,
            'name' => 'Policial ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4229,
            'name' => 'Portal del Jacaranda',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4230,
            'name' => 'Posta de Vargas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4231,
            'name' => 'Praderas del Sur ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4232,
            'name' => 'Prados de Manantiales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4233,
            'name' => 'Primera Junta',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4234,
            'name' => 'Providencia ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4235,
            'name' => 'Puente Blanco',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4236,
            'name' => 'Quebrada de las Rosas',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4237,
            'name' => 'Quebrada de Manantiales ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4238,
            'name' => 'Quintas de Arguello',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4239,
            'name' => 'Quintas de Ferreyra',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4240,
            'name' => 'Quintas de Flores ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4241,
            'name' => 'Quintas de Italia I',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4242,
            'name' => 'Quintas de Italia II',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4243,
            'name' => 'Quintas de Italia III ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4244,
            'name' => 'Quintas de Italia IV',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4245,
            'name' => 'Quintas de Italia V',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4246,
            'name' => 'Quintas de San Jorge ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4247,
            'name' => 'Recreo Norte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4248,
            'name' => 'Remedios de Escalada',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4249,
            'name' => 'Remo Copello',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4250,
            'name' => 'Renacimiento',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4251,
            'name' => 'René Favaloro',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4252,
            'name' => 'Residencial Alberdi ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4253,
            'name' => 'Residencial América',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4254,
            'name' => 'Residencial Jardín',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4255,
            'name' => 'Residencial América',
            'city_id' => 1429,
        ]);


        Neighborhood::create([
            'id' => 4256,
            'name' => 'Residencial Oeste',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4257,
            'name' => 'Residencial San Carlos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4258,
            'name' => 'Residencial San Roque ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4259,
            'name' => 'Residencial Santa Ana',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4260,
            'name' => 'Residencial Santa Rosa',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4261,
            'name' => 'Residencial Sur ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4262,
            'name' => 'Residencial Vélez Sársfield',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4263,
            'name' => 'Riberas de Manantiales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4264,
            'name' => 'Rincones de Manantiales ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4265,
            'name' => 'Rivadavia',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4266,
            'name' => 'Rocío del Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4267,
            'name' => 'Rogelio Martínezn ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4268,
            'name' => 'Roque Sáenz Peña',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4269,
            'name' => 'Rosedal',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4270,
            'name' => 'Rosedal Anexo ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4271,
            'name' => 'S.M.A.T.A.',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4272,
            'name' => 'Sacchi',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4273,
            'name' => 'Saldán  ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4274,
            'name' => 'San Antonio',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4275,
            'name' => 'San Carlos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4276,
            'name' => 'San Cayetano ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4277,
            'name' => 'San Daniel',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4278,
            'name' => 'San Fernando',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4279,
            'name' => 'San Francisco ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4280,
            'name' => 'San Ignacio',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4281,
            'name' => 'San Ignacio Village',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4282,
            'name' => 'San Javier ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4283,
            'name' => 'San Jorge',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4284,
            'name' => 'San José',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4285,
            'name' => 'San Lorenzo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4286,
            'name' => 'San Marcelo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4287,
            'name' => 'San Martín ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4288,
            'name' => 'San Martín Norte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4289,
            'name' => 'San Martín Norte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4290,
            'name' => 'San Nicolás',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4291,
            'name' => 'San Pablo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4292,
            'name' => 'San Pedro Nolasco',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4293,
            'name' => 'San Rafael',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4294,
            'name' => 'San Román ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4295,
            'name' => 'San Salvador',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4296,
            'name' => 'San Vicente',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4297,
            'name' => 'Santa Cecilia',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4298,
            'name' => 'Santa Clara de Asís',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4299,
            'name' => 'Santa Elena',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4300,
            'name' => 'Santa Isabel ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4301,
            'name' => 'Santa Rita',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4302,
            'name' => 'Santina Norte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4303,
            'name' => 'Sargento Cabral ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4304,
            'name' => 'Sarmiento',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4305,
            'name' => 'SEP',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4306,
            'name' => 'Siete Soles Naturaleza Urbana ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4307,
            'name' => 'Silvano Funes',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4308,
            'name' => 'Smata',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4309,
            'name' => 'Sol Naciente ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4310,
            'name' => 'Solares de Manantiales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4311,
            'name' => 'Solares de Santa María',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4312,
            'name' => 'Solares de Santa María II',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4313,
            'name' => 'Spilimbergo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4314,
            'name' => 'Suárez',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4315,
            'name' => 'Tablada Park',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4316,
            'name' => 'Tablada Park',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4317,
            'name' => 'Talleres',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4318,
            'name' => 'Talleres Este',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4319,
            'name' => 'Talleres Oeste',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4320,
            'name' => 'Talleres Sur',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4321,
            'name' => 'Tejas II',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4322,
            'name' => 'Teodoro Felds',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4323,
            'name' => 'Terranova',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4324,
            'name' => 'Terrazas de Manantiales',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4325,
            'name' => 'Tranviarios',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4326,
            'name' => 'UOCRA',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4327,
            'name' => 'URCA',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4328,
            'name' => 'Uritorco',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4329,
            'name' => 'Urquiza',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4330,
            'name' => 'Valle Cercano',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4331,
            'name' => 'Valle del Cerro',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4332,
            'name' => 'Valle Escondido',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4333,
            'name' => 'Villa 17 de Octubre',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4334,
            'name' => 'Villa 9 de Julio',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4335,
            'name' => 'Villa Achával',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4336,
            'name' => 'Villa Adela',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4337,
            'name' => 'Villa Alberdi',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4338,
            'name' => 'Villa Alicia Risler',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4339,
            'name' => 'Villa Allende Parque',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4340,
            'name' => 'Villa Argentina',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4341,
            'name' => 'Villa Aspacia',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4342,
            'name' => 'Villa Avalos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4343,
            'name' => 'Villa Azalais',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4344,
            'name' => 'Villa Azalais Oeste',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4345,
            'name' => 'Villa Belgrano',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4346,
            'name' => 'Villa Boedo',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4347,
            'name' => 'Villa Cabrera',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4348,
            'name' => 'Villa Centenerio',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4349,
            'name' => 'Villa Claret',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4350,
            'name' => 'Vila Claudina',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4351,
            'name' => 'Villa Corina',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4352,
            'name' => 'Villa Cornú',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4353,
            'name' => 'Villa del Sol',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4354,
            'name' => 'Villa El Libertador',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4355,
            'name' => 'Villa El Trompezón',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4356,
            'name' => 'Villa Esquiú',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4357,
            'name' => 'Villa Gran Parque',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4358,
            'name' => 'Villa la lonja',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4359,
            'name' => 'Villa Los 40 Guasos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4360,
            'name' => 'Villa Los Pinos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4361,
            'name' => 'Villa Mafekin',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4362,
            'name' => 'Villa Marta',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4363,
            'name' => 'Villa Martínez',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4364,
            'name' => 'Villa Paez',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4365,
            'name' => 'Villa Páez',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4366,
            'name' => 'Villa Quisquizacate',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4367,
            'name' => 'Villa Retiro',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4368,
            'name' => 'Villa Revol',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4369,
            'name' => 'Villa Rivadavia',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4370,
            'name' => 'Villa Rivera Indarte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4371,
            'name' => 'Villa San Alberto',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4372,
            'name' => 'Villa San Carlos',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4373,
            'name' => 'Villa Serrana',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4374,
            'name' => 'Villa Siburu',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4375,
            'name' => 'Villa Solferino',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4376,
            'name' => 'Villa Unión',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4377,
            'name' => 'Villa Urquiza',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4378,
            'name' => 'Villa Warcalde',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4379,
            'name' => 'Vivero ',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4380,
            'name' => 'Vivero Norte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4381,
            'name' => 'Yapeyú',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4382,
            'name' => 'Yofre',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4383,
            'name' => 'Yofre H',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4384,
            'name' => 'Yofre I',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4385,
            'name' => 'Yofre Norte',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4386,
            'name' => 'Yofre Sud',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4387,
            'name' => 'Zepa',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4388,
            'name' => 'Zepa A',
            'city_id' => 1429,
        ]);

        Neighborhood::create([
            'id' => 4389,
            'name' => 'Zumarán',
            'city_id' => 1429,
        ]);

        //Villa Carlos Paz

        Neighborhood::create([
            'id' => 4390,
            'name' => 'Centro',
            'city_id' => 1430,
        ]);


        Neighborhood::create([
            'id' => 4391,
            'name' => 'La Quinta',
            'city_id' => 1430,
        ]);

        Neighborhood::create([
            'id' => 4392,
            'name' => 'Las Malvinas',
            'city_id' => 1430,
        ]);

        Neighborhood::create([
            'id' => 4393,
            'name' => 'Los Eucaliptos',
            'city_id' => 1430,
        ]);

        Neighborhood::create([
            'id' => 4394,
            'name' => 'Los Manantiales',
            'city_id' => 1430,
        ]);

        Neighborhood::create([
            'id' => 4395,
            'name' => 'Sarmiento',
            'city_id' => 1430,
        ]);

        Neighborhood::create([
            'id' => 4396,
            'name' => 'Sol y Lago',
            'city_id' => 1430,
        ]);

        Neighborhood::create([
            'id' => 4397,
            'name' => 'Villa Dominguez',
            'city_id' => 1430,
        ]);

        Neighborhood::create([
            'id' => 4398,
            'name' => 'Villa Suiza',
            'city_id' => 1430,
        ]);

        //Villa Allende

        Neighborhood::create([
            'id' => 4399,
            'name' => 'Villa Allende',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4400,
            'name' => 'Villa Allende Golf',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4401,
            'name' => 'San Isidro',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4402,
            'name' => 'Chacras de la Villa',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4403,
            'name' => 'Villa Allende centro',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4404,
            'name' => 'Barrio Norte',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4405,
            'name' => 'Bosque Alegre',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4406,
            'name' => 'Casonas del Golf',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4407,
            'name' => 'Cumbres de villa Allende',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4408,
            'name' => 'Cumbres del Golf',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4409,
            'name' => 'Cóndor Alto',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4410,
            'name' => 'Cóndor Bajo',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4411,
            'name' => 'El Ceibo',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4412,
            'name' => 'Español',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4413,
            'name' => 'Housing y Condominions',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4414,
            'name' => 'Industrial',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4415,
            'name' => 'Jardín Epicuro',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4416,
            'name' => 'La Amalia',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4417,
            'name' => 'La Cruz',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4418,
            'name' => 'La Herradura',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4419,
            'name' => 'La Morada',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4420,
            'name' => 'La Paloma',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4421,
            'name' => 'La Polinesias',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4422,
            'name' => 'Las Rosas',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4423,
            'name' => 'Lomas Este',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4424,
            'name' => 'Lomas Oeste',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4425,
            'name' => 'Lomas Sur',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4426,
            'name' => 'Pan de Azúcar',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4427,
            'name' => 'Prados de la Villa',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4428,
            'name' => 'Prados de la Villa Housing',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4429,
            'name' => 'San Alfonso',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4430,
            'name' => 'San Alfonso I',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4431,
            'name' => 'San Alfonso II',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4432,
            'name' => 'San Clemente',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4433,
            'name' => 'Solares de San Alfonso',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4434,
            'name' => 'Terrazas de la Villa',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4435,
            'name' => 'Terrazas de Villa Allende',
            'city_id' => 1431,
        ]);

        Neighborhood::create([
            'id' => 4436,
            'name' => 'Villa Brizuela',
            'city_id' => 1431,
        ]);

        //La Calera

        Neighborhood::create([
            'id' => 4437,
            'name' => 'Cuesta Colorada',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4438,
            'name' => 'La Rufina',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4439,
            'name' => 'La Cuesta',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4440,
            'name' => 'La Deseada Country',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4441,
            'name' => 'La Estanzuela',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4442,
            'name' => 'Alto Warcalde',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4443,
            'name' => 'Altos de la Calera',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4444,
            'name' => 'Cinco Lomas',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4445,
            'name' => 'El Calicanto',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4446,
            'name' => 'El Rodeo',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4447,
            'name' => 'Jardines de la Estanzuela',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4448,
            'name' => 'La Pankana',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4449,
            'name' => 'Los Prados',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4450,
            'name' => 'Los Prados II',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4451,
            'name' => 'Stoecklin',
            'city_id' => 1432,
        ]);

        Neighborhood::create([
            'id' => 4452,
            'name' => 'Terrazas de la Estanzuela',
            'city_id' => 1432,
        ]);

        //Mendiolaza

        Neighborhood::create([
            'id' => 4453,
            'name' => 'El Talar',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4454,
            'name' => 'Mendiolaza Centro',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4455,
            'name' => 'Valle del Sol',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4456,
            'name' => 'Estancia El Terrón',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4457,
            'name' => 'Estancia Q2',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4458,
            'name' => '4 Hojas',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4459,
            'name' => 'Housing y Condominios',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4460,
            'name' => 'La Finca del Sol',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4461,
            'name' => 'La Serena',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4462,
            'name' => 'Las Corzuelas',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4463,
            'name' => 'Las Lomitas',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4464,
            'name' => 'Lomas de Mendiolaza',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4465,
            'name' => 'Molinos del Viento',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4466,
            'name' => 'Q2',
            'city_id' => 1433,
        ]);

        Neighborhood::create([
            'id' => 4467,
            'name' => 'San Alfonso del Talar',
            'city_id' => 1433,
        ]);

        //Achiras

        Neighborhood::create([
            'id' => 4468,
            'name' => 'Achiras',
            'city_id' => 1434,
        ]);

        //Adelia María

        Neighborhood::create([
            'id' => 4469,
            'name' => 'Adelia María',
            'city_id' => 1435,
        ]);

        //Agua de Oro

        Neighborhood::create([
            'id' => 4470,
            'name' => 'Agua de Oro',
            'city_id' => 1436,
        ]);

        Neighborhood::create([
            'id' => 4471,
            'name' => 'Villa El Rosal',
            'city_id' => 1436,
        ]);

        //Alcira Gigena

        Neighborhood::create([
            'id' => 4472,
            'name' => 'Alcira Gigena',
            'city_id' => 1437,
        ]);

        //Aldea Santa María

        Neighborhood::create([
            'id' => 4473,
            'name' => 'Aldea Santa María',
            'city_id' => 1438,
        ]);

        //Alejandro Roca

        Neighborhood::create([
            'id' => 4474,
            'name' => 'Alejandro Roca',
            'city_id' => 1439,
        ]);

        //Alicia

        Neighborhood::create([
            'id' => 4475,
            'name' => 'Alicia',
            'city_id' => 1440,
        ]);

        //ALmafuerte

        Neighborhood::create([
            'id' => 4476,
            'name' => 'Almafuerte',
            'city_id' => 1441,
        ]);

        //Alpa Corral

        Neighborhood::create([
            'id' => 4477,
            'name' => 'Alpa Corral',
            'city_id' => 1442,
        ]);

        //Alta Gracia

        Neighborhood::create([
            'id' => 4478,
            'name' => 'Norte',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4479,
            'name' => 'El Potrerillo de Larreta',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4480,
            'name' => 'Córdoba',
            'city_id' => 1443,
        ]);


        Neighborhood::create([
            'id' => 4481,
            'name' => 'Liniers',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4482,
            'name' => 'Paravachasca',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4483,
            'name' => 'Parque Casino',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4484,
            'name' => 'Parque del Virrey',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4485,
            'name' => 'Piedra del Sapo',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4486,
            'name' => 'Poluyan',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4487,
            'name' => 'Sabattini',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4488,
            'name' => 'San Juan',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4489,
            'name' => 'San Martin',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4490,
            'name' => 'Santa María',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4491,
            'name' => 'Santa Teresa de Jesus',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4492,
            'name' => 'Sur',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4493,
            'name' => 'Tiro Federal',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4494,
            'name' => 'Touring Club',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4495,
            'name' => 'Villa Camiares',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4496,
            'name' => 'Villa Joven',
            'city_id' => 1443,
        ]);

        Neighborhood::create([
            'id' => 4497,
            'name' => 'Villa Oviedo',
            'city_id' => 1443,
        ]);

        //Alto Alegre

        Neighborhood::create([
            'id' => 4498,
            'name' => 'Alto Alegre',
            'city_id' => 1444,
        ]);

        //Altos de Chipión

        Neighborhood::create([
            'id' => 4499,
            'name' => 'Altos de Chipión',
            'city_id' => 1445,
        ]);

        //Amboy

        Neighborhood::create([
            'id' => 4500,
            'name' => 'Amboy',
            'city_id' => 1446,
        ]);

        //Ana Zumarán

        Neighborhood::create([
            'id' => 4501,
            'name' => 'Ana Zumarán',
            'city_id' => 1447,
        ]);

        //Anisacate

        Neighborhood::create([
            'id' => 4502,
            'name' => 'Anisacate',
            'city_id' => 1448,
        ]);

        //Arroyito

        Neighborhood::create([
            'id' => 4503,
            'name' => 'Arroyito',
            'city_id' => 1449,
        ]);

        //Arroyo Algodón

        Neighborhood::create([
            'id' => 4504,
            'name' => 'Arroyo Algodón',
            'city_id' => 1450,
        ]);

        //Arroyo Cabral

        Neighborhood::create([
            'id' => 4505,
            'name' => 'Arroyo Cabral',
            'city_id' => 1451,
        ]);

        //Arroyo de los Patos

        Neighborhood::create([
            'id' => 4506,
            'name' => 'Arroyo de los Patos',
            'city_id' => 1452,
        ]);

        //Ascochinga

        Neighborhood::create([
            'id' => 4507,
            'name' => 'Ascochinga',
            'city_id' => 1453,
        ]);

        //Assunta

        Neighborhood::create([
            'id' => 4508,
            'name' => 'Assunta',
            'city_id' => 1454,
        ]);

        //Atahona

        Neighborhood::create([
            'id' => 4509,
            'name' => 'Atahona',
            'city_id' => 1455,
        ]);

        //Ausonia

        Neighborhood::create([
            'id' => 4510,
            'name' => 'Ausonia',
            'city_id' => 1456,
        ]);

        //Avellaneda

        Neighborhood::create([
            'id' => 4511,
            'name' => 'Avellaneda',
            'city_id' => 1457,
        ]);

        //Ballesteros

        Neighborhood::create([
            'id' => 4512,
            'name' => 'Ballesteros',
            'city_id' => 1458,
        ]);

        //Ballesteros Sur

        Neighborhood::create([
            'id' => 4513,
            'name' => 'Ballesteros Sur',
            'city_id' => 1459,
        ]);

        //Balnearia

        Neighborhood::create([
            'id' => 4514,
            'name' => 'Balnearia',
            'city_id' => 1460,
        ]);

        //Bell Ville

        Neighborhood::create([
            'id' => 4515,
            'name' => 'Bell Ville',
            'city_id' => 1461,
        ]);

        //Bengolea

        Neighborhood::create([
            'id' => 4516,
            'name' => 'Bengolea',
            'city_id' => 1462,
        ]);

        //Berrotarán

        Neighborhood::create([
            'id' => 4517,
            'name' => 'Berrotarán',
            'city_id' => 1463,
        ]);

        //Bialet Massé

        Neighborhood::create([
            'id' => 4518,
            'name' => 'Bialet Massé',
            'city_id' => 1464,
        ]);

        //Bouwer

        Neighborhood::create([
            'id' => 4519,
            'name' => 'Bouwer',
            'city_id' => 1465,
        ]);

        //Brinkmann

        Neighborhood::create([
            'id' => 4520,
            'name' => 'Brinkman',
            'city_id' => 1466,
        ]);

        //Buchardo

        Neighborhood::create([
            'id' => 4521,
            'name' => 'Buchardo',
            'city_id' => 1467,
        ]);

        //Bulnes

        Neighborhood::create([
            'id' => 4522,
            'name' => 'Bulnes',
            'city_id' => 1468,
        ]);

        //Cabalango

        Neighborhood::create([
            'id' => 4523,
            'name' => 'Cabalengo',
            'city_id' => 1469,
        ]);

        //Calamuchita

        Neighborhood::create([
            'id' => 4524,
            'name' => 'Calamuchita',
            'city_id' => 1470,
        ]);

        //Calchín

        Neighborhood::create([
            'id' => 4525,
            'name' => 'Calchín',
            'city_id' => 1471,
        ]);

        //Calchín Oeste

        Neighborhood::create([
            'id' => 4526,
            'name' => 'Calcín Oeste',
            'city_id' => 1472,
        ]);

        //Calmayo

        Neighborhood::create([
            'id' => 4527,
            'name' => 'Calmayo',
            'city_id' => 1473,
        ]);

        //Caminiaga

        Neighborhood::create([
            'id' => 4528,
            'name' => 'Caminaga',
            'city_id' => 1474,
        ]);

        //Canals

        Neighborhood::create([
            'id' => 4529,
            'name' => 'Canals',
            'city_id' => 1475,
        ]);

        //Candelaria Sud

        Neighborhood::create([
            'id' => 4530,
            'name' => 'Candelaria Sud',
            'city_id' => 1476,
        ]);

        //Candonga

        Neighborhood::create([
            'id' => 4531,
            'name' => 'Candonga',
            'city_id' => 1477,
        ]);

        //Capilla de los Remedios

        Neighborhood::create([
            'id' => 4532,
            'name' => 'Capilla de los Remedios',
            'city_id' => 1478,
        ]);

        //Capilla de Sitón

        Neighborhood::create([
            'id' => 4533,
            'name' => 'Capilla de Sitón',
            'city_id' => 1479,
        ]);

        //Capilla del Carmen

        Neighborhood::create([
            'id' => 4534,
            'name' => 'Capilla del Carmen',
            'city_id' => 1480,
        ]);

        //Capilla del Monte

        Neighborhood::create([
            'id' => 4535,
            'name' => 'Capilla del Monte',
            'city_id' => 1481,
        ]);

        //Carnerillo

        Neighborhood::create([
            'id' => 4536,
            'name' => 'Carnerillo',
            'city_id' => 1482,
        ]);

        //Carrilobo

        Neighborhood::create([
            'id' => 4537,
            'name' => 'Carrilobo',
            'city_id' => 1483,
        ]);

        //Casa Grande

        Neighborhood::create([
            'id' => 4538,
            'name' => 'Casa Grande',
            'city_id' => 1484,
        ]);

        //Cañada de Luque

        Neighborhood::create([
            'id' => 4539,
            'name' => 'Cañada de Luque',
            'city_id' => 1485,
        ]);

        //Cañada de Machado

        Neighborhood::create([
            'id' => 4540,
            'name' => 'Cañada de Machado',
            'city_id' => 1486,
        ]);

        //Cañada de Río Pinto

        Neighborhood::create([
            'id' => 4541,
            'name' => 'Cañada de Río Pinto',
            'city_id' => 1487,
        ]);

        //Cañada del Sauce

        Neighborhood::create([
            'id' => 4542,
            'name' => 'Cañada del Sauce',
            'city_id' => 1488,
        ]);


        //Chaján

        Neighborhood::create([
            'id' => 4543,
            'name' => 'Chaján',
            'city_id' => 1490,
        ]);

        //Chalacea

        Neighborhood::create([
            'id' => 4544,
            'name' => 'Chalacea',
            'city_id' => 1491,
        ]);

        //Chancaní

        Neighborhood::create([
            'id' => 4545,
            'name' => 'Chancaní',
            'city_id' => 1492,
        ]);

        //Charbonier

        Neighborhood::create([
            'id' => 4546,
            'name' => 'Charbonier',
            'city_id' => 1493,
        ]);

        //Charras

        Neighborhood::create([
            'id' => 4547,
            'name' => 'Charras',
            'city_id' => 1494,
        ]);

        //Chazón

        Neighborhood::create([
            'id' => 4548,
            'name' => 'Chazón',
            'city_id' => 1495,
        ]);

        //Chañar Viejo

        Neighborhood::create([
            'id' => 4549,
            'name' => 'Chañar Viejo',
            'city_id' => 1496,
        ]);

        //Chilibroste

        Neighborhood::create([
            'id' => 4550,
            'name' => 'Chilibroste',
            'city_id' => 1497,
        ]);

        //Chucul

        Neighborhood::create([
            'id' => 4551,
            'name' => 'Chucul',
            'city_id' => 1498,
        ]);

        //Churqui Cañada

        Neighborhood::create([
            'id' => 4552,
            'name' => 'Churqui Cañada',
            'city_id' => 1499,
        ]);

        //Chuña

        Neighborhood::create([
            'id' => 4553,
            'name' => 'Chuña',
            'city_id' => 1500,
        ]);

        //Chuña Huasi

        Neighborhood::create([
            'id' => 4554,
            'name' => 'Chuña Huasi',
            'city_id' => 1501,
        ]);

        //Cintra

        Neighborhood::create([
            'id' => 4555,
            'name' => 'Cintra',
            'city_id' => 1502,
        ]);

        //Ciénaga del Coro

        Neighborhood::create([
            'id' => 4556,
            'name' => 'Ciénaga del Coro',
            'city_id' => 1503,
        ]);

        //Colazo

        Neighborhood::create([
            'id' => 4557,
            'name' => 'Colazo',
            'city_id' => 1504,
        ]);

        //Colonia Almada

        Neighborhood::create([
            'id' => 4558,
            'name' => 'Colonia Almada',
            'city_id' => 1505,
        ]);

        //Colonia Anita

        Neighborhood::create([
            'id' => 4559,
            'name' => 'Colonia Anita',
            'city_id' => 1506,
        ]);

        //Colonia Bismarck

        Neighborhood::create([
            'id' => 4560,
            'name' => 'Colonia Bismarck',
            'city_id' => 1507,
        ]);

        //Colonia Bremen

        Neighborhood::create([
            'id' => 4561,
            'name' => 'Colonia Bremen',
            'city_id' => 1508,
        ]);

        //Colonia Caroya

        Neighborhood::create([
            'id' => 4562,
            'name' => 'Colonia Caroya',
            'city_id' => 1509,
        ]);

        //Colonia Cocha

        Neighborhood::create([
            'id' => 4563,
            'name' => 'Colonia Cocha',
            'city_id' => 1510,
        ]);

        //Colonia Iturraspe

        Neighborhood::create([
            'id' => 4564,
            'name' => 'Colonia Iturraspe',
            'city_id' => 1511,
        ]);

        //Colonia Las Cuatro Esquinas

        Neighborhood::create([
            'id' => 4565,
            'name' => 'Colonia Las Cuatro Esquinas',
            'city_id' => 1512,
        ]);

        //Colonia Las Pichanas


        Neighborhood::create([
            'id' => 4566,
            'name' => 'Colonia Las Pichanas',
            'city_id' => 1513,
        ]);

        //Colonia Marina

        Neighborhood::create([
            'id' => 4567,
            'name' => 'Colonia Marina',
            'city_id' => 1514,
        ]);

        //Colonia Prosperidad


        Neighborhood::create([
            'id' => 4568,
            'name' => 'Colonia Prosperidad',
            'city_id' => 1515,
        ]);

        //Colonia San Bartolome

        Neighborhood::create([
            'id' => 4569,
            'name' => 'Colonia San Bartolome',
            'city_id' => 1516,
        ]);

        //Colonia San Pedro

        Neighborhood::create([
            'id' => 4570,
            'name' => 'Colonia San Pedro',
            'city_id' => 1517,
        ]);

        //Colonia Tirolesa

        Neighborhood::create([
            'id' => 4571,
            'name' => 'Colonia Tirolesa',
            'city_id' => 1518,
        ]);

        //Colonia Valtelina

        Neighborhood::create([
            'id' => 4572,
            'name' => 'Colonia Valetelina',
            'city_id' => 1519,
        ]);

        //Colonia Vicente Agüero

        Neighborhood::create([
            'id' => 4573,
            'name' => 'Colonia Vicente Agüero',
            'city_id' => 1520,
        ]);

        //Colonia Videla

        Neighborhood::create([
            'id' => 4574,
            'name' => 'Colonia Videla ',
            'city_id' => 1521,
        ]);

        //Colonia Vignaud

        Neighborhood::create([
            'id' => 4575,
            'name' => 'Colonia Vignaud',
            'city_id' => 1522,
        ]);

        //Comechingones

        Neighborhood::create([
            'id' => 4576,
            'name' => 'Comechingones',
            'city_id' => 1523,
        ]);

        //Conlara

        Neighborhood::create([
            'id' => 4577,
            'name' => 'Conlara',
            'city_id' => 1524,
        ]);

        //Copacabana

        Neighborhood::create([
            'id' => 4578,
            'name' => 'Copacabana',
            'city_id' => 1525,
        ]);

        //Coronel Baigorria

        Neighborhood::create([
            'id' => 4579,
            'name' => 'Coronel Baigorria',
            'city_id' => 1526,
        ]);

        //Coronel Moldes

        Neighborhood::create([
            'id' => 4580,
            'name' => 'Coronel Moldes',
            'city_id' => 1527,
        ]);

        //Corralito

        Neighborhood::create([
            'id' => 4581,
            'name' => 'Corralito',
            'city_id' => 1528,
        ]);

        //Cosquín

        Neighborhood::create([
            'id' => 4582,
            'name' => 'Cosquín',
            'city_id' => 1529,
        ]);

        //Costa Sacate

        Neighborhood::create([
            'id' => 4583,
            'name' => 'Costa Sacate',
            'city_id' => 1530,
        ]);

        //Cruz Chica

        Neighborhood::create([
            'id' => 4584,
            'name' => 'Cruz Chica',
            'city_id' => 1531,
        ]);

        //Cruz del Eje

        Neighborhood::create([
            'id' => 4585,
            'name' => 'Cruz del Eje',
            'city_id' => 1532,
        ]);

        //Cruz Grande

        Neighborhood::create([
            'id' => 4586,
            'name' => 'Cruz Grande',
            'city_id' => 1533,
        ]);

        //Dalmacio Vélez Sarsfield

        Neighborhood::create([
            'id' => 4587,
            'name' => 'Dalmacio Vélez Sarsfield',
            'city_id' => 1534,
        ]);

        //Del campillo

        Neighborhood::create([
            'id' => 4588,
            'name' => 'Del Campillo',
            'city_id' => 1535,
        ]);

        //Despeñaderos

        Neighborhood::create([
            'id' => 4589,
            'name' => 'Despeñaderos',
            'city_id' => 1536,
        ]);

        //Devoto

        Neighborhood::create([
            'id' => 4590,
            'name' => 'Devoto',
            'city_id' => 1537,
        ]);

        //Deán Funes

        Neighborhood::create([
            'id' => 4591,
            'name' => 'Deán Funes',
            'city_id' => 1538,
        ]);

        //Diego de Rojas

        Neighborhood::create([
            'id' => 4592,
            'name' => 'Diego de Rojas',
            'city_id' => 1539,
        ]);

        //Dique Chico

        Neighborhood::create([
            'id' => 4593,
            'name' => 'Dique Chico',
            'city_id' => 1540,
        ]);

        //Dumesnil

        Neighborhood::create([
            'id' => 4594,
            'name' => 'Dumesnil',
            'city_id' => 1541,
        ]);

        //El Arañado

        Neighborhood::create([
            'id' => 4595,
            'name' => 'El Arañado',
            'city_id' => 1542,
        ]);

        //El Chacho

        Neighborhood::create([
            'id' => 4596,
            'name' => 'El Chacho',
            'city_id' => 1543,
        ]);

        //El Crispín

        Neighborhood::create([
            'id' => 4597,
            'name' => 'El Crispín',
            'city_id' => 1544,
        ]);

        //El Fortín

        Neighborhood::create([
            'id' => 4598,
            'name' => 'El Fortín',
            'city_id' => 1545,
        ]);

        //El Manzano

        Neighborhood::create([
            'id' => 4599,
            'name' => 'El Manzano',
            'city_id' => 1546,
        ]);

        //El Rastreador

        Neighborhood::create([
            'id' => 4600,
            'name' => 'El Rastreador',
            'city_id' => 1547,
        ]);

        //El Rodeo

        Neighborhood::create([
            'id' => 4601,
            'name' => 'El Rodeo',
            'city_id' => 1548,
        ]);

        //El Salto

        Neighborhood::create([
            'id' => 4602,
            'name' => 'El Salto',
            'city_id' => 1549,
        ]);

        //El Tío

        Neighborhood::create([
            'id' => 4603,
            'name' => 'El Tío',
            'city_id' => 1550,
        ]);

        //Elena

        Neighborhood::create([
            'id' => 4604,
            'name' => 'Elena',
            'city_id' => 1551,
        ]);

        //Embalse

        Neighborhood::create([
            'id' => 4605,
            'name' => 'Embalse',
            'city_id' => 1552,
        ]);

        //Esquina

        Neighborhood::create([
            'id' => 4606,
            'name' => 'Esquina',
            'city_id' => 1553,
        ]);

        //Estación General Paz

        Neighborhood::create([
            'id' => 4607,
            'name' => 'Estación General Paz',
            'city_id' => 1554,
        ]);

        //Estancia de Guadalupe

        Neighborhood::create([
            'id' => 4608,
            'name' => 'Estancia de Guadalupe',
            'city_id' => 1555,
        ]);

        //Estancia Vieja

        Neighborhood::create([
            'id' => 4609,
            'name' => 'Estancia Vieja',
            'city_id' => 1556,
        ]);

        //Etruria

        Neighborhood::create([
            'id' => 4610,
            'name' => 'Etruria',
            'city_id' => 1557,
        ]);

        //Eufrasio Loza

        Neighborhood::create([
            'id' => 4611,
            'name' => 'Eufrasio Loza',
            'city_id' => 1558,
        ]);

        //Falda del Carmen

        Neighborhood::create([
            'id' => 4612,
            'name' => 'Falda del Carmen',
            'city_id' => 1559,
        ]);

        //Freyre

        Neighborhood::create([
            'id' => 4613,
            'name' => 'Freyre',
            'city_id' => 1560,
        ]);

        //General Cabrera

        Neighborhood::create([
            'id' => 4614,
            'name' => 'General Cabrera',
            'city_id' => 1561,
        ]);

        //General Deheza

        Neighborhood::create([
            'id' => 4615,
            'name' => 'General Deheza',
            'city_id' => 1562,
        ]);

        //General Fotheringham

        Neighborhood::create([
            'id' => 4616,
            'name' => 'General Fotheringham',
            'city_id' => 1563,
        ]);

        //General Levalle

        Neighborhood::create([
            'id' => 4617,
            'name' => 'General Levalle',
            'city_id' => 1564,
        ]);

        //General San Martin

        Neighborhood::create([
            'id' => 4618,
            'name' => 'General San Martín',
            'city_id' => 1565,
        ]);

        //Gould

        Neighborhood::create([
            'id' => 4619,
            'name' => 'Gould',
            'city_id' => 1566,
        ]);

        //Guasapampa

        Neighborhood::create([
            'id' => 4620,
            'name' => 'Guasapampa',
            'city_id' => 1567,
        ]);

        //Gutemberg

        Neighborhood::create([
            'id' => 4621,
            'name' => 'Gutemberg',
            'city_id' => 1568,
        ]);

        //Hernando

        Neighborhood::create([
            'id' => 4622,
            'name' => 'Hernando',
            'city_id' => 1569,
        ]);

        //Huachillas

        Neighborhood::create([
            'id' => 4623,
            'name' => 'Huanchillas',
            'city_id' => 1570,
        ]);

        //Huerta Grande

        Neighborhood::create([
            'id' => 4624,
            'name' => 'Huerta Grande',
            'city_id' => 1571,
        ]);

        //Huinca Renancó

        Neighborhood::create([
            'id' => 4625,
            'name' => 'Huinca Renancó',
            'city_id' => 1572,
        ]);

        //Idiazábal

        Neighborhood::create([
            'id' => 4626,
            'name' => 'Idiazábal',
            'city_id' => 1573,
        ]);

        //Impira

        Neighborhood::create([
            'id' => 4627,
            'name' => 'Impira',
            'city_id' => 1574,
        ]);

        //Ischillín

        Neighborhood::create([
            'id' => 4628,
            'name' => 'Ischillín',
            'city_id' => 1575,
        ]);

        //Italó

        Neighborhood::create([
            'id' => 4629,
            'name' => 'Italó',
            'city_id' => 1576,
        ]);

        //James Craik

        Neighborhood::create([
            'id' => 4630,
            'name' => 'James Craik',
            'city_id' => 1577,
        ]);

        //Jesús María

        Neighborhood::create([
            'id' => 4631,
            'name' => 'Jesús María',
            'city_id' => 1578,
        ]);

        //Jesús de la Quintana

        Neighborhood::create([
            'id' => 4632,
            'name' => 'Jesús de la Quintana',
            'city_id' => 1579,
        ]);

        //Jovita

        Neighborhood::create([
            'id' => 4633,
            'name' => 'Jovita',
            'city_id' => 1580,
        ]);


        //Justiniano Posse

        Neighborhood::create([
            'id' => 4634,
            'name' => 'Justiniano Posse',
            'city_id' => 1581,
        ]);

        //Juárez Celman

        Neighborhood::create([
            'id' => 4635,
            'name' => 'Juárez Celman',
            'city_id' => 1582,
        ]);

        //Kilómetro 658

        Neighborhood::create([
            'id' => 4636,
            'name' => 'Italó',
            'city_id' => 1583,
        ]);

        //La Carlota

        Neighborhood::create([
            'id' => 4637,
            'name' => 'La Carlota',
            'city_id' => 1584,
        ]);

        //La Cautiva

        Neighborhood::create([
            'id' => 4638,
            'name' => 'La Cautiva',
            'city_id' => 1585,
        ]);

        //La Cesira

        Neighborhood::create([
            'id' => 4639,
            'name' => 'La Cesira',
            'city_id' => 1586,
        ]);

        // La Cruz

        Neighborhood::create([
            'id' => 4640,
            'name' => 'La Cruz',
            'city_id' => 1587,
        ]);

        //La Cumbre

        Neighborhood::create([
            'id' => 4641,
            'name' => 'La Cumbre',
            'city_id' => 1588,
        ]);

        //La Cumbrecita

        Neighborhood::create([
            'id' => 4642,
            'name' => 'La Cumbrecita',
            'city_id' => 1589,
        ]);

        //La Falda

        Neighborhood::create([
            'id' => 4643,
            'name' => 'La falda',
            'city_id' => 1590,
        ]);

        //La Francia

        Neighborhood::create([
            'id' => 4644,
            'name' => 'La Francia',
            'city_id' => 1591,
        ]);

        //La Granja

        Neighborhood::create([
            'id' => 4645,
            'name' => 'La Granja',
            'city_id' => 1592,
        ]);

        //La Laguna

        Neighborhood::create([
            'id' => 4646,
            'name' => 'La Laguna',
            'city_id' => 1593,
        ]);

        //La Paisanita

        Neighborhood::create([
            'id' => 4647,
            'name' => 'La Paisanita',
            'city_id' => 1594,
        ]);

        //La Palestina

        Neighborhood::create([
            'id' => 4648,
            'name' => 'La Palestina',
            'city_id' => 1595,
        ]);

        //La Pampa

        Neighborhood::create([
            'id' => 4649,
            'name' => 'La Pampa',
            'city_id' => 1596,
        ]);

        //La Paquita

        Neighborhood::create([
            'id' => 4650,
            'name' => 'La Paquita',
            'city_id' => 1597,
        ]);

        //La Para

        Neighborhood::create([
            'id' => 4651,
            'name' => 'La Para',
            'city_id' => 1598,
        ]);

        //La Paz

        Neighborhood::create([
            'id' => 4652,
            'name' => 'La Paz',
            'city_id' => 1599,
        ]);

        //La Playa

        Neighborhood::create([
            'id' => 4653,
            'name' => 'La Playa',
            'city_id' => 1600,
        ]);

        //La Playosa

        Neighborhood::create([
            'id' => 4654,
            'name' => 'La Playosa',
            'city_id' => 1601,
        ]);

        //La Población

        Neighborhood::create([
            'id' => 4655,
            'name' => 'La Población',
            'city_id' => 1602,
        ]);

        //La Posta

        Neighborhood::create([
            'id' => 4656,
            'name' => 'La Posta',
            'city_id' => 1603  ,
        ]);

        //La Puerta

        Neighborhood::create([
            'id' => 4657,
            'name' => 'La Puerta',
            'city_id' => 1604,
        ]);

        //La Quinta

        Neighborhood::create([
            'id' => 4658,
            'name' => 'La Quinta',
            'city_id' => 1605,
        ]);

        //La Rancherita

        Neighborhood::create([
            'id' => 4659,
            'name' => 'La Rancherita',
            'city_id' => 1606,
        ]);

        //La Rinconada

        Neighborhood::create([
            'id' => 4660,
            'name' => 'La Rinconada',
            'city_id' => 1607,
        ]);

        //La Tordilla

        Neighborhood::create([
            'id' => 4661,
            'name' => 'La Tordilla',
            'city_id' => 1608,
        ]);

        //Laborde

        Neighborhood::create([
            'id' => 4662,
            'name' => 'Laborde',
            'city_id' => 1609,
        ]);

        //Laboulaye

        Neighborhood::create([
            'id' => 4663,
            'name' => 'Laboulaye',
            'city_id' => 1610,
        ]);

        //Laguna Larga

        Neighborhood::create([
            'id' => 4664,
            'name' => 'Laguna Larga',
            'city_id' => 1611,
        ]);

        //Las Acequias

        Neighborhood::create([
            'id' => 4665,
            'name' => 'Las Acequias',
            'city_id' => 1612,
        ]);

        //Las Albahacas

        Neighborhood::create([
            'id' => 4666,
            'name' => 'Las Albahacas',
            'city_id' => 1613,
        ]);

        //Las Arrias

        Neighborhood::create([
            'id' => 4667,
            'name' => 'Las Arrias',
            'city_id' => 1614,
        ]);

        //Las Bajadas

        Neighborhood::create([
            'id' => 4668,
            'name' => 'Las Bajadas',
            'city_id' => 1615,
        ]);

        //Las Caleras

        Neighborhood::create([
            'id' => 4669,
            'name' => 'Las Caleras',
            'city_id' => 1616,
        ]);

        //Las Calles

        Neighborhood::create([
            'id' => 4670,
            'name' => 'Las Calles',
            'city_id' => 1617,
        ]);

        //Las Gramillas

        Neighborhood::create([
            'id' => 4671,
            'name' => 'Las Gramillas',
            'city_id' => 1618,
        ]);

        //Las Higueras

        Neighborhood::create([
            'id' => 4672,
            'name' => 'Las Higueras',
            'city_id' => 1619,
        ]);

        //Las Isletillas

        Neighborhood::create([
            'id' => 4673,
            'name' => 'Las Isletillas',
            'city_id' => 1620,
        ]);

        //Las Junturas

        Neighborhood::create([
            'id' => 4674,
            'name' => 'Las Junturas',
            'city_id' => 1621,
        ]);

        //Las Palmas

        Neighborhood::create([
            'id' => 4675,
            'name' => 'Las Palmas',
            'city_id' => 1622,
        ]);

        //Las Perdices

        Neighborhood::create([
            'id' => 4676,
            'name' => 'Las Perdices',
            'city_id' => 1623,
        ]);

        //Las Peñas

        Neighborhood::create([
            'id' => 4677,
            'name' => 'Las Peñas',
            'city_id' => 1624,
        ]);

        //Las Peñas Sud

        Neighborhood::create([
            'id' => 4678,
            'name' => 'Las Peñas Sud',
            'city_id' => 1625,
        ]);

        //Las Rabonas

        Neighborhood::create([
            'id' => 4679,
            'name' => 'Las Rabonas',
            'city_id' => 1626,
        ]);

        //Las Saladas

        Neighborhood::create([
            'id' => 4680,
            'name' => 'Las Saladas',
            'city_id' => 1627,
        ]);

        //Las Tapías

        Neighborhood::create([
            'id' => 4681,
            'name' => 'Las Tapías',
            'city_id' => 1628,
        ]);

        //Las Varas

        Neighborhood::create([
            'id' => 4682,
            'name' => 'Las Varas',
            'city_id' => 1629,
        ]);

        //Las Varillas

        Neighborhood::create([
            'id' => 4683,
            'name' => 'Las Varillas',
            'city_id' => 1630,
        ]);

        //Las Vertientes

        Neighborhood::create([
            'id' => 4684,
            'name' => 'Las Vertientes',
            'city_id' => 1631,
        ]);

        //Leguizamón

        Neighborhood::create([
            'id' => 4685,
            'name' => 'Leguizamón',
            'city_id' => 1632,
        ]);

        //Los Cedros

        Neighborhood::create([
            'id' => 4686,
            'name' => 'Los Cedros',
            'city_id' => 1633,
        ]);

        //Los Cerrillos

        Neighborhood::create([
            'id' => 4687,
            'name' => 'Los Cerrillos',
            'city_id' => 1634,
        ]);


        //Los Cocos

        Neighborhood::create([
            'id' => 4688,
            'name' => 'Los Cocos',
            'city_id' => 1637,
        ]);

        //Los Cóndores

        Neighborhood::create([
            'id' => 4689,
            'name' => 'Los Cóndores',
            'city_id' => 1638,
        ]);

        //Los Hornillos

        Neighborhood::create([
            'id' => 4690,
            'name' => 'Los Hornillos',
            'city_id' => 1639,
        ]);

        //Los Hoyos

        Neighborhood::create([
            'id' => 4691,
            'name' => 'Los Hoyos',
            'city_id' => 1640,
        ]);

        //Los Mistoles

        Neighborhood::create([
            'id' => 4692,
            'name' => 'Los Mistoles',
            'city_id' => 1641,
        ]);

        //Los Molinos

        Neighborhood::create([
            'id' => 4693,
            'name' => 'Los Molinos',
            'city_id' => 1642,
        ]);

        //Los Pozos

        Neighborhood::create([
            'id' => 4694,
            'name' => 'Los Pozos',
            'city_id' => 1643,
        ]);

        //Los Reartes

        Neighborhood::create([
            'id' => 4695,
            'name' => 'Los Reartes',
            'city_id' => 1644,
        ]);

        //Los Talares

        Neighborhood::create([
            'id' => 4696,
            'name' => 'Los Talares',
            'city_id' => 1645,
        ]);

        //Los Zorros

        Neighborhood::create([
            'id' => 4697,
            'name' => 'Los Zorros',
            'city_id' => 1646,
        ]);


        //Lucio V Mansilla

        Neighborhood::create([
            'id' => 4700,
            'name' => 'Lucio V Mansilla',
            'city_id' => 1647,
        ]);

        //Luque

        Neighborhood::create([
            'id' => 4701,
            'name' => 'Luque',
            'city_id' => 1648,
        ]);

        //Lutti

        Neighborhood::create([
            'id' => 4702,
            'name' => 'Lutti',
            'city_id' => 1649,
        ]);

        //Luyaba

        Neighborhood::create([
            'id' => 4703,
            'name' => 'Luyaba',
            'city_id' => 1650,
        ]);

        //Malagueño

        Neighborhood::create([
            'id' => 4704,
            'name' => 'Malagueño',
            'city_id' => 1651,
        ]);

        //Malena

        Neighborhood::create([
            'id' => 4705,
            'name' => 'Malena',
            'city_id' => 1652,
        ]);

        //Malvinas Argentinas

        Neighborhood::create([
            'id' => 4706,
            'name' => 'Malvinas Argentinas',
            'city_id' => 1653,
        ]);

        //Manfredi

        Neighborhood::create([
            'id' => 4707,
            'name' => 'Manfredi',
            'city_id' => 1654,
        ]);

        //Maquinista Gallini

        Neighborhood::create([
            'id' => 4708,
            'name' => 'Maquinista Gallini',
            'city_id' => 1655,
        ]);

        //Marcos Juárez

        Neighborhood::create([
            'id' => 4709,
            'name' => 'Marcos Juárez',
            'city_id' => 1656,
        ]);

        //Marull

        Neighborhood::create([
            'id' => 4710,
            'name' => 'Marull',
            'city_id' => 1667,
        ]);

        //Matorrales

        Neighborhood::create([
            'id' => 4711,
            'name' => 'Matorrales',
            'city_id' => 1668,
        ]);

        //Mataldi

        Neighborhood::create([
            'id' => 4712,
            'name' => 'Mataldi',
            'city_id' => 1669,
        ]);

        //Mayu Sumaj

        Neighborhood::create([
            'id' => 4713,
            'name' => 'Mayu Sumaj',
            'city_id' => 1670,
        ]);

        //Melo

        Neighborhood::create([
            'id' => 4714,
            'name' => 'Melo',
            'city_id' => 1671,
        ]);

        //Mi Granja

        Neighborhood::create([
            'id' => 4715,
            'name' => 'Mi Granja',
            'city_id' => 1672,
        ]);

        //Mina Clavero

        Neighborhood::create([
            'id' => 4716,
            'name' => 'Mina Clavero',
            'city_id' => 1673,
        ]);

        //Miramar

        Neighborhood::create([
            'id' => 4717,
            'name' => 'Miramar',
            'city_id' => 1674,
        ]);

        //Monte Cristo

        Neighborhood::create([
            'id' => 4718,
            'name' => 'Monte Cristo',
            'city_id' => 1675,
        ]);

        //Monte de los Gauchos

        Neighborhood::create([
            'id' => 4719,
            'name' => 'Monte de los Gauchos',
            'city_id' => 1676,
        ]);

        //Monte Leña

        Neighborhood::create([
            'id' => 4720,
            'name' => 'Monte Leña',
            'city_id' => 1677,
        ]);

        //Monte Maíz

        Neighborhood::create([
            'id' => 4721,
            'name' => 'Monte Maíz',
            'city_id' => 1678,
        ]);

        //Monte Ralo

        Neighborhood::create([
            'id' => 4722,
            'name' => 'Monte Ralo',
            'city_id' => 1679,
        ]);

        //Morrison

        Neighborhood::create([
            'id' => 4723,
            'name' => 'Morrison',
            'city_id' => 1680,
        ]);

        //Morteros

        Neighborhood::create([
            'id' => 4724,
            'name' => 'Morteros',
            'city_id' => 1681,
        ]);

        //Nicolás Bruzzone

        Neighborhood::create([
            'id' => 4725,
            'name' => 'Nicolas Bruzzone',
            'city_id' => 1682,
        ]);

        //Noetinger

        Neighborhood::create([
            'id' => 4726,
            'name' => 'Noetinger',
            'city_id' => 1683,
        ]);

        //Nono

        Neighborhood::create([
            'id' => 4727,
            'name' => 'Nono',
            'city_id' => 1684,
        ]);

        //Obispo Trejo

        Neighborhood::create([
            'id' => 4728,
            'name' => 'Obispo Trejo',
            'city_id' => 1685,
        ]);

        //Olaeta

        Neighborhood::create([
            'id' => 4729,
            'name' => 'Olaeta',
            'city_id' => 1686,
        ]);

        //Oliva

        Neighborhood::create([
            'id' => 4730,
            'name' => 'Oliva',
            'city_id' => 1687,
        ]);

        //Olivares de San Nicolás

        Neighborhood::create([
            'id' => 4731,
            'name' => 'Olivares de San Nicolás',
            'city_id' => 1688,
        ]);

        //Onagoyti

        Neighborhood::create([
            'id' => 4732,
            'name' => 'Onagoyti',
            'city_id' => 1689,
        ]);

        //Oncativo

        Neighborhood::create([
            'id' => 4733,
            'name' => 'Oncativo',
            'city_id' => 1690,
        ]);

        //Ordóñez

        Neighborhood::create([
            'id' => 4734,
            'name' => 'Ordóñez',
            'city_id' => 1691,
        ]);


        //Pacheco de Melo

        Neighborhood::create([
            'id' => 4736,
            'name' => 'Pacheco de Melo',
            'city_id' => 1693,
        ]);

        //Pampayasta Norte

        Neighborhood::create([
            'id' => 4737,
            'name' => 'Pampayasta Norte',
            'city_id' => 1694,
        ]);

        //Pampayasta Sud

        Neighborhood::create([
            'id' => 4738,
            'name' => 'Pampayasta Sud',
            'city_id' => 1695,
        ]);

        //Panaholma

        Neighborhood::create([
            'id' => 4739,
            'name' => 'Panaholma',
            'city_id' => 1696,
        ]);

        //Pascanas

        Neighborhood::create([
            'id' => 4740,
            'name' => 'Pascanas',
            'city_id' => 1697,
        ]);

        //Pasco

        Neighborhood::create([
            'id' => 4741,
            'name' => 'Pasco',
            'city_id' => 1698,
        ]);

        //Paso del Durazno

        Neighborhood::create([
            'id' => 4742,
            'name' => 'Paso del durazno',
            'city_id' => 1699,
        ]);

        //Pilar

        Neighborhood::create([
            'id' => 4743,
            'name' => 'Pilar',
            'city_id' => 1700,
        ]);

        //Pincén

        Neighborhood::create([
            'id' => 4744,
            'name' => 'Pincén',
            'city_id' => 1701,
        ]);

        //Piquillín

        Neighborhood::create([
            'id' => 4745,
            'name' => 'Piquillín',
            'city_id' => 1702,
        ]);

        //Plaza de Mercedes

        Neighborhood::create([
            'id' => 4746,
            'name' => 'Plaza de Mercedes',
            'city_id' => 1703,
        ]);

        //Plaza Luxardo

        Neighborhood::create([
            'id' => 4747,
            'name' => 'Plaza Luxardo',
            'city_id' => 1704,
        ]);

        //Porteña

        Neighborhood::create([
            'id' => 4748,
            'name' => 'Porteña',
            'city_id' => 1705,
        ]);

        //Potrero de Garay

        Neighborhood::create([
            'id' => 4749,
            'name' => 'Potrero de Garay',
            'city_id' => 1706,
        ]);

        //Pozo del Molle

        Neighborhood::create([
            'id' => 4750,
            'name' => 'Pozo del Molle',
            'city_id' => 1707,
        ]);

        //Pozo Nuevo

        Neighborhood::create([
            'id' => 4751,
            'name' => 'Pozo Nuevo',
            'city_id' => 1708,
        ]);

        //Pueblo Italiano

        Neighborhood::create([
            'id' => 4752,
            'name' => 'Pueblo Italiano',
            'city_id' => 1709,
        ]);

        //Puesto de Castro

        Neighborhood::create([
            'id' => 4753,
            'name' => 'Puesto de Castro',
            'city_id' => 1710,
        ]);

        //Punta del Agua

        Neighborhood::create([
            'id' => 4754,
            'name' => 'Punta del Agua',
            'city_id' => 1711,
        ]);

        //Rafael García

        Neighborhood::create([
            'id' => 4755,
            'name' => 'Rafael García',
            'city_id' => 1711,
        ]);

        //Quebracho Herrado

        Neighborhood::create([
            'id' => 4756,
            'name' => 'Quebracho Herrado',
            'city_id' => 1712,
        ]);

        //Quebrado de los Pozos

        Neighborhood::create([
            'id' => 4757,
            'name' => 'Quebrado de los Pozos',
            'city_id' => 1713,
        ]);

        //Quilino

        Neighborhood::create([
            'id' => 4758,
            'name' => 'Quilino',
            'city_id' => 1714,
        ]);

        //Rafael García

        Neighborhood::create([
            'id' => 4759,
            'name' => 'Rafael García',
            'city_id' => 1715,
        ]);

        //Ranqueles

        Neighborhood::create([
            'id' => 4760,
            'name' => 'Ranqueles',
            'city_id' => 1716,
        ]);

        //Rayo Cortado

        Neighborhood::create([
            'id' => 4761,
            'name' => 'Rayo Cortado',
            'city_id' => 1717,
        ]);

        //Reducción

        Neighborhood::create([
            'id' => 4762,
            'name' => 'Reducción',
            'city_id' => 1718,
        ]);

        //Rincon

        Neighborhood::create([
            'id' => 4763,
            'name' => 'Rincon',
            'city_id' => 1719,
        ]);

        //Rosales

        Neighborhood::create([
            'id' => 4764,
            'name' => 'Rosales',
            'city_id' => 1720,
        ]);

        //Rosario del Saladillo

        Neighborhood::create([
            'id' => 4765,
            'name' => 'Rosario del Saladillo',
            'city_id' => 1721,
        ]);

        //Río Bamba

        Neighborhood::create([
            'id' => 4766,
            'name' => 'Río Bamba',
            'city_id' => 1722,
        ]);

        //Río Ceballos

        Neighborhood::create([
            'id' => 4767,
            'name' => 'Río Ceballos',
            'city_id' => 1723,
        ]);

        //Río Tercero

        Neighborhood::create([
            'id' => 4768,
            'name' => 'Río Cuarto',
            'city_id' => 1724,
        ]);

        //Río de los Sauces

        Neighborhood::create([
            'id' => 4769,
            'name' => 'Río de los Sauces',
            'city_id' => 1725,
        ]);

        //Río Primero

        Neighborhood::create([
            'id' => 4770,
            'name' => 'Río Primero',
            'city_id' => 1726,
        ]);

        //Río Segundo

        Neighborhood::create([
            'id' => 4771,
            'name' => 'Río Segundo',
            'city_id' => 1727,
        ]);

        //Río Tercero

        Neighborhood::create([
            'id' => 4772,
            'name' => 'Río Tercero',
            'city_id' => 1728,
        ]);

        //Sacanta

        Neighborhood::create([
            'id' => 4773,
            'name' => 'Sacanta',
            'city_id' => 1729,
        ]);

        //Sagrada Familia

        Neighborhood::create([
            'id' => 4774,
            'name' => 'Sagrada Familia',
            'city_id' => 1730,
        ]);

        //Saldán

        Neighborhood::create([
            'id' => 4775,
            'name' => 'Saldán',
            'city_id' => 1731,
        ]);

        //Salsacate

        Neighborhood::create([
            'id' => 4776,
            'name' => 'Salsacate',
            'city_id' => 1732,
        ]);

        //Salsipuedes

        Neighborhood::create([
            'id' => 4777,
            'name' => 'Salsipuedes',
            'city_id' => 1733,
        ]);

        //Sampacho

        Neighborhood::create([
            'id' => 4778,
            'name' => 'Sampacho',
            'city_id' => 1734,
        ]);

        //San Agustín

        Neighborhood::create([
            'id' => 4779,
            'name' => 'San Agustín',
            'city_id' => 1735,
        ]);

        //San Alberto

        Neighborhood::create([
            'id' => 4780,
            'name' => 'San Alberto',
            'city_id' => 1736,
        ]);

        //San Antonio de Arredondo

        Neighborhood::create([
            'id' => 4781,
            'name' => 'San Antonio de Arredondo',
            'city_id' => 1737,
        ]);

        //San Antonio de Litín

        Neighborhood::create([
            'id' => 4782,
            'name' => 'San Antonio de Litín',
            'city_id' => 1738,
        ]);

        //San Basilio

        Neighborhood::create([
            'id' => 4783,
            'name' => 'San Basilio',
            'city_id' => 1739,
        ]);

        //San Carlos Minas

        Neighborhood::create([
            'id' => 4784,
            'name' => 'San Carlos Minas',
            'city_id' => 1740,
        ]);

        //San Clemente

        Neighborhood::create([
            'id' => 4785,
            'name' => 'San Clemente',
            'city_id' => 1741,
        ]);

        //San Esteban

        Neighborhood::create([
            'id' => 4786,
            'name' => 'San Esteban',
            'city_id' => 1742,
        ]);

        //San Francisco

        Neighborhood::create([
            'id' => 4787,
            'name' => 'San Francisco',
            'city_id' => 1743,
        ]);

        //San Francisco del Chañar

        Neighborhood::create([
            'id' => 4788,
            'name' => 'San Francisco del Chañar',
            'city_id' => 1744,
        ]);

        //San Gerónimo

        Neighborhood::create([
            'id' => 4789,
            'name' => 'San Gerónimo',
            'city_id' => 1745,
        ]);

        //San Ignacio

        Neighborhood::create([
            'id' => 4790,
            'name' => 'San Ignacio',
            'city_id' => 1746,
        ]);

        //San Javier

        Neighborhood::create([
            'id' => 4791,
            'name' => 'San Javier',
            'city_id' => 1747,
        ]);

        //San Joaquín

        Neighborhood::create([
            'id' => 4792,
            'name' => 'San Joaquín',
            'city_id' => 1748,
        ]);

        //San José

        Neighborhood::create([
            'id' => 4793,
            'name' => 'San José',
            'city_id' => 1749,
        ]);

        //San José de la Dormida

        Neighborhood::create([
            'id' => 4794,
            'name' => 'San José de la Dormida',
            'city_id' => 1750,
        ]);

        //San José de las Salinas

        Neighborhood::create([
            'id' => 4795,
            'name' => 'San José de las Salinas',
            'city_id' => 1751,
        ]);

        //San Justo

        Neighborhood::create([
            'id' => 4796,
            'name' => 'San Justo',
            'city_id' => 1752,
        ]);

        //San Lorenzo

        Neighborhood::create([
            'id' => 4797,
            'name' => 'San Lorenzo',
            'city_id' => 1753,
        ]);

        //San Roque

        Neighborhood::create([
            'id' => 4798,
            'name' => 'San Roque',
            'city_id' => 1754,
        ]);

        //San Marcos Sud

        Neighborhood::create([
            'id' => 4799,
            'name' => 'San Marcos Sud',
            'city_id' => 1755,
        ]);

        //San Pedro

        Neighborhood::create([
            'id' => 4800,
            'name' => 'San Pedro',
            'city_id' => 1756,
        ]);

        //San Pedro Norte

        Neighborhood::create([
            'id' => 4801,
            'name' => 'San Pedro Norte',
            'city_id' => 1757,
        ]);

        //San Roque

        Neighborhood::create([
            'id' => 4802,
            'name' => 'San Roque',
            'city_id' => 1758,
        ]);

        //San Vicente

        Neighborhood::create([
            'id' => 4803,
            'name' => 'San Vicente',
            'city_id' => 1759,
        ]);

        //Santa Catalina

        Neighborhood::create([
            'id' => 4804,
            'name' => 'Santa Catalina',
            'city_id' => 1760,
        ]);

        //Santa Elena

        Neighborhood::create([
            'id' => 4805,
            'name' => 'Santa Elena',
            'city_id' => 1761,
        ]);

        //Santa Eufemia

        Neighborhood::create([
            'id' => 4806,
            'name' => 'Santa Eufemia',
            'city_id' => 1762,
        ]);

        //Santa María

        Neighborhood::create([
            'id' => 4807,
            'name' => 'Santa María',
            'city_id' => 1763,
        ]);

        //Santa María de Punilla

        Neighborhood::create([
            'id' => 4808,
            'name' => 'Santa María de Punilla',
            'city_id' => 1764,
        ]);

        //Santa Mónica

        Neighborhood::create([
            'id' => 4809,
            'name' => 'Santa Mónica',
            'city_id' => 1765,
        ]);

        //Santa Rosa de Calamuchita

        Neighborhood::create([
            'id' => 4810,
            'name' => 'Santa Rosa de Calamuchita',
            'city_id' => 1766,
        ]);

        //Santa Rosa de Río Primero

        Neighborhood::create([
            'id' => 4811,
            'name' => 'Santa Rosa de Río Primero',
            'city_id' => 1767,
        ]);

        //Santiago Temple

        Neighborhood::create([
            'id' => 4812,
            'name' => 'Santiago Temple',
            'city_id' => 1768,
        ]);

        //Sarmiento

        Neighborhood::create([
            'id' => 4813,
            'name' => 'Sarmiento',
            'city_id' => 1769,
        ]);

        //Saturnino María Laspiur

        Neighborhood::create([
            'id' => 4814,
            'name' => 'Saturnino María Laspiur',
            'city_id' => 1770,
        ]);

        //Sauce Arriba

        Neighborhood::create([
            'id' => 4815,
            'name' => 'Sauce Arriba',
            'city_id' => 1771,
        ]);

        //Sebastián Elcano

        Neighborhood::create([
            'id' => 4816,
            'name' => 'Sebastían Elcano',
            'city_id' => 1772,
        ]);

        //Seeber

        Neighborhood::create([
            'id' => 4817,
            'name' => 'Seeber',
            'city_id' => 1773,
        ]);

        //Segunda Usina

        Neighborhood::create([
            'id' => 4818,
            'name' => 'Segunda Usina',
            'city_id' => 1774,
        ]);

        //Serrano

        Neighborhood::create([
            'id' => 4819,
            'name' => 'Serrano',
            'city_id' => 1775,
        ]);

        //Simbolar

        Neighborhood::create([
            'id' => 4820,
            'name' => 'Simbolar',
            'city_id' => 1779,
        ]);

        //Sinsacate

        Neighborhood::create([
            'id' => 4821,
            'name' => 'Sinsacate',
            'city_id' => 1780,
        ]);

        //Suco

        Neighborhood::create([
            'id' => 4822,
            'name' => 'Suco',
            'city_id' => 1781,
        ]);

        //Tala Cañada

        Neighborhood::create([
            'id' => 4823,
            'name' => 'Tala Cañada',
            'city_id' => 1782,
        ]);




        //Toledo

        Neighborhood::create([
            'id' => 4824,
            'name' => 'Toledo',
            'city_id' => 1790,
        ]);

        //Toro Pujio

        Neighborhood::create([
            'id' => 4825,
            'name' => 'Toro Pujio',
            'city_id' => 1791,
        ]);

        //Tosno

        Neighborhood::create([
            'id' => 4826,
            'name' => 'Tosno',
            'city_id' => 1792,
        ]);

        //Tosquita

        Neighborhood::create([
            'id' => 4827,
            'name' => 'Tosquita',
            'city_id' => 1793,
        ]);

        //Tránsito

        Neighborhood::create([
            'id' => 4828,
            'name' => 'Tránsito',
            'city_id' => 1794,
        ]);

        //Tío Pujio

        Neighborhood::create([
            'id' => 4829,
            'name' => 'Tío Pujio',
            'city_id' => 1795,
        ]);

        //Ucacha

        Neighborhood::create([
            'id' => 4830,
            'name' => 'Ucacha',
            'city_id' => 1796,
        ]);

        //Unquillo

        Neighborhood::create([
            'id' => 4831,
            'name' => 'Unquillo',
            'city_id' => 1797,
        ]);

        //Valle Hermoso

        Neighborhood::create([
            'id' => 4832,
            'name' => 'Valle Hermoso',
            'city_id' => 1798,
        ]);

        //Viamonte

        Neighborhood::create([
            'id' => 4833,
            'name' => 'Viamonte',
            'city_id' => 1799,
        ]);

        //Vicuña Mackenna

        Neighborhood::create([
            'id' => 4834,
            'name' => 'Vicuña Mackenna',
            'city_id' => 1800,
        ]);

        //Villa Amancay

        Neighborhood::create([
            'id' => 4835,
            'name' => 'Villa Amancay',
            'city_id' => 1801,
        ]);

        //Villa Ascasubi

        Neighborhood::create([
            'id' => 4836,
            'name' => 'Villa Ascasubi',
            'city_id' => 1802,
        ]);

        //Villa Candelaria Norte

        Neighborhood::create([
            'id' => 4837,
            'name' => 'Villa Candelaria Norte',
            'city_id' => 1803,
        ]);

        //Villa Cerro Azul

        Neighborhood::create([
            'id' => 4838,
            'name' => 'Villa Cerro Azul',
            'city_id' => 1804,
        ]);

        //Villa Ciudad de America

        Neighborhood::create([
            'id' => 4839,
            'name' => 'Villa Ciudad de America',
            'city_id' => 1805,
        ]);

        //Villa Ciudad Parque de los Reartes

        Neighborhood::create([
            'id' => 4840,
            'name' => 'Villa Ciudad Parque de los Reartes',
            'city_id' => 1806,
        ]);

        //Villa Concepción del Tío

        Neighborhood::create([
            'id' => 4841,
            'name' => 'Villa Concepción del Tío',
            'city_id' => 1807,
        ]);

        //Villa Cura Brochero

        Neighborhood::create([
            'id' => 4842,
            'name' => 'Villa Cura Brochero',
            'city_id' => 1808,
        ]);

        //Villa de las Rosas

        Neighborhood::create([
            'id' => 4843,
            'name' => 'Villa de las Rosas',
            'city_id' => 1809,
        ]);

        //Villa de María

        Neighborhood::create([
            'id' => 4844,
            'name' => 'Villa de María',
            'city_id' => 1810,
        ]);

        //Villa de Pocho

        Neighborhood::create([
            'id' => 4845,
            'name' => 'Villa de Pocho',
            'city_id' => 1811,
        ]);

        //Villa de Soto

        Neighborhood::create([
            'id' => 4846,
            'name' => 'Villa de Soto',
            'city_id' => 1812,
        ]);

        //Villa del Dique

        Neighborhood::create([
            'id' => 4847,
            'name' => 'Villa del dique',
            'city_id' => 1813,
        ]);

        //Villa del Prado

        Neighborhood::create([
            'id' => 4848,
            'name' => 'Villa del Prado',
            'city_id' => 1814,
        ]);

        //Villa del Rosario

        Neighborhood::create([
            'id' => 4849,
            'name' => 'Villa del Rosario',
            'city_id' => 1815,
        ]);

        //Villa del Totoral

        Neighborhood::create([
            'id' => 4850,
            'name' => 'Villa del Totoral',
            'city_id' => 1816,
        ]);

        //Villa Dolores

        Neighborhood::create([
            'id' => 4851,
            'name' => 'Villa Dolores',
            'city_id' => 1817,
        ]);

        //Villa El Chacay

        Neighborhood::create([
            'id' => 4852,
            'name' => 'Villa El Chacay',
            'city_id' => 1818,
        ]);

        //Villa Flor Serrana

        Neighborhood::create([
            'id' => 4853,
            'name' => 'Villa Flor Serrana',
            'city_id' => 1819,
        ]);

        //Villa Fontana

        Neighborhood::create([
            'id' => 4854,
            'name' => 'Villa Fontana',
            'city_id' => 1820,
        ]);

        //Villa General Belgrano

        Neighborhood::create([
            'id' => 4855,
            'name' => 'Villa General Belgrano',
            'city_id' => 1821,
        ]);

        //Villa Giardino

        Neighborhood::create([
            'id' => 4856,
            'name' => 'Villa Giardino',
            'city_id' => 1822,
        ]);

        //Villa Gutiérrez

        Neighborhood::create([
            'id' => 4857,
            'name' => 'Villa Gutiérrez',
            'city_id' => 1823,
        ]);

        //Villa Huidobro

        Neighborhood::create([
            'id' => 4858,
            'name' => 'Villa Huidobro',
            'city_id' => 1824,
        ]);

        //Villa Icho Cruz

        Neighborhood::create([
            'id' => 4859,
            'name' => 'Villa Icho Cruz',
            'city_id' => 1825,
        ]);

        //Villa La Bolsa

        Neighborhood::create([
            'id' => 4860,
            'name' => 'Villa La Bolsa',
            'city_id' => 1826,
        ]);

        //Villa Los Aromos

        Neighborhood::create([
            'id' => 4861,
            'name' => 'Villa los Aromos',
            'city_id' => 1827,
        ]);

        //Villa los Patos

        Neighborhood::create([
            'id' => 4862,
            'name' => 'Villa los Patos',
            'city_id' => 1828,
        ]);

        //Villa María

        Neighborhood::create([
            'id' => 4863,
            'name' => 'Villa María',
            'city_id' => 1829,
        ]);

        //Villa Nueva

        Neighborhood::create([
            'id' => 4864,
            'name' => 'Villa Nueva',
            'city_id' => 1830,
        ]);

        //Villa Parque Santa Ana

        Neighborhood::create([
            'id' => 4865,
            'name' => 'Villa Parque Santa Ana',
            'city_id' => 1831,
        ]);

        //Villa Parque Siquiman

        Neighborhood::create([
            'id' => 4866,
            'name' => 'Villa Parque Siquiman',
            'city_id' => 1832,
        ]);

        //Villa Quillinzo

        Neighborhood::create([
            'id' => 4867,
            'name' => 'Villa Quillinzo',
            'city_id' => 1833,
        ]);

        //Villa Rossi

        Neighborhood::create([
            'id' => 4868,
            'name' => 'Villa Rossi',
            'city_id' => 1834,
        ]);

        //Villa Rumipal

        Neighborhood::create([
            'id' => 4869,
            'name' => 'Villa Rumipal',
            'city_id' => 1835,
        ]);

        //Villa San Esteban

        Neighborhood::create([
            'id' => 4870,
            'name' => 'Villa San Esteban',
            'city_id' => 1836,
        ]);

        //Villa San Isidro

        Neighborhood::create([
            'id' => 4871,
            'name' => 'Villa San Isidro',
            'city_id' => 1837,
        ]);

        //Villa Santa Cruz del Lago

        Neighborhood::create([
            'id' => 4872,
            'name' => 'Villa Santa Cruz del Lago',
            'city_id' => 1838,
        ]);

        //Villa Sarmiento

        Neighborhood::create([
            'id' => 4873,
            'name' => 'Villa Sarmiento',
            'city_id' => 1839,
        ]);

        //Villa Tulumba

        Neighborhood::create([
            'id' => 4874,
            'name' => 'Villa Tulumba',
            'city_id' => 1840,
        ]);

        //Villa Valeria

        Neighborhood::create([
            'id' => 4875,
            'name' => 'Villa Valeria',
            'city_id' => 1841,
        ]);

        //Villa Yacanto

        Neighborhood::create([
            'id' => 4876,
            'name' => 'Villa Yacanto',
            'city_id' => 1842,
        ]);

        //Washington

        Neighborhood::create([
            'id' => 4877,
            'name' => 'Washington',
            'city_id' => 1843,
        ]);

        //Wenceslao Escalante

        Neighborhood::create([
            'id' => 4878,
            'name' => 'Wenceslao Escalante',
            'city_id' => 1844,
        ]);

        //Ámbul

        Neighborhood::create([
            'id' => 4879,
            'name' => 'Ámbul',
            'city_id' => 1845,
        ]);

        //Entre Rios

        Neighborhood::create([
            'id' => 4880,
            'name' => 'Gualeguaychú',
            'city_id' => 1846,
        ]);

        //Victoria

        Neighborhood::create([
            'id' => 4881,
            'name' => 'Victoria',
            'city_id' => 1847,
        ]);

        //Colón

        Neighborhood::create([
            'id' => 4882,
            'name' => 'Colón',
            'city_id' => 1848,
        ]);

        //Concordia

        Neighborhood::create([
            'id' => 4883,
            'name' => 'Concordia',
            'city_id' => 1849,
        ]);

        //Paraná

        Neighborhood::create([
            'id' => 4884,
            'name' => 'Paraná',
            'city_id' => 1850,
        ]);

        //Alarcón

        Neighborhood::create([
            'id' => 4885,
            'name' => 'Alarcón',
            'city_id' => 1851,
        ]);

        //Alcaraz Norte

        Neighborhood::create([
            'id' => 4886,
            'name' => 'Alcaraz Norte',
            'city_id' => 1852,
        ]);

        //Alcaraz Sur o Segundo

        Neighborhood::create([
            'id' => 4887,
            'name' => 'Alcaraz Sur o Segundo',
            'city_id' => 1853,
        ]);

        //Aldea Asunción

        Neighborhood::create([
            'id' => 4888,
            'name' => 'Aldea Asunción',
            'city_id' => 1854,
        ]);

        //Aldea Brasilera

        Neighborhood::create([
            'id' => 4889,
            'name' => 'Aldea Brasilera',
            'city_id' => 1855,
        ]);

        //Aldea Eigenfeld

        Neighborhood::create([
            'id' => 4890,
            'name' => 'Aldea Eigenfeld',
            'city_id' => 1856,
        ]);

        //Aldea Grapschental

        Neighborhood::create([
            'id' => 4891,
            'name' => 'Aldea Grapschental',
            'city_id' => 1857,
        ]);

        //Aldea María Luisa

        Neighborhood::create([
            'id' => 4892,
            'name' => 'Aldea María Luisa',
            'city_id' => 1858,
        ]);

        //Aldea Protestante

        Neighborhood::create([
            'id' => 4893,
            'name' => 'Aldea Protestante',
            'city_id' => 1859,
        ]);

        //Aldea Salto

        Neighborhood::create([
            'id' => 4894,
            'name' => 'Aldea Salto',
            'city_id' => 1860,
        ]);

        //Aldea San Antonio

        Neighborhood::create([
            'id' => 4895,
            'name' => 'Aldea San Antonio',
            'city_id' => 1861,
        ]);

        //Aldea San Francisco

        Neighborhood::create([
            'id' => 4896,
            'name' => 'Aldea San Franscisco',
            'city_id' => 1862,
        ]);

        //Aldea San Juan

        Neighborhood::create([
            'id' => 4897,
            'name' => 'Aldea San Juan',
            'city_id' => 1863,
        ]);

        //Aldea San Miguel

        Neighborhood::create([
            'id' => 4898,
            'name' => 'Aldea San Miguel',
            'city_id' => 1864,
        ]);

        //Aldea San Rafael

        Neighborhood::create([
            'id' => 4899,
            'name' => 'Aldea San Rafael',
            'city_id' => 1865,
        ]);

        //Aldea Santa María

        Neighborhood::create([
            'id' => 4900,
            'name' => 'Aldea Santa María',
            'city_id' => 1866,
        ]);

        //Aldea Santa Rosa

        Neighborhood::create([
            'id' => 4901,
            'name' => 'Aldea Santa Rosa',
            'city_id' => 1867,
        ]);

        //Aldea Spatzenkutter

        Neighborhood::create([
            'id' => 4902,
            'name' => 'Aldea Spatzenkutter',
            'city_id' => 1868,
        ]);

        //Aldea Valle María

        Neighborhood::create([
            'id' => 4903,
            'name' => 'Aldea Valle María',
            'city_id' => 1869,
        ]);



        //Antelo

        Neighborhood::create([
            'id' => 4904,
            'name' => 'Antelo',
            'city_id' => 1872,
        ]);

        //Antonio Tomás

        Neighborhood::create([
            'id' => 4905,
            'name' => 'Antonio Tomás',
            'city_id' => 1873,
        ]);

        //Aranguren

        Neighborhood::create([
            'id' => 4906,
            'name' => 'Aranguren',
            'city_id' => 1874,
        ]);

        //Arroyo Barú

        Neighborhood::create([
            'id' => 4907,
            'name' => 'Arroyo Barú',
            'city_id' => 1875,
        ]);

        //Arroyo Burgos

        Neighborhood::create([
            'id' => 4908,
            'name' => 'Arroyo Burgos',
            'city_id' => 1876,
        ]);

        //Arroyo Clé

        Neighborhood::create([
            'id' => 4909,
            'name' => 'Arroyo Clé',
            'city_id' => 1877,
        ]);

        //Arroyo Corralito

        Neighborhood::create([
            'id' => 4910,
            'name' => 'Aldea Corralito',
            'city_id' => 1878,
        ]);

        //Arroyo del Medio

        Neighborhood::create([
            'id' => 4911,
            'name' => 'Arroyo del Medio',
            'city_id' => 1879,
        ]);

        //Arroyo Gená

        Neighborhood::create([
            'id' => 4912,
            'name' => 'Arroyo Gená',
            'city_id' => 1880,
        ]);

        //Arroyo Martínez

        Neighborhood::create([
            'id' => 4913,
            'name' => 'Arroyo Martínez',
            'city_id' => 1881,
        ]);

        //Arroyo Maturango

        Neighborhood::create([
            'id' => 4914,
            'name' => 'Arroyo Maturango',
            'city_id' => 1882,
        ]);

        //Arroyo Palo Seco

        Neighborhood::create([
            'id' => 4915,
            'name' => 'Arroyo Palo Seco',
            'city_id' => 1883,
        ]);

        //Arroyo Tuna

        Neighborhood::create([
            'id' => 4916,
            'name' => 'Arroyo Tuna',
            'city_id' => 1884,
        ]);

        //Banderas

        Neighborhood::create([
            'id' => 4917,
            'name' => 'Banderas',
            'city_id' => 1885,
        ]);

        //Basavilbaso

        Neighborhood::create([
            'id' => 4918,
            'name' => 'Basavilbaso',
            'city_id' => 1886,
        ]);

        //Betbeder

        Neighborhood::create([
            'id' => 4919,
            'name' => 'Betbeder',
            'city_id' => 1887,
        ]);

        //Bovril

        Neighborhood::create([
            'id' => 4920,
            'name' => 'Bovril',
            'city_id' => 1888,
        ]);

        //Brazo Largo

        Neighborhood::create([
            'id' => 4921,
            'name' => 'Brazo Largo',
            'city_id' => 1889,
        ]);

        //Caseros

        Neighborhood::create([
            'id' => 4922,
            'name' => 'Caseros',
            'city_id' => 1900,
        ]);

        //Ceibas

        Neighborhood::create([
            'id' => 4923,
            'name' => 'Ceibas',
            'city_id' => 1901,
        ]);

        //Cerrito

        Neighborhood::create([
            'id' => 4924,
            'name' => 'Cerrito',
            'city_id' => 1902,
        ]);

        //Chajarí

        Neighborhood::create([
            'id' => 4925,
            'name' => 'Chajarí',
            'city_id' => 1903,
        ]);

        //Chilcas

        Neighborhood::create([
            'id' => 4926,
            'name' => 'Chilcas',
            'city_id' => 1904,
        ]);

        //Clodomiro Ledesma

        Neighborhood::create([
            'id' => 4927,
            'name' => 'Clodomiro Ledesma',
            'city_id' => 1905,
        ]);

        //Colonia Alemana

        Neighborhood::create([
            'id' => 4928,
            'name' => 'Colonia Alemana',
            'city_id' => 1906,
        ]);

        //Colonia Avellaneda

        Neighborhood::create([
            'id' => 4929,
            'name' => 'Colonia Avellaneda',
            'city_id' => 1907,
        ]);

        //Colonia Avigdor

        Neighborhood::create([
            'id' => 4930,
            'name' => 'Colonia Avigdor',
            'city_id' => 1908,
        ]);

        //Colonia Ayuí

        Neighborhood::create([
            'id' => 4931,
            'name' => 'Colonia Ayuí',
            'city_id' => 1909,
        ]);

        //Colonia Baylina

        Neighborhood::create([
            'id' => 4932,
            'name' => 'Colonia Baylina',
            'city_id' => 1910,
        ]);

        //Colonia Carrasco

        Neighborhood::create([
            'id' => 4933,
            'name' => 'Colonia Carrasco',
            'city_id' => 1911,
        ]);

        //Colonia Celina

        Neighborhood::create([
            'id' => 4934,
            'name' => 'Colonia Celina',
            'city_id' => 1912,
        ]);

        //Colonia Cerrito

        Neighborhood::create([
            'id' => 4935,
            'name' => 'Colonia Cerrito',
            'city_id' => 1913,
        ]);

        //Colonia Crespo

        Neighborhood::create([
            'id' => 4936,
            'name' => 'Colonia Crespo',
            'city_id' => 1914,
        ]);

        //Colonia Elía

        Neighborhood::create([
            'id' => 4937,
            'name' => 'Colonia Elía',
            'city_id' => 1915,
        ]);

        //Colonia Ensayo

        Neighborhood::create([
            'id' => 4938,
            'name' => 'Colonia Ensayo',
            'city_id' => 1916,
        ]);

        //Colonia General Roca

        Neighborhood::create([
            'id' => 4939,
            'name' => 'Colonia General Roca',
            'city_id' => 1917,
        ]);

        //Colonia Hocker

        Neighborhood::create([
            'id' => 4940,
            'name' => 'Colonia Hocker',
            'city_id' => 1918,
        ]);

        //Colonia La Argentina

        Neighborhood::create([
            'id' => 4941,
            'name' => 'Colonia La Argentina',
            'city_id' => 1919,
        ]);

        //Colonia Merou

        Neighborhood::create([
            'id' => 4942,
            'name' => 'Colonia Merou',
            'city_id' => 1920,
        ]);

        //Colonia Oficial 13

        Neighborhood::create([
            'id' => 4943,
            'name' => 'Colonia Oficial ',
            'city_id' => 1921,
        ]);

        //Colonia Oficial 14 La Ceiba

        Neighborhood::create([
            'id' => 4944,
            'name' => 'Colonia Oficial 14 La Ceiba',
            'city_id' => 1922,
        ]);


        //Colonia Oficial 3 Gral Urdinarrain

        Neighborhood::create([
            'id' => 4945,
            'name' => 'Colonia Oficial 3 Gral Urdinarrain',
            'city_id' => 1923,
        ]);

        //Colonia Oficial 5

        Neighborhood::create([
            'id' => 4946,
            'name' => 'Colonia Oficial 5',
            'city_id' => 1924,
        ]);

        //Colonia Reffino

        Neighborhood::create([
            'id' => 4947,
            'name' => 'Colonia Reffino',
            'city_id' => 1925,
        ]);

        //Colonia San Anselmo y Aledañas

        Neighborhood::create([
            'id' => 4948,
            'name' => 'Colonia San Anselmo y Aledañas',
            'city_id' => 1926,
        ]);

        //Colonia Tunas

        Neighborhood::create([
            'id' => 4949,
            'name' => 'Colonia Tunas',
            'city_id' => 1927,
        ]);

        //Colonia Viraró

        Neighborhood::create([
            'id' => 4950,
            'name' => 'Colonia Viraró',
            'city_id' => 1928,
        ]);

        //Colonias Santa María

        Neighborhood::create([
            'id' => 4951,
            'name' => 'Colonia Santa María',
            'city_id' => 1929,
        ]);

        //Concepción del Uruguay

        Neighborhood::create([
            'id' => 4952,
            'name' => 'Concepción del Uruguay',
            'city_id' => 1930,
        ]);

        //Conscripto Bernardi

        Neighborhood::create([
            'id' => 4953,
            'name' => 'Conscripto Bernardi',
            'city_id' => 1931,
        ]);

        //Costa Grande

        Neighborhood::create([
            'id' => 4954,
            'name' => 'Costa Grande',
            'city_id' => 1932,
        ]);

        //Costa San Antonio

        Neighborhood::create([
            'id' => 4955,
            'name' => 'Costa San Antonio',
            'city_id' => 1933,
        ]);

        //Costa Uruguay Norte

        Neighborhood::create([
            'id' => 4956,
            'name' => 'Costa Uruguay Norte',
            'city_id' => 1934,
        ]);

        //Crespo

        Neighborhood::create([
            'id' => 4957,
            'name' => 'Crespo',
            'city_id' => 1935,
        ]);

        //Crucesitas Octava

        Neighborhood::create([
            'id' => 4958,
            'name' => 'Crucesitas Octava',
            'city_id' => 1936,
        ]);

        //Crusecitas Séptima

        Neighborhood::create([
            'id' => 4959,
            'name' => 'Crusecitas Séptima',
            'city_id' => 1937,
        ]);

        //Crusecitas Tercera

        Neighborhood::create([
            'id' => 4960,
            'name' => 'Crusecitas Tercera',
            'city_id' => 1938,
        ]);

        //Cuchilla Redonda

        Neighborhood::create([
            'id' => 4961,
            'name' => 'Cuchilla Redonda',
            'city_id' => 1939,
        ]);

        //Curtiembre

        Neighborhood::create([
            'id' => 4962,
            'name' => 'Curtiembre',
            'city_id' => 1940,
        ]);

        //Diamante

        Neighborhood::create([
            'id' => 4963,
            'name' => 'Diamante',
            'city_id' => 1941,
        ]);

        //Distrito Chiqueros

        Neighborhood::create([
            'id' => 4964,
            'name' => 'Distrito Chiqueros',
            'city_id' => 1942,
        ]);

        //Distrito Cuarto

        Neighborhood::create([
            'id' => 4965,
            'name' => 'Distrito Cuarto',
            'city_id' => 1943,
        ]);

        //Distrito Diego López

        Neighborhood::create([
            'id' => 4966,
            'name' => 'Distrito Diego López',
            'city_id' => 1944,
        ]);

        //Distrito Pajonal

        Neighborhood::create([
            'id' => 4967,
            'name' => 'Distrito Pajonal',
            'city_id' => 1945,
        ]);

        //Distrito Sauce

        Neighborhood::create([
            'id' => 4968,
            'name' => 'Distrito Sauce',
            'city_id' => 1946,
        ]);

        //Distrito Sexto Costa de Nogoyá

        Neighborhood::create([
            'id' => 4969,
            'name' => 'Distrito Sexto Costa de Nogoyá',
            'city_id' => 1947,
        ]);

        //Distrito Tala

        Neighborhood::create([
            'id' => 4970,
            'name' => 'Distrito Tala',
            'city_id' => 1948,
        ]);

        //Distrito Talitas

        Neighborhood::create([
            'id' => 4971,
            'name' => 'Distrito Talitas',
            'city_id' => 1949,
        ]);

        //Don Cristóbal Primero

        Neighborhood::create([
            'id' => 4972,
            'name' => 'Don Cristóbal Primero',
            'city_id' => 1950,
        ]);

        //Don Cristobal Segunda

        Neighborhood::create([
            'id' => 4973,
            'name' => 'Don Cristobal Segundo',
            'city_id' => 1951,
        ]);

        //Durazno

        Neighborhood::create([
            'id' => 4974,
            'name' => 'Durazno',
            'city_id' => 1952,
        ]);

        //El Cimarron

        Neighborhood::create([
            'id' => 4975,
            'name' => 'El Cimarron',
            'city_id' => 1953,
        ]);

        //El Gato - Loma Limpia

        Neighborhood::create([
            'id' => 4976,
            'name' => 'El Gato - Loma Limpia',
            'city_id' => 1954,
        ]);

        //El Gramiyal

        Neighborhood::create([
            'id' => 4977,
            'name' => 'El Gramiyal',
            'city_id' => 1955,
        ]);

        //El Palenque

        Neighborhood::create([
            'id' => 4978,
            'name' => 'El Palenque',
            'city_id' => 1956,
        ]);

        //El Pingo

        Neighborhood::create([
            'id' => 4979,
            'name' => 'El Pingo',
            'city_id' => 1957,
        ]);

        //El Quebracho

        Neighborhood::create([
            'id' => 4980,
            'name' => 'El Quebracho',
            'city_id' => 1958,
        ]);

        //El Redomon

        Neighborhood::create([
            'id' => 4981,
            'name' => 'El Redomon',
            'city_id' => 1959,
        ]);

        //El Solar

        Neighborhood::create([
            'id' => 4982,
            'name' => 'El Solar',
            'city_id' => 1960,
        ]);

        //Enrique Carbó

        Neighborhood::create([
            'id' => 4983,
            'name' => 'Enrique Carbó',
            'city_id' => 1961,
        ]);

        //Espinillo Norte

        Neighborhood::create([
            'id' => 4984,
            'name' => 'Espinillo Norte',
            'city_id' => 1962,
        ]);

        //Estación Camps

        Neighborhood::create([
            'id' => 4985,
            'name' => 'Estación Camps',
            'city_id' => 1963,
        ]);

        //Estación Escriña

        Neighborhood::create([
            'id' => 4986,
            'name' => 'Estación Escriña',
            'city_id' => 1964,
        ]);

        //Estación Lazo

        Neighborhood::create([
            'id' => 4987,
            'name' => 'Estación Lazo',
            'city_id' => 1965,
        ]);

        //Estación Líbaros

        Neighborhood::create([
            'id' => 4988,
            'name' => 'Estación Líbaros',
            'city_id' => 1966,
        ]);

        //Estación Racedo (El Carmen)

        Neighborhood::create([
            'id' => 4989,
            'name' => 'Estacíon Racedo (El Carmen)',
            'city_id' => 1967,
        ]);

        //Estación Raíces

        Neighborhood::create([
            'id' => 4990,
            'name' => 'Estación Raíces',
            'city_id' => 1968,
        ]);

        //Estación Solá

        Neighborhood::create([
            'id' => 4991,
            'name' => 'Estación Solá',
            'city_id' => 1969,
        ]);

        //Estación Yerúa

        Neighborhood::create([
            'id' => 4992,
            'name' => 'Estacíon Yerúa',
            'city_id' => 1970,
        ]);

        //Estación Yuquerí

        Neighborhood::create([
            'id' => 4993,
            'name' => 'Estación Yuquerí',
            'city_id' => 1971,
        ]);

        //Estación Grande

        Neighborhood::create([
            'id' => 4994,
            'name' => 'Estación Grande',
            'city_id' => 1972,
        ]);

        //Estaquitas

        Neighborhood::create([
            'id' => 4995,
            'name' => 'Estaquitas',
            'city_id' => 1973,
        ]);

        //Faustino M Parera

        Neighborhood::create([
            'id' => 4996,
            'name' => 'Faustino M Parera',
            'city_id' => 1974,
        ]);

        //Febre

        Neighborhood::create([
            'id' => 4997,
            'name' => 'Febre',
            'city_id' => 1975,
        ]);

        //Federación

        Neighborhood::create([
            'id' => 4998,
            'name' => 'Federación',
            'city_id' => 1976,
        ]);

        //Federal

        Neighborhood::create([
            'id' => 4999,
            'name' => 'Federal',
            'city_id' => 1977,
        ]);

        //General Almada

        Neighborhood::create([
            'id' => 5000,
            'name' => 'General Almada',
            'city_id' => 1978,
        ]);

        //General Alvear

        Neighborhood::create([
            'id' => 5001,
            'name' => 'General Alvear',
            'city_id' => 1979,
        ]);

        //General Campos

        Neighborhood::create([
            'id' => 5002,
            'name' => 'General Campos',
            'city_id' => 1980,
        ]);

        //General Galarza

        Neighborhood::create([
            'id' => 5003,
            'name' => 'General Galarza',
            'city_id' => 1981,
        ]);

        //General Ramírez

        Neighborhood::create([
            'id' => 5004,
            'name' => 'General Ramírez',
            'city_id' => 1982,
        ]);

        //Gilbert

        Neighborhood::create([
            'id' => 5005,
            'name' => 'Gilbert',
            'city_id' => 1983,
        ]);

        //Gobernador Echagüe

        Neighborhood::create([
            'id' => 5006,
            'name' => 'Gobernador Echagüe',
            'city_id' => 1984,
        ]);

        //Gobernador Mansilla

        Neighborhood::create([
            'id' => 5007,
            'name' => 'Gobernador Mansilla',
            'city_id' => 1985,
        ]);

        //González Calderón

        Neighborhood::create([
            'id' => 5008,
            'name' => 'González Calderón',
            'city_id' => 1986,
        ]);

        //Gualeguay

        Neighborhood::create([
            'id' => 5009,
            'name' => 'Gualeguay',
            'city_id' => 1987,
        ]);

        //Gualeguaycito

        Neighborhood::create([
            'id' => 5010,
            'name' => 'Gualeguaycito',
            'city_id' => 1988,
        ]);

        //Guardamonte

        Neighborhood::create([
            'id' => 5011,
            'name' => 'Guardamonte',
            'city_id' => 1989,
        ]);

        //Hambis

        Neighborhood::create([
            'id' => 5012,
            'name' => 'Hambis',
            'city_id' => 1990,
        ]);

        //Hasenkamp

        Neighborhood::create([
            'id' => 5013,
            'name' => 'Hasenkamp',
            'city_id' => 1991,
        ]);

        //Hernandarias

        Neighborhood::create([
            'id' => 5014,
            'name' => 'Hernandarias',
            'city_id' => 1992,
        ]);

        //Hernández

        Neighborhood::create([
            'id' => 5015,
            'name' => 'Hernández',
            'city_id' => 1993,
        ]);

        //Herrera

        Neighborhood::create([
            'id' => 5016,
            'name' => 'Herrera',
            'city_id' => 1994,
        ]);

        //Hinojal

        Neighborhood::create([
            'id' => 5017,
            'name' => 'Hinojal',
            'city_id' => 1995,
        ]);

        //Ingeniero Sajaroff

        Neighborhood::create([
            'id' => 5018,
            'name' => 'Ingeniero Sajaroff',
            'city_id' => 1996,
        ]);

        //Irazusta

        Neighborhood::create([
            'id' => 5019,
            'name' => 'Irazusta',
            'city_id' => 1997,
        ]);

        //Islas Las Lechiguanas

        Neighborhood::create([
            'id' => 5020,
            'name' => 'Islas Las Lechiguanas',
            'city_id' => 1998,
        ]);

        //Isletas

        Neighborhood::create([
            'id' => 5021,
            'name' => 'Isletas',
            'city_id' => 1999,
        ]);

        //Jubileo

        Neighborhood::create([
            'id' => 5022,
            'name' => 'Jubileo',
            'city_id' => 2000,
        ]);

        //Justo José de Urquiza

        Neighborhood::create([
            'id' => 5023,
            'name' => 'Justo José de Urquiza',
            'city_id' => 2001,
        ]);

        //La Clarita

        Neighborhood::create([
            'id' => 5024,
            'name' => 'La Clarita',
            'city_id' => 2002,
        ]);

        //La Criolla

        Neighborhood::create([
            'id' => 5025,
            'name' => 'La Criolla',
            'city_id' => 2003,
        ]);

        //La Esmeralda

        Neighborhood::create([
            'id' => 5026,
            'name' => 'La Esmeralda',
            'city_id' => 2004,
        ]);

        //La Florida

        Neighborhood::create([
            'id' => 5027,
            'name' => 'La Florida',
            'city_id' => 2005,
        ]);

        //La Fraternidad y Santa Juana

        Neighborhood::create([
            'id' => 5028,
            'name' => 'La Fraternidad y Santa Juana',
            'city_id' => 2006,
        ]);

        //La Hierra

        Neighborhood::create([
            'id' => 5029,
            'name' => 'La Hierra',
            'city_id' => 2007,
        ]);

        //La Ollita

        Neighborhood::create([
            'id' => 5030,
            'name' => 'La Ollita',
            'city_id' => 2008,
        ]);

        //La Paz

        Neighborhood::create([
            'id' => 5031,
            'name' => 'La Paz',
            'city_id' => 2009,
        ]);

        //La Picada

        Neighborhood::create([
            'id' => 5032,
            'name' => 'La Picada',
            'city_id' => 2010,
        ]);

        //La Providencia

        Neighborhood::create([
            'id' => 5033,
            'name' => 'La Providencia',
            'city_id' => 2011,
        ]);

        //La Verbena

        Neighborhood::create([
            'id' => 5034,
            'name' => 'La Verbena',
            'city_id' => 2012,
        ]);

        //Laguna Benítez

        Neighborhood::create([
            'id' => 5035,
            'name' => 'Laguna Benítez',
            'city_id' => 2013,
        ]);

        //Laguna del Pescado

        Neighborhood::create([
            'id' => 5036,
            'name' => 'Laguna del Pescado',
            'city_id' => 2014,
        ]);

        //Larroque

        Neighborhood::create([
            'id' => 5037,
            'name' => 'Larroque',
            'city_id' => 2015,
        ]);

        //Las Cuevas

        Neighborhood::create([
            'id' => 5038,
            'name' => 'Las Cuevas',
            'city_id' => 2016,
        ]);

        //Las Garzas

        Neighborhood::create([
            'id' => 5039,
            'name' => 'Las Garzas',
            'city_id' => 2017,
        ]);

        //Las Guachas

        Neighborhood::create([
            'id' => 5040,
            'name' => 'Las Guachas',
            'city_id' => 2018,
        ]);

        //Las Mercedes

        Neighborhood::create([
            'id' => 5041,
            'name' => 'Las Mercedes',
            'city_id' => 2019,
        ]);

        //Las Moscas

        Neighborhood::create([
            'id' => 5042,
            'name' => 'Las Moscas',
            'city_id' => 2020,
        ]);

        //Las Mulitas

        Neighborhood::create([
            'id' => 5043,
            'name' => 'Las Mulitas',
            'city_id' => 2021,
        ]);

        //Las Toscas

        Neighborhood::create([
            'id' => 5044,
            'name' => 'Las Toscas',
            'city_id' => 2022,
        ]);

        //Laurencena

        Neighborhood::create([
            'id' => 5045,
            'name' => 'Laurencena',
            'city_id' => 2023,
        ]);

        //Libertador San Martín

        Neighborhood::create([
            'id' => 5046,
            'name' => 'Libertador San Martín',
            'city_id' => 2024,
        ]);

        //Los Ceibos

        Neighborhood::create([
            'id' => 5047,
            'name' => 'Los Ceibos',
            'city_id' => 2025,
        ]);

        //Los Charruas

        Neighborhood::create([
            'id' => 5048,
            'name' => 'Los Charrúas',
            'city_id' => 2026,
        ]);

        //Los Conquistadores

        Neighborhood::create([
            'id' => 5049,
            'name' => 'Los Conquistadores',
            'city_id' => 2027,
        ]);

        //Lucas González

        Neighborhood::create([
            'id' => 5050,
            'name' => 'Lucas González',
            'city_id' => 2028,
        ]);

        //Lucas Norte

        Neighborhood::create([
            'id' => 5051,
            'name' => 'Lucas Norte',
            'city_id' => 2029,
        ]);

        //Lucas Sur Primera

        Neighborhood::create([
            'id' => 5052,
            'name' => 'Lucas Sur Primera',
            'city_id' => 2030,
        ]);

        //Lucas Sur Segundo

        Neighborhood::create([
            'id' => 5053,
            'name' => 'Lucas Sur Segundo',
            'city_id' => 2031,
        ]);

        //Maciá

        Neighborhood::create([
            'id' => 5054,
            'name' => 'Maciá',
            'city_id' => 2032,
        ]);

        //María Grande

        Neighborhood::create([
            'id' => 5055,
            'name' => 'María Grande',
            'city_id' => 2033,
        ]);

        //Maria Grande Segunda

        Neighborhood::create([
            'id' => 5056,
            'name' => 'María Grande Segunda',
            'city_id' => 2034,
        ]);

        //Mojones Norte

        Neighborhood::create([
            'id' => 5057,
            'name' => 'Mojones Norte',
            'city_id' => 2035,
        ]);

        //Mojones Sur

        Neighborhood::create([
            'id' => 5058,
            'name' => 'Mojones Sur',
            'city_id' => 2036,
        ]);

        //Molino Doll

        Neighborhood::create([
            'id' => 5059,
            'name' => 'Molino Doll',
            'city_id' => 2037,
        ]);

        //Monte Redondo

        Neighborhood::create([
            'id' => 5060,
            'name' => 'Monte Redondo',
            'city_id' => 2038,
        ]);

        //Montoya

        Neighborhood::create([
            'id' => 5061,
            'name' => 'Montoya',
            'city_id' => 2039,
        ]);

        //Mulas Grandes

        Neighborhood::create([
            'id' => 5062,
            'name' => 'Mulas Grandes',
            'city_id' => 2040,
        ]);

        //Médanos

        Neighborhood::create([
            'id' => 5063,
            'name' => 'Médanos',
            'city_id' => 2041,
        ]);

        //Nogoyá

        Neighborhood::create([
            'id' => 5064,
            'name' => 'Nogoyá',
            'city_id' => 2042,
        ]);

        //Nueva Escocia

        Neighborhood::create([
            'id' => 5065,
            'name' => 'Nueva Escocia',
            'city_id' => 2043,
        ]);

        //Nueva Vizcaya

        Neighborhood::create([
            'id' => 5066,
            'name' => 'Nueva Vizcaya',
            'city_id' => 2044,
        ]);

        //Oro Verde

        Neighborhood::create([
            'id' => 5067,
            'name' => 'Oro Verde',
            'city_id' => 2045,
        ]);

        //Osvaldo Magnasco

        Neighborhood::create([
            'id' => 5068,
            'name' => 'Osvaldo Magnasco',
            'city_id' => 2046,
        ]);


        //Paraje Guayaquil

        Neighborhood::create([
            'id' => 5070,
            'name' => 'Paraje Guayaquil',
            'city_id' => 2048,
        ]);

        //Paraje las Tunas

        Neighborhood::create([
            'id' => 5071,
            'name' => 'Paraje Las Tunas',
            'city_id' => 2049,
        ]);

        //Paraje los Algarrobos

        Neighborhood::create([
            'id' => 5072,
            'name' => 'Paraje Los Algarrobos',
            'city_id' => 2050,
        ]);

        //Paso de La Arena

        Neighborhood::create([
            'id' => 5073,
            'name' => 'Paso de La Arena',
            'city_id' => 2051,
        ]);

        //Paso de la Laguna

        Neighborhood::create([
            'id' => 5074,
            'name' => 'Paso de la Laguna',
            'city_id' => 2052,
        ]);

        //Paso de Las Piedras

        Neighborhood::create([
            'id' => 5075,
            'name' => 'Paso de las Piedras',
            'city_id' => 2053,
        ]);

        //Paso Duarte

        Neighborhood::create([
            'id' => 5076,
            'name' => 'Paso Duarte',
            'city_id' => 2054,
        ]);

        //Picada Berón

        Neighborhood::create([
            'id' => 5077,
            'name' => 'Picada Berón',
            'city_id' => 2058,
        ]);

        //Pidras Blancas

        Neighborhood::create([
            'id' => 5078,
            'name' => 'Pidras Blancas',
            'city_id' => 2059,
        ]);

        //Primer Destino Cuchillas

        Neighborhood::create([
            'id' => 5079,
            'name' => 'Primer Destino Cuchillas',
            'city_id' => 2060,
        ]);

        //Pronunciamiento

        Neighborhood::create([
            'id' => 5080,
            'name' => 'Pronunciamiento',
            'city_id' => 2061,
        ]);

        //Pueblo Bellocq

        Neighborhood::create([
            'id' => 5081,
            'name' => 'Pueblo Bellocq',
            'city_id' => 2062,
        ]);

        //Pueblo Brugo

        Neighborhood::create([
            'id' => 5082,
            'name' => 'Pueblo Brugo',
            'city_id' => 2063,
        ]);

        //Pueblo Cazes

        Neighborhood::create([
            'id' => 5083,
            'name' => 'Pueblo Cazes',
            'city_id' => 2064,
        ]);

        //Pueblo General

        Neighborhood::create([
            'id' => 5084,
            'name' => 'Pueblo General',
            'city_id' => 2065,
        ]);

        //Pueblo Liebig

        Neighborhood::create([
            'id' => 5085,
            'name' => 'Pueblo Liebig',
            'city_id' => 2066,
        ]);

        //Puerto Algarrobo

        Neighborhood::create([
            'id' => 5086,
            'name' => 'Puerto Algarrobo',
            'city_id' => 2067,
        ]);

        //Puerto Ibicuy

        Neighborhood::create([
            'id' => 5087,
            'name' => 'Puerto Ibicuy',
            'city_id' => 2068,
        ]);

        //Puerto Ibicuy

        Neighborhood::create([
            'id' => 5088,
            'name' => 'Puerto Ibicuy',
            'city_id' => 2069,
        ]);

        //Puerto Yeruá

        Neighborhood::create([
            'id' => 5089,
            'name' => 'Puerto Yeruá',
            'city_id' => 2070,
        ]);

        //Punta del Momento

        Neighborhood::create([
            'id' => 5090,
            'name' => 'Punta del Monte',
            'city_id' => 2071,
        ]);

        //Quebracho

        Neighborhood::create([
            'id' => 5091,
            'name' => 'Quebracho',
            'city_id' => 2072,
        ]);

        //Quinto Distrito

        Neighborhood::create([
            'id' => 5092,
            'name' => 'Quinto Distrito',
            'city_id' => 2073,
        ]);

        //Raíces Oeste

        Neighborhood::create([
            'id' => 5093,
            'name' => 'Raíces Oeste',
            'city_id' => 2074,
        ]);

        //Rincón de Nogoyá

        Neighborhood::create([
            'id' => 5094,
            'name' => 'Rincón de Nogoyá',
            'city_id' => 2075,
        ]);

        //Rincón del Cinto

        Neighborhood::create([
            'id' => 5095,
            'name' => 'Rincón del Cinto',
            'city_id' => 2076,
        ]);

        //Rincón del Doll

        Neighborhood::create([
            'id' => 5096,
            'name' => 'Rincón del Doll',
            'city_id' => 2077,
        ]);

        //Rincón del Gato

        Neighborhood::create([
            'id' => 5097,
            'name' => 'Rincón del Gato',
            'city_id' => 2078,
        ]);

        //Rocamora

        Neighborhood::create([
            'id' => 5098,
            'name' => 'Rocamora',
            'city_id' => 2079,
        ]);

        //Rosario del Tala

        Neighborhood::create([
            'id' => 5099,
            'name' => 'Rosario del Tala',
            'city_id' => 2080,
        ]);

        //San Benito

        Neighborhood::create([
            'id' => 5100,
            'name' => 'San Benito',
            'city_id' => 2081,
        ]);

        //San Cipriano

        Neighborhood::create([
            'id' => 5101,
            'name' => 'San Cipriano',
            'city_id' => 2082,
        ]);

        //San Ernesto

        Neighborhood::create([
            'id' => 5102,
            'name' => 'San Ernesto',
            'city_id' => 2083,
        ]);

        //San Gustavo

        Neighborhood::create([
            'id' => 5103,
            'name' => 'San Gustavo',
            'city_id' => 2084,
        ]);

        //San Jaime de la Frontera

        Neighborhood::create([
            'id' => 5104,
            'name' => 'San Jaime de la Frontera',
            'city_id' => 2085,
        ]);

        //San José

        Neighborhood::create([
            'id' => 5105,
            'name' => 'San José',
            'city_id' => 2086,
        ]);

        //San José Feliciano

        Neighborhood::create([
            'id' => 5106,
            'name' => 'San José Feliciano',
            'city_id' => 2087,
        ]);

        //San Justo

        Neighborhood::create([
            'id' => 5107,
            'name' => 'San Justo',
            'city_id' => 2088,
        ]);

        //San Marcial

        Neighborhood::create([
            'id' => 5108,
            'name' => 'San Marcial',
            'city_id' => 2089,
        ]);

        //San Pedro

        Neighborhood::create([
            'id' => 5109,
            'name' => 'San Pedro',
            'city_id' => 2090,
        ]);

        //San Ramírez

        Neighborhood::create([
            'id' => 5110,
            'name' => 'San Ramírez',
            'city_id' => 2091,
        ]);

        //San Ramón

        Neighborhood::create([
            'id' => 5111,
            'name' => 'San Ramón',
            'city_id' => 2092,
        ]);

        //San Roque

        Neighborhood::create([
            'id' => 5112,
            'name' => 'San Roque',
            'city_id' => 2093,
        ]);

        //San Salvador

        Neighborhood::create([
            'id' => 5113,
            'name' => 'San Salvador',
            'city_id' => 2094,
        ]);

        //San Victor

        Neighborhood::create([
            'id' => 5114,
            'name' => 'San Victor',
            'city_id' => 2095,
        ]);

        //Santa Ana

        Neighborhood::create([
            'id' => 5115,
            'name' => 'Santa Ana',
            'city_id' => 2096,
        ]);

        //Santa Anita

        Neighborhood::create([
            'id' => 5116,
            'name' => 'Santa Anita',
            'city_id' => 2097,
        ]);

        //Santa Elena

        Neighborhood::create([
            'id' => 5117,
            'name' => 'Santa Elena',
            'city_id' => 2098,
        ]);

        //Santa Lucía

        Neighborhood::create([
            'id' => 5118,
            'name' => 'Santa Lucía',
            'city_id' => 2099,
        ]);

        //Santa Luisa

        Neighborhood::create([
            'id' => 5119,
            'name' => 'Santa Luisa',
            'city_id' => 2100,
        ]);

        //Sauce de Luna

        Neighborhood::create([
            'id' => 5120,
            'name' => 'Sauce de Luna',
            'city_id' => 2101,
        ]);


        //Sauce Pintos

        Neighborhood::create([
            'id' => 5121,
            'name' => 'Sauce Pintos',
            'city_id' => 2103,
        ]);

        //Sauce Sur

        Neighborhood::create([
            'id' => 5122,
            'name' => 'Sauce Sur',
            'city_id' => 2104,
        ]);

        //Saucesito

        Neighborhood::create([
            'id' => 5123,
            'name' => 'Saucesito',
            'city_id' => 2105,
        ]);

        //Seguí

        Neighborhood::create([
            'id' => 5124,
            'name' => 'Seguí',
            'city_id' => 2106,
        ]);

        //Sir Leonard

        Neighborhood::create([
            'id' => 5125,
            'name' => 'Sir Leonard',
            'city_id' => 2107,
        ]);

        //Sosa

        Neighborhood::create([
            'id' => 5126,
            'name' => 'Sosa',
            'city_id' => 2108,
        ]);

        //Tabossi

        Neighborhood::create([
            'id' => 5127,
            'name' => 'Tabossi',
            'city_id' => 2109,
        ]);

        //Tacuaras - Ombu

        Neighborhood::create([
            'id' => 5128,
            'name' => 'Tacuaras - Obu',
            'city_id' => 2110,
        ]);

        //Tacuaras - Yacare

        Neighborhood::create([
            'id' => 5129,
            'name' => 'Tacuaras - Yacare',
            'city_id' => 2111,
        ]);

        //Tezanos Pintos

        Neighborhood::create([
            'id' => 5130,
            'name' => 'Tezanos Pintos',
            'city_id' => 2112,
        ]);

        //Ubajay

        Neighborhood::create([
            'id' => 5131,
            'name' => 'Ubajay',
            'city_id' => 2113,
        ]);

        //Urdinarrain

        Neighborhood::create([
            'id' => 5132,
            'name' => 'Urdinarrain',
            'city_id' => 2114,
        ]);

        //Veinte de Septiembre

        Neighborhood::create([
            'id' => 5133,
            'name' => 'Veinte de Septiembre',
            'city_id' => 2115,
        ]);

        //Viale

        Neighborhood::create([
            'id' => 5134,
            'name' => 'Viale',
            'city_id' => 2116,
        ]);

        //Villa Clara

        Neighborhood::create([
            'id' => 5135,
            'name' => 'Villa Clara',
            'city_id' => 2117,
        ]);

        //Villa del Rosario

        Neighborhood::create([
            'id' => 5136,
            'name' => 'Villa del Rosario',
            'city_id' => 2118,
        ]);

        //Villa Dominguez

        Neighborhood::create([
            'id' => 5137,
            'name' => 'Villa Dominguez',
            'city_id' => 2119,
        ]);

        //Villa elisa

        Neighborhood::create([
            'id' => 5138,
            'name' => 'Villa Elisa',
            'city_id' => 2120,
        ]);

        //Villa Fontana

        Neighborhood::create([
            'id' => 5139,
            'name' => 'Villa Fontana',
            'city_id' => 2121,
        ]);

        //Villa Gobernador Etchevere

        Neighborhood::create([
            'id' => 5140,
            'name' => 'Villa Gobernador Etchevere',
            'city_id' => 2122,
        ]);

        //Villa Mantero

        Neighborhood::create([
            'id' => 5141,
            'name' => 'Villa Mantero',
            'city_id' => 2123,
        ]);

        //Villa Paranacito

        Neighborhood::create([
            'id' => 5142,
            'name' => 'Villa Paranacito',
            'city_id' => 2124,
        ]);

        //Villa Urquiza

        Neighborhood::create([
            'id' => 5143,
            'name' => 'Villa Urquiza',
            'city_id' => 2125,
        ]);

        //Villa Zorraquín

        Neighborhood::create([
            'id' => 5144,
            'name' => 'Villa Zorraquín',
            'city_id' => 2126,
        ]);

        //Villaguay

        Neighborhood::create([
            'id' => 5145,
            'name' => 'Villaguay',
            'city_id' => 2127,
        ]);

        //Pedernal

        Neighborhood::create([
            'id' => 5146,
            'name' => 'Pedernal',
            'city_id' => 2128,
        ]);

        //Waltermoss

        Neighborhood::create([
            'id' => 5147,
            'name' => 'Walter Moss',
            'city_id' => 2129,
        ]);

        //Yeso Oeste

        Neighborhood::create([
            'id' => 5148,
            'name' => 'Yeso Oeste',
            'city_id' => 2130,
        ]);

        //Ñancay

        Neighborhood::create([
            'id' => 5149,
            'name' => 'Ñancay',
            'city_id' => 2131,
        ]);

        //Formosa

        Neighborhood::create([
            'id' => 5150,
            'name' => 'Formosa',
            'city_id' => 2132,
        ]);

        //Pirané

        Neighborhood::create([
            'id' => 5151,
            'name' => 'Pirané',
            'city_id' => 2133,
        ]);

        //Las Lomitas

        Neighborhood::create([
            'id' => 5152,
            'name' => 'Las Lomitas',
            'city_id' => 2134,
        ]);

        //General Manuel Belgrano

        Neighborhood::create([
            'id' => 5153,
            'name' => 'General Manuel Belgrano',
            'city_id' => 2135,
        ]);

        //Ingeniero Juárez

        Neighborhood::create([
            'id' => 5154,
            'name' => 'Ingeniero Juárez',
            'city_id' => 2136,
        ]);

        //Banco Payaguá

        Neighborhood::create([
            'id' => 5155,
            'name' => 'Banco Payaguá',
            'city_id' => 2137,
        ]);

        //Bartolomé de las Casas

        Neighborhood::create([
            'id' => 5156,
            'name' => 'Bartolomé de las Casas',
            'city_id' => 2138,
        ]);

        //Buena Vista

        Neighborhood::create([
            'id' => 5157,
            'name' => 'Buena Vista',
            'city_id' => 2139,
        ]);

        //Clorinda

        Neighborhood::create([
            'id' => 5158,
            'name' => 'Clorinda',
            'city_id' => 2140,
        ]);

        //Colonia Pastoril

        Neighborhood::create([
            'id' => 5159,
            'name' => 'Colonia Pastoril',
            'city_id' => 2141,
        ]);

        //Colonia Sarmiento

        Neighborhood::create([
            'id' => 5160,
            'name' => 'Colonia Sarmiento',
            'city_id' => 2142,
        ]);

        //Comandante Fontana

        Neighborhood::create([
            'id' => 5161,
            'name' => 'Comandante Fontana',
            'city_id' => 2143,
        ]);

        //El Colorado

        Neighborhood::create([
            'id' => 5162,
            'name' => 'El Colorado',
            'city_id' => 2144,
        ]);

        //El Espinillo

        Neighborhood::create([
            'id' => 5163,
            'name' => 'El Espinillo',
            'city_id' => 2145,
        ]);

        //El Potrillo

        Neighborhood::create([
            'id' => 5164,
            'name' => 'El Potrillo',
            'city_id' => 2146,
        ]);

        //El Recreo

        Neighborhood::create([
            'id' => 5165,
            'name' => 'El Recreo',
            'city_id' => 2147,
        ]);

        //Estanislao del Campo

        Neighborhood::create([
            'id' => 5166,
            'name' => 'Estanislao del Campo',
            'city_id' => 2148,
        ]);

        //Fortín Leyes

        Neighborhood::create([
            'id' => 5167,
            'name' => 'Fortín Leyes',
            'city_id' => 2149,
        ]);

        //Fortín Lugones

        Neighborhood::create([
            'id' => 5168,
            'name' => 'Fortín Lugones',
            'city_id' => 2150,
        ]);

        //General Lucio V Mansilla

        Neighborhood::create([
            'id' => 5169,
            'name' => 'General Lucio V Mansilla',
            'city_id' => 2151,
        ]);

        //General Mosconi

        Neighborhood::create([
            'id' => 5170,
            'name' => 'General Mosconi',
            'city_id' => 2152,
        ]);

        //Gran Guardia

        Neighborhood::create([
            'id' => 5171,
            'name' => 'Gran Guardia',
            'city_id' => 2153,
        ]);

        //Herradura

        Neighborhood::create([
            'id' => 5172,
            'name' => 'Herradura',
            'city_id' => 2154,
        ]);

        //Ibarreta

        Neighborhood::create([
            'id' => 5173,
            'name' => 'Ibarreta',
            'city_id' => 2155,
        ]);

        //Juan G Bazán

        Neighborhood::create([
            'id' => 5174,
            'name' => 'Juan G Bazàn',
            'city_id' => 2156,
        ]);

        //Laguna Blanca

        Neighborhood::create([
            'id' => 5175,
            'name' => 'Laguna Blanca',
            'city_id' => 2157,
        ]);

        //Laguna Naick Neck

        Neighborhood::create([
            'id' => 5176,
            'name' => 'Laguna Naick Neck',
            'city_id' => 2158,
        ]);

        //Laguna Yema

        Neighborhood::create([
            'id' => 5177,
            'name' => 'Laguna Yema',
            'city_id' => 2159,
        ]);

        //Los Chiriguanos

        Neighborhood::create([
            'id' => 5178,
            'name' => 'Los Chiriguanos',
            'city_id' => 2160,
        ]);

        //Mariano Boedo

        Neighborhood::create([
            'id' => 5179,
            'name' => 'Mariano Boedo',
            'city_id' => 2161,
        ]);

        //Mayor Vicente Villafañe

        Neighborhood::create([
            'id' => 5180,
            'name' => 'Mayor Vicente Villafañe',
            'city_id' => 2162,
        ]);

        //Misión Tacaagle

        Neighborhood::create([
            'id' => 5181,
            'name' => 'Misión Tacaagle',
            'city_id' => 2163,
        ]);

        //Mojón de Fierro

        Neighborhood::create([
            'id' => 5182,
            'name' => 'Mojón de Fierro',
            'city_id' => 2164,
        ]);


        //Palma Sola

        Neighborhood::create([
            'id' => 5184,
            'name' => 'Palma Sola',
            'city_id' => 2166,
        ]);

        //Palo Santo

        Neighborhood::create([
            'id' => 5185,
            'name' => 'Palo Santo',
            'city_id' => 2167,
        ]);

        //Porton Negro

        Neighborhood::create([
            'id' => 5186,
            'name' => 'Porton Negro',
            'city_id' => 2168,
        ]);

        //Posta Cambio Zalazar

        Neighborhood::create([
            'id' => 5187,
            'name' => 'Posta Cambio Zalazar',
            'city_id' => 2169,
        ]);

        //Pozo de Maza

        Neighborhood::create([
            'id' => 5188,
            'name' => 'Pozo de Maza',
            'city_id' => 2170,
        ]);

        //Pozo del Mortero

        Neighborhood::create([
            'id' => 5189,
            'name' => 'Pozo del Mortero',
            'city_id' => 2171,
        ]);

        //Pozo del Tigre

        Neighborhood::create([
            'id' => 5190,
            'name' => 'Pozo del Tigre',
            'city_id' => 2172,
        ]);

        //Puerto Eva Perón

        Neighborhood::create([
            'id' => 5191,
            'name' => 'Puerto Eva Perón',
            'city_id' => 2173,
        ]);

        //Puerto Pilcomayo

        Neighborhood::create([
            'id' => 5192,
            'name' => 'Puerto Pilcomayo',
            'city_id' => 2174,
        ]);

        //Riacho He- He

        Neighborhood::create([
            'id' => 5193,
            'name' => 'Riacho He- He',
            'city_id' => 2175,
        ]);

        //Riacho Negro

        Neighborhood::create([
            'id' => 5194,
            'name' => 'Riacho Negro',
            'city_id' => 2176,
        ]);

        //San Hilario

        Neighborhood::create([
            'id' => 5195,
            'name' => 'San Hilario',
            'city_id' => 2177,
        ]);

        //San Martin 1

        Neighborhood::create([
            'id' => 5196,
            'name' => 'San Martin 1',
            'city_id' => 2178,
        ]);

        //San Martin 2

        Neighborhood::create([
            'id' => 5197,
            'name' => 'San Martin 2',
            'city_id' => 2179,
        ]);

        //Siete Palmas

        Neighborhood::create([
            'id' => 5198,
            'name' => 'Siete Palmas',
            'city_id' => 2180,
        ]);

        //Subteniente Perín

        Neighborhood::create([
            'id' => 5199,
            'name' => 'Subteniente Perín',
            'city_id' => 2181,
        ]);

        //Tatané

        Neighborhood::create([
            'id' => 5200,
            'name' => 'Tatané',
            'city_id' => 2182,
        ]);

        //Tres Lagunas

        Neighborhood::create([
            'id' => 5201,
            'name' => 'Tres Lagunas',
            'city_id' => 2183,
        ]);

        //Villa del Carmen

        Neighborhood::create([
            'id' => 5202,
            'name' => 'Vila del Carmen',
            'city_id' => 2184,
        ]);

        //Villa Dos Trece

        Neighborhood::create([
            'id' => 5203,
            'name' => 'Villa Dos Trece',
            'city_id' => 2185,
        ]);

        //Villa Escolar

        Neighborhood::create([
            'id' => 5204,
            'name' => 'Villa Escolar',
            'city_id' => 2186,
        ]);

        //Villa General Güemes

        Neighborhood::create([
            'id' => 5205,
            'name' => 'Villa General Güemes',
            'city_id' => 2187,
        ]);

        //Villa Trinidad

        Neighborhood::create([
            'id' => 5206,
            'name' => 'Villa Trinidad',
            'city_id' => 2188,
        ]);

        //La Matanza

        Neighborhood::create([
            'id' => 5207,
            'name' => 'Ramos Mejía',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5208,
            'name' => 'San Justo',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5209,
            'name' => 'Villa Luzuriaga',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5210,
            'name' => 'Lomas del Mirador',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5211,
            'name' => 'La Tablada',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5212,
            'name' => 'Aldo Bonzi',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5213,
            'name' => 'Ciudad Evita',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5214,
            'name' => 'Club de Campo Las Perdices ',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5215,
            'name' => 'González Catán',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5216,
            'name' => 'Gregorio de Laferrere',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5217,
            'name' => 'Isidro Casanova',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5218,
            'name' => 'Las Perdices',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5219,
            'name' => 'Rafael Castillo',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5220,
            'name' => 'Tapiales',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5221,
            'name' => 'Veinte de Junio',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5222,
            'name' => 'Villa Celina',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5223,
            'name' => 'Villa Madero',
            'city_id' => 2189,
        ]);

        Neighborhood::create([
            'id' => 5224,
            'name' => 'Virrey del Pino',
            'city_id' => 2189,
        ]);


        //Ituzaingo

        Neighborhood::create([
            'id' => 5225,
            'name' => 'Villa Udaondo',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5226,
            'name' => 'Ituzaingó Sur',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5227,
            'name' => 'Altos del Sol',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5228,
            'name' => 'Agustinas I',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5229,
            'name' => 'Agustinas II',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5230,
            'name' => 'Ayres de Leloir',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5231,
            'name' => 'Don Caggiano',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5232,
            'name' => 'El Casco de Leloir',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5233,
            'name' => 'El Jagüel (Ituzaingo)',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5234,
            'name' => 'El Pilar',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5235,
            'name' => 'Haras Miryam',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5236,
            'name' => 'Los Pingüinos',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5237,
            'name' => 'María del Parque',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5238,
            'name' => 'Parque Sumampa',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5239,
            'name' => 'Rincón de Leloir',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5240,
            'name' => 'San Alberto',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5241,
            'name' => 'Solares del Jagüel',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5242,
            'name' => 'Soleloir',
            'city_id' => 2191,
        ]);

        Neighborhood::create([
            'id' => 5243,
            'name' => 'Villa Ariza',
            'city_id' => 2191,
        ]);

        //Tres de Febrero

        Neighborhood::create([
            'id' => 5244,
            'name' => 'Caseros',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5245,
            'name' => 'Ciudadela',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5246,
            'name' => 'Sáenz Peña',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5247,
            'name' => 'Villa Bosch',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5248,
            'name' => 'Ciudad Jardín Lomas del Palomar',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5249,
            'name' => 'Churruca',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5250,
            'name' => 'El Libertador',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5251,
            'name' => 'José Ingenieros',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5252,
            'name' => 'Loma Hermosa',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5253,
            'name' => 'Martín Coronado',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5254,
            'name' => 'Once de Septiembre',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5255,
            'name' => 'Pablo Podestá',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5256,
            'name' => 'Remedios de Escalada de San Martín',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5257,
            'name' => 'Santos Lugares',
            'city_id' => 2192,
        ]);

        Neighborhood::create([
            'id' => 5258,
            'name' => 'Villa Raffo',
            'city_id' => 2192,
        ]);

        //Moreno

        Neighborhood::create([
            'id' => 5259,
            'name' => 'Francisco Alvarez',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5260,
            'name' => 'Moreno',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5261,
            'name' => 'La Reja',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5262,
            'name' => 'Paso del Rey',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5263,
            'name' => 'Trujui',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5264,
            'name' => 'Cruce Castelar',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5265,
            'name' => 'Cuartel V',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5266,
            'name' => 'El Casco de Moreno',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5267,
            'name' => 'El Hogar Obrero',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5268,
            'name' => 'El Resuello',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5269,
            'name' => 'Green Village',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5270,
            'name' => 'Haras María Elena',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5271,
            'name' => 'Haras María Eugenia',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5273,
            'name' => 'Haras María Victoria',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5274,
            'name' => 'María Eugenia Residences & Village',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5275,
            'name' => 'Prados del Oeste',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5276,
            'name' => 'Santa Ana',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5277,
            'name' => 'Terrazas del Sol',
            'city_id' => 2193,
        ]);

        Neighborhood::create([
            'id' => 5278,
            'name' => 'Umbrales de la Merced',
            'city_id' => 2193,
        ]);



        //Hurlingham

        Neighborhood::create([
            'id' => 5279,
            'name' => 'Hurlingham',
            'city_id' => 2196,
        ]);

        Neighborhood::create([
            'id' => 5280,
            'name' => 'Villa Tesei',
            'city_id' => 2196,
        ]);

        Neighborhood::create([
            'id' => 5281,
            'name' => 'Wiliam Morris',
            'city_id' => 2196,
        ]);

        Neighborhood::create([
            'id' => 5282,
            'name' => 'Santos Tesei',
            'city_id' => 2196,
        ]);

        Neighborhood::create([
            'id' => 5283,
            'name' => 'Las Cabañas',
            'city_id' => 2196,
        ]);

        Neighborhood::create([
            'id' => 5284,
            'name' => 'West Village',
            'city_id' => 2196,
        ]);

        //Luján

        Neighborhood::create([
            'id' => 5285,
            'name' => 'Luján',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5286,
            'name' => 'Open Door',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5287,
            'name' => 'Comarcas de Luján',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5288,
            'name' => 'La Concepción',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5289,
            'name' => 'Carlos Keen',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5290,
            'name' => 'Aconcagua',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5291,
            'name' => 'Altos de Luján',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5292,
            'name' => 'Arroyo Dulce',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5293,
            'name' => 'Bahía Serena',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5294,
            'name' => 'Chacras de Eulalia',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5295,
            'name' => 'Chacras La Catalina',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5296,
            'name' => 'Club de Campo La Asunción',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5297,
            'name' => 'Colonia de Chacras del Rio Luján',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5298,
            'name' => 'Cortines',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5299,
            'name' => 'El Argentino Farm Club',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5300,
            'name' => 'El Chamical',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5301,
            'name' => 'El Espinillo Golf',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5302,
            'name' => 'Everlinks',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5303,
            'name' => 'Fortín Luján',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5304,
            'name' => 'José María Jáuregui',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5305,
            'name' => 'La Cañada Polo Club',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5306,
            'name' => 'La Cecilia',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5307,
            'name' => 'La Colina',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5308,
            'name' => 'La Colina Villa de Campo',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5309,
            'name' => 'La Primavera',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5310,
            'name' => 'La Ranita',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5311,
            'name' => 'La Vieja Querencia',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5312,
            'name' => 'Las Chacras de Open Door',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5313,
            'name' => 'Las Praderas',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5314,
            'name' => 'Loma Escondida',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5315,
            'name' => 'Lomas de Olivera',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5316,
            'name' => 'Lomas de San Antonio',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5317,
            'name' => 'Los Juncos',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5318,
            'name' => 'Los Puentes',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5319,
            'name' => 'Los Robles',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5320,
            'name' => 'Luján del Sol',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5321,
            'name' => 'Luján Match Point',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5322,
            'name' => 'Miralejos',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5323,
            'name' => 'Olivera',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5324,
            'name' => 'Pehuén Country Club ',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5325,
            'name' => 'Santa Catalina',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5326,
            'name' => 'Santa Catalina 2 (Lujan)',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5327,
            'name' => 'Santa Irene',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5328,
            'name' => 'Santa María',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5329,
            'name' => 'Santa María de Luján',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5330,
            'name' => 'Santa Matilde',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5331,
            'name' => 'Torres',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5332,
            'name' => 'Valle Viejo',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5334,
            'name' => 'El Espinillo Golf',
            'city_id' => 2197,
        ]);

        Neighborhood::create([
            'id' => 5335,
            'name' => 'Villa de Campo Los Tres Pinos',
            'city_id' => 2197,
        ]);

        //Marcos Paz

        Neighborhood::create([
            'id' => 5336,
            'name' => 'Marcos Paz',
            'city_id' => 2198,
        ]);

        Neighborhood::create([
            'id' => 5337,
            'name' => 'El Moro',
            'city_id' => 2198,
        ]);

        Neighborhood::create([
            'id' => 5338,
            'name' => 'Club de Campo Las Hojas',
            'city_id' => 2198,
        ]);

        //Merlo

        Neighborhood::create([
            'id' => 5339,
            'name' => 'San Antonio de Padua',
            'city_id' => 2199,
        ]);

        Neighborhood::create([
            'id' => 5340,
            'name' => 'Merlo Centro',
            'city_id' => 2199,
        ]);

        Neighborhood::create([
            'id' => 5341,
            'name' => 'Libertad',
            'city_id' => 2199,
        ]);

        Neighborhood::create([
            'id' => 5342,
            'name' => 'Pontevedra',
            'city_id' => 2199,
        ]);

        Neighborhood::create([
            'id' => 5343,
            'name' => 'Barrio Parque San Martin',
            'city_id' => 2199,
        ]);

        Neighborhood::create([
            'id' => 5344,
            'name' => 'El Potrero',
            'city_id' => 2199,
        ]);


        //Abdón Castro Tolay

        Neighborhood::create([
            'id' => 5346,
            'name' => 'Abdón Castro Tolay',
            'city_id' => 2205,
        ]);

        //Abra Pampa

        Neighborhood::create([
            'id' => 5347,
            'name' => 'Abra Pampa',
            'city_id' => 2206,
        ]);

        //Abralaite

        Neighborhood::create([
            'id' => 5348,
            'name' => 'Abralaite',
            'city_id' => 2207,
        ]);

        //Agua Caliente

        Neighborhood::create([
            'id' => 5349,
            'name' => 'Agua Caliente',
            'city_id' => 2208,
        ]);

        //Agua Caliente de la Puna

        Neighborhood::create([
            'id' => 5350,
            'name' => 'Agua Caliente de la Puna',
            'city_id' => 2209,
        ]);

        Neighborhood::create([
            'id' => 5351,
            'name' => 'Agua Chica',
            'city_id' => 2210,
        ]);

        //Aguas Calientes

        Neighborhood::create([
            'id' => 5352,
            'name' => 'Aguas Calientes',
            'city_id' => 2211,
        ]);

        //Alto Comedero

        Neighborhood::create([
            'id' => 5353,
            'name' => 'Alto Comedero',
            'city_id' => 2212,
        ]);

        //Altos Hornos Zapla

        Neighborhood::create([
            'id' => 5354,
            'name' => 'Altos Hornos Zapla',
            'city_id' => 2213,
        ]);

        //Antiguyoc

        Neighborhood::create([
            'id' => 5355,
            'name' => 'Antiguyoc',
            'city_id' => 2214,
        ]);

        //Aparzo

        Neighborhood::create([
            'id' => 5356,
            'name' => 'Aparzo',
            'city_id' => 2215,
        ]);

        //Arrayanal

        Neighborhood::create([
            'id' => 5357,
            'name' => 'Arrayanal',
            'city_id' => 2216,
        ]);

        //Arroyo Colorado

        Neighborhood::create([
            'id' => 5358,
            'name' => 'Arroyo Colorado',
            'city_id' => 2217,
        ]);

        //Azul Pampa

        Neighborhood::create([
            'id' => 5359,
            'name' => 'Azul Pampa',
            'city_id' => 2218,
        ]);

        //Bananal

        Neighborhood::create([
            'id' => 5360,
            'name' => 'Bananal',
            'city_id' => 2219,
        ]);

        //Barrealito

        Neighborhood::create([
            'id' => 5361,
            'name' => 'Barrealito',
            'city_id' => 2220,
        ]);

        //Barrio El Milagro

        Neighborhood::create([
            'id' => 5362,
            'name' => 'Barrio El Milagro',
            'city_id' => 2221,
        ]);

        //Barrio La Unión

        Neighborhood::create([
            'id' => 5363,
            'name' => 'Barrio La Unión',
            'city_id' => 2222,
        ]);

        //Barrios

        Neighborhood::create([
            'id' => 5364,
            'name' => 'Barrios',
            'city_id' => 2223,
        ]);

        //Barro Negro

        Neighborhood::create([
            'id' => 5365,
            'name' => 'Barro Negro',
            'city_id' => 2224,
        ]);

        //Bermejito

        Neighborhood::create([
            'id' => 5366,
            'name' => 'Bermejito',
            'city_id' => 2225,
        ]);

        //Cabreria

        Neighborhood::create([
            'id' => 5367,
            'name' => 'Cabreria',
            'city_id' => 2226,
        ]);

        //Caimancito

        Neighborhood::create([
            'id' => 5368,
            'name' => 'Caimancito',
            'city_id' => 2227,
        ]);

        //Cajas

        Neighborhood::create([
            'id' => 5369,
            'name' => 'Cajas',
            'city_id' => 2228,
        ]);

        //Calahoyo

        Neighborhood::create([
            'id' => 5370,
            'name' => 'Calahoyo',
            'city_id' => 2229,
        ]);

        //Calilegua

        Neighborhood::create([
            'id' => 5371,
            'name' => 'Calilegua',
            'city_id' => 2230,
        ]);

        //Cangrejillos

        Neighborhood::create([
            'id' => 5372,
            'name' => 'Cangrejillos',
            'city_id' => 2231,
        ]);

        //Cangrejos

        Neighborhood::create([
            'id' => 5373,
            'name' => 'Cangrejos',
            'city_id' => 2232,
        ]);

        //Capla

        Neighborhood::create([
            'id' => 5374,
            'name' => 'Capla',
            'city_id' => 2233,
        ]);

        //Caracara

        Neighborhood::create([
            'id' => 5375,
            'name' => 'Caracara',
            'city_id' => 2234,
        ]);

        //Carahuasi

        Neighborhood::create([
            'id' => 5376,
            'name' => 'Carahuasi',
            'city_id' => 2235,
        ]);

        //Carahunco

        Neighborhood::create([
            'id' => 5377,
            'name' => 'Carahunco',
            'city_id' => 2236,
        ]);

        //Casa Colorada

        Neighborhood::create([
            'id' => 5378,
            'name' => 'Casa Colorada',
            'city_id' => 2237,
        ]);

        //Casa Grande

        Neighborhood::create([
            'id' => 5379,
            'name' => 'Casa Grande',
            'city_id' => 2238,
        ]);

        //Casabindo

        Neighborhood::create([
            'id' => 5380,
            'name' => 'Casabindo',
            'city_id' => 2239,
        ]);

        //Casillas

        Neighborhood::create([
            'id' => 5381,
            'name' => 'Casillas',
            'city_id' => 2240,
        ]);

        //Casira

        Neighborhood::create([
            'id' => 5382,
            'name' => 'Casira',
            'city_id' => 2241,
        ]);

        //Caspalá

        Neighborhood::create([
            'id' => 5383,
            'name' => 'Caspalá',
            'city_id' => 2242,
        ]);

        //Casti

        Neighborhood::create([
            'id' => 5384,
            'name' => 'Casti',
            'city_id' => 2243,
        ]);

        //Catua

        Neighborhood::create([
            'id' => 5385,
            'name' => 'Catua',
            'city_id' => 2244,
        ]);

        //Cañuelas

        Neighborhood::create([
            'id' => 5386,
            'name' => 'Cañuelas',
            'city_id' => 2245,
        ]);

        //Centro Forestal

        Neighborhood::create([
            'id' => 5387,
            'name' => 'Centro Forestal',
            'city_id' => 2246,
        ]);

        //Cerrillos

        Neighborhood::create([
            'id' => 5388,
            'name' => 'Cerrillos',
            'city_id' => 2247,
        ]);

        //Chalican

        Neighborhood::create([
            'id' => 5389,
            'name' => 'Chalican',
            'city_id' => 2248,
        ]);

        //Chaupi Rodeo

        Neighborhood::create([
            'id' => 5390,
            'name' => 'Chaupi Rodeo',
            'city_id' => 2249,
        ]);

        //Chocoite

        Neighborhood::create([
            'id' => 5391,
            'name' => 'Chocoite',
            'city_id' => 2250,
        ]);

        //Chorcan

        Neighborhood::create([
            'id' => 5392,
            'name' => 'Chorcan',
            'city_id' => 2251,
        ]);

        //Chucalesna

        Neighborhood::create([
            'id' => 5393,
            'name' => 'Chucalesna',
            'city_id' => 2252,
        ]);

        //Cianzo

        Neighborhood::create([
            'id' => 5394,
            'name' => 'Cianzo',
            'city_id' => 2253,
        ]);

        //Cieneguillas

        Neighborhood::create([
            'id' => 5395,
            'name' => 'Cieneguillas',
            'city_id' => 2254,
        ]);

        //Cince

        Neighborhood::create([
            'id' => 5396,
            'name' => 'Cince',
            'city_id' => 2255,
        ]);

        //Ciénaga

        Neighborhood::create([
            'id' => 5397,
            'name' => 'Ciénaga',
            'city_id' => 2256,
        ]);

        //Cienaga Grande

        Neighborhood::create([
            'id' => 5398,
            'name' => 'Cienaga Grande',
            'city_id' => 2257,
        ]);

        //Cobre

        Neighborhood::create([
            'id' => 5399,
            'name' => 'Cobre',
            'city_id' => 2258,
        ]);

        //Cochinoca

        Neighborhood::create([
            'id' => 5400,
            'name' => 'Cochinoca',
            'city_id' => 2259,
        ]);

        //Coctaca

        Neighborhood::create([
            'id' => 5401,
            'name' => 'Coctaca',
            'city_id' => 2260,
        ]);

        //Colonia San José

        Neighborhood::create([
            'id' => 5402,
            'name' => 'Colonia San José',
            'city_id' => 2261,
        ]);

        //Coranzuli

        Neighborhood::create([
            'id' => 5403,
            'name' => 'Coranzuli',
            'city_id' => 2262,
        ]);

        //Coraya

        Neighborhood::create([
            'id' => 5404,
            'name' => 'Coraya',
            'city_id' => 2263,
        ]);

        //Corral Blanco

        Neighborhood::create([
            'id' => 5405,
            'name' => 'Corral Blanco',
            'city_id' => 2264,
        ]);

        //Corral de Piedra

        Neighborhood::create([
            'id' => 5406,
            'name' => 'Corral del Piedra',
            'city_id' => 2265,
        ]);

        //Corral Grande

        Neighborhood::create([
            'id' => 5407,
            'name' => 'Corral Grande',
            'city_id' => 2266,
        ]);

        //Cusi Cusi

        Neighborhood::create([
            'id' => 5408,
            'name' => 'Cusi Cusi',
            'city_id' => 2267,
        ]);

        //Don Emilio

        Neighborhood::create([
            'id' => 5409,
            'name' => 'Don Emilio',
            'city_id' => 2268,
        ]);

        //Doncellas Chicas

        Neighborhood::create([
            'id' => 5410,
            'name' => 'Doncellas Chicas',
            'city_id' => 2269,
        ]);

        //Doncellas Grandes

        Neighborhood::create([
            'id' => 5411,
            'name' => 'Doncellas Grandes',
            'city_id' => 2270,
        ]);

        //El Acheral

        Neighborhood::create([
            'id' => 5412,
            'name' => 'El Acheral',
            'city_id' => 2271,
        ]);

        //El Aguilar

        Neighborhood::create([
            'id' => 5413,
            'name' => 'El Aguilar',
            'city_id' => 2272,
        ]);

        //El Algarrobal

        Neighborhood::create([
            'id' => 5414,
            'name' => 'El Angosto',
            'city_id' => 2273,
        ]);

        //El Angosto

        Neighborhood::create([
            'id' => 5415,
            'name' => 'El Angosto',
            'city_id' => 2274,
        ]);

        //El ceibal

        Neighborhood::create([
            'id' => 5416,
            'name' => 'El Ceibal',
            'city_id' => 2275,
        ]);

        //El Codo

        Neighborhood::create([
            'id' => 5417,
            'name' => 'El Codo',
            'city_id' => 2276,
        ]);

        //El Cucho

        Neighborhood::create([
            'id' => 5419,
            'name' => 'El Cucho',
            'city_id' => 2277,
        ]);

        //El Condor

        Neighborhood::create([
            'id' => 5420,
            'name' => 'El Condor',
            'city_id' => 2278,
        ]);

        //El Fuerte

        Neighborhood::create([
            'id' => 5421,
            'name' => 'El Fuerte',
            'city_id' => 2279,
        ]);

        //El Olvido

        Neighborhood::create([
            'id' => 5422,
            'name' => 'El Olvido',
            'city_id' => 2280,
        ]);

        //El Piquete

        Neighborhood::create([
            'id' => 5423,
            'name' => 'El Piquete',
            'city_id' => 2281,
        ]);

        //El Puesto

        Neighborhood::create([
            'id' => 5424,
            'name' => 'El Puesto',
            'city_id' => 2282,
        ]);

        //El Quemado

        Neighborhood::create([
            'id' => 5425,
            'name' => 'El Quemado',
            'city_id' => 2283,
        ]);

        //El Rosal

        Neighborhood::create([
            'id' => 5426,
            'name' => 'El Rosal',
            'city_id' => 2284,
        ]);

        //El Sauzal

        Neighborhood::create([
            'id' => 5427,
            'name' => 'El Sauzal',
            'city_id' => 2285,
        ]);

        //El Talar

        Neighborhood::create([
            'id' => 5428,
            'name' => 'El Talar',
            'city_id' => 2286,
        ]);

        //El Tipal

        Neighborhood::create([
            'id' => 5429,
            'name' => 'El Tipal',
            'city_id' => 2287,
        ]);

        //El Toro

        Neighborhood::create([
            'id' => 5430,
            'name' => 'El Toro',
            'city_id' => 2288,
        ]);

        //Esquina de Quisto

        Neighborhood::create([
            'id' => 5431,
            'name' => 'Esquina de Quisto',
            'city_id' => 2289,
        ]);

        //Esquina Grande

        Neighborhood::create([
            'id' => 5432,
            'name' => 'Esquina Grande',
            'city_id' => 2290,
        ]);

        //Fraile Pintado

        Neighborhood::create([
            'id' => 5433,
            'name' => 'El Fraile Pintado',
            'city_id' => 2291,
        ]);

        //Guayacan

        Neighborhood::create([
            'id' => 5434,
            'name' => 'Guayacan',
            'city_id' => 2292,
        ]);

        //Guayatayoc

        Neighborhood::create([
            'id' => 5435,
            'name' => 'Guayatayoc',
            'city_id' => 2293,
        ]);

        //Guerrero (421 hab)

        Neighborhood::create([
            'id' => 5436,
            'name' => 'Guerrero (421 Hab)',
            'city_id' => 2294,
        ]);

        //Hípolito Yrigoyen

        Neighborhood::create([
            'id' => 5437,
            'name' => 'Hípolito Yrigoyen',
            'city_id' => 2295,
        ]);

        //Hornaditas

        Neighborhood::create([
            'id' => 5438,
            'name' => 'Hornaditas',
            'city_id' => 2296,
        ]);

        //Hornillos

        Neighborhood::create([
            'id' => 5439,
            'name' => 'Hornillos',
            'city_id' => 2297,
        ]);

        //Huacalera

        Neighborhood::create([
            'id' => 5440,
            'name' => 'Huacalera',
            'city_id' => 2298,
        ]);

        //Huancar

        Neighborhood::create([
            'id' => 5441,
            'name' => 'Huancar',
            'city_id' => 2299,
        ]);

        //Humahuaca

        Neighborhood::create([
            'id' => 5442,
            'name' => 'Humahuaca',
            'city_id' => 2300,
        ]);

        //Icacha

        Neighborhood::create([
            'id' => 5443,
            'name' => 'Icacha',
            'city_id' => 2301,
        ]);

        //Isla Chica

        Neighborhood::create([
            'id' => 5444,
            'name' => 'Isla Chica',
            'city_id' => 2302,
        ]);

        //Jaire

        Neighborhood::create([
            'id' => 5445,
            'name' => 'Jaire',
            'city_id' => 2303,
        ]);

        //Jaramillo

        Neighborhood::create([
            'id' => 5446,
            'name' => 'Jaramillo',
            'city_id' => 2304,
        ]);

        //La Almona

        Neighborhood::create([
            'id' => 5447,
            'name' => 'La Almona (34 hab)',
            'city_id' => 2305,
        ]);

        //La Celulosa

        Neighborhood::create([
            'id' => 5448,
            'name' => 'La Celulosa',
            'city_id' => 2306,
        ]);

        //La Ciénaga

        Neighborhood::create([
            'id' => 5449,
            'name' => 'La Ciénaga',
            'city_id' => 2307,
        ]);

        //La Cuesta

        Neighborhood::create([
            'id' => 5450,
            'name' => 'La Cuesta',
            'city_id' => 2308,
        ]);

        //La Cueva

        Neighborhood::create([
            'id' => 5451,
            'name' => 'La Cueva',
            'city_id' => 2309,
        ]);

        //La Esperanza

        Neighborhood::create([
            'id' => 5452,
            'name' => 'La Esperanza',
            'city_id' => 2310,
        ]);

        //La Intermedia

        Neighborhood::create([
            'id' => 5453,
            'name' => 'La Intermedia',
            'city_id' => 2311,
        ]);

        //La Manga

        Neighborhood::create([
            'id' => 5454,
            'name' => 'La Manga',
            'city_id' => 2312,
        ]);

        //La Mendieta

        Neighborhood::create([
            'id' => 5455,
            'name' => 'La Mendieta',
            'city_id' => 2313,
        ]);



        //Lagunillas

        Neighborhood::create([
            'id' => 5456,
            'name' => 'Lagunillas',
            'city_id' => 2316,
        ]);

        //Lagunillas del Farallón

        Neighborhood::create([
            'id' => 5457,
            'name' => 'Lagunillas del Farallón',
            'city_id' => 2317,
        ]);

        //Las Capillas

        Neighborhood::create([
            'id' => 5458,
            'name' => 'Las Capillas',
            'city_id' => 2318,
        ]);

        //Las Juntas

        Neighborhood::create([
            'id' => 5459,
            'name' => 'La Juntas',
            'city_id' => 2319,
        ]);

        //León (431 hab)

        Neighborhood::create([
            'id' => 5460,
            'name' => 'León (431 Hab)',
            'city_id' => 2320,
        ]);

        //Libertad

        Neighborhood::create([
            'id' => 5461,
            'name' => 'Libertad',
            'city_id' => 2321,
        ]);

        //Libertador General San Martín

        Neighborhood::create([
            'id' => 5462,
            'name' => 'Libertador General San Martin',
            'city_id' => 2322,
        ]);

        //Liviara

        Neighborhood::create([
            'id' => 5463,
            'name' => 'Liviara',
            'city_id' => 2323,
        ]);

        //Llulluchayoc

        Neighborhood::create([
            'id' => 5464,
            'name' => 'Llulluchayoc',
            'city_id' => 2324,
        ]);

        //Loma Blanca

        Neighborhood::create([
            'id' => 5465,
            'name' => 'Loma Blanca',
            'city_id' => 2325,
        ]);

        //Los Blancos

        Neighborhood::create([
            'id' => 5466,
            'name' => 'Los Blancos',
            'city_id' => 2326,
        ]);

        //Los Lapachos

        Neighborhood::create([
            'id' => 5467,
            'name' => 'Los Lapachos',
            'city_id' => 2327,
        ]);

        //Los Matos

        Neighborhood::create([
            'id' => 5468,
            'name' => 'Los Matos',
            'city_id' => 2328,
        ]);

        //Los Nogales

        Neighborhood::create([
            'id' => 5469,
            'name' => 'Los Nogales',
            'city_id' => 2329,
        ]);

        //Loteo Navea

        Neighborhood::create([
            'id' => 5470,
            'name' => 'Loteo Navea',
            'city_id' => 2330,
        ]);

        //Lozano (1139 hab)

        Neighborhood::create([
            'id' => 5471,
            'name' => 'Lozano (1139 hab)',
            'city_id' => 2331,
        ]);

        //Lulluchayoc

        Neighborhood::create([
            'id' => 5472,
            'name' => 'Lulluchayoc',
            'city_id' => 2332,
        ]);

        //Madrejón

        Neighborhood::create([
            'id' => 5473,
            'name' => 'Madrejón',
            'city_id' => 2333,
        ]);

        //Maimará

        Neighborhood::create([
            'id' => 5474,
            'name' => 'Maimará',
            'city_id' => 2334,
        ]);

        //Manantiales

        Neighborhood::create([
            'id' => 5475,
            'name' => 'Manantiales',
            'city_id' => 2335,
        ]);

        //Mina 9 de Octubre

        Neighborhood::create([
            'id' => 5476,
            'name' => 'Mina 9 de Octubre',
            'city_id' => 2336,
        ]);

        //Mina Ajedrez

        Neighborhood::create([
            'id' => 5477,
            'name' => 'Mina Ajedrez',
            'city_id' => 2337,
        ]);

        //Mina Pan de Azúcar

        Neighborhood::create([
            'id' => 5478,
            'name' => 'Mina Pan de Azúcar',
            'city_id' => 2338,
        ]);

        //Mina Pirquitas

        Neighborhood::create([
            'id' => 5479,
            'name' => 'Mina Pirquitas',
            'city_id' => 2339,
        ]);

        //Mina Providencia

        Neighborhood::create([
            'id' => 5480,
            'name' => 'Mina Providencia',
            'city_id' => 2340,
        ]);

        //Miniaio

        Neighborhood::create([
            'id' => 5481,
            'name' => 'Miniaio',
            'city_id' => 2341,
        ]);

        //Miraflores

        Neighborhood::create([
            'id' => 5482,
            'name' => 'Miraflores',
            'city_id' => 2342,
        ]);

        //Misarrumi

        Neighborhood::create([
            'id' => 5483,
            'name' => 'Misarrumi',
            'city_id' => 2343,
        ]);

        //Monterrico

        Neighborhood::create([
            'id' => 5484,
            'name' => 'Monterrico',
            'city_id' => 2344,
        ]);

        //Mulli Punco

        Neighborhood::create([
            'id' => 5485,
            'name' => 'Mulli Punco',
            'city_id' => 2345,
        ]);

        //Muñayoc

        Neighborhood::create([
            'id' => 5486,
            'name' => 'Muñayoc',
            'city_id' => 2346,
        ]);

        //Nazareno

        Neighborhood::create([
            'id' => 5487,
            'name' => 'Nazareno',
            'city_id' => 2347,
        ]);

        //Nuevo Arbolito

        Neighborhood::create([
            'id' => 5488,
            'name' => 'Nuevo Arbolito',
            'city_id' => 2348,
        ]);

        //Ocloyas (82 Hab)

        Neighborhood::create([
            'id' => 5489,
            'name' => 'Ocloyas (82 hab)',
            'city_id' => 2349,
        ]);

        //Ojo de Agua

        Neighborhood::create([
            'id' => 5490,
            'name' => 'Ojo de Agua',
            'city_id' => 2350,
        ]);

        //Olacapato

        Neighborhood::create([
            'id' => 5491,
            'name' => 'Olacapato',
            'city_id' => 2351,
        ]);

        //Olaroz Chico

        Neighborhood::create([
            'id' => 5492,
            'name' => 'Olaroz Chico',
            'city_id' => 2352,
        ]);

        //Olaroz Grande

        Neighborhood::create([
            'id' => 5493,
            'name' => 'Olaroz Grande',
            'city_id' => 2353,
        ]);

        //Oratorio

        Neighborhood::create([
            'id' => 5494,
            'name' => 'Oratorio',
            'city_id' => 2354,
        ]);

        //Oros

        Neighborhood::create([
            'id' => 5495,
            'name' => 'Oros',
            'city_id' => 2355,
        ]);

        //Orosmayo

        Neighborhood::create([
            'id' => 5496,
            'name' => 'Orosmayo',
            'city_id' => 2356,
        ]);

        //Paicone

        Neighborhood::create([
            'id' => 5497,
            'name' => 'Paicone',
            'city_id' => 2357,
        ]);

        //Pairique Chico

        Neighborhood::create([
            'id' => 5498,
            'name' => 'Pairique Chico',
            'city_id' => 2358,
        ]);

        //Palca de Aparzo

        Neighborhood::create([
            'id' => 5499,
            'name' => 'Palca de Aparzo',
            'city_id' => 2359,
        ]);

        //Palma Sola

        Neighborhood::create([
            'id' => 5500,
            'name' => 'Palma Sola',
            'city_id' => 2360,
        ]);

        //Palos Blancos

        Neighborhood::create([
            'id' => 5501,
            'name' => 'Palos Blancos',
            'city_id' => 2361,
        ]);

        //Palpalá

        Neighborhood::create([
            'id' => 5502,
            'name' => 'Palpalá',
            'city_id' => 2362,
        ]);

        //Pampa Blanca

        Neighborhood::create([
            'id' => 5503,
            'name' => 'Pampa Blanca',
            'city_id' => 2363,
        ]);

        //Pampichuela

        Neighborhood::create([
            'id' => 5504,
            'name' => 'Pampichuela',
            'city_id' => 2364,
        ]);

        //Parapetí

        Neighborhood::create([
            'id' => 5505,
            'name' => 'Parapetí',
            'city_id' => 2365,
        ]);

        //Pasajes

        Neighborhood::create([
            'id' => 5506,
            'name' => 'Pasajes',
            'city_id' => 2366,
        ]);

        //Pastos Chicos

        Neighborhood::create([
            'id' => 5507,
            'name' => 'Pastos Chicos',
            'city_id' => 2367,
        ]);

        //Paulina

        Neighborhood::create([
            'id' => 5508,
            'name' => 'Paulina',
            'city_id' => 2368,
        ]);

        //Perico

        Neighborhood::create([
            'id' => 5509,
            'name' => 'Perico',
            'city_id' => 2369,
        ]);

        //Peñas Blancas

        Neighborhood::create([
            'id' => 5510,
            'name' => 'Peñas Blancas',
            'city_id' => 2370,
        ]);

        //Piedra Negra

        Neighborhood::create([
            'id' => 5511,
            'name' => 'Piedra Negra',
            'city_id' => 2371,
        ]);

        //Piedritas

        Neighborhood::create([
            'id' => 5512,
            'name' => 'Piedritas',
            'city_id' => 2372,
        ]);

        //Pirquitas

        Neighborhood::create([
            'id' => 5513,
            'name' => 'Pirquitas',
            'city_id' => 2373,
        ]);

        //Piscuno

        Neighborhood::create([
            'id' => 5514,
            'name' => 'Piscuno',
            'city_id' => 2374,
        ]);

        //Portezuelo

        Neighborhood::create([
            'id' => 5515,
            'name' => 'Portezuelo',
            'city_id' => 2375,
        ]);

        //Potrero

        Neighborhood::create([
            'id' => 5516,
            'name' => 'Potrero',
            'city_id' => 2376,
        ]);

        //Pucara

        Neighborhood::create([
            'id' => 5517,
            'name' => 'Pucara',
            'city_id' => 2377,
        ]);

        //Pueblo Viejo

        Neighborhood::create([
            'id' => 5518,
            'name' => 'Pueblo Viejo',
            'city_id' => 2378,
        ]);

        //Puente Lavayen

        Neighborhood::create([
            'id' => 5519,
            'name' => 'Puente Lavayen',
            'city_id' => 2379,
        ]);

        //Puesto del Marquéz

        Neighborhood::create([
            'id' => 5520,
            'name' => 'Puesto del Marquéz',
            'city_id' => 2380,
        ]);

        //Puesto Grande

        Neighborhood::create([
            'id' => 5521,
            'name' => 'Puesto Grande',
            'city_id' => 2381,
        ]);

        //Puesto Viejo

        Neighborhood::create([
            'id' => 5522,
            'name' => 'Puesto Viejo',
            'city_id' => 2382,
        ]);

        //Pumahuasi

        Neighborhood::create([
            'id' => 5523,
            'name' => 'Pumahuasi',
            'city_id' => 2383,
        ]);

        //Punta de Agua

        Neighborhood::create([
            'id' => 5524,
            'name' => 'Punta de Agua',
            'city_id' => 2384,
        ]);

        //Purmamarca

        Neighborhood::create([
            'id' => 5525,
            'name' => 'Purmamarca',
            'city_id' => 2385,
        ]);

        //Quichuagua

        Neighborhood::create([
            'id' => 5526,
            'name' => 'Quichuagua',
            'city_id' => 2386,
        ]);

        //Rachaite

        Neighborhood::create([
            'id' => 5527,
            'name' => 'Rachaite',
            'city_id' => 2387,
        ]);

        //Ramallo

        Neighborhood::create([
            'id' => 5528,
            'name' => 'Ramallo',
            'city_id' => 2388,
        ]);

        //Rangel

        Neighborhood::create([
            'id' => 5529,
            'name' => 'Rangel',
            'city_id' => 2389,
        ]);

        //Real de los Toros

        Neighborhood::create([
            'id' => 5530,
            'name' => 'Real de los Toros',
            'city_id' => 2390,
        ]);

        //Rinconada

        Neighborhood::create([
            'id' => 5531,
            'name' => 'Rinconada',
            'city_id' => 2391,
        ]);

        //Rinconadillas

        Neighborhood::create([
            'id' => 5532,
            'name' => 'Rinconadillas',
            'city_id' => 2392,
        ]);

        //Rincón de Cajas

        Neighborhood::create([
            'id' => 5533,
            'name' => 'Rincón de Cajas',
            'city_id' => 2393,
        ]);

        //Rodeo

        Neighborhood::create([
            'id' => 5534,
            'name' => 'Rodeo',
            'city_id' => 2394,
        ]);

        //Rodeo Chico

        Neighborhood::create([
            'id' => 5535,
            'name' => 'Rodeo Chico',
            'city_id' => 2395,
        ]);

        //Rodeíto

        Neighborhood::create([
            'id' => 5536,
            'name' => 'Rodeíto',
            'city_id' => 2396,
        ]);

        //Ronqui

        Neighborhood::create([
            'id' => 5537,
            'name' => 'Ronqui',
            'city_id' => 2397,
        ]);

        //Rosario de Coyahuima

        Neighborhood::create([
            'id' => 5538,
            'name' => 'Rosario de Coyahuima',
            'city_id' => 2398,
        ]);

        //Rosario de Río Grande

        Neighborhood::create([
            'id' => 5539,
            'name' => 'Rosario de Río Grande',
            'city_id' => 2399,
        ]);

        //Rosario de Susques

        Neighborhood::create([
            'id' => 5540,
            'name' => 'Rosario de Susques',
            'city_id' => 2400,
        ]);

        //Rumicruz

        Neighborhood::create([
            'id' => 5541,
            'name' => 'Rumicruz',
            'city_id' => 2401,
        ]);

        //Río Blanco

        Neighborhood::create([
            'id' => 5542,
            'name' => 'Río Blanco',
            'city_id' => 2402,
        ]);

        //Río Grande

        Neighborhood::create([
            'id' => 5543,
            'name' => 'Río Grande',
            'city_id' => 2403,
        ]);

        //San Antonio

        Neighborhood::create([
            'id' => 5544,
            'name' => 'San Antonio',
            'city_id' => 2404,
        ]);

        //San Borja

        Neighborhood::create([
            'id' => 5545,
            'name' => 'San Borja',
            'city_id' => 2405,
        ]);

        //San Francisco

        Neighborhood::create([
            'id' => 5546,
            'name' => 'San Francisco',
            'city_id' => 2406,
        ]);

        //San Francisco de Alfarcito

        Neighborhood::create([
            'id' => 5547,
            'name' => 'San Francisco de Alfarcito',
            'city_id' => 2407,
        ]);

        //San Isidro

        Neighborhood::create([
            'id' => 5548,
            'name' => 'San Isidro',
            'city_id' => 2408,
        ]);

        //San José

        Neighborhood::create([
            'id' => 5549,
            'name' => 'San José',
            'city_id' => 2409,
        ]);

        //San José de Miraflores

        Neighborhood::create([
            'id' => 5550,
            'name' => 'San José de Miraflores',
            'city_id' => 2410,
        ]);

        //San Juan de Dios

        Neighborhood::create([
            'id' => 5551,
            'name' => 'San Juan de Dios',
            'city_id' => 2411,
        ]);

        //San Juan de Oro

        Neighborhood::create([
            'id' => 5552,
            'name' => 'San Juan de Oro',
            'city_id' => 2412,
        ]);

        //San Juan de Oros

        Neighborhood::create([
            'id' => 5553,
            'name' => 'San Juan de Oros',
            'city_id' => 2413,
        ]);

        //San Juan de Quillaques

        Neighborhood::create([
            'id' => 5554,
            'name' => 'San Juan de Quillaques',
            'city_id' => 2414,
        ]);

        //San Juancito

        Neighborhood::create([
            'id' => 5555,
            'name' => 'San Juancito',
            'city_id' => 2415,
        ]);

        //San Leon

        Neighborhood::create([
            'id' => 5556,
            'name' => 'San Leon',
            'city_id' => 2416,
        ]);

        //San Lucas

        Neighborhood::create([
            'id' => 5557,
            'name' => 'San Lucas',
            'city_id' => 2417,
        ]);

        //San Pablo de Reyes

        Neighborhood::create([
            'id' => 5558,
            'name' => 'San Pablo de Reyes',
            'city_id' => 2418,
        ]);

        //San Pedro de Jujuy

        Neighborhood::create([
            'id' => 5559,
            'name' => 'San Pedro de Jujuy',
            'city_id' => 2419,
        ]);

        //San Rafael

        Neighborhood::create([
            'id' => 5560,
            'name' => 'San Rafael',
            'city_id' => 2420,
        ]);

        //Santa Ana

        Neighborhood::create([
            'id' => 5561,
            'name' => 'San Ana',
            'city_id' => 2421,
        ]);

        //Santa Catalina

        Neighborhood::create([
            'id' => 5562,
            'name' => 'Santa Catalina',
            'city_id' => 2422,
        ]);

        //Santa Clara

        Neighborhood::create([
            'id' => 5563,
            'name' => 'Santa Clara',
            'city_id' => 2423,
        ]);

        //Santa Rita

        Neighborhood::create([
            'id' => 5564,
            'name' => 'Santa Rita',
            'city_id' => 2424,
        ]);

        //Santuario de Tres Pozos

        Neighborhood::create([
            'id' => 5565,
            'name' => 'Santuario de Tres Pozos',
            'city_id' => 2425,
        ]);

        //Sey

        Neighborhood::create([
            'id' => 5566,
            'name' => 'Sey',
            'city_id' => 2426,
        ]);

        //Siete Aguas

        Neighborhood::create([
            'id' => 5567,
            'name' => 'Siete Aguas',
            'city_id' => 2427,
        ]);

        //Sol de Mayo

        Neighborhood::create([
            'id' => 5568,
            'name' => 'Sol de Mayo',
            'city_id' => 2428,
        ]);

        //Suripujio

        Neighborhood::create([
            'id' => 5569,
            'name' => 'Suripujio',
            'city_id' => 2429,
        ]);

        //Susques

        Neighborhood::create([
            'id' => 5570,
            'name' => 'Susques',
            'city_id' => 2430,
        ]);

        //Tafna

        Neighborhood::create([
            'id' => 5571,
            'name' => 'Tafna',
            'city_id' => 2431,
        ]);

        //Tambillos

        Neighborhood::create([
            'id' => 5572,
            'name' => 'Tambillos',
            'city_id' => 2432,

        ]);

       //Tanques

        Neighborhood::create([
            'id' => 5573,
            'name' => 'Tanques',
            'city_id' => 2433,

        ]);

        //Tilcara

        Neighborhood::create([
            'id' => 5574,
            'name' => 'Tilcara',
            'city_id' => 2434,

        ]);

        //Tilquiza

        Neighborhood::create([
            'id' => 5575,
            'name' => 'Tilquiza',
            'city_id' => 2435,

        ]);

        //Timon Cruz

        Neighborhood::create([
            'id' => 5576,
            'name' => 'Timon Cruz',
            'city_id' => 2436,

        ]);

        //Tiomayo

        Neighborhood::create([
            'id' => 5577,
            'name' => 'Tiomayo',
            'city_id' => 2437,

        ]);

        //Tiraxi

        Neighborhood::create([
            'id' => 5578,
            'name' => 'Tiraxi',
            'city_id' => 2438,

        ]);

        //Toquero

        Neighborhood::create([
            'id' => 5579,
            'name' => 'Toquero',
            'city_id' => 2439,

        ]);

        //Tres Cruces

        Neighborhood::create([
            'id' => 5580,
            'name' => 'Tres Cruces',
            'city_id' => 2440,

        ]);

        //Tumbaya

        Neighborhood::create([
            'id' => 5581,
            'name' => 'Tumbaya',
            'city_id' => 2441,

        ]);

        //Turilari

        Neighborhood::create([
            'id' => 5582,
            'name' => 'Turilari',
            'city_id' => 2442,

        ]);

        //Tusaquilla

        Neighborhood::create([
            'id' => 5583,
            'name' => 'Tusaquilla',
            'city_id' => 2443,

        ]);

        //Tusaquillas

        Neighborhood::create([
            'id' => 5584,
            'name' => 'Tusaquillas',
            'city_id' => 2444,

        ]);

        //Ucumaso

        Neighborhood::create([
            'id' => 5585,
            'name' => 'Ucumaso',
            'city_id' => 2445,

        ]);

        //Uquia

        Neighborhood::create([
            'id' => 5586,
            'name' => 'Uquia',
            'city_id' => 2446,

        ]);

        //Valle Colorado

        Neighborhood::create([
            'id' => 5587,
            'name' => 'Valle Colorado',
            'city_id' => 2447,

        ]);

        //Valle Grande

        Neighborhood::create([
            'id' => 5588,
            'name' => 'Valle Grande',
            'city_id' => 2448,

        ]);

        //Veintitres de Agosto

        Neighborhood::create([
            'id' => 5589,
            'name' => 'Veintitres de Agosto',
            'city_id' => 2449,

        ]);

        //Villa Jardin de Reyes

        Neighborhood::create([
            'id' => 5590,
            'name' => 'Villa Jardin de Reyes',
            'city_id' => 2450,

        ]);

        //Villa Palpalá

        Neighborhood::create([
            'id' => 5591,
            'name' => 'Villa Palpalá',
            'city_id' => 2451,

        ]);

        //Vinalito

        Neighborhood::create([
            'id' => 5592,
            'name' => 'Vinalito',
            'city_id' => 2452,

        ]);

        //Vizcarra

        Neighborhood::create([
            'id' => 5593,
            'name' => 'Vizcarra',
            'city_id' => 2453,

        ]);

        //Volcán

        Neighborhood::create([
            'id' => 5594,
            'name' => 'Volcán',
            'city_id' => 2454,

        ]);

        //Yala (1923 hab)

        Neighborhood::create([
            'id' => 5595,
            'name' => 'Yala (1923 hab)',
            'city_id' => 2455,

        ]);

        //Yavi

        Neighborhood::create([
            'id' => 5596,
            'name' => 'Yavi',
            'city_id' => 2456,

        ]);

        //Yavi Chico

        Neighborhood::create([
            'id' => 5597,
            'name' => 'Yavi Chico',
            'city_id' => 2457,

        ]);

        //Yoscaba

        Neighborhood::create([
            'id' => 5598,
            'name' => 'Yoscaba',
            'city_id' => 2458,

        ]);

        //Yuto

        Neighborhood::create([
            'id' => 5599,
            'name' => 'Yuto',
            'city_id' => 2459,

        ]);

        //La Pampa

        Neighborhood::create([
            'id' => 5600,
            'name' => 'Santa Rosa',
            'city_id' => 2460,

        ]);

        //Toay

        Neighborhood::create([
            'id' => 5601,
            'name' => 'Toay',
            'city_id' => 2461,

        ]);

        //Conhelo

        Neighborhood::create([
            'id' => 5602,
            'name' => 'Conhelo',
            'city_id' => 2462,

        ]);

        //Puelén

        Neighborhood::create([
            'id' => 5603,
            'name' => 'Puelén',
            'city_id' => 2463,

        ]);

        //Limay Mahuida

        Neighborhood::create([
            'id' => 5604,
            'name' => 'Limay Mahuida',
            'city_id' => 2464,

        ]);

        //Abramo

        Neighborhood::create([
            'id' => 5605,
            'name' => 'Abramo',
            'city_id' => 2465,

        ]);

        //Adolfo Van Praet

        Neighborhood::create([
            'id' => 5606,
            'name' => 'Adolfo Van Praet',
            'city_id' => 2466,

        ]);

        //Agustoni

        Neighborhood::create([
            'id' => 5607,
            'name' => 'Agustoni',
            'city_id' => 2466,

        ]);

        //Algarrobo del Águila

        Neighborhood::create([
            'id' => 5608,
            'name' => 'Algarrobo del Águila',
            'city_id' => 2467,

        ]);

        //Alpachiri

        Neighborhood::create([
            'id' => 5609,
            'name' => 'Alpachiri',
            'city_id' => 2468,

        ]);

        //Alta Italia

        Neighborhood::create([
            'id' => 5610,
            'name' => 'Alta Italia',
            'city_id' => 2469,

        ]);

        //Anguil

        Neighborhood::create([
            'id' => 5611,
            'name' => 'Anguil',
            'city_id' => 2470,

        ]);

        //Anzoategui

        Neighborhood::create([
            'id' => 5612,
            'name' => 'Anzoategui',
            'city_id' => 2471,

        ]);

        //Arata

        Neighborhood::create([
            'id' => 5613,
            'name' => 'Arata',
            'city_id' => 2472,

        ]);

        //Ataliva Roca

        Neighborhood::create([
            'id' => 5614,
            'name' => 'Ataliva Roca',
            'city_id' => 2473,

        ]);

        //Bernardo Larroude

        Neighborhood::create([
            'id' => 5615,
            'name' => ' Bernardo Larroude',
            'city_id' => 2474,

        ]);

        //Bernasconi

        Neighborhood::create([
            'id' => 5616,
            'name' => 'Bernasconi',
            'city_id' => 2475,

        ]);

        //Caleufú

        Neighborhood::create([
            'id' => 5617,
            'name' => 'Caleufú',
            'city_id' => 2476,

        ]);

        //Carro Quemado

        Neighborhood::create([
            'id' => 5618,
            'name' => 'Carro Quemado',
            'city_id' => 2477,

        ]);

        //Casa de Piedra

        Neighborhood::create([
            'id' => 5619,
            'name' => 'Casa de Piedra',
            'city_id' => 2478,

        ]);

        //Catriló

        Neighborhood::create([
            'id' => 5620,
            'name' => 'Catriló',
            'city_id' => 2479,

        ]);

        //Ceballos

        Neighborhood::create([
            'id' => 5621,
            'name' => 'Ceballos',
            'city_id' => 2480,

        ]);

        //Chacharramendi

        Neighborhood::create([
            'id' => 5622,
            'name' => 'Chacharramendi',
            'city_id' => 2481,

        ]);

        //Colonia Barón

        Neighborhood::create([
            'id' => 5623,
            'name' => 'Colonia Barón',
            'city_id' => 2482,

        ]);

        //Colonia San José

        Neighborhood::create([
            'id' => 5624,
            'name' => 'Colonia San José',
            'city_id' => 2483,

        ]);

        //Colonia Santa María

        Neighborhood::create([
            'id' => 5625,
            'name' => 'Colonia Santa María',
            'city_id' => 2484,

        ]);

        //Coronel Hilario Lagos

        Neighborhood::create([
            'id' => 5626,
            'name' => 'Coronel Hilario Lagos',
            'city_id' => 2485,

        ]);

        //Cuchillo - Có

        Neighborhood::create([
            'id' => 5627,
            'name' => 'Cuchillo - Có',
            'city_id' => 2486,

        ]);

        //Doblas

        Neighborhood::create([
            'id' => 5628,
            'name' => 'Doblas',
            'city_id' => 2487,

        ]);

        //Dorila

        Neighborhood::create([
            'id' => 5629,
            'name' => 'Dorila',
            'city_id' => 2488,

        ]);

        //Eduardo Castex

        Neighborhood::create([
            'id' => 5630,
            'name' => 'Eduardo Castex',
            'city_id' => 2489,

        ]);

        //Embajador Martini

        Neighborhood::create([
            'id' => 5631,
            'name' => 'Embajador Martini',
            'city_id' => 2490,

        ]);

        //Falucho

        Neighborhood::create([
            'id' => 5632,
            'name' => 'Falucho',
            'city_id' => 2491,

        ]);

        //General Acha

        Neighborhood::create([
            'id' => 5633,
            'name' => 'General Acha',
            'city_id' => 2492,

        ]);

        //General Manuel Campos

        Neighborhood::create([
            'id' => 5634,
            'name' => 'General Manuel Campos',
            'city_id' => 2493,

        ]);


        //General San Martín

        Neighborhood::create([
            'id' => 5636,
            'name' => 'General San Martín',
            'city_id' => 2494,

        ]);

        //Gobernador Duval

        Neighborhood::create([
            'id' => 5637,
            'name' => 'Gobernador Duval',
            'city_id' => 2495,

        ]);

        //Guatraché

        Neighborhood::create([
            'id' => 5638,
            'name' => 'Guatraché',
            'city_id' => 2496,

        ]);

        //Hucal

        Neighborhood::create([
            'id' => 5639,
            'name' => 'Hucal',
            'city_id' => 2497,

        ]);

        //Ingeniero Foster

        Neighborhood::create([
            'id' => 5640,
            'name' => 'Ingeniero Foster',
            'city_id' => 2498,

        ]);

        //Ingeniero Luiggi

        Neighborhood::create([
            'id' => 5641,
            'name' => 'Ingeniero Luiggi',
            'city_id' => 2499,

        ]);

        //Intendente Alvear

        Neighborhood::create([
            'id' => 5642,
            'name' => 'Intendente Alvear',
            'city_id' => 2500,

        ]);

        //Jacinto Aráuz

        Neighborhood::create([
            'id' => 5643,
            'name' => 'Jacinto Aráuz',
            'city_id' => 2501,

        ]);

        //La Adela

        Neighborhood::create([
            'id' => 5644,
            'name' => 'La Adela',
            'city_id' => 2502,

        ]);

        //La Gloria

        Neighborhood::create([
            'id' => 5645,
            'name' => 'La Gloria',
            'city_id' => 2503,

        ]);

        //La Humada

        Neighborhood::create([
            'id' => 5646,
            'name' => 'La Humada',
            'city_id' => 2504,

        ]);

        //La Maruja

        Neighborhood::create([
            'id' => 5647,
            'name' => 'La Maruja',
            'city_id' => 2505,

        ]);

        //La Reforma

        Neighborhood::create([
            'id' => 5648,
            'name' => 'La Reforma',
            'city_id' => 2506,

        ]);

        //Lonquimay

        Neighborhood::create([
            'id' => 5649,
            'name' => 'Lonquimay',
            'city_id' => 2507,

        ]);

        //Loventué

        Neighborhood::create([
            'id' => 5650,
            'name' => 'Loventué',
            'city_id' => 2508,

        ]);

        //Luan Toro

        Neighborhood::create([
            'id' => 5651,
            'name' => 'Luan Toro',
            'city_id' => 2509,

        ]);

        //Macachín

        Neighborhood::create([
            'id' => 5652,
            'name' => 'Macachín',
            'city_id' => 2510,

        ]);

        //Maisonnave

        Neighborhood::create([
            'id' => 5653,
            'name' => 'Maisonnave',
            'city_id' => 2511,

        ]);

        //Mauricio Mayer

        Neighborhood::create([
            'id' => 5654,
            'name' => 'Mauricio Mayer',
            'city_id' => 2512,

        ]);

        //Metileo

        Neighborhood::create([
            'id' => 5655,
            'name' => 'Metileo',
            'city_id' => 2513,

        ]);

        //Miguel Cané

        Neighborhood::create([
            'id' => 5656,
            'name' => 'Miguel Cané',
            'city_id' => 2514,

        ]);

        //Miguel Riglos

        Neighborhood::create([
            'id' => 5657,
            'name' => 'Miguel Riglos',
            'city_id' => 2515,

        ]);

        //Monte Nievas

        Neighborhood::create([
            'id' => 5658,
            'name' => 'Monte Nievas',
            'city_id' => 2516,

        ]);

        //Naicó

        Neighborhood::create([
            'id' => 5659,
            'name' => 'Naicó',
            'city_id' => 2517,

        ]);

        //Ojeda

        Neighborhood::create([
            'id' => 5660,
            'name' => 'Ojeda',
            'city_id' => 2518,

        ]);


        //Parera

        Neighborhood::create([
            'id' => 5662,
            'name' => 'Parera',
            'city_id' => 2520,

        ]);

        //Perú

        Neighborhood::create([
            'id' => 5663,
            'name' => 'Perú',
            'city_id' => 2521,

        ]);

        //Pichi Huinca

        Neighborhood::create([
            'id' => 5664,
            'name' => 'Pichi Huinca',
            'city_id' => 2522,

        ]);

        //Puelches

        Neighborhood::create([
            'id' => 5665,
            'name' => 'Puelches',
            'city_id' => 2523,

        ]);

        //Quehué

        Neighborhood::create([
            'id' => 5666,
            'name' => 'Quehué',
            'city_id' => 2524,

        ]);

        //Quemú Quemú

        Neighborhood::create([
            'id' => 5667,
            'name' => 'Quemú Quemú',
            'city_id' => 2525,

        ]);

        //Quetrequén

        Neighborhood::create([
            'id' => 5668,
            'name' => 'Quetrequén',
            'city_id' => 2526,

        ]);

        //Rancul

        Neighborhood::create([
            'id' => 5669,
            'name' => 'Rancul',
            'city_id' => 2527,

        ]);

        //Realicó

        Neighborhood::create([
            'id' => 5670,
            'name' => 'Realicó',
            'city_id' => 2528,

        ]);

        //Relmo

        Neighborhood::create([
            'id' => 5671,
            'name' => 'Relmo',
            'city_id' => 2529,

        ]);

        //Rolón

        Neighborhood::create([
            'id' => 5672,
            'name' => 'Rolón',
            'city_id' => 2530,

        ]);

        //Rucanelo

        Neighborhood::create([
            'id' => 5673,
            'name' => 'Rucanelo',
            'city_id' => 2531,

        ]);

        //Santa Isabel

        Neighborhood::create([
            'id' => 5674,
            'name' => 'Santa Isabel',
            'city_id' => 2532,

        ]);

        //Santa Teresa

        Neighborhood::create([
            'id' => 5675,
            'name' => 'Santa Tersa',
            'city_id' => 2533,

        ]);

        //Sarah

        Neighborhood::create([
            'id' => 5676,
            'name' => 'Sarah',
            'city_id' => 2534,

        ]);

        //Speluzzi

        Neighborhood::create([
            'id' => 5677,
            'name' => 'Speluzzi',
            'city_id' => 2535,

        ]);

        //Telén

        Neighborhood::create([
            'id' => 5678,
            'name' => 'Telén',
            'city_id' => 2536,

        ]);

        //Tomás Manuel de Anchorena

        Neighborhood::create([
            'id' => 5679,
            'name' => 'Tomás Manuel de Anchorena',
            'city_id' => 2537,

        ]);

        //Trebolares

        Neighborhood::create([
            'id' => 5680,
            'name' => 'Trebolares',
            'city_id' => 2538,

        ]);

        //Trenel

        Neighborhood::create([
            'id' => 5681,
            'name' => 'Trenel',
            'city_id' => 2539,

        ]);

        //Unanue

        Neighborhood::create([
            'id' => 5682,
            'name' => 'Unanue',
            'city_id' => 2540,

        ]);

        //Uriburu

        Neighborhood::create([
            'id' => 5683,
            'name' => 'Uriburu',
            'city_id' => 2541,

        ]);

        //Veinticinco de Mayo

        Neighborhood::create([
            'id' => 5684,
            'name' => 'Veinticinco de Mayo',
            'city_id' => 2542,

        ]);

        //Victorica

        Neighborhood::create([
            'id' => 5685,
            'name' => 'Victorica',
            'city_id' => 2543,

        ]);

        //Villa Mirasol

        Neighborhood::create([
            'id' => 5686,
            'name' => 'Villa Marisol',
            'city_id' => 2544,

        ]);

        //Vértiz

        Neighborhood::create([
            'id' => 5687,
            'name' => 'Vértiz',
            'city_id' => 2545,

        ]);

        //Winifreda

        Neighborhood::create([
            'id' => 5688,
            'name' => 'Winifreda',
            'city_id' => 2546,

        ]);

        //La Rioja

        Neighborhood::create([
            'id' => 5689,
            'name' => 'Monte Grande',
            'city_id' => 2547,

        ]);

        //Campanas

        Neighborhood::create([
            'id' => 5690,
            'name' => 'Campanas',
            'city_id' => 2548,

        ]);

        //La Rioja

        Neighborhood::create([
            'id' => 5691,
            'name' => 'La Rioja',
            'city_id' => 2549,

        ]);

        //Chilecito

        Neighborhood::create([
            'id' => 5692,
            'name' => 'Chilecito',
            'city_id' => 2550,

        ]);

        //Miraflores

        Neighborhood::create([
            'id' => 5693,
            'name' => 'Miraflores',
            'city_id' => 2551,

        ]);

        //Agua Blanca

        Neighborhood::create([
            'id' => 5694,
            'name' => 'Agua Blanca',
            'city_id' => 2552,

        ]);

        //Aguayo

        Neighborhood::create([
            'id' => 5695,
            'name' => 'Aguayo',
            'city_id' => 2553,

        ]);

        //Aicuña

        Neighborhood::create([
            'id' => 5696,
            'name' => 'Aicuña',
            'city_id' => 2554,

        ]);

        //Aimogasta

        Neighborhood::create([
            'id' => 5697,
            'name' => 'Aimogasta',
            'city_id' => 2555,

        ]);

        //Alcázar

        Neighborhood::create([
            'id' => 5698,
            'name' => 'Alcázar',
            'city_id' => 2556,

        ]);

        //Alpasinche

        Neighborhood::create([
            'id' => 5699,
            'name' => 'Alpasinche',
            'city_id' => 2557,

        ]);

        //Alta Gracia

        Neighborhood::create([
            'id' => 5700,
            'name' => 'Alta Gracia',
            'city_id' => 2558,

        ]);

        //Alto Carrizal

        Neighborhood::create([
            'id' => 5701,
            'name' => 'Alto Carrizal',
            'city_id' => 2559,

        ]);

        //Amaná

        Neighborhood::create([
            'id' => 5702,
            'name' => 'Amaná',
            'city_id' => 2560,

        ]);

        //Ambil

        Neighborhood::create([
            'id' => 5703,
            'name' => 'Ambil',
            'city_id' => 2561,

        ]);

        //Aminga

        Neighborhood::create([
            'id' => 5704,
            'name' => 'Aminga',
            'city_id' => 2562,

        ]);

        //Amuschina

        Neighborhood::create([
            'id' => 5705,
            'name' => 'Amuschina',
            'city_id' => 2563,

        ]);

        //Andolucas

        Neighborhood::create([
            'id' => 5706,
            'name' => 'Andolucas',
            'city_id' => 2564,

        ]);

        //Anillaco

        Neighborhood::create([
            'id' => 5707,
            'name' => 'Anillaco',
            'city_id' => 2565,

        ]);

        //Anjullón

        Neighborhood::create([
            'id' => 5708,
            'name' => 'Anjullón',
            'city_id' => 2566,

        ]);

        //Antinaco

        Neighborhood::create([
            'id' => 5709,
            'name' => 'Antinaco',
            'city_id' => 2567,

        ]);

        //Arauco

        Neighborhood::create([
            'id' => 5710,
            'name' => 'Arauco',
            'city_id' => 2568,

        ]);

        //Bajo Carrizal

        Neighborhood::create([
            'id' => 5711,
            'name' => 'Bajo Carrizal',
            'city_id' => 2569,

        ]);

        //Bajo Hondo

        Neighborhood::create([
            'id' => 5712,
            'name' => 'Bajo Hondo',
            'city_id' => 2570,

        ]);

        //Banda Florida

        Neighborhood::create([
            'id' => 5713,
            'name' => 'Banda Florida',
            'city_id' => 2571,

        ]);

        //Bazán

        Neighborhood::create([
            'id' => 5714,
            'name' => 'Bazán',
            'city_id' => 2572,

        ]);

        //Bañado de los Pantanos

        Neighborhood::create([
            'id' => 5715,
            'name' => 'Bañado de los Pantanos',
            'city_id' => 2573,

        ]);

        //Bella Vista

        Neighborhood::create([
            'id' => 5716,
            'name' => 'Bella Vista',
            'city_id' => 2574,

        ]);

        //Carrizal

        Neighborhood::create([
            'id' => 5717,
            'name' => 'Carrizal',
            'city_id' => 2575,

        ]);

        //Castro Barros

        Neighborhood::create([
            'id' => 5718,
            'name' => 'Castro Barros',
            'city_id' => 2576,

        ]);

        //Cebollar

        Neighborhood::create([
            'id' => 5719,
            'name' => 'Cebollar',
            'city_id' => 2577,

        ]);

        //Chamical

        Neighborhood::create([
            'id' => 5720,
            'name' => 'Chamical',
            'city_id' => 2578,

        ]);

        //Chaupihuasi

        Neighborhood::create([
            'id' => 5721,
            'name' => 'Chuapihuasi',
            'city_id' => 2579,

        ]);

        //Chañar

        Neighborhood::create([
            'id' => 5722,
            'name' => 'Chañar',
            'city_id' => 2580,

        ]);

        //Chañarmuyo

        Neighborhood::create([
            'id' => 5723,
            'name' => 'Chañarmuyo',
            'city_id' => 2581,

        ]);

        //Chepes

        Neighborhood::create([
            'id' => 5724,
            'name' => 'Chepes',
            'city_id' => 2582,

        ]);

        //Chila

        Neighborhood::create([
            'id' => 5725,
            'name' => 'Chila',
            'city_id' => 2583,

        ]);

        //Chuquis

        Neighborhood::create([
            'id' => 5726,
            'name' => 'Chuquis',
            'city_id' => 2584,

        ]);

        //Colonia Ortiz de Ocampo

        Neighborhood::create([
            'id' => 5727,
            'name' => 'Colonia Ortiz de Ocampo',
            'city_id' => 2585,

        ]);

        //Comandante Leal

        Neighborhood::create([
            'id' => 5728,
            'name' => 'Comandante Leal',
            'city_id' => 2586,

        ]);

        //Corral de Isaac

        Neighborhood::create([
            'id' => 5729,
            'name' => 'Corral de Isaac',
            'city_id' => 2587,

        ]);

        //Cortaderas

        Neighborhood::create([
            'id' => 5730,
            'name' => 'Cortaderas',
            'city_id' => 2588,

        ]);

        //Cuatro Esquinas

        Neighborhood::create([
            'id' => 5731,
            'name' => 'Cuatro Esquinas',
            'city_id' => 2589,

        ]);

        //Cuipán

        Neighborhood::create([
            'id' => 5732,
            'name' => 'Cuipán',
            'city_id' => 2590,

        ]);

        //Desiderio Tello

        Neighborhood::create([
            'id' => 5733,
            'name' => 'Desiderio Tello',
            'city_id' => 2591,

        ]);

        //El Caldén

        Neighborhood::create([
            'id' => 5734,
            'name' => 'El Caldén',
            'city_id' => 2592,

        ]);

        //El Condado

        Neighborhood::create([
            'id' => 5735,
            'name' => 'El Condado',
            'city_id' => 2593,

        ]);

        //El Estanquito

        Neighborhood::create([
            'id' => 5736,
            'name' => 'El Estanquito',
            'city_id' => 2594,

        ]);

        //El Fraile

        Neighborhood::create([
            'id' => 5737,
            'name' => 'El Fraile',
            'city_id' => 2595,

        ]);

        //El Médano

        Neighborhood::create([
            'id' => 5738,
            'name' => 'El Médano',
            'city_id' => 2596,

        ]);

        //El Quemado

        Neighborhood::create([
            'id' => 5739,
            'name' => 'El Quemado',
            'city_id' => 2597,

        ]);

        //El Retamo

        Neighborhood::create([
            'id' => 5740,
            'name' => 'El Retamo',
            'city_id' => 2598,

        ]);

        //El Tala

        Neighborhood::create([
            'id' => 5741,
            'name' => 'El Tala',
            'city_id' => 2599,

        ]);

        //El Totoral

        Neighborhood::create([
            'id' => 5742,
            'name' => 'El Totoral',
            'city_id' => 2600,

        ]);

        //Esperanza de los Cerrillos

        Neighborhood::create([
            'id' => 5743,
            'name' => 'Esperanza de los Cerrillos',
            'city_id' => 2601,

        ]);

        //Esquina del Norte

        Neighborhood::create([
            'id' => 5744,
            'name' => 'Esquina del Norte',
            'city_id' => 2602,

        ]);

        //Estación Mazán

        Neighborhood::create([
            'id' => 5745,
            'name' => 'Estacíon Mazán',
            'city_id' => 2603,

        ]);

        //Famatina

        Neighborhood::create([
            'id' => 5746,
            'name' => 'Famatina',
            'city_id' => 2604,

        ]);

        //Guandacol

        Neighborhood::create([
            'id' => 5747,
            'name' => 'Guandacol',
            'city_id' => 2605,

        ]);

        //Huaco

        Neighborhood::create([
            'id' => 5748,
            'name' => 'Huaco',
            'city_id' => 2606,

        ]);

        //Jagüé

        Neighborhood::create([
            'id' => 5749,
            'name' => 'Jagüe',
            'city_id' => 2607,

        ]);

        //La Aguadita

        Neighborhood::create([
            'id' => 5750,
            'name' => 'La Aguadita',
            'city_id' => 2608,

        ]);

        //La Banda

        Neighborhood::create([
            'id' => 5751,
            'name' => 'La Banda',
            'city_id' => 2609,

        ]);

        //La Cuadra

        Neighborhood::create([
            'id' => 5752,
            'name' => 'La Cuadra',
            'city_id' => 2610,

        ]);

        //La Ramadita

        Neighborhood::create([
            'id' => 5753,
            'name' => 'La Ramadita',
            'city_id' => 2611,

        ]);

        //Las Jarillas

        Neighborhood::create([
            'id' => 5754,
            'name' => 'Las Jarillas',
            'city_id' => 2612,

        ]);

        //Las Peñas

        Neighborhood::create([
            'id' => 5755,
            'name' => 'Las Peñas',
            'city_id' => 2613,

        ]);

        //Las Talas

        Neighborhood::create([
            'id' => 5756,
            'name' => 'Las Talas',
            'city_id' => 2614,

        ]);

        //Las Toscas

        Neighborhood::create([
            'id' => 5757,
            'name' => 'Las Toscas',
            'city_id' => 2615,

        ]);

        //Loma Blanca

        Neighborhood::create([
            'id' => 5758,
            'name' => 'Loma Blanca',
            'city_id' => 2616,

        ]);

        //Los Aguirres

        Neighborhood::create([
            'id' => 5759,
            'name' => 'Los Aguirres',
            'city_id' => 2617,

        ]);

        //Los Alanices

        Neighborhood::create([
            'id' => 5760,
            'name' => 'Los Alanices',
            'city_id' => 2618,

        ]);

        //Los Colorados

        Neighborhood::create([
            'id' => 5761,
            'name' => 'Los Colorados',
            'city_id' => 2619,

        ]);

        //Los Molinos

        Neighborhood::create([
            'id' => 5762,
            'name' => 'Los Molinos',
            'city_id' => 2620,

        ]);

        //Los Palacios

        Neighborhood::create([
            'id' => 5763,
            'name' => 'Los Palacios',
            'city_id' => 2621,

        ]);

        //Los Robles

        Neighborhood::create([
            'id' => 5764,
            'name' => 'Los Robles',
            'city_id' => 2622,

        ]);

        //Los Tambillos

        Neighborhood::create([
            'id' => 5765,
            'name' => 'Los Tambillos',
            'city_id' => 2623,

        ]);

        //Machigasta

        Neighborhood::create([
            'id' => 5766,
            'name' => 'Machigasta',
            'city_id' => 2624,

        ]);

        //Malanzán

        Neighborhood::create([
            'id' => 5767,
            'name' => 'Malanzán',
            'city_id' => 2625,

        ]);

        //Mascasín

        Neighborhood::create([
            'id' => 5768,
            'name' => 'Mascasín',
            'city_id' => 2626,

        ]);

        //Milagro

        Neighborhood::create([
            'id' => 5769,
            'name' => 'Milagro',
            'city_id' => 2627,

        ]);

        //Nácate

        Neighborhood::create([
            'id' => 5770,
            'name' => 'Nácate',
            'city_id' => 2628,

        ]);

        //Olpas

        Neighborhood::create([
            'id' => 5771,
            'name' => 'Olpas',
            'city_id' => 2629,

        ]);

        //Olta

        Neighborhood::create([
            'id' => 5772,
            'name' => 'Olta',
            'city_id' => 2630,

        ]);


        //Pagancillo

        Neighborhood::create([
            'id' => 5774,
            'name' => 'Pagancillo',
            'city_id' => 2632,

        ]);

        //Paganzo

        Neighborhood::create([
            'id' => 5775,
            'name' => 'Paganzo',
            'city_id' => 2633,

        ]);

        //Patquía

        Neighborhood::create([
            'id' => 5776,
            'name' => 'Patquía',
            'city_id' => 2634,

        ]);

        //Pinchas

        Neighborhood::create([
            'id' => 5777,
            'name' => 'Pinchas',
            'city_id' => 2635,

        ]);

        //Pituil

        Neighborhood::create([
            'id' => 5778,
            'name' => 'Pituil',
            'city_id' => 2636,

        ]);

        //Plaza Vieja

        Neighborhood::create([
            'id' => 5779,
            'name' => 'Plaza Vieja',
            'city_id' => 2637,

        ]);

        //Polco

        Neighborhood::create([
            'id' => 5780,
            'name' => 'Polco',
            'city_id' => 2638,

        ]);

        //Portezuelo

        Neighborhood::create([
            'id' => 5781,
            'name' => 'Portezuelo',
            'city_id' => 2639,

        ]);

        //Potrero Grande

        Neighborhood::create([
            'id' => 5782,
            'name' => 'Potrero Grande',
            'city_id' => 2640,

        ]);

        //Puerto Alegre

        Neighborhood::create([
            'id' => 5783,
            'name' => 'Puerto Alegre',
            'city_id' => 2641,

        ]);

        //Punta de los Llanos

        Neighborhood::create([
            'id' => 5784,
            'name' => 'Punta de los Llanos',
            'city_id' => 2642,

        ]);

        //Retamal

        Neighborhood::create([
            'id' => 5785,
            'name' => 'Retamal',
            'city_id' => 2643,

        ]);

        //Rivadavia

        Neighborhood::create([
            'id' => 5786,
            'name' => 'Rivadavia',
            'city_id' => 2644,

        ]);

        //Salicas

        Neighborhood::create([
            'id' => 5787,
            'name' => 'Salicas',
            'city_id' => 2645,

        ]);

        //San Antonio

        Neighborhood::create([
            'id' => 5788,
            'name' => 'San Antonio',
            'city_id' => 2646,

        ]);

        //San Blas

        Neighborhood::create([
            'id' => 5789,
            'name' => 'San Blas',
            'city_id' => 2647,

        ]);

        //San Isidro

        Neighborhood::create([
            'id' => 5790,
            'name' => 'San Isidro',
            'city_id' => 2648,

        ]);

        //San Javier

        Neighborhood::create([
            'id' => 5791,
            'name' => 'San Javier',
            'city_id' => 2649,

        ]);

        //San Juan

        Neighborhood::create([
            'id' => 5792,
            'name' => 'San Juan',
            'city_id' => 2650,

        ]);

        //San Lorenzo

        Neighborhood::create([
            'id' => 5793,
            'name' => 'San Lorenzo',
            'city_id' => 2651,

        ]);

        //San Pedro

        Neighborhood::create([
            'id' => 5794,
            'name' => 'San Pedro',
            'city_id' => 2652,

        ]);

        //San Ramón

        Neighborhood::create([
            'id' => 5795,
            'name' => 'San Ramón',
            'city_id' => 2653,

        ]);

        //San Solano

        Neighborhood::create([
            'id' => 5796,
            'name' => 'San Solano',
            'city_id' => 2654,

        ]);

        //Santa Bárbara

        Neighborhood::create([
            'id' => 5797,
            'name' => 'Santa Bárbara',
            'city_id' => 2655,

        ]);

        //Santa Clara

        Neighborhood::create([
            'id' => 5798,
            'name' => 'Santa Clara',
            'city_id' => 2656,

        ]);

        //Santa Cruz

        Neighborhood::create([
            'id' => 5799,
            'name' => 'Santa Cruz',
            'city_id' => 2657,

        ]);

        //Santa Rita de la Zanja

        Neighborhood::create([
            'id' => 5800,
            'name' => 'Santa Rita de la Zanja',
            'city_id' => 2658,

        ]);

        //Santa Vera Cruz

        Neighborhood::create([
            'id' => 5801,
            'name' => 'Santa Vera Cruz',
            'city_id' => 2659,

        ]);

        //Santo Domingo

        Neighborhood::create([
            'id' => 5802,
            'name' => 'Santo Domingo',
            'city_id' => 2660,

        ]);

        //Shaqui

        Neighborhood::create([
            'id' => 5803,
            'name' => 'Shaqui',
            'city_id' => 2661,

        ]);

        //Sierra Brava

        Neighborhood::create([
            'id' => 5804,
            'name' => 'Sierra Brava',
            'city_id' => 2662,

        ]);

        //Sierra de los Quinteros

        Neighborhood::create([
            'id' => 5805,
            'name' => 'Sierra de los Quinteros',
            'city_id' => 2663,

        ]);

        //Simbolar

        Neighborhood::create([
            'id' => 5806,
            'name' => 'Simbolar',
            'city_id' => 2664,

        ]);

        //Suriyaco

        Neighborhood::create([
            'id' => 5807,
            'name' => 'Suriyaco',
            'city_id' => 2665,

        ]);

        //Talamuyuna

        Neighborhood::create([
            'id' => 5808,
            'name' => 'Talamuyuna',
            'city_id' => 2666,

        ]);

        //Tama

        Neighborhood::create([
            'id' => 5809,
            'name' => 'Tama',
            'city_id' => 2667,

        ]);

        //Termas de Santa Teresita

        Neighborhood::create([
            'id' => 5810,
            'name' => 'Termas de Santa Teresita',
            'city_id' => 2668,

        ]);

        //Trampas del Tigre

        Neighborhood::create([
            'id' => 5811,
            'name' => 'Trampas del Tigre',
            'city_id' => 2669,

        ]);

        //Tuizón

        Neighborhood::create([
            'id' => 5812,
            'name' => 'Tuizón',
            'city_id' => 2670,

        ]);

        //Tuyubil

        Neighborhood::create([
            'id' => 5813,
            'name' => 'Tuyubil',
            'city_id' => 2671,

        ]);

        //Udpinango

        Neighborhood::create([
            'id' => 5814,
            'name' => 'Udpinango',
            'city_id' => 2672,

        ]);

        //Ulapes

        Neighborhood::create([
            'id' => 5815,
            'name' => 'Ulapes',
            'city_id' => 2673,

        ]);

        //Valle Hermoso

        Neighborhood::create([
            'id' => 5816,
            'name' => 'Valle Hermoso',
            'city_id' => 2674,

        ]);

        //Villa Bustos

        Neighborhood::create([
            'id' => 5817,
            'name' => 'Villa Bustos',
            'city_id' => 2675,

        ]);

        //Villa Castelli

        Neighborhood::create([
            'id' => 5818,
            'name' => 'Villa Castelli',
            'city_id' => 2676,

        ]);

        //Villa Mazán

        Neighborhood::create([
            'id' => 5819,
            'name' => 'Villa Mazán',
            'city_id' => 2677,

        ]);

        //Villa San José de Vinchina

        Neighborhood::create([
            'id' => 5820,
            'name' => 'Villa San José de Vinchina',
            'city_id' => 2678,

        ]);

        //Villa Sanagasta

        Neighborhood::create([
            'id' => 5821,
            'name' => 'Villa Sanagasta',
            'city_id' => 2679,

        ]);

        //Villa Santa Rita de Catuna

        Neighborhood::create([
            'id' => 5822,
            'name' => 'Villa Santa Rita Catuna',
            'city_id' => 2680,

        ]);

        //Villa Unión

        Neighborhood::create([
            'id' => 5823,
            'name' => 'Villa Unión',
            'city_id' => 2681,

        ]);

        //Ángulos

        Neighborhood::create([
            'id' => 5824,
            'name' => 'Ángulos',
            'city_id' => 2682,

        ]);

        //Ñoqueve

        Neighborhood::create([
            'id' => 5825,
            'name' => 'Ñoqueve',
            'city_id' => 2683,

        ]);

        //Mendoza

        Neighborhood::create([
            'id' => 5826,
            'name' => 'Ciudad de Mendoza',
            'city_id' => 2684,

        ]);

        //Godoy Cruz

        Neighborhood::create([
            'id' => 5827,
            'name' => 'Villa Hipodromo',
            'city_id' => 2685,

        ]);

        Neighborhood::create([
            'id' => 5828,
            'name' => 'La Carrodilla',
            'city_id' => 2685,

        ]);

        //Luján de Cuyo

        Neighborhood::create([
            'id' => 5829,
            'name' => 'La Puntilla',
            'city_id' => 2686,

        ]);

        Neighborhood::create([
            'id' => 5830,
            'name' => 'Estancia Bulnes',
            'city_id' => 2686,

        ]);

        //San Rafael

        Neighborhood::create([
            'id' => 5831,
            'name' => 'San Rafael',
            'city_id' => 2687,

        ]);

        //Maipú

        Neighborhood::create([
            'id' => 5832,
            'name' => 'Coquimbito',
            'city_id' => 2688,

        ]);

        Neighborhood::create([
            'id' => 5833,
            'name' => 'Luzuriaga',
            'city_id' => 2688,

        ]);

        Neighborhood::create([
            'id' => 5834,
            'name' => 'Villa Mazán',
            'city_id' => 2688,

        ]);

        //Aeroparque

        Neighborhood::create([
            'id' => 5835,
            'name' => 'Aeroparque',
            'city_id' => 2689,

        ]);

        //Agrelo

        Neighborhood::create([
            'id' => 5836,
            'name' => 'Agrelo',
            'city_id' => 2690,

        ]);

        //Agua Escondido

        Neighborhood::create([
            'id' => 5837,
            'name' => 'Agua Escondido',
            'city_id' => 2691,

        ]);

        //Algarrobo Grande

        Neighborhood::create([
            'id' => 5838,
            'name' => 'Algarrobo Grande',
            'city_id' => 2692,

        ]);

        //Alto Verde

        Neighborhood::create([
            'id' => 5839,
            'name' => 'Alto Verde',
            'city_id' => 2693,

        ]);

        //Alvear Oeste

        Neighborhood::create([
            'id' => 5840,
            'name' => 'Alvear Oeste',
            'city_id' => 2694,

        ]);

        //Anchoris

        Neighborhood::create([
            'id' => 5841,
            'name' => 'Anchoris',
            'city_id' => 2695,

        ]);

        //Andrade

        Neighborhood::create([
            'id' => 5842,
            'name' => 'Andrade',
            'city_id' => 2696,

        ]);

        //Barrio Cívico

        Neighborhood::create([
            'id' => 5843,
            'name' => 'Barrio Cívico',
            'city_id' => 2697,

        ]);

        //Belgrano

        Neighborhood::create([
            'id' => 5844,
            'name' => 'Belgrano',
            'city_id' => 2698,

        ]);

        //Bowen

        Neighborhood::create([
            'id' => 5845,
            'name' => 'Bowen',
            'city_id' => 2699,

        ]);

        //Buena Nueva

        Neighborhood::create([
            'id' => 5846,
            'name' => 'Buena Nueva',
            'city_id' => 2700,

        ]);

        //Cacheuta

        Neighborhood::create([
            'id' => 5847,
            'name' => 'Cacheuta',
            'city_id' => 2701,

        ]);

        //Cadetes de Chile

        Neighborhood::create([
            'id' => 5848,
            'name' => 'Cadetes de Chile',
            'city_id' => 2702,

        ]);

        //Campo de los Andes

        Neighborhood::create([
            'id' => 5849,
            'name' => 'Campo de los Andes',
            'city_id' => 2703,

        ]);

        //Capdevilla

        Neighborhood::create([
            'id' => 5850,
            'name' => 'Capdevilla',
            'city_id' => 2704,

        ]);

        //Capilla del Rosario

        Neighborhood::create([
            'id' => 5851,
            'name' => 'Capilla del Rosario',
            'city_id' => 2705,

        ]);

        //Carrodilla

        Neighborhood::create([
            'id' => 5852,
            'name' => 'Carrodilla',
            'city_id' => 2706,

        ]);

        //Cañada Seca

        Neighborhood::create([
            'id' => 5853,
            'name' => 'Cañada Seca',
            'city_id' => 2707,

        ]);

        //Chacras de Coria

        Neighborhood::create([
            'id' => 5854,
            'name' => 'Chacras de Coria',
            'city_id' => 2708,

        ]);

        //Chilecito

        Neighborhood::create([
            'id' => 5855,
            'name' => 'Chilecito',
            'city_id' => 2709,

        ]);

        //Colonia Alvear Oeste

        Neighborhood::create([
            'id' => 5856,
            'name' => 'Colonia Alvear Oeste',
            'city_id' => 2710,

        ]);

        //Colonia Las Rosas

        Neighborhood::create([
            'id' => 5857,
            'name' => 'Colonia Las Rosas',
            'city_id' => 2711,

        ]);

        //Colonia Segovia

        Neighborhood::create([
            'id' => 5858,
            'name' => 'Colonia Segovia',
            'city_id' => 2712,

        ]);

        //Cordón del Plata

        Neighborhood::create([
            'id' => 5859,
            'name' => 'Cordón del Plata',
            'city_id' => 2713,

        ]);

        //Costa de Araujo

        Neighborhood::create([
            'id' => 5860,
            'name' => 'Costa de Araujo',
            'city_id' => 2714,

        ]);

        //Cruz de Piedra

        Neighborhood::create([
            'id' => 5861,
            'name' => 'Cruz de Piedra',
            'city_id' => 2715,

        ]);

        //Cuadro Banegas

        Neighborhood::create([
            'id' => 5862,
            'name' => 'Cuadro Banegas',
            'city_id' => 2716,

        ]);

        //Cuadro Nacional

        Neighborhood::create([
            'id' => 5863,
            'name' => 'Cuadro Nacional',
            'city_id' => 2717,

        ]);

        //Desaguadero

        Neighborhood::create([
            'id' => 5864,
            'name' => 'Desaguadero',
            'city_id' => 2718,

        ]);

        //Doce de Octubre

        Neighborhood::create([
            'id' => 5865,
            'name' => 'Doce de Octubre',
            'city_id' => 2719,

        ]);

        //Dorrego

        Neighborhood::create([
            'id' => 5866,
            'name' => 'Dorrego',
            'city_id' => 2720,

        ]);

        //El Algarrobal

        Neighborhood::create([
            'id' => 5867,
            'name' => 'El Algarrobal',
            'city_id' => 2721,

        ]);

        //El Algarrobo

        Neighborhood::create([
            'id' => 5868,
            'name' => 'El Algarrobo',
            'city_id' => 2722,

        ]);

        //El Bermejo

        Neighborhood::create([
            'id' => 5869,
            'name' => 'El Bermejo',
            'city_id' => 2723,

        ]);

        //El Borbollon

        Neighborhood::create([
            'id' => 5870,
            'name' => 'El Borbollon',
            'city_id' => 2724,

        ]);

        //El Carmen

        Neighborhood::create([
            'id' => 5871,
            'name' => 'El Carmen',
            'city_id' => 2725,

        ]);

        //El Carrizal

        Neighborhood::create([
            'id' => 5872,
            'name' => 'El Carrizal',
            'city_id' => 2726,

        ]);

        //El Cerrito

        Neighborhood::create([
            'id' => 5873,
            'name' => 'El Cerrito',
            'city_id' => 2727,

        ]);

        //El Chilcal

        Neighborhood::create([
            'id' => 5874,
            'name' => 'El Chilcal',
            'city_id' => 2728,

        ]);

        //El Mirador

        Neighborhood::create([
            'id' => 5875,
            'name' => 'El Mirador',
            'city_id' => 2729,

        ]);

        //El Nihuil

        Neighborhood::create([
            'id' => 5876,
            'name' => 'El Nihuil',
            'city_id' => 2730,

        ]);

        //El Pastal

        Neighborhood::create([
            'id' => 5877,
            'name' => 'El Pastal',
            'city_id' => 2731,

        ]);

        //El Peral

        Neighborhood::create([
            'id' => 5878,
            'name' => 'El Peral',
            'city_id' => 2732,

        ]);

        //El Plumerillo

        Neighborhood::create([
            'id' => 5879,
            'name' => 'El Plumerillo',
            'city_id' => 2733,

        ]);

        //El Plumero

        Neighborhood::create([
            'id' => 5880,
            'name' => 'El Plumero',
            'city_id' => 2734,

        ]);

        //El Resguardo

        Neighborhood::create([
            'id' => 5881,
            'name' => 'El Resguardo',
            'city_id' => 2735,

        ]);

        //El Sauce

        Neighborhood::create([
            'id' => 5882,
            'name' => 'El Sauce',
            'city_id' => 2736,

        ]);

        //El Sosneado

        Neighborhood::create([
            'id' => 5883,
            'name' => 'El Sosneado',
            'city_id' => 2737,

        ]);

        //El Totoral

        Neighborhood::create([
            'id' => 5884,
            'name' => 'El Totoral',
            'city_id' => 2738,

        ]);

        //El Tropezón

        Neighborhood::create([
            'id' => 5885,
            'name' => 'El Tropezón',
            'city_id' => 2739,

        ]);

        //El Vergel

        Neighborhood::create([
            'id' => 5886,
            'name' => 'El Vergel',
            'city_id' => 2740,

        ]);

        //El Zampal

        Neighborhood::create([
            'id' => 5887,
            'name' => 'El Zampal',
            'city_id' => 2741,

        ]);

        //El Zampalito

        Neighborhood::create([
            'id' => 5888,
            'name' => 'El Zampalito',
            'city_id' => 2742,

        ]);

        //Kilómetro 11

        Neighborhood::create([
            'id' => 5889,
            'name' => 'Kilómetro 11',
            'city_id' => 2761,

        ]);

        //Kilómetro 8

        Neighborhood::create([
            'id' => 5890,
            'name' => 'Kilómetro 8',
            'city_id' => 2762,

        ]);

        //La Arboleda

        Neighborhood::create([
            'id' => 5891,
            'name' => 'La Arboleda',
            'city_id' => 2763,

        ]);

        //La Asunción

        Neighborhood::create([
            'id' => 5892,
            'name' => 'La Asunción',
            'city_id' => 2764,

        ]);

        //La Carrera

        Neighborhood::create([
            'id' => 5893,
            'name' => 'El Carrera',
            'city_id' => 2765,

        ]);

        //La Central

        Neighborhood::create([
            'id' => 5894,
            'name' => 'La Central',
            'city_id' => 2766,

        ]);

        //La Cieneguita

        Neighborhood::create([
            'id' => 5895,
            'name' => 'La Cieneguita',
            'city_id' => 2767,

        ]);

        //La Colonia

        Neighborhood::create([
            'id' => 5896,
            'name' => 'La Colonia',
            'city_id' => 2768,

        ]);

        //La Consulta

        Neighborhood::create([
            'id' => 5897,
            'name' => 'La Consulta',
            'city_id' => 2769,

        ]);

        //La Dormida

        Neighborhood::create([
            'id' => 5898,
            'name' => 'La Dormida',
            'city_id' => 2770,

        ]);

        //La Gloriosa

        Neighborhood::create([
            'id' => 5899,
            'name' => 'La Gloriosa',
            'city_id' => 2771,

        ]);

        //La Holanda

        Neighborhood::create([
            'id' => 5900,
            'name' => 'La Holanda',
            'city_id' => 2772,

        ]);

        //La Libertad

        Neighborhood::create([
            'id' => 5901,
            'name' => 'La Libertad',
            'city_id' => 2773,

        ]);

        //La Llave

        Neighborhood::create([
            'id' => 5902,
            'name' => 'La Llave',
            'city_id' => 2774,

        ]);

        //La Palmera

        Neighborhood::create([
            'id' => 5903,
            'name' => 'La Palmera',
            'city_id' => 2775,

        ]);

        //La Paz

        Neighborhood::create([
            'id' => 5904,
            'name' => 'La Paz',
            'city_id' => 2776,

        ]);

        //La Pega

        Neighborhood::create([
            'id' => 5905,
            'name' => 'La Pega',
            'city_id' => 2777,

        ]);

        //La Primavera

        Neighborhood::create([
            'id' => 5906,
            'name' => 'La Primavera',
            'city_id' => 2778,

        ]);

        //La Puntilla

        Neighborhood::create([
            'id' => 5907,
            'name' => 'La Puntilla',
            'city_id' => 2779,

        ]);

        //Lagunas del Rosario

        Neighborhood::create([
            'id' => 5908,
            'name' => 'Lagunas del Rosario',
            'city_id' => 2780,

        ]);

        //Las Barrancas

        Neighborhood::create([
            'id' => 5909,
            'name' => 'Las Barrancas',
            'city_id' => 2781,

        ]);

        //Las Catitas

        Neighborhood::create([
            'id' => 5910,
            'name' => 'Las Catitas',
            'city_id' => 2782,

        ]);

        //Las Cañas

        Neighborhood::create([
            'id' => 5911,
            'name' => 'Las Cañas',
            'city_id' => 2783,

        ]);

        //Las Chacritas

        Neighborhood::create([
            'id' => 5912,
            'name' => 'Las Chacritas',
            'city_id' => 2784,

        ]);

        //Las Cuevas

        Neighborhood::create([
            'id' => 5913,
            'name' => 'Las Cuevas',
            'city_id' => 2785,

        ]);

        //Las Heras

        Neighborhood::create([
            'id' => 5914,
            'name' => 'Las Heras',
            'city_id' => 2786,

        ]);

        //Las Leñas

        Neighborhood::create([
            'id' => 5915,
            'name' => 'Las Leñas',
            'city_id' => 2787,

        ]);

        //Las Malvinas

        Neighborhood::create([
            'id' => 5916,
            'name' => 'Las Malvinas',
            'city_id' => 2788,

        ]);

        //Las Paredes

        Neighborhood::create([
            'id' => 5917,
            'name' => 'Las Paredes',
            'city_id' => 2789,

        ]);

        //Las Pintadas

        Neighborhood::create([
            'id' => 5918,
            'name' => 'Las Pintadas',
            'city_id' => 2790,

        ]);

        //Las Tortugas

        Neighborhood::create([
            'id' => 5919,
            'name' => 'Las Tortugas',
            'city_id' => 2791,

        ]);

        //Las Violetas

        Neighborhood::create([
            'id' => 5920,
            'name' => 'Las Violetas',
            'city_id' => 2792,

        ]);

        //Lavalle

        Neighborhood::create([
            'id' => 5921,
            'name' => 'Lavalle',
            'city_id' => 2793,

        ]);

        //Los Barriales

        Neighborhood::create([
            'id' => 5922,
            'name' => 'Los Barriales',
            'city_id' => 2794,

        ]);

        //Los Campamentos

        Neighborhood::create([
            'id' => 5923,
            'name' => 'Los Campamentos',
            'city_id' => 2795,

        ]);

        //Los Chacayes

        Neighborhood::create([
            'id' => 5924,
            'name' => 'Los Chacayes',
            'city_id' => 2796,

        ]);

        //Los Corralitos

        Neighborhood::create([
            'id' => 5925,
            'name' => 'Los Corralitos',
            'city_id' => 2797,

        ]);

        //Los Huarpes

        Neighborhood::create([
            'id' => 5926,
            'name' => 'Los Huarpes',
            'city_id' => 2798,

        ]);

        //Los Sauces

        Neighborhood::create([
            'id' => 5927,
            'name' => 'Los Sauces',
            'city_id' => 2799,

        ]);

        //Los Árboles

        Neighborhood::create([
            'id' => 5928,
            'name' => 'Los Árboles',
            'city_id' => 2800,

        ]);

        //lunlunta

        Neighborhood::create([
            'id' => 5929,
            'name' => 'Lunlunta',
            'city_id' => 2801,

        ]);

        //Malargüe

        Neighborhood::create([
            'id' => 5930,
            'name' => 'Malargüe',
            'city_id' => 2802,

        ]);

        //Mayor Drummond

        Neighborhood::create([
            'id' => 5931,
            'name' => 'Mayor Drummond',
            'city_id' => 2803,

        ]);

        //Medrano

        Neighborhood::create([
            'id' => 5932,
            'name' => 'Mayor Drummond',
            'city_id' => 2804,

        ]);

        //Monte Comán

        Neighborhood::create([
            'id' => 5933,
            'name' => 'Monte Comán',
            'city_id' => 2805,

        ]);

        //Mundo Nuevo

        Neighborhood::create([
            'id' => 5934,
            'name' => 'Mundo Nuevo',
            'city_id' => 2806,

        ]);

        //Nueva Ciudad

        Neighborhood::create([
            'id' => 5935,
            'name' => 'Nueva Ciudad',
            'city_id' => 2807,

        ]);


        //Panquehua

        Neighborhood::create([
            'id' => 5937,
            'name' => 'Panquehua',
            'city_id' => 2809,

        ]);

        //Paramillo

        Neighborhood::create([
            'id' => 5938,
            'name' => 'Paramillo',
            'city_id' => 2810,

        ]);

        //Pareditas

        Neighborhood::create([
            'id' => 5939,
            'name' => 'Pareditas',
            'city_id' => 2811,

        ]);

        //Parque Central

        Neighborhood::create([
            'id' => 5940,
            'name' => 'Parque Central',
            'city_id' => 2812,

        ]);

        //Parque O`Higgins

        Neighborhood::create([
            'id' => 5941,
            'name' => 'Parque O´Higgins',
            'city_id' => 2813,

        ]);

        //Pedro Molina

        Neighborhood::create([
            'id' => 5942,
            'name' => 'Pedro Molina',
            'city_id' => 2814,

        ]);

        //Penitentes

        Neighborhood::create([
            'id' => 5943,
            'name' => 'Penitentes',
            'city_id' => 2815,

        ]);

        //Perdiel

        Neighborhood::create([
            'id' => 5944,
            'name' => 'Perdiel',
            'city_id' => 2816,

        ]);

        //Phillips

        Neighborhood::create([
            'id' => 5945,
            'name' => 'Phillips',
            'city_id' => 2817,

        ]);

        //Piedemonte

        Neighborhood::create([
            'id' => 5946,
            'name' => 'Piedemonte',
            'city_id' => 2818,

        ]);

        //Potrerillos

        Neighborhood::create([
            'id' => 5947,
            'name' => 'Potrerillos',
            'city_id' => 2819,

        ]);

        //Presidente Sarmiento

        Neighborhood::create([
            'id' => 5948,
            'name' => 'Presidente Sarmiento',
            'city_id' => 2820,

        ]);

        //Puente de Hierro

        Neighborhood::create([
            'id' => 5949,
            'name' => 'Puente de Hierro',
            'city_id' => 2821,

        ]);

        //Punta del Agua

        Neighborhood::create([
            'id' => 5950,
            'name' => 'Punta del Agua',
            'city_id' => 2822,

        ]);

        //Rama Caída

        Neighborhood::create([
            'id' => 5951,
            'name' => 'Rama Caída',
            'city_id' => 2823,

        ]);

        //Real del Padre

        Neighborhood::create([
            'id' => 5952,
            'name' => 'Real del Padre',
            'city_id' => 2824,

        ]);

        //Reducción

        Neighborhood::create([
            'id' => 5953,
            'name' => 'Reducción',
            'city_id' => 2825,

        ]);

        //Residencial Los Cerros

        Neighborhood::create([
            'id' => 5954,
            'name' => 'Residencial Los Cerros',
            'city_id' => 2826,

        ]);

        //Residencial Norte

        Neighborhood::create([
            'id' => 5955,
            'name' => 'Residencial Norte',
            'city_id' => 2827,

        ]);

        //Residencial Parque

        Neighborhood::create([
            'id' => 5956,
            'name' => 'Residencial Parque',
            'city_id' => 2828,

        ]);

        //Residencial Sur

        Neighborhood::create([
            'id' => 5957,
            'name' => 'Residencial Sur',
            'city_id' => 2829,

        ]);

        //Rivadavia

        Neighborhood::create([
            'id' => 5958,
            'name' => 'Rivadavia',
            'city_id' => 2830,

        ]);

        //Rodeo de la Cruz

        Neighborhood::create([
            'id' => 5959,
            'name' => 'Rodeo de la Cruz',
            'city_id' => 2831,

        ]);

        //Rodeo del Medio

        Neighborhood::create([
            'id' => 5960,
            'name' => 'Rodeo del Medio',
            'city_id' => 2832,

        ]);

        //Rodríguez Peña

        Neighborhood::create([
            'id' => 5961,
            'name' => 'Rodríguez Peña',
            'city_id' => 2833,

        ]);

        //Russell

        Neighborhood::create([
            'id' => 5962,
            'name' => 'Russell',
            'city_id' => 2834,

        ]);

        //Río Barrancas

        Neighborhood::create([
            'id' => 5963,
            'name' => 'Río Barrancas',
            'city_id' => 2835,

        ]);

        //Río Grande

        Neighborhood::create([
            'id' => 5964,
            'name' => 'Río Grande',
            'city_id' => 2836,

        ]);

        //Salto de las Rosas

        Neighborhood::create([
            'id' => 5965,
            'name' => 'Salto de las Rosas',
            'city_id' => 2837,

        ]);

        //San Agustín

        Neighborhood::create([
            'id' => 5966,
            'name' => 'San Agustín',
            'city_id' => 2838,

        ]);

        //San Carlos

        Neighborhood::create([
            'id' => 5967,
            'name' => 'San Carlos',
            'city_id' => 2839,

        ]);

        //San Francisco

        Neighborhood::create([
            'id' => 5968,
            'name' => 'San Francisco' ,
            'city_id' => 2840,

        ]);

        //San Francisco del Monte

        Neighborhood::create([
            'id' => 5969,
            'name' => 'San Francisco del Monte',
            'city_id' => 2841,

        ]);

        //San Isidro

        Neighborhood::create([
            'id' => 5970,
            'name' => 'San Isidro',
            'city_id' => 2842,

        ]);

        //San José

        Neighborhood::create([
            'id' => 5971,
            'name' => 'San José',
            'city_id' => 2843,

        ]);

        //San José (Mendoza)

        Neighborhood::create([
            'id' => 5972,
            'name' => 'San Jose (Mendoza)',
            'city_id' => 2844,

        ]);

        //San Martín

        Neighborhood::create([
            'id' => 5973,
            'name' => 'San Martín',
            'city_id' => 2845,

        ]);

        //San Miguel

        Neighborhood::create([
            'id' => 5974,
            'name' => 'San Miguel',
            'city_id' => 2846,

        ]);

        //San Pedro del Atuel

        Neighborhood::create([
            'id' => 5975,
            'name' => 'San Pedro del Atuel',
            'city_id' => 2847,

        ]);

        //San Roque

        Neighborhood::create([
            'id' => 5976,
            'name' => 'San Roque',
            'city_id' => 2848,

        ]);

        //Santa Clara (Mendoza)

        Neighborhood::create([
            'id' => 5977,
            'name' => 'Santa Clara (mendoza)',
            'city_id' => 2849,

        ]);

        //Santa María de Oro

        Neighborhood::create([
            'id' => 5978,
            'name' => 'Santa María de Oro',
            'city_id' => 2850,

        ]);

        //Santa Rosa

        Neighborhood::create([
            'id' => 5979,
            'name' => 'Santa Rosa',
            'city_id' => 2851,

        ]);

        //Sierras de Encalada

        Neighborhood::create([
            'id' => 5980,
            'name' => 'Sierras de Encalada',
            'city_id' => 2852,

        ]);

        //Tres de Mayo

        Neighborhood::create([
            'id' => 5981,
            'name' => 'Tres de Mayo',
            'city_id' => 2853,

        ]);

        //Tunuyán

        Neighborhood::create([
            'id' => 5982,
            'name' => 'Tunuyán',
            'city_id' => 2854,

        ]);

        //Tupungato

        Neighborhood::create([
            'id' => 5983,
            'name' => 'Tupungato',
            'city_id' => 2855,

        ]);

        //Ugarteche

        Neighborhood::create([
            'id' => 5984,
            'name' => 'Ugarteche',
            'city_id' => 2856,

        ]);

        //Uspallata

        Neighborhood::create([
            'id' => 5985,
            'name' => 'Uspallata',
            'city_id' => 2857,

        ]);

        //Veinticinco de Mayo

        Neighborhood::create([
            'id' => 5986,
            'name' => 'Veinticinco de Mayo',
            'city_id' => 2858,

        ]);

        //Villa Antigua

        Neighborhood::create([
            'id' => 5987,
            'name' => 'Villa Antigua',
            'city_id' => 2859,

        ]);

        //Villa Atuel

        Neighborhood::create([
            'id' => 5988,
            'name' => 'Villa Atuel',
            'city_id' => 2860,

        ]);

        //Villa Bastías

        Neighborhood::create([
            'id' => 5989,
            'name' => 'Villa Bastías',
            'city_id' => 2861,

        ]);

        //Villa Cabecera

        Neighborhood::create([
            'id' => 5990,
            'name' => 'Villa Cabecera?',
            'city_id' => 2862,

        ]);

        //Villa Nueva

        Neighborhood::create([
            'id' => 5991,
            'name' => 'Villa Nueva',
            'city_id' => 2863,
        ]);

        //Villa Seca

        Neighborhood::create([
            'id' => 5992,
            'name' => 'Villa Seca',
            'city_id' => 2864,

        ]);

        //Vista Flores

        Neighborhood::create([
            'id' => 5993,
            'name' => 'Vista Flores',
            'city_id' => 2865,

        ]);

        //Vistalba

        Neighborhood::create([
            'id' => 5994,
            'name' => 'Vistalba',
            'city_id' => 2866 ,

        ]);

        //Zapata (Mendoza)

        Neighborhood::create([
            'id' => 5995,
            'name' => 'Zapata (Mendoza)',
            'city_id' => 2867,

        ]);

        //Área Funcional

        Neighborhood::create([
            'id' => 5996,
            'name' => 'Área Fundacional',
            'city_id' => 2868,

        ]);

        //Ñacuñan

        Neighborhood::create([
            'id' => 5997,
            'name' => 'Ñacuñan',
            'city_id' => 2869,

        ]);

        //Posadas

        Neighborhood::create([
            'id' => 5998,
            'name' => 'Posadas',
            'city_id' => 2870,

        ]);

        Neighborhood::create([
            'id' => 5999,
            'name' => 'Miguel Lanús',
            'city_id' => 2870,

        ]);

        //Candelaria

        Neighborhood::create([
            'id' => 6000,
            'name' => 'Candelaria',
            'city_id' => 2871,

        ]);

        //Garupá

        Neighborhood::create([
            'id' => 6001,
            'name' => 'Barrio Norte',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6002,
            'name' => 'Ñu Porá',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6003,
            'name' => 'Centro',
            'city_id' => 2872,

        ]);
        Neighborhood::create([
            'id' => 6004,
            'name' => 'Altos de González',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6005,
            'name' => 'El Portal',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6006,
            'name' => 'Alberto Roth',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6007,
            'name' => 'Barrio Nuevo',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6008,
            'name' => 'Barrio Unido',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6009,
            'name' => 'Claudia Ester',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6010,
            'name' => 'Don Alejandro',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6011,
            'name' => 'Don Claudio',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6012,
            'name' => 'Don Santiago',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6013,
            'name' => 'Gottschalk',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6014,
            'name' => 'Horacio Quiroga',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6015,
            'name' => 'Lomas de Garupá',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6016,
            'name' => 'Lomas del Sol',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6017,
            'name' => 'Malvinas',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6018,
            'name' => 'Martín Fierro',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6019,
            'name' => 'Nuestra Señora de Fátima',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6020,
            'name' => 'Nuevo Garupá',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6021,
            'name' => 'Néstor Kirchner',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6022,
            'name' => 'Santa Bárbara',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6023,
            'name' => 'Santa Catalina',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6024,
            'name' => 'Santa Clara',
            'city_id' => 2872,

        ]);

        Neighborhood::create([
            'id' => 6025,
            'name' => 'Santa Cruz',
            'city_id' => 2872,

        ]);


        //Puerto Iguazú

        Neighborhood::create([
            'id' => 6027,
            'name' => 'Puerto Iguazú',
            'city_id' => 2874,

        ]);

        //Alba Posse

        Neighborhood::create([
            'id' => 6028,
            'name' => 'Alba Posse',
            'city_id' => 2875,

        ]);

        //Alberdi

        Neighborhood::create([
            'id' => 6029,
            'name' => 'Alberdi',
            'city_id' => 2876,

        ]);

        //Almafuerte

        Neighborhood::create([
            'id' => 6030,
            'name' => 'Almafuerte',
            'city_id' => 2877,

        ]);

        //Apóstoles

        Neighborhood::create([
            'id' => 6031,
            'name' => 'Apóstoles',
            'city_id' => 2878,

        ]);

        //Aristóbulo del Valle

        Neighborhood::create([
            'id' => 6032,
            'name' => 'Aristóbulo del Valle',
            'city_id' => 2879,

        ]);

        //Arroyo del Medio

        Neighborhood::create([
            'id' => 6033,
            'name' => 'Arroyo del Medio',
            'city_id' => 2880,

        ]);

        //Azara

        Neighborhood::create([
            'id' => 6034,
            'name' => 'Azara',
            'city_id' => 2881,

        ]);

        //Bernardo de Irigoyen

        Neighborhood::create([
            'id' => 6035,
            'name' => 'Bernardo de Irigoyen',
            'city_id' => 2882,

        ]);

        //Bonpland

        Neighborhood::create([
            'id' => 6036,
            'name' => 'Bonpland',
            'city_id' => 2883,

        ]);

        //Campo Grande

        Neighborhood::create([
            'id' => 6037,
            'name' => 'Campo Grande',
            'city_id' => 2884,

        ]);

        //Campo Ramón

        Neighborhood::create([
            'id' => 6038,
            'name' => 'Campo Ramón',
            'city_id' => 2885,

        ]);

        //Campo Viera

        Neighborhood::create([
            'id' => 6039,
            'name' => 'Campo Viera',
            'city_id' => 2886,

        ]);

        //Capioví

        Neighborhood::create([
            'id' => 6040,
            'name' => 'Capioví',
            'city_id' => 2887,

        ]);

        //Caá Yarí

        Neighborhood::create([
            'id' => 6041,
            'name' => 'Caá Yarí',
            'city_id' => 2888,

        ]);

        //Cerro Azul

        Neighborhood::create([
            'id' => 6042,
            'name' => 'Cerro Azul',
            'city_id' => 2889,

        ]);

        //Cerro Corá

        Neighborhood::create([
            'id' => 6043,
            'name' => 'Cerro Corá',
            'city_id' => 2890,

        ]);

        //Colonia Alberdi

        Neighborhood::create([
            'id' => 6044,
            'name' => 'Colonia Alberdi',
            'city_id' => 2891,

        ]);

        //Colonia Aurora

        Neighborhood::create([
            'id' => 6045,
            'name' => 'Colonia Aurora',
            'city_id' => 2892,

        ]);

        //Colonia Delicia

        Neighborhood::create([
            'id' => 6046,
            'name' => 'Colonia Delicia',
            'city_id' => 2893,

        ]);

        //Colonia Polana

        Neighborhood::create([
            'id' => 6047,
            'name' => 'Colonia Polana',
            'city_id' => 2894,

        ]);

        //Colonia Tamanduá

        Neighborhood::create([
            'id' => 6048,
            'name' => 'Colonia Tamanduá',
            'city_id' => 2895,

        ]);

        //Colonia Victoria

        Neighborhood::create([
            'id' => 6049,
            'name' => 'Colonia Victoria',
            'city_id' => 2896,

        ]);

        //Colonia Wanda

        Neighborhood::create([
            'id' => 6050,
            'name' => 'Colonia Wanda',
            'city_id' => 2897,

        ]);

        //Comandante Andrés Guacurarí

        Neighborhood::create([
            'id' => 6051,
            'name' => 'Comandante Andrés Guacararí',
            'city_id' => 2898,

        ]);

        //Concepción de la Sierra

        Neighborhood::create([
            'id' => 6052,
            'name' => 'Concepción de la Sierra',
            'city_id' => 2899,

        ]);

        //Corpus

        Neighborhood::create([
            'id' => 6053,
            'name' => 'Corpus',
            'city_id' => 2900,

        ]);

        //Dos Arroyos

        Neighborhood::create([
            'id' => 6054,
            'name' => 'Dos Arroyos',
            'city_id' => 2901,

        ]);

        //Dos de Mayo

        Neighborhood::create([
            'id' => 6055,
            'name' => 'Dos de Mayo',
            'city_id' => 2902,

        ]);

        //El Alcázar

        Neighborhood::create([
            'id' => 6056,
            'name' => 'El Alcázar',
            'city_id' => 2903,

        ]);

        //El Dorado

        Neighborhood::create([
            'id' => 6057,
            'name' => 'El Dorado',
            'city_id' => 2904,

        ]);


        //General Alvear

        Neighborhood::create([
            'id' => 6058,
            'name' => 'General Alvear',
            'city_id' => 2909,

        ]);

        //General Urquiza

        Neighborhood::create([
            'id' => 6059,
            'name' => 'General Urquiza',
            'city_id' => 2910,

        ]);

        //Gobernador López

        Neighborhood::create([
            'id' => 6060,
            'name' => 'Gobernador López',
            'city_id' => 2911,

        ]);

        //Gobernador Roca

        Neighborhood::create([
            'id' => 6061,
            'name' => 'Gobernador Roca',
            'city_id' => 2912,

        ]);

        //Guaraní

        Neighborhood::create([
            'id' => 6062,
            'name' => 'Guaraní',
            'city_id' => 2913,

        ]);

        //Hipólito Yrigoyen

        Neighborhood::create([
            'id' => 6063,
            'name' => 'Hipólito Yrigoyen',
            'city_id' => 2914,

        ]);

        //Itacaruaré

        Neighborhood::create([
            'id' => 6064,
            'name' => 'Itacaruaré',
            'city_id' => 2915,

        ]);

        //Jardín América

        Neighborhood::create([
            'id' => 6065,
            'name' => 'Jardín América',
            'city_id' => 2916,

        ]);

        //Leandro N Alem

        Neighborhood::create([
            'id' => 6066,
            'name' => 'Leandro N Alem',
            'city_id' => 2917,

        ]);

        //Loreto

        Neighborhood::create([
            'id' => 6067,
            'name' => 'Loreto',
            'city_id' => 2918,

        ]);

        //Los Helechos

        Neighborhood::create([
            'id' => 6068,
            'name' => 'Los Helechos',
            'city_id' => 2919,

        ]);

        //Mojón Grande

        Neighborhood::create([
            'id' => 6069,
            'name' => 'Mojón Grande',
            'city_id' => 2920,

        ]);

        //Montecarlo

        Neighborhood::create([
            'id' => 6070,
            'name' => 'Montecarlo',
            'city_id' => 2921,

        ]);

        //Mártires

        Neighborhood::create([
            'id' => 6071,
            'name' => 'Mártires',
            'city_id' => 2922,

        ]);

        //Nueve de Julio

        Neighborhood::create([
            'id' => 6072,
            'name' => 'Nueve de Julio',
            'city_id' => 2923,

        ]);

        //Obrerá

        Neighborhood::create([
            'id' => 6073,
            'name' => 'Obrerá',
            'city_id' => 2924,

        ]);

        //Olegario Víctor Andrade

        Neighborhood::create([
            'id' => 6074,
            'name' => 'Olegario Víctor Andrade',
            'city_id' => 2925,

        ]);

        //Panambí

        Neighborhood::create([
            'id' => 6075,
            'name' => 'Panambí',
            'city_id' => 2926,

        ]);

        //Panambí Kilómetro 8

        Neighborhood::create([
            'id' => 6076,
            'name' => 'Panambí Kilómetro 8',
            'city_id' => 2927,

        ]);

        //Pindapoy

        Neighborhood::create([
            'id' => 6077,
            'name' => 'Pindapoy',
            'city_id' => 2928,

        ]);

        //Profundidad

        Neighborhood::create([
            'id' => 6078,
            'name' => 'Profundidad',
            'city_id' => 2929,

        ]);

        //Puerto Esperanza

        Neighborhood::create([
            'id' => 6079,
            'name' => 'Puerto Esperanza',
            'city_id' => 2930,

        ]);

        //Puerto Leoni

        Neighborhood::create([
            'id' => 6080,
            'name' => 'Puerto Leoni',
            'city_id' => 2931,

        ]);

        //Puerto Libertad

        Neighborhood::create([
            'id' => 6081,
            'name' => 'Puerto Libertad',
            'city_id' => 2932,

        ]);

        //Puerto Rico

        Neighborhood::create([
            'id' => 6082,
            'name' => 'Puerto Rico',
            'city_id' => 2933,

        ]);

        //Puerto Sánchez

        Neighborhood::create([
            'id' => 6083,
            'name' => 'Puerto Sánchez',
            'city_id' => 2934,

        ]);

        //Ruiz de Montoya

        Neighborhood::create([
            'id' => 6084,
            'name' => 'Ruiz de Montoya',
            'city_id' => 2935,

        ]);

        //San Antonio

        Neighborhood::create([
            'id' => 6085,
            'name' => 'San Antonio',
            'city_id' => 2936,

        ]);

        //San Ignacio

        Neighborhood::create([
            'id' => 6086,
            'name' => 'San Ignacio',
            'city_id' => 2937,

        ]);

        //San Javier

        Neighborhood::create([
            'id' => 6087,
            'name' => 'San José',
            'city_id' => 2938,

        ]);

        //San Martín

        Neighborhood::create([
            'id' => 6088,
            'name' => 'San Martín',
            'city_id' => 2939,

        ]);

        //San Pedro

        Neighborhood::create([
            'id' => 6089,
            'name' => 'San Pedro',
            'city_id' => 2940,

        ]);

        //San Vicente

        Neighborhood::create([
            'id' => 6090,
            'name' => 'San Vicente',
            'city_id' => 2941,

        ]);

        //Santa Ana

        Neighborhood::create([
            'id' => 6091,
            'name' => 'Santa Ana',
            'city_id' => 2942,

        ]);

        //Santa Maria

        Neighborhood::create([
            'id' => 6092,
            'name' => 'Santa Maria',
            'city_id' => 2943,

        ]);

        //Santiago de Liniers

        Neighborhood::create([
            'id' => 6093,
            'name' => 'Santiago de Liniers',
            'city_id' => 2944,

        ]);

        //Santo Pipó

        Neighborhood::create([
            'id' => 6094,
            'name' => 'Santo Pipó',
            'city_id' => 2945,

        ]);



        Neighborhood::create([
            'id' => 6095,
            'name' => 'Islas Malvinas',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6096,
            'name' => 'La Sirena',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6097,
            'name' => 'Limay',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6098,
            'name' => 'Los Olivos',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6099,
            'name' => 'Los Prados',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6100,
            'name' => 'Manuel Belgrano',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6101,
            'name' => 'Mariano Moreno',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6102,
            'name' => 'Melipal',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6103,
            'name' => 'Militar',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6104,
            'name' => 'Morada del Agua Life',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6105,
            'name' => 'Prima Terra',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6106,
            'name' => 'Provincias Unidas',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6107,
            'name' => 'Rincón de Emilio',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6108,
            'name' => 'Rincón del Valle',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6109,
            'name' => 'Río Grande',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6110,
            'name' => 'San Lorenzo Sur',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6111,
            'name' => 'Santa Ángela III',
            'city_id' => 2950,

        ]);



        Neighborhood::create([
            'id' => 6112,
            'name' => 'Tierra Mansa',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6113,
            'name' => 'Unión de Mayo',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6114,
            'name' => 'Valentina Norte Rural',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6115,
            'name' => 'Valentina Norte Urbana',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6116,
            'name' => 'Valentina Sur Rural',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6117,
            'name' => 'Valentina Sur Urbana',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6118,
            'name' => 'Villa Ceferino',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6119,
            'name' => 'Villa El Chocón',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6120,
            'name' => 'Villa Farrell',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6121,
            'name' => 'Villa Florencia',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6122,
            'name' => 'Villa María',
            'city_id' => 2950,

        ]);

        Neighborhood::create([
            'id' => 6123,
            'name' => 'Área Centro Sur',
            'city_id' => 2950,

        ]);

        //San Martín de los Andes

        Neighborhood::create([
            'id' => 6124,
            'name' => 'Centro',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6125,
            'name' => 'Meliquina',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6126,
            'name' => 'Chapelco Golf & Resort',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6127,
            'name' => 'Camino Lolog',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6128,
            'name' => 'Alihuen Alto y Bajo',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6129,
            'name' => 'Aeropuerto',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6130,
            'name' => 'Altos de la Vega',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6131,
            'name' => 'Altos del Chapelco',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6132,
            'name' => 'Barrio La Cascada',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6133,
            'name' => 'Bickel',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6134,
            'name' => 'Caleuche',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6135,
            'name' => 'Callejon de Bello',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6136,
            'name' => 'Callejon de Gin Gins',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6137,
            'name' => 'Callejon de Torres',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6138,
            'name' => 'Chacra 28',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6139,
            'name' => 'Chacra 30',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6140,
            'name' => 'Covisal',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6141,
            'name' => 'El Arenal',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6142,
            'name' => 'El Oasis',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6143,
            'name' => 'El Pegual',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6144,
            'name' => 'El Portal',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6145,
            'name' => 'Estancia Los Ñires',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6146,
            'name' => 'Handel',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6147,
            'name' => 'La Cascada',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6148,
            'name' => 'Lago Lolog',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6149,
            'name' => 'Las Marías del Valle Club de Campo',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6150,
            'name' => 'Las Vertientes',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6151,
            'name' => 'Los Coirones',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6152,
            'name' => 'Los Faldeos de Chapelco',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6153,
            'name' => 'Los Maitenes',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6154,
            'name' => 'Los Riscos',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6155,
            'name' => 'Los Robles',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6156,
            'name' => 'Miralejos',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6157,
            'name' => 'Nahueilen',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6158,
            'name' => 'Noregon',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6159,
            'name' => 'Quilquihue',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6160,
            'name' => 'Ruca Hue',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6162,
            'name' => 'San Fernando',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6163,
            'name' => 'Sigrand',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6164,
            'name' => 'Tierra del Sol',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6165,
            'name' => 'Vega Chica',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6166,
            'name' => 'Villa Lolog',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6167,
            'name' => 'Villa Paur',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6168,
            'name' => 'Villa Vega Maipu',
            'city_id' => 2951,

        ]);

        Neighborhood::create([
            'id' => 6169,
            'name' => 'Villa Vega San Martín',
            'city_id' => 2951,

        ]);

        //Plottier

        Neighborhood::create([
            'id' => 6170,
            'name' => 'Los Canales',
            'city_id' => 2952,

        ]);

        Neighborhood::create([
            'id' => 6171,
            'name' => 'Altos de Alberdi I',
            'city_id' => 2952,

        ]);

        //Villa La Angostura

        Neighborhood::create([
            'id' => 6172,
            'name' => 'Puerto Manzano',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6173,
            'name' => 'Centro',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6174,
            'name' => 'El Once',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6175,
            'name' => 'Epufalquen',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6176,
            'name' => 'Barrio Norte',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6177,
            'name' => 'Aguas Azules',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6178,
            'name' => 'Antil Hue',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6179,
            'name' => 'Bandurrias',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6180,
            'name' => 'Cahuien Hue',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6181,
            'name' => 'Calfuco',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6182,
            'name' => 'Camping Florencia Brazo Rincón',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6183,
            'name' => 'Cascada Inayacal',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6184,
            'name' => 'Cerro Bayo',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6185,
            'name' => 'Colinas Maikana',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6186,
            'name' => 'Cumelén',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6187,
            'name' => 'Cuyén Co',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6188,
            'name' => 'Del Cipres',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6189,
            'name' => 'Dos Lagos Villas & Marinas',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6190,
            'name' => 'El Cruce',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6191,
            'name' => 'El Cruce Chico',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6192,
            'name' => 'El Mallin',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6193,
            'name' => 'Estancia Inalco',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6194,
            'name' => 'Faldeo del Bayo',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6195,
            'name' => 'Faldeo del belvedere',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6196,
            'name' => 'Faldeo Manzano',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6197,
            'name' => 'Hospital Villa Angostura',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6198,
            'name' => 'Las Balsas',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6199,
            'name' => 'Las Margaritas',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6200,
            'name' => 'Loma Guacha',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6201,
            'name' => 'Lomas dek Correntoso',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6202,
            'name' => 'Los Volcanes',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6203,
            'name' => 'Muelle de Piedra',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6204,
            'name' => 'Parque Arauco',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6205,
            'name' => 'Peumayen',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6206,
            'name' => 'Pichi Rincón',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6207,
            'name' => 'Pinar',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6208,
            'name' => 'Puertos de la Villa',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6209,
            'name' => 'Tres Cruces',
            'city_id' => 2953,

        ]);

        Neighborhood::create([
            'id' => 6210,
            'name' => 'Villa Correntoso',
            'city_id' => 2953,

        ]);

        //Añelo

        Neighborhood::create([
            'id' => 6211,
            'name' => 'Riveras de Añelo',
            'city_id' => 2954,

        ]);

        //Agrio del Medio

        Neighborhood::create([
            'id' => 6212,
            'name' => 'Agrio del Medio',
            'city_id' => 2955,

        ]);

        //Agua de Canale

        Neighborhood::create([
            'id' => 6213,
            'name' => 'Agua de Canale',
            'city_id' => 2956,

        ]);

        //Agua del Carrizo

        Neighborhood::create([
            'id' => 6214,
            'name' => 'Agua del Carrizo',
            'city_id' => 2957,

        ]);

        //Aguada San Roque

        Neighborhood::create([
            'id' => 6215,
            'name' => 'Aguada San Roque',
            'city_id' => 2958,

        ]);

        //Aguas Calientes

        Neighborhood::create([
            'id' => 6216,
            'name' => 'Aguas Calientes',
            'city_id' => 2959,

        ]);

        //Aluminé

        Neighborhood::create([
            'id' => 6217,
            'name' => 'Aluminé',
            'city_id' => 2960,

        ]);

        //Andacollo

        Neighborhood::create([
            'id' => 6218,
            'name' => 'Andacollo',
            'city_id' => 2961,

        ]);

        //Arroyito

        Neighborhood::create([
            'id' => 6219,
            'name' => 'Arroyito',
            'city_id' => 2962,

        ]);

        //Atreuco

        Neighborhood::create([
            'id' => 6220,
            'name' => 'Atreuco',
            'city_id' => 2963,

        ]);

        //Auca - Pan

        Neighborhood::create([
            'id' => 6221,
            'name' => 'Auca - Pan',
            'city_id' => 2964,

        ]);

        //Auca Mahuida

        Neighborhood::create([
            'id' => 6222,
            'name' => 'Auca Mahuida',
            'city_id' => 2965,

        ]);

        //Auquinco

        Neighborhood::create([
            'id' => 6223,
            'name' => 'Auquinco',
            'city_id' => 2966,

        ]);

        //Bajada Colorada

        Neighborhood::create([
            'id' => 6224,
            'name' => 'Bajada Colorada',
            'city_id' => 2967,

        ]);

        //Bajada del Agrio

        Neighborhood::create([
            'id' => 6225,
            'name' => 'Bajada del Agrio',
            'city_id' => 2968,

        ]);

        //Barrancas

        Neighborhood::create([
            'id' => 6226,
            'name' => 'Barrancas',
            'city_id' => 2969,

        ]);

        //Bella Vista

        Neighborhood::create([
            'id' => 6227,
            'name' => 'Bella Vista',
            'city_id' => 2970,

        ]);

        //Buta Ranquil

        Neighborhood::create([
            'id' => 6228,
            'name' => 'Buta Ranquil',
            'city_id' => 2971,

        ]);

        //Caepe Malal

        Neighborhood::create([
            'id' => 6229,
            'name' => 'Caepe Malal',
            'city_id' => 2972,

        ]);

        //Cajón de Almanza

        Neighborhood::create([
            'id' => 6230,
            'name' => 'Cajón de Almanza',
            'city_id' => 2973,

        ]);

        //Catan Lil

        Neighborhood::create([
            'id' => 6231,
            'name' => 'Catan Lil',
            'city_id' => 2974,

        ]);

        //Caviahue-Copahue

        Neighborhood::create([
            'id' => 6232,
            'name' => 'Caviahue-Copahue',
            'city_id' => 2975,

        ]);

        //Cañadon Nogales

        Neighborhood::create([
            'id' => 6233,
            'name' => 'Cañadon Nogales',
            'city_id' => 2976,

        ]);

        //Centenario

        Neighborhood::create([
            'id' => 6234,
            'name' => 'Centenario',
            'city_id' => 2977,

        ]);

        //Chacayco

        Neighborhood::create([
            'id' => 6235,
            'name' => 'Chacayco',
            'city_id' => 2978,

        ]);

        //Chacayco Sur

        Neighborhood::create([
            'id' => 6236,
            'name' => 'Chacayco Sur',
            'city_id' => 2979,

        ]);

        //Chapua

        Neighborhood::create([
            'id' => 6237,
            'name' => 'Chapua',
            'city_id' => 2980,

        ]);

        //Chiquilihuin

        Neighborhood::create([
            'id' => 6238,
            'name' => 'Chiquilihuin',
            'city_id' => 2981,

        ]);

        //Chorriaca

        Neighborhood::create([
            'id' => 6239,
            'name' => 'Chorriaca',
            'city_id' => 2982,

        ]);

        //Chos Malal

        Neighborhood::create([
            'id' => 6240,
            'name' => 'Chos Malal',
            'city_id' => 2983,

        ]);

        //Colipilli

        Neighborhood::create([
            'id' => 6241,
            'name' => 'Colipilli',
            'city_id' => 2984,

        ]);

        //Collón Curá

        Neighborhood::create([
            'id' => 6242,
            'name' => 'Collón Curá',
            'city_id' => 2985,

        ]);

        //Costa Tilhue

        Neighborhood::create([
            'id' => 6243,
            'name' => 'Costa Tilhue',
            'city_id' => 2986,

        ]);

        //Covunco Abajo

        Neighborhood::create([
            'id' => 6244,
            'name' => 'Covunco Abajo',
            'city_id' => 2987,

        ]);

        //Covunco Centro

        Neighborhood::create([
            'id' => 6245,
            'name' => 'Covunco Centro',
            'city_id' => 2988,

        ]);

        //Coyuco-Cochico

        Neighborhood::create([
            'id' => 6246,
            'name' => 'Coyuco-Cochico',
            'city_id' => 2989,

        ]);

        //Curaco

        Neighborhood::create([
            'id' => 6247,
            'name' => 'Curaco',
            'city_id' => 2990,

        ]);

        //Cutral Có

        Neighborhood::create([
            'id' => 6248,
            'name' => 'Cutral Có',
            'city_id' => 2991,

        ]);

        //Cuyin Manzano

        Neighborhood::create([
            'id' => 6249,
            'name' => 'Cuyin Manzano',
            'city_id' => 2992,

        ]);

        //El Alamito

        Neighborhood::create([
            'id' => 6250,
            'name' => 'El Alamito',
            'city_id' => 2993,

        ]);

        //El Chocón

        Neighborhood::create([
            'id' => 6251,
            'name' => 'El Chocón',
            'city_id' => 2994,

        ]);

        //El Cholar

        Neighborhood::create([
            'id' => 6252,
            'name' => 'El Cholar',
            'city_id' => 2995,

        ]);

        //El Cruce

        Neighborhood::create([
            'id' => 6253,
            'name' => 'El Cruce',
            'city_id' => 2996,

        ]);

        //El Huecú

        Neighborhood::create([
            'id' => 6254,
            'name' => 'El Huecú',
            'city_id' => 2997,

        ]);

        //El Marucho

        Neighborhood::create([
            'id' => 6255,
            'name' => 'El Marucho',
            'city_id' => 2998,

        ]);

        //El Portezuelo

        Neighborhood::create([
            'id' => 6256,
            'name' => 'El Portezuelo',
            'city_id' => 2999,

        ]);

        //El Sauce

        Neighborhood::create([
            'id' => 6257,
            'name' => 'El Sauce',
            'city_id' => 3000,

        ]);

        //Fortin 1º de Mayo

        Neighborhood::create([
            'id' => 6258,
            'name' => 'Fortin 1º de Mayo',
            'city_id' => 3001,

        ]);

        //Guañacos

        Neighborhood::create([
            'id' => 6259,
            'name' => 'Guañacos',
            'city_id' => 3002,

        ]);

        //Huarenchenque

        Neighborhood::create([
            'id' => 6260,
            'name' => 'Huarencheque',
            'city_id' => 3003,

        ]);

        //Huelchulafquen

        Neighborhood::create([
            'id' => 6261,
            'name' => 'Huelchulafquen',
            'city_id' => 3004,

        ]);

        //Huemul

        Neighborhood::create([
            'id' => 6262,
            'name' => 'Huemul',
            'city_id' => 3005,

        ]);

        //Huinganco

        Neighborhood::create([
            'id' => 6263,
            'name' => 'Huinganco',
            'city_id' => 3006,

        ]);

        //Huitrin

        Neighborhood::create([
            'id' => 6264,
            'name' => 'Huitrin',
            'city_id' => 3007,

        ]);

        //Hunca

        Neighborhood::create([
            'id' => 6265,
            'name' => 'Hunca',
            'city_id' => 3008,

        ]);

        //Junin de los Andes

        Neighborhood::create([
            'id' => 6266,
            'name' => 'Junín de los Andes',
            'city_id' => 3009,

        ]);

        //Kilca

        Neighborhood::create([
            'id' => 6267,
            'name' => 'Kilca',
            'city_id' => 3010,

        ]);

        //La Amarga

        Neighborhood::create([
            'id' => 6268,
            'name' => 'La Amarga',
            'city_id' => 3011,

        ]);

        //La Angostura

        Neighborhood::create([
            'id' => 6269,
            'name' => 'La Angostura',
            'city_id' => 3012,

        ]);

        //La Buitrera

        Neighborhood::create([
            'id' => 6270,
            'name' => 'La Buitrera',
            'city_id' => 3013,

        ]);

        //La Salada

        Neighborhood::create([
            'id' => 6271,
            'name' => 'La Salada',
            'city_id' => 3014,

        ]);

        //Las Coloradas

        Neighborhood::create([
            'id' => 6272,
            'name' => 'Las Coloradas',
            'city_id' => 3015,

        ]);

        //Las Cortaderas

        Neighborhood::create([
            'id' => 6273,
            'name' => 'Las Cortaderas',
            'city_id' => 3016,

        ]);

        //Las Lagunas

        Neighborhood::create([
            'id' => 6274,
            'name' => 'Las Lagunas',
            'city_id' => 3017,

        ]);

        //Las Lajas

        Neighborhood::create([
            'id' => 6275,
            'name' => 'Las Lajas',
            'city_id' => 3018,

        ]);

        //Las Ovejas

        Neighborhood::create([
            'id' => 6276,
            'name' => 'Las Ovejas',
            'city_id' => 3019,

        ]);

        //Limay Centro

        Neighborhood::create([
            'id' => 6277,
            'name' => 'Limay Centro',
            'city_id' => 3020,

        ]);

        //Lonco Vaca

        Neighborhood::create([
            'id' => 6278,
            'name' => 'Lonco Vaca',
            'city_id' => 3021,

        ]);

        //Loncopué

        Neighborhood::create([
            'id' => 6279,
            'name' => 'Loncopué',
            'city_id' => 3022,

        ]);

        //Los Carrizos

        Neighborhood::create([
            'id' => 6280,
            'name' => 'Los Carrizos',
            'city_id' => 3023,

        ]);

        //Los Catutos

        Neighborhood::create([
            'id' => 6281,
            'name' => 'Los Catutos',
            'city_id' => 3024,

        ]);

        //Los Chihuidos

        Neighborhood::create([
            'id' => 6282,
            'name' => 'Los Chihuidos',
            'city_id' => 3025,

        ]);

        //Los Menucos

        Neighborhood::create([
            'id' => 6283,
            'name' => 'Los Menucos',
            'city_id' => 3026,

        ]);

        //Los Miches

        Neighborhood::create([
            'id' => 6284,
            'name' => 'Los Miches',
            'city_id' => 3027,

        ]);

        //Lácar

        Neighborhood::create([
            'id' => 6285,
            'name' => 'Lácar',
            'city_id' => 3028,

        ]);

        //Malleo

        Neighborhood::create([
            'id' => 6286,
            'name' => 'Malleo',
            'city_id' => 3029,

        ]);

        //Mallin Quemado

        Neighborhood::create([
            'id' => 6287,
            'name' => 'Mallin Quemado',
            'city_id' => 3030,

        ]);

        //Manzano Amargo

        Neighborhood::create([
            'id' => 6288,
            'name' => 'Manzano Amargo',
            'city_id' => 3031,

        ]);

        //Mariano Moreno

        Neighborhood::create([
            'id' => 6289,
            'name' => 'Mariano Moreno',
            'city_id' => 3032,

        ]);

        //Moquehue

        Neighborhood::create([
            'id' => 6290,
            'name' => 'Moquehue',
            'city_id' => 3033,

        ]);

        //Muchilinico

        Neighborhood::create([
            'id' => 6291,
            'name' => 'Muchilinico',
            'city_id' => 3034,

        ]);

        //Nahuel Huapi

        Neighborhood::create([
            'id' => 6292,
            'name' => 'Nahuel Huapi',
            'city_id' => 3035,

        ]);

        //Naunauco

        Neighborhood::create([
            'id' => 6293,
            'name' => 'Naunauco',
            'city_id' => 3036,

        ]);

        //Octavio Pico

        Neighborhood::create([
            'id' => 6294,
            'name' => 'Octavio Pico',
            'city_id' => 3037,

        ]);

        //Ojo de Agua

        Neighborhood::create([
            'id' => 6295,
            'name' => 'Riveras de Añelo',
            'city_id' => 3038,

        ]);


        //Parajes

        Neighborhood::create([
            'id' => 6297,
            'name' => 'Parajes',
            'city_id' => 3040,

        ]);

        //Paso Aguerre

        Neighborhood::create([
            'id' => 6298,
            'name' => 'Paso Coihue',
            'city_id' => 3041,

        ]);

        //Paso Coihue

        Neighborhood::create([
            'id' => 6299,
            'name' => 'Paso Coihue',
            'city_id' => 3042,

        ]);

        //Peña Haichol

        Neighborhood::create([
            'id' => 6300,
            'name' => 'Peña  Haichol',
            'city_id' => 3043,

        ]);

        //Pichaihue

        Neighborhood::create([
            'id' => 6301,
            'name' => 'Pichaihue',
            'city_id' => 3044,

        ]);

        //Pichi Neuquén

        Neighborhood::create([
            'id' => 6302,
            'name' => 'Pichi Neuquén',
            'city_id' => 3045,

        ]);

        //Pichi Traful

        Neighborhood::create([
            'id' => 6303,
            'name' => 'Pichi Traful',
            'city_id' => 3046,

        ]);

        //Picun Leufu

        Neighborhood::create([
            'id' => 6304,
            'name' => 'Picun Leufu',
            'city_id' => 3047,

        ]);

        //Picún Leufú

        Neighborhood::create([
            'id' => 6305,
            'name' => 'Picún Leufú',
            'city_id' => 3048,

        ]);

        //Piedra del Aguila

        Neighborhood::create([
            'id' => 6306,
            'name' => 'Piedra del Aguila',
            'city_id' => 3049,

        ]);

        //Pilolil

        Neighborhood::create([
            'id' => 6307,
            'name' => 'Pilolil',
            'city_id' => 3050,

        ]);

        //Plaza Huincul

        Neighborhood::create([
            'id' => 6308,
            'name' => 'Plaza Huincul',
            'city_id' => 3051,

        ]);

        //Puerto Anchorena

        Neighborhood::create([
            'id' => 6309,
            'name' => 'Puerto Anchorena',
            'city_id' => 3052,

        ]);

        //Puerto Huemul

        Neighborhood::create([
            'id' => 6310,
            'name' => 'Puerto Huemul',
            'city_id' => 3053,

        ]);

        //Puerto Tromen

        Neighborhood::create([
            'id' => 6311,
            'name' => 'Puerto Tromen',
            'city_id' => 3054,

        ]);

        //Puenta Sierra

        Neighborhood::create([
            'id' => 6312,
            'name' => 'Punta Sierra',
            'city_id' => 3055,

        ]);

        //Quili Malal

        Neighborhood::create([
            'id' => 6313,
            'name' => 'Quili Malal',
            'city_id' => 3056,

        ]);

        //Quillen

        Neighborhood::create([
            'id' => 6314,
            'name' => 'Quillen',
            'city_id' => 3057,

        ]);

        //Quintuco

        Neighborhood::create([
            'id' => 6315,
            'name' => 'Quintuco',
            'city_id' => 3058,

        ]);

        //Rahue

        Neighborhood::create([
            'id' => 6316,
            'name' => 'Rahue',
            'city_id' => 3059,

        ]);

        //Rahueco

        Neighborhood::create([
            'id' => 6317,
            'name' => 'Rahueco',
            'city_id' => 3060,

        ]);

        //Ramón M Castro

        Neighborhood::create([
            'id' => 6318,
            'name' => 'Ramón M Castro',
            'city_id' => 3061,
        ]);

        //Ranquilon

        Neighborhood::create([
            'id' => 6319,
            'name' => 'Ranquilon',
            'city_id' => 3062,

        ]);

        //Rincón Colorado

        Neighborhood::create([
            'id' => 6320,
            'name' => 'Rincón Colorado',
            'city_id' => 3063,

        ]);

        //Rincón de los Sauces

        Neighborhood::create([
            'id' => 6321,
            'name' => 'Rincón de los Sauces',
            'city_id' => 3064,

        ]);

        //Ruca Malen

        Neighborhood::create([
            'id' => 6322,
            'name' => 'Ruca Malen',
            'city_id' => 3065,

        ]);

        //Rucachoroi

        Neighborhood::create([
            'id' => 6323,
            'name' => 'Rucachoroi',
            'city_id' => 3066,

        ]);

        //San Ignacio

        Neighborhood::create([
            'id' => 6324,
            'name' => 'San Ignacio',
            'city_id' => 3067,

        ]);

        //San Patricio del Chañar

        Neighborhood::create([
            'id' => 6325,
            'name' => 'San Patricio del Chañar',
            'city_id' => 3068,

        ]);

        //Santo Domingo

        Neighborhood::create([
            'id' => 6326,
            'name' => 'Santo Domingo',
            'city_id' => 3069,

        ]);

        //Santo Tomas

        Neighborhood::create([
            'id' => 6327,
            'name' => 'Santo Tomas',
            'city_id' => 3070,

        ]);

        //Sauzal Bonito

        Neighborhood::create([
            'id' => 6328,
            'name' => 'Sauzal Bonito',
            'city_id' => 3071,

        ]);

        //Sañico

        Neighborhood::create([
            'id' => 6329,
            'name' => 'Sañico',
            'city_id' => 3072,

        ]);

        //Senillosa

        Neighborhood::create([
            'id' => 6330,
            'name' => 'Senillosa',
            'city_id' => 3073,

        ]);

        //Taquimilan Abajo

        Neighborhood::create([
            'id' => 6331,
            'name' => 'Taquimilan Abajo',
            'city_id' => 3074,

        ]);

        //Taquimilan Arriba

        Neighborhood::create([
            'id' => 6332,
            'name' => 'Taquimilan Arriba',
            'city_id' => 3075,

        ]);

        //Taquimilan Centro

        Neighborhood::create([
            'id' => 6333,
            'name' => 'Taquimilan Centro',
            'city_id' => 3076,

        ]);

        //Taquimilán

        Neighborhood::create([
            'id' => 6334,
            'name' => 'Taquimilán',
            'city_id' => 3077,

        ]);

        //Tres Puentes

        Neighborhood::create([
            'id' => 6335,
            'name' => 'Tres Puentes',
            'city_id' => 3078,

        ]);

        //Tricao Malal

        Neighborhood::create([
            'id' => 6336,
            'name' => 'Tricao Malal',
            'city_id' => 3079,

        ]);

        //Tropezón

        Neighborhood::create([
            'id' => 6337,
            'name' => 'Tropezón',
            'city_id' => 3080,

        ]);

        //Varvarco/Invernada Vieja

        Neighborhood::create([
            'id' => 6338,
            'name' => 'Varvarco/Invernada Vieja',
            'city_id' => 3081,

        ]);

        //Villa Curí Leuvú

        Neighborhood::create([
            'id' => 6339,
            'name' => 'Villa Curí Leuvú',
            'city_id' => 3082,

        ]);

        //Villa del Agrio

        Neighborhood::create([
            'id' => 6340,
            'name' => 'Villa del Agrio',
            'city_id' => 3083,

        ]);

        //Villa del Nahueve

        Neighborhood::create([
            'id' => 6341,
            'name' => 'Villa del Nahueve',
            'city_id' => 3084,

        ]);

        //Villa del Puente Picún Leufú

        Neighborhood::create([
            'id' => 6342,
            'name' => 'Villa del Puente Picún Leufú',
            'city_id' => 3085,

        ]);

        //Villa El Chocón

        Neighborhood::create([
            'id' => 6343,
            'name' => 'Villa El Chocón',
            'city_id' => 3086,

        ]);

        //Villa Llanquin

        Neighborhood::create([
            'id' => 6344,
            'name' => 'Villa Llanquin',
            'city_id' => 3087,

        ]);

        //Villa Pehuenia

        Neighborhood::create([
            'id' => 6345,
            'name' => 'Villa Pehuenia',
            'city_id' => 3088,

        ]);

        //Villa Pichi Picun Leufu

        Neighborhood::create([
            'id' => 6346,
            'name' => 'Villa Pichi Picun Leufu',
            'city_id' => 3089,

        ]);

        //Villa Rincón Chico

        Neighborhood::create([
            'id' => 6347,
            'name' => 'Villa Rincón Chico',
            'city_id' => 3090,

        ]);

        //Villa Traful

        Neighborhood::create([
            'id' => 6348,
            'name' => 'Villa Traful',
            'city_id' => 3091,

        ]);

        //Villa Unión

        Neighborhood::create([
            'id' => 6349,
            'name' => 'Villa Unión',
            'city_id' => 3092,

        ]);

        //Vilu Mallin

        Neighborhood::create([
            'id' => 6350,
            'name' => 'Vilu Mallin',
            'city_id' => 3093,

        ]);

        //Vista Alegre

        Neighborhood::create([
            'id' => 6351,
            'name' => 'Vista Alegre',
            'city_id' => 3094,

        ]);

        //Zapala

        Neighborhood::create([
            'id' => 6352,
            'name' => 'Zapala',
            'city_id' => 3095,

        ]);

        //Ñireco

        Neighborhood::create([
            'id' => 6353,
            'name' => 'Ñireco',
            'city_id' => 3096,

        ]);

        //Ñorquinco

        Neighborhood::create([
            'id' => 6354,
            'name' => 'Ñorquinco',
            'city_id' => 3097,

        ]);

        //Rio Negro

        Neighborhood::create([
            'id' => 6355,
            'name' => 'San Carlos de Bariloche',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6356,
            'name' => 'Arelauquen Golf & Country Club',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6357,
            'name' => 'Villa Arelauquen',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6358,
            'name' => 'Dina Huapi' ,
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6359,
            'name' => 'Lago Moreno',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6360,
            'name' => 'Arelauquen Lodge Golf & Polo',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6361,
            'name' => 'Atahualpa Yupanqui',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6362,
            'name' => 'Casa de Piedra Meli',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6363,
            'name' => 'Club Pinar del Sol',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6364,
            'name' => 'Costa del Sol',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6365,
            'name' => 'Country Club Pinar del Sol',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6366,
            'name' => 'Cumelén C.C.',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6367,
            'name' => 'Entre Cerros',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6368,
            'name' => 'J. M de Rosas',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6369,
            'name' => 'La Cheni - Valcheta',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6370,
            'name' => 'La Fragua',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6371,
            'name' => 'Lago Gutiérrez',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6372,
            'name' => 'Lago Moreno Este',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6373,
            'name' => 'Lago Moreno Oeste',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6374,
            'name' => 'Las Cartas',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6375,
            'name' => 'Los Cipresales',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6376,
            'name' => 'Los Coihues',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6377,
            'name' => 'Los Notros Cahiu',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6378,
            'name' => 'Quaglia',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6379,
            'name' => 'Reina Mora',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6380,
            'name' => 'S. I. del Cerro Fader',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6381,
            'name' => 'Trevelín Nueva Gales',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6382,
            'name' => 'Urbanización del Este',
            'city_id' => 3098,

        ]);

        Neighborhood::create([
            'id' => 6383,
            'name' => 'Villa Serena',
            'city_id' => 3098,

        ]);

        //Cipolletti

        Neighborhood::create([
            'id' => 6384,
            'name' => 'Centro',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6385,
            'name' => '12 de Septiembre',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6386,
            'name' => 'San Pablo',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6387,
            'name' => 'Arévalo',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6388,
            'name' => 'El Manzanar Club de Paddle',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6389,
            'name' => 'Almirante Brown',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6390,
            'name' => 'Anai Mapu',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6391,
            'name' => 'Antártida Argentina',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6392,
            'name' => 'Bartolomé Mitre',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6393,
            'name' => 'Belgrano',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6394,
            'name' => 'Bretana',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6395,
            'name' => 'Del Trabajo',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6396,
            'name' => 'Don Bosco',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6397,
            'name' => 'El Manzanar',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6398,
            'name' => 'Filipuzzi',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6399,
            'name' => 'Flamingo',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6400,
            'name' => 'Godoy',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6401,
            'name' => 'Jorge Newbery',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6402,
            'name' => 'La Alameda',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6403,
            'name' => 'La Falda',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6404,
            'name' => 'Las Calandrias',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6405,
            'name' => 'Las Viñas',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6406,
            'name' => 'Los Alamos',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6407,
            'name' => 'Los Tilos',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6408,
            'name' => 'Los Tordos',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6409,
            'name' => 'Luis Piedrabuena',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6410,
            'name' => 'Mariano Moreno',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6411,
            'name' => 'Mercantiles',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6412,
            'name' => 'Parque Industrial',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6413,
            'name' => 'Parque Norte',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6414,
            'name' => 'Pichi Nahuel',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6415,
            'name' => 'Rincón Lindo',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6416,
            'name' => 'Rincón Lindo',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6417,
            'name' => 'Rincón Lindo II',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6418,
            'name' => 'San Lorenzo',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6419,
            'name' => 'Santa Clara',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6420,
            'name' => 'Santa Rosa',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6421,
            'name' => 'Spino Florido',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6422,
            'name' => 'Tte. O`Connor',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6423,
            'name' => 'Villa Alicia',
            'city_id' => 3099,

        ]);

        Neighborhood::create([
            'id' => 6424,
            'name' => 'Villarino',
            'city_id' => 3099,

        ]);

        //General Roca

        Neighborhood::create([
            'id' => 6425,
            'name' => 'General Roca',
            'city_id' => 3100,

        ]);

        //General Fernandez Oro

        Neighborhood::create([
            'id' => 6426,
            'name' => 'Quintas de Sara',
            'city_id' => 3101,

        ]);

        //El Bolsón

        Neighborhood::create([
            'id' => 6427,
            'name' => 'Los Nogales',
            'city_id' => 3102,

        ]);

        //Aguada Cecilio

        Neighborhood::create([
            'id' => 6428,
            'name' => 'Aguada Cecilio',
            'city_id' => 3103,

        ]);

        //Aguada de Guerra

        Neighborhood::create([
            'id' => 6429,
            'name' => 'Aguada de Guerra',
            'city_id' => 3104,

        ]);

        //Aguada Guzman

        Neighborhood::create([
            'id' => 6430,
            'name' => 'Aguada Guzmán',
            'city_id' => 3105,

        ]);

        //Aguada Troncoso

        Neighborhood::create([
            'id' => 6431,
            'name' => 'Aguada Troncoso',
            'city_id' => 3106,

        ]);

        //Allen

        Neighborhood::create([
            'id' => 6432,
            'name' => 'Allen',
            'city_id' => 3107,

        ]);

        //Arroyo de la Ventana

        Neighborhood::create([
            'id' => 6433,
            'name' => 'Arroyo de la Ventana',
            'city_id' => 3108,

        ]);

        //Arroyo Los Berros

        Neighborhood::create([
            'id' => 6434,
            'name' => 'Arroyo Los Berros',
            'city_id' => 3109,

        ]);

        //Arroyo Verde

        Neighborhood::create([
            'id' => 6435,
            'name' => 'Arroyo Verde',
            'city_id' => 3110,

        ]);

        //Bahía Creek

        Neighborhood::create([
            'id' => 6436,
            'name' => 'Faro Belén ',
            'city_id' => 3111,

        ]);

        //Bajo San Cayetano

        Neighborhood::create([
            'id' => 6437,
            'name' => 'Bajo San Cayetano',
            'city_id' => 3112,

        ]);

        //Barda del Medio

        Neighborhood::create([
            'id' => 6438,
            'name' => 'Barda del Medio',
            'city_id' => 3113,

        ]);

        //Barrio Blanco

        Neighborhood::create([
            'id' => 6439,
            'name' => 'Barrio Blanco',
            'city_id' => 3114,

        ]);

        //Barrio Calle Ciega 10

        Neighborhood::create([
            'id' => 6440,
            'name' => 'Barrio Calle Ciega 10',
            'city_id' => 3115,

        ]);

        //Barrio Calle Ciega 6

        Neighborhood::create([
            'id' => 6441,
            'name' => 'Barrio Calle Ciega 6',
            'city_id' => 3116,

        ]);

        //Barrio Canale

        Neighborhood::create([
            'id' => 6442,
            'name' => 'Barrio Canale',
            'city_id' => 3117,

        ]);

        //Barrio Colonia Conesa

        Neighborhood::create([
            'id' => 6443,
            'name' => 'Barrio Colonia Conesa',
            'city_id' => 3118,

        ]);

        //Barrio Costa Este

        Neighborhood::create([
            'id' => 6444,
            'name' => 'Barrio Costa Este',
            'city_id' => 3119,

        ]);

        //Barrio Costa Linda

        Neighborhood::create([
            'id' => 6445,
            'name' => 'Barrio Costa Linda',
            'city_id' => 3120,

        ]);

        //Barrio EL Labrador

        Neighborhood::create([
            'id' => 6446,
            'name' => 'Barrio El Labrador',
            'city_id' => 3121,

        ]);

        //Barrio El Maruchito

        Neighborhood::create([
            'id' => 6447,
            'name' => 'Barrio El Maruchito',
            'city_id' => 3122,

        ]);

        //Barrio El Petróleo

        Neighborhood::create([
            'id' => 6448,
            'name' => 'Barrio El Petróleo',
            'city_id' => 3123,

        ]);

        //Barrio El Pilar

        Neighborhood::create([
            'id' => 6449,
            'name' => 'Barrio El Pilar',
            'city_id' => 3124,

        ]);

        //Barrio Ex Isla 10

        Neighborhood::create([
            'id' => 6450,
            'name' => 'Barrio Ex Isla 10',
            'city_id' => 3125,

        ]);

        //Barrio Frontera

        Neighborhood::create([
            'id' => 6451,
            'name' => 'Barrio Frontera',
            'city_id' => 3126,

        ]);

        //Barrio Guerrico

        Neighborhood::create([
            'id' => 6452,
            'name' => 'Barrio Guerrico',
            'city_id' => 3127,

        ]);

        //Barrio La Barda

        Neighborhood::create([
            'id' => 6453,
            'name' => 'Barrio La Barda',
            'city_id' => 3128,

        ]);

        //Barrio La Costa

        Neighborhood::create([
            'id' => 6454,
            'name' => 'Barrio La Costa',
            'city_id' => 3129,

        ]);

        //Barrio La Defensa

        Neighborhood::create([
            'id' => 6455,
            'name' => 'Barrio La Defensa',
            'city_id' => 3130,

        ]);

        //Barrio La Lor

        Neighborhood::create([
            'id' => 6456,
            'name' => 'Barrio La Lor',
            'city_id' => 3131,

        ]);

        //Barrio La Ribera

        Neighborhood::create([
            'id' => 6457,
            'name' => 'Barrio La Ribera',
            'city_id' => 3132,

        ]);

        //Barrio Las Angustias

        Neighborhood::create([
            'id' => 6458,
            'name' => 'Barrio Las Angustias',
            'city_id' => 3133,

        ]);

        //Barrio Mar del Plata

        Neighborhood::create([
            'id' => 6459,
            'name' => 'Barrio Mar del Plata',
            'city_id' => 3134,

        ]);

        //Barrio Maria Elvira

        Neighborhood::create([
            'id' => 6460,
            'name' => 'Barrio Maria Elvira',
            'city_id' => 3135,

        ]);

        //Barrio Mosconi

        Neighborhood::create([
            'id' => 6461,
            'name' => 'Barrio Mosconi',
            'city_id' => 3136,

        ]);

        //Barrio Norte - Municipio Cinco Saltos

        Neighborhood::create([
            'id' => 6462,
            'name' => 'Barrio Norte - Municipio Cinco Saltos',
            'city_id' => 3137,

        ]);

        //Barrio Norte - Municipio Cipolletti

        Neighborhood::create([
            'id' => 6463,
            'name' => 'Barrio Norte - Municipio Cipolletti',
            'city_id' => 3138,

        ]);

        //Barrio Norte - Municipio General Roca

        Neighborhood::create([
            'id' => 6464,
            'name' => 'Barrio Norte - Municipio General Roca',
            'city_id' => 3139,

        ]);

        //Barrio Pino Azul

        Neighborhood::create([
            'id' => 6465,
            'name' => 'Barrio Pino Azul',
            'city_id' => 3140,

        ]);

        //Barrio Porvenir

        Neighborhood::create([
            'id' => 6466,
            'name' => 'Barrio Porvenir',
            'city_id' => 3141,

        ]);

        //Barrio Presidente Peron

        Neighborhood::create([
            'id' => 6467,
            'name' => 'Barrio Presidente Peron',
            'city_id' => 3142,

        ]);

        //Barrio Puente 83

        Neighborhood::create([
            'id' => 6468,
            'name' => 'Barrio Puente 83',
            'city_id' => 3143,

        ]);

        //Barrio Puente Cero

        Neighborhood::create([
            'id' => 6469,
            'name' => 'Barrio Puente Cero',
            'city_id' => 3144,

        ]);

        //Barrio Santa Rita

        Neighborhood::create([
            'id' => 6470,
            'name' => 'Barrio Santa Rita',
            'city_id' => 3145,

        ]);

        //Barrio Union

        Neighborhood::create([
            'id' => 6471,
            'name' => 'Barrio Union',
            'city_id' => 3146,

        ]);

        //Boca de la Travesía

        Neighborhood::create([
            'id' => 6472,
            'name' => 'Boca de la Travesía',
            'city_id' => 3147,

        ]);

        //Campo Grande

        Neighborhood::create([
            'id' => 6473,
            'name' => 'Campo Grande',
            'city_id' => 3148,

        ]);

        //Catriel

        Neighborhood::create([
            'id' => 6474,
            'name' => 'Catriel',
            'city_id' => 3149,

        ]);

        //Cañadon Chileno

        Neighborhood::create([
            'id' => 6475,
            'name' => 'Cañadon Chileno',
            'city_id' => 3150,

        ]);

        //Cerro Policía

        Neighborhood::create([
            'id' => 6476,
            'name' => 'Cerro Policía',
            'city_id' => 3151,

        ]);

        //Cervantes

        Neighborhood::create([
            'id' => 6477,
            'name' => 'Cervantes',
            'city_id' => 3152,

        ]);

        //Chacay Huarruca

        Neighborhood::create([
            'id' => 6478,
            'name' => 'Chacay Huarruca',
            'city_id' => 3153,

        ]);

        //Chasico

        Neighborhood::create([
            'id' => 6479,
            'name' => 'Chasico',
            'city_id' => 3154,

        ]);

        //Chelforó

        Neighborhood::create([
            'id' => 6480,
            'name' => 'Chelforó',
            'city_id' => 3155,

        ]);

        //Chenqueniyeu

        Neighborhood::create([
            'id' => 6481,
            'name' => 'Chenqueniyeu',
            'city_id' => 3156,

        ]);

        //Chinchinales

        Neighborhood::create([
            'id' => 6482,
            'name' => 'Chinchinales',
            'city_id' => 3157,

        ]);

        //Chipauquil

        Neighborhood::create([
            'id' => 6483,
            'name' => 'Chipauquil',
            'city_id' => 3158,

        ]);

        //Choele Choel

        Neighborhood::create([
            'id' => 6484,
            'name' => 'Choele Choel',
            'city_id' => 3159,

        ]);

        //Cinco Saltos

        Neighborhood::create([
            'id' => 6485,
            'name' => 'Cinco Saltos',
            'city_id' => 3160,

        ]);

        //Clemente Onelli

        Neighborhood::create([
            'id' => 6486,
            'name' => 'Clemente Onelli',
            'city_id' => 3161,

        ]);

        //Colan Conhue

        Neighborhood::create([
            'id' => 6487,
            'name' => 'Colan Conhue',
            'city_id' => 3162,

        ]);

        //Colonia Chocori

        Neighborhood::create([
            'id' => 6488,
            'name' => 'Colonia Chocori',
            'city_id' => 3163,

        ]);

        //Colonia Fátima

        Neighborhood::create([
            'id' => 6489,
            'name' => 'Colonia Fátima',
            'city_id' => 3164,

        ]);

        //Colonia Josefa

        Neighborhood::create([
            'id' => 6490,
            'name' => 'Colonia Josefa',
            'city_id' => 3165,

        ]);

        //Colonia Julia y Echarren

        Neighborhood::create([
            'id' => 6491,
            'name' => 'Colonia Julia y Echarren',
            'city_id' => 3166,

        ]);

        //Colonia La Luisa

        Neighborhood::create([
            'id' => 6492,
            'name' => 'La Luisa',
            'city_id' => 3167,

        ]);

        //Colonia Peñas Blancas

        Neighborhood::create([
            'id' => 6493,
            'name' => 'Colonia Peñas Blancas',
            'city_id' => 3168,

        ]);

        //Colonia San Juan

        Neighborhood::create([
            'id' => 6494,
            'name' => 'Colonia San Juan',
            'city_id' => 3169,

        ]);

        //Colonia Santa Rosa

        Neighborhood::create([
            'id' => 6495,
            'name' => 'Colonia Santa Rosa',
            'city_id' => 3170,

        ]);

        //Colonia Santa Teresita

        Neighborhood::create([
            'id' => 6496,
            'name' => 'Colonia Santa Teresita',
            'city_id' => 3171,

        ]);

        //Colonia Suiza

        Neighborhood::create([
            'id' => 6497,
            'name' => 'Colonia Suiza',
            'city_id' => 3172,

        ]);

        //Colonia Comallo

        Neighborhood::create([
            'id' => 6498,
            'name' => 'Colonia Comallo',
            'city_id' => 3173,

        ]);

        //Comicó

        Neighborhood::create([
            'id' => 6499,
            'name' => 'Comicó',
            'city_id' => 3174,

        ]);

        //Cona Niyeu

        Neighborhood::create([
            'id' => 6500,
            'name' => 'Cona Niyeu',
            'city_id' => 3175,

        ]);

        //Contralmirante Cordero

        Neighborhood::create([
            'id' => 6501,
            'name' => 'Contralmirante Cordero',
            'city_id' => 3176,

        ]);

        //Coronel Belisle

        Neighborhood::create([
            'id' => 6502,
            'name' => 'Coronel Belisle',
            'city_id' => 3177,

        ]);

        //Coronel Eugenio del Busto

        Neighborhood::create([
            'id' => 6503,
            'name' => 'Coronel Eugenio del Busto',
            'city_id' => 3178,

        ]);

        //Coronel Fco Sosa

        Neighborhood::create([
            'id' => 6504,
            'name' => 'Coronel Fco Sosa',
            'city_id' => 3179,

        ]);

        //Coronel J J Gomez

        Neighborhood::create([
            'id' => 6505,
            'name' => 'Coronel J.J Gomez',
            'city_id' => 3180,

        ]);

        //Costa de Río

        Neighborhood::create([
            'id' => 6506,
            'name' => 'Costa de Río',
            'city_id' => 3181,

        ]);

        //Cubanea

        Neighborhood::create([
            'id' => 6507,
            'name' => 'Cubanea',
            'city_id' => 3182,

        ]);

        //Cuesta del Ternero

        Neighborhood::create([
            'id' => 6508,
            'name' => 'Cuesta del Ternero',
            'city_id' => 3183,

        ]);

        //Darwin

        Neighborhood::create([
            'id' => 6509,
            'name' => 'Darwin',
            'city_id' => 3184,

        ]);

        //Dina Huapi

        Neighborhood::create([
            'id' => 6510,
            'name' => 'Dina Huapi',
            'city_id' => 3185,

        ]);

        //El Caín

        Neighborhood::create([
            'id' => 6511,
            'name' => 'El Caín',
            'city_id' => 3186,

        ]);

        //El Condor

        Neighborhood::create([
            'id' => 6512,
            'name' => 'El Condor',
            'city_id' => 3187,

        ]);

        //El Cuy

        Neighborhood::create([
            'id' => 6513,
            'name' => 'El Cuy',
            'city_id' => 3188,

        ]);

        //El Foyel

        Neighborhood::create([
            'id' => 6514,
            'name' => 'El Foyel',
            'city_id' => 3189,

        ]);

        //El Juncal

        Neighborhood::create([
            'id' => 6515,
            'name' => 'El Juncal',
            'city_id' => 3190,

        ]);

        //El Manso

        Neighborhood::create([
            'id' => 6516,
            'name' => 'El Manso',
            'city_id' => 3191,

        ]);

        //El Rincón

        Neighborhood::create([
            'id' => 6517,
            'name' => 'El Rincón',
            'city_id' => 3192,

        ]);

        //Ferri

        Neighborhood::create([
            'id' => 6518,
            'name' => 'Ferri',
            'city_id' => 3193,

        ]);

        //Fitalancao

        Neighborhood::create([
            'id' => 6519,
            'name' => 'Fitalancao',
            'city_id' => 3194,

        ]);

        //Fortin Uno

        Neighborhood::create([
            'id' => 6520,
            'name' => 'Fortin Uno',
            'city_id' => 3195,

        ]);

        //Futa Ruin

        Neighborhood::create([
            'id' => 6521,
            'name' => 'Futa Ruin',
            'city_id' => 3196,

        ]);

        //General Conesa

        Neighborhood::create([
            'id' => 6522,
            'name' => 'General Conesa',
            'city_id' => 3197,

        ]);

        //General Enrique Godoy

        Neighborhood::create([
            'id' => 6523,
            'name' => 'General Enrique Godoy',
            'city_id' => 3198,

        ]);

        //General L Bernal

        Neighborhood::create([
            'id' => 6524,
            'name' => 'General L Bernal',
            'city_id' => 3199,

        ]);


        //Los Menucos

        Neighborhood::create([
            'id' => 6525,
            'name' => 'Los Menucos',
            'city_id' => 3216,

        ]);

        //Los Repollos

        Neighborhood::create([
            'id' => 6526,
            'name' => 'Los Repollos',
            'city_id' => 3217,

        ]);

        //Luis Beltrán

        Neighborhood::create([
            'id' => 6527,
            'name' => 'Luis Beltrán',
            'city_id' => 3218,

        ]);

        //Mainqué

        Neighborhood::create([
            'id' => 6528,
            'name' => 'Mainqué',
            'city_id' => 3219,

        ]);

        //Mallín Ahogado

        Neighborhood::create([
            'id' => 6529,
            'name' => 'Mallín Ahogado',
            'city_id' => 3220,

        ]);

        //Mamuel Choique

        Neighborhood::create([
            'id' => 6530,
            'name' => 'Mamuel Choique',
            'city_id' => 3221,

        ]);

        //Maquinchao

        Neighborhood::create([
            'id' => 6531,
            'name' => 'Maquinchao',
            'city_id' => 3222,

        ]);

        //Mencué

        Neighborhood::create([
            'id' => 6532,
            'name' => 'Mencué',
            'city_id' => 3223,

        ]);

        //Mina Santa Teresita

        Neighborhood::create([
            'id' => 6533,
            'name' => 'Mina Santa Teresita',
            'city_id' => 3224,

        ]);

        //Ministro Ramos Mexia

        Neighborhood::create([
            'id' => 6534,
            'name' => 'Ministro Ramos Mexia',
            'city_id' => 3225,

        ]);

        //Nahuel Niyeu

        Neighborhood::create([
            'id' => 6535,
            'name' => 'Nahuel Niyeu',
            'city_id' => 3226,

        ]);

        //Naupe Huen

        Neighborhood::create([
            'id' => 6536,
            'name' => 'Naupe Huen',
            'city_id' => 3227,

        ]);

        //Ojos de Agua

        Neighborhood::create([
            'id' => 6537,
            'name' => 'Ojos de Agua',
            'city_id' => 3228,

        ]);


        //Padre Stefanelli

        Neighborhood::create([
            'id' => 6539,
            'name' => 'Padre Stefanelli',
            'city_id' => 3230,

        ]);

        //Paja Alta

        Neighborhood::create([
            'id' => 6540,
            'name' => 'Paja Alta',
            'city_id' => 3231,

        ]);

        //Paso Cordoba

        Neighborhood::create([
            'id' => 6541,
            'name' => 'Paso Cordoba',
            'city_id' => 3232,

        ]);

        //Paso Flores

        Neighborhood::create([
            'id' => 6542,
            'name' => 'Paso Flores',
            'city_id' => 3233,

        ]);

        //Península Ruca Co

        Neighborhood::create([
            'id' => 6543,
            'name' => 'Península Ruca Co',
            'city_id' => 3234,

        ]);

        //Peñas Blancas

        Neighborhood::create([
            'id' => 6544,
            'name' => 'Peñas Blancas',
            'city_id' => 3235,

        ]);

        //Pichi Mahuida

        Neighborhood::create([
            'id' => 6545,
            'name' => 'Pichi Mahuida',
            'city_id' => 3236,

        ]);

        //Pilcaniyeu

        Neighborhood::create([
            'id' => 6546,
            'name' => 'Pilcaniyeu',
            'city_id' => 3237,

        ]);

        //Pilquiniyeu

        Neighborhood::create([
            'id' => 6547,
            'name' => 'Pilquiniyeu',
            'city_id' => 3238,

        ]);

        //Pilquiniyeu del Limay

        Neighborhood::create([
            'id' => 6548,
            'name' => 'Pilquiniyeu del Limay',
            'city_id' => 3239,

        ]);

        //Playas Doradas

        Neighborhood::create([
            'id' => 6549,
            'name' => 'Playas Doradas',
            'city_id' => 3240,

        ]);

        //Pomona

        Neighborhood::create([
            'id' => 6550,
            'name' => 'Pomona',
            'city_id' => 3241,

        ]);

        //Pozo Salado

        Neighborhood::create([
            'id' => 6551,
            'name' => 'Pozo Salado',
            'city_id' => 3242,

        ]);

        //Prahuaniyeu

        Neighborhood::create([
            'id' => 6552,
            'name' => 'Prahuaniyeu',
            'city_id' => 3243,

        ]);

        //Puerto Blest

        Neighborhood::create([
            'id' => 6553,
            'name' => 'Puerto Blest',
            'city_id' => 3244,

        ]);

        //Puerto Frías

        Neighborhood::create([
            'id' => 6554,
            'name' => 'Puerto Frías',
            'city_id' => 3245,

        ]);

        //Punta Colorada

        Neighborhood::create([
            'id' => 6555,
            'name' => 'Punta Colorada',
            'city_id' => 3246,

        ]);

        //Río Foyel

        Neighborhood::create([
            'id' => 6556,
            'name' => 'Río Foyel',
            'city_id' => 3247,

        ]);

        //Río Chico (Est Cerro Mesa)

        Neighborhood::create([
            'id' => 6557,
            'name' => 'Río Chico (Est Cerro Mesa)',
            'city_id' => 3248,

        ]);

        //Río Colorado

        Neighborhood::create([
            'id' => 6558,
            'name' => 'Río Colorado',
            'city_id' => 3249,

        ]);



        //Sierra Grande

        Neighborhood::create([
            'id' => 6559,
            'name' => 'Sierra Grande',
            'city_id' => 3258,

        ]);

        //Sierra Pailemán

        Neighborhood::create([
            'id' => 6560,
            'name' => 'Sierra Pailemán',
            'city_id' => 3259,

        ]);

        //Treneta

        Neighborhood::create([
            'id' => 6561,
            'name' => 'Treneta',
            'city_id' => 3260,

        ]);

        //Trica Có

        Neighborhood::create([
            'id' => 6562,
            'name' => 'Trica Có',
            'city_id' => 3261,

        ]);

        //Valcheta

        Neighborhood::create([
            'id' => 6563,
            'name' => 'Valcheta',
            'city_id' => 3262,

        ]);

        //Valle Azul

        Neighborhood::create([
            'id' => 6564,
            'name' => 'Valle Azul',
            'city_id' => 3263,

        ]);

        //Vicealmirante E O´Connor

        Neighborhood::create([
            'id' => 6565,
            'name' => 'Vicealmirante E O´Connor',
            'city_id' => 3264,

        ]);

        //Viedma

        Neighborhood::create([
            'id' => 6566,
            'name' => 'Viedma',
            'city_id' => 3265,

        ]);

        //Villa Alberdi

        Neighborhood::create([
            'id' => 6567,
            'name' => 'Villa Alberdi',
            'city_id' => 3266,

        ]);

        //Villa Campanario

        Neighborhood::create([
            'id' => 6568,
            'name' => 'Villa Campanario',
            'city_id' => 3267,

        ]);

        //Villa Cerro Catedral

        Neighborhood::create([
            'id' => 6569,
            'name' => 'Villa Cerro Catedral',
            'city_id' => 3268,

        ]);

        //Villa del Parque

        Neighborhood::create([
            'id' => 6570,
            'name' => 'Villa del Parque',
            'city_id' => 3269,

        ]);

        //Villa Llanquin

        Neighborhood::create([
            'id' => 6571,
            'name' => 'Villa Llanquin',
            'city_id' => 3270,

        ]);

        //Villa Llao Llao

        Neighborhood::create([
            'id' => 6572,
            'name' => 'Villa Llao Llao',
            'city_id' => 3271,

        ]);

        //Villa Los Coihues

        Neighborhood::create([
            'id' => 6573,
            'name' => 'Villa Los Coihues',
            'city_id' => 3272,

        ]);

        //Villa Manzano

        Neighborhood::create([
            'id' => 6574,
            'name' => 'Villa Manzano',
            'city_id' => 3273,

        ]);

        //Villa Mascardi

        Neighborhood::create([
            'id' => 6575,
            'name' => 'Villa Mascardi',
            'city_id' => 3274,

        ]);

        //Villa Regina

        Neighborhood::create([
            'id' => 6576,
            'name' => 'Villa Regina',
            'city_id' => 3275,

        ]);

        //Villa San Isidro

        Neighborhood::create([
            'id' => 6577,
            'name' => 'Villa San Isidro',
            'city_id' => 3276,

        ]);

        //Yaminué

        Neighborhood::create([
            'id' => 6578,
            'name' => 'Yaminué',
            'city_id' => 3277,

        ]);

        //Zanjón de Oyuela

        Neighborhood::create([
            'id' => 6579,
            'name' => 'Zanjón de Oyuela',
            'city_id' => 3278,

        ]);

        //Salta

        Neighborhood::create([
            'id' => 6580,
            'name' => 'Centro Ciudad',
            'city_id' => 3279,

        ]);

        Neighborhood::create([
            'id' => 6581,
            'name' => 'Tres Cerritos',
            'city_id' => 3279,

        ]);


        Neighborhood::create([
            'id' => 6582,
            'name' => 'Praderas San Lorenzo',
            'city_id' => 3279,

        ]);


        Neighborhood::create([
            'id' => 6583,
            'name' => 'Valle Escondido',
            'city_id' => 3279,

        ]);


        Neighborhood::create([
            'id' => 6584,
            'name' => 'La Almudena',
            'city_id' => 3279,

        ]);


        Neighborhood::create([
            'id' => 6585,
            'name' => '20 de Febrero',
            'city_id' => 3279,

        ]);


        Neighborhood::create([
            'id' => 6586,
            'name' => 'Ayres de los Andes',
            'city_id' => 3279,

        ]);


        Neighborhood::create([
            'id' => 6587,
            'name' => 'La Aguada',
            'city_id' => 3279,

        ]);


        Neighborhood::create([
            'id' => 6588,
            'name' => 'La Fidelina',
            'city_id' => 3279,

        ]);


        Neighborhood::create([
            'id' => 6589,
            'name' => 'La Lucinda',
            'city_id' => 3279,

        ]);

        Neighborhood::create([
            'id' => 6590,
            'name' => 'La Lucinda II',
            'city_id' => 3279,

        ]);

        Neighborhood::create([
            'id' => 6591,
            'name' => 'Los Olmos',
            'city_id' => 3279,

        ]);

        Neighborhood::create([
            'id' => 6592,
            'name' => 'Los Prados de la Merced Chica',
            'city_id' => 3279,

        ]);


        Neighborhood::create([
            'id' => 6593,
            'name' => 'Santa María de la Aguada',
            'city_id' => 3279,

        ]);

        Neighborhood::create([
            'id' => 6594,
            'name' => 'Villa Mercedes',
            'city_id' => 3279,

        ]);

        //San Lorenzo

        Neighborhood::create([
            'id' => 6595,
            'name' => 'Altos de San Lorenzo',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6596,
            'name' => 'Terrazas de San Lorenzo',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6597,
            'name' => 'El Tipal',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6598,
            'name' => 'La Aguada',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6599,
            'name' => 'Castell La Hoyada',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6600,
            'name' => 'Belisario Roldan',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6601,
            'name' => 'Buena Vista',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6602,
            'name' => 'Chacras Santa María',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6603,
            'name' => 'Finca La Montaña',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6604,
            'name' => 'La Trinidad I',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6605,
            'name' => 'Las Vertientes',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6606,
            'name' => 'Los Berros',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6607,
            'name' => 'Los Zarzos',
            'city_id' => 3280,

        ]);

        Neighborhood::create([
            'id' => 6608,
            'name' => 'Praderas de San Lorenzo',
            'city_id' => 3280,

        ]);

        //Cerrillos

        Neighborhood::create([
            'id' => 6609,
            'name' => 'Cerrillos',
            'city_id' => 3281,

        ]);

        //Rosario de Lerma

        Neighborhood::create([
            'id' => 6610,
            'name' => 'Rosario de Lerma',
            'city_id' => 3282,

        ]);

        //Cafayate

        Neighborhood::create([
            'id' => 6611,
            'name' => 'La Estancia de Cafayate Wine & Golf',
            'city_id' => 3283,

        ]);

        //Acambuco

        Neighborhood::create([
            'id' => 6612,
            'name' => 'Acambuco',
            'city_id' => 3284,

        ]);

        //Acoyte

        Neighborhood::create([
            'id' => 6613,
            'name' => 'Acoyte',
            'city_id' => 3285,

        ]);

        //Agua Negra

        Neighborhood::create([
            'id' => 6614,
            'name' => 'Agua Negra',
            'city_id' => 3286,

        ]);

        //Aguaray

        Neighborhood::create([
            'id' => 6615,
            'name' => 'Aguaray',
            'city_id' => 3287,

        ]);

        //Aguas Blancas

        Neighborhood::create([
            'id' => 6616,
            'name' => 'Aguas Blancas',
            'city_id' => 3288,

        ]);

        //Alemania

        Neighborhood::create([
            'id' => 6617,
            'name' => 'Alemania',
            'city_id' => 3289,

        ]);

        //Alfarcito

        Neighborhood::create([
            'id' => 6618,
            'name' => 'Alfarcito',
            'city_id' => 3290,

        ]);

        //Algarrobal

        Neighborhood::create([
            'id' => 6619,
            'name' => 'Algarrobal',
            'city_id' => 3291,

        ]);

        //Almirante Brown

        Neighborhood::create([
            'id' => 6620,
            'name' => 'Almirante Brown',
            'city_id' => 3292,

        ]);

        //Alto de la Sierra

        Neighborhood::create([
            'id' => 6621,
            'name' => 'Alto de la Sierra',
            'city_id' => 3293,

        ]);

        //Alto del Mistol

        Neighborhood::create([
            'id' => 6622,
            'name' => 'Alto del Mistol',
            'city_id' => 3294,

        ]);

        //Alto Verde

        Neighborhood::create([
            'id' => 6623,
            'name' => 'Alto Verde',
            'city_id' => 3295,

        ]);

        //Amberes

        Neighborhood::create([
            'id' => 6624,
            'name' => 'Amberes',
            'city_id' => 3296,

        ]);

        //Amblayo

        Neighborhood::create([
            'id' => 6625,
            'name' => 'Amblayo',
            'city_id' => 3297,

        ]);

        //Ampasachi

        Neighborhood::create([
            'id' => 6626,
            'name' => 'Ampasachi',
            'city_id' => 3298,

        ]);

        //Angastaco

        Neighborhood::create([
            'id' => 6627,
            'name' => 'Angastaco',
            'city_id' => 3299,

        ]);

        //Angostura

        Neighborhood::create([
            'id' => 6628,
            'name' => 'Angostura',
            'city_id' => 3300,

        ]);

        //Animaná

        Neighborhood::create([
            'id' => 6629,
            'name' => 'Animaná',
            'city_id' => 3301,

        ]);

        //Antilla

        Neighborhood::create([
            'id' => 6630,
            'name' => 'Antilla',
            'city_id' => 3302,

        ]);

        //Apeadero Cochabamba

        Neighborhood::create([
            'id' => 6631,
            'name' => 'Apeadero Cochabamba',
            'city_id' => 3303,

        ]);

        //Apolinerio Saravia

        Neighborhood::create([
            'id' => 6632,
            'name' => 'Apolinerio Saravia',
            'city_id' => 3304,

        ]);

        //Arenal

        Neighborhood::create([
            'id' => 6633,
            'name' => 'Arenal',
            'city_id' => 3305,

        ]);

        //Atocha

        Neighborhood::create([
            'id' => 6634,
            'name' => 'Atocha',
            'city_id' => 3306,

        ]);

        //Bajo Grande

        Neighborhood::create([
            'id' => 6635,
            'name' => 'Bajo Grande',
            'city_id' => 3307,

        ]);

        //Balboa

        Neighborhood::create([
            'id' => 6636,
            'name' => 'Balboa',
            'city_id' => 3308,

        ]);

        //Barrio El Jardín de San Martín

        Neighborhood::create([
            'id' => 6637,
            'name' => 'Barrio El Jardín de San Martín',
            'city_id' => 3309,

        ]);

        //Barrio El Milagro

        Neighborhood::create([
            'id' => 6638,
            'name' => 'Barrio El Milagro',
            'city_id' => 3310,

        ]);

        //Belgrano

        Neighborhood::create([
            'id' => 6639,
            'name' => 'Belgrano',
            'city_id' => 3311,

        ]);

        //Betania

        Neighborhood::create([
            'id' => 6640,
            'name' => 'Betania',
            'city_id' => 3312,

        ]);

        //Brealito

        Neighborhood::create([
            'id' => 6641,
            'name' => 'Brealito',
            'city_id' => 3313,

        ]);

        //Cabeza de buey

        Neighborhood::create([
            'id' => 6642,
            'name' => 'Cabeza de Buey',
            'city_id' => 3314,

        ]);

        //Cabra Corral

        Neighborhood::create([
            'id' => 6643,
            'name' => 'Cabra Corral',
            'city_id' => 3315,

        ]);

        //Cachi

        Neighborhood::create([
            'id' => 6644,
            'name' => 'Cachi',
            'city_id' => 3316,

        ]);

        //Cachi Adentro

        Neighborhood::create([
            'id' => 6645,
            'name' => 'Cachi Adentro',
            'city_id' => 3317,

        ]);

        //Cachiñal

        Neighborhood::create([
            'id' => 6646,
            'name' => 'Cachiñal',
            'city_id' => 3318,

        ]);

        //Caipe

        Neighborhood::create([
            'id' => 6647,
            'name' => 'Caipe',
            'city_id' => 3319,

        ]);

        //Calvimonte

        Neighborhood::create([
            'id' => 6648,
            'name' => 'Calvimonte',
            'city_id' => 3320,

        ]);

        //Campamento Vespucio

        Neighborhood::create([
            'id' => 6649,
            'name' => 'Campamento Vespucio',
            'city_id' => 3321,

        ]);

        //Campichuelo

        Neighborhood::create([
            'id' => 6650,
            'name' => 'Campichuelo ',
            'city_id' => 3322,

        ]);

        //Campo Durán

        Neighborhood::create([
            'id' => 6651,
            'name' => 'Campo Durán',
            'city_id' => 3323,

        ]);

        //Campo La Cruz

        Neighborhood::create([
            'id' => 6652,
            'name' => 'Campo La Cruz',
            'city_id' => 3324,

        ]);

        //Campo la Paz

        Neighborhood::create([
            'id' => 6653,
            'name' => 'Campo La Paz',
            'city_id' => 3325,

        ]);

        //Campo Quijano

        Neighborhood::create([
            'id' => 6654,
            'name' => 'Campo Quijano',
            'city_id' => 3326,

        ]);

        //Campo Santo

        Neighborhood::create([
            'id' => 6655,
            'name' => 'Campo Santo',
            'city_id' => 3327,

        ]);

        //Capiazuti

        Neighborhood::create([
            'id' => 6656,
            'name' => 'Capiazuti',
            'city_id' => 3328,

        ]);

        //Capitán Juan Pagé

        Neighborhood::create([
            'id' => 6657,
            'name' => 'Capitán Juan Pagé',
            'city_id' => 3329,

        ]);

        //Carboncito

        Neighborhood::create([
            'id' => 6658,
            'name' => 'Carboncito',
            'city_id' => 3330,

        ]);

        //Castellanos

        Neighborhood::create([
            'id' => 6659,
            'name' => 'Castellanos',
            'city_id' => 3331,

        ]);

        //Cebilar

        Neighborhood::create([
            'id' => 6660,
            'name' => 'Cebilar',
            'city_id' => 3332,

        ]);

        //Ceibalito

        Neighborhood::create([
            'id' => 6661,
            'name' => 'Ceibalito',
            'city_id' => 3333,

        ]);

        //Centro 25 de Junio

        Neighborhood::create([
            'id' => 6662,
            'name' => 'Centro 25 de Junio',
            'city_id' => 3334,

        ]);

        //Cerro Negro

        Neighborhood::create([
            'id' => 6663,
            'name' => 'Cerro Negro',
            'city_id' => 3335,

        ]);

        //Chaguaral

        Neighborhood::create([
            'id' => 6664,
            'name' => 'Chaguaral',
            'city_id' => 3336,

        ]);

        //Chicoana

        Neighborhood::create([
            'id' => 6665,
            'name' => 'Chicoana',
            'city_id' => 3337,

        ]);

        //Chicoana

        Neighborhood::create([
            'id' => 6666,
            'name' => 'Chiyayoc',
            'city_id' => 3338,

        ]);

        //Chorrillos

        Neighborhood::create([
            'id' => 6667,
            'name' => 'Chorrillos',
            'city_id' => 3339,

        ]);

        //Chorroarín

        Neighborhood::create([
            'id' => 6668,
            'name' => 'Chorroarín',
            'city_id' => 3340,

        ]);

        //Chuchulaqui

        Neighborhood::create([
            'id' => 6669,
            'name' => 'Chuculaqui',
            'city_id' => 3341,

        ]);

        //Cobos

        Neighborhood::create([
            'id' => 6670,
            'name' => 'Cobos',
            'city_id' => 3342,

        ]);

        //Cobres

        Neighborhood::create([
            'id' => 6671,
            'name' => 'Cobres',
            'city_id' => 3343,

        ]);

        //Colanzuli

        Neighborhood::create([
            'id' => 6672,
            'name' => 'Colanzuli',
            'city_id' => 3344,

        ]);

        //Colomé

        Neighborhood::create([
            'id' => 6673,
            'name' => 'Colomé',
            'city_id' => 3345,

        ]);

        //Colonia Santa Rosa

        Neighborhood::create([
            'id' => 6674,
            'name' => 'Colonia Santa Rosa',
            'city_id' => 3346,

        ]);

        //Copo Quile

        Neighborhood::create([
            'id' => 6675,
            'name' => 'Copo Quile',
            'city_id' => 3347,

        ]);

        //Coronel Cornejo

        Neighborhood::create([
            'id' => 6676,
            'name' => 'Coronel Cornejo',
            'city_id' => 3348,

        ]);

        //Coronel Juan Solá

        Neighborhood::create([
            'id' => 6677,
            'name' => 'Coronel Juan Sola',
            'city_id' => 3349,

        ]);

        //Coronel Mollinedo

        Neighborhood::create([
            'id' => 6678,
            'name' => 'Coronel Moldes',
            'city_id' => 3350,

        ]);

        //Coronel Mollinedo

        Neighborhood::create([
            'id' => 6679,
            'name' => 'Coronel Mollinedo',
            'city_id' => 3351,

        ]);

        //Coronel Olleros

        Neighborhood::create([
            'id' => 6680,
            'name' => 'Coronel Olleros',
            'city_id' => 3352,

        ]);

        //Corralito

        Neighborhood::create([
            'id' => 6681,
            'name' => 'Corralito',
            'city_id' => 3353,

        ]);

        //Cruz Quemada

        Neighborhood::create([
            'id' => 6682,
            'name' => 'Cruz Quemada',
            'city_id' => 3354,

        ]);

        //Curva del Turco

        Neighborhood::create([
            'id' => 6683,
            'name' => 'Curva del Turco',
            'city_id' => 3355,

        ]);

        //Diego de Almagro

        Neighborhood::create([
            'id' => 6684,
            'name' => 'Diego del Almagro',
            'city_id' => 3356,

        ]);

        //Dragones

        Neighborhood::create([
            'id' => 6685,
            'name' => 'Dragones',
            'city_id' => 3357,

        ]);

        //Ebro

        Neighborhood::create([
            'id' => 6686,
            'name' => 'Ebro',
            'city_id' => 3358,

        ]);

        //El Alisal

        Neighborhood::create([
            'id' => 6687,
            'name' => 'El Alisal',
            'city_id' => 3359,

        ]);

        //El Angosto

        Neighborhood::create([
            'id' => 6688,
            'name' => 'El Angosto',
            'city_id' => 3360,

        ]);

        //El Barrial

        Neighborhood::create([
            'id' => 6689,
            'name' => 'El Barrial',
            'city_id' => 3361,

        ]);

        //El Bordo

        Neighborhood::create([
            'id' => 6690,
            'name' => 'El Bordo',
            'city_id' => 3362,

        ]);

        //El Brete

        Neighborhood::create([
            'id' => 6691,
            'name' => 'El Brete',
            'city_id' => 3363,

        ]);

        //El Carmen

        Neighborhood::create([
            'id' => 6692,
            'name' => 'El Carmen',
            'city_id' => 3364,

        ]);

        //El Carril

        Neighborhood::create([
            'id' => 6693,
            'name' => 'El Carril',
            'city_id' => 3365,

        ]);

        //El Ceibal

        Neighborhood::create([
            'id' => 6694,
            'name' => 'El Ceibal',
            'city_id' => 3366,

        ]);

        //El Churcal

        Neighborhood::create([
            'id' => 6695,
            'name' => 'El Churcal',
            'city_id' => 3367,

        ]);

        //El Espinillo

        Neighborhood::create([
            'id' => 6696,
            'name' => 'El Espinillo',
            'city_id' => 3368,

        ]);



        //Guachipas

        Neighborhood::create([
            'id' => 6697,
            'name' => 'Guachipas',
            'city_id' => 3399,

        ]);

        //Hickman

        Neighborhood::create([
            'id' => 6698,
            'name' => 'Hickman',
            'city_id' => 3400,

        ]);

        //Hipólito Yrigoyen

        Neighborhood::create([
            'id' => 6699,
            'name' => 'Hipólito Yrigoyen',
            'city_id' => 3401,

        ]);

        //Horcones

        Neighborhood::create([
            'id' => 6700,
            'name' => 'Horcones',
            'city_id' => 3402,

        ]);

        //Incahuasi

        Neighborhood::create([
            'id' => 6701,
            'name' => 'Incahuasi',
            'city_id' => 3403,

        ]);

        //Incamayo

        Neighborhood::create([
            'id' => 6702,
            'name' => 'Incamayo',
            'city_id' => 3404,

        ]);

        //Ingeniero Maury

        Neighborhood::create([
            'id' => 6703,
            'name' => 'Ingeniero Maury',
            'city_id' => 3405,

        ]);

        //Ingenio San Martín del Tabacal

        Neighborhood::create([
            'id' => 6704,
            'name' => 'Ingenio San Martín del Tabacal',
            'city_id' => 3406,

        ]);

        //Iruya

        Neighborhood::create([
            'id' => 6705,
            'name' => 'Iruya',
            'city_id' => 3407,

        ]);

        //Isla de Cañas

        Neighborhood::create([
            'id' => 6706,
            'name' => 'Isla de Cañas',
            'city_id' => 3408,

        ]);

        //Jerónimo Matorras

        Neighborhood::create([
            'id' => 6707,
            'name' => 'Jerónimo Matorras',
            'city_id' => 3409,

        ]);

        //Joaquín Víctor González

        Neighborhood::create([
            'id' => 6708,
            'name' => 'Joaquín Víctor González',
            'city_id' => 3410,

        ]);

        //Juramento

        Neighborhood::create([
            'id' => 6709,
            'name' => 'Juramento',
            'city_id' => 3411,

        ]);

        //Kilómetro 1094

        Neighborhood::create([
            'id' => 6710,
            'name' => 'Kilómetro 1094',
            'city_id' => 3412,

        ]);

        //Kilómetro 1281

        Neighborhood::create([
            'id' => 6711,
            'name' => 'Kilómetro 1282',
            'city_id' => 3413,

        ]);

        //La Caldera

        Neighborhood::create([
            'id' => 6712,
            'name' => 'La Caldera',
            'city_id' => 3414,

        ]);

        //La Calderilla

        Neighborhood::create([
            'id' => 6713,
            'name' => 'La Calderilla',
            'city_id' => 3415,

        ]);

        //La Candelaria

        Neighborhood::create([
            'id' => 6714,
            'name' => 'La Candelaria',
            'city_id' => 3416,

        ]);

        //La Ciénaga

        Neighborhood::create([
            'id' => 6715,
            'name' => 'La Ciénaga',
            'city_id' => 3417,

        ]);

        //La Corzuela

        Neighborhood::create([
            'id' => 6716,
            'name' => 'La Corzuela',
            'city_id' => 3418,

        ]);

        //La Curvita

        Neighborhood::create([
            'id' => 6717,
            'name' => 'La Curvita',
            'city_id' => 3419,

        ]);

        //La Esperanza

        Neighborhood::create([
            'id' => 6718,
            'name' => 'La Esperanza',
            'city_id' => 3420,

        ]);

        //La Estrella

        Neighborhood::create([
            'id' => 6719,
            'name' => 'La Estrella',
            'city_id' => 3421,

        ]);

        //La Merced

        Neighborhood::create([
            'id' => 6720,
            'name' => 'La Merced',
            'city_id' => 3422,

        ]);

        //La Misión

        Neighborhood::create([
            'id' => 6721,
            'name' => 'La Misión',
            'city_id' => 3423,

        ]);

        //La Paya

        Neighborhood::create([
            'id' => 6722,
            'name' => 'La Paya',
            'city_id' => 3424,

        ]);

        //La Poma

        Neighborhood::create([
            'id' => 6723,
            'name' => 'La Poma',
            'city_id' => 3425,

        ]);

        //La Puerta

        Neighborhood::create([
            'id' => 6724,
            'name' => 'La Puerta',
            'city_id' => 3426,

        ]);

        //La Puntana

        Neighborhood::create([
            'id' => 6725,
            'name' => 'La Puntana',
            'city_id' => 3427,

        ]);

        //La Quena

        Neighborhood::create([
            'id' => 6726,
            'name' => 'La Quena',
            'city_id' => 3428,

        ]);

        //La Silleta

        Neighborhood::create([
            'id' => 6727,
            'name' => 'La Silleta',
            'city_id' => 3429,

        ]);

        //La Unión

        Neighborhood::create([
            'id' => 6728,
            'name' => 'La Unión',
            'city_id' => 3430,

        ]);

        //La Viña

        Neighborhood::create([
            'id' => 6729,
            'name' => 'La Viña',
            'city_id' => 3431,

        ]);

        //La Zanja

        Neighborhood::create([
            'id' => 6730,
            'name' => 'La Zanja',
            'city_id' => 3432,

        ]);

        //Laguna Seca

        Neighborhood::create([
            'id' => 6731,
            'name' => 'Laguna Seca',
            'city_id' => 3433,

        ]);

        //Las Conchas

        Neighborhood::create([
            'id' => 6732,
            'name' => 'Las Conchas',
            'city_id' => 3434,

        ]);

        //Las Costas

        Neighborhood::create([
            'id' => 6733,
            'name' => 'Las Costas',
            'city_id' => 3435,

        ]);

        //Las Cuevas

        Neighborhood::create([
            'id' => 6734,
            'name' => 'Las Cuevas',
            'city_id' => 3436,

        ]);

        //Las Flacas

        Neighborhood::create([
            'id' => 6735,
            'name' => 'Las Flacas',
            'city_id' => 3437,

        ]);

        //Las Flores

        Neighborhood::create([
            'id' => 6736,
            'name' => 'Las Flores',
            'city_id' => 3438,

        ]);

        //Las Juntas

        Neighborhood::create([
            'id' => 6737,
            'name' => 'Las Juntas',
            'city_id' => 3439,

        ]);

        //Las Lajitas

        Neighborhood::create([
            'id' => 6738,
            'name' => 'Las Lajitas',
            'city_id' => 3440,

        ]);

        //Las Mesitas

        Neighborhood::create([
            'id' => 6739,
            'name' => 'Las Mesitas',
            'city_id' => 3441,

        ]);

        //Lesser

        Neighborhood::create([
            'id' => 6740,
            'name' => 'Lesser',
            'city_id' => 3442,

        ]);

        //Lizoite

        Neighborhood::create([
            'id' => 6741,
            'name' => 'Lizoite',
            'city_id' => 3443,

        ]);

        //Los Baños

        Neighborhood::create([
            'id' => 6742,
            'name' => 'Los Baños',
            'city_id' => 3444,

        ]);

        //Los Blancos

        Neighborhood::create([
            'id' => 6743,
            'name' => 'Blancos',
            'city_id' => 3445,

        ]);

        //Los Mogotes

        Neighborhood::create([
            'id' => 6744,
            'name' => 'Los Mogotes',
            'city_id' => 3446,

        ]);

        //Los Sauces

        Neighborhood::create([
            'id' => 6745,
            'name' => 'Los Sauces',
            'city_id' => 3447,

        ]);

        //Los Toldos

        Neighborhood::create([
            'id' => 6746,
            'name' => 'Los Toldos',
            'city_id' => 3448,

        ]);

        //Los Yacones

        Neighborhood::create([
            'id' => 6747,
            'name' => 'Los Yacones',
            'city_id' => 3449,

        ]);

        //Luis Burella

        Neighborhood::create([
            'id' => 6748,
            'name' => 'Luis Burella',
            'city_id' => 3450,

        ]);

        //Luna Muerta

        Neighborhood::create([
            'id' => 6749,
            'name' => 'Luna Muerta',
            'city_id' => 3451,

        ]);

        //Luracatao

        Neighborhood::create([
            'id' => 6750,
            'name' => 'Luracatao',
            'city_id' => 3452,

        ]);

        //Macapillo

        Neighborhood::create([
            'id' => 6751,
            'name' => 'Macapillo',
            'city_id' => 3453,

        ]);

        //Maizales

        Neighborhood::create([
            'id' => 6752,
            'name' => 'Maizales',
            'city_id' => 3454,

        ]);

        //Manuel Elordi

        Neighborhood::create([
            'id' => 6753,
            'name' => 'Manuel Elordi',
            'city_id' => 3455,

        ]);

        //Martín García

        Neighborhood::create([
            'id' => 6754,
            'name' => 'Martín García',
            'city_id' => 3456,

        ]);

        //Martínez del Tineo

        Neighborhood::create([
            'id' => 6755,
            'name' => 'Martínez del Tineo',
            'city_id' => 3457,

        ]);

        //Meseta

        Neighborhood::create([
            'id' => 6756,
            'name' => 'Meseta',
            'city_id' => 3458,

        ]);

        //Metán

        Neighborhood::create([
            'id' => 6757,
            'name' => 'Metán',
            'city_id' => 3459,

        ]);

        //Metán Viejo

        Neighborhood::create([
            'id' => 6758,
            'name' => 'Metán Viejo',
            'city_id' => 3460,

        ]);

        //Mina Don Otto

        Neighborhood::create([
            'id' => 6759,
            'name' => 'Mina Don Otto',
            'city_id' => 3461,

        ]);

        //Mina La Casualidad

        Neighborhood::create([
            'id' => 6760,
            'name' => 'Mina La Casualidad',
            'city_id' => 3462,

        ]);

        //Mina Tincalado

        Neighborhood::create([
            'id' => 6761,
            'name' => 'Mina Tincalado',
            'city_id' => 3463,

        ]);

        //Mision El Cruce

        Neighborhood::create([
            'id' => 6762,
            'name' => 'Mision El Cruce',
            'city_id' => 3464,

        ]);

        //Mision La Paz

        Neighborhood::create([
            'id' => 6763,
            'name' => 'Mision La Paz',
            'city_id' => 3465,

        ]);

        //Misión Carboncito

        Neighborhood::create([
            'id' => 6764,
            'name' => 'Mision Carboncito',
            'city_id' => 3466,

        ]);

        //Misión Chaqueña

        Neighborhood::create([
            'id' => 6765,
            'name' => 'Misión Chaqueña',
            'city_id' => 3467,

        ]);

        //Misión Kilómetro 6

        Neighborhood::create([
            'id' => 6766,
            'name' => 'Misión Kilómetro 6',
            'city_id' => 3468,

        ]);

        //Misión Salim

        Neighborhood::create([
            'id' => 6767,
            'name' => 'Misión Salim',
            'city_id' => 3469,

        ]);

        //Misión Tierras Fiscales

        Neighborhood::create([
            'id' => 6768,
            'name' => 'Misión Tierras Fiscales',
            'city_id' => 3470,

        ]);

        //Misión Zenta

        Neighborhood::create([
            'id' => 6769,
            'name' => 'Misión Zenta',
            'city_id' => 3471,

        ]);

        //Molinos

        Neighborhood::create([
            'id' => 6770,
            'name' => 'Molinos',
            'city_id' => 3472,

        ]);

        //Monteverde

        Neighborhood::create([
            'id' => 6771,
            'name' => 'Monteverde',
            'city_id' => 3473,

        ]);

        //Muñano

        Neighborhood::create([
            'id' => 6772,
            'name' => 'Muñano',
            'city_id' => 3474,

        ]);

        //Nazareno

        Neighborhood::create([
            'id' => 6773,
            'name' => 'Nazareno',
            'city_id' => 3475,

        ]);

        //Nuestra Señora de Talavera

        Neighborhood::create([
            'id' => 6774,
            'name' => 'Nuestra Señora de Talavera',
            'city_id' => 3476,

        ]);

        //Olacapato

        Neighborhood::create([
            'id' => 6775,
            'name' => 'Olacapato',
            'city_id' => 3477,

        ]);

        //Osma

        Neighborhood::create([
            'id' => 6776,
            'name' => 'Osma',
            'city_id' => 3478,

        ]);


        //Ovejería

        Neighborhood::create([
            'id' => 6778,
            'name' => 'Ovejería',
            'city_id' => 3480,

        ]);

        //Pacará

        Neighborhood::create([
            'id' => 6779,
            'name' => 'Pacará',
            'city_id' => 3481,

        ]);

        //Padre Lozano

        Neighborhood::create([
            'id' => 6780,
            'name' => 'Padre Lozano',
            'city_id' => 3482,

        ]);

        //Palermo

        Neighborhood::create([
            'id' => 6781,
            'name' => 'Palermo',
            'city_id' => 3483,

        ]);

        //Palmarcito

        Neighborhood::create([
            'id' => 6782,
            'name' => 'Palmarcito',
            'city_id' => 3484,

        ]);

        //Palomitas

        Neighborhood::create([
            'id' => 6783,
            'name' => 'Palomitas',
            'city_id' => 3485,

        ]);

        //Pampa Grande

        Neighborhood::create([
            'id' => 6784,
            'name' => 'Pampa Grande',
            'city_id' => 3486,

        ]);

        //Paraje Corralito

        Neighborhood::create([
            'id' => 6785,
            'name' => 'Paraje Corralito',
            'city_id' => 3487,

        ]);

        //Paraje del Juramento

        Neighborhood::create([
            'id' => 6786,
            'name' => 'Paraje del Juramento',
            'city_id' => 3488,

        ]);

        //Paraje San Antonio

        Neighborhood::create([
            'id' => 6787,
            'name' => 'Paraje San Antonio',
            'city_id' => 3489,

        ]);

        //Payogasta

        Neighborhood::create([
            'id' => 6788,
            'name' => 'Payogasta',
            'city_id' => 3490,

        ]);

        //Payogastilla

        Neighborhood::create([
            'id' => 6789,
            'name' => 'Payogastilla',
            'city_id' => 3491,

        ]);

        //Pichanal

        Neighborhood::create([
            'id' => 6790,
            'name' => 'Pichanal',
            'city_id' => 3492,

        ]);

        //Piquete Cabado

        Neighborhood::create([
            'id' => 6791,
            'name' => 'Piquete Cabado',
            'city_id' => 3493,

        ]);

        //Piquirenda

        Neighborhood::create([
            'id' => 6792,
            'name' => 'Piquirenda',
            'city_id' => 3494,

        ]);

        //Pluma de Pato

        Neighborhood::create([
            'id' => 6793,
            'name' => 'Pluma de Pato',
            'city_id' => 3495,

        ]);

        //Pocoy

        Neighborhood::create([
            'id' => 6794,
            'name' => 'Pocoy',
            'city_id' => 3496,

        ]);

        //Poscaya

        Neighborhood::create([
            'id' => 6795,
            'name' => 'Poscaya',
            'city_id' => 3497,

        ]);

        //Potrerillos

        Neighborhood::create([
            'id' => 6796,
            'name' => 'Potrerillos de Castilla',
            'city_id' => 3498,

        ]);

        //Potrero de Castilla

        Neighborhood::create([
            'id' => 6797,
            'name' => 'Potrero de Castilla',
            'city_id' => 3499,

        ]);

        //Pozo Bravo

        Neighborhood::create([
            'id' => 6798,
            'name' => 'Pozo Bravo',
            'city_id' => 3500,

        ]);

        //Pozo Cercado

        Neighborhood::create([
            'id' => 6799,
            'name' => 'Pozo Cercado',
            'city_id' => 3501,

        ]);

        //Pozo Hondo

        Neighborhood::create([
            'id' => 6800,
            'name' => 'Pozo Hondo',
            'city_id' => 3502,

        ]);

        //Presa El Tunal

        Neighborhood::create([
            'id' => 6801,
            'name' => 'Presa El Tunal',
            'city_id' => 3503,

        ]);

        //Pucará

        Neighborhood::create([
            'id' => 6802,
            'name' => 'Pucará',
            'city_id' => 3504,

        ]);

        //Pueblo Viejo

        Neighborhood::create([
            'id' => 6803,
            'name' => 'Pueblo Viejo',
            'city_id' => 3505,

        ]);

        //Puente de Plata

        Neighborhood::create([
            'id' => 6804,
            'name' => 'Puente de Plata',
            'city_id' => 3506,

        ]);

        //Puerta Tastil

        Neighborhood::create([
            'id' => 6805,
            'name' => 'Puerta Tastil',
            'city_id' => 3507,

        ]);

        //Puerto La Paz

        Neighborhood::create([
            'id' => 6806,
            'name' => 'Puerto La Paz',
            'city_id' => 3508,

        ]);

        //Pulares

        Neighborhood::create([
            'id' => 6807,
            'name' => 'Pulares',
            'city_id' => 3509,

        ]);

        //Punta De Agua

        Neighborhood::create([
            'id' => 6808,
            'name' => 'Punta de Agua',
            'city_id' => 3510,

        ]);

        //Quebrada del Agua

        Neighborhood::create([
            'id' => 6809,
            'name' => 'Quebrada del Agua',
            'city_id' => 3511,

        ]);

        //Rancagua

        Neighborhood::create([
            'id' => 6810,
            'name' => 'rancagua',
            'city_id' => 3512,

        ]);

        //Recaredo

        Neighborhood::create([
            'id' => 6811,
            'name' => 'Recaredo',
            'city_id' => 3513,

        ]);

        //Rivadavia

        Neighborhood::create([
            'id' => 6812,
            'name' => 'Rivadavia',
            'city_id' => 3514,

        ]);

        //Rodeo Colorado

        Neighborhood::create([
            'id' => 6813,
            'name' => 'Rodeo Colorado',
            'city_id' => 3515,

        ]);

        //Rodeo Pampa

        Neighborhood::create([
            'id' => 6814,
            'name' => 'Rodeo Pampa',
            'city_id' => 3516,

        ]);

        //Rosario de la Frontera

        Neighborhood::create([
            'id' => 6815,
            'name' => 'Rosario de la Frontera',
            'city_id' => 3517,

        ]);

        //Río del Valle

        Neighborhood::create([
            'id' => 6816,
            'name' => 'Río del Valle',
            'city_id' => 3518,

        ]);

        //Río Pescado

        Neighborhood::create([
            'id' => 6817,
            'name' => 'Río Pescado',
            'city_id' => 3519,

        ]);

        //Río Piedras

        Neighborhood::create([
            'id' => 6818,
            'name' => 'Río Piedras',
            'city_id' => 3520,

        ]);

        //Río Seco

        Neighborhood::create([
            'id' => 6819,
            'name' => 'Río Seco',
            'city_id' => 3521,

        ]);

        //Río Urueña

        Neighborhood::create([
            'id' => 6820,
            'name' => 'Río Urueña',
            'city_id' => 3522,

        ]);

        //Saladillo

        Neighborhood::create([
            'id' => 6821,
            'name' => 'Saladillo',
            'city_id' => 3523,

        ]);

        //Salar de Pocitos

        Neighborhood::create([
            'id' => 6822,
            'name' => 'Salar de Pocitos',
            'city_id' => 3524,

        ]);

        //Salvador Mazza

        Neighborhood::create([
            'id' => 6823,
            'name' => 'Salvador Mazza',
            'city_id' => 3525,

        ]);

        //San Agustin

        Neighborhood::create([
            'id' => 6824,
            'name' => 'San Agustín',
            'city_id' => 3526,

        ]);

        //San Antonio de los Cobres

        Neighborhood::create([
            'id' => 6825,
            'name' => 'San Antonio de los Cobres',
            'city_id' => 3527,

        ]);

        //San Bernardo de las Zorras

        Neighborhood::create([
            'id' => 6826,
            'name' => 'San Bernardo de las Zorras',
            'city_id' => 3528,

        ]);

        //San Carlos

        Neighborhood::create([
            'id' => 6827,
            'name' => 'San Carlos',
            'city_id' => 3529,

        ]);

        //San Felipe

        Neighborhood::create([
            'id' => 6828,
            'name' => 'San Felipe',
            'city_id' => 3530,

        ]);

        //San Fernando de Escoipe

        Neighborhood::create([
            'id' => 6829,
            'name' => 'San Fernando de Escoipe',
            'city_id' => 3531,

        ]);

        //San Isidro

        Neighborhood::create([
            'id' => 6830,
            'name' => 'San Isidro',
            'city_id' => 3532,

        ]);

        //San Isidro de Iruya

        Neighborhood::create([
            'id' => 6831,
            'name' => 'San Isidro de Iruya',
            'city_id' => 3533,

        ]);

        //San José de Escalchi

        Neighborhood::create([
            'id' => 6832,
            'name' => 'San José de Escalchi',
            'city_id' => 3534,

        ]);

        //San José de Cachi

        Neighborhood::create([
            'id' => 6833,
            'name' => 'San José de Cachi',
            'city_id' => 3535,

        ]);

        //San José de la Orquera

        Neighborhood::create([
            'id' => 6834,
            'name' => 'San Jose de la Orquera',
            'city_id' => 3536,

        ]);

        //San José de Metán

        Neighborhood::create([
            'id' => 6835,
            'name' => 'San José de Metán',
            'city_id' => 3537,

        ]);

        //San Juan

        Neighborhood::create([
            'id' => 6836,
            'name' => 'San Juan',
            'city_id' => 3538,

        ]);

        //San Luis

        Neighborhood::create([
            'id' => 6837,
            'name' => 'San Luis',
            'city_id' => 3539,

        ]);

        //San Marcos

        Neighborhood::create([
            'id' => 6838,
            'name' => 'San Marcos',
            'city_id' => 3540,

        ]);

        //San Martín

        Neighborhood::create([
            'id' => 6839,
            'name' => 'San Martín',
            'city_id' => 3541,

        ]);

        //San Miguel

        Neighborhood::create([
            'id' => 6840,
            'name' => 'San Miguel',
            'city_id' => 3542,

        ]);

        //San Rafael

        Neighborhood::create([
            'id' => 6841,
            'name' => 'San Rafael',
            'city_id' => 3543,

        ]);

        //San Ramón de la Nueva Orán

        Neighborhood::create([
            'id' => 6842,
            'name' => 'San Ramón de la Nueva Orán',
            'city_id' => 3544,

        ]);

        //Santa Bárbara

        Neighborhood::create([
            'id' => 6843,
            'name' => 'Santa Bárbara',
            'city_id' => 3545,

        ]);

        //Santa María

        Neighborhood::create([
            'id' => 6844,
            'name' => 'Santa María',
            'city_id' => 3546,

        ]);

        //Santa Rosa

        Neighborhood::create([
            'id' => 6845,
            'name' => 'Santa Rosa',
            'city_id' => 3547,

        ]);

        //Santa Rosa de los Pastos Grandes

        Neighborhood::create([
            'id' => 6846,
            'name' => 'Santa Rosa de los Pastos Grandes',
            'city_id' => 3548,

        ]);

        //Santa Rosa de Tastil

        Neighborhood::create([
            'id' => 6847,
            'name' => 'Santa Rosa de Tastil',
            'city_id' => 3549,

        ]);

        //Santa Victoria Este

        Neighborhood::create([
            'id' => 6848,
            'name' => 'Santa Victoria Este',
            'city_id' => 3550,

        ]);

        //Santa Victoria Oeste

        Neighborhood::create([
            'id' => 6849,
            'name' => 'Santa Victoria Oeste',
            'city_id' => 3551,

        ]);

        //Santo Domingo

        Neighborhood::create([
            'id' => 6850,
            'name' => 'Santo Domingo',
            'city_id' => 3552,

        ]);

        //Saucelito

        Neighborhood::create([
            'id' => 6851,
            'name' => 'Saucelito',
            'city_id' => 3553,

        ]);

        //Schneidewind

        Neighborhood::create([
            'id' => 6852,
            'name' => 'Schneidewind',
            'city_id' => 3554,

        ]);

        //Seclantás

        Neighborhood::create([
            'id' => 6853,
            'name' => 'Seclantás',
            'city_id' => 3555,

        ]);

        //Senda Hachada

        Neighborhood::create([
            'id' => 6854,
            'name' => 'Senda Hachada',
            'city_id' => 3556,

        ]);

        //Senillosa

        Neighborhood::create([
            'id' => 6855,
            'name' => 'Senillosa',
            'city_id' => 3557,

        ]);

        //Socompa

        Neighborhood::create([
            'id' => 6856,
            'name' => 'Socompa',
            'city_id' => 3558,

        ]);

        //Sumalao

        Neighborhood::create([
            'id' => 6857,
            'name' => 'Sumalao',
            'city_id' => 3559,

        ]);

        //Suri Pintado

        Neighborhood::create([
            'id' => 6858,
            'name' => 'Suri Pintado',
            'city_id' => 3560,

        ]);

        //Taca Taca

        Neighborhood::create([
            'id' => 6859,
            'name' => 'Taca Taca',
            'city_id' => 3561,

        ]);

        //Tacuara

        Neighborhood::create([
            'id' => 6860,
            'name' => 'Tacuara',
            'city_id' => 3562,

        ]);

        //Tacuil

        Neighborhood::create([
            'id' => 6861,
            'name' => 'Tacuil',
            'city_id' => 3563,

        ]);

        //Tipán

        Neighborhood::create([
            'id' => 6862,
            'name' => 'Tipán',
            'city_id' => 3564,

        ]);

        //Tobantirenda

        Neighborhood::create([
            'id' => 6863,
            'name' => 'Tobantirenda',
            'city_id' => 3565,

        ]);

        //Tolar Grande

        Neighborhood::create([
            'id' => 6864,
            'name' => 'Tolar Grande',
            'city_id' => 3566,

        ]);

        //Tolloche

        Neighborhood::create([
            'id' => 6865,
            'name' => 'Tolloche',
            'city_id' => 3567,

        ]);

        //Tolombón

        Neighborhood::create([
            'id' => 6866,
            'name' => 'Tolombón',
            'city_id' => 3568,

        ]);

        //Tonono

        Neighborhood::create([
            'id' => 6867,
            'name' => 'Tonono',
            'city_id' => 3569,

        ]);

        //Tranquitas

        Neighborhood::create([
            'id' => 6868,
            'name' => 'Tranquitas',
            'city_id' => 3570,

        ]);

        //Unquillar

        Neighborhood::create([
            'id' => 6869,
            'name' => 'Unquillar',
            'city_id' => 3571,

        ]);



        //Vega de Arizaro

        Neighborhood::create([
            'id' => 6870,
            'name' => 'Vega de Arizaro',
            'city_id' => 3574,

        ]);

        //Veinte de Febrero

        Neighborhood::create([
            'id' => 6871,
            'name' => 'Veinte de Febrero',
            'city_id' => 3575,

        ]);

        //Villa Angelica

        Neighborhood::create([
            'id' => 6872,
            'name' => 'Villa Angélica',
            'city_id' => 3576,

        ]);

        //Villa Los Álamos

        Neighborhood::create([
            'id' => 6873,
            'name' => 'Villa Los Álamos',
            'city_id' => 3577,

        ]);

        //Vinalito

        Neighborhood::create([
            'id' => 6874,
            'name' => 'Vinalito',
            'city_id' => 3578,

        ]);

        //Virgilio Tedin

        Neighborhood::create([
            'id' => 6875,
            'name' => 'Virgilio Tedin',
            'city_id' => 3579,

        ]);

        //Viñaco

        Neighborhood::create([
            'id' => 6876,
            'name' => 'Viñaco',
            'city_id' => 3580,

        ]);

        //Volcan Higueras

        Neighborhood::create([
            'id' => 6877,
            'name' => 'Volcan Higueras',
            'city_id' => 3581,

        ]);

        //Vuelta de los Tobas

        Neighborhood::create([
            'id' => 6878,
            'name' => 'Vuelta de los Tobas',
            'city_id' => 3582,

        ]);

        //Yacuy

        Neighborhood::create([
            'id' => 6879,
            'name' => 'Yacuy',
            'city_id' => 3583,

        ]);

        //Yariguarenda

        Neighborhood::create([
            'id' => 6880,
            'name' => 'Yariguarenda',
            'city_id' => 3584,

        ]);

        //Yatasto

        Neighborhood::create([
            'id' => 6881,
            'name' => 'Yatasto',
            'city_id' => 3585,

        ]);

        //Yuchán

        Neighborhood::create([
            'id' => 6882,
            'name' => 'Yuchán',
            'city_id' => 3586,

        ]);

        //Zanja del Tigre

        Neighborhood::create([
            'id' => 6883,
            'name' => 'Zanja del Tigre',
            'city_id' => 3587,

        ]);

        //San Juan

        Neighborhood::create([
            'id' => 6884,
            'name' => 'San Juan',
            'city_id' => 3588,

        ]);

        //General San Martín

        Neighborhood::create([
            'id' => 6885,
            'name' => 'General San Martín',
            'city_id' => 3589,

        ]);

        //Rivadavia

        Neighborhood::create([
            'id' => 6886,
            'name' => 'Rivadavia',
            'city_id' => 3590,

        ]);

        //Santa Lucía

        Neighborhood::create([
            'id' => 6887,
            'name' => 'Santa Lucía',
            'city_id' => 3591,

        ]);

        //Rawson

        Neighborhood::create([
            'id' => 6888,
            'name' => 'Rawson',
            'city_id' => 3592,

        ]);

        //Agua Cercada

        Neighborhood::create([
            'id' => 6889,
            'name' => 'Agua Cercada',
            'city_id' => 3593,

        ]);

        //Alto de Sierra

        Neighborhood::create([
            'id' => 6890,
            'name' => 'Alto de Sierra',
            'city_id' => 3594,

        ]);

        //Alto de Sierra Este

        Neighborhood::create([
            'id' => 6891,
            'name' => 'Alto de Sierra Este',
            'city_id' => 3595,

        ]);

        //Angulasto

        Neighborhood::create([
            'id' => 6892,
            'name' => 'Angulasto',
            'city_id' => 3596,

        ]);

        //Astica

        Neighborhood::create([
            'id' => 6893,
            'name' => 'astica',
            'city_id' => 3597,

        ]);

        //Baldes del Rosario

        Neighborhood::create([
            'id' => 6894,
            'name' => 'Baldes del Rosario',
            'city_id' => 3598,

        ]);

        //Barreal

        Neighborhood::create([
            'id' => 6895,
            'name' => 'Barreal',
            'city_id' => 3599,

        ]);

        //Barrio Laprida

        Neighborhood::create([
            'id' => 6896,
            'name' => 'Barrio Laprida',
            'city_id' => 3600,

        ]);

        //Barrio ruta 40

        Neighborhood::create([
            'id' => 6897,
            'name' => 'Barrio Ruta 40',
            'city_id' => 3601,

        ]);

        //Barrio Sadop

        Neighborhood::create([
            'id' => 6898,
            'name' => 'Barrio Sadop',
            'city_id' => 3602,

        ]);

        //Bella Vista

        Neighborhood::create([
            'id' => 6899,
            'name' => 'Bella Vista',
            'city_id' => 3603,

        ]);

        //Bermejo

        Neighborhood::create([
            'id' => 6900,
            'name' => 'Bermejo',
            'city_id' => 3604,

        ]);

        //Calingasta

        Neighborhood::create([
            'id' => 6901,
            'name' => 'Calingasta',
            'city_id' => 3605,

        ]);

        //Campanario

        Neighborhood::create([
            'id' => 6902,
            'name' => 'Campanario',
            'city_id' => 3606,

        ]);

        //Campo Afuera

        Neighborhood::create([
            'id' => 6903,
            'name' => 'Campo Afuera',
            'city_id' => 3607,

        ]);

        //Caucete

        Neighborhood::create([
            'id' => 6904,
            'name' => 'Caucete',
            'city_id' => 3608,

        ]);

        //Cañada Honda

        Neighborhood::create([
            'id' => 6905,
            'name' => 'Cañada Honda',
            'city_id' => 3609,

        ]);

        //Chimbas

        Neighborhood::create([
            'id' => 6906,
            'name' => 'Chimbas',
            'city_id' => 3610,

        ]);

        //Chucuma

        Neighborhood::create([
            'id' => 6907,
            'name' => 'Chucuma',
            'city_id' => 3611,

        ]);

        //Cienaguita

        Neighborhood::create([
            'id' => 6908,
            'name' => 'Cienaguita',
            'city_id' => 3612,

        ]);

        //Cochagual

        Neighborhood::create([
            'id' => 6909,
            'name' => 'Cochagual',
            'city_id' => 3613,

        ]);

        //Colanguil

        Neighborhood::create([
            'id' => 6910,
            'name' => 'Colanguil',
            'city_id' => 3614,

        ]);

        //Colola

        Neighborhood::create([
            'id' => 6911,
            'name' => 'Colola',
            'city_id' => 3615,

        ]);

        //Colonia Fiorito

        Neighborhood::create([
            'id' => 6912,
            'name' => 'Colonia Fiorito',
            'city_id' => 3616,

        ]);

        //Colonia Gutiérrez

        Neighborhood::create([
            'id' => 6913,
            'name' => 'Colonia Gutiérrez',
            'city_id' => 3617,

        ]);

        //Concepción

        Neighborhood::create([
            'id' => 6914,
            'name' => 'Concepción',
            'city_id' => 3618,

        ]);

        //Desamparados

        Neighborhood::create([
            'id' => 6915,
            'name' => 'Desamparados',
            'city_id' => 3619,

        ]);

        //Dibella

        Neighborhood::create([
            'id' => 6916,
            'name' => 'Dibella',
            'city_id' => 3620,

        ]);

        //Divisadero

        Neighborhood::create([
            'id' => 6917,
            'name' => 'Divisadero',
            'city_id' => 3621,

        ]);

        //Dos Acequias

        Neighborhood::create([
            'id' => 6918,
            'name' => 'Dos Acequias',
            'city_id' => 3622,

        ]);

        //El Alamito

        Neighborhood::create([
            'id' => 6919,
            'name' => 'El Alamito',
            'city_id' => 3623,

        ]);

        //El Bosque

        Neighborhood::create([
            'id' => 6920,
            'name' => 'El Bosque',
            'city_id' => 3624,

        ]);

        //El Chilote

        Neighborhood::create([
            'id' => 6921,
            'name' => 'El Chilote',
            'city_id' => 3625,

        ]);

        //El Chinguillo

        Neighborhood::create([
            'id' => 6922,
            'name' => 'El Chinguillo',
            'city_id' => 3626,

        ]);

        //El Encón

        Neighborhood::create([
            'id' => 6923,
            'name' => 'El Encón',
            'city_id' => 3627,

        ]);

        //El Fiscal

        Neighborhood::create([
            'id' => 6924,
            'name' => 'El Fiscal',
            'city_id' => 3628,

        ]);

        //El Medanito

        Neighborhood::create([
            'id' => 6925,
            'name' => 'El Medanito',
            'city_id' => 3629,

        ]);

        //El Mogote

        Neighborhood::create([
            'id' => 6926,
            'name' => 'El Mogote',
            'city_id' => 3630,

        ]);

        //El Médano

        Neighborhood::create([
            'id' => 6927,
            'name' => 'El Médano',
            'city_id' => 3631,

        ]);

        //El Rincón

        Neighborhood::create([
            'id' => 6928,
            'name' => 'El Rincón',
            'city_id' => 3632,

        ]);

        //El Salado

        Neighborhood::create([
            'id' => 6929,
            'name' => 'El Salado',
            'city_id' => 3633,

        ]);

        //El Salvador

        Neighborhood::create([
            'id' => 6930,
            'name' => 'El Salvador',
            'city_id' => 3634,

        ]);

        //El Tapón

        Neighborhood::create([
            'id' => 6931,
            'name' => 'El Tapón',
            'city_id' => 3635,

        ]);

        //Entre Ríos

        Neighborhood::create([
            'id' => 6932,
            'name' => 'Entre Ríos',
            'city_id' => 3636,

        ]);

        //Estación Juan Jufré

        Neighborhood::create([
            'id' => 6933,
            'name' => 'Estación Juan Jufré',
            'city_id' => 3637,

        ]);

        //Gran China

        Neighborhood::create([
            'id' => 6934,
            'name' => 'Gran China',
            'city_id' => 3638,

        ]);

        //Gualilán

        Neighborhood::create([
            'id' => 6935,
            'name' => 'Gualilán',
            'city_id' => 3639,

        ]);

        //Guanacache

        Neighborhood::create([
            'id' => 6936,
            'name' => 'Guanacache',
            'city_id' => 3640,

        ]);

        //Huaco

        Neighborhood::create([
            'id' => 6937,
            'name' => 'Huaco',
            'city_id' => 3641,

        ]);

        //Huerta Huachi

        Neighborhood::create([
            'id' => 6938,
            'name' => 'Huerta Huachi',
            'city_id' => 3642,

        ]);

        //Iglesia

        Neighborhood::create([
            'id' => 6939,
            'name' => 'Iglesia',
            'city_id' => 3643,

        ]);

        //Ischigualasto

        Neighborhood::create([
            'id' => 6940,
            'name' => 'Ischigualasto',
            'city_id' => 3644,

        ]);

        //José Dolores

        Neighborhood::create([
            'id' => 6941,
            'name' => 'José Dolores',
            'city_id' => 3645,

        ]);

        //La Bebida

        Neighborhood::create([
            'id' => 6942,
            'name' => 'La Bebida',
            'city_id' => 3646,

        ]);

        //La Cañada

        Neighborhood::create([
            'id' => 6943,
            'name' => 'La Cañada',
            'city_id' => 3647,

        ]);

        //La Chimbera

        Neighborhood::create([
            'id' => 6944,
            'name' => 'La Chimbera',
            'city_id' => 3648,

        ]);

        //La Ciénaga

        Neighborhood::create([
            'id' => 6945,
            'name' => 'La Ciénaga',
            'city_id' => 3649,

        ]);

        //La Falda

        Neighborhood::create([
            'id' => 6946,
            'name' => 'El Falda',
            'city_id' => 3650,

        ]);

        //La Frontera

        Neighborhood::create([
            'id' => 6947,
            'name' => 'La Frontera',
            'city_id' => 3651,

        ]);

        //La Isla

        Neighborhood::create([
            'id' => 6948,
            'name' => 'La Isla',
            'city_id' => 3652,

        ]);

        //La Laja

        Neighborhood::create([
            'id' => 6949,
            'name' => 'La Laja',
            'city_id' => 3653,

        ]);

        //La Legua

        Neighborhood::create([
            'id' => 6950,
            'name' => 'La Legua',
            'city_id' => 3654,

        ]);

        //La Majadita

        Neighborhood::create([
            'id' => 6951,
            'name' => 'La Majadita',
            'city_id' => 3655,

        ]);

        //La Mesada

        Neighborhood::create([
            'id' => 6952,
            'name' => 'La Mesada',
            'city_id' => 3656,

        ]);

        //La Represa

        Neighborhood::create([
            'id' => 6953,
            'name' => 'La Represa',
            'city_id' => 3657,

        ]);

        //La Rinconada

        Neighborhood::create([
            'id' => 6954,
            'name' => 'La Rinconada',
            'city_id' => 3658,

        ]);

        //La Toma

        Neighborhood::create([
            'id' => 6955,
            'name' => 'La Toma',
            'city_id' => 3659,

        ]);

        //Las Chacras

        Neighborhood::create([
            'id' => 6956,
            'name' => 'Las Chacras',
            'city_id' => 3660,

        ]);

        //Las Chacritas

        Neighborhood::create([
            'id' => 6957,
            'name' => 'Las Chacritas',
            'city_id' => 3661,

        ]);

        //Las Flores

        Neighborhood::create([
            'id' => 6958,
            'name' => 'Las Flores',
            'city_id' => 3662,

        ]);

        //Las Lagunas

        Neighborhood::create([
            'id' => 6959,
            'name' => 'Las Lagunas',
            'city_id' => 3663,

        ]);

        //Las Lomitas

        Neighborhood::create([
            'id' => 6960,
            'name' => 'Las Lomitas',
            'city_id' => 3664,

        ]);

        //Las Talas

        Neighborhood::create([
            'id' => 6961,
            'name' => 'Las Talas',
            'city_id' => 3665,

        ]);

        //Las Tapias

        Neighborhood::create([
            'id' => 6962,
            'name' => 'Las Tapias',
            'city_id' => 3666,

        ]);

        //Las Tumanas

        Neighborhood::create([
            'id' => 6963,
            'name' => 'Las Tumanas',
            'city_id' => 3667,

        ]);

        //Los Baldecitos

        Neighborhood::create([
            'id' => 6964,
            'name' => 'Los Baldecitos',
            'city_id' => 3668,

        ]);

        //Los Berros

        Neighborhood::create([
            'id' => 6965,
            'name' => 'Los Berros',
            'city_id' => 3669,

        ]);

        //Los Bretes

        Neighborhood::create([
            'id' => 6966,
            'name' => 'Los Bretes',
            'city_id' => 3670,

        ]);

        //Los Médanos

        Neighborhood::create([
            'id' => 6967,
            'name' => 'Los Médanos',
            'city_id' => 3671,

        ]);

        //Los Rincones

        Neighborhood::create([
            'id' => 6968,
            'name' => 'Los rincones',
            'city_id' => 3672,

        ]);

        //Maipirinqui

        Neighborhood::create([
            'id' => 6969,
            'name' => 'Maipirinqui',
            'city_id' => 3673,

        ]);

        //Malimán

        Neighborhood::create([
            'id' => 6970,
            'name' => 'Malimán',
            'city_id' => 3674,

        ]);

        //Marayes

        Neighborhood::create([
            'id' => 6971,
            'name' => 'Marayes',
            'city_id' => 3675,

        ]);

        //Marquesado

        Neighborhood::create([
            'id' => 6972,
            'name' => 'Marquesado',
            'city_id' => 3676,

        ]);

        //Matagusano

        Neighborhood::create([
            'id' => 6973,
            'name' => 'Matagusano',
            'city_id' => 3677,

        ]);

        //Media Agua

        Neighborhood::create([
            'id' => 6974,
            'name' => 'Media Agua',
            'city_id' => 3678,

        ]);

        //Mogna

        Neighborhood::create([
            'id' => 6975,
            'name' => 'Mogna',
            'city_id' => 3679,

        ]);

        //Niquivil

        Neighborhood::create([
            'id' => 6976,
            'name' => 'Niquivil',
            'city_id' => 3680,

        ]);

        //Obispo Zapata

        Neighborhood::create([
            'id' => 6977,
            'name' => 'Obispo Zapata',
            'city_id' => 3681,

        ]);


        //Pampa del Chañar

        Neighborhood::create([
            'id' => 6979,
            'name' => 'Pampa del Chañar',
            'city_id' => 3683,

        ]);

        //Pampa Vieja

        Neighborhood::create([
            'id' => 6980,
            'name' => 'Pampa Vieja',
            'city_id' => 3684,

        ]);

        //Pedernal

        Neighborhood::create([
            'id' => 6981,
            'name' => 'Pedernal',
            'city_id' => 3685,

        ]);

        //Pie de Palo

        Neighborhood::create([
            'id' => 6982,
            'name' => 'Pie de Palo',
            'city_id' => 3686,

        ]);

        //Pismanta

        Neighborhood::create([
            'id' => 6983,
            'name' => 'Pismanta',
            'city_id' => 3687,

        ]);

        //Pocito

        Neighborhood::create([
            'id' => 6984,
            'name' => 'Pocito ',
            'city_id' => 3688,

        ]);

        //Pozo Salado

        Neighborhood::create([
            'id' => 6985,
            'name' => 'Pozo Salado',
            'city_id' => 3689,

        ]);

        //Puchuzum

        Neighborhood::create([
            'id' => 6986,
            'name' => 'Puchuzum',
            'city_id' => 3690,

        ]);

        //Punta del Agua

        Neighborhood::create([
            'id' => 6987,
            'name' => 'Punta del Agua',
            'city_id' => 3691,

        ]);

        //Punta del Monte

        Neighborhood::create([
            'id' => 6988,
            'name' => 'Punta del Monte',
            'city_id' => 3692,

        ]);

        //Punta del Médano

        Neighborhood::create([
            'id' => 6989,
            'name' => 'Punta del Médano',
            'city_id' => 3693,

        ]);

        //Quinto Cuartel

        Neighborhood::create([
            'id' => 6990,
            'name' => 'Quinto Cuartel',
            'city_id' => 3694,

        ]);

        //Retamito

        Neighborhood::create([
            'id' => 6991,
            'name' => 'Retamito',
            'city_id' => 3695,

        ]);

        //Rincón Cercado

        Neighborhood::create([
            'id' => 6992,
            'name' => 'Rincón Cercado',
            'city_id' => 3696,

        ]);

        //Rio Verde

        Neighborhood::create([
            'id' => 6993,
            'name' => 'Rio Verde',
            'city_id' => 3697,

        ]);

        //Rodeo

        Neighborhood::create([
            'id' => 6994,
            'name' => 'Rodeo',
            'city_id' => 3698,

        ]);

        //San Isidro

        Neighborhood::create([
            'id' => 6995,
            'name' => 'San Isidro',
            'city_id' => 3699,

        ]);

        //San José de Jáchal

        Neighborhood::create([
            'id' => 6996,
            'name' => 'San José de Jáchal',
            'city_id' => 3700,

        ]);

        //San Roque

        Neighborhood::create([
            'id' => 6997,
            'name' => 'San Roque',
            'city_id' => 3701,

        ]);

        //Santa Rosa

        Neighborhood::create([
            'id' => 6998,
            'name' => 'Santa Rosa',
            'city_id' => 3702,

        ]);

        //Sierra de Chávez

        Neighborhood::create([
            'id' => 6999,
            'name' => 'Sierra de Chávez',
            'city_id' => 3703,

        ]);

        //Sierra de Elizondo

        Neighborhood::create([
            'id' => 7000,
            'name' => 'Sierra de Elizondo',
            'city_id' => 3704,

        ]);

        //Sierra de Rivero

        Neighborhood::create([
            'id' => 7001,
            'name' => 'Sierra de Rivero',
            'city_id' => 3705,

        ]);

        //Sorocayense

        Neighborhood::create([
            'id' => 7002,
            'name' => 'Sorocayense',
            'city_id' => 3706,

        ]);

        //Talacasto

        Neighborhood::create([
            'id' => 7003,
            'name' => 'Talacasto',
            'city_id' => 3707,

        ]);

        //Tamberías

        Neighborhood::create([
            'id' => 7004,
            'name' => 'Tamberías',
            'city_id' => 3708,

        ]);

        //Tierra Adentro

        Neighborhood::create([
            'id' => 7005,
            'name' => 'Tierra Adentro',
            'city_id' => 3709,

        ]);

        //Tres Esquina

        Neighborhood::create([
            'id' => 7006,
            'name' => 'Tres Esquina',
            'city_id' => 3710,

        ]);

        //Trinidad

        Neighborhood::create([
            'id' => 7007,
            'name' => 'Trinidad',
            'city_id' => 3711,

        ]);

        //Tucunuco

        Neighborhood::create([
            'id' => 7008,
            'name' => 'Tucunuco',
            'city_id' => 3712,

        ]);

        //Tudcum

        Neighborhood::create([
            'id' => 7009,
            'name' => 'Tudcum',
            'city_id' => 3713,

        ]);

        //Tupelí

        Neighborhood::create([
            'id' => 7010,
            'name' => 'Tupelí',
            'city_id' => 3714,

        ]);

        //Usno

        Neighborhood::create([
            'id' => 7011,
            'name' => 'Usno',
            'city_id' => 3715,

        ]);

        //Valdes de Astica

        Neighborhood::create([
            'id' => 7012,
            'name' => 'Valdes de Astica',
            'city_id' => 3716,

        ]);

        //Valdes de Las Chilcas

        Neighborhood::create([
            'id' => 7013,
            'name' => 'Valdes de Las Chilcas ',
            'city_id' => 3717,

        ]);

        //Vallecito

        Neighborhood::create([
            'id' => 7014,
            'name' => 'Vallecito',
            'city_id' => 3718,

        ]);

        //Villa Aberastain

        Neighborhood::create([
            'id' => 7015,
            'name' => 'Villa Aberastain',
            'city_id' => 3719,

        ]);

        //Villa Ampacama

        Neighborhood::create([
            'id' => 7016,
            'name' => 'Villa Ampacama',
            'city_id' => 3720,

        ]);

        //Villa Aurora

        Neighborhood::create([
            'id' => 7017,
            'name' => 'Villa Aurora',
            'city_id' => 3721,

        ]);

        //Villa Barboza

        Neighborhood::create([
            'id' => 7018,
            'name' => 'Villa Barboza',
            'city_id' => 3722,

        ]);

        //Villa Basilio Nievas

        Neighborhood::create([
            'id' => 7019,
            'name' => 'Villa Basilio Nievas',
            'city_id' => 3723,

        ]);

        //Villa Bolaños

        Neighborhood::create([
            'id' => 7020,
            'name' => 'Villa Bolaños',
            'city_id' => 3724,

        ]);

        //Villa Borjas

        Neighborhood::create([
            'id' => 7021,
            'name' => 'Villa Borjas',
            'city_id' => 3725,

        ]);

        //Villa Centenario

        Neighborhood::create([
            'id' => 7022,
            'name' => 'Villa Centenario',
            'city_id' => 3726,

        ]);

        //Villa Corral

        Neighborhood::create([
            'id' => 7023,
            'name' => 'Villa Corral',
            'city_id' => 3727,

        ]);

        //Villa Dominguito

        Neighborhood::create([
            'id' => 7024,
            'name' => 'Villa Dominguito',
            'city_id' => 3728,

        ]);

        //Villa Don Bosco

        Neighborhood::create([
            'id' => 7025,
            'name' => 'Villa Don Bosco',
            'city_id' => 3729,

        ]);

        //Villa El Salvador

        Neighborhood::create([
            'id' => 7026,
            'name' => 'Villa El Salvador',
            'city_id' => 3730,

        ]);

        //Villa El Tango

        Neighborhood::create([
            'id' => 7027,
            'name' => 'Villa El Tango',
            'city_id' => 3731,

        ]);

        //Villa Ibáñez

        Neighborhood::create([
            'id' => 7028,
            'name' => 'Villa Ibáñez',
            'city_id' => 3732,

        ]);

        //Villa Independencia

        Neighborhood::create([
            'id' => 7029,
            'name' => 'Villa Independencia',
            'city_id' => 3733,

        ]);

        //Villa Krause

        Neighborhood::create([
            'id' => 7030,
            'name' => 'Villa Krause',
            'city_id' => 3734,

        ]);

        //Villa Malvinas Argentinas

        Neighborhood::create([
            'id' => 7031,
            'name' => 'Villa Malvinas Argentinas',
            'city_id' => 3735,

        ]);

        //Villa Media Agua

        Neighborhood::create([
            'id' => 7032,
            'name' => 'Villa Media Agua',
            'city_id' => 3736,

        ]);

        //Villa Mercedes

        Neighborhood::create([
            'id' => 7033,
            'name' => 'Villa Mercedes',
            'city_id' => 3737,

        ]);

        //Villa Nacusi

        Neighborhood::create([
            'id' => 7034,
            'name' => 'Villa Nacusi',
            'city_id' => 3738,

        ]);

        //Villa Nueva

        Neighborhood::create([
            'id' => 7035,
            'name' => 'Villa Nueva',
            'city_id' => 3739,

        ]);

        //Villa Nueve de Julio

        Neighborhood::create([
            'id' => 7036,
            'name' => 'Villa Nueve de Julio',
            'city_id' => 3740,

        ]);

        //Villa Obrera

        Neighborhood::create([
            'id' => 7037,
            'name' => 'Villa Obrera',
            'city_id' => 3741,

        ]);

        //Villa Observatorio

        Neighborhood::create([
            'id' => 7038,
            'name' => 'Villa Observatorio',
            'city_id' => 3742,

        ]);

        //Villa Pituil

        Neighborhood::create([
            'id' => 7039,
            'name' => 'Villa General San Martín',
            'city_id' => 3743,

        ]);

        //Villa San Agustín

        Neighborhood::create([
            'id' => 7040,
            'name' => 'Villa San Agustín',
            'city_id' => 3744,

        ]);

        //Villa San Martín

        Neighborhood::create([
            'id' => 7041,
            'name' => 'Villa San Martín',
            'city_id' => 3745,

        ]);

        //Villa Santa Rosa

        Neighborhood::create([
            'id' => 7042,
            'name' => 'Villa Santa Rosa',
            'city_id' => 3746,

        ]);

        //Villa Sefair Talacasto

        Neighborhood::create([
            'id' => 7043,
            'name' => 'Villa Sefair Talacasto',
            'city_id' => 3747,

        ]);

        //Villa Tucú

        Neighborhood::create([
            'id' => 7044,
            'name' => 'Villa Tucú',
            'city_id' => 3748,

        ]);

        //Villa Unión

        Neighborhood::create([
            'id' => 7045,
            'name' => 'Villa Unión',
            'city_id' => 3749,

        ]);

        //Zonda

        Neighborhood::create([
            'id' => 7046,
            'name' => 'Zonda',
            'city_id' => 3750,

        ]);

        // Villa Merlo (San Luis)

        Neighborhood::create([
            'id' => 7047,
            'name' => 'Merlo',
            'city_id' => 3751,

        ]);

        Neighborhood::create([
            'id' => 7048,
            'name' => 'Cerro de Oro',
            'city_id' => 3751,

        ]);

        Neighborhood::create([
            'id' => 7049,
            'name' => 'El Rincón',
            'city_id' => 3751,

        ]);

        Neighborhood::create([
            'id' => 7050,
            'name' => 'Las Moreras',
            'city_id' => 3751,

        ]);

        Neighborhood::create([
            'id' => 7051,
            'name' => 'Piedra Blanca Abajo',
            'city_id' => 3751,

        ]);

        Neighborhood::create([
            'id' => 7052,
            'name' => 'Las Nubes',
            'city_id' => 3751,

        ]);

        Neighborhood::create([
            'id' => 7053,
            'name' => 'Piedra Blanca Arriba',
            'city_id' => 3751,

        ]);

        //San Luis

        Neighborhood::create([
            'id' => 7054,
            'name' => 'Nuevo Merlo',
            'city_id' => 3752,

        ]);

        Neighborhood::create([
            'id' => 7055,
            'name' => 'Piedra Blanca ',
            'city_id' => 3752,

        ]);

        Neighborhood::create([
            'id' => 7056,
            'name' => 'Rincón del Este',
            'city_id' => 3752,

        ]);

        Neighborhood::create([
            'id' => 7057,
            'name' => 'Parque de los Nogales',
            'city_id' => 3752,

        ]);

        //Potrero de los Funes

        Neighborhood::create([
            'id' => 7058,
            'name' => 'Potrero de los Funes',
            'city_id' => 3753,

        ]);

        //Juana Koslay

        Neighborhood::create([
            'id' => 7059,
            'name' => 'Juana Koslay',
            'city_id' => 3754,

        ]);

        //Carpintería

        Neighborhood::create([
            'id' => 7060,
            'name' => 'Carpintería',
            'city_id' => 3755,

        ]);

        //Alto Pelado

        Neighborhood::create([
            'id' => 7061,
            'name' => 'Alto Pelado',
            'city_id' => 3756,

        ]);

        //Alto Pencoso

        Neighborhood::create([
            'id' => 7062,
            'name' => 'Alto Pencoso',
            'city_id' => 3757,

        ]);

        //Anchorena

        Neighborhood::create([
            'id' => 7063,
            'name' => 'Anchorena',
            'city_id' => 3758,

        ]);

        //Arizona

        Neighborhood::create([
            'id' => 7064,
            'name' => 'Arizona',
            'city_id' => 3759,

        ]);

        //Bagual

        Neighborhood::create([
            'id' => 7065,
            'name' => 'Bagual',
            'city_id' => 3760,

        ]);

        //Balde

        Neighborhood::create([
            'id' => 7066,
            'name' => 'Balde',
            'city_id' => 3761,

        ]);

        //Betavia

        Neighborhood::create([
            'id' => 7067,
            'name' => 'Betavia',
            'city_id' => 3762,

        ]);

        //Beazley

        Neighborhood::create([
            'id' => 7068,
            'name' => 'Beazley',
            'city_id' => 3763,

        ]);

        //Buena Esperanza

        Neighborhood::create([
            'id' => 7069,
            'name' => 'Buena Esperanza',
            'city_id' => 3764,

        ]);

        //Candelaria

        Neighborhood::create([
            'id' => 7070,
            'name' => 'Candelaria',
            'city_id' => 3765,

        ]);

        //Carolina

        Neighborhood::create([
            'id' => 7071,
            'name' => 'Carolina',
            'city_id' => 3766,

        ]);

        //Concarán

        Neighborhood::create([
            'id' => 7072,
            'name' => 'Concarán',
            'city_id' => 3767,

        ]);

        //Cortaderas

        Neighborhood::create([
            'id' => 7073,
            'name' => 'Cortaderas',
            'city_id' => 3768,

        ]);

        //El Trapiche

        Neighborhood::create([
            'id' => 7074,
            'name' => 'El Trapiche',
            'city_id' => 3769,

        ]);

        //El Volcán

        Neighborhood::create([
            'id' => 7075,
            'name' => 'El Volcán',
            'city_id' => 3770,

        ]);

        //Fortuna

        Neighborhood::create([
            'id' => 7076,
            'name' => 'Fortuna',
            'city_id' => 3771,

        ]);

        //Fortín El Patria

        Neighborhood::create([
            'id' => 7077,
            'name' => 'Fortín El Patria',
            'city_id' => 3772,

        ]);

        //Fraga

        Neighborhood::create([
            'id' => 7078,
            'name' => 'Fraga',
            'city_id' => 3773,

        ]);

        //Juan Jorba

        Neighborhood::create([
            'id' => 7079,
            'name' => 'Juan Jorba',
            'city_id' => 3774,

        ]);

        //Juan Llerena

        Neighborhood::create([
            'id' => 7080,
            'name' => 'Juan Llerena',
            'city_id' => 3775,

        ]);

        //Justo Daract

        Neighborhood::create([
            'id' => 7081,
            'name' => 'Justo Daract',
            'city_id' => 3776,

        ]);

        //La Calera

        Neighborhood::create([
            'id' => 7082,
            'name' => 'La Calera',
            'city_id' => 3777,

        ]);

        //La Florida

        Neighborhood::create([
            'id' => 7083,
            'name' => 'La Florida',
            'city_id' => 3778,

        ]);

        //La Punilla

        Neighborhood::create([
            'id' => 7084,
            'name' => 'La Punilla',
            'city_id' => 3779,

        ]);

        //La Punta

        Neighborhood::create([
            'id' => 7085,
            'name' => 'La Punta',
            'city_id' => 3780,

        ]);

        //La Toma

        Neighborhood::create([
            'id' => 7086,
            'name' => 'La Toma',
            'city_id' => 3781,

        ]);

        //La Toma

        Neighborhood::create([
            'id' => 7087,
            'name' => 'La Toma',
            'city_id' => 3782,

        ]);

        //Lafinur

        Neighborhood::create([
            'id' => 7088,
            'name' => 'Lafinur',
            'city_id' => 3783,

        ]);

        //LAs Acequias de la Merced

        Neighborhood::create([
            'id' => 7089,
            'name' => 'Las Acequias de la Merced',
            'city_id' => 3784,

        ]);

        //Las Aguadas

        Neighborhood::create([
            'id' => 7090,
            'name' => 'Las Aguadas',
            'city_id' => 3785,

        ]);

        //Las Chacras

        Neighborhood::create([
            'id' => 7091,
            'name' => 'Las Chacras',
            'city_id' => 3786,

        ]);

        //Las Lagunas

        Neighborhood::create([
            'id' => 7092,
            'name' => 'Las Lagunas',
            'city_id' => 3787,

        ]);

        //Las Vertientes

        Neighborhood::create([
            'id' => 7093,
            'name' => 'Las Vertientes',
            'city_id' => 3788,

        ]);

        //Lavaisse

        Neighborhood::create([
            'id' => 7094,
            'name' => 'Lavaisse',
            'city_id' => 3789,

        ]);

        //Leandro N Alem

        Neighborhood::create([
            'id' => 7095,
            'name' => 'Leandro N Alem',
            'city_id' => 3790,

        ]);

        //Los Molles

        Neighborhood::create([
            'id' => 7096,
            'name' => 'Los Molles',
            'city_id' => 3791,

        ]);

        //Luján

        Neighborhood::create([
            'id' => 7097,
            'name' => 'Luján',
            'city_id' => 3792,

        ]);

        //Naschel

        Neighborhood::create([
            'id' => 7098,
            'name' => 'Naschel',
            'city_id' => 3793,

        ]);

        //Navia

        Neighborhood::create([
            'id' => 7099,
            'name' => 'Navia',
            'city_id' => 3794,

        ]);

        //Nogolí

        Neighborhood::create([
            'id' => 7100,
            'name' => 'Nogolí',
            'city_id' => 3795,

        ]);

        //Nueva Galia

        Neighborhood::create([
            'id' => 7101,
            'name' => 'Nueva Galia',
            'city_id' => 3796,

        ]);


        //Papagayos

        Neighborhood::create([
            'id' => 7103,
            'name' => 'Papagayos',
            'city_id' => 3798,

        ]);

        //Paso Grande

        Neighborhood::create([
            'id' => 7104,
            'name' => 'Paso Grande',
            'city_id' => 3799,

        ]);

        //Quines

        Neighborhood::create([
            'id' => 7105,
            'name' => 'Quines',
            'city_id' => 3800,

        ]);

        //Renca

        Neighborhood::create([
            'id' => 7106,
            'name' => 'Renca',
            'city_id' => 3801,

        ]);

        //Saladillo

        Neighborhood::create([
            'id' => 7107,
            'name' => 'Saladillo',
            'city_id' => 3802,

        ]);

        //San Francisco del Monte de Oro

        Neighborhood::create([
            'id' => 7108,
            'name' => 'San Francisco del Monte de Oro',
            'city_id' => 3803,

        ]);

        //San Gerónimo

        Neighborhood::create([
            'id' => 7109,
            'name' => 'San Gerónimo',
            'city_id' => 3804,

        ]);

        //San Isidro

        Neighborhood::create([
            'id' => 7110,
            'name' => 'San Isidro',
            'city_id' => 3805,

        ]);

        //San José del Morro

        Neighborhood::create([
            'id' => 7111,
            'name' => 'San José del Morro',
            'city_id' => 3806,

        ]);

        //San Martín

        Neighborhood::create([
            'id' => 7112,
            'name' => 'San Martín ',
            'city_id' => 3807,

        ]);

        //San Pablo

        Neighborhood::create([
            'id' => 7113,
            'name' => 'San Pablo',
            'city_id' => 3808,

        ]);

        //Santa Rosa de Conlara

        Neighborhood::create([
            'id' => 7114,
            'name' => 'Santa Rosa de Conlara',
            'city_id' => 3810,

        ]);

        //Talita

        Neighborhood::create([
            'id' => 7115,
            'name' => 'Talita',
            'city_id' => 3810,

        ]);

        //Tilisarao

        Neighborhood::create([
            'id' => 7116,
            'name' => 'Tilisarao',
            'city_id' => 3811,

        ]);

        //Unión

        Neighborhood::create([
            'id' => 7117,
            'name' => 'Unión',
            'city_id' => 3812,

        ]);

        //Villa de la Quebrada

        Neighborhood::create([
            'id' => 7118,
            'name' => 'Villa de la Quebrada',
            'city_id' => 3813,

        ]);

        //Villa de la Praga

        Neighborhood::create([
            'id' => 7119,
            'name' => 'Villa de la Praga',
            'city_id' => 3814,

        ]);

        //Villa del Carmen

        Neighborhood::create([
            'id' => 7120,
            'name' => 'Villa del Carmen',
            'city_id' => 3815,

        ]);

        //Villa General Roca

        Neighborhood::create([
            'id' => 7121,
            'name' => 'Villa General Roca',
            'city_id' => 3816,

        ]);

        //Villa Larca

        Neighborhood::create([
            'id' => 7122,
            'name' => 'Villa Larca',
            'city_id' => 3817,

        ]);

        //Villa Mercedes

        Neighborhood::create([
            'id' => 7123,
            'name' => 'Villa Mercedes',
            'city_id' => 3818,

        ]);

        //Villa Reynolds

        Neighborhood::create([
            'id' => 7124,
            'name' => 'Villa Reynolds',
            'city_id' => 3819,

        ]);

        //Zanjitas

        Neighborhood::create([
            'id' => 7125,
            'name' => 'Zanjitas',
            'city_id' => 3820,

        ]);

        //Santa Cruz

        Neighborhood::create([
            'id' => 7126,
            'name' => 'El Calafate',
            'city_id' => 3821,

        ]);

        //Caleta Olivia

        Neighborhood::create([
            'id' => 7127,
            'name' => 'La Cabaña',
            'city_id' => 3822,

        ]);

        //Río Gallegos

        Neighborhood::create([
            'id' => 7128,
            'name' => 'Río Gallegos',
            'city_id' => 3823,

        ]);

        //Río Chico

        Neighborhood::create([
            'id' => 7129,
            'name' => 'Río Chico',
            'city_id' => 3824,

        ]);

        //Tres Lagos

        Neighborhood::create([
            'id' => 7130,
            'name' => 'Tres Lagos',
            'city_id' => 3825,

        ]);

        //Bahía Laura

        Neighborhood::create([
            'id' => 7131,
            'name' => 'Bahía Laura',
            'city_id' => 3826,

        ]);

        //Bajo Caracoles

        Neighborhood::create([
            'id' => 7132,
            'name' => 'Bajo Caracoles',
            'city_id' => 3827,

        ]);

        //Bella Vista

        Neighborhood::create([
            'id' => 7133,
            'name' => 'Bella Vista',
            'city_id' => 3828,

        ]);

        //Cabo Blanco

        Neighborhood::create([
            'id' => 7134,
            'name' => 'Cabo Blanco',
            'city_id' => 3829,

        ]);

        //Cabo Virgenes

        Neighborhood::create([
            'id' => 7135,
            'name' => 'Cabo Vírgenes',
            'city_id' => 3830,

        ]);

        //Cañadón Seco

        Neighborhood::create([
            'id' => 7136,
            'name' => 'Cañadon Seco',
            'city_id' => 3831,

        ]);

        //Cerro Leon

        Neighborhood::create([
            'id' => 7137,
            'name' => 'Cerro Leon',
            'city_id' => 3832,

        ]);

        //Comandante Luis Piedrabuena

        Neighborhood::create([
            'id' => 7138,
            'name' => 'Comandante Luis Piedrabuena',
            'city_id' => 3833,

        ]);

        //Cueva de las Manos

        Neighborhood::create([
            'id' => 7139,
            'name' => 'Cueva de las Manos',
            'city_id' => 3834,

        ]);

        //El Chaltén

        Neighborhood::create([
            'id' => 7140,
            'name' => 'El Chaltén',
            'city_id' => 3835,

        ]);

        //El Pluma

        Neighborhood::create([
            'id' => 7141,
            'name' => 'El Pluma',
            'city_id' => 3836,

        ]);

        //El Salado

        Neighborhood::create([
            'id' => 7142,
            'name' => 'El Salado',
            'city_id' => 3837,

        ]);

        //El Turbio

        Neighborhood::create([
            'id' => 7143,
            'name' => 'El Turbio',
            'city_id' => 3838,

        ]);

        //Esperanza

        Neighborhood::create([
            'id' => 7144,
            'name' => 'Esperanza',
            'city_id' => 3839,

        ]);

        //Fitz Roy

        Neighborhood::create([
            'id' => 7145,
            'name' => 'Fitz Roy',
            'city_id' => 3840,

        ]);

        //Fuentes del Coyle

        Neighborhood::create([
            'id' => 7146,
            'name' => 'Fuentes del Coyle',
            'city_id' => 3841,

        ]);

        //Gobernador Gregores

        Neighborhood::create([
            'id' => 7147,
            'name' => 'El Salado',
            'city_id' => 3842,

        ]);

        //Güer Aike

        Neighborhood::create([
            'id' => 7148,
            'name' => 'Güer Aike',
            'city_id' => 3843,

        ]);

        //J Dufour

        Neighborhood::create([
            'id' => 7149,
            'name' => 'J Dufour',
            'city_id' => 3844,

        ]);

        //Jaramillo

        Neighborhood::create([
            'id' => 7150,
            'name' => 'Jaramillo',
            'city_id' => 3845,

        ]);

        //Koluel Kayke

        Neighborhood::create([
            'id' => 7151,
            'name' => 'Koluel Kayke',
            'city_id' => 3846,

        ]);

        //La Leona

        Neighborhood::create([
            'id' => 7152,
            'name' => 'La Leona',
            'city_id' => 3847,

        ]);

        //Lago Posadas

        Neighborhood::create([
            'id' => 7153,
            'name' => 'Lago Posadas',
            'city_id' => 3848,

        ]);

        //Las Heras

        Neighborhood::create([
            'id' => 7154,
            'name' => 'Las Heras',
            'city_id' => 3849,

        ]);

        //Los Antiguos

        Neighborhood::create([
            'id' => 7155,
            'name' => 'Los Antiguos',
            'city_id' => 3850,

        ]);

        //Los Monos

        Neighborhood::create([
            'id' => 7156,
            'name' => 'Los Monos',
            'city_id' => 3851,

        ]);

        //Mina 3

        Neighborhood::create([
            'id' => 7157,
            'name' => 'Mina 3',
            'city_id' => 3852,

        ]);

        //Pampa Alta

        Neighborhood::create([
            'id' => 7158,
            'name' => 'Pampa Alta',
            'city_id' => 3853,

        ]);

        //Perito Moreno

        Neighborhood::create([
            'id' => 7159,
            'name' => 'Perito Moreno',
            'city_id' => 3854,

        ]);

        //Pico Truncado

        Neighborhood::create([
            'id' => 7160,
            'name' => 'Pico Truncado',
            'city_id' => 3855,

        ]);

        //Puerto Bandera

        Neighborhood::create([
            'id' => 7161,
            'name' => 'Puerto Bandera',
            'city_id' => 3856,

        ]);

        //Puerto de Punta Quilla

        Neighborhood::create([
            'id' => 7162,
            'name' => 'Puerta de Punta Quilla',
            'city_id' => 3857,

        ]);

        //Puerto Deseado

        Neighborhood::create([
            'id' => 7163,
            'name' => 'Puerto Deseado',
            'city_id' => 3858,

        ]);

        //Puerto San Julián

        Neighborhood::create([
            'id' => 7164,
            'name' => 'Puerto San Julián',
            'city_id' => 3859,

        ]);

        //Puerto Santa Cruz

        Neighborhood::create([
            'id' => 7165,
            'name' => 'Puerto Santa Cruz',
            'city_id' => 3860,

        ]);

        //Punta Loyola

        Neighborhood::create([
            'id' => 7166,
            'name' => 'Punta Loyola',
            'city_id' => 3861,

        ]);

        //Rospentek Aike

        Neighborhood::create([
            'id' => 7167,
            'name' => 'Rospentek Aike',
            'city_id' => 3862,

        ]);

        //Río Blanco

        Neighborhood::create([
            'id' => 7168,
            'name' => 'Río Blanco',
            'city_id' => 3863,

        ]);

        //Río Olnie

        Neighborhood::create([
            'id' => 7169,
            'name' => 'Río Olnie',
            'city_id' => 3864,

        ]);

        //Río Turbio

        Neighborhood::create([
            'id' => 7170,
            'name' => 'Río Turbio',
            'city_id' => 3865,

        ]);

        //Tamel Aike

        Neighborhood::create([
            'id' => 7171,
            'name' => 'Tamel Aike',
            'city_id' => 3866,

        ]);

        //Tellier

        Neighborhood::create([
            'id' => 7172,
            'name' => 'Tellier',
            'city_id' => 3867,

        ]);

        //Tres Cerros

        Neighborhood::create([
            'id' => 7173,
            'name' => 'Tres Cerros',
            'city_id' => 3868,

        ]);

        //Veintiocho de Noviembre

        Neighborhood::create([
            'id' => 7174,
            'name' => 'Veintiocho de Noviembre',
            'city_id' => 3869,

        ]);

        //Santiago del Estero

        Neighborhood::create([
            'id' => 7175,
            'name' => 'Tellier',
            'city_id' => 3870,

        ]);

        //Santos Lugares

        Neighborhood::create([
            'id' => 7176,
            'name' => 'Santos Lugares',
            'city_id' => 3871,

        ]);

        //Termas de Río Hondo

        Neighborhood::create([
            'id' => 7177,
            'name' => 'Termas de Río Hondo',
            'city_id' => 3872,

        ]);

        //La Banda

        Neighborhood::create([
            'id' => 7178,
            'name' => 'La Banda',
            'city_id' => 3873,

        ]);

        //Nueva Esperanza

        Neighborhood::create([
            'id' => 7179,
            'name' => 'Nueva Esperanza',
            'city_id' => 3874,

        ]);

        //Agustina Libarona

        Neighborhood::create([
            'id' => 7180,
            'name' => 'Agustina Libarona',
            'city_id' => 3875,

        ]);

        //Ahí Veremos

        Neighborhood::create([
            'id' => 7181,
            'name' => 'Ahí Veremos',
            'city_id' => 3876,

        ]);

        //Ancaján

        Neighborhood::create([
            'id' => 7182,
            'name' => 'Ancaján',
            'city_id' => 3877,

        ]);

        //Anga

        Neighborhood::create([
            'id' => 7183,
            'name' => 'Anga',
            'city_id' => 3878,

        ]);

        //Antajé

        Neighborhood::create([
            'id' => 7184,
            'name' => 'Antajé',
            'city_id' => 3879,

        ]);

        //Ardiles

        Neighborhood::create([
            'id' => 7185,
            'name' => 'Ardiles',
            'city_id' => 3880,

        ]);

        //Argentina

        Neighborhood::create([
            'id' => 7186,
            'name' => 'Argentina',
            'city_id' => 3881,

        ]);

        //Averías

        Neighborhood::create([
            'id' => 7187,
            'name' => 'Averías',
            'city_id' => 3882,

        ]);

        //Ayuncha

        Neighborhood::create([
            'id' => 7188,
            'name' => 'Ayuncha',
            'city_id' => 3883,

        ]);

        //Añatuya

        Neighborhood::create([
            'id' => 7189,
            'name' => 'Añatuya',
            'city_id' => 3884,

        ]);

        //Bandera Bajada

        Neighborhood::create([
            'id' => 7190,
            'name' => 'Bandera Bajada',
            'city_id' => 3885,

        ]);

        //Barrancas

        Neighborhood::create([
            'id' => 7191,
            'name' => 'Barrancas',
            'city_id' => 3886,

        ]);

        //Barrancas Coloradas

        Neighborhood::create([
            'id' => 7192,
            'name' => 'Barrancas Coloradas',
            'city_id' => 3887,

        ]);

        //Belgrano

        Neighborhood::create([
            'id' => 7193,
            'name' => 'Belgrano',
            'city_id' => 3888,

        ]);

        //Beltrán

        Neighborhood::create([
            'id' => 7194,
            'name' => 'Beltrán',
            'city_id' => 3889,

        ]);

        //Brea Pozo

        Neighborhood::create([
            'id' => 7195,
            'name' => 'Brea Pozo',
            'city_id' => 3890,

        ]);

        //Campo Alegre

        Neighborhood::create([
            'id' => 7196,
            'name' => 'Campo Alegre',
            'city_id' => 3891,

        ]);

        //Campo Gallo

        Neighborhood::create([
            'id' => 7197,
            'name' => 'Campo Gallo',
            'city_id' => 3892,

        ]);

        //Campo Grande

        Neighborhood::create([
            'id' => 7198,
            'name' => 'Campo Grande',
            'city_id' => 3893,

        ]);

        //Casares

        Neighborhood::create([
            'id' => 7199,
            'name' => 'Casares',
            'city_id' => 3894,

        ]);

        //Caspi Corral

        Neighborhood::create([
            'id' => 7200,
            'name' => 'Caspi Corral',
            'city_id' => 3895,

        ]);

        //Cañada Escobar

        Neighborhood::create([
            'id' => 7201,
            'name' => 'Cañada Escobar',
            'city_id' => 3896,

        ]);

        //Chaupi Pozo

        Neighborhood::create([
            'id' => 7202,
            'name' => 'Chaupi Pozo',
            'city_id' => 3897,

        ]);

        //Chilca Juliana

        Neighborhood::create([
            'id' => 7203,
            'name' => 'Chilca Juliana',
            'city_id' => 3898,

        ]);

        //Chilca La Loma

        Neighborhood::create([
            'id' => 7204,
            'name' => 'Chilca La Loma',
            'city_id' => 3899,

        ]);

        //Choya

        Neighborhood::create([
            'id' => 7205,
            'name' => 'Choya',
            'city_id' => 3900,

        ]);

        //Chuña Albardón

        Neighborhood::create([
            'id' => 7206,
            'name' => 'Chuña Albardón',
            'city_id' => 3901,

        ]);

        //Clodomira

        Neighborhood::create([
            'id' => 7207,
            'name' => 'Clodomira',
            'city_id' => 3902,

        ]);

        //Collera Huarcuna

        Neighborhood::create([
            'id' => 7208,
            'name' => 'Collera Huarcuna',
            'city_id' => 3903,

        ]);

        //Colonia Alpina

        Neighborhood::create([
            'id' => 7209,
            'name' => 'Colonia Alpina',
            'city_id' => 3904,

        ]);

        //Colonia Dora

        Neighborhood::create([
            'id' => 7210,
            'name' => 'Colonia Dora',
            'city_id' => 3905,

        ]);

        //Colonia El Simbolar

        Neighborhood::create([
            'id' => 7211,
            'name' => 'Colonia El Simbolar',
            'city_id' => 3906,

        ]);

        //Colonia Pinto

        Neighborhood::create([
            'id' => 7212,
            'name' => 'Colonia Pinto',
            'city_id' => 3907,

        ]);

        //Colonia San Juan

        Neighborhood::create([
            'id' => 7213,
            'name' => 'Colonia San Juan',
            'city_id' => 3908,

        ]);

        //Colonia Tinco

        Neighborhood::create([
            'id' => 7214,
            'name' => 'Colonia Tinco',
            'city_id' => 3909,

        ]);

        //Coronel Manuel Leoncio Rico

        Neighborhood::create([
            'id' => 7215,
            'name' => 'Coronel Manuel Leoncio Rico',
            'city_id' => 3910,

        ]);

        //Cuatro Bocas

        Neighborhood::create([
            'id' => 7216,
            'name' => 'Cuatro Bocas',
            'city_id' => 3911,

        ]);

        //Diente del Arado

        Neighborhood::create([
            'id' => 7217,
            'name' => 'Diente del Arado',
            'city_id' => 3912,

        ]);

        //Donadeu

        Neighborhood::create([
            'id' => 7218,
            'name' => 'Donadeu',
            'city_id' => 3913,

        ]);

        //Doña Luisa

        Neighborhood::create([
            'id' => 7219,
            'name' => 'Doña Luisa',
            'city_id' => 3914,

        ]);

        //El Arenal

        Neighborhood::create([
            'id' => 7220,
            'name' => 'El Arenal',
            'city_id' => 3915,

        ]);

        //El Bobadal

        Neighborhood::create([
            'id' => 7221,
            'name' => 'El Bobadal',
            'city_id' => 3916,

        ]);

        //El Caburé

        Neighborhood::create([
            'id' => 7222,
            'name' => 'El Caburé',
            'city_id' => 3917,

        ]);

        //El Charco

        Neighborhood::create([
            'id' => 7223,
            'name' => 'El Charco',
            'city_id' => 3918,

        ]);

        //El Colorado

        Neighborhood::create([
            'id' => 7224,
            'name' => 'El Colorado',
            'city_id' => 3919,

        ]);

        //El Cuadrado

        Neighborhood::create([
            'id' => 7225,
            'name' => 'El Cuadrado',
            'city_id' => 3920,

        ]);

        //El Mojón

        Neighborhood::create([
            'id' => 7226,
            'name' => 'El Mojón',
            'city_id' => 3921,

        ]);

        //El Remate

        Neighborhood::create([
            'id' => 7227,
            'name' => 'El Remate',
            'city_id' => 3922,

        ]);

        //El Setenta

        Neighborhood::create([
            'id' => 7228,
            'name' => 'El Setenta',
            'city_id' => 3923,

        ]);

        //Estación Atamisqui

        Neighborhood::create([
            'id' => 7229,
            'name' => 'Estación Atamisqui',
            'city_id' => 3924,

        ]);

        //Estación La Punta

        Neighborhood::create([
            'id' => 7230,
            'name' => 'Estacíon La Punta',
            'city_id' => 3925,

        ]);

        //Estación Robles

        Neighborhood::create([
            'id' => 7231,
            'name' => 'Estación Robles',
            'city_id' => 3926,

        ]);

        //Estación Simbolar

        Neighborhood::create([
            'id' => 7232,
            'name' => 'Estación Simbolar',
            'city_id' => 3927,

        ]);

        //Estación Taboada

        Neighborhood::create([
            'id' => 7233,
            'name' => 'Estación Taboada',
            'city_id' => 3928,

        ]);

        //Estación Tacañitas

        Neighborhood::create([
            'id' => 7234,
            'name' => 'Estación Tacañitas',
            'city_id' => 3929,

        ]);

        //Fernández

        Neighborhood::create([
            'id' => 7235,
            'name' => 'Fernández',
            'city_id' => 3930,

        ]);

        //Fortín Inca

        Neighborhood::create([
            'id' => 7236,
            'name' => 'Fortín Inca',
            'city_id' => 3931,

        ]);

        //Frías

        Neighborhood::create([
            'id' => 7237,
            'name' => 'Frías',
            'city_id' => 3932,

        ]);

        //Garza

        Neighborhood::create([
            'id' => 7238,
            'name' => 'Garza',
            'city_id' => 3933,

        ]);

        //Gramilla

        Neighborhood::create([
            'id' => 7239,
            'name' => 'Gramilla',
            'city_id' => 3934,

        ]);

        //Guampacha

        Neighborhood::create([
            'id' => 7240,
            'name' => 'Guampacha',
            'city_id' => 3935,

        ]);

        //Guardia Escolta

        Neighborhood::create([
            'id' => 7241,
            'name' => 'Guardia Escolta',
            'city_id' => 3936,

        ]);

        //Herrera

        Neighborhood::create([
            'id' => 7242,
            'name' => 'Herrera',
            'city_id' => 3937,

        ]);

        //Hoyón

        Neighborhood::create([
            'id' => 7243,
            'name' => 'Hoyón',
            'city_id' => 3938,

        ]);

        //Huachana

        Neighborhood::create([
            'id' => 7244,
            'name' => 'Huachana',
            'city_id' => 3939,

        ]);

        //Icaño

        Neighborhood::create([
            'id' => 7245,
            'name' => 'Icaño',
            'city_id' => 3940,

        ]);

        //Ingeniero Forres

        Neighborhood::create([
            'id' => 7246,
            'name' => 'Ingeniero Forres',
            'city_id' => 3941,

        ]);

        //Jumi Pozo

        Neighborhood::create([
            'id' => 7247,
            'name' => 'Jumi Pozo',
            'city_id' => 3942,

        ]);

        //Kilómetro 83

        Neighborhood::create([
            'id' => 7248,
            'name' => 'Kilómetro 83',
            'city_id' => 3943,

        ]);

        //Kilómetro 90

        Neighborhood::create([
            'id' => 7249,
            'name' => 'Kilómetro 90',
            'city_id' => 3944,

        ]);

        //La Abrita

        Neighborhood::create([
            'id' => 7250,
            'name' => 'La Abrita',
            'city_id' => 3945,

        ]);

        //La Aurora

        Neighborhood::create([
            'id' => 7251,
            'name' => 'La Aurora',
            'city_id' => 3946,

        ]);

        //La Banda

        Neighborhood::create([
            'id' => 7252,
            'name' => 'La Banda',
            'city_id' => 3947,

        ]);

        //La Blanca

        Neighborhood::create([
            'id' => 7253,
            'name' => 'La Blanca',
            'city_id' => 3948,

        ]);

        //La Cañada

        Neighborhood::create([
            'id' => 7254,
            'name' => 'La Cañada',
            'city_id' => 3949,

        ]);

        //La Dormida

        Neighborhood::create([
            'id' => 7255,
            'name' => 'La Dormida',
            'city_id' => 3950,

        ]);

        //La Darsena

        Neighborhood::create([
            'id' => 7256,
            'name' => 'La Darsena',
            'city_id' => 3951,

        ]);

        //La Fragua

        Neighborhood::create([
            'id' => 7257,
            'name' => 'La Fragua',
            'city_id' => 3952,

        ]);

        //La Higuera

        Neighborhood::create([
            'id' => 7258,
            'name' => 'La Higuera',
            'city_id' => 3953,

        ]);

        //La Invernada

        Neighborhood::create([
            'id' => 7259,
            'name' => 'La Invernada',
            'city_id' => 3954,

        ]);

        //La Noria

        Neighborhood::create([
            'id' => 7260,
            'name' => 'La Noria',
            'city_id' => 3955,

        ]);

        //La Revancha

        Neighborhood::create([
            'id' => 7261,
            'name' => 'La Revancha',
            'city_id' => 3956,

        ]);

        //Laprida

        Neighborhood::create([
            'id' => 7262,
            'name' => 'Laprida',
            'city_id' => 3957,

        ]);

        //Las Carpas

        Neighborhood::create([
            'id' => 7263,
            'name' => 'Las Carpas',
            'city_id' => 3958,

        ]);

        //Las Delicias

        Neighborhood::create([
            'id' => 7264,
            'name' => 'Las Delicias',
            'city_id' => 3959,

        ]);

        //Las Tinajas

        Neighborhood::create([
            'id' => 7265,
            'name' => 'Las Tinajas',
            'city_id' => 3960,

        ]);

        //Lavalle

        Neighborhood::create([
            'id' => 7266,
            'name' => 'Lavalle',
            'city_id' => 3961,

        ]);

        //Loreto

        Neighborhood::create([
            'id' => 7267,
            'name' => 'Loreto',
            'city_id' => 3962,

        ]);

        //Los Cerrillos

        Neighborhood::create([
            'id' => 7268,
            'name' => 'Los Cerrillos',
            'city_id' => 3963,

        ]);

        //Los Gallegos

        Neighborhood::create([
            'id' => 7269,
            'name' => 'Los Gallegos',
            'city_id' => 3964,

        ]);

        //Los Juríes

        Neighborhood::create([
            'id' => 7270,
            'name' => 'Los Juríes',
            'city_id' => 3965,

        ]);

        //Los Núñez

        Neighborhood::create([
            'id' => 7271,
            'name' => 'Los Núñez',
            'city_id' => 3966,

        ]);

        //Los Pirpintos

        Neighborhood::create([
            'id' => 7272,
            'name' => 'Los Pirpintos',
            'city_id' => 3967,

        ]);

        //Los Quiroga

        Neighborhood::create([
            'id' => 7273,
            'name' => 'Los Quiroga',
            'city_id' => 3968,

        ]);

        //Los Telares

        Neighborhood::create([
            'id' => 7274,
            'name' => 'Los Telares',
            'city_id' => 3969,

        ]);


        //Los Tolozas

        Neighborhood::create([
            'id' => 7275,
            'name' => 'Los Tolozas',
            'city_id' => 3970,

        ]);

        //Lugones

        Neighborhood::create([
            'id' => 7276,
            'name' => 'Lugones',
            'city_id' => 3971,

        ]);

        //Malbrán

        Neighborhood::create([
            'id' => 7277,
            'name' => 'Malbrán',
            'city_id' => 3972,

        ]);

        //Malota

        Neighborhood::create([
            'id' => 7278,
            'name' => 'Malota',
            'city_id' => 3973,

        ]);

        //Manogasta

        Neighborhood::create([
            'id' => 7279,
            'name' => 'Manogasta',
            'city_id' => 3974,

        ]);

        //Matará

        Neighborhood::create([
            'id' => 7280,
            'name' => 'Matará',
            'city_id' => 3975,

        ]);

        //Medellín

        Neighborhood::create([
            'id' => 7281,
            'name' => 'Medellín',
            'city_id' => 3976,

        ]);

        //Mistol Pozo

        Neighborhood::create([
            'id' => 7282,
            'name' => 'Mistol Pozo',
            'city_id' => 3977,

        ]);

        //Monte Quemado

        Neighborhood::create([
            'id' => 7283,
            'name' => 'Monte Quemado',
            'city_id' => 3978,

        ]);

        //Monte Redondo

        Neighborhood::create([
            'id' => 7284,
            'name' => 'Monte Redondo',
            'city_id' => 3979,

        ]);

        //Nueva Francia

        Neighborhood::create([
            'id' => 7285,
            'name' => 'Nueva Francia',
            'city_id' => 3980,

        ]);


        //Otumpa

        Neighborhood::create([
            'id' => 7287,
            'name' => 'Otumpa',
            'city_id' => 3982,

        ]);

        //Palo Negro

        Neighborhood::create([
            'id' => 7288,
            'name' => 'Palo Negro',
            'city_id' => 3983,

        ]);

        //Pampa de los Guanacos

        Neighborhood::create([
            'id' => 7289,
            'name' => 'Pampa de los Guanacos',
            'city_id' => 3984,

        ]);

        //Patay

        Neighborhood::create([
            'id' => 7290,
            'name' => 'Patay',
            'city_id' => 3985,

        ]);

        //Perchil Bajo

        Neighborhood::create([
            'id' => 7291,
            'name' => 'Perchil Bajo',
            'city_id' => 3986,

        ]);

        //Pinto

        Neighborhood::create([
            'id' => 7292,
            'name' => 'Pinto',
            'city_id' => 3987,

        ]);

        //Pozo Betbeder

        Neighborhood::create([
            'id' => 7293,
            'name' => 'Pozo Betbeder',
            'city_id' => 3988,

        ]);

        //Pozo del Toba

        Neighborhood::create([
            'id' => 7294,
            'name' => 'Pozo del Toba',
            'city_id' => 3989,

        ]);

        //Pozo Hondo

        Neighborhood::create([
            'id' => 7295,
            'name' => 'Pozo Hondo',
            'city_id' => 3990,

        ]);

        //Pozuelos

        Neighborhood::create([
            'id' => 7296,
            'name' => 'Pozuelos',
            'city_id' => 3991,

        ]);

        //Puestito

        Neighborhood::create([
            'id' => 7297,
            'name' => 'Puestito',
            'city_id' => 3992,

        ]);

        //Puesto de Juanes

        Neighborhood::create([
            'id' => 7298,
            'name' => 'Puesto de Juanes',
            'city_id' => 3993,

        ]);

        //Puesto de Suárez

        Neighborhood::create([
            'id' => 7299,
            'name' => 'Puesto de Suárez',
            'city_id' => 3994,

        ]);

        //Punua

        Neighborhood::create([
            'id' => 7300,
            'name' => 'Punua',
            'city_id' => 3995,

        ]);

        //Quebracho Coto

        Neighborhood::create([
            'id' => 7301,
            'name' => 'Quebracho Coto',
            'city_id' => 3996,

        ]);

        //Quimilí

        Neighborhood::create([
            'id' => 7302,
            'name' => 'Quimilí',
            'city_id' => 3997,

        ]);

        //Ramírez de Velazco

        Neighborhood::create([
            'id' => 7303,
            'name' => 'Ramírez de Velazco',
            'city_id' => 3998,

        ]);

        //Rapelli

        Neighborhood::create([
            'id' => 7304,
            'name' => 'Rapelli',
            'city_id' => 3999,

        ]);

        //Real Sayana

        Neighborhood::create([
            'id' => 7305,
            'name' => 'Real Sayana',
            'city_id' => 4000,

        ]);

        //Rubia Paso

        Neighborhood::create([
            'id' => 7306,



