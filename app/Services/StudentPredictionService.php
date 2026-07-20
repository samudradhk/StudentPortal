<?php

namespace App\Services;

use Phpml\ModelManager;

class StudentPredictionService
{
    private $model;

    public function __construct()
    {
        $manager = new ModelManager();
        $this->model = $manager->restoreFromFile(
            storage_path('app/train_model/student_prediction_model.phpml')
        );
    }

    public function predict(
        int $attendance, int $assignment, 
        int $mid_exam, int $final_exam
    ): bool{
        $prediction = $this->model->predict([
            $attendance, $assignment, $mid_exam, $final_exam
        ]);

        return (bool) $prediction;
    }
}
