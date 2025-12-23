<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Services\Templates;

use Cweetagram\CweetagramVonageWhatsapp\Data\Responses\TemplateStateResponseData;
use Cweetagram\CweetagramVonageWhatsapp\Data\WabaAccountData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetTemplateStateService
{
    public function handle(WabaAccountData $wabaAccountData, string $templateId): ?TemplateStateResponseData
    {
        try {
            $response = Http::withToken($wabaAccountData->appJwt)
                ->acceptJson()
                ->contentType('application/json')
                ->get(sprintf('%s%s',
                        config('vonage_api.api_endpoint'),
                        'whatsapp-manager/wabas/' . $wabaAccountData->waba_id. '/templates/' . $templateId
                    )
                );

            $data = $response->json();

            return new TemplateStateResponseData(state: $data['status']);

        } catch (\Exception $exception) {
            Log::error('Failed to fetch state for template (' . $templateId . ') on account ' . $wabaAccountData->waba_id . ' : ' . $exception->getMessage());
            Log::error($exception);

            return null;
        }
    }
}