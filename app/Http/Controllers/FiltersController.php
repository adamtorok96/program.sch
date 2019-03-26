<?php

namespace App\Http\Controllers;


use App\Models\Circle;
use App\Models\Resort;
use App\Models\User;
use Auth;

class FiltersController extends Controller
{
    public function edit()
    {
        return view('filters.edit', [
            'resorts'           => Resort::orderBy('name')->get(),
            'resortlessCircles' => Circle::active()
                ->resortless()
                ->hasNewsletterMail()
                ->orderBy('name')
                ->get()
        ]);
    }

    public function enable()
    {
        Auth::user()->update([
            'filter' => true
        ]);

        return redirect()->route('profile.index');
    }

    public function disable()
    {
        Auth::user()->update([
            'filter' => false
        ]);

        return redirect()->route('profile.index');
    }

    public function toggleProgram(Circle $circle)
    {
        $user   = Auth::user();
        $enable = !$user->isProgramFilteredAt($circle);

        if( $user->hasFilterAt($circle) ) {
            $user->filters()->updateExistingPivot($circle->id, [
                'program' => $enable
            ]);
        }
        else if( $enable ) {
            $user->filters()->attach($circle->id, [
                'program' => $enable
            ]);
        }

        $this->clearEmptyFilters($user, $circle);

        return response()->json([
            'success' => true
        ]);
    }

    public function toggleNewsletter(Circle $circle)
    {
        $user   = Auth::user();
        $enable = !$user->isNewsletterFilteredAt($circle);

        if( $user->hasFilterAt($circle) ) {
            $user->filters()->updateExistingPivot($circle->id, [
                'newsletter' => $enable
            ]);
        }
        else if( $enable ) {
            $user->filters()->attach($circle->id, [
                'newsletter' => $enable
            ]);
        }

        $this->clearEmptyFilters($user, $circle);

        return response()->json([
            'success' => true
        ]);
    }

    private function clearEmptyFilters(User $user, Circle $circle) : void
    {
        $clear = $user
            ->filters()
            ->wherePivot('program', false)
            ->wherePivot('newsletter', false)
            ->where('id', $circle->id)
            ->exists();

        if( $clear ) {
            $user
                ->filters()
                ->detach($circle->id)
            ;
        }
    }
}