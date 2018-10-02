<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreProgram;
use App\Http\Requests\UpdateProgram;
use App\Managers\ProgramsManager;
use App\Models\Circle;
use App\Models\Location;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function info()
    {
        return view('programs.info');
    }

    public function create(Circle $circle)
    {
        return view('programs.create', [
            'circle'    => $circle,
            'locations' => Location::all()
        ]);
    }

    public function store(StoreProgram $request, Circle $circle, ProgramsManager $programsManager)
    {
        $program = $programsManager
            ->setCircle($circle)
            ->create($request)
        ;

        return redirect()->route('programs.show', [
            'program' => $program
        ]);
    }

    public function edit(Program $program)
    {
        return view('programs.edit', [
            'program'   => $program,
            'locations' => Location::all()
        ]);
    }

    public function update(UpdateProgram $request, Program $program, ProgramsManager $programsManager)
    {
        $this->checkboxFix($request);

        $programsManager
            ->setProgram($program)
            ->update($request)
        ;

        return redirect()->route('programs.show', [
            'program' => $program
        ]);
    }

    public function show(Program $program)
    {
        return view('programs.show', [
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

        return redirect()->route('index');
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