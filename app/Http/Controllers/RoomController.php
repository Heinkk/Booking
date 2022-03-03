<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Room;
use App\Models\Photo;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $rooms = Room::when(Auth::user()->role == 1,function ($query){
//            $query->where("user_id",Auth::id());
//        })->search()->latest("id")->paginate(7);
//
//        return view('room.index',compact('rooms'));

        return view("room.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("room.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {


        if (!Storage::exists("public/thumbnail")) {
            Storage::makeDirectory("public/thumbnail");
        }

        $room = new Room();
        $room->name = $request->name;
        $room->slug = $request->name;
//        $post->category_id = $request->category;
        $room->type_id = $request->type;
        $room->description = $request->description;
        $room->price = $request->price;

        $room->user_id = Auth::id();
        $room->save();


        $room->features()->attach($request->features);

        if ($request->hasFile('photos')) {

            foreach ($request->file('photos') as $photo) {

                $newName = uniqid() . "_photo." . $photo->extension();
                $photo->storeAs('public/photo', $newName);


                $img = Image::make($photo);
                $img->fit(200, 200);
                $img->save("storage/thumbnail/" . $newName, 100);

                $photo = new Photo();
                $photo->name = $newName;
                $photo->room_id = $room->id;
                $photo->user_id = Auth::id();
                $photo->save();


            }
        }
        return redirect()->route('room.index')->with("status","Created Room Successfully");
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view("room.show",compact("room"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view("room.edit",compact("room"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoomRequest  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->name = $request->name;
        $room->description = $request->description;
        $room->type_id = $request->type;
        $room->price = $request->price;
        $room->user_id = Auth::user()->id;
        $room->slug = Str::slug($request->name);
        $room->update();
//
        $room->features()->detach();
        $room->features()->attach($request->features);

        return redirect()->route("room.index")->with("status","Updated Room Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        // delete pivot records
        $room->features()->detach();

        // delete db records
        $room->features()->delete();

        // post delete
        $room->delete();
        return redirect()->back()->with("status","Deleted Room Successfully");
    }
}
