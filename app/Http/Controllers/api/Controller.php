<?php

namespace App\Http\Controllers\api;

class Controller
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Laravel News API",
     *      description="L5 SwaggerLaravel News API Documentation",
     *      @OA\Contact(
     *          email="udara.cherath@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="News API Server"
     * )

     *
     * @OA\Tag(
     *     name="News",
     *     description="API Endpoints of News laravel Api"
     * )
     * 
     *  * @OA\SecurityScheme(
     *    securityScheme="bearerAuth",
     *    in="header",
     *    name="bearerAuth",
     *    type="http",
     *    scheme="bearer",
     *    bearerFormat="JWT",
     *    description="Add token value without Bearer. will append automaticaly"
     * ),
     */
}