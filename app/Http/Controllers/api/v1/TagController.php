<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagSaveRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
    * @OA\Get(
    *      path="/{lang}/tags",
    *      operationId="index",
    *      tags={"Tags"},
    *      summary="Get All Tags",
    *      description="Returns All Tags",
    *      security={{"bearerAuth":{}}},
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation",
    *          @OA\JsonContent(
    *          )
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *          @OA\JsonContent()
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden",
    *          @OA\JsonContent()
    *      )
    *     )
    */
    public function index($lang)
    {
        return TagResource::collection((new Tag())->on($lang)->paginate(10));
    }

    /**
    * @OA\Post(
    *      path="/{lang}/tags",
    *      operationId="store",
    *      tags={"Tags"},
    *      summary="Create New Tag",
    *      description="Returns All Tags",
    *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="Tag Name",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="disabled",
     *          in="query",
     *          required=false,
     *          description="Status of Tag",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation",
    *          @OA\JsonContent(
    *          )
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *          @OA\JsonContent()
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden",
    *          @OA\JsonContent()
    *      )
    *     )
    */
    public function store($connection, TagSaveRequest $request)
    {
        $tag = new Tag();
        $tag->setConnection($connection);
        $tag->name = $request->name;
        $tag->disabled = $request->disabled ?? Tag::DISABLED_FALSE;
        $tag->save();

        return $tag;
    }

    /**
    * @OA\Get(
    *      path="/{lang}/tags",
    *      operationId="show",
    *      tags={"Tags"},
    *      summary="Get Tag By Id",
    *      description="Returns Specific Tag By Id",
    *      security={{"bearerAuth":{}}},
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation",
    *          @OA\JsonContent(
    *          )
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *          @OA\JsonContent()
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden",
    *          @OA\JsonContent()
    *      )
    *     )
    */
    public function show($connection, Tag $tag)
    {
        return new TagResource($tag);
    }

    /**
    * @OA\Put(
    *      path="/{lang}/tags/{tag}",
    *      operationId="store",
    *      tags={"Tags"},
    *      summary="Update Tag",
    *      description="Returns All Tags",
    *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          description="Tag Name",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
     *      @OA\Parameter(
     *          name="disabled",
     *          in="query",
     *          required=false,
     *          description="Status of Tag",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful operation",
    *          @OA\JsonContent(
    *          )
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *          @OA\JsonContent()
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden",
    *          @OA\JsonContent()
    *      )
    *     )
    */
    public function update($connection, TagSaveRequest $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->disabled = $request->disabled ?? Tag::DISABLED_FALSE;
        $tag->save();

        return $tag;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($connection, Tag $tag)
    {
        return $tag->delete();
    }
}
