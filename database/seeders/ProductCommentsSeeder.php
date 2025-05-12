<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some users for comments if they don't exist
        $user1 = User::firstOrCreate(
            ['email' => 'commenter1@example.com'],
            [
                'name' => 'Kovács János',
                'password' => bcrypt('password123'),
            ]
        );

        $user2 = User::firstOrCreate(
            ['email' => 'commenter2@example.com'],
            [
                'name' => 'Nagy Eszter',
                'password' => bcrypt('password123'),
            ]
        );

        // Comments for each product
        $comments = [
            // Product 1 - Tölgyfa Étkezőasztal
            [
                'product_id' => 1,
                'user_id' => $user1->id,
                'content' => 'Gyönyörű asztal, tökéletesen illik az étkezőnkbe. A fa mintázata egyedi és a kidolgozás kiváló minőségű. Nagyon elégedett vagyok a vásárlással!',
                'rating' => 9,
            ],
            [
                'product_id' => 1,
                'user_id' => $user2->id,
                'content' => 'Szép darab, de az összeszerelés kicsit nehézkes volt. A végeredmény azonban megérte a fáradságot. Stabil és elegáns.',
                'rating' => 8,
            ],

            // Product 2 - Bőr Kanapé
            [
                'product_id' => 2,
                'user_id' => $user1->id,
                'content' => 'Rendkívül kényelmes és elegáns kanapé. A bőr minősége kiváló, és a színe pontosan olyan, mint a képen. Vendégeink is mindig megdicsérik.',
                'rating' => 10,
            ],
            [
                'product_id' => 2,
                'user_id' => $user2->id,
                'content' => 'Nagyon elégedett vagyok a kanapéval. Kényelmes, strapabíró és könnyen tisztítható. Az egyetlen apró negatívum, hogy a szállítás kicsit késett.',
                'rating' => 9,
            ],

            // Product 3 - Skandináv Ruhásszekrény
            [
                'product_id' => 3,
                'user_id' => $user1->id,
                'content' => 'Tökéletes választás volt a hálószobánkba. Rengeteg tárolóhelyet biztosít, és a minimalista dizájn remekül illik a lakásunk stílusához.',
                'rating' => 9,
            ],
            [
                'product_id' => 3,
                'user_id' => $user2->id,
                'content' => 'Szép szekrény, de a csúszó ajtók néha beragadnak. Az összeszerelés sem volt egyszerű, de a végeredmény szép lett.',
                'rating' => 7,
            ],

            // Product 4 - Modern Íróasztal
            [
                'product_id' => 4,
                'user_id' => $user1->id,
                'content' => 'Kiváló minőségű íróasztal, tökéletes a home office munkához. A kábelrendező rendszer nagyon praktikus, és a felület valóban csökkenti a képernyő tükröződését.',
                'rating' => 9,
            ],
            [
                'product_id' => 4,
                'user_id' => $user2->id,
                'content' => 'Jó ár-érték arányú termék. Stabil, jól néz ki, és a fiókjai is tágasak. Ajánlom mindenkinek, aki otthoni irodát rendez be.',
                'rating' => 8,
            ],

            // Product 5 - Vintage Állólámpa
            [
                'product_id' => 5,
                'user_id' => $user1->id,
                'content' => 'Csodálatos darab, igazi szemet gyönyörködtető lakberendezési tárgy. A fénye kellemes, meleg hangulatot teremt a nappaliban.',
                'rating' => 10,
            ],
            [
                'product_id' => 5,
                'user_id' => $user2->id,
                'content' => 'Nagyon tetszik a lámpa dizájnja, tökéletesen illik a vintage stílusú nappalinkba. Az okosotthon kompatibilitás nagy előny!',
                'rating' => 9,
            ],

            // Product 6 - Antik Váza
            [
                'product_id' => 6,
                'user_id' => $user1->id,
                'content' => 'Gyönyörű darab, pontosan olyan, mint a leírásban. Valódi műalkotás, amely egyedi hangulatot ad a nappalinknak.',
                'rating' => 10,
            ],
            [
                'product_id' => 6,
                'user_id' => $user2->id,
                'content' => 'Elégedett vagyok a vázával, bár kicsit kisebb, mint amire számítottam. A kidolgozás és a részletek azonban lenyűgözőek.',
                'rating' => 8,
            ],

            // Product 7 - Bio Alma
            [
                'product_id' => 7,
                'user_id' => $user1->id,
                'content' => 'Fantasztikusan finom és ropogós almák! Látszik, hogy gondosan válogatták őket. Biztosan újra rendelek.',
                'rating' => 10,
            ],
            [
                'product_id' => 7,
                'user_id' => $user2->id,
                'content' => 'Nagyon ízletes és friss almák. Jó érzés, hogy vegyszermentes terméket fogyaszthatunk. A gyerekek is imádják!',
                'rating' => 9,
            ],

            // Product 8 - Prémium Banán
            [
                'product_id' => 8,
                'user_id' => $user1->id,
                'content' => 'Kiváló minőségű banánok, tökéletesen érettek és nagyon ízletesek. Smoothie-khoz és sütéshez is remek alapanyag.',
                'rating' => 9,
            ],
            [
                'product_id' => 8,
                'user_id' => $user2->id,
                'content' => 'Finom banánok, de néhány darab már túlérett volt a csomag alján. Ettől függetlenül jó ár-érték arányú termék.',
                'rating' => 8,
            ],

            // Product 9 - Egzotikus Mangó
            [
                'product_id' => 9,
                'user_id' => $user1->id,
                'content' => 'Életem legjobb mangója! Tökéletesen érett, édes és lédús. Már többször rendeltem, és mindig kiváló minőséget kaptam.',
                'rating' => 10,
            ],
            [
                'product_id' => 9,
                'user_id' => $user2->id,
                'content' => 'Nagyon finom, de az ára kicsit borsos. Különleges alkalmakra azonban tökéletes választás.',
                'rating' => 8,
            ],

            // Product 10 - Különleges Ananász
            [
                'product_id' => 10,
                'user_id' => $user1->id,
                'content' => 'Rendkívül édes és lédús ananász, sokkal jobb, mint amit a szupermarketekben lehet kapni. Megéri az árát!',
                'rating' => 10,
            ],
            [
                'product_id' => 10,
                'user_id' => $user2->id,
                'content' => 'Nagyon finom és friss ananász. Könnyű volt megtisztítani, és a családom imádta az ízét. Biztosan újra vásárolok.',
                'rating' => 9,
            ],

            // Product 11 - Prémium Avokádó
            [
                'product_id' => 11,
                'user_id' => $user1->id,
                'content' => 'Tökéletesen érett avokádók, krémes textúrával és gazdag ízzel. Guacamole készítéséhez ideális!',
                'rating' => 10,
            ],
            [
                'product_id' => 11,
                'user_id' => $user2->id,
                'content' => 'Jó minőségű avokádók, bár néhány darab még éretlen volt. Összességében elégedett vagyok, és újra rendelek majd.',
                'rating' => 8,
            ],

            // Product 12 - Egzotikus Sárkánygyümölcs
            [
                'product_id' => 12,
                'user_id' => $user1->id,
                'content' => 'Gyönyörű és ízletes gyümölcs! Nemcsak dekoratív, de nagyon finom is. Smoothie-khoz különösen ajánlom.',
                'rating' => 9,
            ],
            [
                'product_id' => 12,
                'user_id' => $user2->id,
                'content' => 'Érdekes és különleges gyümölcs, bár az íze enyhébb, mint amire számítottam. Mindenesetre örülök, hogy kipróbáltam.',
                'rating' => 8,
            ],
        ];

        // Delete existing comments
        Comment::truncate();

        // Insert new comments
        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
