<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Tölgyfa Étkezőasztal',
                'description' => 'Ez a kézzel készített tölgyfa étkezőasztal tökéletes választás a modern és klasszikus otthonokba egyaránt. Masszív szerkezetének köszönhetően generációkon át szolgálhatja családját.',
                'price' => 139900,
                'image' => 'bigyo1.png',
                'rating' => 8.3,
                'rating_count' => 2,
                'category_id' => 1, // Bútor
                'subcategory_id' => 1, // Étkezőasztal
            ],
            [
                'name' => 'Bőr Kanapé',
                'description' => 'Luxus bőr kanapé, amely tökéletes kényelmet biztosít. Kiváló minőségű anyagokból készült, tartós és elegáns.',
                'price' => 438900,
                'image' => 'bigyo2.png',
                'rating' => 9.1,
                'rating_count' => 3,
                'category_id' => 1, // Bútor
                'subcategory_id' => 2, // Ülőgarnitúra
            ],
            [
                'name' => 'Skandináv Ruhásszekrény',
                'description' => 'Ez a skandináv stílusú ruhásszekrény tökéletes egyensúlyt teremt a funkcionalitás és az esztétika között. A minimalista dizájn és a világos színek tágasabbá teszik a teret, míg a praktikus belső elrendezés maximális tárolóhelyet biztosít. A szekrény nyírfából készült, amely természetes szépséget és tartósságot kölcsönöz. A csúszó ajtók puhán és csendesen működnek, a belső polcok állítható magasságúak, így személyre szabhatja a tárolóteret. A szekrény alján található fiók tökéletes a kisebb ruhadarabok tárolására. A matt felület könnyen tisztítható és ellenáll a karcolásoknak. Ez a szekrény nemcsak tárolóhely, hanem stílusos kiegészítője is otthonának.',
                'price' => 87900,
                'image' => 'bigyo3.png',
                'rating' => 8.7,
                'rating_count' => 5,
                'category_id' => 1, // Bútor
                'subcategory_id' => 3, // Szekrény
            ],
            [
                'name' => 'Modern Íróasztal',
                'description' => 'Ez a modern íróasztal tökéletes választás otthoni irodájába vagy dolgozósarkába. Az ergonomikus kialakítás hosszú órákon át kényelmes munkavégzést biztosít. A minimalista dizájn bármilyen belső térhez illeszkedik, míg a praktikus tárolórekeszek segítenek rendben tartani a munkaterületet. Az asztal felülete speciális, matt bevonattal rendelkezik, amely csökkenti a képernyő tükröződését és a szemfáradtságot. A beépített kábelrendező rendszer segít elkerülni a kábelrengeteg kialakulását. Az asztal lábai állítható magasságúak, így tökéletesen személyre szabható. A kiváló minőségű anyagok és a gondos kivitelezés hosszú élettartamot biztosítanak ennek a praktikus és stílusos bútordarabnak.',
                'price' => 134900,
                'image' => 'bigyo4.png',
                'rating' => 7.9,
                'rating_count' => 4,
                'category_id' => 1, // Bútor
                'subcategory_id' => 6, // Íróasztal
            ],
            [
                'name' => 'Vintage Állólámpa',
                'description' => 'Ez a vintage stílusú állólámpa tökéletes kiegészítője lehet bármely nappalinak vagy olvasósaroknak. Az ipari dizájn elemeit ötvözi a klasszikus formákkal, így egyedi hangulatot teremt otthonában. A lámpa teste kézzel megmunkált fémből készült, antikolt réz bevonattal, amely időtálló megjelenést biztosít. A lámpaernyő kézzel készített, természetes lenvászonból, amely kellemes, meleg fényt szór a helyiségben. A lámpa magassága állítható, így tökéletesen igazítható az Ön igényeihez. A talpazat nehéz öntöttvasból készült, amely stabil állást biztosít. A lámpa kompatibilis az okosotthon rendszerekkel, és távirányítóval is vezérelhető. Ez a darab nemcsak világítótest, hanem művészi értékű lakberendezési tárgy is.',
                'price' => 109000,
                'image' => 'bigyo5.png',
                'rating' => 8.5,
                'rating_count' => 3,
                'category_id' => 1, // Bútor
                'subcategory_id' => 7, // Lámpa
            ],
            [
                'name' => 'Antik Váza',
                'description' => 'Ez az antik váza egy igazi műremek, amely tökéletesen ötvözi a funkcionalitást és az esztétikát. A 19. század közepén készült, kézzel festett motívumokkal díszített kerámia váza nemcsak dekorációs elemként szolgál, hanem egy darab történelmet is hoz otthonába. A váza kiváló állapotban maradt fenn, apró kopásnyomokkal, amelyek csak növelik autentikus jellegét. Tökéletes választás gyűjtőknek vagy azoknak, akik egyedi, történelmi értékkel bíró darabokkal szeretnék gazdagítani otthonukat.',
                'price' => 32900,
                'image' => 'bigyo6.png',
                'rating' => 9.3,
                'rating_count' => 7,
                'category_id' => 6, // Dekoráció
                'subcategory_id' => 19, // Váza
            ],
            [
                'name' => 'Bio Alma',
                'description' => 'A bio alma egy különleges, vegyszermentes termesztésű gyümölcs, amely tele van vitaminokkal és ásványi anyagokkal. Ez a fajta alma a Jonagold fajtához tartozik, amely édes-savanykás ízével és ropogós húsával tűnik ki. A gyümölcsöt kézi szedéssel takarítják be, hogy elkerüljék a sérüléseket, és gondosan válogatják, hogy csak a legjobb minőségű termékek kerüljenek a vásárlókhoz. Fogyasztható nyersen, de kiváló alapanyag süteményekhez, kompótokhoz vagy akár smoothie-khoz is. A bio termesztésnek köszönhetően nem tartalmaz káros vegyszermaradványokat, így biztonságosan fogyasztható az egész család számára.',
                'price' => 200,
                'image' => 'bigyo7.png',
                'rating' => 8.8,
                'rating_count' => 6,
                'category_id' => 7, // Élelmiszer
                'subcategory_id' => 20, // Gyümölcs
            ],
            [
                'name' => 'Súlyozott Házastárs Téglatest',
                'description' => 'Kényelmes, king size franciaágy memóriahabos matraccal és elegáns fejvéggel.',
                'price' => 67900,
                'image' => 'bigyo8.png',
                'rating' => 9.0,
                'rating_count' => 4,
                'category_id' => 6, // Dekoráció
                'subcategory_id' => 2, // Ülőgarnitúra
            ],
            [
                'name' => 'Antióchiai Szent Kézigránát',
                'description' => 'A legújabb technológiával felszerelt okostelefon, kiváló kamerával és hosszú akkumulátor-élettartammal.',
                'price' => 549900,
                'image' => 'bigyo9.png',
                'rating' => 9.2,
                'rating_count' => 8,
                'category_id' => 4, // Sport és szabadidő
                'subcategory_id' => 18, // Kézigránát
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
