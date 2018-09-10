<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProgram;
use App\Http\Requests\Admin\UpdateProgram;
use App\Managers\ProgramsManager;
use App\Models\Circle;
use App\Models\Location;
use App\Models\Program;
use App\Models\Resort;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function index()
    {
        return view('admin.programs.index');
    }

    public function create()
    {
        return view('admin.programs.create', [
            'resorts'   => Resort::orderBy('name')->get(),
            'locations' => Location::all()
        ]);
    }

    public function store(StoreProgram $request, ProgramsManager $programsManager)
    {
        $program = $programsManager
            ->setCircle(Circle::firstOrFail($request->circle))
            ->createFromRequest($request)
        ;

        return redirect()->route('admin.programs.show', [
           'program' => $program
        ]);
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', [
            'program'       => $program,
            'resorts'       => Resort::orderBy('name')->get(),
            'locations'     => Location::all()
        ]);
    }

    public function update(UpdateProgram $request, Program $program, ProgramsManager $programsManager)
    {
        $this->checkboxFix($request);

        $programsManager
            ->setCircle(Circle::firstOrFail($request->circle))
            ->updateFromRequest($request)
        ;

        return redirect()->route('admin.programs.show', [
            'program' => $program
        ]);
    }

    public function show(Program $program)
    {
        return view('admin.programs.show', [
            'program' => $program
        ]);
    }

    /**
     * @param Program $program
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index');
    }

    private function checkboxFix(Request $request)
    {
        $inputs = [
            'display_email',
            'display_poster'
        ];

        foreach ($inputs as $input) {
            if( !$request->has($input) || ($request->has($input) && $request->get($input) === null) )
                $request->merge([$input => false]);
        }
    }
}