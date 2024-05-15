<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Requests\CreateTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

class TeamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Team $team)
    {
        $teams = Team::latest()->paginate(10);
        return TeamResource::collection($teams);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return new TeamResource($team);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTeamRequest $request)
    {
        $user = auth()->user();

        $team = Team::create($request->all() + ['user_id' => $user->id]);
    
        return new TeamResource($team);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->all());

        return new TeamResource($team);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();
        
        return response()->json([
            'message' => 'Team deleted successfully'
        ]);
    }
}
