<?php

namespace App\Filament\User\Resources\ShortUrlResource\Pages;

use App\Filament\User\Resources\ShortUrlResource;
use App\Models\MyShortUrl;
use App\Service\ShortUrlService;
use AshAllenDesign\ShortURL\Models\ShortURL;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShortUrl extends CreateRecord
{
    protected static string $resource = ShortUrlResource::class;

    protected function handleRecordCreation(array $data): ShortURL
    {

        return app(ShortUrlService::class)->destinationUrl($data['destination_url'])
            ->beforeCreate(function (ShortURL $shortURL) {
                $shortURL->user_id = auth()->id();
                $result =  Builder::create()
                    ->writer(new PngWriter())
                    ->writerOptions([])
                    ->data($shortURL->default_short_url)
                    ->encoding(new Encoding('UTF-8'))
                    ->errorCorrectionLevel(ErrorCorrectionLevel::High)
                    ->size(300)
                    ->margin(10)
                    ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
                    ->logoPath(public_path('/logo.png'))
                    ->logoResizeToWidth(100)
                    ->logoPunchoutBackground(true)
                    ->labelText('')
                    ->labelFont(new NotoSans(20))
                    ->labelAlignment(LabelAlignment::Center)
                    ->validateResult(false)
                    ->build();
                $result->saveToFile(storage_path('/app/public/' . $shortURL->url_key . '.png'));
                $shortURL->image = $shortURL->url_key . '.png';
            })
            ->make();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
