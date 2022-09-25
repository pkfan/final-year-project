<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    private $cities = [
        // =========== Balochistan ==================
        "Balochistan" => [
            'Quetta','Khuzdar','Turbat','Chaman','Hub'	,
            'Sibi','Zhob','Gwadar','Dera Murad Jamali'	,
            'Dera Allah Yar','Usta Mohammad','Loralai',
            'Pasni','Kharan','Mastung','Nushki','Kalat'
        ],
        // ============ Khyber Pakhtunkhwa =============

        "Khyber Pakhtunkhwa" => [
            'Abbottabad','Adezai','Alpuri', 'Akora Khattak', 'Ayubia', 'Banda Daud Shah',
            'Bannu','Batkhela', 'Battagram','Birote', 'Chakdara', 'Charsadda','Chitral',
            'Daggar','Dargai','Darya Khan','Dera Ismail Khan','Doaba','Dir',
            'Drosh','Hangu','Haripur','Karak','Kohat','Kulachi','Lakki Marwat','Latamber',
            'Madyan', 'Mansehra','Mardan','Mastuj','Mingora','Nowshera',
        ],
        // ========== Punjab =========
        "Punjab" => [
            'Ahmadpur East',' Ahmed Nager Chatha', 'Ali Khan Abad', 'Alipur','Arifwala',
            'Attock','Bhera','Bhalwal','Bahawalnagar', 'Bahawalpur','Bhakkar','Burewala','Chillianwala','Chakwal','Chichawatni', 'Chiniot',
            'Chishtian','Daska','Darya Khan','Dera Ghazi Khan','Dhaular','Dina','Dinga','Dipalpur','Faisalabad',
        ],

        // ============ Sindh =============
        "Sindh" => [
            'Badin','Bhirkan','Rajo Khanani','Chak','Dadu','Digri','Diplo','Dokri','Ghotki',
            'Haala','Hyderabad','Islamkot','Jacobabad','Jamshoro','Jungshahi','Kandhkot','Kandiaro',
        ],
    ];


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $pics_index = mt_rand(1,15);

        $state = $this->faker->randomElement(["Balochistan","Khyber Pakhtunkhwa","Punjab","Sindh"]);
        $city = $this->faker->randomElement($this->cities[$state]);
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'state' => $state,
            'city' => $city,
            'description' => $this->faker->text(250),
            'shop_image' => "FakeImages/shop/{$pics_index}.webp",
            'created_at' => $this->faker->dateTimeBetween('-19 days', '-5 days'),
            'updated_at' => $this->faker->dateTimeBetween('-5 days', '-1 minute')
        ];
    }
}
