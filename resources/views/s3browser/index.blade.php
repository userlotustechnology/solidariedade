@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Arquivos no S3</h2>
    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="path" class="form-control" value="{{ $currentPath }}" placeholder="Caminho do diretório">
            <button class="btn btn-primary" type="submit">Abrir</button>
        </div>
    </form>
    <div class="mb-4">
        <h5>Diretórios</h5>
        <ul>
            @forelse($directories as $dir)
                <li>
                    <a href="?path={{ $dir }}">{{ $dir }}</a>
                </li>
            @empty
                <li>Nenhum diretório encontrado.</li>
            @endforelse
        </ul>
    </div>
    <div>
        <h5>Arquivos</h5>
        <ul>
            @forelse($files as $file)
                <li>
                    {{ $file }}
                    @if(isset($fileLinks[$file]) && $fileLinks[$file])
                        <a href="{{ $fileLinks[$file] }}" target="_blank" class="btn btn-sm btn-outline-success ms-2">Link Temporário</a>
                    @else
                        <span class="text-danger ms-2">Erro ao gerar link</span>
                    @endif
                </li>
            @empty
                <li>Nenhum arquivo encontrado.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
