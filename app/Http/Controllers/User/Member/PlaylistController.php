<?php

namespace App\Http\Controllers\User\Member;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\PlaylistVideo;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function playlists(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();
        $playlists = Playlist::where('sub_product_id', $subProduct->id)
            ->with('subProduct')
            ->withCount('playlistVideos')
            ->latest()
            ->paginate(10);

        return inertia('User/Members/Playlists/Index', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'playlists' => $playlists,
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

        return inertia('User/Members/Playlists/Show', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'playlist' => $playlist,
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

        return inertia('User/Members/Playlists/Videos/Show', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'playlist' => $playlist,
            'playlistVideo' => $playlistVideo,
        ]);
    }
}
