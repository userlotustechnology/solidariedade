<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MediaHelper
{
    /**
     * Retorna a URL do avatar do participante.
     *
     * @param string|null $path
     * @return string
     */
    public static function getParticipantAvatarUrl($path)
    {
        if (!$path) {
            return asset('assets/images/user.png');
        }

        try {
            if (config('filesystems.default') === 's3') {
                return Storage::disk('s3')->temporaryUrl(
                    $path,
                    now()->addMinutes(5)
                );
            }

            return Storage::disk('public')->exists($path)
                ? Storage::disk('public')->url($path)
                : asset('assets/images/user.png');
        } catch (\Exception $e) {
            Log::error('Erro ao gerar URL do avatar do participante: ' . $e->getMessage());
            return asset('assets/images/user.png');
        }
    }

    /**
     * Faz upload de uma imagem para o disco correto conforme o ambiente.
     *
     * @param \Illuminate\Http\UploadedFile|null $file
     * @param string $folder
     * @return string|null Caminho do arquivo salvo ou null em caso de erro
     */
    public static function upload($file, $folder)
    {
        if (!$file) {
            return null;
        }

        // Gera um nome único para o arquivo
        $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $folder . '/' . $fileName;

        // Determina o disco baseado no ambiente
        $disk = app()->environment('local') ? 'public' : 's3';

        try {
            // Garante que o diretório existe
            if ($disk === 'public' && !Storage::disk($disk)->exists($folder)) {
                Storage::disk($disk)->makeDirectory($folder);
            }

            // Faz o upload do arquivo
            Storage::disk($disk)->put($path, file_get_contents($file));
            return $path;
        } catch (\Exception $e) {
            Log::error('Erro ao fazer upload do arquivo: ' . $e->getMessage());
            return null;
        }
    }

    public static function delete($path)
    {
        if (empty($path)) {
            return false;
        }

        try {
            // Determina o disco baseado no ambiente
            $disk = app()->environment('local') ? 'public' : 's3';

            // Verifica se o arquivo existe antes de tentar deletar
            if (Storage::disk($disk)->exists($path)) {
                return Storage::disk($disk)->delete($path);
            }

            return false;
        } catch (\Exception $e) {
            \Log::error('Erro ao deletar arquivo: ' . $e->getMessage());
            return false;
        }
    }
}
