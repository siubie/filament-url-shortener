<?php

namespace App\Http\Controllers;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\LabelAlignment as LabelLabelAlignment;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;

class QrController extends Controller
{
    //index function
    public function index()
    {
        return view('qr.index');
    }

    //generate function
    public function generate(Request $request)
    {
        $result =  Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data('https://dosenngoding.com')
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->logoPath(public_path('/logo.png'))
            ->logoResizeToWidth(100)
            ->logoPunchoutBackground(true)
            ->labelText('This is the label')
            ->labelFont(new NotoSans(20))
            ->labelAlignment(LabelLabelAlignment::Center)
            ->validateResult(false)
            ->build();

        $result->saveToFile(public_path('/qr.png'));
        return redirect()->route('qr.index');
    }
}
