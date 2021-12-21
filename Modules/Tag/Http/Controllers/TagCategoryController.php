<?php

namespace Modules\Tag\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Post\Entities\Post;
use Modules\Tag\Entities\TagCategory;

class TagCategoryController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        // Set default response
        $response = [
            'status'  => 'error',
            'message' => 'Failed to save tag category. Please try again.',
        ];

        // validate data
        $this->validate($request,[
            'tag_category_name' => ['required', 'max:255'],
        ]);

        $id       = $request->input('tag_category_id');
        $updating = ($id > 0);

        // Insert or update tag category to db table
        $tag_category       = $updating ? TagCategory::find($id) : new TagCategory;
        $tag_category->name = $request->input('tag_category_name');

        $saved = $tag_category->save();

        if ($saved) {
            $response = [
                'status'        => 'success',
                'message'       => 'Tag category has been saved.',
                'data'          => $tag_category,
            ];
        }

        return response()->json($response);

    }

    public function tagCategories(Request $request, $tag_category_query = null)
    {
        // If tag category is not found -> return 404 | Not Found
        if (!$tag_category_query) {
            abort(404);
        }

        $posts = Post::getByTagCategoryName($tag_category_query);

        $data['page_title'] = $tag_category_query;
        $data['posts']      = $posts;

        return view('tag::archive.category-archive', $data);
    }

    public function searchTagsInCategory(Request $request){
        $search = $request->search;
        $category_id = $request->categoryId;
        $post_id = $request->has('postId') ? $request->postId : null;

        $tags = TagCategory::leftJoin('tags', 'tags.tag_category_id', '=', 'tag_categories.id')
            ->where('tag_category_id', $category_id)
            ->where('tags.name', 'like', $search.'%')
            ->select('tags.id', 'tags.name')
            ->get();

        if($post_id != null){
            $post = Post::find($post_id);
            $post_tags = $post->getTagNames();
        }

        $tags_array = [];
        foreach($tags as $tag){
            if($post_id != null && in_array($tag->name, $post_tags)){
                continue;
            }

            $tags_array[] = [
                'id' => $tag->id,
                'text' => $tag->name
            ];
        }


        return [
            'results' => $tags_array
        ];
    }
}
