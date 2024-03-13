@extends('layouts.app')

@section('page-title', 'Modifica il progetto ' . $project->name)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1>
                        {{ 'Modifica il progetto ' . $project->name }}
                    </h1>
                    
                    {{-- Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <br>

                    <form action="{{ route('admin.projects.update', ['project' => $project->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="d-block" for="name">Nome progetto: <span class="text-danger">*</span></label>
                            <input class="@error('name') is-invalid @enderror" value="{{ old('name', $project->name) }}" maxlength="64" id="name" name="name" type="text" placeholder="Scrivi il nome..." required>
                            {{-- Barra errore --}}
                            @error('name')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>

                        {{-- Tipo --}}
                        <div class="my-4">
                            <label class="d-block" for="type_id">Tipo:</label>

                            <select name="type_id" id="type_id">
                                <option value="" {{ old('type_id', $project->type_id) == null ? 'selected' : '' }}>
                                    Scegli il tipo...
                                </option>
    
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"  {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tecnologie --}}
                        <div class="my-4">
                            <label class="d-block" for="type_id">Scegli le tecnologie per il progetto:</label>

                            @foreach ($technologies as $technology)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        name="technologies[]" 
                                        value="{{ $technology->id }}" 
                                        id="technology-{{ $technology->id }}"
                                        {{ $project->technologies->contains($technology->id) ? 'checked' : ''}}
                                    >

                                    <label class="form-check-label" for="{{ $technology->id }}">
                                        {{ $technology->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{-- File da aggiungere --}}
                        <div class="mb-3">
                            <label for="dataFile" class="form-label">Scegli un'immagine:</label>
                            <input style="width: 25%" class="form-control" type="file" id="dataFile" name="dataFile">
                            {{-- Barra errore --}}
                            @error('dataFile')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                            
                            {{-- Immagine corrente --}}
                            @if ($project->image_src != null)
                                <div class="my-3">
                                    <img style="width: 300px" src="/storage/{{ $project->image_src }}" alt="image">
                                </div>
                            @endif

                            {{-- 
                                Checkbox per eliminare l'img,
                                anche se non dobbiamo salvarlo nel db, comunque 
                                dobbiamo validarlo, altrimenti nei dati nel backend non arriva.

                                Validazione = nullable|boolean.

                                Si mette come value dell'input 1 perchè 
                                devo controllare se questo è pieno in update()

                                Se quel progetto ha una img associata mi fai vedere l'input
                            --}}
                            @if ($project->image_src != null)
                                <div>
                                    <input value="1" type="checkbox" name="remove_file" id="remove_file">
                                    <label for="remove_file" class="form-label">- Rimuovi immagine</label>
                                </div>
                            @endif

                        </div>
            
                        <div class="mb-3">
                            <label class="d-block" for="description">Descrizione:</label>
                            <textarea cols="23" class="@error('description') is-invalid @enderror" maxlength="4096" name="description" id="description" placeholder="Scrivi una descrizione">
                                {{ old('description', $project->description) }}
                            </textarea>
                            {{-- Barra errore --}}
                            @error('description')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <button type="submit" class="btn btn-warning">Aggiorna</button>
                        </div>
                        <br>
                    </form>

                    La dashboard è una pagina privata (protetta dal middleware)
                </div>
            </div>
        </div>
    </div>
@endsection