<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Apply auth middleware to user-facing methods
        $this->middleware('auth');
        
        // Apply admin middleware only to admin methods
        $this->middleware('admin')->only([
            'index', 'pending', 'approved', 'rejected', 'approve', 'reject'
        ]);
    }

    /**
     * Store a newly uploaded image.
     * (User-facing method)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the file
        $path = $request->file('image')->store('gallery', 'public');

        // Create database record
        $image = new Image();
        $image->title = $request->title;
        $image->path = $path;
        $image->user_id = auth()->id();
        $image->status = 'pending'; // Default status is pending
        $image->save();

        return redirect()->route('home')->with('status', 'Image uploaded successfully! It will be reviewed by an admin.');
    }

    /**
     * Get all images for user gallery display.
     * (User-facing method)
     *
     * @return \Illuminate\Http\Response
     */
    public function userGallery()
    {
        $images = Image::where('user_id', auth()->id())->latest()->get();
        return view('home', compact('images'));
    }

    /**
     * Display a listing of all images.
     * (Admin-facing method)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $images = Image::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.images.index', compact('images'));
    }

    /**
     * Display a listing of pending images.
     * (Admin-facing method)
     *
     * @return \Illuminate\View\View
     */
    public function pending()
    {
        $images = Image::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->paginate(15);
        return view('admin.images.pending', compact('images'));
    }

    /**
     * Display a listing of approved images.
     * (Admin-facing method)
     *
     * @return \Illuminate\View\View
     */
    public function approved()
    {
        $images = Image::with('user')
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.images.approved', compact('images'));
    }

    /**
     * Display a listing of rejected images.
     * (Admin-facing method)
     *
     * @return \Illuminate\View\View
     */
    public function rejected()
    {
        $images = Image::with('user')
            ->where('status', 'rejected')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.images.rejected', compact('images'));
    }

    /**
     * Approve the specified image.
     * (Admin-facing method)
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Image $image)
    {
        $image->status = 'approved';
        $image->approved_at = now();
        $image->save();
        
        return back()->with('success', 'Image has been approved');
    }

    /**
     * Reject the specified image.
     * (Admin-facing method)
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(Image $image)
    {
        $image->status = 'rejected';
        $image->save();
        
        return back()->with('success', 'Image has been rejected');
    }
}