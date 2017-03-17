<?php

namespace App\Http\Controllers;

use App\Lifecanvas\Transformers\ByteTransformer;
use Illuminate\Http\Request;
use App\Byte;

class ApiByteController extends ApiController
{
    /**
     * @var byteTransformer
     */
    protected $byteTransformer;

    /**
     * LessonsController constructor.
     * @param ByteTransformer $byteTransformer
     * @internal param ByteTransformer $lessonTransformer
     */
    function __construct(ByteTransformer $byteTransformer)
    {
        $this->byteTransformer = $byteTransformer;

        $this->middleware('auth.basic', ['only' => 'store']);
    }

    /**
     * Returns json containing a list of bytes found.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bytes = Byte::all();

        if (! $bytes) {
            return $this->responseNotFound('No bytes found.');
        }

        return $this->respond([
            'data' => $this->byteTransformer->transformCollection($bytes->toArray())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Lesson input verification section.
        if( ! $request->input('name') and ! $request->input('user_id'))
        {
            return $this->responseValidationError('Parameters failed validation.');
        }

        Byte::create($request->all());
        return $this->responseAddSuccess('Byte added successfully.');

    }

    /**
     * Return json containing the found byte.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Byte $byte)
    {
        //return $byte;

        //$lesson = Lesson::find($id);

        if (! $byte)
        {
            return $this->responseNotFound('Byte does not exist.');
        }
        return $this->respond(['data' => $this->byteTransformer->transform($byte)]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
