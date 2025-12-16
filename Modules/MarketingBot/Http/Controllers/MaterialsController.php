<?php

namespace Modules\MarketingBot\Http\Controllers;

use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Modules\MarketingBot\Services\CampaignService;
use Modules\MarketingBot\Http\Requests\FetchUrlRequest;
use Modules\MarketingBot\Exports\TrainingMaterialExport;
use Modules\MarketingBot\Services\TrainingMaterialService;
use Modules\MarketingBot\Transformers\CampaignTrainingResource;

class MaterialsController extends Controller
{

    public function __construct(
        protected CampaignService $campaignService,
        protected TrainingMaterialService $trainingMaterialService
    ) {}

    /**
     * Retrieve a list of training materials for a campaign.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|string  $id  Campaign ID.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function materials(Request $request, $id): JsonResponse|View
    {
        $data['campaign'] = $this->campaignService->getCampaignById($id);
        $data['materials'] = $this->trainingMaterialService->allMaterials($id)->filter('Modules\\MarketingBot\\Filters\\MaterialFilter')->paginate(preference('row_per_page'));

        if ($request->ajax()) {
            return response()->json([
                'items' =>  view('marketingbot::materials.materials-table-rows', $data)->render(),
            ]);
        }

        return view('marketingbot::materials.training-materials', $data);
    }

    /**
     * Fetches URLs using the FetchUrlRequest data and handles exceptions.
     *
     * @param FetchUrlRequest $request The request containing data for fetching URLs.
     * @return JsonResponse The JSON response containing the fetched URLs or error message.
     */
    public function fetchUrl(FetchUrlRequest $request): JsonResponse
    {
        try {
            $urls = $this->trainingMaterialService->fetchUrls($request->except('_token'));
            return response()->json(['data' => $urls], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Stores a training material for a campaign.
     *
     * @param \Illuminate\Http\Request $request The request containing data for storing the training material.
     * @param int|string $id The campaign ID.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the stored training material or error message.
     *
     * @throws Exception
     */
    public function train(Request $request, $id): JsonResponse
    {
        try {
            $collect = $this->trainingMaterialService->storeMaterials($id, $request->except('_token'));
            return response()->json(['data' => CampaignTrainingResource::collection($collect)], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()],

                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Stores a training material for a campaign.
     *
     * @param \Illuminate\Http\Request $request The request containing data for storing the training material.
     * @param int|string $id The campaign ID.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the stored training material or error message.
     *
     * @throws Exception
     */
    public function trainMaterials(Request $request, $id) 
    {
        try {
            // $campaign = $this->campaignService->getCampaignById($id);

            // if (!$campaign) {
            //     return response()->json(['error' =>  __('No :x found.', [ 'x' => __('Campaign') ])], Response::HTTP_NOT_FOUND);
            // }

            $checkSubscription = checkUserSubscription('word');

            if ($checkSubscription['status'] != 'success') {
                return response()->json(['error' => $checkSubscription['response']], Response::HTTP_FORBIDDEN);
            }

            $marketingBot = $this->campaignService->getSettings();

            if (!isset($marketingBot['provider']) && !isset($marketingBot['model'])) {
                return response()->json(['error' => __('Please contact admin to configure :x settings.', [ 'x' => __('Marketing Bot') ])], Response::HTTP_FORBIDDEN);
            }

            request()->merge([
                'provider' => $marketingBot['provider'],
                'model' => $marketingBot['model'],
            ]);

            $collect = $this->trainingMaterialService->train($request->except('_token'));
            return response()->json(['data' => CampaignTrainingResource::collection($collect)], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    /**
     * Delete a training material.
     *
     * @param \Illuminate\Http\Request $request The request containing the data for deleting the training material.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the message of the deletion or error message.
     *
     * @throws Exception
     */
    public function deleteMaterials(Request $request): JsonResponse
    {
        try {
            $this->trainingMaterialService->deleteMaterial(($request->except('_token')));
            return response()->json(['message' => __('Material deleted successfully')], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 
                $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Export training materials to CSV format.
     *
     * Downloads all training materials as a CSV file with a timestamp-based filename.
     * Uses the TrainingMaterialExport class to handle the data transformation.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportTrainingMaterials()
    {
        return Excel::download(new TrainingMaterialExport(Auth::id()), 'training_material_' . uniqid() . '.csv');
    }
}