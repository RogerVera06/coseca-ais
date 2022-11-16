<?php
declare(strict_types=1);

namespace App\Stage;

use App\Model\Entity\Student;
use App\Model\Entity\StudentStage;
use App\Model\Field\StageField;

interface StageInterface
{
    /**
     * @param StudentStage $studentStage
     */
    public function __construct(StudentStage $studentStage);

    /**
     * @return StageField
     */
    public function getStageField(): StageField;

    /**
     * @return integer
     */
    public function getStudentId(): int;

    /**
     * @param boolean $reset
     * @return Student|null
     */
    public function getStudent(bool $reset = false): ?Student;

    /**
     * @param boolean $reset
     * @return StudentStage|null
     */
    public function getStudentStage(bool $reset = false): ?StudentStage;

    /**
     * @return string
     */
    public function getLastError(): string;

    /**
     * @param string $error
     * @return void
     */
    public function setLastError(string $error);

    /**
     * @return StageField
     */
    public function getNextStageField(): StageField;

    /**
     * @return void
     */
    public function initialize(): void;

    /**
     * @param string $status
     * @return void
     */
    public function close(string $status);    
}
