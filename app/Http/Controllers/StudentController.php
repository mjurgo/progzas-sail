<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(private readonly UserRepositoryInterface $repository) {}

    public function index(): View
    {
        return View('students.index', [
            'students' => $this->repository->getStudents(),
        ]);
    }

    public function show(int $id): View
    {
        return View('students.show', [
            'student' => $this->repository->getStudentById($id),
            'subjects' => Subject::all(),
        ]);
    }

    public function addGrade(int $id, StoreGradeRequest $request): View
    {
        Gate::authorize('teacher-level');

        $validated = $request->validated();

        Grade::create([
            'value' => $validated['value'],
            'comment' => $validated['comment'],
            'subject_id' => $validated['subject_id'],
            'user_id' => $id,
            'teacher_id' => Auth::id(),
            'identifier' => Str::uuid(),
        ]);

        return View('students.show', [
            'student' => $this->repository->getStudentById($id),
            'subjects' => Subject::all(),
        ]);
    }

    public function deleteGrade(int $id, Request $request): View
    {
        Gate::authorize('teacher-level');

        $grade = Grade::findOrFail($request->get('gradeId'));
        $grades = Grade::where('identifier', $grade->identifier)->get();

        Gate::allowIf($grade->teacher_id === Auth::id() || Auth::user()->isAdmin());

        foreach ($grades as $grade) {
            $grade->delete();
        }

        return View('students.show', [
            'student' => $this->repository->getStudentById($id),
            'subjects' => Subject::all(),
        ]);
    }
}
