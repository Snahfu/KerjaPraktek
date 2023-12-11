<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'qty' => $this->faker->randomNumber($nbDigits = 2, $strict = false),
          'satuan' => $this->faker->randomElement($array = array ('unit','set')),
          'tanggalBeli' => $this->faker->dateTime(),
          'hargaBeli' => $this->faker->numberBetween($min = 10000, $max = 1000000),
          'jenis_barang_idjenis_barang' => $this->faker->numberBetween($min = 1, $max = 42),
        ];
    }
}
