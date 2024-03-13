@extends('layouts.app')

@section('page-title', 'Crea un progetto')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1>
                        Crea un nuovo progetto
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

                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
            
                        <div class="mb-3">
                            <label class="d-block" for="name">Nome progetto: <span class="text-danger">*</span></label>
                            <input class="@error('name') is-invalid @enderror" value="{{ old('name') }}" maxlength="64" id="name" name="name" type="text" placeholder="Scrivi il nome..." required>
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
                                <option value="" {{ old('type_id') == null ? 'selected' : '' }}>
                                    Scegli il tipo...
                                </option>
    
                                @foreach ($types as $type)
                                    <option {{ old('type_id') == $type->id ? 'selected' : '' }} value="{{ $type->id }}">
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
                                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : ''}}
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
                        </div>
            
                        <div class="mb-3">
                            <label class="d-block" for="description">Descrizione:</label>
                            <textarea cols="23" class="@error('description') is-invalid @enderror" maxlength="4096" name="description" id="description" placeholder="Scrivi una descrizione">
                                {{ old('description') }}
                            </textarea>
                            {{-- Barra errore --}}
                            @error('description')
                                <div class="alert alert-danger">	
                                    {{ $message }} 
                                </div>
                            @enderror
                        </div>
            
                        <div>
                            <button type="submit" class="btn btn-primary">Aggiungi</button>
                        </div>
                        <br>
                    </form>

                    La dashboard è una pagina privata (protetta dal middleware)
                </div>
            </div>
        </div>
    </div>
@endsection