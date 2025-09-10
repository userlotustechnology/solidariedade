<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participant;
use App\Models\User;
use Carbon\Carbon;

class ParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar um usuário para ser o responsável pelo cadastro
        $defaultUser = User::first();
        
        if (!$defaultUser) {
            $this->command->error('Nenhum usuário encontrado. Execute primeiro o UserSeeder.');
            return;
        }

        $participants = [
            [
                'name' => 'ABRÃAO FERREIRA DE ARAÚJO',
                'document_number' => '141.111.604-68',
                'neighborhood' => 'TORRE',
                'birth_date' => '1955-06-05',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ANA MARIA DOS SANTOS VALERIANO',
                'document_number' => '073.057.554-35',
                'neighborhood' => 'ALTO DO CÉU',
                'birth_date' => '1970-11-04',
                'family_members' => 5,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ANALIANE FELICIANO DE OLIVEIRA',
                'document_number' => '705.428.974-90',
                'neighborhood' => 'JAGUARIBE',
                'birth_date' => '1998-01-10',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ANTONIA DA SILVA LIMA',
                'document_number' => '468.459.094-15',
                'neighborhood' => 'MANGABEIRA',
                'birth_date' => '1952-09-27',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ANTONIA INACIO DE SOUZA',
                'document_number' => '250.500.104-97',
                'neighborhood' => 'DOS IPÊS',
                'birth_date' => '1952-05-13',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ANTONIA MARIA DOS SANTOS MARINHO',
                'document_number' => '079.615.874-62',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1963-03-05',
                'family_members' => 11,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ANTONIA MARIA NOBREGA DOS SANTOS',
                'document_number' => '569.530.034-72',
                'neighborhood' => 'CRISTO',
                'birth_date' => '1946-04-21',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ANTONIA VALERIANO DOS SANTOS',
                'document_number' => '062.496.434-51',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1961-01-02',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'BETANIA ALVES DOS SANTOS',
                'document_number' => '768.167.614-72',
                'neighborhood' => 'VARJÃO',
                'birth_date' => '1962-02-05',
                'family_members' => 10,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'CECÍLIA ALVES DE LIMA',
                'document_number' => '468.425.354-68',
                'neighborhood' => 'TORRE',
                'birth_date' => '1962-02-05',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'CLEONEIDE DE ARAUJO COSTA SILVA',
                'document_number' => '788.411.864-53',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1973-02-22',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'CLEONICE DE ARAUJO COSTA',
                'document_number' => '507.465.964-72',
                'neighborhood' => 'DOS IPÊS',
                'birth_date' => '1948-04-03',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'CRISTINA VIANA DA SILVA',
                'document_number' => '674.681.604-49',
                'neighborhood' => 'MANGABEIRA',
                'birth_date' => '1965-01-07',
                'family_members' => 3,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'DACILDA DO CARMO SOUZA',
                'document_number' => '753.679.394-49',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1937-12-19',
                'family_members' => 2,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'DANIELLE RICARTE NOGUEIRA',
                'document_number' => '078.993.314-47',
                'neighborhood' => 'DAS INDUSTRIAS',
                'birth_date' => '1986-12-03',
                'family_members' => 5,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'DORIVANE PESSOA DA SILVA',
                'document_number' => '442.059.534-53',
                'neighborhood' => 'COLINAS DO SUL',
                'birth_date' => '1965-07-25',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'EDILEUZA FAUSTINO DE LIMA',
                'document_number' => '011.179.194-47',
                'neighborhood' => 'TREZE DE MAIO',
                'birth_date' => '1966-01-07',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'EDNA MARIA CARNEIRO DOS SANTOS',
                'document_number' => '717.300.704-69',
                'neighborhood' => 'RANGEL',
                'birth_date' => '1957-11-02',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'EGRIMÁRIO MARINHO DE ALBUQUERQUE',
                'document_number' => '181.099.694-53',
                'neighborhood' => 'TORRE',
                'birth_date' => '1948-10-02',
                'family_members' => 6,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ELIETE ALVES DOS SANTOS',
                'document_number' => '024.558.184-70',
                'neighborhood' => 'VARJÃO',
                'birth_date' => '1964-02-20',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ELIZETE LAURENTINO DA SILVA',
                'document_number' => '023.817.514-67',
                'neighborhood' => 'OITIZEIRO',
                'birth_date' => '1965-02-28',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ERIKA MARIANA MENEZES DE FARIAS',
                'document_number' => '046.954.604-24',
                'neighborhood' => 'TORRE',
                'birth_date' => '1982-03-20',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'EROTIDE RIBEIRO',
                'document_number' => '368.361.684-91',
                'neighborhood' => 'CRUZ DAS ARMAS',
                'birth_date' => '1945-10-06',
                'family_members' => 8,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ESLANY DOS SANTOS ARAÚJO',
                'document_number' => '064.783.724-21',
                'neighborhood' => 'JAGUARIBE',
                'birth_date' => '1989-01-14',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'EZIETE MARIA DA CONCEIÇÃO',
                'document_number' => '040.419.594-62',
                'neighborhood' => 'TREZE DE MAIO',
                'birth_date' => '1967-04-01',
                'family_members' => 3,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'FRANCISCA DA SILVA PEREIRA',
                'document_number' => '079.320.714-29',
                'neighborhood' => 'CRISTO',
                'birth_date' => '1952-01-10',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'FRANCISCA DAS CHAGAS DIAS',
                'document_number' => '030.159.294-29',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1944-11-24',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'GENILDA SILVA DOS SANTOS',
                'document_number' => '044.760.124-50',
                'neighborhood' => 'DOS IPÊS',
                'birth_date' => '1950-05-29',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'GILVANEIDE CHAVES DO BU',
                'document_number' => '050.706.504-24',
                'neighborhood' => 'DAS INDUSTRIAS',
                'birth_date' => '1981-10-06',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'GIVANILDA DA SILVA LIRA',
                'document_number' => '011.468.254-20',
                'neighborhood' => 'SÃO RAFAEL',
                'birth_date' => '1981-11-17',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'HELENA MARIA ALEXANDRINO',
                'document_number' => '569.240.544-04',
                'neighborhood' => 'TORRE',
                'birth_date' => '1956-07-05',
                'family_members' => 2,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'IRIS DE LOURDES FELICIANO',
                'document_number' => '203.562.504-15',
                'neighborhood' => 'CENTRO',
                'birth_date' => '1954-05-11',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'IVANEIDE DE OLIVEIRA SILVA',
                'document_number' => '008.620.674-56',
                'neighborhood' => 'ILHA DO BISPO',
                'birth_date' => '1964-10-21',
                'family_members' => 2,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'IVANILDA DE ARAUJO COSTA',
                'document_number' => '038.876.194-63',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1979-05-17',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'IVANILDA NASCIMENTO SILVA',
                'document_number' => '056.618.334-07',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1981-09-02',
                'family_members' => 1,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'IVANISE DO NASCIMENTO SILVA',
                'document_number' => '498.771.784-00',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1963-11-27',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'IVONETE DA SILVA REIS',
                'document_number' => '191.275.024-49',
                'neighborhood' => 'TRINCHEIRAS',
                'birth_date' => '1949-02-04',
                'family_members' => 3,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'IVONETE DO NASCIMENTO SILVA FERREIRA',
                'document_number' => '917.437.964-04',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1971-03-19',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'IVONETE GUEDES DE OLIVEIRA',
                'document_number' => '279.084.884-04',
                'neighborhood' => 'DAS INDUSTRIAS',
                'birth_date' => '1948-12-08',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'IZABEL AMARO',
                'document_number' => '218.725.384-87',
                'neighborhood' => 'PADRE ZÉ',
                'birth_date' => '1946-12-23',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'JOSEFA LAURENTINO',
                'document_number' => '567.583.244-00',
                'neighborhood' => 'VARJÃO',
                'birth_date' => '1960-06-16',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'JOSEFA MARIA DA SILVA MAXIMINO',
                'document_number' => '251.604.944-72',
                'neighborhood' => 'CRUZ DAS ARMAS',
                'birth_date' => '1955-09-28',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'JOSELITA CALIXTO DOS SANTOS',
                'document_number' => '043.278.094-70',
                'neighborhood' => 'TRINCHEIRAS',
                'birth_date' => '1978-09-27',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'JOSELITA DAS GRAÇAS DE HOLANDA',
                'document_number' => '262.644.554-15',
                'neighborhood' => 'COLINAS DO SUL',
                'birth_date' => '1953-12-10',
                'family_members' => 5,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'JULIANA SOARES DA SILVA',
                'document_number' => '094.216.504-76',
                'neighborhood' => 'PADRE ZÉ',
                'birth_date' => '1989-07-10',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'LUCIANA MAURICIO DA SILVA',
                'document_number' => '549.383.504-59',
                'neighborhood' => 'TREZE DE MAIO',
                'birth_date' => '1972-05-05',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'LUCINALDO GONÇALVES DA SILVA',
                'document_number' => '009.294.424-82',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1980-12-27',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'LUISA DA COSTA ROCHA',
                'document_number' => '981.397.114-20',
                'neighborhood' => 'PADRE ZÉ',
                'birth_date' => '1942-06-08',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'LUIZA DEODATO DE SOUZA',
                'document_number' => '738.881.094-34',
                'neighborhood' => 'TRINCHEIRAS',
                'birth_date' => '1963-11-11',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'LUZINETE FABRICIO DE MELO',
                'document_number' => '486.539.934-87',
                'neighborhood' => 'PADRE ZÉ',
                'birth_date' => '1954-12-17',
                'family_members' => 4,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'LUZINETE XAVIER DOS SANTOS',
                'document_number' => '978.732.924-87',
                'neighborhood' => 'EXPEDICINÁRIOS',
                'birth_date' => '1971-09-02',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA ALVES DA SILVA SOARES',
                'document_number' => '848.253.404-15',
                'neighborhood' => 'OITIZEIRO',
                'birth_date' => '1949-03-24',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA BERNADETE LIRA DOS SANTOS',
                'document_number' => '031.907.074-30',
                'neighborhood' => 'JAGUARIBE',
                'birth_date' => '1965-03-20',
                'family_members' => 6,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA BERNARDETE DE ARAUJO ALEXANDRE',
                'document_number' => '285.698.574-20',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1946-09-21',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA CÉLIA SILVA DE ANDRADE',
                'document_number' => '964.794.264-87',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1958-06-23',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA CRISTINA DA SILVA LEITE',
                'document_number' => '717.247.614-04',
                'neighborhood' => 'JAGUARIBE',
                'birth_date' => '1969-06-12',
                'family_members' => 11,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DA PENHA PEREIRA BELIZIO',
                'document_number' => '045.019.734-47',
                'neighborhood' => 'ALTO DO CÉU',
                'birth_date' => '1962-01-20',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DA PENHA SOARES DOS SANTOS',
                'document_number' => '031.424.914-14',
                'neighborhood' => 'PARATIBE',
                'birth_date' => '1955-09-05',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DA SALETE LAURINDO DA SILVA',
                'document_number' => '175.161.534-00',
                'neighborhood' => 'MANGABEIRA',
                'birth_date' => '1950-04-24',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DAS DORES FERREIRA DOS ANJOS',
                'document_number' => '023.127.964-73',
                'neighborhood' => 'RANGEL',
                'birth_date' => '1943-06-09',
                'family_members' => 3,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'MARIA DAS GRAÇAS DE CARVALHO',
                'document_number' => '123.425.564-20',
                'neighborhood' => 'CRUZ DAS ARMAS',
                'birth_date' => '1950-07-10',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DAS GRAÇAS LIMA DE VASCONCELOS',
                'document_number' => '139.597.514-00',
                'neighborhood' => 'CRUZ DAS ARMAS',
                'birth_date' => '1950-04-25',
                'family_members' => 7,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DAS GRAÇAS PEREIRA DO NASCIMENTO',
                'document_number' => '713.686.124-15',
                'neighborhood' => 'MUÇUMAGRO',
                'birth_date' => '1950-09-27',
                'family_members' => 4,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'MARIA DAS GRAÇAS SILVA',
                'document_number' => '919.832.317-20',
                'neighborhood' => 'PADRE ZÉ',
                'birth_date' => '1959-05-15',
                'family_members' => 5,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DAS GRAÇAS VIANA DA COSTA',
                'document_number' => '054.790.304-93',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1963-10-12',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DAS MERCÊS DE ARAUJO',
                'document_number' => '001.822.714-71',
                'neighborhood' => 'JAGUARIBE',
                'birth_date' => '1940-10-23',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DAS NEVES DA SILVA LIMA',
                'document_number' => '108.752.044-49',
                'neighborhood' => 'DAS INDUSTRIAS',
                'birth_date' => '1951-06-02',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DE FÁTIMA BISPO',
                'document_number' => '977.303.004-00',
                'neighborhood' => '13 DE MAIO',
                'birth_date' => '1961-01-23',
                'family_members' => 5,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DE FÁTIMA DA SILVA',
                'document_number' => '436.445.544-04',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1965-03-20',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DE FÁTIMA DE ARAÚJO COSTA',
                'document_number' => '567.784.304-00',
                'neighborhood' => 'CRISTO',
                'birth_date' => '1968-09-22',
                'family_members' => 3,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'MARIA DE FÁTIMA FIRMINO DOS SANTOS',
                'document_number' => '053.505.894-23',
                'neighborhood' => 'JAGUARIBE',
                'birth_date' => '1973-12-25',
                'family_members' => 9,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DE FÁTIMA NASCIMENTO DOS SANTOS',
                'document_number' => '414.468.364-87',
                'neighborhood' => 'CRUZ DAS ARMAS',
                'birth_date' => '1958-01-20',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DE FÁTIMA RODRIGUES RIBEIRO',
                'document_number' => '910.446.774-49',
                'neighborhood' => 'CRUZ DAS ARMAS',
                'birth_date' => '1953-07-30',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DE LOURDES DA CONCEIÇÃO',
                'document_number' => '503.340.454-87',
                'neighborhood' => 'TRINCHEIRAS',
                'birth_date' => '1961-01-10',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DO CARMO ALVES DA SILVA',
                'document_number' => '952.268.004-44',
                'neighborhood' => 'RENASCER',
                'birth_date' => '1967-02-02',
                'family_members' => 6,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DO CARMO DA SILVA',
                'document_number' => '036.329.014-14',
                'neighborhood' => 'SÃO RAFAEL',
                'birth_date' => '1945-05-03',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DO ROSARIO DA SILVA',
                'document_number' => '570.431.324-87',
                'neighborhood' => 'CRUZ DAS ARMAS',
                'birth_date' => '1938-01-03',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA DO SOCORRO VITALINO DA SILVA',
                'document_number' => '486.451.844-00',
                'neighborhood' => 'TRINCHEIRAS',
                'birth_date' => '1955-07-11',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA FERNANDES DE LIMA',
                'document_number' => '264.037.494-04',
                'neighborhood' => 'TREZE DE MAIO',
                'birth_date' => '1935-05-13',
                'family_members' => 5,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'MARIA FRANCISCA DA SILVA',
                'document_number' => '154.227.394-34',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1944-12-22',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA JOSÉ DA SILVA',
                'document_number' => '854.528.584-15',
                'neighborhood' => 'PADRE ZÉ',
                'birth_date' => '1965-03-20',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA JOSÉ ESTEVAM PEREIRA DE FRANÇA',
                'document_number' => '929.812.164-49',
                'neighborhood' => 'OITIZIRO',
                'birth_date' => '1950-03-18',
                'family_members' => 7,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA TOMAZ DA SILVA',
                'document_number' => '050.990.754-79',
                'neighborhood' => 'PADRE ZÉ',
                'birth_date' => '1965-03-20',
                'family_members' => 5,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARIA VENÂNCIO DOS SANTOS',
                'document_number' => '039.516.094-43',
                'neighborhood' => 'TRINCHEIRAS',
                'birth_date' => '1951-09-30',
                'family_members' => 6,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARILENE DE SANTANA MARQUES',
                'document_number' => '685.791.794-91',
                'neighborhood' => 'TREZE DE MAIO',
                'birth_date' => '1962-08-14',
                'family_members' => 7,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'MARINEIDE DE LUNA ARAUJO',
                'document_number' => '518.428.744-20',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1964-04-19',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARLEIDE GONÇALVES DOS SANTOS',
                'document_number' => '218.459.994-87',
                'neighborhood' => 'GRAMAME',
                'birth_date' => '1959-09-07',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARLENE LIMA E SILVA',
                'document_number' => '042.829.427-89',
                'neighborhood' => 'CRUZ DAS ARMAS',
                'birth_date' => '1953-01-29',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARLÍ DE LUNA ARAÚJO',
                'document_number' => '012.770.854-55',
                'neighborhood' => 'VARJÃO',
                'birth_date' => '1968-03-07',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MARLUCE DE LUNA ARAUJO',
                'document_number' => '022.327.834-30',
                'neighborhood' => 'VARJÃO',
                'birth_date' => '1967-01-29',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MIRIAM ESTEVAM DE MOARES',
                'document_number' => '674.675.394-87',
                'neighborhood' => 'GRAMAME',
                'birth_date' => '1964-12-17',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'MORGANA ALVES DE OLIVEIRA',
                'document_number' => '726.610.034-87',
                'neighborhood' => 'DOS ESTADOS',
                'birth_date' => '1968-04-16',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'NEUMA FERREIRA DE SANTANA',
                'document_number' => '060.407.264-31',
                'neighborhood' => 'TORRE',
                'birth_date' => '1976-12-02',
                'family_members' => 8,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'PALOMA GLEISE GONÇALVES DOS SANTOS',
                'document_number' => '703.873.674-46',
                'neighborhood' => 'GRAMAME',
                'birth_date' => '1995-05-03',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'PATRICIA DE LIMA FERREIRA DA SILVA',
                'document_number' => '073.704.594-97',
                'neighborhood' => 'PARATIBE',
                'birth_date' => '1986-05-12',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'PEDRO FERNANDES LAZARO',
                'document_number' => '218.736.234-53',
                'neighborhood' => 'TORRE',
                'birth_date' => '1950-06-03',
                'family_members' => 5,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'REGINALDO ALVES MARTINS',
                'document_number' => '696.204.904-87',
                'neighborhood' => 'JOSÉ AMERICO',
                'birth_date' => '1969-12-22',
                'family_members' => 5,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'ROSEMARY DA SILVA SANTOS',
                'document_number' => '048.726.874-18',
                'neighborhood' => 'PADRE ZÉ',
                'birth_date' => '1976-04-22',
                'family_members' => 6,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'SERGIO GONZAZA DE OLIVEIRA',
                'document_number' => '981.076.584-34',
                'neighborhood' => 'SANTA RITA',
                'birth_date' => '1975-12-29',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'SEVERINA CARNEIRO DO NASCIMENTO',
                'document_number' => '964.815.794-49',
                'neighborhood' => 'ALTO DO CÉU',
                'birth_date' => '1964-01-26',
                'family_members' => 4,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'SEVERINA CORREIA DE MELO',
                'document_number' => '737.958.017-53',
                'neighborhood' => 'MANGABEIRA',
                'birth_date' => '1949-05-17',
                'family_members' => 4,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'SEVERINA GOMES DA SILVA',
                'document_number' => '824.722.707-04',
                'neighborhood' => 'ALTO DO CÉU',
                'birth_date' => '1964-12-24',
                'family_members' => 3,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'SEVERINA PEREIRA DAS NEVES',
                'document_number' => '094.992.704-00',
                'neighborhood' => 'DOS IPÊS',
                'birth_date' => '1946-12-25',
                'family_members' => 4,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'SILENE CABRAL DA COSTA',
                'document_number' => '022.870.514-22',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1973-08-11',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'SILVANIA DA SILVA',
                'document_number' => '726.382.734-49',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1972-08-23',
                'family_members' => 5,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'SIMONE FELICIANO',
                'document_number' => '798.464.324-53',
                'neighborhood' => 'TRINCHEIRAS',
                'birth_date' => '1975-01-29',
                'family_members' => 5,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'TANIA MARIA BRITO DA SILVA',
                'document_number' => '504.125.904-68',
                'neighborhood' => 'TORRE',
                'birth_date' => '1966-03-09',
                'family_members' => 1,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'TELMA MARIA CHAVES DO BU',
                'document_number' => '373.938.634-72',
                'neighborhood' => 'PADRE ZÉ',
                'birth_date' => '1960-12-29',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'TEREZA GOMES DE ARAUJO',
                'document_number' => '312.929.684-00',
                'neighborhood' => 'TRINCHEIRAS',
                'birth_date' => '1952-02-28',
                'family_members' => 3,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'TEREZA MARCELINO DE LUNA',
                'document_number' => '031.476.584-06',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1942-06-21',
                'family_members' => 2,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'TEREZINHA FRANÇA DA SILVA',
                'document_number' => '203.207.444-34',
                'neighborhood' => 'TORRE',
                'birth_date' => '1942-05-03',
                'family_members' => 7,
                'receives_government_benefit' => false
            ],
            [
                'name' => 'TEREZINHA GOMES DA SILVA',
                'document_number' => '027.248.754-60',
                'neighborhood' => 'VARJÃO',
                'birth_date' => '1953-10-09',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'VALDEISA VIANA DIONIZIO',
                'document_number' => '078.137.444-89',
                'neighborhood' => 'DOS ESTADOS',
                'birth_date' => '1971-11-17',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'VANDA MARIA DA CONCEIÇÃO',
                'document_number' => '674.575.504-10',
                'neighborhood' => 'PADRE ZÉ',
                'birth_date' => '1962-02-20',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'VANISE FONTES',
                'document_number' => '873.288.604-72',
                'neighborhood' => 'VARJÃO',
                'birth_date' => '1957-08-11',
                'family_members' => 3,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ZILMA BATISTA MARCELINO',
                'document_number' => '031.476.804-10',
                'neighborhood' => 'MANDACARU',
                'birth_date' => '1965-06-13',
                'family_members' => 2,
                'receives_government_benefit' => true
            ],
            [
                'name' => 'ZULEIDE DA SILVA PESSOA',
                'document_number' => '731.948.324-68',
                'neighborhood' => 'TRINCHEIRAS',
                'birth_date' => '1970-06-26',
                'family_members' => 1,
                'receives_government_benefit' => true
            ]
        ];

        $this->command->info('Iniciando importação de participantes...');
        
        foreach ($participants as $index => $participantData) {
            try {
                // Verificar se o participante já existe pelo CPF
                $existingParticipant = Participant::where('document_number', $participantData['document_number'])->first();
                
                if ($existingParticipant) {
                    $this->command->warn("Participante {$participantData['name']} já existe (CPF: {$participantData['document_number']})");
                    continue;
                }

                // Criar o participante com os dados básicos
                Participant::create([
                    'name' => $participantData['name'],
                    'document_type' => 'CPF',
                    'document_number' => $participantData['document_number'],
                    'birth_date' => $participantData['birth_date'],
                    'address' => 'Endereço não informado',
                    'neighborhood' => $participantData['neighborhood'],
                    'city' => 'João Pessoa',
                    'state' => 'PB',
                    'zip_code' => '58000-000',
                    'family_members' => $participantData['family_members'],
                    'receives_government_benefit' => $participantData['receives_government_benefit'],
                    'government_benefit_type' => $participantData['receives_government_benefit'] ? 'Auxílio Brasil' : null,
                    'active' => true,
                    'registered_at' => now(),
                    'registered_by' => $defaultUser->id,
                ]);

                $this->command->info("✓ Participante criado: {$participantData['name']}");
                
            } catch (\Exception $e) {
                $this->command->error("Erro ao criar participante {$participantData['name']}: " . $e->getMessage());
            }
        }

        $totalParticipants = Participant::count();
        $this->command->info("✅ Importação concluída! Total de participantes: {$totalParticipants}");
    }
}
