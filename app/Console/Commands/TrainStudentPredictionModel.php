<?php

namespace App\Console\Commands;

use Faker\Factory;
use Illuminate\Console\Command;
use Phpml\Classification\Ensemble\RandomForest;
use Phpml\ModelManager;

class TrainStudentPredictionModel extends Command
{
    protected $signature = 'student-prediction:train';
    protected $description = 'Training prediction model';

    public function handle()
    {
        $attributes = [];
        $labels = [];

        $faker = Factory::create();

        for($i=0; $i<200; $i++){
            $attendance = $faker->numberBetween(40, 100);
            $assignment = $faker->numberBetween(40, 100);
            $mid_exam = $faker->numberBetween(40, 100);
            $final_exam = $faker->numberBetween(40, 100);

            $avg = ($assignment + $mid_exam + $final_exam) / 3;
            $label = $avg < 75 || $attendance < 85;

            $attributes[] = [
                $attendance, $assignment, $mid_exam, $final_exam
            ];
            $labels[] = $label ? 1 : 0;
        }

        $classifier = new RandomForest(10);
        $classifier->train($attributes, $labels);

        $manager = new ModelManager();
        $manager->saveToFile(
            $classifier,
            storage_path('app/train_model/student_prediction_model.phpml')
        );

        $this->info('training success');
    }
}
