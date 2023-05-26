<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\TextsResources;
use App\Models\Texts;
use App\Repositories\TextsRepository;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    use ApiTrait;

    /**
     * @var TextsRepository
     */
    private $repository;

    public function __construct(TextsRepository $textsRepository)
    {
        $this->repository = $textsRepository;
    }

    public function index(Request $request)
    {
        return TextsResources::collection(
            $this->repository
                ->where('provider_id', '=', $request->provider_id)
                ->get()
        );
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request->all(), $id);
        return $this->createApiSuccessMessage();
    }

}
