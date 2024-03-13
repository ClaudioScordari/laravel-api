@extends('layouts.app')

@section('page-title', $project->name)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="my-2">
                        {{ $project->name }}
                    </h1>

                    {{-- Tipo del progetto --}}
                    <h2 class="my-3">
                        @if ($project->type)
                            Type: {{ $project->type->name }}
                        @else
                            -
                        @endif
                    </h2>

                    {{-- Tecnologie usate --}}
                    <div class="my-3">
                        <h2>
                            Tecnologie:
                        </h2>

                        <ul>
                            @forelse ($project->technologies as $technology)
                                <li>
                                    {{ $technology->name }}
                                </li>
                            @empty
                                -
                            @endforelse
                        </ul>
                    </div>

                    {{-- Immagine associata --}}
                    <div class="my-3">
                        <h2>
                            Immagine:
                        </h2>

                        @if ($project->image_src != null)
                            <div>
                                <img style="width: 300px" src="/storage/{{ $project->image_src }}" alt="image1">
                            </div>
                        @else
                            -
                        @endif
                    </div>

                    <p>
                        {{ $project->description }}
                    </p>

                    {{-- Progetti --}}
                    <div>
                        <a class="btn btn-primary" href="{{ route('admin.projects.index') }}">
                            Torna ai progetti
                        </a>
                    </div>

                    <br>

                    La dashboard è una pagina privata (protetta dal middleware)
                </div>
            </div>
        </div>
    </div>
@endsection