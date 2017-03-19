<?php

namespace App\Http\Controllers;

use App\Byte;
use App\Lifecanvas\Transformers\LineTransformer;
use Illuminate\Http\Request;
use App\Line;

class ApiLineController extends ApiController
{
    /**
     * @var byteTransformer
     */
    protected $lineTransformer;

    /**
     * ApiLineController constructor.
     * @param LineTransformer $lineTransformer
     */
    function __construct(LineTransformer $lineTransformer)
    {
        $this->lineTransformer = $lineTransformer;
    }

    /**
     * Returns json containing a list of lines found.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        //$lines = Line::all();

        $lines = $id ? Byte::find($id)->lines : Line::all();

        if (! $lines) {
            return $this->responseNotFound('No lines found.');
        }

        return $this->respond([
            'data' => $this->lineTransformer->transformCollection($lines->toArray())
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
