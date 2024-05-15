<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlayerResource;
use Illuminate\Http\Request;
use App\Models\Player;
use App\Http\Requests\CreatePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;

// Laravel form request


class PlayerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Player $player)
    {

        $query = Player::latest();

        $filters = $request->query();

        if(isset($filters['position'])) {
            $query->where('position', $filters['position']);
        }
        if(isset($filters['nationality'])) {
            $query->where('nationality', $filters['nationality']);
        }
        if(isset($filters['age'])) {
            $query->where('age', $filters['age']);
        }

        $filteredPlayers = $query->paginate(20);

        return PlayerResource::collection($filteredPlayers);



    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        return new PlayerResource($player);
    }

    /**
     * Store a newly created resource in storage.
     */    

    public function store(CreatePlayerRequest $request)
    {
    
        $user = auth()->user();

        $player = Player::create($request->all() + ['user_id' => $user->id]);

        return new PlayerResource($player);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, Player $player)
    {
        $player->update($request->all());

        return new PlayerResource($player);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        $player->delete();

        return response()->json([
            'message' => 'Player deleted successfully'
        ]);
    }
}
