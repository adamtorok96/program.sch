@extends('layouts.layout')

@section('title', 'Hírlevelek')
@section('subtitle', 'Beérkezők')
@section('icon', 'inbox')

@section('content')
    @include('layouts.title-center')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Beérkező hírlevelek</h3>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tárgy</th>
                    <th>Kör</th>
                    <th class="text-center">Dátum</th>
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
                    <td>
                        <a href="{{ route('circles.show', ['circle' => $newsletter->circle]) }}">
                            {{ $newsletter->circle->name }}
                        </a>
                    </td>
                    <td class="text-center">{{ $newsletter->sent_at->format('Y. m. d. H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $newsletters->links() }}
@endsection