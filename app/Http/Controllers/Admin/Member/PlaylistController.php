<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\PlaylistVideo;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    public function playlists(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();
        $playlists = Playlist::where('sub_product_id', $subProduct->id)
            ->with('subProduct')
            ->latest()
            ->paginate(10);

        return inertia('Admin/Members/Playlists/Index', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'playlists' => $playlists,
        ]);
    }

    public function playlistCreate(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();

        return inertia('Admin/Members/Playlists/Create', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
        ]);
    }

    public function playlistStore(Request $request, Product $product, SubProduct $subProduct)
    {
        $request->validate([
            'title'       => 'required|unique:playlists,title',
            'id_playlist' => 'required|unique:playlists,id_playlist',
            'thumbnail'   => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'description' => 'nullable',
        ], [
            'title.unique'       => 'Nama playlist sudah digunakan. Gunakan nama lain.',
            'id_playlist.unique' => 'ID playlist sudah digunakan. Gunakan ID lain.',
            'thumbnail.required' => 'Thumbnail tidak boleh kosong.',
            'thumbnail.image'    => 'Thumbnail harus berupa file gambar.',
            'thumbnail.mimes'    => 'Thumbnail harus berekstensi jpg, jpeg, atau png.',
            'thumbnail.max'      => 'Ukuran thumbnail maksimal 10MB.',
        ]);

        $path_thumbnail = $request->file('thumbnail')->store('playlists', 'public');

        Playlist::create([
            'sub_product_id' => $subProduct->id,
            'title'          => $request->title,
            'id_playlist'    => $request->id_playlist,
            'thumbnail'      => $path_thumbnail,
            'description'    => $request->description,
        ]);

        return redirect()->route('admin.members.playlists.index', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
        ]);
    }

    public function playlistShow(Product $product, SubProduct $subProduct, Playlist $playlist)
    {
        $menuProducts = Product::with('subProducts')->get();
        $playlist = Playlist::findOrFail($playlist->id);
        $playlistVideos = $playlist->playlistVideos()
            ->oldest()
            ->get();
        $playlist->setRelation('playlistVideos', $playlistVideos);

        return inertia('Admin/Members/Playlists/Show', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'playlist' => $playlist,
        ]);
    }

    public function playlistEdit(Product $product, SubProduct $subProduct, Playlist $playlist)
    {
        $menuProducts = Product::with('subProducts')->get();
        $playlist->thumbnail_name = basename($playlist->thumbnail);
        $playlist->thumbnail_size = Storage::disk('public')->size($playlist->thumbnail);

        return inertia('Admin/Members/Playlists/Edit', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'playlist' => $playlist,
        ]);
    }

    public function playlistUpdate(Request $request, Product $product, SubProduct $subProduct, Playlist $playlist)
    {
        $request->validate([
            'title'       => 'required|unique:playlists,title,' . $playlist->id,
            'id_playlist' => 'required|unique:playlists,id_playlist,' . $playlist->id,
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'description' => 'nullable',
        ], [
            'title.unique'       => 'Nama playlist sudah digunakan. Gunakan nama lain.',
            'id_playlist.unique' => 'ID playlist sudah digunakan. Gunakan ID lain.',
            'thumbnail.image'    => 'Thumbnail harus berupa file gambar.',
            'thumbnail.mimes'    => 'Thumbnail harus berekstensi jpg, jpeg, atau png.',
            'thumbnail.max'      => 'Ukuran thumbnail maksimal 10MB.',
        ]);

        $path_thumbnail = $playlist->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($path_thumbnail && Storage::disk('public')->exists($path_thumbnail)) {
                Storage::disk('public')->delete($path_thumbnail);
            }

            $path_thumbnail = $request->file('thumbnail')->store('playlists', 'public');
        }

        $playlist->update([
            'sub_product_id' => $subProduct->id,
            'title'          => $request->title,
            'id_playlist'    => $request->id_playlist,
            'thumbnail'      => $path_thumbnail,
            'description'    => $request->description,
        ]);

        return redirect()->route('admin.members.playlists.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'playlist' => $playlist->id_playlist,
        ]);
    }

    public function playlistDestroy(Product $product, SubProduct $subProduct, Playlist $playlist)
    {
        if ($playlist->thumbnail && Storage::disk('public')->exists($playlist->thumbnail)) {
            Storage::disk('public')->delete($playlist->thumbnail);
        }

        $playlist->delete();

        return redirect()->route('admin.members.playlists.index', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
        ]);
    }

    public function playlistCreateVideo(Product $product, SubProduct $subProduct, Playlist $playlist)
    {
        $menuProducts = Product::with('subProducts')->get();

        return inertia('Admin/Members/Playlists/Videos/Create', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'playlist' => $playlist,
        ]);
    }

    public function playlistStoreVideo(Request $request, Product $product, SubProduct $subProduct, Playlist $playlist)
    {
        $request->validate([
            'title'       => 'required|unique:playlist_videos,title',
            'id_video'    => 'required|unique:playlist_videos,id_video',
            'thumbnail'   => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'description' => 'nullable',
        ], [
            'title.unique'    => 'Nama video sudah digunakan. Gunakan nama lain.',
            'id_video.unique' => 'ID video sudah digunakan. Gunakan ID lain.',
            'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berekstensi jpg, jpeg, atau png.',
            'thumbnail.max'   => 'Ukuran thumbnail maksimal 10MB.',
        ]);

        $path_thumbnail = $request->file('thumbnail')->store('playlistVideos', 'public');

        PlaylistVideo::create([
            'playlist_id' => $playlist->id,
            'title'       => $request->title,
            'id_video'    => $request->id_video,
            'thumbnail'   => $path_thumbnail,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.members.playlists.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'playlist' => $playlist->id_playlist,
        ]);
    }

    public function playlistEditVideo(Product $product, SubProduct $subProduct, Playlist $playlist, PlaylistVideo $playlistVideo)
    {
        $menuProducts = Product::with('subProducts')->get();
        $playlistVideo->thumbnail_name = basename($playlistVideo->thumbnail);
        $playlistVideo->thumbnail_size = Storage::disk('public')->size($playlistVideo->thumbnail);

        return inertia('Admin/Members/Playlists/Videos/Edit', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'playlist' => $playlist,
            'playlistVideo' => $playlistVideo,
        ]);
    }

    public function playlistUpdateVideo(Request $request, Product $product, SubProduct $subProduct, Playlist $playlist, PlaylistVideo $playlistVideo)
    {
        $request->validate([
            'title'       => 'required|unique:playlist_videos,title,' . $playlistVideo->id,
            'id_video'    => 'required|unique:playlist_videos,id_video,' . $playlistVideo->id,
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'description' => 'nullable',
        ], [
            'title.unique'    => 'Nama video sudah digunakan. Gunakan nama lain.',
            'id_video.unique' => 'ID video sudah digunakan. Gunakan ID lain.',
            'thumbnail.image' => 'Thumbnail harus berupa file gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berekstensi jpg, jpeg, atau png.',
            'thumbnail.max'   => 'Ukuran thumbnail maksimal 10MB.',
        ]);

        $path_thumbnail = $playlistVideo->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($path_thumbnail && Storage::disk('public')->exists($path_thumbnail)) {
                Storage::disk('public')->delete($path_thumbnail);
            }

            $path_thumbnail = $request->file('thumbnail')->store('playlistVideos', 'public');
        }

        $playlistVideo->update([
            'title'       => $request->title,
            'id_video'    => $request->id_video,
            'thumbnail'   => $path_thumbnail,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.members.playlists.videos.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'playlist' => $playlist->id_playlist,
            'playlistVideo' => $playlistVideo->id_video,
        ]);
    }

    public function playlistShowVideo(Product $product, SubProduct $subProduct, Playlist $playlist, PlaylistVideo $playlistVideo)
    {
        $menuProducts = Product::with('subProducts')->get();
        $playlist = Playlist::findOrFail($playlist->id);
        $playlistVideos = $playlist->playlistVideos()
            ->oldest()
            ->get();
        $playlist->setRelation('playlistVideos', $playlistVideos);

        return inertia('Admin/Members/Playlists/Videos/Show', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'playlist' => $playlist,
            'playlistVideo' => $playlistVideo,
        ]);
    }

    public function playlistDestroyVideo(Product $product, SubProduct $subProduct, Playlist $playlist, PlaylistVideo $playlistVideo)
    {
        if ($playlistVideo->thumbnail && Storage::disk('public')->exists($playlistVideo->thumbnail)) {
            Storage::disk('public')->delete($playlistVideo->thumbnail);
        }

        $playlistVideo->delete();

        return redirect()->route('admin.members.playlists.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'playlist' => $playlist->id_playlist,
        ]);
    }
}
