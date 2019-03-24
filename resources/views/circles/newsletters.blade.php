@extends('layouts.layout')

@section('title', 'Körök')
@section('subtitle', $circle->name . ' - Hírlevelek')
@section('icon', 'circle')

@section('content')
    @include('layouts.title-center')

    <div class="panel panel-default">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Hírlevél tárgya</th>
                {{--<th class="text-center">Dátum</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($newsletters as $newsletter)
                <tr>
                    <td>
                        <a href="{{ route('newsletterMails.show', ['newsletter' => $newsletter]) }}">
                            {{ $newsletter->subject }}
                        </a>
                    </td>
                    {{--<td class="text-center">--}}
                        {{--{{ $newsletter->sent_at->format('Y. m. d. H:i') }}--}}
                    {{--</td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $newsletters->links() }}
@endsection