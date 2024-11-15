<?php

namespace App\Enums;

enum ExtensionsEnum : string
{
    case PDF = "pdf";
    case DOC = 'doc';
    case DOCX = 'docx';
    case XLS = 'xls';
    case XLSX = 'xlsx';
    case PPT = 'ppt';
    case PPTX = 'pptx';
    case JPG = 'jpg';
    case JPEG = 'jpeg';
    case PNG = 'png';
    case WEBP = 'webp';
    case SVG = 'svg';
    case GIF = 'gif';
    case MP4 = 'mp4';
    case MOV = 'mov';
    case AVI = 'avi';
    case MP3 = 'mp3';
    case MKV = 'mkv';
    case OGG = 'ogg';
    case WAV = 'wav';
    case ZIP = 'zip';
    case RAR = 'rar';
    case TXT = 'txt';
    case CSV = 'csv';
    case XML = 'xml';



        public static function getExtension(string $extension): string
        {



            return match ($extension) {

                self::PDF => asset('icons/pdf.png'),
                self::DOC => asset('icons/doc.png'),
                self::DOCX => asset('icons/docx.png'),
                self::XLS => asset('icons/xls.png'),
                self::XLSX => asset('icons/xlsx.png'),
                self::PPT =>  asset('icons/ppt.png'),
                self::PPTX => asset('icons/pptx.png'),
                self::JPG => asset('icons/jpg.png'),
                self::JPEG => asset('icons/jpeg.png'),
                self::PNG => asset('icons/png.png'),
                self::WEBP => asset('icons/webp.png'),
                self::SVG => asset('icons/svg.png'),
                self::GIF => asset('icons/gif.png'),
                self::MP4 =>  asset('icons/mp4.png'),
                self::MOV => asset('icons/mov.png'),
                self::AVI => asset('icons/avi.png'),
                self::MP3 => asset('icons/mp3.png'),
                self::MKV => asset('icons/mkv.png'),
                self::OGG => asset('icons/ogg.png'),
                self::WAV => asset('icons/wav.png'),
                self::ZIP => asset('icons/zip.png'),
                self::RAR => asset('icons/rar.png'),
                self::TXT =>  asset('icons/txt.png'),
                self::CSV => asset('icons/csv.png'),
                self::XML => asset('icons/xml.png'),
                default => asset('icons/none.png')


            };
        }


    // public static function groupForTypeFile($extension): string
    // {
    //     return match ($extension) {

    //         self::PDF, self::DOC, self::DOCX, self::XLS, self::XLSX, self::PPT, self::PPTX, self::TXT, self::CSV, self::XML => 'document',
    //         self::JPG, self::JPEG, self::PNG, self::WEBP, self::SVG, self::GIF => 'image',
    //         self::MP4, self::MOV, self::AVI, self::MKV => 'video',
    //         self::MP3, self::OGG, self::WAV => 'audio',
    //         self::ZIP, self::RAR => 'compressed',
    //         default => 'none',
    //     };
    // }

    // public static function getExtension($extension): string
    // {
    //     return match ($extension) {
    //         self::PDF, self::DOC, self::DOCX, self::XLS, self::XLSX, self::PPT, self::PPTX, self::JPG, self::JPEG, self::PNG, self::WEBP, self::SVG, self::GIF, self::MP4, self::MOV, self::AVI, self::MP3, self::MKV, self::OGG, self::WAV, self::ZIP, self::RAR, self::TXT, self::CSV, self::XML => asset('icons/' . $extension . '.png'),
    //         default => asset('icons/none.png'),
    //     };
    // }

    public static function groupForTypeFile($extension): string
    {
        return match ($extension) {
            self::PDF, self::DOC, self::DOCX, self::XLS, self::XLSX, self::PPT, self::PPTX, self::TXT, self::CSV, self::XML => 'document',
            self::JPG, self::JPEG, self::PNG, self::WEBP, self::SVG, self::GIF => 'image',
            self::MP4, self::MOV, self::AVI, self::MKV => 'video',
            self::MP3, self::OGG, self::WAV => 'audio',
            self::ZIP, self::RAR => 'compressed',
            default => 'none',
        };
    }



}
