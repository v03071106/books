<?php

namespace App\Docs\Swagger;

/**
 * @OA\Server(
 *     url="http://ma.docker.local",
 *     description="測試區主機"
 * )
 * @OA\Server(
 *     url="https://ma.docker.local",
 *     description="正式區主機"
 * )
 * @OA\Server(
 *     url="http://ma.docker.local",
 *     description="Localhost"
 * )
 */
class Server { }