<?php

namespace App\Enums;

enum FileTypeEnum: string
{
    // Definir tipos de archivos con las extensiones permitidas para cada tipo.
    case Document = 'document';
    case Image = 'image';
    case Video = 'video';
    case Audio = 'audio';
    case Compressed = 'compressed';

    // Asignar las extensiones correspondientes a cada tipo.
    public static function getExtensions(self $type): array
    {
        return match ($type) {
            self::Document => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv', 'xml'],
            self::Image => ['jpg', 'jpeg', 'png', 'webp', 'svg', 'gif'],
            self::Video => ['mp4', 'mov', 'avi', 'mkv'],
            self::Audio => ['mp3', 'ogg', 'wav'],
            self::Compressed => ['zip', 'rar'],
        };
    }

    // Devuelve el tipo de archivo basado en una extensión específica
    public static function getTypeForExtension(string $extension): ?self
    {
        return match ($extension) {
            'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv', 'xml' => self::Document,
            'jpg', 'jpeg', 'png', 'webp', 'svg', 'gif' => self::Image,
            'mp4', 'mov', 'avi', 'mkv' => self::Video,
            'mp3', 'ogg', 'wav' => self::Audio,
            'zip', 'rar' => self::Compressed,
            default => null,
        };
    }
}
