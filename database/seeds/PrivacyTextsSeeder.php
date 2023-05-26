<?php

use Illuminate\Database\Seeder;

class PrivacyTextsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Provider::truncate();
        \App\Models\Texts::firstOrCreate([
            'provider_id' => 1,
            'first_title' => 'Type reis',
            'first_paragraph' => 'Wij willen graag een %type_reis% voor u reserveren. De aanbieders voor de reisdiensten zijn:',
            'second_title' => 'Aanbieder',
            'second_paragraph' => 'Op deze reis zijn de algemene voorwaarden van %agency% van toepassing. Daarnaast gelden de ANVR voorwaarden en de aanvullende algemene voorwaarden van Preisdaler.nl .',
            'third_title' => 'Gegevens',
            'third_paragraph' => 'Wij vragen van u diverse gegevens welke wij benodigd zijn voor het boeken van de reis. Deze gegevens bewaren wij zoals omschreven in onze Privacy Policy. Tevens houden wij u graag op de hoogte van aanbiedingen, informatie en relevante wijzigingen. Hiervoor vragen wij uw akkoord voor het aanmelden van de nieuwsbrief.',
            'epilogue' => 'Deze bijzondere persoonsgegevens worden automatisch 10 dagen na terugkomst van uw reis verwijderd uit ons systeem.</br>Meer informatie over de AVG is hier te vinden. (website Autoriteit Persoonsgegevens)'
        ]);
        \App\Models\Texts::firstOrCreate([
            'provider_id' => 2,
            'first_title' => 'Type reis',
            'first_paragraph' => ' Wij willen graag een %type_reis% voor u reserveren. Reisbureau Friesland is voor u de %location% zoals tussen haakjes vermeld bij keuze voor deze reis. De aanbieders voor de reisdiensten zijn:',
            'second_title' => 'Aanbieder',
            'second_paragraph' => 'Op deze reis zijn de algemene voorwaarden van %agency% van toepassing. Daarnaast gelden de ANVR voorwaarden en de aanvullende algemene voorwaarden van Reisbureau Friesland.',
            'third_title' => 'Gegevens',
            'third_paragraph' => 'Wij vragen van u diverse gegevens welke wij benodigd zijn voor het boeken van de reis. Deze gegevens bewaren wij zoals omschreven in onze Privacy Policy. Tevens houden wij u graag op de hoogte van aanbiedingen, informatie en relevante wijzigingen. Hiervoor vragen wij uw akkoord voor het aanmelden van de nieuwsbrief.',
            'epilogue' => 'Deze bijzondere persoonsgegevens worden automatisch 10 dagen na terugkomst van uw reis verwijderd uit ons systeem.</br>Meer informatie over de AVG is hier te vinden. (website Autoriteit Persoonsgegevens)'
        ]);
    }
}