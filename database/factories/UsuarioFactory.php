<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
        'apellido_nombre' => $this->faker->word,
        'nombre_usuario' => $this->faker->word,
        'mail' => $this->faker->word,
        'numero_cuit' => $this->faker->word,
        'codigo_reparticion' => $this->faker->word,
        'nombre_reparticion' => $this->faker->word,
        'codigo_sector_interno' => $this->faker->word,
        'cargo' => $this->faker->word
        ];
    }
}
