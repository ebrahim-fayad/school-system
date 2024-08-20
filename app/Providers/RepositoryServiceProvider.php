<?php

namespace App\Providers;

use App\Interface\Fees\FeesInvoicesRepositoryInterface;
use App\Interface\Fees\FeesRepositoryInterface;
use App\Interface\PaymentStudents\PaymentStudentRepositoryInterface;
use App\Interface\ProcessingFees\ProcessingFeesRepositoryInterface;
use App\Interface\Receipts\ReceiptStudentRepositoryInterface;
use App\Interface\Students\StudentGraduationRepositoryInterface;
use App\Interface\Students\StudentPromotionRepositoryInterface;
use App\Interface\Students\StudentRepositoryInterface;
use App\Interface\Teachers\TeacherRepositoryInterface;
use App\Repository\Fees\FeesInvoicesRepository;
use App\Repository\Fees\FeesRepository;
use App\Repository\PaymentStudents\PaymentStudentRepository;
use App\Repository\ProcessingFees\ProcessingFeesRepository;
use App\Repository\Receipts\ReceiptStudentRepository;
use App\Repository\Students\StudentGraduationRepository;
use App\Repository\Students\StudentPromotionRepository;
use App\Repository\Students\StudentRepository;
use App\Repository\Teachers\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(StudentPromotionRepositoryInterface::class, StudentPromotionRepository::class);
        $this->app->bind(StudentGraduationRepositoryInterface::class, StudentGraduationRepository::class);
        $this->app->bind(FeesRepositoryInterface::class, FeesRepository::class);
        $this->app->bind(FeesInvoicesRepositoryInterface::class, FeesInvoicesRepository::class);
        $this->app->bind(ReceiptStudentRepositoryInterface::class, ReceiptStudentRepository::class);
        $this->app->bind(ProcessingFeesRepositoryInterface::class, ProcessingFeesRepository::class);
        $this->app->bind(PaymentStudentRepositoryInterface::class, PaymentStudentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
