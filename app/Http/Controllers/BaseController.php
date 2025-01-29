<?php

namespace App\Http\Controllers;

use App\Messaging\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class BaseController extends \Illuminate\Routing\Controller
{
    public function badRequest($message)
    {
        return response()->json(new Response(null, $message), 400);
    }

    public function forbidden($message)
    {
        return response()->json(new Response(null, $message), 403);
    }

    public function created($id, $message = "Created successfully")
    {
        return $this->ok($id, $message, null, null, 201);
    }

    public function ok($data, $message = null, $errors = null, ?string $charset = null, $statusCode = 200)
    {
        $options = $charset == 'utf-8' ? JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES : 0;

        return response()->json(new Response($data, $message, $errors), $statusCode, []);
    }

    public function defused()
    {
        return $this->deleted('Defused Successfully');
    }

    public function deleted($message = "Deleted successfully.")
    {
        return $this->ok(null, $message);
    }

    public function notFound($message = "The requested resource is not found")
    {
        return response()->json(new Response(null, $message), 404);
    }

    public function internalError($message = "Sorry, Something wrong happened at out side, please try again in a few moments")
    {
        return response()->json(new Response(null, $message), 500);
    }

    public function tokenExpired($message)
    {
        return response()->json(new Response(null, $message), 498);
    }

    /**
     * @param $items
     * @param int $perPage
     * @param $page
     * @param array $options
     * @return LengthAwarePaginator
     * @author Aiham Shikho
     * @note you can use this function to make paginate for array
     */
    public function paginate($items, int $perPage = 5, $page = null, array $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage)->values(), $items->count(), $perPage, $page, $options);
    }
}
