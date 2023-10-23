<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::all();

        if($posts->isEmpty()){
            return response()->json(['message' => 'Nenhuma postagem encontrado!'], 404);
        }
        return  response()->json(['Posts' => $posts]);
    }

    public function show($id): JsonResponse
    {
        $post = Post::query()->find($id);

        if($post == null) {
            return response()->json(['message' => 'Nenhuma postagem encontrada com esse ID!'], 404);
        }
        return response()->json($post, 200);
    }
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:posts',
            'user_id' => 'required',
            'content' => 'required|min:6',
            'visibility' => [
                'required',
                Rule::in(['ativo', 'inativo'])
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }

        $newPost = Post::query()->create([
            'title' => $request->get('title'),
            'user_id' => $request->get('user_id'),
            'content' => $request->get('content'),
            'visibility' => $request->get('visibility')
        ]);


        if($newPost) {
            return response()->json(['message' => 'Postagem criada com sucesso!'], 200);
        }
        return response()->json(['message' => 'Erro ao criar uma postagem!'], 400);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:posts',
            'user_id' => 'required',
            'content' => 'required|min:6',
            'visibility' => [
                'required',
                Rule::in(['ativo', 'inativo'])
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()]);
        }

        $post = Post::query()
            ->where('id', $id)
            ->update([
                'title' => $request->get('title'),
                'user_id' => $request->get('user_id'),
                'content' => $request->get('content'),
                'visibility' => $request->get('visibility')
            ]);

        if($post) {
            return response()->json(['message' => 'Post atualizado com sucesso!'], 200);
        }
        return response()->json(['message' => 'Erro ao atualizar post!'], 400);
    }

    public function delete($id): JsonResponse
    {
        $post = Post::query()->where('id', $id)->delete();

        if($post) {
            return response()->json(['message' => 'Post deletado com sucesso!'], 200);
        }
        return response()->json(['message' => 'Erro ao deletar post!'], 400);
    }
}
