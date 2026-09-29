<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    public function run(): void
    {
        $biologia = Subject::where('slug', 'biologia')->first();
        $espanol = Subject::where('slug', 'espanol')->first();
        $geografia = Subject::where('slug', 'geografia')->first();

        $exercises = [
            // ===== BIOLOGÍA =====
            [
                'subject' => $biologia,
                'title' => 'Los mamíferos',
                'question' => '¿Cuál de estos animales es un mamífero?',
                'instructions' => 'Elige la respuesta correcta.',
                'options' => [
                    ['text' => 'Pez', 'correct' => false],
                    ['text' => 'Perro', 'correct' => true],
                    ['text' => 'Rana', 'correct' => false],
                    ['text' => 'Águila', 'correct' => false],
                ],
            ],
            [
                'subject' => $biologia,
                'title' => 'Las plantas',
                'question' => '¿Qué necesitan las plantas para hacer fotosíntesis?',
                'instructions' => 'Piensa en lo que las plantas toman del ambiente.',
                'options' => [
                    ['text' => 'Luz solar, agua y dióxido de carbono', 'correct' => true],
                    ['text' => 'Solo tierra', 'correct' => false],
                    ['text' => 'Solo agua', 'correct' => false],
                    ['text' => 'Oscuridad y viento', 'correct' => false],
                ],
            ],
            [
                'subject' => $biologia,
                'title' => 'El cuerpo humano',
                'question' => '¿Cuál es el órgano que bombea la sangre?',
                'instructions' => 'Está en el pecho.',
                'options' => [
                    ['text' => 'Pulmón', 'correct' => false],
                    ['text' => 'Corazón', 'correct' => true],
                    ['text' => 'Estómago', 'correct' => false],
                    ['text' => 'Cerebro', 'correct' => false],
                ],
            ],
            [
                'subject' => $biologia,
                'title' => 'Los sentidos',
                'question' => '¿Con qué órgano escuchamos?',
                'instructions' => 'Piensa en los cinco sentidos.',
                'options' => [
                    ['text' => 'Ojos', 'correct' => false],
                    ['text' => 'Nariz', 'correct' => false],
                    ['text' => 'Oídos', 'correct' => true],
                    ['text' => 'Lengua', 'correct' => false],
                ],
            ],
            [
                'subject' => $biologia,
                'title' => 'Hábitats',
                'question' => '¿Dónde vive un pez?',
                'instructions' => 'Piensa en su ambiente natural.',
                'options' => [
                    ['text' => 'En el desierto', 'correct' => false],
                    ['text' => 'En el agua', 'correct' => true],
                    ['text' => 'En los árboles', 'correct' => false],
                    ['text' => 'En cuevas', 'correct' => false],
                ],
            ],
            [
                'subject' => $biologia,
                'title' => 'Alimentación',
                'question' => '¿Cuál de estos es una fruta?',
                'instructions' => 'Elige el alimento que crece en un árbol.',
                'options' => [
                    ['text' => 'Zanahoria', 'correct' => false],
                    ['text' => 'Manzana', 'correct' => true],
                    ['text' => 'Lechuga', 'correct' => false],
                    ['text' => 'Papa', 'correct' => false],
                ],
            ],
            [
                'subject' => $biologia,
                'title' => 'Seres vivos',
                'question' => '¿Cuál de estos NO es un ser vivo?',
                'instructions' => 'Piensa en qué tiene vida.',
                'options' => [
                    ['text' => 'Árbol', 'correct' => false],
                    ['text' => 'Perro', 'correct' => false],
                    ['text' => 'Piedra', 'correct' => true],
                    ['text' => 'Mariposa', 'correct' => false],
                ],
            ],
            [
                'subject' => $biologia,
                'title' => 'Animales salvajes',
                'question' => '¿Cuál de estos animales vive en la selva?',
                'instructions' => 'Piensa en animales de climas cálidos.',
                'options' => [
                    ['text' => 'Oso polar', 'correct' => false],
                    ['text' => 'Tigre', 'correct' => true],
                    ['text' => 'Pingüino', 'correct' => false],
                    ['text' => 'Foca', 'correct' => false],
                ],
            ],
            [
                'subject' => $biologia,
                'title' => 'Medio ambiente',
                'question' => '¿Qué debemos hacer con la basura?',
                'instructions' => 'Piensa en cuidar el planeta.',
                'options' => [
                    ['text' => 'Tirarla al suelo', 'correct' => false],
                    ['text' => 'Reciclarla', 'correct' => true],
                    ['text' => 'Quemarla', 'correct' => false],
                    ['text' => 'Enterrarla', 'correct' => false],
                ],
            ],
            [
                'subject' => $biologia,
                'title' => 'Las aves',
                'question' => '¿Qué tienen las aves que las hace diferentes?',
                'instructions' => 'Piensa en su cuerpo.',
                'options' => [
                    ['text' => 'Plumas', 'correct' => true],
                    ['text' => 'Escamas', 'correct' => false],
                    ['text' => 'Pelaje', 'correct' => false],
                    ['text' => 'Caparazón', 'correct' => false],
                ],
            ],

            // ===== ESPAÑOL =====
            [
                'subject' => $espanol,
                'title' => 'Las vocales',
                'question' => '¿Cuántas vocales hay en español?',
                'instructions' => 'Cuenta con los dedos.',
                'options' => [
                    ['text' => '3', 'correct' => false],
                    ['text' => '4', 'correct' => false],
                    ['text' => '5', 'correct' => true],
                    ['text' => '6', 'correct' => false],
                ],
            ],
            [
                'subject' => $espanol,
                'title' => 'El abecedario',
                'question' => '¿Con qué letra empieza la palabra "casa"?',
                'instructions' => 'Escucha el primer sonido.',
                'options' => [
                    ['text' => 'A', 'correct' => false],
                    ['text' => 'C', 'correct' => true],
                    ['text' => 'S', 'correct' => false],
                    ['text' => 'K', 'correct' => false],
                ],
            ],
            [
                'subject' => $espanol,
                'title' => 'Las sílabas',
                'question' => '¿Cuántas sílabas tiene la palabra "pelota"?',
                'instructions' => 'Aplaude cada sílaba.',
                'options' => [
                    ['text' => '1', 'correct' => false],
                    ['text' => '2', 'correct' => false],
                    ['text' => '3', 'correct' => true],
                    ['text' => '4', 'correct' => false],
                ],
            ],
            [
                'subject' => $espanol,
                'title' => 'Los sustantivos',
                'question' => '¿Cuál de estas palabras es un sustantivo?',
                'instructions' => 'El sustantivo nombra personas, animales o cosas.',
                'options' => [
                    ['text' => 'Correr', 'correct' => false],
                    ['text' => 'Perro', 'correct' => true],
                    ['text' => 'Rápido', 'correct' => false],
                    ['text' => 'Saltar', 'correct' => false],
                ],
            ],
            [
                'subject' => $espanol,
                'title' => 'Los adjetivos',
                'question' => '¿Cuál de estas palabras es un adjetivo?',
                'instructions' => 'El adjetivo describe cómo es algo.',
                'options' => [
                    ['text' => 'Grande', 'correct' => true],
                    ['text' => 'Mesa', 'correct' => false],
                    ['text' => 'Cantar', 'correct' => false],
                    ['text' => 'Niño', 'correct' => false],
                ],
            ],
            [
                'subject' => $espanol,
                'title' => 'Sinónimos',
                'question' => '¿Cuál es un sinónimo de "feliz"?',
                'instructions' => 'Sinónimo significa que significa lo mismo.',
                'options' => [
                    ['text' => 'Triste', 'correct' => false],
                    ['text' => 'Contento', 'correct' => true],
                    ['text' => 'Enojado', 'correct' => false],
                    ['text' => 'Cansado', 'correct' => false],
                ],
            ],
            [
                'subject' => $espanol,
                'title' => 'Antónimos',
                'question' => '¿Cuál es el antónimo de "grande"?',
                'instructions' => 'Antónimo significa lo contrario.',
                'options' => [
                    ['text' => 'Enorme', 'correct' => false],
                    ['text' => 'Pequeño', 'correct' => true],
                    ['text' => 'Alto', 'correct' => false],
                    ['text' => 'Ancho', 'correct' => false],
                ],
            ],
            [
                'subject' => $espanol,
                'title' => 'Comprensión lectora',
                'question' => 'Ana tiene un gato negro. ¿De qué color es el gato?',
                'instructions' => 'Lee con atención.',
                'options' => [
                    ['text' => 'Blanco', 'correct' => false],
                    ['text' => 'Negro', 'correct' => true],
                    ['text' => 'Gris', 'correct' => false],
                    ['text' => 'Naranja', 'correct' => false],
                ],
            ],
            [
                'subject' => $espanol,
                'title' => 'Construcción de oraciones',
                'question' => '¿Cuál oración está bien escrita?',
                'instructions' => 'Piensa en mayúscula inicial y punto final.',
                'options' => [
                    ['text' => 'el perro corre', 'correct' => false],
                    ['text' => 'El perro corre.', 'correct' => true],
                    ['text' => 'EL PERRO CORRE', 'correct' => false],
                    ['text' => 'perro el corre', 'correct' => false],
                ],
            ],
            [
                'subject' => $espanol,
                'title' => 'Palabras',
                'question' => '¿Cuál de estas palabras está bien escrita?',
                'instructions' => 'Piensa en la ortografía.',
                'options' => [
                    ['text' => 'Baca', 'correct' => false],
                    ['text' => 'Vaca', 'correct' => true],
                    ['text' => 'Bacca', 'correct' => false],
                    ['text' => 'Vacca', 'correct' => false],
                ],
            ],

            // ===== GEOGRAFÍA =====
            [
                'subject' => $geografia,
                'title' => 'El planeta Tierra',
                'question' => '¿Qué forma tiene la Tierra?',
                'instructions' => 'Piensa en el globo terráqueo.',
                'options' => [
                    ['text' => 'Cuadrada', 'correct' => false],
                    ['text' => 'Redonda', 'correct' => true],
                    ['text' => 'Triangular', 'correct' => false],
                    ['text' => 'Plana', 'correct' => false],
                ],
            ],
            [
                'subject' => $geografia,
                'title' => 'Los continentes',
                'question' => '¿Cuántos continentes hay?',
                'instructions' => 'Cuenta los grandes bloques de tierra.',
                'options' => [
                    ['text' => '3', 'correct' => false],
                    ['text' => '5', 'correct' => false],
                    ['text' => '7', 'correct' => true],
                    ['text' => '10', 'correct' => false],
                ],
            ],
            [
                'subject' => $geografia,
                'title' => 'Los océanos',
                'question' => '¿Cuál es el océano más grande?',
                'instructions' => 'Piensa en el que está entre América y Asia.',
                'options' => [
                    ['text' => 'Atlántico', 'correct' => false],
                    ['text' => 'Pacífico', 'correct' => true],
                    ['text' => 'Índico', 'correct' => false],
                    ['text' => 'Ártico', 'correct' => false],
                ],
            ],
            [
                'subject' => $geografia,
                'title' => 'México',
                'question' => '¿Cuál es la capital de México?',
                'instructions' => 'Es una ciudad muy grande.',
                'options' => [
                    ['text' => 'Guadalajara', 'correct' => false],
                    ['text' => 'Monterrey', 'correct' => false],
                    ['text' => 'Ciudad de México', 'correct' => true],
                    ['text' => 'Puebla', 'correct' => false],
                ],
            ],
            [
                'subject' => $geografia,
                'title' => 'Los estados',
                'question' => '¿Cuántos estados tiene México?',
                'instructions' => 'Piensa en el mapa de México.',
                'options' => [
                    ['text' => '15', 'correct' => false],
                    ['text' => '25', 'correct' => false],
                    ['text' => '32', 'correct' => true],
                    ['text' => '50', 'correct' => false],
                ],
            ],
            [
                'subject' => $geografia,
                'title' => 'Los mapas',
                'question' => '¿Para qué sirve un mapa?',
                'instructions' => 'Piensa en para qué lo usamos.',
                'options' => [
                    ['text' => 'Para cocinar', 'correct' => false],
                    ['text' => 'Para ubicarnos', 'correct' => true],
                    ['text' => 'Para dormir', 'correct' => false],
                    ['text' => 'Para pintar', 'correct' => false],
                ],
            ],
            [
                'subject' => $geografia,
                'title' => 'Puntos cardinales',
                'question' => '¿Cuáles son los puntos cardinales?',
                'instructions' => 'Piensa en la brújula.',
                'options' => [
                    ['text' => 'Norte, Sur, Este, Oeste', 'correct' => true],
                    ['text' => 'Arriba, Abajo', 'correct' => false],
                    ['text' => 'Izquierda, Derecha', 'correct' => false],
                    ['text' => 'Rojo, Azul, Verde', 'correct' => false],
                ],
            ],
            [
                'subject' => $geografia,
                'title' => 'Paisajes',
                'question' => '¿Qué encontramos en una playa?',
                'instructions' => 'Piensa en el mar.',
                'options' => [
                    ['text' => 'Arena y mar', 'correct' => true],
                    ['text' => 'Nieve', 'correct' => false],
                    ['text' => 'Selva', 'correct' => false],
                    ['text' => 'Desierto', 'correct' => false],
                ],
            ],
            [
                'subject' => $geografia,
                'title' => 'Países',
                'question' => '¿Cuál de estos es un país?',
                'instructions' => 'Piensa en naciones del mundo.',
                'options' => [
                    ['text' => 'Guadalajara', 'correct' => false],
                    ['text' => 'Francia', 'correct' => true],
                    ['text' => 'Amazonas', 'correct' => false],
                    ['text' => 'Los Andes', 'correct' => false],
                ],
            ],
            [
                'subject' => $geografia,
                'title' => 'Regiones',
                'question' => '¿Dónde hace más frío?',
                'instructions' => 'Piensa en los polos.',
                'options' => [
                    ['text' => 'En el ecuador', 'correct' => false],
                    ['text' => 'En los polos', 'correct' => true],
                    ['text' => 'En la playa', 'correct' => false],
                    ['text' => 'En el desierto', 'correct' => false],
                ],
            ],
        ];

        foreach ($exercises as $index => $data) {
            $exercise = Exercise::create([
                'subject_id' => $data['subject']->id,
                'title' => $data['title'],
                'question' => $data['question'],
                'instructions' => $data['instructions'],
                'type' => 'multiple_choice',
                'difficulty' => 'easy',
                'points_reward' => 10,
                'order' => $index + 1,
                'is_active' => true,
            ]);

            foreach ($data['options'] as $optIndex => $option) {
                $exercise->options()->create([
                    'option_text' => $option['text'],
                    'is_correct' => $option['correct'],
                    'order' => $optIndex + 1,
                ]);
            }
        }
    }
}
