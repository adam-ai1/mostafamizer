<?php

namespace Modules\Pebblely;

use App\Lib\AiProvider;
use Modules\Pebblely\Traits\PebblelyApiTrait;
use Modules\OpenAI\Contracts\Resources\AiProductPhotographyContract;
use Modules\Pebblely\Resources\AiProductPhotographyDataProcessor;

use Modules\Pebblely\Responses\AiProductPhotography\AiProductPhotographyResponse;

class PebblelyProvider extends AiProvider implements AiProductPhotographyContract
{
    use PebblelyApiTrait;

    /**
     * Holds the processed data after it has been manipulated or transformed.
     * This property is typically used within the context of a class to store
     * data that has been modified or processed in some way.
     *
     * @var array Contains an array of data resulting from processing operations.
     */
    protected $processedData;

    public function description(): array
    {
        return [
            'title' => 'Pebblely',
            'description' => __(':x is an AI-powered tool that removes backgrounds, adds custom themes, and generates professional product photos—no Photoshop or studio needed.', ['x' => 'Pebblely']),
            'image' => 'Modules/Pebblely/Resources/assets/image/pebblely.png',
        ];
    }

    /**
     * Retrieves the character chatbot options by instantiating a AiChatDataProcessor
     * and calling the characterChatbotOptions method.
     *
     * @return array An array of character chatbot options.
     */
    public function aiProductPhotographyOptions(): array
    {
        return (new AiProductPhotographyDataProcessor)->aiProductPhotographyOptions();
    }

    /**
     * Get the validation rules for a specific processor.
     * 
     * @param string $processor The name of the data processor class.
     * 
     * @return array Validation rules for the processor.
     */
    public function getValidationRules(string $processor): array
    {
        $processorClass = "Modules\\Pebblely\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->validationRules();
        }

        return [];
    }

    /**
     * Get the validation rules for a specific processor.
     * 
     * @param string $processor The name of the data processor class.
     * 
     * @return array Validation rules for the processor.
     */
    public function getCustomerValidationRules(string $processor): array
    {
        $processorClass = "Modules\\Pebblely\\Resources\\" . $processor;

        if (class_exists($processorClass)) {
            return (new $processorClass())->customerValidationRules();
        }

        return [];
    }

    /**
     * Synchronizes data from the HeyGen API based on the provided type.
     * 
     * Makes a GET request to the HeyGen API to retrieve and dump data of the specified type.
     * 
     * @return array The response from the API call.
     */

    public function sync(): array
    {
        return $this->makeCurlRequest(moduleConfig('pebblely.base_url') . "themes/v1", "GET");
    }
    public function aiProductPhotographyRules(): array
    {
        return (new AiProductPhotographyDataProcessor)->rules();
    }

    public function processSyncData(array $data): array
    {
        return (new AiProductPhotographyDataProcessor)->processData($data);
    }

    public function generateProductShot(array $data): \Modules\OpenAI\Contracts\Responses\AiProductPhotography\AiProductPhotographyResponseContract
    {
        $this->processedData = (new AiProductPhotographyDataProcessor($data))->prepareData();
        $service = data_get($data, 'options.service', 'create-background');
        $route = moduleConfig('pebblely.base_url') . moduleConfig('pebblely.productshot.services.' . $service);
        return new AiProductPhotographyResponse($this->makeCurlRequest($route, "POST", json_encode($this->processedData)));
    }
}
