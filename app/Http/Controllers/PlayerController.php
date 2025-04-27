<?php

namespace App\Http\Controllers;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller {
    // display a listing of the resource, return json
    public function index() {
        $players = Player::all();
        return response()->json($players);
    }

    //store a newly created resource in storage
    public function store(Request $request) {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:players',
        ]);
        $player = Player::create($validateData);
        return response()->json($player, 201);
    }

    // display the specified resource
    public function show($id) {
        $player = Player::findOrFail($id);
        return response()->json($player);
    }

    // update the specified resource in storage
    public function update(Request $request, Player $player) {
        $validateData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:players,email,' . $id,
        ]);
        $player->update($validateData);
        return response()->json($player);
    }

    // remove the specified resource from storage
    public function destroy(Player $player) {
        $player->delete();
        return response()->json(null, 204);
    }

}