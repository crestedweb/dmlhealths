<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()?->is_admin, 403);
        return view('admin.dashboard', ['stats' => [
            'Contact messages' => DB::table('contact_messages')->count(), 'Information requests' => DB::table('information_requests')->count(),
            'Published articles' => DB::table('blog_posts')->where('published', true)->count(), 'Gallery images' => DB::table('gallery_images')->count(),
        ]]);
    }
}
