<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Interest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', ['users' => $users]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'south_african_id' => 'required',
            'mobile_number' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'dob' => 'required',
            'language' => 'required',
            'interests' => 'required',
        ]);
    //dd($request->interests);
        if ($validator->fails()) {
            return response()->json([
                'status' => '400',
                'error' => $validator->messages(),
            ]);
        }

       $user = User::updateOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'surname' => $request->surname,
                'south_african_id' => $request->south_african_id,
                'dob' => $request->dob,
                'language' => $request->language,
                'mobile_number' => $request->mobile_number,
            ]
        );

        Interest::where('user_id',$request->user_id)->delete();
        if ($request->interests) {
            foreach (explode(',', $request->interests) as $interest) {
                Interest::updateOrCreate(['name' => $interest, 'user_id'=> $user->id]);
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Data Inserted Successfully',
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request)
    {
        $interests = [];
        $user = User::find($request->user_id);

        foreach ($user->interests as $interest) {
            $interests[] = $interest->name;
        }

        return [
            'user' => $user->toArray(),
            'interests' => implode(', ', $interests),
        ];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        $interests = [];
        $user = User::find($request->user_id);

        foreach ($user->interests as $interest) {
            $interests[] = $interest->name;
        }

        return [
            'user' => $user->toArray(),
            'interests' => implode(', ', $interests),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request): array
    {
        User::find($request->user_id)->delete();

        return array(
            'status' => 200,
            'message' => 'Data Deleted Successfully',
        );
    }
}
