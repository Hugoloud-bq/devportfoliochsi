<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProjectsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        return Project::where('user_id', $this->userId)->get();
    }

    public function headings(): array
    {
        return [
            'Название',
            'Предмет',
            'Описание',
            'GitHub',
            'ТЗ',
            'Отчёт',
            'Дневник',
            'Дата начала',
            'Дата сдачи',
            'Часов затрачено',
            'Создано',
        ];
    }

    public function map($project): array
    {
        return [
            $project->title,
            $project->subject,
            $project->description,
            $project->github_link,
            $project->tz_status ? '✅' : '❌',
            $project->report_status ? '✅' : '❌',
            $project->diary_status ? '✅' : '❌',
            $project->start_date,
            $project->end_date,
            $project->hours_spent,
            $project->created_at->format('d.m.Y'),
        ];
    }
}