<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Services\Templates;

use Cweetagram\CweetagramVonageWhatsapp\Data\Responses\CreatedTemplateResponseData;
use Cweetagram\CweetagramVonageWhatsapp\Data\TemplateData;
use Cweetagram\CweetagramVonageWhatsapp\Data\WabaAccountData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CreateTemplateService
{
    public function handle(
        WabaAccountData $wabaAccountData,
        TemplateData $templateData
    ): ?CreatedTemplateResponseData
    {
        try {
            $response = Http::withToken($wabaAccountData->appJwt)
                ->acceptJson()
                ->contentType('application/json')
                ->post(sprintf('%s%s',
                    config('vonage_api.api_endpoint'),
                    'whatsapp-manager/wabas/' . $wabaAccountData->waba_id. '/templates'
                    ),
                    $templateData->all()
                );

            $data = $response->json();

            return new CreatedTemplateResponseData($data);
        } catch (\Exception $exception) {
            Log::error('Failed to create template for account ' . $wabaAccountData->waba_id . ' : ' . $exception->getMessage());
            Log::error($exception);

            return null;
        }
    }
}
