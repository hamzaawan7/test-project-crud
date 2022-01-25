<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSaveRequest;
use App\Repositories\InterestRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    private $userRepository;
    private $interestRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param InterestRepositoryInterface $interestRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        InterestRepositoryInterface $interestRepository
    ) {
        $this->userRepository = $userRepository;
        $this->interestRepository = $interestRepository;
    }

    public function index()
    {
        return view('users.index', ['users' => $this->userRepository->all()]);
    }

    /**
     * @param UserSaveRequest $request
     * @return JsonResponse
     */
    public function store(UserSaveRequest $request): JsonResponse
    {
        $user = $this->userRepository->save($request->all());
        $this->interestRepository->save(explode(',', $request->interests), $user->id);

        return response()->json(
            [
                'status'  => 200,
                'message' => 'Data Inserted Successfully',
            ]
        );
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request): array
    {
        $user = $this->userRepository->get($request->user_id);

        return [
            'user'      => $user->toArray(),
            'interests' => $this->stringifyInterests($user->interests),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request): array
    {
        $this->userRepository->delete($request->user_id);

        return array(
            'status'  => 200,
            'message' => 'Data Deleted Successfully',
        );
    }

    /**
     * @param $interests
     * @return string
     */
    private function stringifyInterests($interests): string
    {
        return implode(',', collect($interests)->pluck('name')->toArray());
    }
}
